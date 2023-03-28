<?php
if (isset($_POST['login'])) {
    // Getting the data
    $nickName = $_POST['nickName'];
    $password = $_POST['password'];


    // Instantiate signup-controller class
    include('../classes/dbConnect.class.php');
    include('../classes/login.classes.php');
    include('../classes/login-controller.classes.php');
    $login = new loginContr($nickName, $password);

    // running error handler and user signup
    $login->loginUser();

    // Going back to front page
    session_start();
    if ($_SESSION['Admin'] == 1) {
        header('location: ../admin/admin_homepage.php');
    } else if ($_SESSION['Admin'] == 0 && $_SESSION['Penalty_Count'] < 3) {
        header('location: ../index.php?error=none');
    } else if ($_SESSION['Admin'] == 0  && $_SESSION['Penalty_Count'] >= 3) {
        header('location: ../account_banned.php');
    }
}
