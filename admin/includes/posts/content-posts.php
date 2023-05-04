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
      case 'add-post':
        include "add-post.php";
        break;
      case 'edit-post':
        include "edit-post.php";
        break;
      case '3':
        echo "";
        break;
      default:
        include "view-all-posts.php";
        break;
    }

    ?>

  </div>
</div>