<?php
require_once 'dbConnect.class.php';
class Search extends dbConnect
{
    public function searchItem($value)
    {
        $this->connect();
        $stmt = $this->connection->prepare("SELECT * FROM collection JOIN types WHERE types.Type_ID = collection.Type_ID AND Title LIKE :query");
        $stmt->bindValue(':query', '%' . $value . '%');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
