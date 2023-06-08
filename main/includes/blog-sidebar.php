<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form> <!--search form-->
        <!-- /.input-group -->
    </div>


    <!-- Login -->
    <?php
    if (isset($_POST['login'])) {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];

        if (!$user_name) {
            $message =  "<div class='alert alert-danger' role='alert'>Username must be provided!</div>";
        } elseif (!$user_password) {
            $message = "<div class='alert alert-danger' role='alert'>Password cannot be empty!</div>";
        } else {
            $user_name = mysqli_real_escape_string($connection, $user_name);
            $user_password = mysqli_real_escape_string($connection, $user_password);

            $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";

            $checkUser = mysqli_query($connection, $query);

            if (!$checkUser) {
                die("Query failed!" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($checkUser)) {
                $db_user_id = $row['user_id'];
                $db_user_name = $row['user_name'];
                $db_user_password = $row['user_password'];
                $db_user_email = $row['user_email'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];

                $user_password = crypt($user_password, $db_user_password);

                if ($user_password !== $db_user_password) {
                    $message = "<div class='alert alert-danger' role='alert'>Password is not correct!</div>";
                } elseif (($user_name === $db_user_name) && ($user_password === $db_user_password)) {
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['user_name'] = $db_user_name;
                    $_SESSION['user_firstname'] = $db_user_firstname;
                    $_SESSION['user_lastname'] = $db_user_lastname;
                    $_SESSION['user_role'] = $db_user_role;

                    $message = '';
                    if (strtolower($_SESSION['user_role']) == 'admin') {
                        echo "<script type='text/javascript'>
                        window.location = 'http://localhost:8080/CMS-Project/main/main/admin/index.php'
                        </script>";
                    } else {
                        echo "<script type='text/javascript'>
                        window.location = 'http://localhost:8080/CMS-Project/main/main/index.php?page=1' 
                        </script>";
                    }
                }
            }
        }
    }
    ?>

    <!--Login  -->
    <div class="well">
        <h4>Login</h4>
        <h6><?php if (isset($_POST['login'])) {
                echo $message;
            } ?></h6>
        <form action="" method="post">
            <div class="form-group">
                <input name="user_name" type="text" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="user_password" placeholder="Password">
            </div>
            <span class="form-group">
                <button name="login" class="btn btn-success" type="submit">Login</button>
                <span>Don't have a profile? Then </span><a href="registration.php">Register</a>
            </span>
        </form> <!--search form-->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <?php
    $query = "SELECT * FROM categories";
    $selectAllCategoriesSidebar = mysqli_query($connection, $query);
    ?>
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($selectAllCategoriesSidebar)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>