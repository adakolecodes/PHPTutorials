<?php
// We can pass data through urls and forms using the $_GET and $_POST superglobals.

// echo $_GET['myname'];
// echo $_GET['myage'];


// Check if the button is set
if(isset($_GET['enter'])){
    $myname = $_GET['myname'];
    $myage = $_GET['myage'];

    echo "<h4>My name is {$myname}</h4>";
    echo "<h4>My Age is {$myage}</h4>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET</title>
</head>
<body>
    <a href="get.php?name=James">CLICK TO SHOW NAME</a>

    <form action="get.php" method="GET">
        <input type="text" name="myname" placeholder="Enter your name">
        <input type="text" name="myage" placeholder="Enter your age">
        <button type="submit" name="enter">Enter</button>
    </form>
</body>
</html>