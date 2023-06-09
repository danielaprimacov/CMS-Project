<?php
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $query = "SELECT * FROM users WHERE user_id = {$user_id}";
  $selectAllInf = mysqli_query($connection, $query);

  checkQuery($selectAllInf);

  while ($row = mysqli_fetch_assoc($selectAllInf)) {
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $user_password = $row['user_password'];
    $user_image = $row['user_image'];

?>

    <?php editAdminProfile(); ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="form-label" for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
      </div>

      <div class="form-group">
        <label class="form-label" for="user_firstname">First Name</label>
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
        <input type="password" class="form-control" name="user_password" autocomplete="off">
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