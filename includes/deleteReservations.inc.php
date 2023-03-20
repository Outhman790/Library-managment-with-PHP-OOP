<?php
$oneDayBeforeNow = time() - 20; // Before 24 hours
// Delete the reservations that are older than one day from the reservation date
$sql = "DELETE FROM reservation WHERE reservation_time < :oneDayBeforeNow";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':oneDayBeforeNow', $oneDayBeforeNow);
$stmt->execute();
