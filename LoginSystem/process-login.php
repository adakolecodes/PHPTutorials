<?php
if(isset($_POST['login'])){
    session_start();
    require "db.php";

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if(empty($email) || empty($password)){
        $_SESSION['error'] = "All fields are required";
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

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