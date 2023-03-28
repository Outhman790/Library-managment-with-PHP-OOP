<?php
require_once 'dbConnect.class.php';
class getAllBorrowings extends dbConnect
{
    public function getAllBorrowings($page, $limit)
    {
        $this->connect();
        try {
            $offset = ($page - 1) * $limit;
            $stmt = $this->connection->prepare('SELECT DISTINCT *
            FROM `borrowings`
            JOIN `collection` ON borrowings.Collection_ID = collection.Collection_ID 
            JOIN `types` ON types.Type_ID = collection.Type_ID  
            JOIN `reservation` ON borrowings.Reservation_ID = reservation.Reservation_ID 
            JOIN `client` ON reservation.Nickname = client.Nickname WHERE borrowings.Status = "Borrowed"
            LIMIT :limit OFFSET :offset;');
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $allBorrowings = $stmt->fetchAll();
            return $allBorrowings;
        } catch (PDOException $e) {
            throw new Exception('error getting all borrowings' . $e->getMessage());
        }
    }
    public function countItems()
    {
        try {
            $this->connect();
            $statement = $this->connection->prepare('SELECT COUNT(*) as total FROM borrowings');
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            throw new Exception('Error counting Items: ' . $e->getMessage());
        }
    }
}
