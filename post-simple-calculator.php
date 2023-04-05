<?php

$sum = "";

if(isset($_POST['calc'])){
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    $sum = $num1 + $num2;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple POST Calculator</title>
</head>
<body>
    <form action="post-simple-calculator.php" method="POST">
        <input type="text" name="num1" placeholder="Enter first number">
        <input type="text" name="num2" placeholder="Enter second number">
        <button type="submit" name="calc">Calculate</button>
    </form>

    <h1><?php echo $sum; ?></h1>
</body>
</html>