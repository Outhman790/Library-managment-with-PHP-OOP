<?php
require_once('dbConnect.class.php');
class CancelReservation extends dbConnect
{
    public function cancelReservation($reservation_id, $user_nickname)
    {
        $this->connect();
        try {
            // begin transaction
            $this->connection->beginTransaction();

            // get reservation details and verify ownership
            $stmt = $this->connection->prepare('SELECT * FROM reservation WHERE Reservation_ID = :Reservation_ID AND Nickname = :Nickname');
            $stmt->bindParam(':Reservation_ID', $reservation_id);
            $stmt->bindParam(':Nickname', $user_nickname);
            $stmt->execute();
            $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reservation) {
                throw new Exception('Reservation not found or you do not have permission to cancel it.');
            }

            // check if reservation has already been converted to borrowing
            $stmt = $this->connection->prepare('SELECT COUNT(*) FROM borrowings WHERE Reservation_ID = :Reservation_ID');
            $stmt->bindParam(':Reservation_ID', $reservation_id);
            $stmt->execute();
            $borrowingExists = $stmt->fetchColumn() > 0;

            if ($borrowingExists) {
                throw new Exception('Cannot cancel reservation that has already been converted to borrowing.');
            }

            // change status of collection back to Available
            $stmt = $this->connection->prepare('UPDATE collection SET Status = :available WHERE Collection_ID = :Collection_ID');
            $status = 'Available';
            $stmt->bindParam(':available', $status);
            $stmt->bindParam(':Collection_ID', $reservation['Collection_ID']);
            $stmt->execute();

            // delete the reservation
            $stmt = $this->connection->prepare('DELETE FROM reservation WHERE Reservation_ID = :Reservation_ID');
            $stmt->bindParam(':Reservation_ID', $reservation_id);
            $stmt->execute();

            // commit transaction
            $this->connection->commit();
            return true;
        } catch (Exception $e) {
            // rollback transaction on error
            $this->connection->rollback();
            throw new Exception('Error canceling reservation: ' . $e->getMessage());
        }
    }
}
