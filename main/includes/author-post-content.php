<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

      <?php

      if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
        $the_author = $_GET['author'];
      }

      $query = "SELECT * FROM posts WHERE post_author = '{$the_author}'";
      $selectPostByAuthor = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($selectPostByAuthor)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_content = $row['post_content'];
      ?>

        <!-- Blog Post -->

        <!-- Title -->
        <h1><?php echo $post_title; ?></h1>

        <!-- Author -->
        <p class="lead">
          by <?php echo $post_author; ?>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

        <!-- Preview Image -->
        <img class="img-responsive" src="./images/<?php echo $post_img; ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $post_content; ?></p>

      <?php } ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/blog-sidebar.php"; ?>

  </div>
  <!-- /.row -->

  <hr>

  <!-- Footer -->
  <footer>
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright &copy; Star Coding 2023</p>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </footer>

</div>