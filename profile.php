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
<link rel="stylesheet" href="css/profile.css">

<?php
if (!$_SESSION['username']) { // User not logged in
    header("Location: index.php");
}

$userId = escape($_SESSION['id']);


$userQuery = "SELECT * FROM users WHERE id={$userId}";
$userQueryResult = mysqli_query($dbConnection, $userQuery);

while ($dbRow = mysqli_fetch_assoc($userQueryResult)) {
    $userUsername = $dbRow['username'];
    $userFirstName = $dbRow['first_name'];
    $userLastName = $dbRow['last_name'];
    $userEmail = $dbRow['email'];
    $userRole = $dbRow['role'];
    $userRandomSalt = $dbRow['random_salt'];
    $userPassword = $dbRow['password'];
    $userImage = $dbRow['picture'];
}

if (isset($_POST['save'])) {
    $inputUsername = escape($_POST['username']);
    $inputPassword = escape($_POST['password']);
    $inputFirstName = escape($_POST['first_name']);
    $inputLastName = escape($_POST['last_name']);
    $inputEmail = escape($_POST['email']);



    $userImageNew = escape($_FILES['image']['name']);

    if ($userImageNew) {
        $userLocalImage = escape($_FILES['image']['tmp_name']);
        move_uploaded_file($userLocalImage, "images/$userImageNew");
    } else {
        $userImageNew = $userImage;
    }


    $userRandomSalt = bin2hex(openssl_random_pseudo_bytes(11));
    $Hformat = '$2y$10$';
    $hashedPassword = crypt($inputPassword, $Hformat . $userRandomSalt);


    if ($inputPassword == '') {
        $hashedPassword = $userPassword;
    }
    $saveProfileQuery = "UPDATE users SET username = '{$inputUsername}', password='{$hashedPassword}',first_name='{$inputFirstName}',last_name='{$inputLastName}',email='{$inputEmail}', picture='{$userImageNew}' WHERE id = {$userId}";
    $saveProfileQueryResult = mysqli_query($dbConnection, $saveProfileQuery);
    header("Location: index.php");
}
?>

<div class="div-container">
    <div class="content">
        <h2 class="text-center">Profile</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image</label>
                <br>
                <img width="64" src="images/<?php echo $userImage ?>" alt="profile image">
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $userEmail ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" name="username" value="<?php echo $userUsername ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" name="first_name" value="<?php echo $userFirstName ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" name="last_name" value="<?php echo $userLastName ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-lg" name="save">Save</button>


        </form>
    </div>
</div>
<?php include "includes/lower.php" ?>