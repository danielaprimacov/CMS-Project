<?php

$name = "SomeName";
$value = 100;
$expire = time() + (60 * 60 * 24 * 7);

setcookie($name, $value, $expire);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>

<body>



</body>

</html>