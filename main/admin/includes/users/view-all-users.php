<?php
if (isset($_GET['delete'])) {
  if (isset($_SESSION['user_role'])) {
    if (strtolower($_SESSION['user_role']) == 'admin') {
      $user_id_delete = mysqli_real_escape_string($connection, $_GET['delete']);
      $query = "DELETE FROM users WHERE user_id = {$user_id_delete}";
      $deleteQuery = mysqli_query($connection, $query);

      if (!$deleteQuery) {
        die("Query failed!" . mysqli_error($connection));
      } else {
        echo "<div class='alert alert-success' role='alert'>User Successfully Deleted!</div>";
      }
    }
  }
}
?>

<?php
if (isset($_GET['change_to_admin'])) {
  $the_user_id = $_GET['change_to_admin'];
  $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$the_user_id} ";
  $changeToAdmin = mysqli_query($connection, $query);

  if (!$changeToAdmin) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-warning' role='alert'>User changed to Admin!</div>";
  }
}


if (isset($_GET['change_to_user'])) {
  $the_user_id = $_GET['change_to_user'];
  $query = "UPDATE users SET user_role = 'User' WHERE user_id = {$the_user_id} ";
  $changetoUser = mysqli_query($connection, $query);

  if (!$changetoUser) {
    die("Query failed!" . mysqli_error($connection));
  } else {
    echo "<div class='alert alert-warning' role='alert'>Admin changed to User!</div>";
  }
}
?>


<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>User Id</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Profile Image</th>
      <th>Change to Admin</th>
      <th>Change to User</th>
      <th>Edit User</th>
      <th>Delete User</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $query = "SELECT * FROM users";
    $selectAllUsers = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectAllUsers)) {
      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_role = $row['user_role'];
      $user_image = $row['user_image'];
    ?>
      <tr>
        <td><?php echo $user_id; ?></td>
        <td><?php echo $user_name; ?></td>
        <td><?php echo $user_firstname; ?></td>
        <td><?php echo $user_lastname; ?></td>
        <td><?php echo $user_email; ?></td>
        <td><?php echo $user_role; ?></td>
        <td><img class='img-responsive' src='../images/profile/<?php echo $user_image; ?>'></td>


        <td><a href='users.php?change_to_admin=<?php echo $user_id; ?>'>Change to admin</a></td>
        <td><a href='users.php?change_to_user=<?php echo $user_id; ?>'>Change to user</a></td>
        <td><a href='users.php?source=edit-user&u_id=<?php echo $user_id; ?>'>Edit</a></td>
        <td><a href='users.php?delete=<?php echo $user_id; ?>'>Delete</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>