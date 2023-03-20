<?php
require_once('dbConnect.class.php');
class Library extends dbConnect
{
    public function getItems()
    {
        try {
            $this->connect();
            $statement = $this->connection->query('SELECT * FROM collection join types ON collection.Type_ID = types.Type_ID; ');
            return $statement->fetchAll();
        } catch (PDOException $e) {
            throw new Exception('Error getting Items: ' . $e->getMessage());
        }
    }

    public function addItem($title, $author, $state, $edition_date, $buy_date, $type, $cover_image)
    {
        $connection = $this->connect();
        $statement = $connection->prepare('INSERT INTO collection (Title, Author_Name, State, Edition_Date, Buy_Date, Type_ID, Cover_Image) VALUES (?,?,?,?,?,?,?)');
        $statement->execute([$title, $author, $state, $edition_date, $buy_date, $type, $cover_image]);
    }

    public function deleteItem($id)
    {
        $this->connect();
        $statement = $this->connection->prepare('DELETE FROM collection WHERE Collection_ID = ?');
        $statement->execute([$id]);
        echo "deleted";
    }

    public function updateItem($id, $title, $author, $state, $edition_date, $buy_date, $type, $cover_image)
    {
        $connection = $this->connect();
        $statement = $connection->prepare('UPDATE collection SET Title = ?, Author_Name = ?, State = ?, Edition_Date = ?, Buy_Date = ?, Type_ID = ?, Cover_Image = ? WHERE Collection_ID = ?');
        $statement->execute([$title, $author, $state, $edition_date, $buy_date, $type, $cover_image['name'], $id]);
    }
}
