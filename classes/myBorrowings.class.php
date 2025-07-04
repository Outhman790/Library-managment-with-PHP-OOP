<?php
include("dbConnect.class.php");
class getMyBorrowings extends dbConnect
{
    public function __construct()
    {
        // No user_id needed for admin view
    }
    public function getMyBorrowings()
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT b.*, c.Title, c.Cover_Image, c.State, t.Type_Name, cl.Nickname as User_Nickname 
                FROM borrowings b 
                JOIN collection c ON b.Collection_ID = c.Collection_ID 
                JOIN types t ON c.Type_ID = t.Type_ID 
                JOIN client cl ON b.Nickname = cl.Nickname 
                ORDER BY b.Borrowing_Date DESC;");
            $stmt->execute();
            $myReservations = $stmt->fetchAll();
            return $myReservations;
        } catch (PDOException $e) {
            throw new Exception('Error getting borrowings: ' . $e->getMessage());
        }
    }
}