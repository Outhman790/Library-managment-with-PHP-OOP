<?php
require_once("../classes/crud.class.php");

$perPage = 20;
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$offset = ($page - 1) * $perPage;

try {
    $library = new Library();
    $allUsers = $library->getAllUsers(); // For total count
    $users = $library->getUsersPaginated($offset, $perPage);
    $totalUsers = count($allUsers);
    $totalPages = ceil($totalUsers / $perPage);
} catch (Exception $e) {
    die("Failed to fetch users: " . $e->getMessage());
}