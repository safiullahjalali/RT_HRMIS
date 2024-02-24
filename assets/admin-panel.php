<?php require_once "php/db.php";
require_once ("php/checkUser.php");
    if(isset($_SESSION['sidebarStatus'])){
        if($_SESSION['sidebarStatus'] == "admin"){
            require_once("partials/sidebar.php");
        }
    }
?>

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
            $sql = "SELECT COUNT(employee_id) as Total from employee";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <div class="numbers"><?php echo $row['Total']; ?></div>
            <?php }
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
            $sql = "SELECT COUNT(department_id) as Total from department";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <div class="numbers"><?php echo $row['Total']; ?></div>
            <?php }
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
            $sql = "SELECT COUNT(visa_id) as Total from employee_visa";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <div class="numbers"><?php echo $row['Total']; ?></div>
            <?php }
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
            $sql = "SELECT COUNT(project_id) as Total from project";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <div class="numbers"><?php echo $row['Total']; ?></div>
            <?php }
            ?>
            <div class="cardName">Projects</div>
        </div>
        <div class="iconBx">
            <i class="fa-solid fa-code-pull-request"></i>
        </div>
    </div>
</div>

<div class="container-fluid">
        <div class="card">
            <div class="card-header fs-5 text-center fw-semibold text-capitalize" style="color:#2a2185;">
                Recently added employees
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead style="background-color:#2a2185; color:white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($con, "SELECT * FROM employee order by employee_id desc");
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><img src="./upload-img-employee/<?php echo $row['photo']; ?>" class="rounded" width="100" height="100"></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="  w-100 m-auto pt-2" style="height:40px;background-color:#eee;color:#888;position:fixed;bottom:0;">
        <p class="ms-5">CopyRights &copy; 2023 |
            Safiullah &quot; Jalali &quot;
        </p>
    </div>
</div>

<?php require_once "partials/footer.php"; ?>