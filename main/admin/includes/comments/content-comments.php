<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Comments
      <small><?php echo $_SESSION['user_name'];?></small>
    </h1>

    <?php

    if (isset($_GET['source'])) {
      $source = $_GET['source'];
    } else {
      $source = '';
    }

    switch ($source) {
      case '1':
        echo "";
        break;
      case '2':
        echo "";
        break;
      case '3':
        echo "";
        break;
      default:
        include "view-all-comments.php";
        break;
    }

    ?>

  </div>
</div>