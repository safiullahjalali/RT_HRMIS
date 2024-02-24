<?php 
    require_once("php/checkUser.php");
    if(isset($_SESSION['sidebarStatus'])){
        if($_SESSION['sidebarStatus'] == 'supervisor'){
            require_once "partials/sidebar-supervisor.php";
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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Employees Resigns Information</h2>
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
               <select class="form-control employee_id search_box"  id="employee_id"data-live-search='true' >
                    <option value="0" class="disabled">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id, firstname FROM employee";
                        $result = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                        <?php }?>
                    </select>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 mb-sm-3 mb-3 col-3 mt-lg-2 text-center">
                   <label for="#resign_date">Resign Date:</label>
               </div>
               <div class="col-lg-2 col-md-10 col-sm-12 mb-sm-3 mb-3 col-9">   
                   <input type="date" class="form-control" id="resign_date"  placeholder="First Name" aria-label="First name">
               </div>
               <div class="col-lg-2 col-md-3 col-sm-12 mb-sm-3 mb-3 col-4 mt-lg-2 my-3">
                   <label for="#reason">Reason & Details:</label>
               </div>
               <div class="col-lg-4 col-md-9 col-sm-12 mb-sm-3 mb-3 col-8">
                   <textarea name="" class="form-control mx-lg-2" id="reason" cols="2" rows="2"></textarea>
               </div>
               <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 col-12">
                   <button type="button" class="btn-all my-2 w-100" id="add_resign">Add Resign</button>
               </div>
           </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid text-center mt-2">
<div class="row department-list d-flex justify-content-between align-items-center">
    <div class="col-lg-2 col-md-4 col-sm-12 mb-sm-3 mb-3 col-5">
        <h4 class="mt-3">List of Resigns</h4>
    </div>
    <div class="col-3"></div>
    <div class="col-lg-6 col-md-2 col-sm-12 mb-sm-3 mb-2 col-3">
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
    <!-- <div class="col-lg-2 d-lg-block d-md-none d-sm-none d-none mb-sm-3">
        <form>
            <div class="col">
                <input type="text" class="form-control search_resign" placeholder="Search here by Name & ID" aria-label="First name">
            </div>
        </form>
    </div> -->
    </div>
</div>

<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <!-- <div id='employee-resign-table'></div>   -->
        <div class="row">
        <div class="col">
        <table class="table table-striped display" id="employee-resign-table">
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Employee Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Issue Date</th>
            <th scope='col'>Expire Date</th>
            <th scope='col'>Action</th>    
          </tr>
        </thead>
        </table>
        </div>
    </div>
</div>

<!--  Message Modal -->
<div class="modal fade" id="employee-resign-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Employee</h1>
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

<div class="modal fade" id="employee-resign-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="employee-resign-form">
         <div class="row">    
               <div class="col-2">
               <select class="form-control py-4 employee_id" >
                    <option value="0" class="disabled">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id, firstname FROM employee";
                        $result = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                        <?php }?>
                    </select>
                    <input type="hidden" class="resign_id">
               </div>
               <div class="col-3 d-flex align-content-between">
                   <label for="#resign_date">Resign Date:</label>
                   <input type="date" class="form-control resign_date" id="resign_date"  placeholder="First Name" aria-label="First name">
               </div>
               <div class="col-4 d-flex align-content-between">
                   <label for="#reason">Reason & Details:</label>
                   <textarea name="" class="form-control mx-2 reason" id="reason" cols="2" rows="1"></textarea>
               </div>
               <div class="col-3">
                   <button type="button" class="btn-all my-3" id="update_resign">Update Resign</button>
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

<?php require_once "partials/footer.php";
