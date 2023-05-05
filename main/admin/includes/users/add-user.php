<?php
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

  $query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_email, user_password, user_role, user_image) VALUES('{$user_name}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_password}', '{$user_role}', '{$user_image}')";

  $createUser = mysqli_query($connection, $query);

  if (!$createUser) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-success' role='alert'>User Successfully Added!</div>";
  }
}
?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_name">Enter Username</label>
    <input type="text" class="form-control" name="user_name">
  </div>

  <div class="form-group">
    <label for="user_firstname">Enter First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label class="form-label" for="user_lastname">Enter Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="user_email">Enter Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="user_email">Enter Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label>
    <select name="user_role">
      <option value="default">--------</option>
      <option value="User">User</option>
      <option value="Admin">Admin</option>
    </select>
  </div>

  <div class="form-group">
    <label for="user_image">Select Profile Image</label>
    <input type="file" class="form-control" name="user_image">
  </div>

  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Add User" name="add_user">
  </div>
</form>