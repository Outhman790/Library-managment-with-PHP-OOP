<?php
require 'classes/dbConnect.class.php';
$dbh = new dbConnect();
$conn = $dbh->connect();

try {
    // Start transaction
    $conn->beginTransaction();

    // First, get all expired reservations that haven't been converted to borrowings
    $selectSql = "SELECT r.Collection_ID 
                  FROM reservation r 
                  WHERE r.Reservation_Expiration_Date < NOW() 
                  AND r.Collection_ID NOT IN (SELECT Collection_ID FROM borrowings)";

    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->execute();
    $expiredCollections = $selectStmt->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($expiredCollections)) {
        // Update collection status back to Available for expired reservations
        $placeholders = str_repeat('?,', count($expiredCollections) - 1) . '?';
        $updateSql = "UPDATE collection SET Status = 'Available' WHERE Collection_ID IN ($placeholders)";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute($expiredCollections);

        // Delete expired reservations
        $deleteSql = "DELETE FROM reservation 
                      WHERE Reservation_Expiration_Date < NOW() 
                      AND Collection_ID NOT IN (SELECT Collection_ID FROM borrowings)";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->execute();

        echo "Successfully processed " . count($expiredCollections) . " expired reservations.\n";
    } else {
        echo "No expired reservations found.\n";
    }

    // Commit transaction
    $conn->commit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo "Error: " . $e->getMessage() . "\n";
}
