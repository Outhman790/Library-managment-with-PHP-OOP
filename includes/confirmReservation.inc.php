<?php
require_once('../classes/confirm_reservation.class.php');
$reservation_ID = $_GET['id'];
$confirmReservationObj = new Reservation();
$newBorrwing = $confirmReservationObj->confirmReservation($reservation_ID);
