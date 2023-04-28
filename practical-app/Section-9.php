<?php session_start(); // start a session

print_r($_GET);

// Set cookie
$name = "CoolCookie";
$value = 123455;
$expire = time() + (60 * 60 * 24 * 7); // expires in one week

setcookie($name, $value, $expire); // setting cookie

// Set value to session
$_SESSION['value'] = "Hello Everybody!"; 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practical Application 9</title>
</head>

<body>

<?php

$inf = 321;

?>

<!-- Create a link and use GET to see the parameters of it-->
<a href="Section-9.php?id=<?php echo $inf; ?>">Click Here</a><br>

<!-- Print cookie -->
<?php 
    if(isset($_COOKIE['CoolCookie'])) {
        echo $_COOKIE['CoolCookie'] . "<br>";
    }
    echo $_SESSION['value'];
 ?>


</body>

</html>