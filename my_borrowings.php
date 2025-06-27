<?php
session_start();
require_once("classes/myBorrowings.php");
require_once 'functions/check_account.func.php';
checkAccount($_SESSION['Penalty_Count']);
if ($_SESSION['Admin'] === 0) :
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My borrowings</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .page-wrapper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#">Olibrary</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Homepage</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?php echo $_SESSION['Nickname'] ?? 'Profile nickname'; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="myProfile.php">My profile</a></li>
                            <li><a class="dropdown-item" href="my_reservations.php">My reservations</a></li>
                            <li><a class="dropdown-item" href="#">My borrowings</a></li>
                            <li><a href="./includes/logout.inc.php" class="dropdown-item">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
                </div>
            </div>
        </header>

        <main>
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <section class="text-center">
                        <h4 class="mb-5"><strong>My Borrowings</strong></h4>
                        <div class="row">
                            <?php
                                $myReservationsObj = new getMyBorrowings($_SESSION['Nickname']);
                                $myReservations = $myReservationsObj->getMyBorrowings();
                                foreach ($myReservations as $key => $value) :
                                ?>
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card">
                                    <div class="bg-image hover-overlay ripple">
                                        <img src="img/<?php echo $value['Cover_Image'] ?>"
                                            class="img-fluid-custom mw-100" style="height: 23rem;" />
                                    </div>
                                    <div>
                                        <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <span class="mdi mdi-home"></span>
                                                <p><?php echo $value['Type_Name'] ?></p>
                                            </div>
                                            <div>
                                                <span class="mdi mdi-file-check"></span>
                                                <p><?php echo $value['Status'] ?></p>
                                            </div>
                                            <div>
                                                <span class="mdi mdi-book-open-variant"></span>
                                                <p><?php echo $value['State'] ?></p>
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

        <footer class="bg-dark text-white text-center py-4">
            &copy; <?php echo date('Y'); ?> Your Website
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
<?php
else :
    header('location: admin/all_borrowings.php');
endif;
?>