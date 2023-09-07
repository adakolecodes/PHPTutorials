<?php
session_start();
include_once 'classes/Employee.php';
$employeeInstance = new Employee();
$employees = $employeeInstance->getAllEmployees();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Add navbar -->
    <?php include_once 'components/navbar.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="mb-5">
            <h1>Employees</h1>
            <p>Total number of employees is <?= count($employees) ?></p>
        </div>
        <div class="mb-3">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Occupation</th>
                        <th>Income</th>
                        <th>Married</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['firstName'] ?></td>
                        <td><?= $employee['lastName'] ?></td>
                        <td><?= $employee['gender'] ?></td>
                        <td><?= $employee['age'] ?></td>
                        <td><?= $employee['occupation'] ?></td>
                        <td>N<?= $employee['income'] ?></td>
                        <td><?= $employee['married'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <?php 
                $teachers = $employeeInstance->getTeachersFirstNameAndAge();
                var_dump($teachers);

                $employeesByOccupation = $employeeInstance->getEmployeesByOccupation('Teacher');
                var_dump($employeesByOccupation);
            ?>
        </div>
    </div>
</body>
</html>