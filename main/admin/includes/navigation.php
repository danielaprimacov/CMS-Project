<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!-- <a class="navbar-brand" href="#">Users Online: <?php usersOnline(); ?></a> -->
    <a class="navbar-brand" href="index.php">Admin</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    <li><a href="../index.php?page=1">Go back</a></li>
    <li><a href="#">Users Online: <span class="usersOnline"></span></a></li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
        </li>
        <li>
        <li class="divider"></li>
        <li>
          <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </li>
      </ul>
    </li>
  </ul>