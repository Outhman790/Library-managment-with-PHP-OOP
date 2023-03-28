<?php
require_once '../classes/myProfile.php';
session_start();
if (isset($_POST['update_profile'])) {

    $Nickname = $_POST['nickname'];
    $Password = $_POST['password'];
    $Address = $_POST['address'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $CIN = $_POST['cin'];
    $Occupation = $_POST['occupation'];
    $Birth_Date = $_POST['birthdate'];

    $profileObj = new profile();
    $updateProfile = $profileObj->updateProfile($Nickname, $Password, $Address, $Email, $Phone, $CIN, $Occupation, $Birth_Date, $_SESSION['Nickname']);
    if ($updateProfile > 0) :
        echo "<script>confirm(\"Profile updated Successfully\");</script>";
    else :
        echo "<script>confirm(\"Profile didn't update Successufully\");</script>";
    endif;
}