<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "config/db-connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get the posted data
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Create a new employee
        $sql = 'INSERT INTO employees (firstName, lastName, gender, age, occupation, income, married) VALUES (:firstName, :lastName, :gender, :age, :occupation, :income, :married)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        if($stmt->rowCount() > 0){
            echo 'Employee created successfully.';
        }else{
            echo 'Failed to create employee';
        }
}else{
    echo 'Method not allowed.';
}

?>