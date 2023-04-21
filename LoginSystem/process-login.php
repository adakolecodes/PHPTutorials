<?php
if(isset($_POST['login'])){

    //Start session so as to make use of session on this page
    session_start();

    //Link your database-connect file
    require "db.php";

    //Get user inputs from form
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    //Validate for empty inputs
    if(empty($email) || empty($password)){
        $_SESSION['error'] = "All fields are required";
        header("Location: login.php");
        exit();
    }

    //Select email and password from db where the email and password from form corresponds with that in db
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If record exists then login user, else show error message
    if($user){
        $_SESSION['success'] = "Login successful";
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];
        header("Location: dashboard.php");
    }else{
        $_SESSION['error'] = "Invalid credentials";
        header("Location: login.php");
    }
}
?>