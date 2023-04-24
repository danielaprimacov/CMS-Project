<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions in PHP</title>
</head>

<body>

<?php 

function init() {
    $text = "Guten Tag";
    saySomething($text);
}

function saySomething($text) {
    echo $text;
}

?>

<h2><?php init()?></h2>


</body>

</html>