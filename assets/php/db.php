<?php
    $LOCALHOST = 'localhost';
    $DB_NAME = "hrsystem";
    $USERNAME = "root";
    $PASSWORD = "";
    $con = mysqli_connect($LOCALHOST,$USERNAME,$PASSWORD,$DB_NAME);
    if(!$con){
        echo "Couldn't connect to database";
    }
?>