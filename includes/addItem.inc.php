<?php
require_once('../classes/crud.class.php');

$Cover_Image = $_FILES['Cover_Image_add'];
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

// Generate a unique filename for the image
$filename = uniqid() . '_' . $Cover_Image['name'];

// Move the uploaded image to the img folder
$uploadDir = '../img/';
if (!move_uploaded_file($Cover_Image['tmp_name'], $uploadDir . $filename)) {
    die('Error moving file to destination folder.');
}

$title = $_POST['Title_add'];
$Author_Name = $_POST['Author_Name_add'];
$state = $_POST['state_add'];
$Edition_Date = $_POST['Edition_Date_add'];
$Buy_Date = $_POST['Buy_Date_add'];
$type = $_POST['type_add'];

$crudObj = new Library();
$updateItem = $crudObj->addItem($title, $Author_Name, $state, $Edition_Date, $Buy_Date, $type, $filename);
header('location: ../admin/allItems.php');
