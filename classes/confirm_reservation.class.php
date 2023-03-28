<?php
require_once('dbConnect.class.php');
class Reservation extends dbConnect
{
    public function confirmReservation($reservation_id)
    {
        $this->connect();
        try {
            // begin transaction
            $this->connection->beginTransaction();

            // get reservation details
            $stmt = $this->connection->prepare('SELECT * FROM reservation WHERE Reservation_ID = :Reservation_ID');
            $stmt->bindParam(':Reservation_ID', $reservation_id);
            $stmt->execute();
            $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

            // change status of reservation
            $stmt = $this->connection->prepare('UPDATE collection SET Status = :reserved WHERE Collection_ID = :Collection_ID');
            $status = 'Borrowed';
            $stmt->bindParam(':reserved', $status);
            $stmt->bindParam(':Collection_ID', $reservation['Collection_ID']);
            $stmt->execute();

            // insert borrowing record
            $Status = "Borrowed";
            $stmt =  $this->connection->prepare('INSERT INTO borrowings (  Nickname, Collection_ID, Reservation_ID, Status ) VALUES ( :Nickname, :Collection_ID, :Reservation_ID, :Status)');
            $stmt->bindParam(':Nickname', $reservation['Nickname']);
            $stmt->bindParam(':Collection_ID', $reservation['Collection_ID']);
            $stmt->bindParam(':Reservation_ID', $reservation['Reservation_ID']);
            $stmt->bindParam(':Status', $Status);
            $stmt->execute();

            // commit transaction
            $this->connection->commit();
            echo "<script>if(confirm(\"Reservation confirmed\")) window.location.href='../admin/all_reservations.php';</script>";
        } catch (Exception $e) {
            // rollback transaction on error
            $this->connection->rollback();

            echo 'Error: ' . $e->getMessage();
        }
    }
}
