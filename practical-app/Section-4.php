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

// function that return a calculation of 2 numbers
function multiplyNumbers($number1, $number2) {
    $multiply = $number1 * $number2;
    return $multiply;
}

echo multiplyNumbers(123, 567) . "<br>";


// function that passes parameters and call it using parameter values
function greetYou($text) {
    echo "Hi " . $text;
}

greetYou("Mike");
?>




</body>

</html>