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

                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $postQuery = 'SELECT * FROM posts';
                                $postQueryResult = mysqli_query($dbConnection, $postQuery);


                                while ($dbRow = mysqli_fetch_assoc($postQueryResult)) {
                                    $postTitle = $dbRow['title'];
                                    $postId = $dbRow['id'];
                                    $postTags = $dbRow['tags'];
                                    $postAuthor = $dbRow['author'];
                                    $postDate = $dbRow['date'];
                                    $postImage = $dbRow['image'];
                                    $postStatus = $dbRow['status'];
                                    $postCategory = $dbRow['category_id'];
                                    $postCommentAmount = $dbRow['comment_amount'];

                                    echo "<tr>";
                                    echo "<td>$postId</td>";
                                    echo "<td>$postTitle</td>";
                                    echo "<td>$postAuthor</td>";
                                    echo "<td>$postTags</td>";
                                    echo "<td>$postDate</td>";
                                    echo "<td>$postStatus</td>";
                                    // Read category
                                    $readCategoryQuery = "SELECT * FROM categories WHERE id = {$postCategory}";
                                    $readCategoryQueryResult = mysqli_query($dbConnection, $readCategoryQuery);

                                    while ($dbRow = mysqli_fetch_assoc($readCategoryQueryResult)) {
                                        $categoryName = $dbRow['name'];

                                        echo "<td>$categoryName</td>";
                                    }
                                    echo "<td><img width='100' src='../images/$postImage' alt='image'></td>";
                                    echo "<td>$postCommentAmount</td>";
                                    echo "<td><a href='edit_post.php?id={$postId}'>Edit</td>";
                                    echo "<td><a href='posts.php?delete={$postId}'>Delete</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        // Delete category
                        if (isset($_GET['delete'])) {
                            $idDelete = $_GET['delete'];
                            $deleteQuery = "DELETE FROM posts WHERE id = {$idDelete}";
                            $deleteResult = mysqli_query($dbConnection, $deleteQuery);
                            header('Location: posts.php');
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