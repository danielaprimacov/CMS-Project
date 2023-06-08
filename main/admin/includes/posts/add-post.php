<?php
if (isset($_POST['add_post'])) {
  $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
  $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
  $post_title = mysqli_real_escape_string($connection, $_POST['title']);
  $post_category_id = $_POST['post_cat'];
  $post_status = $_POST['post_status'];
  $post_tags = $_POST['post_tags'];

  $post_img = $_FILES['post_img']['name'];
  $post_img_temp = $_FILES['post_img']['tmp_name'];

  $post_date = date('d-m-y');

  move_uploaded_file($post_img_temp, "../images/$post_img");

  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
  $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', '{$post_status}')";

  $createPost = mysqli_query($connection, $query);
  
  if(!$createPost) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    $new_post_id = mysqli_insert_id($connection);
    echo "<div class='alert alert-success' role='alert'>Post Successfully Added! <a href='../post.php?p_id={$new_post_id}'>View Post</a></div>";
  }
}
?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label" for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label class="form-label" for="summernote">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_cat">Post Category </label>
    <select class="form-control" name="post_cat" id="post_cat">
      <option selected>Choose category...</option>
      <?php
      $query = "SELECT * FROM categories";
      $selectCategories = mysqli_query($connection, $query);

      if (!$selectCategories) {
        die("Query failed!" . mysqli_error($connection));
      }

      while ($row = mysqli_fetch_assoc($selectCategories)) {
        $category_id = $row['cat_id'];
        $category_title = $row['cat_title'];

        echo "<option value='$category_id'>$category_title</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_cat">Post Author </label>
    <select class="form-control" name="post_author" id="post_author">
      <option selected>Choose author...</option>
      <?php
      $query = "SELECT * FROM users";
      $selectUsers = mysqli_query($connection, $query);

      if (!$selectUsers) {
        die("Query failed!" . mysqli_error($connection));
      }

      while ($row = mysqli_fetch_assoc($selectUsers)) {
        $user_id = $row['user_id'];
        $username = $row['user_name'];

        echo "<option value='$user_id'>$username</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_status">Post Status</label>
    <select class="form-control" name="post_status">
      <option value="Default">Choose status...</option>
      <option value="Draft">Draft</option>
      <option value="Published">Published</option>
    </select>

  <div class="form-group">
    <label class="form-label" for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label class="form-label" for="post_img">Post Image</label>
    <input type="file" name="post_img">
  </div>

  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Add Post" name="add_post">
  </div>
</form>