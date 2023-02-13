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
                                    <th>Content</th>
                                    <th>Author Id</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Replied to</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $commentQuery = 'SELECT * FROM comments';
                                $commentQueryResult = mysqli_query($dbConnection, $commentQuery);


                                while ($dbRow = mysqli_fetch_assoc($commentQueryResult)) {
                                    $commentId = $dbRow['comment_id'];
                                    $commentContent = $dbRow['content'];
                                    $commentAuthorId = $dbRow['author_id'];
                                    $commentDate = $dbRow['date'];
                                    $commentStatus = $dbRow['status'];
                                    $repliedPostId = $dbRow['post_id'];

                                    echo "<tr>";
                                    echo "<td>{$commentId}</td>";
                                    echo "<td>{$commentContent}</td>";
                                    echo "<td>{$commentAuthorId}</td>";
                                    echo "<td>{$commentDate}</td>";
                                    echo "<td>{$commentStatus}</td>";

                                    // Read post
                                    $repliedPostQuery = "SELECT * FROM posts WHERE id = {$repliedPostId}";
                                    $repliedPostQueryResult = mysqli_query($dbConnection, $repliedPostQuery);

                                    while ($dbRow = mysqli_fetch_assoc($repliedPostQueryResult)) {
                                        // $postName = $dbRow['name'];

                                        echo "<td><a href='../post.php?id={$repliedPostId}'>Original Post</a></td>";
                                    }

                                    // echo "<td>{$repliedPostId}</td>";
                                    echo "<td><a href='comments.php?approve={$commentId}'>Approve</td>";
                                    echo "<td><a href='comments.php?reject={$commentId}'>Reject</td>";
                                    echo "<td><a href='comments.php?delete={$commentId}'>Delete</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                        <?php
                        // Delete comment
                        if (isset($_GET['delete'])) {
                            $idDelete = $_GET['delete'];

                            // Read post replied to
                            $readQuery = "SELECT post_id FROM comments WHERE comment_id = {$idDelete}";
                            $readQueryResult = mysqli_query($dbConnection, $readQuery);
                            while ($dbRow = mysqli_fetch_assoc($readQueryResult)) {
                                $postCommented = $dbRow['post_id'];
                            }

                            // Decrease post comment count
                            $updateCommentAmountQuery = "UPDATE posts SET comment_amount = comment_amount - 1 WHERE id = {$postCommented}";
                            $updateCommentAmountQueryResult = mysqli_query($dbConnection, $updateCommentAmountQuery);

                            // Delete comment
                            $deleteQuery = "DELETE FROM comments WHERE comment_id = {$idDelete}";
                            $deleteQueryResult = mysqli_query($dbConnection, $deleteQuery);
                            header('Location: comments.php');
                        }
                        // Approve comment
                        if (isset($_GET['approve'])) {
                            $idApprove = $_GET['approve'];
                            $approveQuery = "UPDATE comments SET status = 'approved' WHERE comment_id = {$idApprove}";
                            $deleteQueryResult = mysqli_query($dbConnection, $approveQuery);
                            header('Location: comments.php');
                        }
                        // Reject comment
                        if (isset($_GET['reject'])) {
                            $idReject = $_GET['reject'];
                            $rejectQuery = "UPDATE comments SET status = 'unapproved' WHERE comment_id = {$idReject}";
                            $rejectQueryResult = mysqli_query($dbConnection, $rejectQuery);
                            header('Location: comments.php');
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