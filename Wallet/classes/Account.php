<?php

class Account{
    public function getAccountBalance($user_id, $pdo){
        $sql = "SELECT * FROM accounts WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        return $account;
    }

    public function fundAccount($amount, $user_id){
        include '../config/db-connect.php';
        $sql = "UPDATE accounts SET balance = balance + ? WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$amount, $user_id]);
        return $result;
    }

    public function createFundRecord($user_id, $amount){
        include '../config/db-connect.php';
        $sql = "INSERT INTO fundings (user_id, amount) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$user_id, $amount]);
        return $result;
    }

    public function withdrawFromAccount($amount, $user_id){
        include '../config/db-connect.php';
        $sql = "UPDATE accounts SET balance = balance - ? WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$amount, $user_id]);
        return $result;
    }

    public function createWithdrawalRecord($user_id, $amount){
        include '../config/db-connect.php';
        $sql = "INSERT INTO withdrawals (user_id, amount) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$user_id, $amount]);
        return $result;
    }

    public function getAllFundingsByUserId($user_id){
        include 'config/db-connect.php';
        $sql = "SELECT * FROM fundings WHERE user_id = ? ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $fundings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fundings;
    }

    public function getAllWithdrawalsByUserId($user_id){
        include 'config/db-connect.php';
        $sql = "SELECT * FROM withdrawals WHERE user_id = ? ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $withdrawals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $withdrawals;
    }
}