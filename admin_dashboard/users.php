<?php
include 'includes/header.php';
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
                            <small>Users</small>
                        </h1>

                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center" colspan="4">Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userQuery = 'SELECT * FROM users';
                                $userQueryResult = mysqli_query($dbConnection, $userQuery);


                                while ($dbRow = mysqli_fetch_assoc($userQueryResult)) {
                                    $userId = $dbRow['id'];
                                    $userUsername = $dbRow['username'];
                                    $userPassword = $dbRow['password'];
                                    $userFirstName = $dbRow['first_name'];
                                    $userLastName = $dbRow['last_name'];
                                    $userEmail = $dbRow['email'];
                                    $userPicture = $dbRow['picture'];
                                    $userRole = $dbRow['role'];
                                    $userRandomSalt = $dbRow['random_salt'];

                                    echo "<tr>";
                                    echo "<td class='text-center'>{$userId}</td>";
                                    echo "<td class='text-center'>{$userUsername}</td>";
                                    echo "<td class='text-center'>{$userFirstName}</td>";
                                    echo "<td class='text-center'>{$userLastName}</td>";
                                    echo "<td class='text-center'>{$userEmail}</td>";
                                    echo "<td class='text-center'>{$userRole}</td>";



                                    echo "<td class='text-center'><a href='users.php?promote={$userId}'>Promote</td>";
                                    echo "<td class='text-center'><a href='users.php?demote={$userId}'>Demote</td>";
                                    echo "<td class='text-center'><a href='edit_user.php?id={$userId}'>Edit</td>";
                                    echo "<td class='text-center'><a href='users.php?delete={$userId}'>Delete</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                        <?php
                        // Delete user
                        if (isset($_GET['delete'])) {
                            $idDelete = escape($_GET['delete']);
                            $deleteQuery = "DELETE FROM users WHERE id = {$idDelete}";
                            $deleteQueryResult = mysqli_query($dbConnection, $deleteQuery);
                            header('Location: users.php');
                        }
                        // Approve user
                        if (isset($_GET['promote'])) {
                            $idPromote = escape($_GET['promote']);
                            $promoteQuery = "UPDATE users SET role = 'admin' WHERE id = {$idPromote}";
                            $promoteQueryResult = mysqli_query($dbConnection, $promoteQuery);
                            header('Location: users.php');
                        }
                        // Demote user
                        if (isset($_GET['demote'])) {
                            $idDemote = escape($_GET['demote']);
                            $demoteQuery = "UPDATE users SET role = 'user' WHERE id = {$idDemote}";
                            $demoteQueryResult = mysqli_query($dbConnection, $demoteQuery);
                            header('Location: users.php');
                        }
                        ?>

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