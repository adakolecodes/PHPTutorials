<?php
    //Show success message
    if(isset($_SESSION['success'])){
        echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }
    //Show error message
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
?>