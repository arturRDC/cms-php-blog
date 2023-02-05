<?php
include 'includes/header.php';


if (isset($_GET['edit'])) {
    $editedPostId = $_GET['edit'];

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


    // $addPostQuery = "INSERT INTO posts(id, category_id, tags, author, title, date, image, content, status, comment_amount) VALUES ('','{$categoryId}','{$postTags}','{$postAuthor}','{$postTitle}',now(), '{$postImage}' ,'{$postContent}','{$postStatus}',{$postCommentAmount})";
    // echo $addPostQuery;

    // $addPostQueryResult = mysqli_query($dbConnection, $addPostQuery);

    // if (!$addPostQueryResult) {
    //     echo 'failed to add post' . mysqli_error($dbConnection);
    // }
    // header('Location: posts.php');
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input value="<?php echo $postTitle ?>" type="text" class="form-control" name="title">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="post-category" id="post-category">

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
                                <input class="btn btn-primary" type="submit" name="submit" value="Publish">
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