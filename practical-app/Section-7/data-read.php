<?php 
  // Database connection
  $connection = mysqli_connect('localhost', 'root', '', 'favorites');
  if(!$connection) {
    die("Database connetion failed");
  }

  // Read data
  $query = "SELECT * FROM lebensmittel";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query failed');
  }
?>



<?php include "header.php";?>

<div class="container">
  <div class="col-sm-6">
    <?php 

      while($row = mysqli_fetch_assoc($result)) {
        ?>
        <pre>
        <?php 
          print_r($row);  
        ?>
        </pre>
        <?php 
      }

    ?>
  </div>
</div>

<?php include "footer.php";?>