<?php
require_once 'dbConnect.class.php';
class return_borrowing extends dbConnect
{
    public function return_borrowing($borrowing_id, $collection_id, $nickname)
    {
        try {
            $this->connect();
            // Update the Borrowing_Return_Date for the specified borrowing
            $stmt = $this->connection->prepare('UPDATE borrowings SET Borrowing_Return_Date = NOW() WHERE Borrowing_ID = :borrowing_id');
            $stmt->bindParam(':borrowing_id', $borrowing_id);
            $stmt->execute();



            // Update the Status for the specified collection
            $new_status = 'Available';
            $stmt = $this->connection->prepare('UPDATE collection SET Status = :new_status WHERE Collection_ID = :collection_id');
            $stmt->bindParam(':new_status', $new_status);
            $stmt->bindParam(':collection_id', $collection_id);
            $stmt->execute();

            // Update the Status for the specified collection
            $stmt = $this->connection->prepare('UPDATE borrowings SET Status = :new_status WHERE Borrowing_ID = :Borrowing_ID');
            $stmt->bindParam(':new_status', $new_status);
            $stmt->bindParam(':Borrowing_ID', $borrowing_id);
            $stmt->execute();


            $stmt = $this->connection->prepare('SELECT Borrowing_Date, Borrowing_Return_Date FROM borrowings WHERE Borrowing_ID = :borrowing_id');
            $stmt->bindParam(':borrowing_id', $borrowing_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $borrowing_date = new DateTime($result['Borrowing_Date']);
            $return_date = new DateTime($result['Borrowing_Return_Date']);
            $difference = $borrowing_date->diff($return_date);
            echo $difference->days;
            if ($difference->days > 15) {
                // Increment penalty count
                $stmt = $this->connection->prepare('UPDATE client SET Penalty_Count = Penalty_Count + 1 WHERE Nickname = :nickname');
                $stmt->bindParam(':nickname', $nickname);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo 'error:' . $e->getMessage();
        }
    }
}
