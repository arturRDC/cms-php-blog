<!-- Blog Comments -->

<?php
if (isset($_POST['post_comment'])) {
    $postId = escape($_GET['id']);


    if ($_SESSION['id']) {
        $commentAuthorId = escape($_SESSION['id']);
        $commentEmail = escape($_SESSION['email']);
    } else {
        $commentAuthorId = 29;
        $commentEmail = 'anon@anon.com';
    }

    $commentContent = escape($_POST['comment_content']);

    // Insert comment in database
    $commentQuery = "INSERT INTO comments(post_id, date, author_id, content, status) ";
    $commentQuery .= "VALUES ({$postId}, now(), '{$commentAuthorId}', '{$commentContent}', 'unapproved')";

    $commentQueryResult = mysqli_query($dbConnection, $commentQuery);

    // Update comment count in database
    $commentCountQuery = "UPDATE posts SET comment_amount = comment_amount + 1 WHERE id = {$postId}";
    $commentCountQueryResult = mysqli_query($dbConnection, $commentCountQuery);
    if ($commentCountQueryResult) {
        echo "<h3> Your comment is pending approval. Come back later </h3>";
    }
}
?>

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment as <?php
                            if ($_SESSION['username']) {
                                echo $_SESSION['username'];
                            } else {
                                echo 'anonymous';
                            }
                            ?></h4>
    <form role="form" action="" method="post">
        <div class="form-group">
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="post_comment">Post Comment</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->

<?php
$commentQuery = "SELECT * FROM comments WHERE post_id = {$postId} AND status = 'approved' ORDER BY comment_id DESC";
$commentQueryResult = mysqli_query($dbConnection, $commentQuery);


while ($dbRow = mysqli_fetch_assoc($commentQueryResult)) {
    $commentContent = $dbRow['content'];
    $commentDate = $dbRow['date'];
    $authorId = $dbRow['author_id'];

    $profileQuery = "SELECT * FROM users WHERE id = {$authorId}";
    $profileQueryResult = mysqli_query($dbConnection, $profileQuery);
    while ($profileDbRow = mysqli_fetch_assoc($profileQueryResult)) {
        $commentAuthor = $profileDbRow['username'];
        $authorEmail = $profileDbRow['email'];
        $profilePicture = $profileDbRow['picture'];



?>




        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/<?php echo $profilePicture ?>" alt="profile picture">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $commentAuthor ?>
                    <small><?php echo $commentDate ?></small>
                </h4>
                <?php echo $commentContent ?>
            </div>
        </div>
<?php
    }
}
?>