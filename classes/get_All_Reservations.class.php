<?php
class getAllReservations extends dbConnect
{
    public function getAllReservations()
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT * FROM `reservation` r JOIN `collection` c  JOIN `types` t JOIN client cl WHERE r.Collection_ID = c.Collection_ID AND t.Type_ID = c.Type_ID AND c.Status = 'Reserved' AND cl.Nickname = r.Nickname ;");
            $stmt->execute();
            $allReservations = $stmt->fetchAll();
            return $allReservations;
        } catch (PDOException $e) {
            throw new Exception("Error getting reservations:" . $e->getMessage());
        }
    }
}