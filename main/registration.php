<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $email = mysqli_real_escape_string($connection, $email);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT randSalt FROM users";
  $randSaltQuery = mysqli_query($connection, $query);
  if(!$randSaltQuery) {
    die("Query failed!" . mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($randSaltQuery)) {
    $randSalt = $row['randSalt'];
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