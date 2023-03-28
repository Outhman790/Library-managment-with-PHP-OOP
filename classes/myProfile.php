<?php
require_once 'dbConnect.class.php';

class profile extends dbConnect
{
    public function getInfo($Nickname)
    {
        try {
            $this->connect();
            $query = "SELECT * FROM client WHERE Nickname = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([$Nickname]);
            $profile = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profile;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }

    public function updateProfile($nickname, $password, $address, $email, $phone, $cin, $occupation, $birth_date, $user_id)
    {
        try {
            $this->connect();
            $stmt = $this->connection->prepare("UPDATE client SET Nickname = ?, Password = ?, Address = ?, Email = ?, Phone = ?, CIN = ?, Occupation = ?, Birth_Date = ? WHERE Nickname = ?");
            $stmt->execute([$nickname, $password, $address, $email, $phone, $cin, $occupation, $birth_date, $user_id]);
            $affected_rows = $stmt->rowCount();
            return $affected_rows;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return false;
        }
    }
}