<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
  $to = "example@support.com";
  $from = "From: " . $_POST['email'];
  $subject = $_POST['subject'];
  // message
  $body = $_POST['body'];    

  // use wordwrap() if lines are longer than 70 characters
  $subject = wordwrap($subject, 70);
  $body = wordwrap($body, 70);

  // send email
  mail($to, $subject, $body, $from);
}
?>




<!-- Page Content -->
<?php include "includes/contact-content.php"; ?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>