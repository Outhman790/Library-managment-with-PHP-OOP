<?php
session_start();
require_once('../classes/cancel_reservation.class.php');

// Check if user is logged in
if (!isset($_SESSION['Nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    echo "<script>alert('Reservation ID is required.'); window.location.href='../my_reservations.php';</script>";
    exit();
}

$reservation_id = $_GET['id'];
$user_nickname = $_SESSION['Nickname'];

try {
    $cancelReservationObj = new CancelReservation();
    $result = $cancelReservationObj->cancelReservation($reservation_id, $user_nickname);

    if ($result) {
        echo "<script>alert('Reservation cancelled successfully!'); window.location.href='../my_reservations.php';</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='../my_reservations.php';</script>";
}
