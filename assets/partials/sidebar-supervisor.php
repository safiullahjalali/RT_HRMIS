<?php require_once ("php/checkUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Panel</title>
    <link rel="icon" href="img/tab-logo.png">
     <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
     <link rel="stylesheet" href="bootstrap5/css/bootstrap-select.min.css">
     <link rel="stylesheet" href="bootstrap5/all.min.css">
     <link rel="stylesheet" href="bootstrap5/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <style>
        .icon img{
            width:60px; 
            height:60px;
            border-radius: 50%;
        }
        .header{
            text-transform: uppercase;
        }
        .btn-delete-department,
        .btn-delete-leave,
        .btn-delete-employee-visa,
        .dis-link,
        .btn-delete-employee-resign,
        .btn-delete-contract,
        .btn-delete-employee{
            display: none;
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
                        <span class="icon"><img src = "upload-img-employee/<?php echo $_SESSION['photo'];?>"></span>
                        <span class="title header text-center ms-4 pt-3 " >(( <?php echo $_SESSION['name'];?> ))</span>
                    </a>
                </li>
                <li>
                    <a href="supervisor-panel.php">
                        <span class="icon"><i class="fa fa-house"></i></span>
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
                    <a href="department.php">
                        <span class="icon"><i class="fa fa-layer-group"></i></span>
                        <span class="title">Department</span>
                    </a>
                </li>

                <li>
                    <a href="contract.php">
                    <span class="icon"><i class="fa-regular fa-file-lines"></i></span>
                        <span class="title">Contract</span>
                    </a>
                </li>
                
                <li>
                    <a href="employee-visa.php">
                        <span class="icon"><i class="fa-brands fa-cc-visa"></i></span>
                        <span class="title">Employee Visa</span>
                    </a>
                </li>

                <li>
                    <a href="leave-request.php">
                        <span class="icon"><i class="fa-solid fa-hourglass-half"></i></span>
                        <span class="title">Leave Request</span>
                    </a>
                </li>
              
                <li>
                    <a href="employee-resign.php">
                        <span class="icon"><i class="fa fa-file-export"></i></span>
                        <span class="title">Resign</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php?s=2">
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
