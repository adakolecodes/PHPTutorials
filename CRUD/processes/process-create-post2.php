<?php

//If create button is set/clicked then run all the codes within
if((isset($_POST['create'])) || (isset($_POST['update']))){
    //Start your session
    session_start();
    //Link your database-connect file
    require '../config/db-connect.php';

    //Get inputs from html form.
    $title = $_POST['title'];
    $body = $_POST['body'];
    $id = $_POST['id'];
    $featured_image_name = $_FILES['featured_image']['name'];
    $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];
    $featured_image_size = $_FILES['featured_image']['size'];
    $featured_image_tmp = $_FILES['featured_image']['tmp_name'];
    $featured_image_ext = explode('.', $featured_image_name);
    $featured_image_ext = strtolower(end($featured_image_ext));
    $featured_image_name = time().'.'.$featured_image_ext;
    $target_dir = "../uploads/{$featured_image_name}";

    if(isset($_POST['create'])){

        if(!in_array($featured_image_ext, $allowed_ext)){
            $_SESSION['error'] = "Invalid file type";
            header("Location: ../create-post2.php");
            exit();
        }

        if($featured_image_size > 1000000){ // 1000000 bytes = 1MB
            $_SESSION['error'] = "File too large";
            header("Location: ../create-post2.php");
            exit();
        }

        //Create our sql query statement
        $sql = "INSERT INTO posts_temporal (title, body, featured_image) VALUES (?, ?, ?)";
        //Prepare our statement
        $stmt = $pdo->prepare($sql);
        //Execute our statement
        $result = $stmt->execute([$title, $body, $featured_image_name]);

        move_uploaded_file($featured_image_tmp, $target_dir);

        //If insert is successful then go to posts page after successfully inserting the post else go to create post page
        if($result){
            $_SESSION['success'] = 'Post created successfully';
            header("Location: ../create-post2.php");
        }else{
            $_SESSION['error'] = 'Error creating post';
            header("Location: ../create-post2.php");
        }
    }

    if(isset($_POST['update'])){
        $sql = "UPDATE posts_temporal SET title = ?, body = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$title, $body, $id]);

        if($result){
            $_SESSION['success'] = 'Post updated successfully';
            header("Location: ../create-post2.php");
        }else{
            $_SESSION['error'] = 'Error updating post';
            header("Location: ../create-post2.php");
        }
    }
}