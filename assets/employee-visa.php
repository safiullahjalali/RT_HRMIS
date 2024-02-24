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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Employees Visa Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="visa_form">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-3 mb-3">
                    <select class="search_box form-control employee_id" data-live-search="true" id="employee_id">
                    <option value="0" class="disabled">Choose Employee</option>
                    <?php
                        $sql = "SELECT * FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-3 col-3 mb-sm-3 mb-3 my-2">
                    <label for="expire_date ">Issue Date</label>
                </div>
                <div class="col-lg-2 col-md-10 col-sm-9 col-9 mb-sm-3 mb-3">
                    <input type="date" class="form-control issue_date" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-3 mb-sm-3 mb-3 my-2 text-center">
                    <label for="expire_date">Expire Date</label>
                </div>
                <div class="col-lg-2 col-md-10 col-sm-9 col-9 mb-sm-3 mb-3">   
                    <input type="date" class="form-control expire_date" id="expire_date" required>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 col-12 mb-sm-12">
                    <button type="button" class="btn-all  w-100" id="add_visa">Add Visa</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<!-- Navbar  -->

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-4 col-sm-6 col-4">
        <h4 class="my-auto">List of Visa</h4>
    </div>
    <div class="col-lg-6 col-3 col-md-2 col-sm-2 ms-auto">
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
    <!-- <div class="col-lg-3 d-lg-block d-md-none d-sm-none d-none">
        <form>
            <div class="col">
                <input type="text" class="form-control search_visa" placeholder="Search here by Name & ID">
            </div>
        </form>
    </div> -->
    </div>
</div>

<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <!-- <div id='employee-visa-table'></div> -->
        <div class="row">
        <div class="col">
        <table class="table table-striped display" id="employee-visa-table">
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
<div class="modal fade" id="employee_visa-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div class="modal fade" id="employee-visa-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="employee-visa-form">
            <div class="row">
               
                <div class="col-2">
                    <select class="form-control py-3 employee_id" id="employee_id">
                    <option value="0" class="disabled">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id, firstname FROM employee";
                        $result = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                        <?php }?>
                    </select>
                    <input type="hidden" class="visa_id">
                </div>
                <div class="col-4 d-flex align-content-between">
                    <label for="expire_date">Issue Date</label>
                    <input type="date" class="form-control issue_date" required placeholder="First Name" aria-label="First name">
                </div>
                <div class="col-4 d-flex align-content-between">
                    <label for="expire_date">Expire Date</label>
                     <input type="date" class="form-control expire_date" id="expire_date" required placeholder="Last Name" aria-label="First name"> 
                </div>
                <div class="col-2">
                    <button type="button" class="btn-all my-2" id="update_visa">Update Visa</button>
                </div>
            </div>
        </form></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php require_once "partials/footer.php";?>
<!-- <script>
  $(document).ready(function(){
    $(".search_box").selectpicker();
  })
</script> -->