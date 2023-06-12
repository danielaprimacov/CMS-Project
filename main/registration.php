<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $error = [
    'username' => '',
    'email' => '',
    'password' => ''
  ];

  if ($username == '') {
    $error['username'] = "<div class='alert alert-warning' role='alert'>Must provide username!</div>";
  } elseif (strlen($username) < 6) {
    $error['username'] = "<div class='alert alert-warning' role='alert'>Username must be longer than 6 characters!</div>";
  } elseif (usernameExists($username)) {
    $error['username'] = "<div class='alert alert-warning' role='alert'>Username already exists!</div>";
  }

  if ($email == '') {
    $error['email'] = "<div class='alert alert-warning' role='alert'>Must provide E-mail!</div>";
  } elseif (emailExists($email)) {
    $error['email'] = "<div class='alert alert-warning' role='alert'>E-mail already exists!</div><a href='index.php?page=1'>Go to Login Page</a>";
  }

  if ($password == '') {
    $error['password'] = "<div class='alert alert-warning' role='alert'>Must provide Password!</div>";
  }

  foreach ($error as $key => $value) {
    if (empty($value)) {
      unset($error[$key]);
    }
  }

  if (empty($error)) {
    registrationUser($username, $email, $password);

    loginUser($username, $password);
  }
}
?>

<!-- Page Content -->
<?php include "includes/registration-content.php"; ?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>