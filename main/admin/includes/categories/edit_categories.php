<form action="" method="post">
  <div class="form-group">
    <label class="form-label" for="category_title">Update Category</label>
    <?php

    if (isset($_GET['edit'])) {
      $cat_id_edit = $_GET['edit'];
      $query = "SELECT * FROM categories WHERE cat_id = $cat_id_edit";
      $selectCaterogiesEdit = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($selectCaterogiesEdit)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    ?>
        <input type="text" class="form-control" name="cat_title" value="<?php if (isset($cat_title)) {echo $cat_title;} ?>">
      <?php } ?>
    <?php } ?>

    <?php

    if (isset($_POST['update_category'])) {
      $cat_title_edit = $_POST['cat_title'];
      $query = "UPDATE categories SET cat_title = '{$cat_title_edit}' WHERE cat_id = '{$cat_id}'";
      $updateQuery = mysqli_query($connection, $query);

      if (!$updateQuery) {
        die("Query failed" . mysqli_error($connection));
      }
    }

    ?>

  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
  </div>
</form>
