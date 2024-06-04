<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <a href="employees.php" class="btn btn-link">View Employees</a>
        <h1 class="mb-5">Add Employee</h1>

        <?php
            if(isset($_SESSION['error'])){
                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }

            if(isset($_SESSION['success'])){
                echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }
        ?>

        <form action="processes/add-employee-process.php" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <select class="form-select" name="gender" required>
                        <option selected disabled value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="occupation" placeholder="Occupation" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="number" class="form-control" name="income" placeholder="Income" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <select class="form-select" name="married" required>
                        <option selected disabled value="">Select marital status</option>
                        <option value="true">Married</option>
                        <option value="false">Single</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" name="submit" class="btn btn-dark">Add Employee</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>