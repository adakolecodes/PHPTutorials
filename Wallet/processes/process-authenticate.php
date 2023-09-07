<?php

if((isset($_POST['register'])) || (isset($_POST['login']))){
    session_start();

    require_once "../classes/Authentication.php";

    $POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $POST['email'];
    
    $authentication =  new Authentication();
    $user = $authentication->getUserByEmail($email);

    if(isset($_POST['register'])){
        //VALIDATION
        //Validate Email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "Enter a valid email";
            header('Location: ../register.php');
            exit();
        }
        //Check if email already exists in db
        if($user){
            $_SESSION['error'] = "Email already exists";
            header('Location: ../register.php');
            exit();
        }

        //Create user
        if($authentication->createUser($email)){
            $user = $authentication->getUserByEmail($email);
            $user_id = $user['id'];
            $authentication->createAccount($user_id);
            $_SESSION['success'] = "User created successfully";
            header('Location: ../register.php');
        }else{
            $_SESSION['error'] = "User could not be created";
            header('Location: ../register.php');
        }
    }

    if(isset($_POST['login'])){
        //VALIDATION
        //Validate Email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "Enter a valid email";
            header('Location: ../login.php');
            exit();
        }

        if($user){
            $_SESSION['userid'] = $user['id'];
            $_SESSION['useremail'] = $user['email'];
            $_SESSION['success'] = "User logged in successfully";
            header('Location: ../dashboard.php');
        }else{
            $_SESSION['error'] = "User could not be logged in";
            header('Location: ../login.php');
        }
    }
}