<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Posts
      <small>Author</small>
    </h1>

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