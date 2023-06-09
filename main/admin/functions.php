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

function redirectToAnotherPage($where)
{
  echo "<script type='text/javascript'>
      window.location = 'http://localhost:8080/CMS-Project/main/main/admin/$where' 
      </script>";
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
