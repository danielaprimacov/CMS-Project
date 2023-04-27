<?php 
  // Database connection
  $connection = mysqli_connect('localhost', 'root', '', 'favorites');
  if(!$connection) {
    die("Database connetion failed");
  }

  // Insert data into database
  if(isset($_POST['submit'])) {
    global $connection;
    $category = $_POST['category'];
    $name = $_POST['name'];
    $range = $_POST['range'];

    $query = "INSERT INTO lebensmittel(category, name, level) ";
    $query .= "VALUES ('$category', '$name', '$range')"; 

    $result = mysqli_query($connection, $query);
    if(!$result) {
      die('Query filed!') . mysqli_error($connection);
    } else {
      echo "Query created!";
    }

    if(!$name) {
      echo "Must provide name";
    }
  }
?>


<?php include "header.php";?>

<div class="container">
  <h2 class="text-center">Your Favorite Lebensmittel is:</h2>
  <form action="Section-7.php" method="post">
    <label for="name" class="form-label">Name</label>
    <input class="form-control" type="text" name="name" id="name">
    <label for="category" class="form-label">Category</label>
    <select class="form-control" name="category" id="category">
      <option value="default">----</option>
      <option value="Fruit">Fruit</option>
      <option value="Vegetable">Vegetable</option>
      <option value="Desert">Desert</option>
      <option value="Salted">Salted</option>
      <option value="Homemade">Homemade</option>
    </select>
    <label for="likeRange" class="form-label">How much do you like it?</label>
    <input type="range" class="form-range" id="likeRange" min="0" max="10" step="1" name="range">
    <input class="btn btn-success" type="submit" value="Submit" name="submit">
  </form>

  <a href="data-read.php">Read data</a>
</div>

<?php include "footer.php";?>