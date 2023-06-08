<?php include "/xampp/htdocs/CMS-Project/main/main/admin/includes/delete-modal.php"; ?>
<?php
if (isset($_GET['delete'])) {
  $post_id_delete = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = {$post_id_delete}";
  $deleteQuery = mysqli_query($connection, $query);

  if (!$deleteQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-success' role='alert'>Post Successfully Deleted!</div>";
  }
}
?>

<?php
if (isset($_GET['reset'])) {
  $post_id_reset = mysqli_real_escape_string($connection, $_GET['reset']);
  $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$post_id_reset}";
  $resetQuery = mysqli_query($connection, $query);

  if (!$resetQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    redirectToAnotherPage("posts.php");
  }
}
?>

<?php
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $checkboxElement) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'Draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkboxElement";
        $draftQuery = mysqli_query($connection, $query);
        if (!$draftQuery) {
          die("Query failed!" . mysqli_error($connection));
        }
        break;
      case 'Published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkboxElement";
        $publishQuery = mysqli_query($connection, $query);
        if (!$publishQuery) {
          die("Query failed!" . mysqli_error($connection));
        }
        break;
      case 'Delete':
        $query = "DELETE FROM posts WHERE post_id = $checkboxElement";
        $deleteQuery = mysqli_query($connection, $query);
        if (!$deleteQuery) {
          die("Query failed!" . mysqli_error($connection));
        }
        break;
      case 'Clone':
        $query = "SELECT * FROM posts WHERE post_id = '{$checkboxElement}'";
        $selectPost = mysqli_query($connection, $query);
        if (!$selectPost) {
          die("Query failed!" . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($selectPost)) {
          $post_author = mysqli_real_escape_string($connection, $row['post_author']);
          $post_content = mysqli_real_escape_string($connection, $row['post_content']);
          $post_title = mysqli_real_escape_string($connection, $row['post_title']);
          $post_id = $row['post_id'];
          $post_category_id = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_img = $row['post_img'];
          $post_tags = $row['post_tags'];
          $post_date = $row['post_date'];
        }

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
        $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $insertClone = mysqli_query($connection, $query);
        if (!$insertClone) {
          die("Query failed!" . mysqli_error($connection));
        } else {
          echo "<div class='alert alert-success' role='alert'>Clone Added!</div>";
        }
        break;
    }
  }
}
?>


<form action="" method="post">

  <table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
      <select class="form-control" style="margin-bottom: 10px;" name="bulk_options">
        <option value="Default">Choose...</option>
        <option value="Published">Publish</option>
        <option value="Draft">Draft</option>
        <option value="Clone">Clone</option>
        <option value="Delete">Delete</option>
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a class="btn btn-primary" href="posts.php?source=add-post">Add New Post</a>
    </div>

    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Content</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Number of views</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $query = "SELECT * FROM posts ORDER BY post_id DESC";
      $selectAllPosts = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($selectAllPosts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_content = $row['post_content'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_img = $row['post_img'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comments_count'];
        $post_date = $row['post_date'];
        $post_view_count = $row['post_view_count'];
      ?>
        <tr>
          <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
          <td><?php echo $post_id; ?></td>


          <td><?php
              if (!empty($post_author)) {
                echo $post_author;
              } elseif (!empty($post_user)) {
                echo $post_user;
              }
              ?></td>
          <td><?php echo $post_title; ?></td>
          <td><?php echo $post_content; ?></td>

          <?php
          $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
          $selectAllCategories = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($selectAllCategories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
          }
          ?>

          <td><?php echo $post_status; ?></td>
          <td><img class='img-responsive' src='../images/<?php echo $post_img; ?>'></td>
          <td><?php echo $post_tags; ?></td>

          <?php
          $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
          $countComment = mysqli_query($connection, $query);
          if (!$countComment) {
            die("Query failed!" . mysqli_error($connection));
          }

          $row = mysqli_fetch_array($countComment);
          if (!empty($row)) {
            $commentId = $row['comment_id'];
            $countComments = mysqli_num_rows($countComment);
          } else {
            $countComments = 0;
            $commentId = $post_id;
          }
          ?>

          <td><a href='posts-comments.php?id=<?php echo $post_id; ?>'><?php echo $countComments; ?></a></td>
          <td><?php echo $post_date; ?></td>
          <td><a href='../post.php?p_id=<?php echo $post_id; ?>'>View</a></td>
          <td><a href='posts.php?source=edit-post&p_id=<?php echo $post_id; ?>'>Edit</a></td>
          <td><a class="delete_link" rel="<?php echo $post_id; ?>" href='javascript:void(0)'>Delete</a></td>
          <td><a href='posts.php?reset=<?php echo $post_id; ?>'><?php echo $post_view_count; ?></a></td>
        </tr>
      <?php } ?>

    </tbody>
  </table>
</form>

<script>
  $(document).ready(function() {
    $(".delete_link").on('click', function() {
      var id = $(this).attr("rel");
      var delete_url = "posts.php?delete="+ id +" ";

      $(".modal-delete-link").attr("href", delete_url);      

      $("#staticBackdrop").modal('show');
    });
  });
</script>