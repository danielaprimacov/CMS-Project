<?php 

if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $connection = mysqli_connect('localhost', 'root', '', 'loginapp');
  if($connection) {
    echo "Connected";
  } else {
    die("Database connetion failed");
  }

  $query = "INSERT INTO users(username, password) ";
  $query .= "VALUES ('$username', '$password')";

  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query failed');
  }

  if($username && $password) {
    echo "";
  } else {
    echo "Must provide username and password!";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Login App</title>
</head>

<body>

<div class="container">
  <div class="col-sm-6">
    <form action="login_create.php" method="post"> 
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <input class="btn btn-primary" type="submit" name="submit" value="Submit"> 
    </form>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>