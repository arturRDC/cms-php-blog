<?php
include 'includes/header.php';

if (isset($_POST['add_user'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];
    $inputFirstName = $_POST['first_name'];
    $inputLastName = $_POST['last_name'];
    $inputEmail = $_POST['email'];
    $inputRole = $_POST['role'];

    // Sanitize inputs
    $userUsername = mysqli_real_escape_string($dbConnection, $inputUsername);
    $userPassword = mysqli_real_escape_string($dbConnection, $$inputPassword);
    $userFirstName = mysqli_real_escape_string($dbConnection, $inputFirstName);
    $userLastName = mysqli_real_escape_string($dbConnection, $inputLastName);
    $userEmail = mysqli_real_escape_string($dbConnection, $inputEmail);
    $userRole = mysqli_real_escape_string($dbConnection, $inputRole);




    $userRandomSalt = bin2hex(openssl_random_pseudo_bytes(11));
    $Hformat = '$2y$10$';
    $hashedPassword = crypt($userPassword, $Hformat . $userRandomSalt);


    $userImage = $_FILES['image']['name'];
    $userLocalImage = $_FILES['image']['tmp_name'];
    move_uploaded_file($userLocalImage, "../images/$userImage");


    $addUserQuery = "INSERT INTO users(id, username, password, first_name, last_name, email, role, picture, random_salt) VALUES ('','{$userUsername}','{$hashedPassword}','{$userFirstName}','{$userLastName}','{$userEmail}', '{$userRole}', '{$userImage}', '{$userRandomSalt}')";
    $addUserQueryResult = mysqli_query($dbConnection, $addUserQuery);

    if (!$addUserQueryResult) {
        echo 'failed to add user' . mysqli_error($dbConnection);
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
                            <small>Subheading</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group  col-xs-5 col-lg-5">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-xs-5 col-lg-5">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-xs-5 col-lg-5">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <label for="role">Role</label>
                            <select name="role" id="role">
                                <option value='user'>Select Role</option>
                                <option value='admin'>Admin</option>
                                <option value='user'>User</option>
                            </select>
                            <div class="row">
                                <div class="form-group  col-xs-5 col-lg-5">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-xs-5 col-lg-5">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
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