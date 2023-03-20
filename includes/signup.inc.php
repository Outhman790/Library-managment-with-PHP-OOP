<?php
if (isset($_POST['signUp'])) {
    // Getting the data
    $nickName = $_POST['nickName'];
    $email = $_POST['email'];
    $CIN = $_POST['CIN'];
    $adress = $_POST['adress'];
    $occupation = $_POST['occupation'];
    $birthDate = $_POST['birthDate'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $phone = $_POST['phone'];

    // Instantiate signup-controller class
    include('../classes/dbConnect.class.php');
    include('../classes/signup.classes.php');
    include('../classes/signup-controller.classes.php');
    $signup = new signUpContr($nickName, $email, $CIN, $adress, $occupation, $birthDate, $password, $repeatPassword, $phone);

    // running error handler and user signup
    $signup->signUpUser();

    // Going back to front page
    header('location: ../index.php?error=none');
}
