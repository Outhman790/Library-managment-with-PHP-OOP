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
        try {
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("SELECT STATUS FROM `collection` WHERE Collection_ID = ? ; ");
            $stmt->execute(array($this->item_id));
            $status = $stmt->fetchColumn();
            $stmt = null;
            if ($status === "Available") {
                $stmt = $this->connection->prepare("UPDATE `collection` SET `Status`='Reserved' WHERE Collection_ID = ? ;");
                $stmt->execute(array($this->item_id));
                $current_date_time = date('Y-m-d H:i:s');
                $current_date_time_plus_24_hours = date('Y-m-d H:i:s', strtotime('+24 hours'));
                $stmt = $this->connection->prepare("INSERT INTO `reservation`(`Reservation_Date`, `Reservation_Expiration_Date`, `Collection_ID`, `Nickname`) VALUES (?,?,?,?)");
                $stmt->execute(array($current_date_time, $current_date_time_plus_24_hours, $this->item_id, $this->user_id));
                echo "You've successfully reserved this item";
                $this->connection->commit();
            } else if ($status === "Reserved") {
                header("location: ../reservations.php?status=reserved");
            } else if ($status === "Borrowed") {
                header("location: ../reservations.php?status=borrowed");
            } else {
                echo "This item is unavailable";
            }
        } catch (Exception $e) {
            $this->connection->rollback();
            echo "Error occurred: " . $e->getMessage();
        }
    }

    public function deleteExpiredReservations()
    {
        $this->connect();
        try {
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("DELETE FROM `reservation` WHERE TIMESTAMPDIFF(SECOND, `Reservation_Date`, NOW()) > 20;");
            $stmt->execute();
            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollback();
            echo "Error occurred: " . $e->getMessage();
        }
    }
}
