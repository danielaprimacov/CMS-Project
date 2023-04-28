<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



<?php 

// Make a variable with some text as value

$text = "helloeverybody";

// Use crypt() function to encrypt it

$hashFormat = "$2y$10$";
$salt = "iusesomecrazycharacters";

$hash_salt = $hashFormat . $salt;

$text = crypt($text, $hash_salt);

//  Print encrypted variable

echo $text;

?>




</body>

</html>