<?php

function escape($string)
{
  global $connection;
  mysqli_real_escape_string($connection, trim($string));
}

function checkQuery($query)
{
  global $connection;
  if (!$query) {
    die("Query failed!" . mysqli_error($connection));
  }
}

function makeQuery($query)
{
  global $connection;
  return mysqli_query($connection, $query);
}

function fetchRecords($result)
{
  return mysqli_fetch_array($result);
}


function isLoggedIn()
{
  if (isset($_SESSION['user_role'])) {
    return true;
  }
  return false;
}

function redirectToAnotherPage($where)
{
  echo "<script type='text/javascript'>
      window.location = 'http://localhost:8080/CMS-Project/main/main/admin/$where' 
      </script>";
  exit;
}

function usersOnline()
{
  if (isset($_GET['onlineusers'])) {
    global $connection;
    if (!$connection) {
      session_start();
      include("../includes/db.php");
      $session = session_id();
      $time = time();
      $time_out_sec = 5;
      $time_out = $time - $time_out_sec;

      $query = "SELECT * FROM users_online WHERE session = '$session'";
      $querySession = mysqli_query($connection, $query);
      checkQuery($querySession);

      $count = mysqli_num_rows($querySession);
      if (!$count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
      } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
      }
      $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
      echo mysqli_num_rows($users_online);
    }
  }
}

usersOnline();

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
      checkQuery($createCategory);
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

    checkQuery($delete_query);
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

function editAdminProfile()
{
  global $connection;
  $user_id = $_SESSION['user_id'];
  if (isset($_POST['update_profile'])) {
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = 'Admin';

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/profile/$user_image");

    if (empty($user_image)) {
      $query = "SELECT * FROM users WHERE user_id = $user_id ";
      $selectImage = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($selectImage)) {
        $user_image = $row['user_image'];
      }
    }

    $query = "UPDATE users SET user_name = '{$user_name}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_password = '{$user_password}', user_role = '{$user_role}', user_image = '{$user_image}' WHERE user_id = {$user_id}";

    $editQuery = mysqli_query($connection, $query);
    if (!$editQuery) {
      die("Query failed!" . mysqli_error($connection));
    } else {
      echo "<div class='alert alert-success' role='alert'>Profile Information Successfully Updated!</div>";
    }
  }
}

function countRecords($table)
{
  global $connection;
  $query = "SELECT * FROM " . $table;
  $selectAll = mysqli_query($connection, $query);
  checkQuery($selectAll);
  $count = mysqli_num_rows($selectAll);
  return $count;
}

function count_records($result)
{
  return mysqli_num_rows($result);
}

function selectByCondition($table, $condition)
{
  global $connection;
  $query = "SELECT * FROM " . $table .  " WHERE " . $condition;
  $selectByCond = mysqli_query($connection, $query);
  $count = mysqli_num_rows($selectByCond);
  checkQuery($selectByCond);
  return $count;
}

function isAdmin()
{
  $user_id = $_SESSION['user_id'];

  if (isLoggedIn()) {
    global $connection;
    $selectRole = makeQuery("SELECT user_role FROM users WHERE user_id = $user_id");
    checkQuery($selectRole);

    $row = fetchRecords($selectRole);
    if ($row['user_role'] == 'Admin') {
      return true;
    } else {
      return false;
    }
  }
}

function loggedinUserId()
{
  if (isLoggedIn()) {
    $result = makeQuery("SELECT * FROM users WHERE user_name='" . $_SESSION['user_name'] . "'");
    $users = mysqli_fetch_array($result);
    return mysqli_num_rows($result) >= 1 ? $users['user_id'] : false;
  }
  return false;
}

function placeholderEmptyImage($img = null)
{
  if (!$img) {
    return 'No-Image-Placeholder.png';
  } else {
    return $img;
  }
}


function getAllUserPosts()
{
  $result = makeQuery("SELECT * FROM posts WHERE user_id=" . loggedinUserId() . "");
  checkQuery($result);
  return $result;
}

function getAllUserComments()
{
  $result = makeQuery("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id=" . loggedinUserId() . "");
  checkQuery($result);
}

function getAllUserCategories()
{
  $result = makeQuery("SELECT * FROM categories WHERE user_id=" . loggedinUserId() . "");
  checkQuery($result);
  return $result;
}

function getAllUserPublishedPosts()
{
  $result = makeQuery("SELECT * FROM posts WHERE user_id=" . loggedinUserId() . " AND post_status='Published'");
  checkQuery($result);
  return $result;
}

function getAllUserDraftPosts()
{
  $result = makeQuery("SELECT * FROM posts WHERE user_id=" . loggedinUserId() . " AND post_status='Draft'");
  checkQuery($result);
  return $result;
}

function getAllUserApprovedComments()
{
  $result = makeQuery("SELECT * FROM comments WHERE user_id=" . loggedinUserId() . " AND comments_status='Approved'");
  checkQuery($result);
  return $result;
}

function getAllUserUnapprovedComments()
{
  $result = makeQuery("SELECT * FROM comments WHERE user_id=" . loggedinUserId() . " AND comments_status='Unapproved'");
  checkQuery($result);
  return $result;
}
