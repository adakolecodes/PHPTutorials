<?php
session_start();

require "db.php";

if(!isset($_SESSION['id'])){
    $_SESSION['error'] = "You must be logged in to access this page";
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM posts";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Community</title>
</head>
<body style="background-color: aliceblue;">
    <div class="container mt-5 mb-5">
        <div>
            <h1><strong>Community</strong></h1>
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
            <form action="process-community.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3" style="display: none;">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <textarea class="form-control mb-3" name="message" rows="3"></textarea>
                    </div>
                    <div class="col-md-4">
                        <input class="form-control mb-3" type="file" name="attachment" placeholder="Select attachment">
                    </div>
                </div>                    
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-dark btn-sm shadow" type="submit" name="profile">Post</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>