<?php
if(isset($_POST['register'])){
    session_start();
    require "db.php";

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $_SESSION['error'] = "Email already exists";
        header("Location: register.php");
        exit();
    }

    if(empty($email) || empty($password)){
        $_SESSION['error'] = "All fields are required";
        header("Location: register.php");
        exit();
    }

    if($password != $confirmPassword){
        $_SESSION['error'] = "Passwords do not match";
        header("Location: register.php");
        exit();
    }

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);

    if($stmt->rowCount() > 0){
        $_SESSION['success'] = "Registration Successful";
        header("Location: login.php");
    }else{
        $_SESSION['error'] = "Failed to register";
        header("Location: register.php");
    }
}
?>