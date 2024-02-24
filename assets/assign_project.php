<?php require_once "php/db.php";
require_once("php/checkUser.php");
if(isset($_SESSION['sidebarStatus'])){
    if($_SESSION['sidebarStatus'] == "project"){
      require_once "partials/sidebar-project.php";

    }else{
      require_once "partials/sidebar.php";
    }
  }
?>

<nav class="navbar navbar-expand-lg header-department">
  <div class="container-fluid">
  <div class="toggle text-white mx-3">
             <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
        </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Assign Projects Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="formAssignProject">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <select class="form-control employee_id search_box" data-live-search="true" id="employee_id">
                        <option class="disabled" value="0">Choose Employee</option>
                    <?php
                        $sql = "SELECT users.employee_id,employee.firstname FROM users INNER JOIN employee on users.employee_id = employee.employee_id WHERE users.user_level = 10";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <select class="form-control project_id search_box" data-live-search="true" id="project_id">
                        <option class="disabled" value="0">Choose Project</option>
                    <?php
                        $sql = "SELECT project_id,project_name FROM project";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['project_id'];?>"><?php echo $row['project_name'];?></option>
                   <?php } ?>
                    </select>
                </div>

                <div class="col-lg-1 col-md-2 col-sm-3 mb-sm-3 mb-3 col-3  ">
                    <label for="" class="my-2">Start Date</label>
                </div>
                <div class="col-lg-2 col-md-10 col-sm-9 mb-sm-3 mb-3 col-9">
                    <input type="date" name="" id="date_start" class="form-control  date_start">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-3 mb-sm-3 mb-3 col-3 ">
                    <label for="" class="my-2">End Date</label>
                </div>
                <div class="col-lg-2 col-md-10 col-sm-9 mb-sm-3 mb-3 col-9">
                    <input type="date" name="" id="date_end" class="form-control  date_end">
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 mb-3 col-12">
                    <button type="button" id="project-assign-button" class="btn-all w-100">Assign Project</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-5 col-sm-6 mb-sm-3 mb-3 col-7">
        <h4 class="">List of Assigned Projects</h4>
    </div>
    <div class="col-lg-6 col-md-2 col-sm-3 mb-sm-3 mb-3 col-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" >
                <span class="navbar-toggler-icon bg-light"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav text-light">
                    <a class="nav-link dis-link active" aria-current="page" href="employee-visa.php">Employee Visa</a>
                    <a class="nav-link dis-link" href="employee-resign.php">Resign</a>
                    <a class="nav-link dis-link" href="employee-over-time.php">Over Time</a>
                    <a class="nav-link dis-link" href="users.php">Users</a>
                    <a class="nav-link dis-link" href="assign_project.php">Assign Project</a>
                </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- <div class="col-lg-3 d-lg-block d-md-none d-sm-none d-none mb-sm-3">
        <form>
            <div class="col">
                <input type="text" class="form-control search_user" placeholder="Search here by User& ID" >
            </div>
        </form>
    </div> -->
    </div>
</div>



<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <!-- <div id='assign-project-table'></div> -->
        <div class="row">
        <div class="col">
        <table class="table table-striped display" id="assign-project-table">
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Employee Name</th>
                <th scope='col'>Project Name</th>
                <th scope='col'>End Date</th>
                <th scope='col'>Project Cost</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        </table>
        </div>
    </div>
  
</div>

<!--  Message Modal -->
<div class="modal fade" id="assign-project-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div class="modal fade" id="assign-project-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="formUpdateAssignProject">
            <div class="row">
                <div class="col-2">
                    <select class="form-control employee_id" id="employee_id">
                        <option class="disabled" value="0">Choose Employee</option>
                    <?php
                        $sql = "SELECT users.employee_id,employee.firstname FROM users INNER JOIN employee on users.employee_id = employee.employee_id WHERE users.user_level = 10";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                    <input type="hidden" name="" class="assign_id">
                </div>
                
                <div class="col-2">
                    <select class="form-control project_id" id="project_id">
                        <option class="disabled" value="0">Choose Project</option>
                    <?php
                        $sql = "SELECT project_id,project_name FROM project";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['project_id'];?>"><?php echo $row['project_name'];?></option>
                   <?php } ?>
                    </select>
                </div>

                <div class="col-2 text-center ">
                    <label for="" class="my-2">Start Date</label>
                </div>
                <div class="col-2">
                    <input type="date" name="" id="date_start" class="form-control  date_start">
                </div>
                <div class="col-2 text-center ">
                    <label for="" class="my-2">End Date</label>
                </div>
                <div class="col-2">
                    <input type="date" name="" id="date_end" class="form-control  date_end">
                </div>
                <div class="col-2 mt-4">
                    <button type="button" id="update-project-assign-button" class="btn-all ">Update</button>
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
