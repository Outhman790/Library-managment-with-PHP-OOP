<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("../classes/dbConnect.class.php");
include("../classes/get_all_borrowings.class.php");
if (isset($_SESSION['Nickname'])) :
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>All borrowings</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script defer src="js/scripts.js"></script>
</head>

<body class="d-flex flex-column min-vh-100 bg-light" style="background: linear-gradient(to right, #f0f7f4, #e3f2ed); color: #1a2e35;">
    <!-- Navigation-->

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

    <!-- Page Content -->
    <div class="container px-4 px-lg-5 mt-5 flex-grow-1">
        <section class="text-center">
            <h4 class="mb-5 text-dark border-bottom pb-2"><strong>All Borrowings</strong></h4>
            <div class="row g-4">
                <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $limit = 4;
                    $offset = ($page - 1) * $limit;
                    $AllBorrowingsObj = new getAllBorrowings();
                    $AllBorrowings = $AllBorrowingsObj->getAllBorrowings($page, $limit);
                    foreach ($AllBorrowings as $key => $value) :
                    ?>
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="bg-image hover-overlay ripple">
                            <img src="../img/<?php echo $value['Cover_Image'] ?>" class="img-fluid mw-100 rounded-top"
                                style="height: 23rem; object-fit:cover;" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                            <div id="reservation_info" class="mb-2">
                                <span class="badge bg-primary">Nickname: <?php echo $value['Nickname'] ?></span>
                                <span class="badge bg-secondary ms-2">CIN: <?php echo $value['CIN'] ?></span>
                            </div>
                            <form method="post" action="../includes/confirm_return.php">
                                <input type="hidden" name="id" value="<?php echo $value['Borrowing_ID'] ?>">
                                <input type="hidden" name="Nickname" value="<?php echo $value['Nickname'] ?>">
                                <input type="hidden" name="collection_id" value="<?php echo $value['Collection_ID'] ?>">
                                <button type="submit" class="btn btn-primary my-2">Confirm return</button>
                            </form>
                            <div class="d-flex justify-content-around mt-3">
                                <div><span class="mdi mdi-home"></span>
                                    <p class="mb-0"><?php echo $value['Type_Name'] ?></p>
                                </div>
                                <div><span class="mdi mdi-file-check"></span>
                                    <p class="mb-0"><?php echo $value['Status'] ?></p>
                                </div>
                                <div><span class="mdi mdi-book-open-variant"></span>
                                    <p class="mb-0"><?php echo $value['State'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php
                $total_items = $AllBorrowingsObj->countItems();
                $total_pages = ceil($total_items / $limit);
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
        </section>
    </div>

    <!-- Footer-->
    <footer class="text-center mt-auto py-3 bg-dark">
        <p class="mb-0 text-white-50">Olibrary - Admin Panel &copy; <?= date("Y") ?> </p>
    </footer>
</body>

</html>
<?php else :
    header('location: ../index.php');
endif; ?>