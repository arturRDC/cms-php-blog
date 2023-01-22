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
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php
                            // Create categories
                            if (isset($_POST['submit'])) {
                                echo '<br>';
                                $categoryName = $_POST['category-name'];
                                if ($categoryName == '' || empty($categoryName)) {
                                    echo 'Please enter a name for the category';
                                } else {
                                    $addCategoryQuery = "INSERT INTO categories(name) VALUE('{$categoryName}')";
                                    $addCategoryQueryResult = mysqli_query($dbConnection, $addCategoryQuery);
                                    if (!$addCategoryQueryResult) {
                                        die('Unable to add category to database') . mysqli_error($dbConnection);
                                    }
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category-name">Category Name: </label>
                                    <input class="form-control" type="text" name="category-name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Create category">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">

                            <?php
                            // Read categories
                            $createCategoryQuery = 'SELECT * FROM categories';
                            $createCategoryQueryResult = mysqli_query($dbConnection, $createCategoryQuery);
                            ?>

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category name</th>
                                    </tr>
                                <tbody>
                                    <?php
                                    while ($dbRow = mysqli_fetch_assoc($createCategoryQueryResult)) {
                                        echo '<tr>';
                                        $categoryId = $dbRow['id'];
                                        $categoryName = $dbRow['name'];

                                        echo "<th>{$categoryId}</th>";
                                        echo "<th>{$categoryName}</th>";
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                                </thead>
                            </table>
                        </div>


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