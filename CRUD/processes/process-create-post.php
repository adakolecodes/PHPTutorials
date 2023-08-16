<?php

//If create or edit button is set/clicked then run all the codes within
if(isset($_POST['create']) || isset($_POST['update'])){
    //Start session so as to make use of session on this page
    session_start();

    //Link your database-connect file
    require '../config/db-connect.php';
    //Link your Blog class
    require '../classes/Blog.php';

    //Create an instance of Blog class
    $blog = new Blog();

    //Get inputs from html form. We are sanitizing the inputs to prevent SQL injection
    $POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = $POST['title'];
    $body = $POST['body'];
    //Get featured_image name and store in the $featured_image_name variable
    $featured_image_name = $_FILES['featured_image']['name'];

    //Creat an array of allowed image extensions and store in the $allowed_ext variable
    $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

    //Get featured image properties from selected image
    //Get featured_image size and store in the $featured_image_size variable
    $featured_image_size = $_FILES['featured_image']['size'];
    //Get temporal directory with name of image that is being uploaded
    //When image is being uploaded, it is first sent to a temporal directory and then moved to the target/final directory (uploads) after a successfull upload
    $featured_image_tmp = $_FILES['featured_image']['tmp_name'];
    //Get featured_image extension and store in the $featured_image_ext variable
    $featured_image_ext = explode('.', $featured_image_name);
    //Convert image extension to lowercase and make usable
    $featured_image_ext = strtolower(end($featured_image_ext));
    /*
    Specify target directory images enter when uploaded.
    We are saving image name as the current time and 
    appending featured image extension to it so as to have a unique image name so as to prevent duplicacy
    */
    $featured_image_name = time().'.'.$featured_image_ext;
    $target_dir = "../uploads/{$featured_image_name}";

    //Run only the code within this isset if create button is set/clicked
    //Create blog post
    if(isset($_POST['create'])){
        //Check if inputs are empty, if it exists then show error message, redirect to add-students.php and exit the script
        if(empty($title) || empty($body)){
            $_SESSION['error'] = "All fields are required";
            header("Location: ../create-post.php");
            exit();
        }

        //Check if post with same title already exists in database before inserting post
        $postExits = $blog->getPostByTitle($title);
        if($postExits){
            $_SESSION['error'] = "Post with same title already exists";
            header("Location: ../create-post.php");
            exit();
        }

        //Validate featured_image type/extension by checking if $featured_image_ext exists in $allowed_ext array
        if(!in_array($featured_image_ext, $allowed_ext)){
            $_SESSION['error'] = "Invalid file type";
            header("Location: ../create-post.php");
            exit();
        }

        //Validate file size by checking if $image_size is greater than 1MB
        if($featured_image_size > 1000000){ // 1000000 bytes = 1MB
            $_SESSION['error'] = "File too large";
            header("Location: ../create-post.php");
            exit();
        }

        //If all validation is passed the insert post into the database
        $result = $blog->createPost([
            'title' => $title,
            'body' => $body,
            'featured_image' => $featured_image_name
        ]);

        //If result is true then show success message, else show error message
        if($result){
            $_SESSION['success'] = "Post created successfully";
            header("Location: ../create-post.php");
        }else{
            $_SESSION['error'] = "Something went wrong";
            header("Location: ../create-post.php");
        }

        //Move uploaded image from temporal directory to target directory
        move_uploaded_file($featured_image_tmp, $target_dir);
    }
}