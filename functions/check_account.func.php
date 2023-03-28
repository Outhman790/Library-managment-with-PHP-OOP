<?php
function checkAccount($penalty_count)
{
    if ($penalty_count >= 3) {
        header('location: account_banned.php');
    }
    exit();
}
