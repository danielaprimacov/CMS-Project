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

function usernameExists($user_name)
{
  global $connection;
  $query = "SELECT user_name FROM users WHERE user_name = '$user_name'";

  $result = mysqli_query($connection, $query);
  checkQuery($result);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}



function emailExists($user_email)
{
  global $connection;
  $query = "SELECT user_email FROM users WHERE user_email = '$user_email'";

  $result = mysqli_query($connection, $query);
  checkQuery($result);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function registrationUser($username, $email, $password)
{
  global $connection;

  $username = mysqli_real_escape_string($connection, $username);
  $email = mysqli_real_escape_string($connection, $email);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT randSalt FROM users";
  $randSaltQuery = mysqli_query($connection, $query);
  checkQuery($randSaltQuery);

  $row = mysqli_fetch_array($randSaltQuery);
  $randSalt = $row['randSalt'];

  $password = crypt($password, $randSalt);

  $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'User')";
  $registrationQuery = mysqli_query($connection, $query);

  if (!$registrationQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    redirectToAnotherPage("index.php?page=1");
  }
}

function loginUser($user_name, $user_password)
{
  global $connection;
  $user_name = trim($user_name);
  $user_password = trim($user_password);


  $user_name = mysqli_real_escape_string($connection, $user_name);
  $user_password = mysqli_real_escape_string($connection, $user_password);

  $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
  $checkUser = mysqli_query($connection, $query);
  checkQuery($checkUser);

  while ($row = mysqli_fetch_assoc($checkUser)) {
    $db_user_id = $row['user_id'];
    $db_user_name = $row['user_name'];
    $db_user_password = $row['user_password'];
    $db_user_email = $row['user_email'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];

    $user_password = crypt($user_password, $db_user_password);

    if ($user_password !== $db_user_password) {
      $message = "<div class='alert alert-danger' role='alert'>Password is not correct!</div>";
    } elseif (($user_name === $db_user_name) && ($user_password === $db_user_password)) {
      $_SESSION['user_id'] = $db_user_id;
      $_SESSION['user_name'] = $db_user_name;
      $_SESSION['user_firstname'] = $db_user_firstname;
      $_SESSION['user_lastname'] = $db_user_lastname;
      $_SESSION['user_role'] = $db_user_role;

      if (strtolower($_SESSION['user_role']) == 'admin') {
        redirectToAnotherPage("admin/index.php");
      } else {
        redirectToAnotherPage("index.php?page=1");
      }
    }
  }
}
