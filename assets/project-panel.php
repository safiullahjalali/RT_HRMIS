<?php
require_once ("php/checkUser.php");
if(isset($_SESSION['sidebarStatus'])){
    if($_SESSION['sidebarStatus'] == "project"){
        require_once("partials/sidebar-project.php");
    }
}
 require_once "php/db.php"; ?>

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
    <div class="card1">
        <div>
            <?Php
            $sql = "SELECT COUNT(assign_project_id) as Total from assign_project";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <div class="numbers"><?php echo $row['Total']; ?></div>
            <?php }
            ?>
            <div class="cardName">Assign Projects</div>
        </div>
        <div class="iconBx">
            <i class="fa-solid fa-people-arrows"></i>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header fs-5 text-center fw-semibold text-capitalize" style="color:#2a2185;">
            Recently added Timesheets
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead style="background-color:#2a2185; color:white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Recently Task</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT timesheet.timesheet_id,timesheet.timesheet_date,timesheet.task,employee.firstname,project.project_name FROM ((timesheet 
                    INNER JOIN project ON timesheet.project_id = project.project_id)
                    INNER JOIN employee ON timesheet.employee_id = employee.employee_id) order by timesheet.timesheet_id DESC
                    ";
                    $res = mysqli_query($con,$sql);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['timesheet_id']; ?></th>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td><?php echo $row['timesheet_date']; ?></td>
                            <td><?php echo $row['task']; ?></td>
                            
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