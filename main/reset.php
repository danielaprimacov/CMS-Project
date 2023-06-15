<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php
if(!isset($_GET['email']) && !isset($_GET['token'])) {
    redirectToAnotherPage("index.php?page=1");
} else {
    $email = $_GET['email'];
    $token = $_GET['token'];
}

if ($stmt = mysqli_prepare($connection, 'SELECT user_name, user_email, token FROM users WHERE token=?')) {
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    if(($token !== $token) || ($email !== $user_email)) {
        redirectToAnotherPage("index.php?page=1");
    }

    if(isset($_POST['new-password']) && isset($_POST['confirm-password'])) {
        if($_POST['new-password'] == $_POST['confirm-password']) {
            $message = '';
            $password = $_POST['new-password'];
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashPassword}' WHERE user_email=?")) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                if(mysqli_stmt_affected_rows($stmt) >= 1) {
                    $message = "<div class='alert alert-success' role='alert'>Password changed! Go to <a href='login.php'>Login</a> Page</div>";
                    //redirectToAnotherPage("login.php");
                } else {
                    $message = "<div class='alert alert-danger' role='alert'>Something went wrong</div>";
                }
            }
        } else {
            $message = "<div class='alert alert-warning' role=''alert>Password do not match!</div>";
        }
    }
}
?>

<!-- Page Content -->
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
                                <h5><?php if (isset($_POST['recover-submit'])) {
                                    echo $message; }?></h5>
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input id="new-password" name="new-password" placeholder="Enter your new password" class="form-control" type="password">
                                        </div><br>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>
                                                <input id="confirm-password" name="confirm-password" placeholder="Confirm your new password" class="form-control" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Start Coding 2023</p>
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

</div> <!-- /.container -->