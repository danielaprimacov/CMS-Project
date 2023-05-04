<?php 
  if(isset($_GET['delete'])){
    $post_id_delete = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id_delete}";
    $deleteQuery = mysqli_query($connection, $query);

    if(!$deleteQuery) {
      die("Query failed!" . mysqli_error($connection));
    } else {
      echo "<div class='alert alert-success' role='alert'>Post Successfully Deleted!</div>";
    }

  }
?>

<table class="table table-bordered table-hover">
      <thead>
        <tr>
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
        </tr>
      </thead>
      <tbody>
      <?php

      $query = "SELECT * FROM posts";
      $selectAllPosts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($selectAllPosts)) {
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
      ?>
      <tr>
        <td><?php echo $post_id; ?></td>
        <td><?php echo $post_author; ?></td>
        <td><?php echo $post_title; ?></td>
        <td><?php echo $post_content; ?></td>

        <?php 
          $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
          $selectAllCategories = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($selectAllCategories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
          }
        ?>

        <td><?php echo $post_status; ?></td>
        <td><img class='img-responsive' src='../images/<?php echo $post_img; ?>'></td>
        <td><?php echo $post_tags; ?></td>
        <td><?php echo $post_comments; ?></td>
        <td><?php echo $post_date; ?></td>
        <td><a href='posts.php?source=edit-post&p_id=<?php echo $post_id; ?>'>Edit</a></td>
        <td><a href='posts.php?delete=<?php echo $post_id; ?>'>Delete</a></td>
      </tr>
     <?php } ?>

      </tbody>
    </table>
