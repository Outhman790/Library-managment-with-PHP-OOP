<?php
require_once 'classes/myProfile.php';
session_start();

if (isset($_SESSION['Nickname'])) :
    $profileObj = new profile();
    $profile = $profileObj->getInfo($_SESSION['Nickname']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>

    <body>
        <!-- Navigation-->
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
        <div class="container mt-5">
            <h1>User Profile</h1>

            <form method="post" action="includes/update_profile.php">
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" class="form-control" id="nickname" name="nickname"
                        value="<?php echo $profile['Nickname'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password"
                        value="<?php echo $profile['Password'] ?>">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo $profile['Address'] ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $profile['Email'] ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" number"
                        value="<?php echo $profile['Phone'] ?>">
                </div>

                <div class="form-group">
                    <label for="cin">CIN:</label>
                    <input type="text" class="form-control" id="cin" name="cin" value="<?php echo $profile['CIN'] ?>">
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter occupation"
                        value="<?php echo $profile['Occupation'] ?>">
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="<?php echo $profile['Birth_Date'] ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
            </form>

        </div>
        <!-- Update Profile Modal -->
        <div class="modal fade" id="profileUpdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="updateTitle">Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="updateMessage" class="mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Update Profile Modal -->

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../index.php');
endif;
?>