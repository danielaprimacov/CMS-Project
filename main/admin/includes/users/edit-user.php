<?php
if (isset($_GET['u_id'])) {
  $the_user_id = $_GET['u_id']; // post_id
}

$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$selectUserById = mysqli_query($connection, $query);

if (!$selectUserById) {
  die("Query failed!" . mysqli_error($connection));
}

while ($row = mysqli_fetch_assoc($selectUserById)) {
  $user_id = $row['user_id'];
  $user_name = $row['user_name'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_email = $row['user_email'];
  $user_password = $row['user_password'];
  $user_role = $row['user_role'];
  $user_image = $row['user_image'];
}

if (isset($_POST['add_user'])) {
  $user_name = $_POST['user_name'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $user_role = $_POST['user_role'];

  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];

  move_uploaded_file($user_image_temp, "../images/profile/$user_image");

  if (empty($user_image)) {
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $selectImage = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectImage)) {
      $user_image = $row['user_image'];
    }
  }

  $query = "SELECT randSalt FROM users";
  $selectSalt = mysqli_query($connection, $query);
  if (!$selectSalt) {
    die("Query failed!" . mysqli_error($connection));
  }

  $row = mysqli_fetch_array($selectSalt);
  $randSalt = $row['randSalt'];
  $hashed_password = crypt($user_password, $randSalt);

  $query = "UPDATE users SET user_name = '{$user_name}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_password = '{$hashed_password}', user_role = '{$user_role}', user_image = '{$user_image}' WHERE user_id = {$the_user_id}";

  $editQuery = mysqli_query($connection, $query);
  if (!$editQuery) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-success' role='alert'>User Successfully Updated!</div>";
  }
}
?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label" for="user_name">Enter Username</label>
    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_firstname">Enter First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_lastname">Enter Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_email">Enter Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_email">Enter Password</label>
    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_role">User Role</label>
    <select class="form-control" name="user_role">
      <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
      <?php
      if (strtolower($user_role) == 'admin') {
        echo "<option value='User'>User</option>";
      } else {
        echo "<option value='Admin'>Admin</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="old_image">Existing Profile Image</label>
    <img class="img-responsive" src="../images/profile/<?php echo $user_image; ?>" name="old_image">
    <label for="user_image">Select Profile Image</label>
    <input type="file" class="form-control" name="user_image">
  </div>

  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Update User Information" name="add_user">
  </div>
</form>