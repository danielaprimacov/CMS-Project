<?php
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $query = "SELECT * FROM users WHERE user_id = {$user_id}";
  $selectAllInf = mysqli_query($connection, $query);

  if (!$selectAllInf) {
    die("Query failed!" . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_assoc($selectAllInf)) {
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $user_password = $row['user_password'];
    $user_image = $row['user_image']; 

?>

<?php
if(isset($_POST['update_profile'])) {
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

?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="form-label" for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
      </div>

      <div class="form-group">
        <label class="form label" for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="user_email">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="user_role">Role</label>
        <input class="form-control" type="text" name="user_role" readonly="readonly" value="<?php echo $user_role; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="old_image">Existing Profile Image</label>
        <img class="img-responsive" src="../images/profile/<?php echo $user_image; ?>" name="old_image">
        <label for="user_image">Select Profile Image</label>
        <input type="file" name="user_image">
      </div>

      <div class="form-group">
        <input class="btn btn-success" type="submit" value="Update Profile Information" name="update_profile">
      </div>
    </form>
  <?php } ?>
<?php } ?>