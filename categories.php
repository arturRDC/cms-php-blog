<?php
include 'includes/header.php';
?>
<?php
include 'includes/db.php';
?>

<!-- Navigation -->
<?php
include 'includes/navbar.php';
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['id'])) {
                $categoryId = $_GET['id'];
            }
            $categoryNameQuery = "SELECT * FROM categories WHERE id = $categoryId";
            $categoryNameQueryResult = mysqli_query($dbConnection, $categoryNameQuery);
            while ($dbRow = mysqli_fetch_assoc($categoryNameQueryResult)) {
                $categoryName = $dbRow['name'];
            }
            ?>
            <h1 class="page-header">
                Categories
                <small><?php echo $categoryName ?> posts</small>
            </h1>

            <!-- First Blog Post -->
            <?php

            $postQuery = "SELECT * FROM posts WHERE category_id = {$categoryId} AND status = 'published'";
            $postQueryResult = mysqli_query($dbConnection, $postQuery);


            while ($dbRow = mysqli_fetch_assoc($postQueryResult)) {
                $postId = $dbRow['id'];
                $postTags = $dbRow['tags'];
                $postAuthor = $dbRow['author'];
                $postTitle = $dbRow['title'];
                $postDate = $dbRow['date'];
                $postContent = substr($dbRow['content'], 0, 150);
                $postImage = $dbRow['image'];
                $postCommentAmount = $dbRow['comment_amount'];
            ?>
                <h2>
                    <?php echo "<a href='post.php?id={$postId}'>{$postTitle}</a>" ?>
                </h2>
                <p class="lead">
                    by <a href="index.php"> <?php echo $postAuthor ?> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $dbRow['image']; ?>" alt="">
                <hr>
                <p><?php echo $postContent ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php
            }
            ?>

            <hr>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include 'includes/sidebar_widgets.php';
        ?>
    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->
    <?php
    include 'includes/footer.php';
    ?>

</div>
<!-- /.container -->
<?php include "includes/lower.php" ?>