<?php
require_once('../classes/crud.class.php');
$Cover_Image = $_FILES['Cover_Image'];
if ($Cover_Image['error'] !== UPLOAD_ERR_OK) {
    die('Error uploading file: ' . $Cover_Image['error']);
}

$allowedTypes = ['image/jpeg', 'image/png'];
if (!in_array($Cover_Image['type'], $allowedTypes)) {
    die('Invalid file type: ' . $Cover_Image['type']);
}

$maxFileSize = 1024 * 1024; // 1 MB
if ($Cover_Image['size'] > $maxFileSize) {
    die('File size exceeds limit: ' . $Cover_Image['size']);
}
$itemID = $_POST['id'];
$title = $_POST['Title'];
$Author_Name = $_POST['Author_Name'];
$state = $_POST['state'];
$Edition_Date = $_POST['Edition_Date'];
$Buy_Date = $_POST['Buy_Date'];
$type = $_POST['type'];

$crudObj = new Library();
$updateItem = $crudObj->updateItem($itemID, $title, $Author_Name, $state, $Edition_Date, $Buy_Date, $type, $Cover_Image);
header('location: ../admin/allItems.php');
