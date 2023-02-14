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
                            <small>Posts</small>
                        </h1>

                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Author</th>
                                    <th class="text-center">Tags</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Comments</th>
                                    <th class="text-center" colspan="4">Control</th>
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
                                    echo "<td class='text-center'>$postTitle</td>";
                                    echo "<td class='text-center'>$postAuthor</td>";
                                    echo "<td class='text-center'>$postTags</td>";
                                    echo "<td class='text-center'>$postDate</td>";
                                    echo "<td class='text-center'>$postStatus</td>";
                                    // Read category
                                    $readCategoryQuery = "SELECT * FROM categories WHERE id = {$postCategory}";
                                    $readCategoryQueryResult = mysqli_query($dbConnection, $readCategoryQuery);

                                    while ($dbRow = mysqli_fetch_assoc($readCategoryQueryResult)) {
                                        $categoryName = $dbRow['name'];

                                        echo "<td>$categoryName</td>";
                                    }
                                    echo "<td><img width='100' src='../images/$postImage' alt='image'></td>";
                                    echo "<td class='text-center'>$postCommentAmount</td>";
                                    echo "<td><a href='edit_post.php?id={$postId}'>Edit</td>";
                                    echo "<td><a href='posts.php?delete={$postId}'>Delete</td>";
                                    echo "<td><a href='posts.php?publish={$postId}'>Publish</td>";
                                    echo "<td><a href='posts.php?unpublish={$postId}'>Unpublish</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        // Delete post
                        if (isset($_GET['delete'])) {
                            $idDelete = escape($_GET['delete']);
                            $deleteQuery = "DELETE FROM posts WHERE id = {$idDelete}";
                            $deleteResult = mysqli_query($dbConnection, $deleteQuery);
                            header('Location: posts.php');
                        }
                        // Publish post
                        if (isset($_GET['publish'])) {
                            $idPublish = escape($_GET['publish']);
                            $publishQuery = "UPDATE posts SET status = 'published', date = now() WHERE id = {$idPublish}";
                            $publishResult = mysqli_query($dbConnection, $publishQuery);
                            header('Location: posts.php');
                        }
                        // Unpublish post
                        if (isset($_GET['unpublish'])) {
                            $idUnpublish = escape($_GET['unpublish']);
                            $unpublishQuery = "UPDATE posts SET status = 'draft' WHERE id = {$idUnpublish}";
                            $unpublishResult = mysqli_query($dbConnection, $unpublishQuery);
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