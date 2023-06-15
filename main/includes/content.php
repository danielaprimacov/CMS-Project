<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            // Pagination
            if (isset($_GET['page'])) {
                $per_page = 5;

                $page = $_GET['page'];
            } else {
                $page = " ";
            }

            if ($page = " " || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            if (isset($_SESSION['user_role']) && strtolower($_SESSION['user_role']) == 'admin') {
                $countPostQuery = "SELECT * FROM posts";
            } else {
                $countPostQuery = "SELECT * FROM posts WHERE post_status = 'Published'";
            }

            $countPost = mysqli_query($connection, $countPostQuery);
            checkQuery($countPost);

            $countPosts = mysqli_num_rows($countPost);

            if ($countPosts < 1) {
                echo "<h1 class='text-center'>No posts avaible!</h1>";
            } else {
                $countPosts = ceil($countPosts / $per_page);

                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                $selectAllPosts = mysqli_query($connection, $query);

                checkQuery($selectAllPosts);

                while ($row = mysqli_fetch_assoc($selectAllPosts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_img = $row['post_img'];
                    $post_content = substr($row['post_content'], 0, 200);
                    $post_status = $row['post_status'];

            ?>
                    <!-- Blog Post -->
                    <h1>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h1>
                    <p class="lead">
                        by <a href="author-post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="./images/<?php echo placeholderEmptyImage($post_img); ?>" alt="Post image"></a>
                    <hr>
                    <p><?php echo $post_content . " ..."; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                <?php } ?>

            <?php } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/blog-sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
            <?php
            for ($i = 1; $i <= $countPosts; $i++) {
                if ($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

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