<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <?php

      if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        if(isset($_SESSION['user_role']) && strtolower($_SESSION['user_role']) == 'admin') {
          $query = "SELECT * FROM posts WHERE post_category_id = $category_id";
        } else {
          $query = "SELECT * FROM posts WHERE post_category_id = $category_id AND post_status = 'Published'";
        }

        $selectAllPosts = mysqli_query($connection, $query);

        checkQuery($selectAllPosts);

        if (mysqli_num_rows($selectAllPosts) < 1) {
          echo "<h1 class='text-center'>No posts avaible!</h1>";
        } else {

          while ($row = mysqli_fetch_assoc($selectAllPosts)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_img = $row['post_img'];
            $post_content = substr($row['post_content'], 0, 200);
      ?>

            <!-- First Blog Post -->
            <h2>
              <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
              by <a href="index.php"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $post_img; ?>" alt="Post image">
            <hr>
            <p><?php echo $post_content . " ..."; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

          <?php } ?>
        <?php } ?>
      <?php } else {
        redirectToAnotherPage("index.php?papge=1");
      }
      ?>

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
        <p>Copyright &copy; Start Coding 2023</p>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </footer>

</div>