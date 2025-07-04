<?php
session_start();
require_once 'functions/check_account.func.php';
if (isset($_SESSION['Nickname'])) {
    checkAccount($_SESSION['Penalty_Count']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Homepage</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!--Navbar-->
        <?php if (isset($_SESSION['Nickname']) && $_SESSION['Nickname']) { ?>
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
        <?php } else { ?>
            <nav id="nav" class="navbar navbar-expand-md bg-dark">
                <div class="container-md d-flex justify-content-between align-items-center">
                    <a class="navbar-brand" href="index.php">
                        <img src="img/Olibrary_logo_white.png" alt="Library logo" style="height: 40px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex align-items-center ms-auto" id="navbarNav">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#sign-in-up">
                            Connect
                        </button>
                    </div>
                </div>
            </nav>
        <?php } ?>
        <!-- Navbar -->
        <!-- Sign up and Sign in Modal -->
        <div class="modal fade" id="sign-in-up" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="wrapper">
                            <div class="title-text">
                                <div class="title login">Login Form</div>
                                <div class="title signup">Signup Form</div>
                            </div>
                            <div class="form-container">
                                <div class="slide-controls">
                                    <input type="radio" name="slide" id="login" checked />
                                    <input type="radio" name="slide" id="signup" />
                                    <label for="login" class="slide login">Login</label>
                                    <label for="signup" class="slide signup">Signup</label>
                                    <div class="slider-tab"></div>
                                </div>
                                <div class="form-inner">
                                    <form id="loginForm" action="./includes/login.inc.php" class="login" method="POST">
                                        <div class="field">
                                            <input type="text" name="nickName" placeholder="Nickname" required />
                                        </div>
                                        <div class="field">
                                            <input type="password" name="password" placeholder="Password" required />
                                        </div>

                                        <div class="field btn p-0">
                                            <div class="btn-layer"></div>
                                            <input type="submit" name="login" value="Login" />
                                        </div>
                                        <div class="signup-link">
                                            Not a member? <a href="">Signup now</a>
                                        </div>
                                    </form>

                                    <form id="signupForm" action="./includes/signup.inc.php" class="signup"
                                        method="POST">
                                        <div class="field">
                                            <input type="text" name="nickName" placeholder="Nickname" required />
                                        </div>
                                        <div class="field">
                                            <input type="text" name="email" placeholder="Email Address" required />
                                        </div>
                                        <div class="field">
                                            <input type="text" name="CIN" placeholder="CIN" required />
                                        </div>
                                        <div class="field">
                                            <input type="text" name="adress" placeholder="adress" required />
                                        </div>
                                        <div class="field">
                                            <select name="occupation" id="occupation-register">
                                                <option value="fonctionnaire">Fonctionnaire</option>
                                                <option value="femme de foyer">Femme de foyer</option>
                                                <option value="etudiant(e)">etudiant(e)</option>
                                            </select>
                                        </div>
                                        <div class="field">
                                            <input type="date" name="birthDate" placeholder="birthDate" required />
                                        </div>
                                        <div class="field">
                                            <input type="password" name="password" placeholder="Password" required />
                                        </div>
                                        <div class="field">
                                            <input type="password" name="repeatPassword" placeholder="Confirm password"
                                                required />
                                        </div>
                                        <div class="field">
                                            <input type="number" name="phone" placeholder="Phone" required />
                                        </div>
                                        <div class="field btn p-0">
                                            <div class="btn-layer"></div>
                                            <input type="submit" name="signUp" value="Signup" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->
        <!-- Background image -->
        <div id="intro" class="bg-image shadow-2-strong d-flex align-items-center justify-content-center text-center"
            style="background-image: url('img/gabriel-sollmann-Y7d265_7i08-unsplash.jpg'); height: 70vh; background-size: cover; background-position: center;">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.8)">
                <div class="container d-flex align-items-center justify-content-center text-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3">10K+ STUDENTS TRUST US</h1>
                        <h5 class="mb-4">
                            Our goal is to make free education resources available for
                            everyone
                        </h5>
                        <a class="btn btn-outline-light btn-lg m-2" href="allItems.php" role="button"
                            rel="nofollow">Take a reservation</a>
                        <a class="btn btn-outline-light btn-lg m-2" href="#why-use-olibrary" role="button">About us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5">
        <div class="container">
            <!--Section: Content-->
            <section id="why-use-olibrary" class="pt-5">
                <div class="row">
                    <div class="col-md-6 gx-5 mb-4">
                        <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">
                            <img src="https://mdbootstrap.com/img/new/slides/031.jpg" class="img-fluid" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 gx-5 mb-4">
                        <h4><strong>Why use Olibrary?</strong></h4>
                        <p class="text-muted">
                            Browse thousands of titles and manage your reservations from anywhere. Reserve your next
                            book online and pick it up within 24 hours.
                        </p>
                        <p><strong>Looking for your next read?</strong></p>
                        <p class="text-muted">
                            Use our search and filter tools to explore new titles. You can borrow up to three items at a
                            time and keep them for 15 days.
                        </p>
                    </div>
                </div>
            </section>
            <!--Section: Content-->

            <hr class="my-5" />

            <!--Section: Content-->
            <section class="text-center">
                <h4 class="mb-5"><strong>You might like</strong></h4>

                <div class="row">
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="img/compound-effect-600x900.png" class="img-fluid-custom" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">The Compound Effect</h5>
                                <p class="card-text">
                                    Learn how small actions build success with this motivational read.
                                </p>
                                <a href="allItems.php" class="btn btn-primary">Reserve</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="img/design-for-writers-book-cover-tf-2-a-million-to-one.jpg"
                                    class="img-fluid-custom" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">A Million to One</h5>
                                <p class="card-text">
                                    An inspiring story of perseverance and creativity.
                                </p>
                                <a href="allItems.php" class="btn btn-primary">Reserve</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="img/0735211299.01._SCLZZZZZZZ_SX500_.jpg" class="img-fluid-custom" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Atomic Habits</h5>
                                <p class="card-text">
                                    James Clear's guide to building good habits that last.
                                </p>
                                <a href="allItems.php" class="btn btn-primary">Reserve</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="img/RichDad_PoorDad.webp" class="img-fluid-custom" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Rich Dad Poor Dad</h5>
                                <p class="card-text">
                                    Understand personal finance through this classic bestseller.
                                </p>
                                <a href="allItems.php" class="btn btn-primary">Reserve</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section: Content-->

            <hr class="my-5" />
        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="text-center mt-auto py-3 bg-dark">
        <p class="mb-0 text-white-50">Olibrary &copy; <?= date("Y") ?> </p>
    </footer>
    <!-- Error Modal -->
    <div class="modal fade" id="loginError" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="errorMessage" class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="signupSuccess" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-success">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="successMessage" class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
</body>

</html>