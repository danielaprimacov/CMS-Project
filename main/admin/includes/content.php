<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Welcome <?php echo $_SESSION['user_name']; ?>
      <small><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <i class="fa fa-dashboard"> </i><a href="index.php">Dashboard</a>
      </li>
    </ol>
  </div>
</div>
<?php include "admin-widget.php"; ?>