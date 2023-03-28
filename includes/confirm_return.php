<?php
require_once '../classes/borrowing_return.class.php';
$borrowing_id = $_POST['id'];
$collection_id = $_POST['collection_id'];
$Nickname = $_POST['Nickname'];
$confirm_return_obj = new return_borrowing();
$confirm_return = $confirm_return_obj->return_borrowing($borrowing_id, $collection_id, $Nickname);
echo "<script>if(confirm(\"return confirmation done\")) window.location.href='../admin/all_borrowings.php'</script>";
