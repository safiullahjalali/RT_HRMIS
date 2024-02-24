<?php
    session_start();

    if(!(isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] == true)){
        header("Location:../index.php");
        exit();
    }
?>