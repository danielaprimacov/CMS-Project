<?php
if (isset($_GET['language']) && !empty($_GET['language'])) {
    $_SESSION['language'] = $_GET['language'];

    if (isset($_SESSION['language']) && $_SESSION['language'] != $_GET['language']) {
        echo "<script type='text/javascript'>location.reload(); </script>"; // refresh page
    }
}

if (isset($_SESSION['language'])) {
    include "includes/languages/" . $_SESSION['language'] . ".php";
} else {
    include "includes/languages/en.php";
}

?>

<div class="container" style="height: 80vh; position: relative; ">
    <div style="height: 50vh; position: absolute; margin: auto; top: 0; left:0; bottom: 0; right: 0; overflow: hidden; ">
        <form action="" class="navbar-form navbar-right" method="get" id="language_form">
            <div class="form-group">
                <select class="form-control" name="language" onchange="changeLanguage()">
                    <option value="en" <?php if (isset($_SESSION['language']) && $_SESSION['language'] == 'en') {
                                            echo "selected";
                                        } ?>>English</option>
                    <option value="ru" <?php if (isset($_SESSION['language']) && $_SESSION['language'] == 'ru') {
                                            echo "selected";
                                        } ?>>Russian</option>
                    <option value="de" <?php if (isset($_SESSION['language']) && $_SESSION['language'] == 'de') {
                                            echo "selected";
                                        } ?>>Deutsch</option>
                </select>
            </div>
        </form>
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1><?php echo _REGISTER; ?></h1>
                            <h5><?php if (isset($error['username'])) {
                                    echo $error['username'];
                                } elseif (isset($error['email'])) {
                                    echo $error['email'];
                                } elseif (isset($error['password'])) {
                                    echo $error['password'];
                                } else {
                                    echo '';
                                }
                                ?></h5>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>

                                    <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" autocomplete="on" value="<?php echo isset(
                                                                                                                                                                    $username
                                                                                                                                                                ) ? $username
                                                                                                                                                                    : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" autocomplete="on" value="<?php echo isset(
                                                                                                                                                                    $email
                                                                                                                                                                ) ? $email
                                                                                                                                                                    : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
                <!-- Footer -->
                <footer>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; Start Coding 2023</p>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </footer>
            </div> <!-- /.container -->
        </section>


    </div>
</div>

<script>
    function changeLanguage() {
        document.getElementById('language_form').submit();
    }
</script>