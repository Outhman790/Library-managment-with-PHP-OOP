<?php
include_once __DIR__ . '/dbConnect.class.php';
class ReservationHistory extends dbConnect
{
    public function __construct()
    {
        // No user_id needed for admin view
    }
    public function getHistory()
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT r.*, c.Title, c.Cover_Image, c.State, t.Type_Name, cl.Nickname as User_Nickname
                FROM reservation r
                JOIN collection c ON r.Collection_ID = c.Collection_ID
                JOIN types t ON c.Type_ID = t.Type_ID
                JOIN client cl ON r.Nickname = cl.Nickname
                ORDER BY r.Reservation_Date DESC;");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception('Error getting reservation history: ' . $e->getMessage());
        }
    }
}