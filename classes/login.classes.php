<?php
class login extends dbConnect
{
    protected function getUser($nickname, $password)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM client WHERE Nickname = ? ;');
        if (!$stmt->execute(array($nickname))) {
            $stmt = null;
            header("location: ./index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkedPassword = password_verify($password, $userData[0]['Password']);


        if ($checkedPassword == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkedPassword == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM client WHERE Nickname = ? AND Password = ?;');
            if (!$stmt->execute(array($nickname, $userData[0]['Password']))) {
                $stmt = null;
                header('location: ../index.php?error=stmtfailed');
                exit();
            }
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header('location: ../index.php?error=usernotfound');
                exit();
            }
            if ($user[0]['Penalty_Count'] >= 3) {
                header('location: ../account_banned.php');
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['Nickname'] = $user[0]['Nickname'];
            $_SESSION['Admin'] = $user[0]['Admin'];
            $_SESSION['Penalty_Count'] = $user[0]['Penalty_Count'];
            $stmt = null;
        }
    }
}
