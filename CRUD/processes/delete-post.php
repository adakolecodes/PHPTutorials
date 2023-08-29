<?php

if(isset($_GET['id'])){
    //Link your database-connect file
    require '../config/db-connect.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM blog_posts WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("location: ../posts.php");
}
?>