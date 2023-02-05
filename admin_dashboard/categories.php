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
                                    <input class="btn btn-primary" type="submit" name="submit" value="Create">
                                </div>
                            </form>

                            <?php
                            if (isset($_GET['edit'])) {
                                $categoryId = $_GET['edit'];
                                include '__DIR__' . '/../includes/edit_categories.php';
                            }
                            ?>

                        </div>
                        <div class="col-xs-6">



                            <?php
                            // Read categories
                            $readCategoryQuery = 'SELECT * FROM categories';
                            $readCategoryQueryResult = mysqli_query($dbConnection, $readCategoryQuery);

                            ?>

                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th class='text-center'>Id</th>
                                        <th class='text-center'>Category Name</th>

                                    </tr>
                                <tbody>
                                    <?php
                                    while ($dbRow = mysqli_fetch_assoc($readCategoryQueryResult)) {
                                        echo '<tr>';
                                        $categoryId = $dbRow['id'];
                                        $categoryName = $dbRow['name'];

                                        echo "<td class='text-center'>{$categoryId}</td>";
                                        echo "<td class='text-center'>{$categoryName}</td>";
                                        echo "<td class='text-center'><a href='categories.php?delete={$categoryId}'>Delete </a><a href='categories.php?edit={$categoryId}'>  Edit</a></td>";
                                        echo '</tr>';
                                    }
                                    ?>

                                    <?php
                                    if (isset($_GET['delete'])) {
                                        $categoryId = $_GET['delete'];
                                        $deleteCategoryQuery = "DELETE FROM categories WHERE id = {$categoryId}";
                                        $deleteCategoryQueryResult =  mysqli_query($dbConnection, $deleteCategoryQuery);

                                        if (!$deleteCategoryQueryResult) {
                                            echo 'Error: unable to delete category' . mysqli_error($dbConnection);
                                        }
                                        header('Location: categories.php');
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