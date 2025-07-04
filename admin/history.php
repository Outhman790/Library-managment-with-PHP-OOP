<?php
session_start();
require_once("../classes/myBorrowings.class.php");
require_once("../classes/reservationHistory.class.php");
require_once '../functions/check_account.func.php';
checkAccount($_SESSION['Penalty_Count']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My History</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />

</head>

<body class="d-flex flex-column min-vh-100 bg-light" style="background: linear-gradient(to right, #f0f7f4, #e3f2ed); color: #1a2e35;">
    <div class="d-flex flex-column min-vh-100">
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
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Borrow & Reservation History</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Review every activity here.</p>
                </div>
            </div>
        </header>
        <main class="flex-grow-1">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <!-- Borrowing History Section -->
                    <div class="mb-5">
                        <h3 class="text-primary border-bottom border-primary pb-2 mb-4">
                            <i class="mdi mdi-book-open-page-variant me-2"></i>
                            Borrowing History
                        </h3>
                        <div class="table-responsive rounded shadow">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Borrowed Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <th>Condition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $borrowObj = new getMyBorrowings();
                                    $borrowings = $borrowObj->getMyBorrowings();
                                    if (empty($borrowings)) : ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-book-open-page-variant" style="font-size: 2rem;"></i>
                                            <p class="mt-2">No borrowing history found</p>
                                        </td>
                                    </tr>
                                    <?php else :
                                    foreach ($borrowings as $borrowing) : ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($borrowing['Title']) ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($borrowing['User_Nickname']) ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo htmlspecialchars($borrowing['Type_Name']) ?></span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($borrowing['Borrowing_Date'])) ?></td>
                                        <td>
                                            <?php 
                                            if ($borrowing['Borrowing_Return_Date']) {
                                                echo date('M d, Y', strtotime($borrowing['Borrowing_Return_Date']));
                                            } else {
                                                echo '<span class="text-muted">—</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $statusClass = '';
                                            $statusText = $borrowing['Status'];
                                            
                                            if (strpos(strtolower($statusText), 'active') !== false) {
                                                $statusClass = 'status-active';
                                            } elseif (strpos(strtolower($statusText), 'returned') !== false) {
                                                $statusClass = 'status-returned';
                                            } else {
                                                $statusClass = 'status-expired';
                                            }
                                            ?>
                                            <span class="status-badge <?php echo $statusClass ?>">
                                                <?php echo htmlspecialchars($statusText) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo htmlspecialchars($borrowing['State']) ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Reservation History Section -->
                    <div class="history-section">
                        <h3 class="section-header text-success">
                            <i class="mdi mdi-calendar-clock me-2"></i>
                            Reservation History
                        </h3>
                        <div class="table-responsive rounded shadow">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Reserved Date</th>
                                        <th>Expiration Date</th>
                                        <th>Status</th>
                                        <th>Condition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $resHistoryObj = new ReservationHistory();
                                    $reservations = $resHistoryObj->getHistory();
                                    if (empty($reservations)) : ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-calendar-clock" style="font-size: 2rem;"></i>
                                            <p class="mt-2">No reservation history found</p>
                                        </td>
                                    </tr>
                                    <?php else :
                                    foreach ($reservations as $reservation) : ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($reservation['Title']) ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($reservation['User_Nickname']) ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo htmlspecialchars($reservation['Type_Name']) ?></span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($reservation['Reservation_Date'])) ?></td>
                                        <td><?php echo date('M d, Y', strtotime($reservation['Reservation_Expiration_Date'])) ?></td>
                                        <td>
                                            <?php 
                                            $expirationDate = new DateTime($reservation['Reservation_Expiration_Date']);
                                            $currentDate = new DateTime();
                                            $statusClass = $expirationDate < $currentDate ? 'status-expired' : 'status-active';
                                            $statusText = $expirationDate < $currentDate ? 'Expired' : 'Active';
                                            ?>
                                            <span class="status-badge <?php echo $statusClass ?>">
                                                <?php echo $statusText ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo htmlspecialchars($reservation['State']) ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="text-center mt-auto py-3 bg-dark">
            <p class="mb-0 text-white-50">Olibrary &copy; <?= date("Y") ?> </p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>