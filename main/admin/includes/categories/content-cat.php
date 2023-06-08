<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Add a new category
      <small><?php echo $_SESSION['user_name']; ?></small>
    </h1>
    <div class="col-xs-6">
      <?php insertCategory(); ?>
      <form action="" method="post">
        <div class="form-group">
          <label class="form-label" for="category_title">Add Category</label>
          <input class="form-control" type="text" name="category_title">
        </div>
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
        </div>
      </form>

      <?php

      if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        include "edit_categories.php";
      }

      ?>
    </div>

    <div class="col-xs-6">

      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Category Title</th>
          </tr>
        </thead>
        <tbody>
          <?php deleteCategory(); ?>

          <?php showCategories(); ?>

        </tbody>
      </table>
    </div>
  </div>
</div>