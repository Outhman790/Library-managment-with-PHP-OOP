<?php
session_start();
if (!isset($_SESSION['Nickname'])) {
    header("Location: ../index.php");
    exit();
}
include("../includes/get_all_users.php"); // Updated path if moved to /includes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100 bg-light" style="background: linear-gradient(to right, #f5f9f0, #e2e8d8); color: #2a3a1e;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="admin_homepage.php">
                <img src="../img/Olibrary_logo.png" alt="Library logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="admin_homepage.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="allItems.php">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="all_reservations.php">Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="all_borrowings.php">Borrowings</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">History</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../includes/logout.inc.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5 flex-grow-1">
        <div class="card p-4 shadow-sm border-0">
            <h2 class="mb-4 text-primary border-bottom pb-2"><i class="bi bi-people-fill"></i> Registered Users</h2>
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-striped table-bordered align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <?php if (!empty($users)) {
                                foreach (array_keys($users[0]) as $col) {
                                    echo "<th>" . htmlspecialchars(ucfirst($col)) . "</th>";
                                }
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <?php foreach ($user as $value): ?>
                            <td><?= htmlspecialchars($value) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="100%">No users found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($totalPages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        Olibrary &copy; <?= date("Y") ?> | Admin Panel
    </footer>

</body>

</html>