<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practical Application</title>
</head>

<body>

<?php 

// If Statement with elseif and else to finally display string - I love PHP
if (2 >= 3) {
    echo "I";
} elseif (2 === 3) {
    echo "love";
} else {
    echo "I love PHP" . "<br>";
}

// forloop that displays 10 numbers
for ($i = 0; $i < 10; $i++) {
    echo $i . "<br>";
}

// switch statement that test against one condition with 5 cases
$test = 20;

switch($test) {
    case 10:
        echo "Didn't pass test 1";
        break;
    case 15:
        echo "Didn't pass test 2";
        break;
    case 20:
        echo "Pass test 3";
        break;
    case 25:
        echo "Didn't pass test 4";
        break;
    case 30:
        echo "Didn't pass test 5";
        break;
    default:
        echo "Number is not here";
        break;
}
    

?>




</body>

</html>