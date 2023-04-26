<?php 
    //Superglobal
if(isset($_POST['submit'])) {
  $name = array("Samid", "Jane", "Tom", "Peter", "Maria");
  $min = 5;
  $max = 10;

  $username = $_POST['username'];
  $password = $_POST['password'];

  if(strlen($username) < $min && strlen($username) > $max) {
    echo "Username must be longer 5 characters and less than 10!";
  }

  if(!in_array($username, $name)){
    echo "Invalid username";
  } else {
    echo "Welcome";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<form action="form.php" method="post">
    <input type="text" placeholder="Username" name="username">
    <input type="password" placeholder="Password" name="password"><br>
    <input type="submit" name="submit">
</form>




</body>

</html>
