<?php
include 'includes/header.php';
ob_start();

if (isset($_GET['id'])) {
    $editedPostId = $_GET['id'];

    $postQuery = "SELECT * FROM posts WHERE id = {$editedPostId}";
    $editPostQueryResult = mysqli_query($dbConnection, $postQuery);


    while ($dbRow = mysqli_fetch_assoc($editPostQueryResult)) {

        $postTitle = $dbRow['title'];
        $postCategoryId = $dbRow['category_id'];
        $postTags = $dbRow['tags'];
        $postStatus = $dbRow['status'];
        $postContent = $dbRow['content'];
        $postAuthor = $dbRow['author'];

        $postImage = $dbRow['image'];


        $postCommentAmount = $dbRow['comment_amount'];
    }
}

if (isset($_POST['save'])) {
    $postTitle = $_POST['title'];
    $postCategoryId = $_POST['post_category'];
    $postTags = $_POST['tags'];
    $postStatus = $_POST['status'];
    $postContent = $_POST['content'];
    $postAuthor = $_POST['author'];
    $postImageNew = $_FILES['image']['name'];
    $postId = $_GET['id'];

    if ($postImageNew) {
        $postLocalImage = $_FILES['image']['tmp_name'];
        move_uploaded_file($postLocalImage, "../images/$postImageNew");
    } else {
        $postImageNew = $postImage;
    }

    $editPostQuery = "UPDATE posts SET category_id = {$postCategoryId}, tags = '{$postTags}', author = '{$postAuthor}', title = '{$postTitle}', image = '{$postImageNew}', content = '{$postContent}', status = '{$postStatus}' WHERE id = {$postId}";
    $editPostQueryResult = mysqli_query($dbConnection, $editPostQuery);
    if (!$editPostQueryResult) {
        echo 'Unable to edit post' . mysqli_error($dbConnection);
    }
    header('Location: posts.php');
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


                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input value="<?php echo $postTitle ?>" type="text" class="form-control" name="title">
                            </div>

                            <div class="form-group">
                                <label for="post_category">Category</label>
                                <select name="post_category" id="post_category">

                                    <?php
                                    $readCategoryQuery = 'SELECT * FROM categories';
                                    $readCategoryQueryResult = mysqli_query($dbConnection, $readCategoryQuery);
                                    if (!$readCategoryQueryResult) die("Unable to read categories" . mysqli_error($dbConnection));
                                    while ($dbRow = mysqli_fetch_assoc($readCategoryQueryResult)) {
                                        $categoryId = $dbRow['id'];
                                        $categoryName = $dbRow['name'];
                                        echo "<option value='{$categoryId}'>{$categoryName}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input value="<?php echo $postAuthor ?>" type="text" class="form-control" name="author">
                            </div>
                            <div class="form-group">
                                <label for="post-image">Image</label>
                                <img width="100" src="../images/<?php echo $postImage ?>" alt="post-image" name="post-image">
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input value="<?php echo $postTags ?>" type="text" class="form-control" name="tags">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input value="<?php echo $postStatus ?>" type="text" class="form-control" name="status">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea type="text" class="form-control" name="content" id="" cols="30" rows="10">
                                    <?php echo $postContent ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="save" value="Save">
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