<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Users
      <small><?php echo $_SESSION['user_name']; ?></small>
    </h1>

    <?php
    if(!isAdmin($_SESSION['user_name'])) {
      redirectToAnotherPage("index.php");
    }

    ?>  

    <?php

    if (isset($_GET['source'])) {
      $source = $_GET['source'];
    } else {
      $source = '';
    }

    switch ($source) {
      case 'add-user':
        include "add-user.php";
        break;
      case 'edit-user':
        include "edit-user.php";
        break;
      case '3':
        echo "";
        break;
      default:
        include "view-all-users.php";
        break;
    }

    ?>

  </div>
</div>