<?php
session_start();

require_once "config/db-connect.php";

$sql = "SELECT * FROM employees";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <a href="add-employee.php" class="btn btn-link">Add Employee</a>
        <h1 class="mb-5">Employees List</h1>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Occupation</th>
                    <th>Income</th>
                    <th>Married</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employees as $employee){ ?>
                    <tr>
                        <td><?php echo $employee['firstName']; ?></td>
                        <td><?php echo $employee['lastName']; ?></td>
                        <td><?php echo $employee['gender']; ?></td>
                        <td><?php echo $employee['age']; ?></td>
                        <td><?php echo $employee['occupation']; ?></td>
                        <td><?php echo $employee['income']; ?></td>
                        <td><?php echo $employee['married']; ?></td>
                        <td><a href="employee-details.php?id=<?php echo $employee['id']; ?>">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>