<div class="container" style="height: 80vh; position: relative; ">
  <div style="height: 60vh; position: absolute; margin: auto; top: 0; left:0; bottom: 0; right: 0; overflow: hidden; ">
    <section id="login">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
              <h1>Contact Me</h1>
              <h5><?php if (isset($_POST['submit'])) {
                    echo $message;
                  } ?></h5>
              <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                <div class="form-group">
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                </div>
                <div class="form-group">
                  <label for="subject" class="sr-only">Subject</label>
                  <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                </div>
                <div class="form-group">
                  <label for="body" class="sr-only">Your Message</label>
                  <textarea type="text" name="body" id="body" class="form-control" placeholder="Enter Your Message" ></textarea>
                </div>

                <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Send Message">
              </form>

            </div>
          </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
      </div> <!-- /.container -->
    </section>

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
  </div>
</div>