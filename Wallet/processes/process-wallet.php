<?php

if((isset($_POST['fund'])) || (isset($_POST['withdraw']))){
    session_start();

    require_once "../classes/Account.php";

    $POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = $POST['amount'];
    $user_id = $_SESSION['userid'];
    
    $account =  new Account();

    //VALIDATION
    //Validate empty input for amount
    if(empty($amount)){
        $_SESSION['error'] = "Enter an amount";
        header('Location: ../dashboard.php');
        exit();
    }

    if(isset($_POST['fund'])){
        if($account->fundAccount($amount, $user_id)){
            $account->createFundRecord($user_id, $amount);
            $_SESSION['success'] = "Account funded successfully with N$amount";
            header('Location: ../dashboard.php');
        }else{
            $_SESSION['error'] = "Error funding account";
            header('Location: ../dashboard.php');
        }
    }

    if(isset($_POST['withdraw'])){
        //Prevent withdrawing above account balance
        require_once '../config/db-connect.php';
        $accountBalance = $account->getAccountBalance($user_id, $pdo);
        if($accountBalance['balance'] < $amount){
            $_SESSION['error'] = "Insufficient funds in your account to initiate a withdrawal request";
            header('Location: ../dashboard.php');
            exit();
        }

        if($account->withdrawFromAccount($amount, $user_id)){
            $account->createWithdrawalRecord($user_id, $amount);
            $_SESSION['success'] = "Withdrawal initiated successfully";
            header('Location: ../dashboard.php');
        }
    }
}