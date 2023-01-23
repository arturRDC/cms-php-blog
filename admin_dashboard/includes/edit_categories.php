<form action="" method="post">
    <div class="form-group">
        <label for="category-name">Edit Category: </label>
        <?php
        if (isset($_GET['edit'])) {
            $editCategoryId = $_GET['edit'];

            $editCategoryQuery = "SELECT * FROM categories WHERE id = {$editCategoryId}";
            $editCategoryQueryResult = mysqli_query($dbConnection, $editCategoryQuery);
            while ($catList = mysqli_fetch_assoc($editCategoryQueryResult)) {
                $categoryName = $catList['name'];
            }
            echo "<input value='{$categoryName}' class='form-control' type='text' name='category-name'>";
        }
        if (isset($_POST['update-category'])) {
            $newName = $_POST['category-name'];
            $updateCategoryQuery = "UPDATE categories SET name = '{$newName}' WHERE id = {$categoryId}";
            $updateCategoryQueryResult =  mysqli_query($dbConnection, $updateCategoryQuery);

            if (!$updateCategoryQueryResult) {
                echo 'Error: unable to update category' . mysqli_error($dbConnection);
            }
            sleep(3);
            header('Location: categories.php');
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update-category" value="Save">
    </div>
</form>