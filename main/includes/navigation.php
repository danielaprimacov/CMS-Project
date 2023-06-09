<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?page=1">Start Coding</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <?php

        $query = "SELECT * FROM categories";
        $selectAllCategories = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($selectAllCategories)) {
          $cat_title = $row['cat_title'];
          $cat_id = $row['cat_id'];

          $category_class = '';
          $contact_class = '';

          $pageName = basename($_SERVER['PHP_SELF']); // current page
          $contact = 'contact.php';

          if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
            $category_class = 'active';
          } elseif ($pageName == $contact) {
            $contact_class = 'active';
          }

          echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
        }

        ?>

        <?php
        if (strtolower($_SESSION['user_role']) == 'admin' && isLoggedIn()) {
        ?>
          <li>
            <a href="admin">Admin</a>
          </li>
          <li>
            <a href="includes/logout.php">Logout</a>
          </li>
          <?php
          if (isset($_GET['p_id'])) {
            $post_id_edit = $_GET['p_id'];
            echo "<li><a href='admin/posts.php?source=edit-post&p_id={$post_id_edit}'>Edit Post</a></li>";
          }
          ?>
        <?php } ?>

        <li class="<?php echo $contact_class; ?>">
          <a href="contact.php">Contact</a>
        </li>

        <?php if (!isLoggedIn()) : ?>
          <li>
            <a href="login.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>