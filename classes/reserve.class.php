<?php
require_once("dbConnect.class.php");
class LibraryItemReservation extends dbConnect
{
    private $item_id;
    private $user_id;

    public function __construct($item_id, $user_id)
    {
        $this->item_id = $item_id;
        $this->user_id = $user_id;
    }

    public function getItemId()
    {
        return $this->item_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function reserveItem()
    {
        $this->connect();
        $this->connection->beginTransaction();

        // Check how many active reservations the user has
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM reservation WHERE Nickname = ? AND Reservation_Expiration_Date > NOW()");
        $stmt->execute([$this->user_id]);
        $user_reservation_count = $stmt->fetchColumn();

        if ($user_reservation_count < 3) :
            try {
                // Check if the item already has a non-expired reservation
                $stmt = $this->connection->prepare("SELECT COUNT(*) FROM reservation WHERE Collection_ID = ? AND Reservation_Expiration_Date > NOW()");
                $stmt->execute([$this->item_id]);
                $item_reservation_count = $stmt->fetchColumn();
                $stmt = null;

                if ($item_reservation_count > 0) {
                    // There is already an active reservation for this item
                    echo "<script>alert(\"This item is already reserved by another user.\"); window.location.href='../my_reservations.php';</script>";
                    $this->connection->rollback();
                    return;
                }

                $stmt = $this->connection->prepare("SELECT STATUS FROM `collection` WHERE Collection_ID = ? ; ");
                $stmt->execute([$this->item_id]);
                $status = $stmt->fetchColumn();
                $stmt = null;

                if ($status === "Available") {
                    $stmt = $this->connection->prepare("UPDATE `collection` SET `Status`='Reserved' WHERE Collection_ID = ? ;");
                    $stmt->execute([$this->item_id]);

                    $current_date_time = date('Y-m-d H:i:s');
                    $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

                    $stmt = $this->connection->prepare("INSERT INTO `reservation`(`Reservation_Date`, `Reservation_Expiration_Date`, `Collection_ID`, `Nickname`) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$current_date_time, $expiration, $this->item_id, $this->user_id]);

                    $this->connection->commit();
                    echo "<script>alert(\"You've successfully reserved this item\"); window.location.href='../my_reservations.php';</script>";
                } else if ($status === "Reserved") {
                    echo "<script>alert(\"This item is reserved\"); window.location.href='../my_reservations.php';</script>";
                } else if ($status === "Borrowed") {
                    echo "<script>alert(\"This item is borrowed\"); window.location.href='../my_reservations.php';</script>";
                } else {
                    echo "<script>alert(\"This item is unavailable\"); window.location.href='../my_reservations.php';</script>";
                }
            } catch (Exception $e) {
                $this->connection->rollback();
                echo "<script>alert('Error occurred: " . addslashes($e->getMessage()) . "'); window.location.href='../my_reservations.php';</script>";
            }
        else :
            echo "<script>alert(\"You can't reserve more than 3 items at the same time.\"); window.location.href='../my_reservations.php';</script>";
        endif;
    }
}
