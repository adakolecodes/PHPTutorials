<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Register</title>
</head>
<body style="background-color: aliceblue;">
    <div class="container mt-5 mb-5">
        <div>
            <h1><strong>Register</strong></h1>
            <p>Enter your email and password to register</p>
            <hr>
        </div>
        <div class="mt-5 mb-3">
            <!-- Display Success message stored in the $_SESSION['success'] -->
            <h6 class="text-success">
            <?php 
                if(isset($_SESSION['success'])){
                    echo $_SESSION['success'];
                }
                unset($_SESSION['success']);
            ?>
            </h6>

            <!-- Display error message stored in the $_SESSION['error'] -->
            <h6 class="text-danger">
            <?php 
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                }
                unset($_SESSION['error']);
            ?>
            </h6>
        </div>
        <div>
            <form action="process-register.php" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="email" name="email" placeholder="Enter your email">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="password" name="password" placeholder="Set your password">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-dark btn-sm shadow" type="submit" name="register">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="mt-3">
            <a href="login.php">Login</a>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>