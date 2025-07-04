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

        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['update_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px auto; max-width: 600px;">
                <i class="mdi mdi-check-circle me-2"></i>
                <?php echo $_SESSION['update_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['update_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['update_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px auto; max-width: 600px;">
                <i class="mdi mdi-alert-circle me-2"></i>
                <?php echo $_SESSION['update_error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['update_error']); ?>
        <?php endif; ?>

        <!-- Filter Items -->
        <div id="filter-items" class="d-flex justify-content-center mt-5">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Add an Item</button>
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
                    <form method="post" class="modal-body needs-validation" enctype="multipart/form-data"
                        action="../includes/addItem.inc.php" id="addItemForm" novalidate>
                        <input type="hidden" name="id_add" class="form-control">
                        <div class="mb-3">
                            <label for="Title_add" class="form-label">Title</label>
                            <input type="text" name="Title_add" class="form-control" id="Title_add" required minlength="2" maxlength="255">
                            <div class="invalid-feedback">Please enter a valid title (2-255 characters).</div>
                        </div>
                        <div class="mb-3">
                            <label for="Author_Name_add" class="form-label">Author name</label>
                            <input type="text" name="Author_Name_add" class="form-control" id="Author_Name_add" required minlength="2" maxlength="255">
                            <div class="invalid-feedback">Please enter a valid author name (2-255 characters).</div>
                        </div>
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Image:</label>
                            <input type="file" name="Cover_Image_add" id="cover_image" class="form-control" accept="image/jpeg,image/png" required>
                            <div class="form-text">Only JPEG and PNG files up to 1MB are allowed.</div>
                            <div class="invalid-feedback">Please select a valid image file (JPEG or PNG, max 1MB).</div>
                        </div>
                        <div class="mb-3">
                            <label for="item_state" class="form-label">State</label>
                            <select name="state_add" id="item_state" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="Used">Used</option>
                                <option value="Pretty used">Pretty Used</option>
                                <option value="New">New</option>
                            </select>
                            <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <div class="mb-3">
                            <label for="Buy_Date_add" class="form-label">Buy Date</label>
                            <input type="date" name="Buy_Date_add" class="form-control" id="Buy_Date_add" required>
                            <div class="invalid-feedback">Please select a valid buy date.</div>
                        </div>
                        <div class="mb-3">
                            <label for="Edition_Date_add" class="form-label">Edition date</label>
                            <input type="date" name="Edition_Date_add" class="form-control" id="Edition_Date_add" required>
                            <div class="invalid-feedback">Please select a valid edition date.</div>
                        </div>
                        <div class="mb-3">
                            <label for="item_type" class="form-label">Type</label>
                            <select name="type_add" id="item_type" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="1">Book</option>
                                <option value="2">CD</option>
                                <option value="3">DVD</option>
                                <option value="4">Roman</option>
                                <option value="5">Magazine</option>
                            </select>
                            <div class="invalid-feedback">Please select a valid type.</div>
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
        <section class="py-1 flex-grow-1">
            <div class="container px-4 px-lg-5 mt-5">
                <!--Section: Content-->
                <section>
                    <h4 class="mb-5 text-primary border-bottom pb-2"><strong>All items</strong></h4>
                    <div class="row g-4">
                        <?php
                        $ItemsObj = new Library();
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 4; // Number of items to be displayed per page
                        $offset = ($page - 1) * $limit;
                        $allItems = $ItemsObj->getItems($offset, $limit);
                        foreach ($allItems as $key => $value) :
                        ?>
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card text-center shadow border-0 h-100">
                                    <div class="bg-image hover-overlay ripple">
                                        <img src="../img/<?php echo $value['Cover_Image'] ?>" class="img-fluid mw-100 rounded-top"
                                            style="height: 23rem; object-fit:cover;" />
                                    </div>
                                    <div class="card-body">
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
                                                enctype="multipart/form-data" id="updateForm<?php echo $value['Collection_ID'] ?>" novalidate>
                                                <input type="hidden" name="id" value="<?php echo $value['Collection_ID'] ?>"
                                                    class="form-control">
                                                <div class="form-group mb-3">
                                                    <label for="title_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="Title" id="title_update_<?php echo $value['Collection_ID'] ?>"
                                                        value="<?php echo htmlspecialchars($value['Title']) ?>"
                                                        class="form-control" required minlength="2" maxlength="255">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid title (2-255 characters).
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="author_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Author name <span class="text-danger">*</span></label>
                                                    <input type="text" name="Author_Name" id="author_update_<?php echo $value['Collection_ID'] ?>"
                                                        value="<?php echo htmlspecialchars($value['Author_Name']) ?>"
                                                        class="form-control" required minlength="2" maxlength="255">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid author name (2-255 characters).
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="cover_image_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Image:</label>
                                                    <input type="file" name="Cover_Image" id="cover_image_update_<?php echo $value['Collection_ID'] ?>"
                                                        class="form-control" accept="image/jpeg,image/png">
                                                    <div class="form-text">Leave empty to keep current image. Only JPEG and PNG files up to 1MB are allowed.</div>
                                                    <div class="invalid-feedback">
                                                        Please select a valid image file (JPEG or PNG, max 1MB).
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="state_update_<?php echo $value['Collection_ID'] ?>" class="form-label">State <span class="text-danger">*</span></label>
                                                    <select name="state" id="state_update_<?php echo $value['Collection_ID'] ?>" class="form-select" required>
                                                        <option value="Used" <?php echo ($value['State'] == 'Used') ? 'selected' : ''; ?>>Used</option>
                                                        <option value="Pretty used" <?php echo ($value['State'] == 'Pretty used') ? 'selected' : ''; ?>>Pretty Used</option>
                                                        <option value="New" <?php echo ($value['State'] == 'New') ? 'selected' : ''; ?>>New</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid state.
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="buy_date_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Buy Date <span class="text-danger">*</span></label>
                                                    <input type="date" name="Buy_Date" id="buy_date_update_<?php echo $value['Collection_ID'] ?>"
                                                        value="<?php echo $value['Buy_Date'] ?>"
                                                        class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Please select a valid buy date.
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="edition_date_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Edition date <span class="text-danger">*</span></label>
                                                    <input type="date" name="Edition_Date" id="edition_date_update_<?php echo $value['Collection_ID'] ?>"
                                                        value="<?php echo $value['Edition_Date'] ?>"
                                                        class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Please select a valid edition date.
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="type_update_<?php echo $value['Collection_ID'] ?>" class="form-label">Type <span class="text-danger">*</span></label>
                                                    <select name="type" id="type_update_<?php echo $value['Collection_ID'] ?>" class="form-select" required>
                                                        <option value="1" <?php echo ($value['Type_ID'] == 1) ? 'selected' : ''; ?>>Book</option>
                                                        <option value="2" <?php echo ($value['Type_ID'] == 2) ? 'selected' : ''; ?>>CD</option>
                                                        <option value="3" <?php echo ($value['Type_ID'] == 3) ? 'selected' : ''; ?>>DVD</option>
                                                        <option value="4" <?php echo ($value['Type_ID'] == 4) ? 'selected' : ''; ?>>Roman</option>
                                                        <option value="5" <?php echo ($value['Type_ID'] == 5) ? 'selected' : ''; ?>>Magazine</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid type.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
        <footer class="py-4 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">
                    Olibrary &copy; <?= date("Y") ?> | Admin Panel
                </p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>

        <!-- Auto-hide alerts after 5 seconds -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-hide alerts after 5 seconds
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);

                // Form validation for update modals
                const updateForms = document.querySelectorAll('form[id^="updateForm"]');

                updateForms.forEach(function(form) {
                    // Real-time validation
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(function(input) {
                        input.addEventListener('blur', function() {
                            validateField(input);
                        });

                        input.addEventListener('input', function() {
                            if (input.classList.contains('is-invalid')) {
                                validateField(input);
                            }
                        });
                    });

                    // File input validation
                    const fileInputs = form.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(function(fileInput) {
                        fileInput.addEventListener('change', function() {
                            validateFileInput(fileInput);
                        });
                    });

                    // Form submission validation
                    form.addEventListener('submit', function(e) {
                        if (!validateForm(form)) {
                            e.preventDefault();
                            return false;
                        }
                    });
                });

                // Field validation function
                function validateField(field) {
                    const value = field.value.trim();
                    let isValid = true;
                    let errorMessage = '';

                    // Remove existing validation classes
                    field.classList.remove('is-valid', 'is-invalid');

                    // Required field validation
                    if (field.hasAttribute('required') && !value) {
                        isValid = false;
                        errorMessage = 'This field is required.';
                    }

                    // Text field validation
                    if (field.type === 'text' && value) {
                        if (field.hasAttribute('minlength') && value.length < parseInt(field.getAttribute('minlength'))) {
                            isValid = false;
                            errorMessage = `Minimum ${field.getAttribute('minlength')} characters required.`;
                        }
                        if (field.hasAttribute('maxlength') && value.length > parseInt(field.getAttribute('maxlength'))) {
                            isValid = false;
                            errorMessage = `Maximum ${field.getAttribute('maxlength')} characters allowed.`;
                        }
                    }

                    // Date validation
                    if (field.type === 'date' && value) {
                        const selectedDate = new Date(value);
                        const today = new Date();

                        if (selectedDate > today) {
                            isValid = false;
                            errorMessage = 'Date cannot be in the future.';
                        }
                    }

                    // Select validation
                    if (field.tagName === 'SELECT' && field.hasAttribute('required')) {
                        if (!value || value === '') {
                            isValid = false;
                            errorMessage = 'Please select a valid option.';
                        }
                    }

                    // Apply validation result
                    if (isValid) {
                        field.classList.add('is-valid');
                    } else {
                        field.classList.add('is-invalid');
                        const feedback = field.parentNode.querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errorMessage;
                        }
                    }

                    return isValid;
                }

                // File input validation
                function validateFileInput(fileInput) {
                    const file = fileInput.files[0];
                    let isValid = true;
                    let errorMessage = '';

                    fileInput.classList.remove('is-valid', 'is-invalid');

                    if (file) {
                        // File type validation
                        const allowedTypes = ['image/jpeg', 'image/png'];
                        if (!allowedTypes.includes(file.type)) {
                            isValid = false;
                            errorMessage = 'Only JPEG and PNG files are allowed.';
                        }

                        // File size validation (1MB = 1024 * 1024 bytes)
                        const maxSize = 1024 * 1024;
                        if (file.size > maxSize) {
                            isValid = false;
                            errorMessage = 'File size must be less than 1MB.';
                        }
                    }

                    // Apply validation result
                    if (isValid) {
                        fileInput.classList.add('is-valid');
                    } else {
                        fileInput.classList.add('is-invalid');
                        const feedback = fileInput.parentNode.querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errorMessage;
                        }
                    }

                    return isValid;
                }

                // Form validation function
                function validateForm(form) {
                    let isValid = true;
                    const inputs = form.querySelectorAll('input, select');

                    inputs.forEach(function(input) {
                        if (!validateField(input)) {
                            isValid = false;
                        }
                    });

                    // Validate file inputs
                    const fileInputs = form.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(function(fileInput) {
                        if (fileInput.files.length > 0 && !validateFileInput(fileInput)) {
                            isValid = false;
                        }
                    });

                    // Show validation summary if form is invalid
                    if (!isValid) {
                        const firstInvalidField = form.querySelector('.is-invalid');
                        if (firstInvalidField) {
                            firstInvalidField.focus();
                        }

                        // Show alert
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                        alertDiv.innerHTML = `
                        <i class="mdi mdi-alert-circle me-2"></i>
                        Please correct the errors in the form before submitting.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                        const modalBody = form.closest('.modal-body');
                        modalBody.insertBefore(alertDiv, modalBody.firstChild);

                        // Auto-remove alert after 5 seconds
                        setTimeout(() => {
                            if (alertDiv.parentNode) {
                                alertDiv.remove();
                            }
                        }, 5000);
                    }

                    return isValid;
                }

                // Bootstrap validation for add item form
                (function() {
                    var form = document.getElementById('addItemForm');
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                })();
            });
        </script>
    </body>

    </html>
<?php
else :
    header('location: ../index.php');
endif;
?>