<?php
session_start();

require "db.php";

if(!isset($_SESSION['id'])){
    $_SESSION['error'] = "You must be logged in to access this page";
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM profile WHERE user_id = {$_SESSION['id']}";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body style="background-color: aliceblue;">
    <div class="container mt-5 mb-5">
        <div>
            <h1><strong>Profile</strong></h1>
            <p>Set your profile details</p>
            <a href="dashboard.php" class="btn btn-dark btn-sm shadow">Dashboard</a>
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
            <form action="process-profile.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3" style="display: none;">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="fullname" placeholder="Enter your fullname" value="<?php echo $user['fullname']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="username" placeholder="Set a username" value="<?php echo $user['username']; ?>">
                    </div>
                </div>
                <div class="row mb-3" style="display: none;">
                    <div class="col-md-6">
                        <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="phone" placeholder="Enter your phone number" value="<?php echo $user['phone']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-select" name="gender">
                            <?php if($user){ ?>
                                <option value="<?php echo $user['gender']; ?>"><?php echo $user['gender']; ?></option>
                            <?php }else{?>
                                 <option selected disabled value="">Select Gender...</option>
                            <?php }?>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input class="form-control" type="file" name="image" placeholder="Select your image">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-dark btn-sm shadow" type="submit" name="profile">Update profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>