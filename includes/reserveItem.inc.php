<?php
include("../classes/reserve.class.php");
session_start();
// Retrieve the book ID from the URL parameter
$itemId = $_GET['id'];


// Create an instance of the Item class with the book ID
$item = new LibraryItemReservation($itemId, $_SESSION['Nickname']);

// Attempt to reserve the item
$reservationSuccessful = $item->reserveItem();
