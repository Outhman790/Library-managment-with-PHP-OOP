<?php
session_start();
include("classes/myReservations.php");
require_once 'functions/check_account.func.php';
checkAccount($_SESSION['Penalty_Count']);
if ($_SESSION['Admin'] === 0) :
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
        <style>
            /* Ensure sticky footer works properly */
            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }

            footer {
                flex-shrink: 0;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">
                    <img src="img/Olibrary_logo.png" alt="Library logo" style="height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="allItems.php">All Items</a></li>
                        <li class="nav-item"><a class="nav-link" href="my_reservations.php">My Reservations</a></li>
                        <li class="nav-item"><a class="nav-link" href="my_borrowings.php">My Borrowings</a></li>
                        <li class="nav-item"><a class="nav-link" href="myProfile.php">My Profile</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="./includes/logout.inc.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Your Reservations</h1>
                    <p class="lead fw-normal text-white-50 mb-0">
                        Review the items you've reserved and prepare for your next read.
                    </p>
                </div>
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="flex-grow-1 d-flex flex-column">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <section class="text-center">
                        <h4 class="mb-5"><strong>My Reservations</strong></h4>
                        <div class="row">
                            <?php
                            $myReservationsObj = new getMyReservations($_SESSION['Nickname']);
                            $myReservations = $myReservationsObj->getMyReservations();
                            foreach ($myReservations as $key => $value) :
                            ?>
                                <div class="col-lg-3 col-md-4 mb-4">
                                    <div class="card">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <img src="img/<?php echo $value['Cover_Image'] ?>"
                                                class="img-fluid-custom mw-100" style="height: 23rem;" />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                            <div class="d-flex justify-content-around mb-3">
                                                <div>
                                                    <span class="mdi mdi-home"></span>
                                                    <p class="mb-1"><?php echo $value['Type_Name'] ?></p>
                                                </div>
                                                <div>
                                                    <span class="mdi mdi-file-check"></span>
                                                    <p class="mb-1"><?php echo $value['Status'] ?></p>
                                                </div>
                                                <div>
                                                    <span class="mdi mdi-book-open-variant"></span>
                                                    <p class="mb-1"><?php echo $value['State'] ?></p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $value['Reservation_ID'] ?>">
                                                    <i class="bi bi-x-circle"></i> Cancel Reservation
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Cancel Reservation Modal -->
                                        <div class="modal fade" id="cancelModal<?php echo $value['Reservation_ID'] ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cancelModalLabel">Cancel Reservation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to cancel your reservation for "<strong><?php echo htmlspecialchars($value['Title']) ?></strong>"?
                                                        <br>
                                                        <small class="text-muted">This action cannot be undone.</small>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Reservation</button>
                                                        <a href="includes/cancelReservation.inc.php?id=<?php echo $value['Reservation_ID'] ?>" class="btn btn-danger">Cancel Reservation</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="text-center py-3 bg-dark mt-auto">
            <p class="mb-0 text-white-50">Olibrary &copy; <?= date("Y") ?> </p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>
<?php
else :
    header('location: admin/all_reservations.php');
endif;
?>