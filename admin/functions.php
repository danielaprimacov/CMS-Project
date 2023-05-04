<?php

function insertCategory()
{
  global $connection;
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['category_title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "<div class='alert alert-danger' role='alert'>
            This field should not be empty
            </div>";
    } else {
      $query = "INSERT INTO categories(cat_title) ";
      $query .= "VALUE('{$cat_title}')";

      $createCategory = mysqli_query($connection, $query);
      if (!$createCategory) {
        die("Query failed" . mysqli_error($connection));
      }
    }
  }
}

function deleteCategory()
{
  global $connection;
  if (isset($_GET['delete'])) {
    $cat_id_delete = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete}";
    $delete_query = mysqli_query($connection, $query);

    if (!$delete_query) {
      die("Query failed!" . mysqli_error($connection));
    }
  }
}


function showCategories()
{
  global $connection;
  $query = "SELECT * FROM categories";
  $selectAllCategories = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($selectAllCategories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

?>
    <tr>
      <td><?php echo $cat_id; ?></td>
      <td><?php echo $cat_title; ?></td>
      <td><a href='categories.php?delete=<?php echo $cat_id; ?>'>Delete</a></td>
      <td><a href='categories.php?edit=<?php echo $cat_id; ?>'>Edit</a></td>
    </tr>
<?php }
}
