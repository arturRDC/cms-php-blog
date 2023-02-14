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
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $categoryQuery = 'SELECT * FROM categories';
                    $categoryQueryResult = mysqli_query($dbConnection, $categoryQuery);
                    $leftCatAmount =  ceil(mysqli_num_rows($categoryQueryResult) / 2);

                    $categoriesDisplayed = 0;
                    while ($dbRow = mysqli_fetch_assoc($categoryQueryResult)) {
                        $categoryName = $dbRow['name'];
                        $categoryId = $dbRow['id'];
                        echo "<li><a href='categories.php?id={$categoryId}'>{$categoryName}</a>";
                        $categoriesDisplayed++;
                        if ($categoriesDisplayed >= $leftCatAmount) break;
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php

                    while ($dbRow = mysqli_fetch_assoc($categoryQueryResult)) {
                        $categoryName = $dbRow['name'];
                        $categoryId = $dbRow['id'];
                        echo "<li><a href='categories.php?id={$categoryId}'>{$categoryName}</a>";
                        $categoriesDisplayed++;
                    }
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>The blog's mission</h4>
        <p>The goal of this website is to be an example of a possible blog created with the CMS system. </p>
    </div>

</div>