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

                <?php
                // header('Location: /../post.php');
                // echo 'Location: \..\index.php';
                // header('Location: ..\index.php');
                ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administrator Dashboard
                            <br>
                            <small><?php echo "Welcome, " . $_SESSION['first_name'] ?></small>
                        </h1>


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