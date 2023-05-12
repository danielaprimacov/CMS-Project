<div id="wrapper">

<?php
$session = session_id();
$time = time();
$time_out_sec = 60;
$time_out = $time - $time_out_sec;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$querySession = mysqli_query($connection, $query);
if(!$querySession) {
  die("Query failed!" . mysqli_error($connection));
}

$count = mysqli_num_rows($querySession);
if(!$count == NULL) {
  mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
} else {
  mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
}
?>

  <!-- Navigation -->
  <?php include "navigation.php"; ?>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <?php include "sidebar-nav.php"; ?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <?php include "content.php"; ?>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>