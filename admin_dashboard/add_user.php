<?php
include 'includes/header.php';

if (isset($_POST['add_user'])) {
    $userUsername = $_POST['username'];
    $userPassword = $_POST['password'];
    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userEmail = $_POST['email'];
    $userRole = $_POST['role'];
    $userRandomSalt = bin2hex(openssl_random_pseudo_bytes(11));


    $addUserQuery = "INSERT INTO users(id, username, password, first_name, last_name, email, role, random_salt) VALUES ('','{$userUsername}','{$userPassword}','{$userFirstName}','{$userLastName}','{$userEmail}', '{$userRole}', '{$userRandomSalt}')";
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
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role">
                                    <option value='user'>Select Role</option>
                                    <option value='admin'>Admin</option>
                                    <option value='user'>User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name">
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