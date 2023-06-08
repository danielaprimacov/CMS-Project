<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!$username) {
    $message = "<div class='alert alert-danger' role='alert'>Must provide username!</div>";
  } elseif (!$email) {
    $message = "<div class='alert alert-danger' role='alert'>Must provide E-mail!</div>";
  } elseif (!$password) {
    $message = "<div class='alert alert-danger' role='alert'>Must provide password!</div>";
  } else {
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT randSalt FROM users";
    $randSaltQuery = mysqli_query($connection, $query);
    if (!$randSaltQuery) {
      die("Query failed!" . mysqli_error($connection));
    }

    $row = mysqli_fetch_array($randSaltQuery);
    $randSalt = $row['randSalt'];

    $password = crypt($password, $randSalt);

    $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'User')";
    $registrationQuery = mysqli_query($connection, $query);

    if (!$registrationQuery) {
      die("Query failed!" . mysqli_error($connection));
    } else {
      $message = '';
      echo "<script type='text/javascript'>
          window.location = 'http://localhost:8080/CMS-Project/main/main/index.php'
          </script>";
    }
  }
}
?>




<!-- Page Content -->
<?php include "includes/contact-content.php"; ?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>