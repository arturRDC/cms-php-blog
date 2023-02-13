<?php
include 'includes/header.php';
ob_start();
?>


<?php
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
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
}

if (isset($_POST['save_user'])) {
    $userId = $_GET['id'];
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];
    $inputFirstName = $_POST['first_name'];
    $inputLastName = $_POST['last_name'];
    $inputEmail = $_POST['email'];
    $inputRole = $_POST['role'];

    // Sanitize inputs
    $inputUsername = mysqli_real_escape_string($dbConnection, $inputUsername);
    $inputPassword = mysqli_real_escape_string($dbConnection, $$inputPassword);
    $inputFirstName = mysqli_real_escape_string($dbConnection, $inputFirstName);
    $inputLastName = mysqli_real_escape_string($dbConnection, $inputLastName);
    $inputEmail = mysqli_real_escape_string($dbConnection, $inputEmail);
    $inputRole = mysqli_real_escape_string($dbConnection, $inputRole);

    $userImageNew = $_FILES['image']['name'];

    if ($userImageNew) {
        $userLocalImage = $_FILES['image']['tmp_name'];
        move_uploaded_file($userLocalImage, "../images/$userImageNew");
    } else {
        $userImageNew = $userImage;
    }

    $Hformat = '$2y$10$';

    // $saltQuery = "SELECT * FROM users WHERE id={$userId}";
    // $saltQueryResult = mysqli_query($dbConnection, $saltQuery);
    // while ($dbRow = mysqli_fetch_assoc($saltQueryResult)) {
    //     $userRandomSalt = $dbRow['random_salt'];
    // }
    $hashedPassword = crypt($inputPassword, $Hformat . $userRandomSalt);

    if ($inputPassword == '') {
        $hashedPassword = $userPassword;
    }



    $saveUserQuery = "UPDATE users SET username = '{$inputUsername}', password='{$hashedPassword}',first_name='{$inputFirstName}',last_name='{$inputLastName}',email='{$inputEmail}', role='{$inputRole}', picture='{$userImageNew}' WHERE id = {$userId}";
    $saveUserQueryResult = mysqli_query($dbConnection, $saveUserQuery);

    if (!$saveUserQueryResult) {
        echo 'Failed to save user' . mysqli_error($dbConnection);
        sleep(3);
    }
    header('Location: users.php');
}

?>



<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include 'includes/navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administrator Dashboard
                            <small>Edit User</small>
                        </h1>


                        <form action="" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                            <div class="row">
                                <div class="form-group col-xs-5 col-lg-5">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $userEmail ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-5 col-lg-5">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $userUsername ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-5 col-lg-5">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role">
                                    <?php
                                    echo "<option value='{$userRole}'>" . ucfirst($userRole) . "</option>";
                                    if ($userRole == "admin") {
                                        echo "<option value='user'>User</option>";
                                    } else {
                                        echo "<option value='admin'>Admin</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-5 col-lg-5">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $userFirstName ?>">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-xs-5 col-lg-5">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $userLastName ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="save_user" value="Save User">
                            </div>


                        </form>
                    </div>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'includes/footer.php';
    ?>