<?php include "db.php";?>
<?php include "functions.php";?>


<?php updateTable();?>

<?php include "includes/header.php";?>

<div class="container">
  <div class="col-sm-6">
    <h1 class="text-center">Update User</h1>
    <form action="login_update.php" method="post"> 
      <div class="form-group">
        <label class="form-label" for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label class="form-label" for="id">Select id: </label>
        <select class="mt-3" name="id" id="">
          <?php
          showData();
          ?>
        </select>
      </div>
      <input class="btn btn-primary mt-3" type="submit" name="submit" value="Update"> 
    </form>
  </div>
</div>



<?php include "includes/footer.php";?>
