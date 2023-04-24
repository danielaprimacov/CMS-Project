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

// Using a pre-built math function and print it
echo "2 to power 123 is " . pow(2, 123) . "<br>";

// Using a pre-built string function and print it
$text = "This is a example";
echo str_replace("example", "text", $text) . "<br>";

// Using a pre-built array function and print it
$listNumber = [1, 45, 56, 1, 2, 34, 678, "Hey"];
print_r(array_count_values($listNumber) );

?>




</body>

</html>