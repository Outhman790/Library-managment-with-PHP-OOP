<?php
session_start();
require_once('../classes/cancel_reservation.class.php');

// Check if admin is logged in
if (!isset($_SESSION['Nickname']) || $_SESSION['Admin'] !== 1) {
    header('Location: ../index.php');
    exit();
}

// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    echo "<script>alert('Reservation ID is required.'); window.location.href='../admin/all_reservations.php';</script>";
    exit();
}

$reservation_id = $_GET['id'];

try {
    // For admin, we'll create a modified version that doesn't check ownership
    $cancelReservationObj = new CancelReservation();

    // We need to modify the approach for admin - let's get the reservation first
    $dbh = new dbConnect();
    $conn = $dbh->connect();

    // Get reservation details
    $stmt = $conn->prepare('SELECT * FROM reservation WHERE Reservation_ID = :Reservation_ID');
    $stmt->bindParam(':Reservation_ID', $reservation_id);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        throw new Exception('Reservation not found.');
    }

    // Check if reservation has already been converted to borrowing
    $stmt = $conn->prepare('SELECT COUNT(*) FROM borrowings WHERE Reservation_ID = :Reservation_ID');
    $stmt->bindParam(':Reservation_ID', $reservation_id);
    $stmt->execute();
    $borrowingExists = $stmt->fetchColumn() > 0;

    if ($borrowingExists) {
        throw new Exception('Cannot cancel reservation that has already been converted to borrowing.');
    }

    // Begin transaction
    $conn->beginTransaction();

    // Change status of collection back to Available
    $stmt = $conn->prepare('UPDATE collection SET Status = :available WHERE Collection_ID = :Collection_ID');
    $status = 'Available';
    $stmt->bindParam(':available', $status);
    $stmt->bindParam(':Collection_ID', $reservation['Collection_ID']);
    $stmt->execute();

    // Delete the reservation
    $stmt = $conn->prepare('DELETE FROM reservation WHERE Reservation_ID = :Reservation_ID');
    $stmt->bindParam(':Reservation_ID', $reservation_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    echo "<script>alert('Reservation cancelled successfully!'); window.location.href='../admin/all_reservations.php';</script>";
} catch (Exception $e) {
    if (isset($conn)) {
        $conn->rollback();
    }
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='../admin/all_reservations.php';</script>";
}
