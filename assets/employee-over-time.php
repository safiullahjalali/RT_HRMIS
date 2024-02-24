<?php  
    require_once("php/checkUser.php");
    if(isset($_SESSION['sidebarStatus'])){
        if($_SESSION['sidebarStatus'] == 'finance'){
            require_once "partials/sidebar-finance.php";
        }else{
            require_once "partials/sidebar.php";
        }
    }
?>
<?php require_once "php/db.php";?>


<nav class="navbar navbar-expand-lg header-department">
  <div class="container-fluid">
  <div class="toggle text-white mx-3">
             <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
        </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Employees Over Times Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 mb-3 col-12">
                    <select class="form-control employee_id search_box" id="employee_id" data-live-search='true'>
                        <option value="0">Choose Employee</option>
                        <?php
                            $sql = "SELECT * FROM employee";
                            $res = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($res)){?>
                                <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                        <?php } ?>
                    </select>
                   
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <input type="text" class="form-control date_year" id="date_year" disabled  placeholder="Date Year" value="<?php echo date("Y")?>">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <select class="form-control date_month search_box" id="date_month" data-live-search="true">
                        <option value="0" class="disabled">Choose Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <input type="number" class="form-control date_day" id="date_day" max="31" min="0"  placeholder="Date Day 0 - 31">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <input type="number" class="form-control hour" id="hour" min='0' max='24'  placeholder="Hour Day 0 - 24">
                </div>
            <div class="col-lg-2 col-md-6x col-sm-12 mb-sm-3 mb-3 col-12">
                <button type="button" class="btn-all w-100" id="btn-add-overtime">Add Over Time</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>
<!-- Navbar Menu -->
<div class="container-fluid  text-center mt-2">
<div class="row department-list d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-3 col-sm-4 mb-sm-3 mb-3 col-6">
        <h4 class="my-3">List of Over Time</h4>
    </div>
     <div class="col-lg-6 col-md-2 col-sm-2 mb-sm-3 mb-3 col-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
    <!-- <div class="col-lg-3 d-lg-block d-md-none d-sm-none d-none mb-sm-3 ">
        <form>
            <div class="col">
                <input type="text" class="form-control search_overtime" placeholder="Search here by Name & ID" >
            </div>
        </form>
    </div> -->
    </div>
</div>
<!-- End Navbar Menu -->

<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <!-- <div id='overtime-table'></div> -->
        <div class="row">
        <div class="col">
        <table class="table table-striped table-responsive" id="overtime-table">
        <thead>
            <tr>
               <th scope='col'>#</th>
               <th scope='col'>Employee Name</th>
               <th scope='col'>Last Name</th>
               <th scope='col'>Year</th>
               <th scope='col'>Month</th>
               <th scope='col'>Day</th>
               <th scope='col'>Overtime Hours</th>
               <th scope='col'>Action</th>
            </tr>
        </thead>
        </table>
        </div>
    </div>
</div>

<!--  Message Modal -->
<div class="modal fade" id="overtime-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Over Time</h1>
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


<!-- Update Modal  -->

<div class="modal fade" id="overtime-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Over Time</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="overtime-form">
            <div class="row">
                <div class="col-2">
                    <select class="form-control employee_id" id="employee_id">
                        <option value="0">Choose Employee</option>
                        <?php
                            $sql = "SELECT * FROM employee";
                            $res = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($res)){?>
                                <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="" class="overtime_id">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control date_year" id="date_year" disabled  placeholder="Date Year" value="<?php echo date("Y")?>">
                </div>
                <div class="col-2">
                    <select class="form-control date_month" id="date_month">
                        <option value="0" class="disabled">Choose Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-1 text-center my-2">
                    <label for="">Date Day</label>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control date_day" id="date_day" max="31" min="1"  placeholder="Date Day">
                </div>
                <div class="col-1 text-center my-2">
                    <label for=""> Hours</label>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control hour" id="hour" min='1' max='24'  placeholder="Hour Day">
                </div>
            <div class="col-3">
                <button type="button" class="btn-all my-3 btn-modal-update-overtime">Update Overtime</button>
            </div>
            </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<?php require_once "partials/footer.php";
