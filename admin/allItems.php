<?php
session_start();
include("../classes/dbConnect.class.php");
include("../classes/crud.class.php");
if (isset($_SESSION['Nickname'])) :
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - All items</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#">Library logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Homepage</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['Nickname'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">My profile</a></li>
                        <li><a class="dropdown-item" href="allItems.php">All items</a></li>
                        <li><a class="dropdown-item" href="all_reservations.php">Reservations</a></li>
                        <li><a class="dropdown-item" href="all_borrowings.php">Borrowings</a></li>
                        <li><a class="dropdown-item" href="../includes/logout.inc.php">Logout</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Filter Items -->
    <div id="filter-items" class="d-flex justify-content-center mt-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Add</button>
    </div>
    <!-- Add item Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="modal-body" enctype="multipart/form-data"
                    action="../includes/addItem.inc.php">
                    <input type="hidden" name="id_add" class="form-control">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="Title_add" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Author name</label>
                        <input type="text" name="Author_Name_add" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Image:</label>
                        <input type="file" name="Cover_Image_add" id="cover_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="item_state">State</label>
                        <select name="state_add" id="item_state" class="form-control">
                            <option value="Used">Used</option>
                            <option value="Pretty used">Pretty Used</option>
                            <option value="New">New</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Buy_Date_add">Buy Date</label>
                        <input type="date" name="Buy_Date_add" class="form-control" id="Buy_Date_add">
                    </div>
                    <div class="form-group">
                        <label for="Edition_Date_add">Edition date</label>
                        <input type="date" name="Edition_Date_add" class="form-control" id="Edition_Date_add">
                    </div>
                    <div class="form-group">
                        <label for="">Title</label>
                        <select name="type_add" id="item_type" class="form-control">
                            <option value="1">Book</option>
                            <option value="2">CD</option>
                            <option value="3">DVD</option>
                            <option value="4">Roman</option>
                            <option value="5">Magazine</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add item Modal -->
    <!-- Section-->
    <section class="py-1">
        <div class="container px-4 px-lg-5 mt-5">
            <!--Section: Content-->
            <section>
                <h4 class="mb-5"><strong>All items</strong></h4>
                <div class="row">
                    <?php
                        $ItemsObj = new Library();
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 4; // Number of items to be displayed per page
                        $offset = ($page - 1) * $limit;
                        $allItems = $ItemsObj->getItems($offset, $limit);
                        foreach ($allItems as $key => $value) :
                        ?>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="../img/<?php echo $value['Cover_Image'] ?>" class="img-fluid-custom mw-100"
                                    style="height: 23rem;" />
                            </div>
                            <div>
                                <h5 class="card-title mt-2"><?php echo $value['Title'] ?></h5>
                                <!-- Button for reserving ( modal ) -->
                                <button type="button" class="btn btn-danger my-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $value['Collection_ID'] ?>">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-success my-2" data-bs-toggle="modal"
                                    data-bs-target="#updateModal<?php echo $value['Collection_ID'] ?>">
                                    Update
                                </button>
                                <!-- Delete item Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $value['Collection_ID'] ?>"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Do you want to delete this item ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button"> <a class="btn btn-danger"
                                                        href="../includes/deleteItem.inc.php?id=<?php echo $value['Collection_ID'] ?>">Delete</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete item Modal -->

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
                        <!-- Update item Modal -->
                        <div class="modal fade" id="updateModal<?php echo $value['Collection_ID'] ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="post" class="modal-body" action="../includes/updateItem.inc.php"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $value['Collection_ID'] ?>"
                                            class="form-control">
                                        <div class="form-group">
                                            <label for="" class="">Title</label>
                                            <input type="text" name="Title" value="<?php echo $value['Title'] ?>"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Author name</label>
                                            <input type="text" name="Author_Name"
                                                value="<?php echo $value['Author_Name'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="cover_image">Image:</label>
                                            <input type="file" name="Cover_Image" id="cover_image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select name="state" id="item_state" class="form-control">
                                                <option value="Used">Used</option>
                                                <option value="Pretty used">Pretty Used</option>
                                                <option value="New">New</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Buy Date</label>
                                            <input type="date" name="Buy_Date" value="<?php echo $value['Buy_Date'] ?>"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Edition date</label>
                                            <input type="date" name="Edition_Date"
                                                value="<?php echo $value['Edition_Date'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <select name="type" id="item_type" class="form-control">
                                                <option value="1">Book</option>
                                                <option value="2">CD</option>
                                                <option value="3">DVD</option>
                                                <option value="4">Roman</option>
                                                <option value="5">Magazine</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Update item Modal -->

                    </div>
                    <?php endforeach; ?>

                </div>
                <?php
                    $total_items = $ItemsObj->countItems();
                    $total_pages = ceil($total_items / $limit);
                    ?>
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
                            ?>
                    </ul>
                </nav>
            </section>

        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; Your Website 2023
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
<?php
else :
    header('location: ../index.php');
endif;
?>