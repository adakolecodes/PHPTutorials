<?php
Session_Start();

//Add your database-connect file
require 'database-connect.php';

//Select students from database
$sql = "SELECT * FROM students";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


//EDIT STUDENTS DETAILS
//Set variables to be first empty to prevent error when app starts. When edit button has been set then reassign values of the variables to that selected from db based on the id passed through the get method so that it can be updated.
$update = false;
$name = "";
$gender = "";
$email = "";
$phone = "";

if(isset($_GET['edit'])){
    $id = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $update = true;

    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();
    
    //If no record exists with the parsed id, redirect to add-students.php page else reasign selected values to the variables
    if(!$rowCount > 0){
        header("Location: add-students.php");
    }else{
        $name = $student['name'];
        $gender = $student['gender'];
        $email = $student['email'];
        $phone = $student['phone'];
    }
}


//DELETE STUDENTS
if(isset($_GET['delete'])){
    $id = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: add-students.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Add Students</title>
</head>
<body style="background-color:aliceblue;">

    <div class="container mt-5 mb-5">
        <!-- ADD STUDENTS -->
        <div>
            <h1>Add Students</h1>
            <p>Add students to the students record</p>
            <hr>
        </div>
        <div class="mt-5">
            <div>
                <!-- Display Success message -->
                <h6 class="text-success">
                <?php 
                    if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                    }
                    unset($_SESSION['success']);
                ?>
                </h6>

                <!-- Display error message -->
                <h6 class="text-danger">
                <?php 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                    }
                    unset($_SESSION['error']);
                ?>
                </h6>
            </div>
            <form action="process-add-students.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <select class="form-select" name="gender">
                            <!-- If update is true, show gender of student as the first option, else show "Select Gender..." as first option -->
                            <?php if($update == true){ ?>
                                <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            <?php }else{ ?>
                                <option selected disabled value="">Select Gender...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <!-- We dont want to be able to edit email hence it is unique, therefore we want to hide email input when updating. -->
                        <!-- If update is true, hide email input else show email input -->
                        <?php if($update == true){ ?>
                            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>" hidden>
                        <?php }else{ ?>
                            <input class="form-control" type="email" name="email" placeholder="Enter your email">
                        <?php } ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <!-- We dont want to be able to edit phone hence it is unique, therefore we want to hide phone input when updating. -->
                        <!-- If update is true, hide phone input else show phone input -->
                        <?php if($update == true){ ?>
                            <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>" hidden>
                        <?php }else{ ?>
                            <input class="form-control" type="text" name="phone" placeholder="Enter your phone number">
                        <?php } ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input class="form-control" type="file" name="image" placeholder="Enter your image">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 d-grid gap-2">
                        <!-- If update is true, show update button else show add button -->
                        <?php if($update == true){ ?>
                            <button class="btn btn-warning btn-sm shadow" type="submit" name="update">Update</button>
                            <a href="add-students.php" class="btn btn-danger btn-sm shadow"> Cancel</a>
                        <?php }else{ ?>
                            <button class="btn btn-dark btn-sm shadow" type="submit" name="add">Add</button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
        <hr>

        <!-- VIEW STUDENTS -->
        <div class="mt-5">
            <h1>View Students</h1>
            <p>View students from the students record</p>
            <hr>
        </div>
        <div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $student){ ?>
                        <tr>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['gender']; ?></td>
                            <td><?php echo $student['email']; ?></td>
                            <td><?php echo $student['phone']; ?></td>
                            <td><a href="uploads/<?php echo $student['image']; ?>"><img src="uploads/<?php echo $student['image']; ?>" alt="" width="50" height="50" class="rounded-circle shadow"></a></td>
                            <td>
                                <a href="add-students.php?edit=<?php echo $student['id']; ?>">Edit</a>
                                <a href="add-students.php?delete=<?php echo $student['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>