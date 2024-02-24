<?php require_once "php/db.php";
 require_once "partials/sidebar-user.php";
?>

<nav class="navbar navbar-expand-lg header-department">
  <div class="container-fluid">
  <div class="toggle text-white mx-3">
             <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
        </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Time Sheet Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="formProject">
            <div class="row">
                <div class="col-3">
                <?php
                  $res = mysqli_query($con, "SELECT firstname FROM employee WHERE employee_id = {$_SESSION['employee_id']}");
                  $row = mysqli_fetch_assoc($res);?>
                  <input type="text" class="form-control employee_name" value="<?php echo $row['firstname'];?>" id="employee_name" disabled>                    
                  <input type="hidden" class="emp_id" value="<?php echo $_SESSION['employee_id'];?>">
                </div>
                <div class="col-3">
                <select class="form-control poject_name search_box" data-live-search="true" id="project_name">
                        <option class="disabled" value="0">Choose Project</option>
                        <?php
                            $sql = "SELECT assign_project.employee_id,project.project_id,project.project_name FROM assign_project INNER JOIN project on assign_project.project_id = project.project_id WHERE assign_project.employee_id = {$_SESSION['employee_id']}";
                            $res = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($res)){?>
                                <option  value="<?php echo $row['project_id'];?>"><?Php echo $row['project_name'];?></option>
                    <?php } ?>
                    </select>
                </div>
               
                <div class="col-2 text-center ">
                    <label for="" class="my-2">Task Date</label>
                </div>
                <div class="col-4">
                    <input type="date" name="" id="task_date" class="form-control task_date">
                </div>
                <div class="col-12 my-3">
                    <textarea class="form-control  task" placeholder="Details & Task" id="task" cols="70" rows="3"></textarea>
                </div>
                <div class="col-2">
                    <button type="button" id="timesheet-employee-add-button" class="btn-all ">Add Timesheet</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-3">
        <h2 class="">List of Time Sheet</h2>
    </div>
    <div class="col-3">
        <form>
            <div class="col">
                <input type="text" class="form-control search_timesheet" placeholder="Search here by Name & ID" >
            </div>
        </form>
    </div>
    </div>
</div>



<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <div id='employee-timesheet-table'></div>       
</div>

<!--  Message Modal -->
<div class="modal fade" id="employee-timesheet-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Update Modal -->

<div class="modal fade" id="timesheet-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="formUpdateTimesheet">
            <div class="row">
                <div class="col-3">
                    <select class="form-control employee_id" id="employee_id">
                        <option class="disabled" value="0">Choose Employee</option>
                        <?php
                            $sql = "SELECT * FROM employee";
                            $res = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($res)){?>
                                <option  value="<?php echo $row['employee_id'];?>"><?Php echo $row['firstname'];?></option>
                    <?php } ?>
                    </select>
                        <input type="hidden" name="" class="timesheet_id">
                </div>
                <div class="col-3">
                    <select class="form-control project_code" id="project_code">
                        <option class="disabled" value="0">Choose Project</option>
                        <?php
                            $sql = "SELECT * FROM project";
                            $res = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($res)){?>
                                <option  value="<?php echo $row['project_id'];?>"><?Php echo $row['project_name'];?></option>
                    <?php } ?>
                    </select>
                </div>
               
                <div class="col-1 text-center px-2 ">
                    <label for="" class="my-2">Task Date</label>
                </div>
                <div class="col-3">
                    <input type="date" name="" id="task_date" class="form-control task_date">
                </div>
                <div class="col-2">
                    <button type="button" id="" class="btn-all timesheet-update-button">Update</button>
                </div>
                <div class="col-12">
                    <textarea class="form-control mt-2 details" placeholder="Details & Task" id="details" cols="70" rows="3"></textarea>
                </div>
            </div>
        </form>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="js/bs.custom-file.js"></script>

<?php require_once "partials/footer.php"?>;
