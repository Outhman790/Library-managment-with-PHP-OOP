<?php
session_start();
include("../classes/dbConnect.class.php");
if (isset($_SESSION['Nickname'])) :
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body class='d-flex flex-column min-vh-100' style="background: linear-gradient(to right, #f0f7f4, #e3f2ed); color: #1a2e35;">



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="admin_homepage.php">
                <img src="../img/Olibrary_logo_white.png" alt="Library logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="admin_homepage.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="allItems.php">Books</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="users.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="all_reservations.php">Reservations</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="all_borrowings.php">Borrow History</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="history.php">History</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="../includes/logout.inc.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="text-dark display-4 fw-bold">Admin Dashboard</h1>
            <p class="text-dark lead">Manage users, books, reservations, and much more!</p>
        </div>



        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-white h-100 p-4 shadow-lg border-0 rounded-4">
                    <h4><i class="bi bi-book"></i> Manage Books</h4>
                    <p class="mb-2">Add, update, and remove books from the library.</p>
                    <a href="allItems.php" class="btn btn-outline-light">Go</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-white h-100 p-4 shadow-lg border-0 rounded-4">
                    <h4><i class="bi bi-person-lines-fill"></i> User Accounts</h4>
                    <p class="mb-2">View and manage registered users.</p>
                    <a href="users.php" class="btn btn-outline-light">Go</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-white h-100 p-4 shadow-lg border-0 rounded-4">
                    <h4><i class="bi bi-journal-bookmark-fill"></i> Reservations</h4>
                    <p class="mb-2">View all pending and approved reservations.</p>
                    <a href="all_reservations.php" class="btn btn-outline-light">Go</a>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center mt-3">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-white h-100 p-4 shadow-lg border-0 rounded-4">
                    <h4><i class="bi bi-clock-history"></i> Borrow History</h4>
                    <p class="mb-2">Check who borrowed which books and when.</p>
                    <a href="all_borrowings.php" class="btn btn-outline-light">Go</a>
                </div>
            </div>
        </div>

    </div>
    </div>

    <footer class="text-center mt-auto py-3 bg-dark">
        <p class="mb-0 text-white-50">Olibrary System Admin Panel &copy; <?= date("Y") ?> </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php endif; ?>