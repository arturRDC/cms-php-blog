<?php
include 'includes/header.php';

if (isset($_POST['submit'])) {
    $postTitle = escape($_POST['title']);
    $categoryId = escape($_POST['post_category']);
    $postTags = escape($_POST['tags']);
    $postStatus = escape($_POST['status']);
    $postContent = escape($_POST['content']);
    $postAuthor = escape($_POST['author']);


    $postImage = escape($_FILES['image']['name']);
    $postLocalImage = escape($_FILES['image']['tmp_name']);


    $postDate = date('y-m-d');
    $postCommentAmount = 0;

    move_uploaded_file($postLocalImage, "../images/$postImage");

    $addPostQuery = "INSERT INTO posts(id, category_id, tags, author, title, date, image, content, status, comment_amount) VALUES ('','{$categoryId}','{$postTags}','{$postAuthor}','{$postTitle}',now(), '{$postImage}' ,'{$postContent}','{$postStatus}',{$postCommentAmount})";

    $addPostQueryResult = mysqli_query($dbConnection, $addPostQuery);

    if (!$addPostQueryResult) {
        echo 'failed to add post' . mysqli_error($dbConnection);
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
                            <small>Add Post</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
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
                                <input type="text" class="form-control" name="author">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" name="tags">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" name="status" value="draft">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea type="text" class="form-control" name="content" id="" cols="30" rows="10"></textarea>
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