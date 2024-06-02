<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "config/db-connect.php";


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['id'])){
        //Sanitize get request
        $GET = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $GET['id'];
        // Fetch a single employee
        $sql = 'SELECT * FROM employees WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if an employee was found
        if ($employee) {
            // Output the employee as JSON
            echo json_encode($employee);
        } else {
            echo 'Employee not found.';
        }
    }else{
        // Fetch all employees
        $sql = 'SELECT * FROM employees';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any employees were found
        if ($employees) {
            // Output the employees as JSON
            echo json_encode($employees);
        } else {
            echo 'No employees found.';
        }
    }
}else{
    echo 'Method not allowed.';
}



?>