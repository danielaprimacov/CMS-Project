<?php 
    //Superglobal
if(isset($_POST['submit'])) {
    echo "It was submited";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form in PHP</title>
</head>

<body>

<form action="form.php" method="post">
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password"><br>
    <input type="submit" name="submit">
</form>

</body>

</html>