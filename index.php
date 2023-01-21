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

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            $postQuery = 'SELECT * FROM posts';
            $postQueryResult = mysqli_query($dbConnection, $postQuery);


            while ($dbRow = mysqli_fetch_assoc($postQueryResult)) {
                $postTags = $dbRow['tags'];
                $postAuthor = $dbRow['author'];
                $postTitle = $dbRow['title'];
                $postDate = $dbRow['date'];
                $postContent = $dbRow['content'];
                $postImage = $dbRow['image'];
                $postCommentAmount = $dbRow['comment_amount'];
            ?>
                <h2>
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"> <?php echo $postAuthor ?> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="https://via.placeholder.com/900x300" alt="">
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

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>