<?php require_once ("php/checkUser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
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
        .btn-delete-employee-timesheet,
        .btn-update-employee-timesheet{
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
                        <span class="icon mt-2"><img src = "upload-img-employee/<?php echo $_SESSION['photo'];?>"></span>
                        <span class="title header text-center ms-4 pt-3 " >(( <?php echo $_SESSION['name'];?> ))</span>
                    </a>
                </li>
                <li>
                    <a href="user-panel.php">
                    <span class="icon"><i class="fa fa-house"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="employee-timesheet.php">
                    <span class="icon"><i class="fa-solid fa-paintbrush"></i></span>
                        <span class="title">Time Sheet</span>
                    </a>
                </li>
                <li>
                    <a href="setting.php?s=10">
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
