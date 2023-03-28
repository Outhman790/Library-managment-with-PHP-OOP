<?php
include("classes/dbConnect.class.php");
class getMyBorrowings extends dbConnect
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getMyBorrowings()
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT * FROM borrowings b JOIN collection c ON b.Collection_ID = c.Collection_ID JOIN Types t ON c.type_ID = t.type_ID WHERE b.Nickname = ? ;");
            $stmt->execute(array($this->user_id));
            $myReservations = $stmt->fetchAll();
            return $myReservations;
        } catch (PDOException $e) {
            throw new Exception('Error getting reservations: ' . $e->getMessage());
        }
    }
}
