<?php
session_start();
require_once("classes/dbConnect.class.php");
require_once("classes/crud.class.php");
require_once 'classes/search.class.php';
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
        <title>All items</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
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

    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-end " id="navbarSupportedContent"
                    style="margin-left: auto;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <a class="navbar-brand" href="index.php">
                                <img src="img/Olibrary_logo.png" alt="Library logo" class="w-auto" style="height: 40px;">
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['Nickname'] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="myProfile.php">My profile</a></li>
                            <li><a class="dropdown-item" href="my_reservations.php">My reservations</a></li>
                            <li><a class="dropdown-item" href="my_borrowings.php">My Borrowings</a></li>
                            <li><a href="./includes/logout.inc.php" class="dropdown-item">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Access the World of Books Online</h1>
                    <p class="lead fw-normal text-white-50 mb-0">
                        Explore the world through our shelves: borrow, read, learn, and grow! </p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <form class="form-inline" action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search an item by title"
                                name="search_value">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="submit_search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Section-->
        <section class="py-2">
            <div class="container px-4 px-lg-5 mt-5">
                <!--Section: Content-->
                <section class="text-center">
                    <h4 class="mb-5"><strong>Our Collection</strong></h4>
                    <div class="row">
                        <?php
                        if (isset($_POST['submit_search'])) :
                            $searchValue = $_POST['search_value'];
                            $searchObj = new Search();
                            $searchValue = $searchObj->searchItem($searchValue);
                            foreach ($searchValue as $key => $value) :
                        ?>
                                <div class="col-lg-3 col-md-4 mb-4">
                                    <div class="card">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <img src="img/<?php echo $value['Cover_Image'] ?>" class="img-fluid-custom mw-100"
                                                style="height: 23rem;" />
                                        </div>
                                        <div>
                                            <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                            <!-- Button for reserving ( modal ) -->
                                            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal"
                                                data-bs-target="#reserveModal<?php echo $value['Collection_ID'] ?>">
                                                Reserve
                                            </button>
                                            <!-- Reserve Modal -->
                                            <div class="modal fade" id="reserveModal<?php echo $value['Collection_ID'] ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to reserve this item ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button"> <a class="btn btn-primary"
                                                                    href="includes/reserveItem.inc.php?id=<?php echo $value['Collection_ID'] ?>">Reserve</a></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End reserve Modal -->
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
                            <?php
                        else :
                            $ItemsObj = new Library();
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $limit = 4;
                            $offset = ($page - 1) * $limit;
                            $allItems = $ItemsObj->getItems($offset, $limit);
                            foreach ($allItems as $key => $value) :
                            ?>
                                <div class="col-lg-3 col-md-4 mb-4">
                                    <div class="card">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <img src="img/<?php echo $value['Cover_Image'] ?>" class="img-fluid-custom mw-100"
                                                style="height: 23rem;" />
                                        </div>
                                        <div>
                                            <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                            <!-- Button for reserving ( modal ) -->
                                            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal"
                                                data-bs-target="#reserveModal<?php echo $value['Collection_ID'] ?>">
                                                Reserve
                                            </button>
                                            <!-- Reserve Modal -->
                                            <div class="modal fade" id="reserveModal<?php echo $value['Collection_ID'] ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to reserve this item ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button"> <a class="btn btn-primary"
                                                                    href="includes/reserveItem.inc.php?id=<?php echo $value['Collection_ID'] ?>">Reserve</a></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End reserve Modal -->
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
                            <?php
                            endforeach;
                            $total_items = $ItemsObj->countItems();
                            $total_pages = ceil($total_items / $limit);

                            ?>
                    </div>

                    <nav>
                        <ul class="pagination justify-content-center">
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
                        endif;
                        ?>
            </div>
        </section>
        </div>
        </section>
        <!-- Footer-->
        <footer class="text-center mt-auto py-3 bg-dark">
            <p class="mb-0 text-white-50">Olibrary &copy; <?= date("Y") ?> </p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>
<?php
else :
    header('location: admin/allItems.php');
endif;
?>