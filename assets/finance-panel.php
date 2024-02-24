<?php 
require_once ("php/checkUser.php");
if(isset($_SESSION['sidebarStatus'])){
    if($_SESSION['sidebarStatus'] == "finance"){
        require_once "partials/sidebar-finance.php";
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
                        $sql = "SELECT COUNT(payroll_id) as total from payroll";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                ?>
                    <div class="cardName">Payrolls</div>
                </div>
                <div class="iconBx">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="card1">
                <div>
                <?Php
                        $sql = "SELECT COUNT(overtime_id) as total from overtime";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                ?>
                    <div class="cardName">Overtimes</div>
                </div>
                <div class="iconBx">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>

        </div>
        <div class="  w-100 m-auto pt-2" style="height:40px;background-color:#eee;color:#888;position:fixed;bottom:0;">
        <p class="ms-5">CopyRights &copy; 2023 |
            Safiullah &quot; Jalali &quot;
        </p>
    </div>
<?php require_once "partials/footer.php";?>