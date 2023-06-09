<?php

use PHPMailer\PHPMailer\PHPMailer;
?>

<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php require '/xampp/htdocs/CMS-Project/main/main/vendor/autoload.php'; ?>

<?php
if (!isset($_GET['forgot'])) {
    redirectToAnotherPage('index.php?page=1');
}

if (ifItIsMethod('post')) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (emailExists($email)) {
            $stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Configure PHPMailer
                $mail = new PHPMailer();

                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = Config::SMTP_USERNAME;                     //SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = Config::SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient


                // //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Here is the subject';
                $mail->Body    = '<p>Click <a href="http://localhost:8080/CMS-Project/main/main/reset.php?email=' . $email . '&token=' . $token . ' ">Here </a>to change your password</p>';

                if ($mail->send()) {
                    $message = "<div class='alert alert-success' role='alert'>Message was sent! Check your E-mail!</div>";
                    $emailSent = true;
                } else {
                    $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $emailSent = false;
                }

                //echo 'Message has been sent';

            } else {
                $error = mysqli_error($connection);
                echo "<div class='alert alert-danger' role='alert'>$error</div>";
            }
        } else {
            $error = "<div class='alert alert-danger' role='alert'>E-mail does not exist!</div>";
            echo $error;
        }
    }
}
?>


<!-- Page Content -->
<div class="container">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if (!isset($emailSent)) : ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="Enter Your E-mail address" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>
                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                </div><!-- Body-->
                            <?php else : ?>

                                <h2><?php echo $message; ?></h2>

                            <?php endif; ?>
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