<?php
require_once('dbConnect.class.php');
class Library extends dbConnect
{
    public function getItems($offset, $limit)
    {
        try {
            $this->connect();
            $statement = $this->connection->prepare('SELECT * FROM collection join types ON collection.Type_ID = types.Type_ID LIMIT ?, ?;');
            $statement->bindValue(1, (int) $offset, PDO::PARAM_INT);
            $statement->bindValue(2, (int) $limit, PDO::PARAM_INT);
            $statement->execute();
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

    public function updateItem($id, $title, $Author_Name, $state, $Edition_Date, $Buy_Date, $type, $imageFilename)
    {
        try {
            $this->connect();

            $stmt = $this->connection->prepare("
                UPDATE collection 
                SET Title = ?, Author_Name = ?, State = ?, Edition_Date = ?, Buy_Date = ?, type_ID = ?, Cover_Image = ?
                WHERE Collection_ID = ?
            ");

            $result = $stmt->execute([
                $title,
                $Author_Name,
                $state,
                $Edition_Date,
                $Buy_Date,
                $type,
                $imageFilename,
                $id
            ]);

            return $result;
        } catch (PDOException $e) {
            throw new Exception('Error updating item: ' . $e->getMessage());
        }
    }

    public function getItemById($itemID)
    {
        $this->connect();
        $stmt = $this->connection->prepare("SELECT * FROM collection WHERE Collection_ID = ?");
        $stmt->execute([$itemID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countItems()
    {
        try {
            $this->connect();
            $statement = $this->connection->prepare('SELECT COUNT(*) as total FROM collection');
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            throw new Exception('Error counting Items: ' . $e->getMessage());
        }
    }
    public function getAllUsers()
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT * FROM client");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching users: " . $e->getMessage());
        }
    }

    public function getUsersPaginated($offset, $limit)
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("SELECT Nickname, Address, Email, Phone, CIN, Occupation, Penalty_Count, Birth_Date, Creation_Date FROM client LIMIT :offset, :limit");
            $stmt->bindValue(":offset", (int) $offset, PDO::PARAM_INT);
            $stmt->bindValue(":limit", (int) $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching paginated users: " . $e->getMessage());
        }
    }
}
