<?php

function redirectToAnotherPage($where)
{
  echo "<script type='text/javascript'>
        window.location = 'http://localhost:8080/CMS-Project/main/main/$where'</script>";
}

function checkQuery($query)
{
  global $connection;
  if (!$query) {
    die("Query failed!" . mysqli_error($connection));
  }
}

function addComment()
{
  global $connection;
  if (isset($_POST['add_comment'])) {
    $the_post_id = $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];

    if (!$comment_author) {
      echo "<div class='alert alert-danger' role='alert'>Author must be provided!</div>";
    } elseif (!$comment_email) {
      echo "<div class='alert alert-danger' role='alert'>Email must be provided!</div>";
    } elseif (!$comment_content) {
      echo "<div class='alert alert-danger' role='alert'>Comment cannot be empty!</div>";
    } else {

      $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";

      $addAllComments = mysqli_query($connection, $query);
      if (checkQuery($addAllComments)) {
        echo "";
      } else {
        echo "<div class='alert alert-success' role='alert'>Comment Successfully Sent!</div>";
      }


      // $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE post_id = $the_post_id";
      // $addCommentCount = mysqli_query($connection, $query);
      // if (!$addCommentCount) {
      //   die("Query failed!" . mysqli_error($connection));
      // }
    }
    redirectToAnotherPage("post.php?p_id={$the_post_id}");
  }
}

function usernameExists($user_name) {
  global $connection;
  $query = "SELECT user_name FROM users WHERE user_name = '$user_name'";

  $result = mysqli_query($connection, $query);
  checkQuery($result);

  if(mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}
