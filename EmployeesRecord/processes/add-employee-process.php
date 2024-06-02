<?php

if(isset($_POST['submit'])){
    session_start();

    include_once "../config/db-connect.php";

    $POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);//Sanitize POST array

    $firstName = $POST['firstName'];
    $lastName = $POST['lastName'];
    $gender = $POST['gender'];
    $age = $POST['age'];
    $occupation = $POST['occupation'];
    $income = $POST['income'];
    $married = $POST['married'];

    //Prevent submission of empty inputs
    if(empty($firstName) || empty($lastName) || empty($gender) || empty($age) || empty($occupation) || empty($income) || empty($married)){
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: ../add-employee.php");
        exit();
    }

    //Insert data into database
    $sql = "INSERT INTO employees (firstName, lastName, gender, age, occupation, income, married) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $gender, $age, $occupation, $income, $married]);

    //Show success or error message if inserted successfully or failed
    if($stmt->rowCount() > 0){
        $_SESSION['success'] = "Employee added successfully";
        header("Location: ../add-employee.php");
    }else{
        $_SESSION['error'] = "Failed to add employee";
        header("Location: ../add-employee.php");
    }

}

?>