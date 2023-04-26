<?php 
    if(isset($_POST['submit'])) {
    $answer = $_POST['answer'];
    if(strtolower($answer) == 'tomorrow') {
        echo "You are right";
    } else {
        echo "Try again!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<h3>What is always coming but never arrives?</h3>

<form action="Section-6.php" method="post">
    <input type="text" placeholder="Your Answer" name="answer"><br>
    <input type="submit" name="submit">
</form>


</body>

</html>