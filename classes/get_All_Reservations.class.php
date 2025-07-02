<?php
class getAllReservations extends dbConnect
{
    public function getAllReservations($page, $limit)
    {
        try {
            $offset = ($page - 1) * $limit;
            $this->connect();
            $stmt = $this->connection->prepare("SELECT * FROM `reservation` r JOIN `collection` c  JOIN `types` t JOIN client cl WHERE r.Collection_ID = c.Collection_ID AND t.Type_ID = c.Type_ID AND c.Status = 'Reserved' AND cl.Nickname = r.Nickname LIMIT :limit OFFSET :offset ;");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $allReservations = $stmt->fetchAll();
            return $allReservations;
        } catch (PDOException $e) {
            throw new Exception("Error getting reservations:" . $e->getMessage());
        }
    }
    public function countItems()
    {
        try {
            $this->connect();
            $statement = $this->connection->prepare('SELECT COUNT(*) as total FROM reservation r JOIN collection c ON r.Collection_ID = c.Collection_ID WHERE c.Status = "Reserved"');
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            throw new Exception('Error counting Items: ' . $e->getMessage());
        }
    }
}
