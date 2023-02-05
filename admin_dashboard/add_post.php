<?php
include 'includes/header.php';

if (isset($_POST['submit'])) {
    $postTitle = $_POST['title'];
    $categoryId = $_POST['category-id'];
    $postTags = $_POST['tags'];
    $postStatus = $_POST['status'];
    $postContent = $_POST['content'];
    $postAuthor = $_POST['author'];

    $postImage = $_FILES['image']['name'];
    $postLocalImage = $_FILES['image']['tmp_name'];


    $postDate = date('y-m-d');
    $postCommentAmount = 0;

    move_uploaded_file($postLocalImage, "../images/$postImage");

    $addPostQuery = "INSERT INTO posts(id, category_id, tags, author, title, date, image, content, status, comment_amount) VALUES ('','{$categoryId}','{$postTags}','{$postAuthor}','{$postTitle}',now(), '{$postImage}' ,'{$postContent}','{$postStatus}',{$postCommentAmount})";
    echo $addPostQuery;

    $addPostQueryResult = mysqli_query($dbConnection, $addPostQuery);
    header('Location: posts.php');

    if (!$addPostQueryResult) {
        echo 'failed to add post' . mysqli_error($dbConnection);
    }
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
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="category">Category Id</label>
                                <input type="text" class="form-control" name="category-id">
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
                                <input type="text" class="form-control" name="status">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea type="text" class="form-control" name="content" id="" cols="30" rows="10">
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