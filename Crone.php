<?php
require 'classes/dbConnect.class.php';
$dbh = new dbConnect();
$conn = $dbh->connect();
$deleteSql = "DELETE FROM reservation WHERE Reservation_Date < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND Collection_ID NOT IN (SELECT Collection_ID FROM borrowings)";
$deleteStmt = $conn->prepare($deleteSql);
$deleteStmt->execute();
