<?php include "db.php"; ?>
<?php

function showData() {
  global $connection;
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query failed');
  }

  while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    echo "<option value='$id'>$id</option>";
  }
}

function readData() {
  global $connection;
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query failed');
  }

}

function updateTable() {
    if (isset($_POST['submit'])) {
      global $connection;
      $username = $_POST['username'];
      $password = $_POST['password'];
      $id = $_POST['id'];

      $query = "UPDATE users SET ";
      $query .= "username = '$username', ";
      $query .= "password = '$password' ";
      $query .= "WHERE id = $id";

      $result = mysqli_query($connection, $query);
      if(!$result) {
        die("Query failed");
      }
   }
}


function deleteUser() {
  if (isset($_POST['submit'])) {
    global $connection;
    $id = $_POST['id'];

    $query = "DELETE FROM users ";
    $query .= "WHERE id = $id";

    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Query failed");
    } else {
      echo "User deleted!";
    }
  }
}


function createUser(){
  global $connection;
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "INSERT INTO users(username, password) ";
  $query .= "VALUES ('$username', '$password')";

  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query failed');
  } else {
    echo "Query created!";
  }

  if(!$username && !$password) {
    echo "Must provide username and password!";
  }
}


?>
