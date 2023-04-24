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

function greet($name) {
    echo "Hello". " " . $name . "!" . "<br>";
}

greet("Beatrice");


function calculateSum($number1, $number2) {
    $sum = $number1 + $number2;
    echo "The sum of these numbers is : " . $sum;
}

calculateSum(12, 145678);


?>




</body>

</html>