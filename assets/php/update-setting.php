<?php require_once("db.php"); 

if(isset($_POST['action']) && $_POST['action'] == 'updateUser'){
    $employee_id = $_POST['employee_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "UPDATE users SET 
        username = '{$username}',
        password = '{$password}'
        WHERE employee_id = {$employee_id}";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}








?>