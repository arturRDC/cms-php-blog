<!-- Blog Comments -->

<?php
if (isset($_POST['post_comment'])) {
    $postId = $_GET['id'];
    $commentAuthor = $_POST['comment_author'];
    $commentEmail = $_POST['comment_email'];
    $commentContent = $_POST['comment_content'];


    $commentQuery = "INSERT INTO comments(post_id, date, author, email, content, status) ";
    $commentQuery .= "VALUES ({$postId}, now(), '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved')";

    $commentQueryResult = mysqli_query($dbConnection, $commentQuery);
}
?>

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="" method="post">
        <div class="form-group">
            <label for="comment_author">Author</label>
            <input type="text" name="comment_author" class="form-control">
        </div>
        <div class="form-group">
            <label for="comment_email">Email</label>
            <input type="email" name="comment_email" class="form-control">
        </div>
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
    $commentAuthor = $dbRow['author'];
    $commentDate = $dbRow['date'];

?>




    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
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
?>