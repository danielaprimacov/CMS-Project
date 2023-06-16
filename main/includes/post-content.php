<!-- Page Content -->
<?php
if (isset($_POST['liked'])) {
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  
  addLike($user_id, $post_id);
}

if (isset($_POST['unliked'])) {
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];

  unLike($user_id, $post_id);
}
?>

<div class="container">
  <div class="row">
    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

      <?php

      if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];

        $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$the_post_id}";
        $viewQuery = mysqli_query($connection, $view_query);
        checkQuery($viewQuery);

        if (isset($_SESSION['user_role']) && strtolower($_SESSION['user_role']) == 'admin') {
          $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        } else {
          $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'Published'";
        }

        $selectPostById = mysqli_query($connection, $query);
        checkQuery($selectPostById);

        if (mysqli_num_rows($selectPostById) < 1) {
          echo "<h1 class='text-center'>No posts avaible!</h1>";
        } else {

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
            <img class="img-responsive" src="./images/<?php echo placeholderEmptyImage($post_img); ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $post_content; ?></p>

            <hr>

            <div class="row">
              <p class="pull-right"><a class="like" href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-up"></span> Like</a><span id="countLikes"> 0</span></p>
            </div>
            <div class="row">
              <p class="pull-right"><a class="unlike" href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a></p>
            </div>
            <div class="clearfix"></div>





          <?php } ?>
          <!-- Blog Comments -->

          <?php addComment(); ?>

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

          <?php
          $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'Approved' ORDER BY comment_id DESC ";
          $selectApprovedComments = mysqli_query($connection, $query);
          checkQuery($selectApprovedComments);

          while ($row = mysqli_fetch_assoc($selectApprovedComments)) {
            $comment_date = $row['comment_date'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
          ?>

            <!-- Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="Profile image">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author; ?>
                  <small><?php echo $comment_date; ?></small>
                </h4>
                <?php echo $comment_content; ?>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      <?php } else {
        redirectToAnotherPage("index.php?page=1");
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

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  </body>

  </html>

</div>

<script>
  $(document).ready(function() {
    var post_id = <?php echo $post_id; ?>;
    var user_id = 5;

    $('.like').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: "post.php?p_id=<?php echo $post_id; ?>",
        type: 'post',
        data: {
          'liked': 1,
          'post_id': post_id,
          'user_id': user_id
        }
      });
    });
    // <-- Like End

    $('.unlike').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: "post.php?p_id=<?php echo $post_id; ?>",
        type: 'post',
        data: {
          'unliked': 1,
          'post_id': post_id,
          'user_id': user_id
        }
      });
    });
    // <-- Unlike End
  });
</script>