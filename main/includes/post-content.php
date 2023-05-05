<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

    <?php

    if(isset($_GET['p_id'])) {
      $the_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $selectPostById = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectPostById)) {
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
        by <a href="#"><?php echo $post_author; ?></a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

      <hr>

      <!-- Preview Image -->
      <img class="img-responsive" src="./images/<?php echo $post_img; ?>" alt="">

      <hr>

      <!-- Post Content -->
      <p class="lead"><?php echo $post_content; ?></p>

      <hr>

    <?php } ?>
      <!-- Blog Comments -->

      <?php 
      if(isset($_POST['add_comment'])) {
        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if(!$comment_author) {
          echo "<div class='alert alert-danger' role='alert'>Author must be provided!</div>";
        } elseif(!$comment_email) {
          echo "<div class='alert alert-danger' role='alert'>Email must be provided!</div>";
        } elseif(!$comment_content) {
          echo "<div class='alert alert-danger' role='alert'>Comment cannot be empty!</div>";
        } else {

          $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";

          $addAllComments = mysqli_query($connection, $query);
          if (!$addAllComments) {
            die("Query failed!" . mysqli_error($connection));
          } else {
            echo "<div class='alert alert-success' role='alert'>Comment Successfully Sent!</div>";
          }
        }
      }
      ?>

      <!-- Comments Form -->
      <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="" method="post" role="form">
          <div class="form-group">
            <label class="form-label" for="comment_author">Your name</label>
            <input class="form-control" type="text" name="comment_author">
          </div>
          <div class="form-group">
            <label class="form-label" for="comment_email">Your email</label>
            <input class="form-control" type="email" name="comment_email">
          </div>
          <div class="form-group">
            <label class="form-label" for="comment_content">Your comment</label>
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
          </div>
          <button type="submit" class="btn btn-success" name="add_comment">Add your comment</button>
        </form>
      </div>

      <hr>

      <!-- Posted Comments -->

      <!-- Comment -->
      <div class="media">
        <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
          <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
          </h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
      </div>

      <!-- Comment -->
      <div class="media">
        <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
          <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
          </h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          <!-- Nested Comment -->
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">Nested Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
              </h4>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>
          <!-- End Nested Comment -->
        </div>
      </div>

    </div>



    <!-- Blog Sidebar Widgets Column -->
  <?php include "blog-sidebar.php"; ?>