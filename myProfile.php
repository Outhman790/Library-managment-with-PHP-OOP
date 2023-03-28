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
            <a class="navbar-brand" href="#">Olibrary</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Homepage</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-secondary text-white" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['Nickname'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">My profile</a>
                            <a class="dropdown-item" href="allItems.php">All items</a>
                            <a class="dropdown-item" href="my_reservations.php">My reservations</a>
                            <a class="dropdown-item" href="my_borrowings.php">My borrowings</a>
                            <a class="dropdown-item" href="./includes/logout.inc.php">Logout</a>
                        </div>
                    </li>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
<?php
else :
    header('location: ../index.php');
endif;
?>