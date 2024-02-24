<?php require_once ("php/checkUser.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="img/tab-logo.png">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap-select.min.css">
     <link rel="stylesheet" href="bootstrap5/all.min.css">
     <link rel="stylesheet" href="bootstrap5/fontawesome.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .icon img{
            width:60px; 
            height:60px;
            border-radius: 50%;
        }
        .header{
            text-transform: uppercase;
        }
   
    </style>
</head>
<body>
    <!-- ============== Navigaiton ================= -->
    <div class="content">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                    <span class="icon mt-2"><img src = "img/logo.png" width="150" height="150"></span>
                        <!-- <span class="icon"><img src = "upload-img-employee/<?php //echo $_SESSION['photo'];?>"></span> -->
                        <!-- <span class="title header text-center ms-4 pt-3 " >(( <?php //echo $_SESSION['name'];?> ))</span> -->
                        <span class="title header text-center  pt-3 " >ROOT TECH</span>
                    </a>
                </li>
               <div class="divider bg-white mb-1" style="height:2px;width:100%"> </div>
                <li>
                    <a href="admin-panel.php">
                        
                        <span class="icon"><i class="fa fa-house"></i></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="employee.php">
                        <span class="icon"><i class="fa-regular fa-circle-user"></i></span>
                        <span class="title">Employee</span>
                    </a>
                </li>

                <li>
                    <a href="contract.php">
                        <span class="icon"><i class="fa-regular fa-file-lines"></i></span>
                        <span class="title">Contract</span>
                    </a>
                </li>

                <li>
                    <a href="employee-payroll.php">
                        <span class="icon"><i class="fa-solid fa-money-bill-wave"></i></span>
                        <span class="title">Payroll</span>
                    </a>
                </li>

                <li>
                    <a href="department.php">
                        <span class="icon"><i class="fa fa-layer-group"></i></span>
                        <span class="title">Department</span>
                    </a>
                </li>
                <li>
                    <a href="project.php">
                        <span class="icon"><i class="fa-solid fa-code-pull-request"></i></span>
                        <span class="title">Project</span>
                    </a>
                </li>
                <li>
                    <a href="leave-request.php">
                        <span class="icon"><i class="fa-solid fa-hourglass-half"></i></span>
                        <span class="title">Leave Request</span>
                    </a>
                </li>
                <li>
                    <a href="timesheet.php">
                        <span class="icon"><i class="fa-solid fa-paintbrush"></i></span>
                        <span class="title">Time Sheet</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php?s=1">
                        <span class="icon"><i class="fa fa-gear"></i></span>
                        <span class="title">Setting</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php?logout=true">
                    <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
         <!-- ============= Main ============ -->
    <div class="main">
