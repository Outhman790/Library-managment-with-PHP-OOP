<?php
session_start();
include("../classes/dbConnect.class.php");
include("../classes/get_All_Reservations.class.php");
if (isset($_SESSION['Nickname'])):
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>All reservations</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
    </head>

    <body class="d-flex flex-column min-vh-100 bg-light"
        style="background: linear-gradient(to right, #f0f7f4, #e3f2ed); color: #1a2e35;">
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
                        <li class="nav-item"><a class="nav-link text-danger" href="../includes/logout.inc.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <section class="text-center">
                        <h4 class="mb-5 text-dark border-bottom pb-2"><strong>All Reservations</strong></h4>
                        <div class="row g-4">
                            <?php
                            $AllReservationsObj = new getAllReservations();
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $limit = 4;
                            $allReservations = $AllReservationsObj->getAllReservations($page, $limit);
                            if (!empty($allReservations)):
                                foreach ($allReservations as $value): ?>
                                    <div class="col-lg-3 col-md-4 mb-4">
                                        <div class="card shadow border-0 h-100">
                                            <div class="bg-image hover-overlay ripple">
                                                <img src="../img/<?php echo $value['Cover_Image'] ?>"
                                                    class="img-fluid mw-100 rounded-top" style="height: 23rem; object-fit:cover;" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                                <div id="reservation_info" class="mb-2">
                                                    <span class="badge bg-primary">Nickname: <?php echo $value['Nickname'] ?></span>
                                                    <span class="badge bg-secondary ms-2">CIN: <?php echo $value['CIN'] ?></span>
                                                </div>
                                                <div class="d-flex gap-2 mb-3 d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal<?php echo $value['Collection_ID'] ?>">
                                                        <i class="bi bi-check-circle"></i> Confirm
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#cancelModal<?php echo $value['Reservation_ID'] ?>">
                                                        <i class="bi bi-x-circle"></i> Cancel
                                                    </button>
                                                </div>

                                                <!-- Confirm Reservation Modal -->
                                                <div class="modal fade" id="confirmationModal<?php echo $value['Collection_ID'] ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Reservation
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Do you want to confirm reservation for this
                                                                item?</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a class="btn btn-primary"
                                                                    href="../includes/confirmReservation.inc.php?id=<?php echo $value['Reservation_ID'] ?>">Confirm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Cancel Reservation Modal -->
                                                <div class="modal fade" id="cancelModal<?php echo $value['Reservation_ID'] ?>"
                                                    tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="cancelModalLabel">Cancel Reservation
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to cancel the reservation for
                                                                "<strong><?php echo htmlspecialchars($value['Title']) ?></strong>"
                                                                by user
                                                                <strong><?php echo htmlspecialchars($value['Nickname']) ?></strong>?
                                                                <br><br>
                                                                <small class="text-muted">This action cannot be undone.</small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Keep Reservation</button>
                                                                <a href="../includes/adminCancelReservation.inc.php?id=<?php echo $value['Reservation_ID'] ?>"
                                                                    class="btn btn-danger">Cancel Reservation</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-around mt-3">
                                                    <div>
                                                        <span class="mdi mdi-home"></span>
                                                        <p class="mb-0"><?php echo $value['Type_Name'] ?></p>
                                                    </div>
                                                    <div>
                                                        <span class="mdi mdi-file-check"></span>
                                                        <p class="mb-0"><?php echo $value['Status'] ?></p>
                                                    </div>
                                                    <div>
                                                        <span class="mdi mdi-book-open-variant"></span>
                                                        <p class="mb-0"><?php echo $value['State'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php
                                $total_items = $AllReservationsObj->countItems();
                                $total_pages = ceil($total_items / $limit);

                                // Only show pagination if there are multiple pages
                                if ($total_pages > 1):
                                ?>
                                    <nav>
                                        <ul class="pagination justify-content-center mt-4">
                                            <?php
                                            if ($page > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo; Previous</a></li>';
                                            }
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                if ($i == $page) {
                                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                                } else {
                                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                                }
                                            }
                                            if ($page < $total_pages) {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next &raquo;</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="text-center">No reservations found.</p>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </section>
        </main>

        <footer class="text-center mt-auto py-3 bg-dark">
            <p class="mb-0 text-white-50">Olibrary - Admin Panel &copy; <?= date("Y") ?> </p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
else:
    header('location: ../index.php');
endif;
?>