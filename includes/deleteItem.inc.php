<?php
require_once('../classes/crud.class.php');
$itemID = $_GET['id'];
$crudObj = new Library();
$deleteItem = $crudObj->deleteItem($itemID);
header('Location: ../admin/allItems.php');
