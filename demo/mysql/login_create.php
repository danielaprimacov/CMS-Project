<?php include "db.php"; ?>
<?php include "functions.php"; 

if(isset($_POST['submit'])) {
  createUser();
}

?>

<?php include "includes/header.php";?>

<div class="container">
  <div class="col-sm-6">
    <h1 class="text-center">Create User</h1>
    <form action="login_create.php" method="post"> 
      <div class="form-group">
        <label class="form-label" for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <input class="btn btn-primary mt-3" type="submit" name="submit" value="Create"> 
    </form>
  </div>
</div>

<?php include "includes/footer.php";?>

