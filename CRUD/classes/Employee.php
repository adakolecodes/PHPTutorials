<?php

class Employee{
    public function getAllEmployees(){
        include "config/db-connect.php";
        $sql = "SELECT * FROM employees";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        //Fetch our result and store it in the $posts variable (fetch is for fetching a single record, while fetchAll is for fetching multiple records)
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $employees;
    }

    public function getTeachersFirstNameAndAge(){
        include "config/db-connect.php";
        $sql = "SELECT firstName, age FROM employees WHERE occupation = 'teacher'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $teachers;
    }

    public function getEmployeesByOccupation($occupation){
        include "config/db-connect.php";
        $sql = "SELECT * FROM employees WHERE occupation = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$occupation]);
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $employees;
    }
}