<?php
if(isset($_POST['profile'])){
    
    //Start session so as to make use of session on this page
    session_start();

    //Link your database-connect file
    require "db.php";

    //Creat an array of allowed image extensions and store in the $allowed_ext variable
    $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

    //Get user inputs from form
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Get image name and store in the $image_name variable
    $image_name = $_FILES['image']['name'];

    //If image input ($image_name) is not empty then get image properties from selected image
    if(!empty($image_name)){
        //Get image size and store in the $image_size variable
        $image_size = $_FILES['image']['size'];
        //Get temporary directory with name of image that is being uploaded
        //When image is being uploaded, it is first sent to a temporal directory and then moved to the target/final directory (uploads) after a successfull upload
        $image_tmp = $_FILES['image']['tmp_name'];
        //Get image extension and store in the $image_ext variable
        $image_ext = explode('.', $image_name);
        //Convert image extension to lowercase and make usable
        $image_ext = strtolower(end($image_ext));
        /*
        Specify target directory images enter when uploaded.
        We are saving image name as their phone number attached with the current day, month, year and time
        and appending image extension to it so as to have a unique image name so as to prevent duplicacy
        */
        $dayInNumber = date("d");
        $monthInNumber = date("m");
        $year = date("Y");
        $time24Hour = date("G");
        $timeMin = date("i");
        $timeSecs = date("s");
        $image_name = "{$phone}{$dayInNumber}{$monthInNumber}{$year}{$time24Hour}{$timeMin}{$timeSecs}.{$image_ext}";
        $target_dir = "uploads/{$image_name}";
    }


    //Validate for empty inputs
    if(empty($user_id) || empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($gender)){
        $_SESSION['error'] = "All fields are required";
        header("Location: profile.php");
        exit();
    }

    //Check if profile has been inserted before
    $sql = "SELECT * FROM profile WHERE user_id = $user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If profile has been inserted into the profile table already then update the profile
    if($user){
        //If $image_name variable is empty (that is if no image is selected) then update profile without image
        if(empty($image_name)){
            $sql = "UPDATE profile SET fullname = ?, username = ?, phone = ?, gender = ? WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$fullname, $username, $phone, $gender, $user_id]);

            if($stmt->rowCount() > 0){
                $_SESSION['success'] = "Profile updated successfully";
                header("Location: profile.php");
            }else{
                $_SESSION['error'] = "No changes made";
                header("Location: profile.php");
            }
        //If $image_name variable is not empty (that is if an image is selected) then update profile with image
        }else{
            //Validate image type/extension by checking if $image_ext exists in $allowed_ext array
            if(!in_array($image_ext, $allowed_ext)){
                $_SESSION['error'] = "Invalid file type";
                header("Location: profile.php");
                exit();
            }

            //Validate file size by checking if $image_size is greater than 1MB
            if($image_size > 1000000){ // 1000000 bytes = 1MB
                $_SESSION['error'] = "File too large";
                header("Location: profile.php");
                exit();
            }
            
            $sql = "UPDATE profile SET fullname = ?, username = ?, phone = ?, gender = ?, image = ? WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$fullname, $username, $phone, $gender, $image_name, $user_id]);

            move_uploaded_file($image_tmp, $target_dir);

            if($stmt->rowCount() > 0){
                $_SESSION['success'] = "Profile updated successfully";
                header("Location: profile.php");
            }else{
                $_SESSION['error'] = "Failed to update profile";
                header("Location: profile.php");
            }
        }
    //If profile has not been inserted into the profile table then insert it
    }else{
        $sql = "INSERT INTO profile (user_id, fullname, username, email, phone, gender, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $fullname, $username, $email, $phone, $gender, $image_name]);

        move_uploaded_file($image_tmp, $target_dir);

        if($stmt->rowCount() > 0){
            $_SESSION['success'] = "Profile created successfully";
            header("Location: profile.php");
        }else{
            $_SESSION['error'] = "Failed to create profile";
            header("Location: profile.php");
        }
    }
}
?>