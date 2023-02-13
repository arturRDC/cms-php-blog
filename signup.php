<?php
include 'includes/header.php';
?>
<?php
include 'includes/db.php';
?>

<!-- Navigation -->
<?php
include 'includes/navbar.php';
?>
<link rel="stylesheet" href="css/signup.css">

<?php
ob_start();
if ($_SESSION['username']) { // User already logged in
    header("Location: index.php");
}
if (isset($_POST['signup'])) {
    $userUsername = $_POST['username'];
    $userPassword = $_POST['password'];
    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userEmail = $_POST['email'];

    // Sanitize inputs
    $userUsername = mysqli_real_escape_string($dbConnection, $userUsername);
    $userPassword = mysqli_real_escape_string($dbConnection, $userPassword);
    $userFirstName = mysqli_real_escape_string($dbConnection, $userFirstName);
    $userLastName = mysqli_real_escape_string($dbConnection, $userLastName);
    $userEmail = mysqli_real_escape_string($dbConnection, $userEmail);



    $userRandomSalt = bin2hex(openssl_random_pseudo_bytes(11));
    $Hformat = '$2y$10$';
    $hashedPassword = crypt($userPassword, $Hformat . $userRandomSalt);

    $signupQuery = "INSERT INTO users(email, username, password, first_name, last_name, role, random_salt) VALUES ('{$userEmail}', '{$userUsername}', '{$hashedPassword}', '{$userFirstName}', '{$userLastName}', 'user', '{$userRandomSalt}')";
    $signupQueryResult = mysqli_query($dbConnection, $signupQuery);
    header("Location: index.php");
}
?>

<div class="div-container">
    <div class="content">
        <h2 class="text-center">Signup</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <hr>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" name="last_name">
            </div>
            <button type="submit" class="btn btn-primary btn-lg" name="signup">Register</button>

            <hr>

        </form>
    </div>
</div>