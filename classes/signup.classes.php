<?php
class signUp extends dbConnect
{
    protected function setUser($NickName, $Email, $Password, $Address, $Phone, $CIN, $Occupation, $Birth_Date)
    {
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare('INSERT INTO client (Nickname,Password,Address,Email,Phone,CIN,Occupation,Birth_Date) VALUES (?,?,?,?,?,?,?,?)');
        if (!$stmt->execute(array($NickName, $hashedPassword, $Address, $Email, $Phone, $CIN, $Occupation, $Birth_Date))) {
            $stmt = null;
            header("location: ./index.php?error=stmtfailed");
            exit();
        }
    }
    protected function checkUser($NickName, $Email)
    {
        $stmt = $this->connect()->prepare('SELECT Nickname FROM client WHERE Nickname = ? OR Email = ? ;');
        if (!$stmt->execute(array($NickName, $Email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $count = $stmt->rowCount();
        return ($count > 0);
    }
}