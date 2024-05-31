<?php

include_once "config/db-connect.php";

// Fetch all employees
$sql = 'SELECT * FROM employees';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll();

// Check if any employees were found
if ($employees) {
    // Output the employees as JSON
    echo json_encode($employees);
} else {
    echo 'No employees found.';
}
?>