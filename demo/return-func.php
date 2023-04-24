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

function addNumbers($number1, $number2) {
    $sum = $number1 + $number2;
    return $sum;
}

$result1 = addNumbers(1255, 298523);
$result2 = addNumbers(123, 345);

$result = addNumbers($result1, $result2);

echo "The sum is : " . $result;




?>




</body>

</html>