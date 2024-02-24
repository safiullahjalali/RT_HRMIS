<?php 
require_once ("php/checkUser.php");
    if(isset($_SESSION['sidebarStatus'])){
        if($_SESSION['sidebarStatus'] == "supervisor"){
            require_once "partials/sidebar-supervisor.php";
        }
    }

 require_once "php/db.php";?>

        <div class="topbar">
            <div class="toggle text-white">
            <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
            </div>
        </div>

        <!-- ============ Cards ============== -->
        <div class="cardBox">
            <div class="card1">
                <div>
                    <?Php
                        $sql = "SELECT COUNT(employee_id) as total from employee";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                    ?>
                    
                    <div class="cardName">Employees</div>
                </div>
                <div class="iconBx">
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>
            <div class="card1">
                <div>
                <?Php
                        $sql = "SELECT COUNT(department_id) as total from department";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                ?>
                    <div class="cardName">Departemnts</div>
                </div>
                <div class="iconBx">
                     <i class="fa fa-layer-group"></i>
                </div>
            </div>
            <div class="card1">
                <div>
                <?Php
                        $sql = "SELECT COUNT(visa_id) as total from employee_visa";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                ?>
                    <div class="cardName">Visa Employees</div>
                </div>
                <div class="iconBx">
                    <i class="fa-brands fa-cc-visa"></i>
                </div>
            </div>
            <div class="card1">
                <div>
                <?Php
                        $sql = "SELECT COUNT(contract_id) as total from contract";
                        $res = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                            echo '<div class="numbers">'.$row['total'].'</div>';
                        }
                ?>
                    <div class="cardName">Contracts</div>
                </div>
                <div class="iconBx">
                     <i class="fa-regular fa-file-lines"></i>
                </div>
            </div>
        </div>
        <div class="  w-100 m-auto pt-2" style="height:40px;background-color:#eee;color:#888;position:fixed;bottom:0;">
    <p class="ms-5">CopyRights &copy; 2023 |
        Safiullah &quot; Jalali &quot;
    </p>
</div>
</div>
    </div>
<?php require_once "partials/footer.php";?>