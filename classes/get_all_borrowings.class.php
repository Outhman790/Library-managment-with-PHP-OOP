<?php
require_once 'dbConnect.class.php';
class getAllBorrowings extends dbConnect
{
    public function getAllBorrowings()
    {
        $this->connect();
        try {
            $stmt = $this->connection->prepare('SELECT * FROM borrowings');
            $stmt->execute();
            $allBorrowings = $stmt->fetchAll();
            return $allBorrowings;
        } catch (PDOException $e) {
            throw new Exception('error getting all borrowings' . $e->getMessage());
        }
    }
}
