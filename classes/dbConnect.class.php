<?php
class dbConnect
{
    protected $connection;
    protected $host = 'localhost';
    protected $dbname = 'library';
    protected $username = 'outhman790';
    protected $Password = 'outhman790..!!';

    public function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->connection = new PDO($dsn, $this->username, $this->Password, $options);
            return $this->connection;
        } catch (PDOException $e) {
            throw new Exception('Could not connect to database: ' . $e->getMessage());
        }
    }
}