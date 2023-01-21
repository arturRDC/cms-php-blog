<?php
include 'db.php';
?>
<div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">
        <h4>Search</h4>
        <form action="search.php" method="post">

            <div class="input-group">
                <input name="searchQuery" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $categoryQuery = 'SELECT * FROM categories';
                    $categoryQueryResult = mysqli_query($dbConnection, $categoryQuery);


                    while ($dbRow = mysqli_fetch_assoc($categoryQueryResult)) {
                        $categoryName = $dbRow['name'];
                        echo "<li><a href='#'>{$categoryName}</a>";
                    }
                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>