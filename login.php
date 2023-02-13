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
<link rel="stylesheet" href="css/login.css">

<?php
ob_start();
if ($_SESSION['username']) { // User already logged in
    header("Location: index.php");
}

if (isset($_POST['login'])) {
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    // Sanitize inputs
    $loginUsername = mysqli_real_escape_string($dbConnection, $loginUsername);
    $loginPassword = mysqli_real_escape_string($dbConnection, $loginPassword);

    $findUsernameQuery = "SELECT * FROM users WHERE username = '{$loginUsername}'";
    $findUsernameQueryResult = mysqli_query($dbConnection, $findUsernameQuery);

    while ($dbRow = mysqli_fetch_assoc($findUsernameQueryResult)) {
        $userUsername = $dbRow['username'];
        $userPassword = $dbRow['password'];
        $userFirstName = $dbRow['first_name'];
        $userRole = $dbRow['role'];
        $userEmail = $dbRow['email'];
        $userId = $dbRow['id'];
        $userSalt = $dbRow['random_salt'];
    }
    $Hformat = '$2y$10$';
    if (hash_equals($userPassword, crypt($loginPassword, $Hformat . $userSalt))) { // Login successful
        $_SESSION['username'] = $userUsername;
        $_SESSION['email'] = $userEmail;
        $_SESSION['id'] = $userId;
        $_SESSION['first_name'] = $userFirstName;
        $_SESSION['role'] = $userRole;

        if ($userRole === 'admin') {
            header("Location: admin_dashboard/index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<h1 class='text-center'>Login Failed</h1>";
    }
}
?>

<div class="div-container">
    <div class="content">
        <h2 class="text-center">Login</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control" id="username" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>

            <button type="button" class="btn btn-link btn-lg" onclick="location.href='signup.php'">Signup</button>
            <hr>

        </form>
    </div>
</div>
<?php include "includes/lower.php" ?>