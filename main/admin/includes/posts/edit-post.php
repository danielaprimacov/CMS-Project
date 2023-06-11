<?php
if (isset($_GET['p_id'])) {
  $the_post_id = $_GET['p_id']; // post_id
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$selectPostById = mysqli_query($connection, $query);

checkQuery($selectPostById);

while ($row = mysqli_fetch_assoc($selectPostById)) {
  $post_id = $row['post_id'];
  $post_author = $row['post_author'];
  $post_content = $row['post_content'];
  $post_title = $row['post_title'];
  $post_category_id = $row['post_category_id'];
  $post_status = $row['post_status'];
  $post_img = $row['post_img'];
  $post_tags = $row['post_tags'];
  $post_comments = $row['post_comments_count'];
  $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {
  $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
  $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
  $post_tags = $_POST['post_tags'];

  $post_img = $_FILES['image']['name'];
  $post_img_temp = $_FILES['image']['tmp_name'];

  move_uploaded_file($post_img_temp, "../images/$post_img");

  if (empty($post_img)) {
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $selectImage = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectImage)) {
      $post_img = $row['post_img'];
    }
  }

  $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = {$post_category_id}, post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_img = '{$post_img}' WHERE post_id = {$the_post_id}";

  $editQuery = mysqli_query($connection, $query);
  if (!$editQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-success' role='alert'>Post Successfully Updated! <a href='../post.php?p_id={$the_post_id}'>View Post</a></div>";
  }
}
?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label" for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="post_content">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_category">Post Category </label>
    <select class="form-control" name="post_category" id="post_cat">
      <?php
      $query = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
      $selectTitle = mysqli_query($connection, $query);
      if (!$selectTitle) {
        die("Query failed!" . mysqli_error($connection));
      } else {
        $row = mysqli_fetch_array($selectTitle);
        $cat_title = $row['cat_title'];
        echo $cat_title;
      }
      ?>
      </option>
      <?php
      $query = "SELECT * FROM categories";
      $selectCategories = mysqli_query($connection, $query);

      checkQuery($selectCategories);

      while ($row = mysqli_fetch_assoc($selectCategories)) {
        $category_id = $row['cat_id'];
        $category_title = $row['cat_title'];

        if ($category_id == $post_category_id) {
          echo "<option selected value='$category_id'>$category_title</option>";
        } else {
          echo "<option value='$category_id'>$category_title</option>";
        }
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_author">Post Author </label>
    <select class="form-control" name="post_author" id="post_author">
      <?php echo "<option selected value='{$post_author}'>$post_author</option>" ?>
      <?php
      $query = "SELECT * FROM users";
      $selectUsers = mysqli_query($connection, $query);

      checkQuery($selectUsers);

      while ($row = mysqli_fetch_assoc($selectUsers)) {
        $user_id = $row['user_id'];
        $username = $row['user_name'];
        $user_lastname = $row['user_lastname'];
        $user_firstname = $row['user_firstname'];

        if (!empty($user_firstname) && !empty($user_lastname)) {
          echo "<option value='{$username}'>$user_lastname $user_firstname</option>";
        } else {
          echo "<option value='{$username}'>$username</option>";
        }
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label class="form-label" for="post_status">Post Status</label>
    <select class="form-control" name="post_status" id="post_status">
      <?php
      if($post_status == 'Published') {
        echo "<option selected value='$post_id'>$post_status</option>";
        echo "<option value='Draft'>Draft</option>";
      } elseif($post_status == 'Draft') {
         echo "<option selected value='$post_id'>$post_status</option>";
         echo "<option value='Published'>Published</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="post_img">Post Image</label>
    <img class="img-responsive" src="../images/<?php echo $post_img; ?>" name="post_img">
    <label class="form-label" for="image">Select new image: </label>
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Update Post" name="update_post">
  </div>
</form>