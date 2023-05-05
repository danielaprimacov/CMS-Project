<?php
if (isset($_GET['delete'])) {
  $comment_id_delete = $_GET['delete'];
  $query = "DELETE FROM comments WHERE comment_id = {$comment_id_delete}";
  $deleteQuery = mysqli_query($connection, $query);

  if (!$deleteQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-success' role='alert'>Comment Successfully Deleted!</div>";
  }
}
?>

<?php
    if (isset($_GET['unapprove'])) {
      $the_comment_id = $_GET['unapprove'];
      $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$the_comment_id} ";
      $unapproveComment = mysqli_query($connection, $query);

      if (!$unapproveComment) {
        die("Query failed!" . mysqli_error($connection));
      } else {
        echo "<div class='alert alert-warning' role='alert'>Comment Unapproved!</div>";
      }
    }


    if (isset($_GET['approve'])) {
      $the_comment_id = $_GET['approve'];
      $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$the_comment_id} ";
      $approveComment = mysqli_query($connection, $query);

      if (!$approveComment) {
        die("Query failed!" . mysqli_error($connection));
      } else {
        echo "<div class='alert alert-success' role='alert'>Comment Approved!</div>";
      }
    }
    ?>


<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Comment Post Id</th>
      <th>Email</th>
      <th>Status</th>
      <th>Date</th>
      <th>In respone to</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $query = "SELECT * FROM comments";
    $selectAllComments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectAllComments)) {
      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_content = $row['comment_content'];
      $comment_email = $row['comment_email'];
      $comment_status = $row['comment_status'];
      $comment_date = $row['comment_date'];
    ?>
      <tr>
        <td><?php echo $comment_id; ?></td>
        <td><?php echo $comment_author; ?></td>
        <td><?php echo $comment_content; ?></td>
        <td><?php echo $comment_post_id; ?></td>
        <td><?php echo $comment_email; ?></td>
        <td><?php echo $comment_status; ?></td>
        <td><?php echo $comment_date; ?></td>

        <?php
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $selectPost = mysqli_query($connection, $query);
        if (!$selectPost) {
          die("Query failed!" . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($selectPost)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
        ?>
          <td><a href='../post.php?p_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a></td>
        <?php } ?>


        <td><a href='comments.php?approve=<?php echo $comment_id; ?>'>Approve</a></td>
        <td><a href='comments.php?unapprove=<?php echo $comment_id; ?>'>Unapprove</a></td>
        <td><a href='comments.php?delete=<?php echo $comment_id; ?>'>Delete</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>