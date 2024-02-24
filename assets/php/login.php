<?php
    require_once("db.php");

    if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT users.employee_id,users.user_level,users.username,employee.firstname,employee.photo FROM users INNER JOIN employee on users.employee_id = employee.employee_id WHERE users.username = '{$username}' AND users.password = '{$password}'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['name'] = $row['firstname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['loginStatus'] = true;
                $_SESSION['sidebarStatus'] = "";
                if($row['user_level'] == 1){
                    $_SESSION['sidebarStatus'] = "admin";
                    echo 1;
                }else if($row['user_level'] == 2){
                    $_SESSION['sidebarStatus'] = "supervisor";
                    echo 2;
                }
                else if($row['user_level'] == 4){
                    $_SESSION['sidebarStatus'] = "finance";
                    echo 4;
                }
                else if($row['user_level'] == 8){
                    $_SESSION['sidebarStatus'] = "project";
                    echo 8;
                }
                else{
                    $_SESSION['sidebarStatus'] = "user";
                    echo 10;
                }
        }else
            echo 0;
    }

?>