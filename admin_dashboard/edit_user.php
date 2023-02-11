<?php
include 'includes/header.php';


if (isset($_POST['save_user'])) {
    $userId = $_GET['id'];
    $userUsername = $_POST['username'];
    $userPassword = $_POST['password'];
    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userEmail = $_POST['email'];
    $userRole = $_POST['role'];




    $saveUserQuery = "UPDATE users SET username = '{$userUsername}', password='{$userPassword}',first_name='{$userFirstName}',last_name='{$userLastName}',email='{$userEmail}', role='{$userRole}' WHERE id = {$userId}";
    echo $saveUserQuery;
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
                            <small>Subheading</small>
                        </h1>
                        <?php
                        if (isset($_GET['id'])) {
                            $userId = $_GET['id'];
                            $userQuery = "SELECT * FROM users WHERE id={$userId}";
                            $userQueryResult = mysqli_query($dbConnection, $userQuery);

                            while ($dbRow = mysqli_fetch_assoc($userQueryResult)) {
                                $userUsername = $dbRow['username'];
                                $userPassword = $dbRow['password'];
                                $userFirstName = $dbRow['first_name'];
                                $userLastName = $dbRow['last_name'];
                                $userEmail = $dbRow['email'];
                                $userRole = $dbRow['role'];
                            }
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $userEmail ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $userUsername ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $userPassword ?>">
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
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="<?php echo $userFirstName ?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="<?php echo $userLastName ?>">
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