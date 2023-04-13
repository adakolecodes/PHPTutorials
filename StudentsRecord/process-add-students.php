<?php
Session_Start();

//Add your database-connect file
require 'database-connect.php';

//Allowed image types extension
$allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

if(isset($_POST['enter'])){
    
    //Get inputs from html form
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //Get image name
    $image_name = $_FILES['image']['name'];
    //Get image size
    $image_size = $_FILES['image']['size'];
    //Get temporary directory with name of image that is being uploaded
    //When image is being uploaded, it is first sent to a temporal directory 
    //before after successfull upload it is now moved from there to your target directory
    $image_tmp = $_FILES['image']['tmp_name'];
    //Get image extension
    $image_ext = explode('.', $image_name);
    //Convert image extension to lowercase
    $image_ext = strtolower(end($image_ext));
    //Set directory images enter when uploaded
    //We are saving image name as their phone number attached with the current day, month, year and time
    //and appending image extension to it so as to have a unique image name
    $dayInNumber = date("d");
    $monthInNumber = date("m");
    $year = date("Y");
    $time24Hour = date("G");
    $timeMin = date("i");
    $image_name = "{$phone}{$dayInNumber}{$monthInNumber}{$year}{$time24Hour}{$timeMin}.{$image_ext}";
    $target_dir = "uploads/{$image_name}";
    

    //Check if inputs are empty
    if(empty($name) || empty($gender) || empty($email) || empty($phone) || empty($image_name)){
        $_SESSION['error'] = "All fields are required";
        header("Location: add-students.php");
        exit();
    }

    //Check if student email or phone already exists in database before inserting student
    $sql = "SELECT * FROM students WHERE email = ? OR phone = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $phone]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        $_SESSION['error'] = "Email or phone already exists";
        header("Location: add-students.php");
        exit();
    }

    //Validate image type/extension
    if(!in_array($image_ext, $allowed_ext)){
        $_SESSION['error'] = "Invalid file type";
        header("Location: add-students.php");
        exit();
    }

    //Validate file size
    if($image_size > 1000000){ // 1000000 bytes = 1MB
        $_SESSION['error'] = "File too large";
        header("Location: add-students.php");
        exit();
    }


    //Create our sql query statement
    $sql = "INSERT INTO students (name, gender, email, phone, image) VALUES (?, ?, ?, ?, ?)";
    //Prepare our statement
    $stmt = $pdo->prepare($sql);
    //Execute our statement
    $stmt->execute([$name, $gender, $email, $phone, $image_name]);


    //Move uploaded image from temporal directory to target directory
    move_uploaded_file($image_tmp, $target_dir);


    //Show success message if inserted successfully
    if($stmt->rowCount() > 0){
        $_SESSION['success'] = "Successfully added student";
        header("Location: add-students.php");
    }else{
        $_SESSION['error'] = "Failed to add student";
        header("Location: add-students.php");
    }
}

?>