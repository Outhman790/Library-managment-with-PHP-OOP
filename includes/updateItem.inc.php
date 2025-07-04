<?php
session_start();
require_once('../classes/crud.class.php');

$crudObj = new Library();

try {
    // Get form values
    $itemID = $_POST['id'];
    $title = $_POST['Title'];
    $Author_Name = $_POST['Author_Name'];
    $state = $_POST['state'];
    $Edition_Date = $_POST['Edition_Date'];
    $Buy_Date = $_POST['Buy_Date'];
    $type = $_POST['type'];

    // Validate required fields
    if (empty(trim($title)) || empty(trim($Author_Name))) {
        $_SESSION['update_error'] = "Title and Author Name are required fields.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Validate title length
    if (strlen(trim($title)) < 2 || strlen(trim($title)) > 255) {
        $_SESSION['update_error'] = "Title must be between 2 and 255 characters.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Validate author name length
    if (strlen(trim($Author_Name)) < 2 || strlen(trim($Author_Name)) > 255) {
        $_SESSION['update_error'] = "Author name must be between 2 and 255 characters.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Validate state
    $allowedStates = ['Used', 'Pretty used', 'New'];
    if (!in_array($state, $allowedStates)) {
        $_SESSION['update_error'] = "Invalid state selected.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Validate type
    $allowedTypes = [1, 2, 3, 4, 5];
    if (!in_array((int)$type, $allowedTypes)) {
        $_SESSION['update_error'] = "Invalid type selected.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Validate dates
    if (empty($Buy_Date) || empty($Edition_Date)) {
        $_SESSION['update_error'] = "Buy Date and Edition Date are required.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Check if dates are not in the future
    $buyDate = new DateTime($Buy_Date);
    $editionDate = new DateTime($Edition_Date);
    $today = new DateTime();

    if ($buyDate > $today) {
        $_SESSION['update_error'] = "Buy Date cannot be in the future.";
        header('location: ../admin/allItems.php');
        exit();
    }

    if ($editionDate > $today) {
        $_SESSION['update_error'] = "Edition Date cannot be in the future.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Check if edition date is not before buy date
    if ($editionDate < $buyDate) {
        $_SESSION['update_error'] = "Edition Date cannot be before Buy Date.";
        header('location: ../admin/allItems.php');
        exit();
    }

    // Default image is null
    $filename = null;

    // If a new file was uploaded, validate and move it
    if (isset($_FILES['Cover_Image']) && $_FILES['Cover_Image']['error'] === UPLOAD_ERR_OK) {
        $Cover_Image = $_FILES['Cover_Image'];

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($Cover_Image['type'], $allowedTypes)) {
            $_SESSION['update_error'] = "Invalid file type. Only JPEG and PNG files are allowed.";
            header('location: ../admin/allItems.php');
            exit();
        }

        $maxFileSize = 1024 * 1024; // 1 MB
        if ($Cover_Image['size'] > $maxFileSize) {
            $_SESSION['update_error'] = "File size exceeds limit. Maximum size is 1MB.";
            header('location: ../admin/allItems.php');
            exit();
        }

        $filename = uniqid() . '_' . $Cover_Image['name'];
        $uploadDir = '../img/';
        if (!move_uploaded_file($Cover_Image['tmp_name'], $uploadDir . $filename)) {
            $_SESSION['update_error'] = "Error uploading file. Please try again.";
            header('location: ../admin/allItems.php');
            exit();
        }
    } else {
        // No file uploaded, retrieve existing image filename
        $existingItem = $crudObj->getItemById($itemID);
        if ($existingItem && isset($existingItem['Cover_Image'])) {
            $filename = $existingItem['Cover_Image'];
        }
    }

    // Call update
    $result = $crudObj->updateItem($itemID, $title, $Author_Name, $state, $Edition_Date, $Buy_Date, $type, $filename);

    if ($result) {
        $_SESSION['update_success'] = "Item updated successfully!";
    } else {
        $_SESSION['update_error'] = "Failed to update item. Please try again.";
    }
} catch (Exception $e) {
    $_SESSION['update_error'] = "Error: " . $e->getMessage();
}

// Redirect
header('location: ../admin/allItems.php');
