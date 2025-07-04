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

// Server-side validation
$errors = [];
$title = trim($_POST['Title_add'] ?? '');
$Author_Name = trim($_POST['Author_Name_add'] ?? '');
$state = $_POST['state_add'] ?? '';
$Edition_Date = $_POST['Edition_Date_add'] ?? '';
$Buy_Date = $_POST['Buy_Date_add'] ?? '';
$type = $_POST['type_add'] ?? '';

if ($title === '' || strlen($title) < 2 || strlen($title) > 255) {
    $errors[] = 'Title must be between 2 and 255 characters.';
}
if ($Author_Name === '' || strlen($Author_Name) < 2 || strlen($Author_Name) > 255) {
    $errors[] = 'Author name must be between 2 and 255 characters.';
}
$validStates = ['Used', 'Pretty used', 'New'];
if (!in_array($state, $validStates)) {
    $errors[] = 'Invalid state.';
}
if (!$Buy_Date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $Buy_Date)) {
    $errors[] = 'Invalid buy date.';
}
if (!$Edition_Date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $Edition_Date)) {
    $errors[] = 'Invalid edition date.';
}
$validTypes = ['1', '2', '3', '4', '5'];
if (!in_array($type, $validTypes)) {
    $errors[] = 'Invalid type.';
}
$Cover_Image = $_FILES['Cover_Image_add'] ?? null;
if (!$Cover_Image || $Cover_Image['error'] !== UPLOAD_ERR_OK) {
    $errors[] = 'Error uploading file.';
} else {
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($Cover_Image['type'], $allowedTypes)) {
        $errors[] = 'Invalid file type.';
    }
    $maxFileSize = 1024 * 1024; // 1 MB
    if ($Cover_Image['size'] > $maxFileSize) {
        $errors[] = 'File size exceeds limit.';
    }
}
if ($errors) {
    echo '<div class="alert alert-danger"><ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul></div>';
    exit;
}

$crudObj = new Library();
$updateItem = $crudObj->addItem($title, $Author_Name, $state, $Edition_Date, $Buy_Date, $type, $filename);
header('location: ../admin/allItems.php');
