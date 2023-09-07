<?php

class Authentication{
    public function getUserByEmail($email){
        include '../config/db-connect.php';
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function createUser($email){
        include '../config/db-connect.php';
        $sql = "INSERT INTO users (email) VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$email]);
        return $result;
    }

    public function createAccount($user_id){
        include '../config/db-connect.php';
        $sql = "INSERT INTO accounts (user_id, balance) VALUES (?, 0)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$user_id]);
        return $result;
    }
}