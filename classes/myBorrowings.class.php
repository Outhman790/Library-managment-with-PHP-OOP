<?php
include("dbConnect.class.php");
class getMyBorrowings extends dbConnect
{
    private $nickname;
    public function __construct($nickname = null)
    {
        $this->nickname = $nickname;
    }
    public function getMyBorrowings()
    {
        try {
            $this->connect();
            if ($this->nickname) {
                $stmt = $this->connection->prepare("SELECT b.*, c.Title, c.Cover_Image, c.State, t.Type_Name, cl.Nickname as User_Nickname 
                    FROM borrowings b 
                    JOIN collection c ON b.Collection_ID = c.Collection_ID 
                    JOIN types t ON c.Type_ID = t.Type_ID 
                    JOIN client cl ON b.Nickname = cl.Nickname 
                    WHERE b.Nickname = ?
                    ORDER BY b.Borrowing_Date DESC;");
                $stmt->execute([$this->nickname]);
            } else {
                $stmt = $this->connection->prepare("SELECT b.*, c.Title, c.Cover_Image, c.State, t.Type_Name, cl.Nickname as User_Nickname 
                    FROM borrowings b 
                    JOIN collection c ON b.Collection_ID = c.Collection_ID 
                    JOIN types t ON c.Type_ID = t.Type_ID 
                    JOIN client cl ON b.Nickname = cl.Nickname 
                    ORDER BY b.Borrowing_Date DESC;");
                $stmt->execute();
            }
            $myReservations = $stmt->fetchAll();
            return $myReservations;
        } catch (PDOException $e) {
            throw new Exception('Error getting borrowings: ' . $e->getMessage());
        }
    }
}
