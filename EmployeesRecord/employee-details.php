<?php
session_start();

if(!isset($_GET['id'])){
    header("Location: employees.php");
    exit();
}

require_once "config/db-connect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM employees WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <a href="employees.php" class="btn btn-link">View Employees</a>
        
        <h1 class="mt-5"><?php echo "{$employee['firstName']} {$employee['lastName']}"; ?></h1>

        <p>Gender: <?php echo $employee['gender']; ?></p>
        <p>Age: <?php echo $employee['age']; ?></p>
        <p>Occupation: <?php echo $employee['occupation']; ?></p>
        <p>Income: <?php echo $employee['income']; ?></p>
        <p>Married: <?php echo $employee['married']; ?></p>
    </div>
</body>
</html>