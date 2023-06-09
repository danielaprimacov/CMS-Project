<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <?php

      if (isset($_POST['submit'])) {
          $search = $_POST['search'];

          $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
          $search_query = mysqli_query($connection, $query);

          if (!$search_query) {
              die("Query failed!" . mysqli_error($connection));
          }

          $count = mysqli_num_rows($search_query);
          if ($count == 0) {
              echo "<h1>No result!</h1>";
          } else {
            
            while ($row = mysqli_fetch_assoc($search_query)) {
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_img = $row['post_img'];
              $post_content = $row['post_content'];
            ?>

              <h1 class="page-header">
                Results for
                <small><?php echo $search; ?></small>
              </h1>

              <!-- First Blog Post -->
              <h2>
                <a href="#"><?php echo $post_title; ?></a>
              </h2>
              <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
              </p>
              <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
              <hr>
              <img class="img-responsive" src="./images/<?php echo $post_img; ?>" alt="Post image">
              <hr>
              <p><?php echo $post_content; ?></p>
              <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

              <hr>

            <?php } ?>              
          <?php

          }
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
        <p>Copyright &copy; Star Coding 2023</p>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </footer>

</div>