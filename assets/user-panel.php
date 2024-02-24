<?php 
require_once ("php/checkUser.php");
if(isset($_SESSION['sidebarStatus'])){
    if($_SESSION['sidebarStatus'] == "user"){
        require_once "partials/sidebar-user.php";
    }
}
 require_once "php/db.php";?>

<div class="topbar">
    <div class="toggle text-white">
        <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
    </div>
    <h4 class="d-flex ms-5 text-white"><?php echo date("d F Y"); ?>
</div>


        <!-- ============ Cards ============== -->
        <div class="cardBox">
            <div class="card1">
                <div>
                    <?Php
                        $employee_id = $_SESSION['employee_id'];
                        $sql = "SELECT COUNT(timesheet_id) as total from timesheet WHERE employee_id = $employee_id";
                        $res = mysqli_query($con,$sql);
                    ?>
                    <div class="numbers"><?php while($row = mysqli_fetch_assoc($res)){ echo $row["total"]; }?></div>
                    <div class="cardName">Assigned Timesheets</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>
          
        </div>
        <div class="  w-100 m-auto pt-2" style="height:40px;background-color:#eee;color:#888;position:fixed;bottom:0;">
        <p class="ms-5">CopyRights &copy; 2023 |
            Safiullah &quot; Jalali &quot;
        </p>
    </div>
<?php require_once "partials/footer.php";?>