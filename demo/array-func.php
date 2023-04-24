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

$list = [344, 234, 567, 897, 5678];

echo "Maximal value of the array is " . max($list) . "<br>";

echo "Minimal value of the array is " . min($list) . "<br>";

sort($list);

print_r($list);

?>




</body>

</html>