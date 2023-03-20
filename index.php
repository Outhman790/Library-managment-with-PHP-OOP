<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
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
        <style>
            #intro {
                background-image: url("img/gabriel-sollmann-Y7d265_7i08-unsplash.jpg");
                height: 70vh;
            }

            .navbar .nav-link {
                color: #fff !important;
            }
        </style>

        <!--Navbar-->
        <nav id="nav" class="navbar navbar-expand-md d-flex justify-content-between bg-dark">
            <div class="container-md nav-position">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <a class="navbar-brand text-light fs-3 d-none d-md-block" href="homepage.php">Navbar</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                    </ul>
                </div>

                <div class="justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- diplay nav to connect -->
                        <?php if (isset($_SESSION['Nickname']) && $_SESSION['Nickname']) { ?>
                            <button type="button" class="btn btn-light">
                                <a href="./includes/logout.inc.php">Logout</a>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#sign-in-up">
                                Connect
                            </button>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
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
                                    <form action="./includes/login.inc.php" class="login" method="POST">
                                        <div class="field">
                                            <input type="text" name="nickName" placeholder="Nickname" required />
                                        </div>
                                        <div class="field">
                                            <input type="password" name="password" placeholder="Password" required />
                                        </div>
                                        <div class="pass-link">
                                            <a href="#">Forgot password?</a>
                                        </div>
                                        <div class="field btn p-0">
                                            <div class="btn-layer"></div>
                                            <input type="submit" name="login" value="Login" />
                                        </div>
                                        <div class="signup-link">
                                            Not a member? <a href="">Signup now</a>
                                        </div>
                                    </form>

                                    <form action="./includes/signup.inc.php" class="signup" method="POST">
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
                                            <input type="password" name="repeatPassword" placeholder="Confirm password" required />
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
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.8)">
                <div class="container d-flex align-items-center justify-content-center text-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3">10K+ STUDENTS TRUST US</h1>
                        <h5 class="mb-4">
                            Our goal is to make free education resources available for
                            everyone
                        </h5>
                        <a class="btn btn-outline-light btn-lg m-2" href="allItems.php" role="button" rel="nofollow">Take a reservation</a>
                        <a class="btn btn-outline-light btn-lg m-2" href="https://mdbootstrap.com/docs/standard/" target="_blank" role="button">About us</a>
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
            <section>
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
                        <h4><strong>Facilis consequatur eligendi</strong></h4>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis
                            consequatur eligendi quisquam doloremque vero ex debitis
                            veritatis placeat unde animi laborum sapiente illo possimus,
                            commodi dignissimos obcaecati illum maiores corporis.
                        </p>
                        <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            itaque voluptate nesciunt laborum incidunt. Officia, quam
                            consectetur. Earum eligendi aliquam illum alias, unde optio
                            accusantium soluta, iusto molestiae adipisci et?
                        </p>
                    </div>
                </div>
            </section>
            <!--Section: Content-->

            <hr class="my-5" />

            <!--Section: Content-->
            <section class="text-center">
                <h4 class="mb-5"><strong>You migh like</strong></h4>

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
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                                <a href="#!" class="btn btn-primary">Button</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="img/design-for-writers-book-cover-tf-2-a-million-to-one.jpg" class="img-fluid-custom" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                                <a href="#!" class="btn btn-primary">Button</a>
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
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                                <a href="#!" class="btn btn-primary">Button</a>
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
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                                <a href="#!" class="btn btn-primary">Button</a>
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
    <footer class="bg-light text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2023 Copyright:
            <a class="text-dark" href="index.php">Olibrary.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- The Modal -->
    <div id="loginError" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Test</p>
        </div>

    </div>

    <!--Footer-->
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>