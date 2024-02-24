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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Contracts Information</h2>
      <h4 class="d-flex ms-5"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="contract-form">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                    <select class="search_box form-control employee" id="employee" data-live-search="true">
                        <option class="disabled" value="0">Choose Employee</option>
                    
                    <?php
                        $sql = "SELECT employee_id,firstname FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                    <input type="number" class="form-control salary" id="salary" placeholder="Gross Salary">
                    <span class="msgValidation"></span>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-3 col-12 mb-3">
                    <input type="text" name="currency" id="currency" class="form-control currency" value="AFN" disabled>
                    <!-- <select class="form-control currency" disabled id="currency" >
                        <option class="disabled" value="0">Choose Currency</option>
                        <option value="1" selected> Afghani</option>
                         <option value="2"> $ Dollor</option> 
                    </select> -->
                </div>

                <div class="col-lg-1 col-md-2 col-sm-3 mb-sm-3 text-lg-center col-3 mb-3 my-1">
                    <label>Start Date:</label>
                </div>
                
                <div class="col-lg-3 col-md-10 col-sm-9 mb-sm-3 col-9 mb-3">
                    <input type="Date" class="form-control start_date" id="start_date" >
                </div>

                <div class="col-lg-1 col-md-2 col-sm-3 mb-sm-3 col-3 mb-3 my-1">
                    <label class="mt-lg-4">End Date:</label>
                </div>
    
                <div class="col-lg-2 col-md-10 col-sm-9 mb-sm-3 col-9 mb-3">
                    <input type="Date" class="form-control mt-lg-4 end_date" id="end_date" >
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                    <input type="text" class="form-control mt-lg-4 position" id="position" placeholder="Position">
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                    <select class="form-control mt-lg-4 contract_type" id="contract_type">
                        <option value="0">Choose Type</option>
                        <option value="12"> Permanent</option>
                        <option value="6"> fixed-term</option>
                    </select>
                </div>
            <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                <button type="button" class="btn-all mt-lg-4 w-100" id="add_contract">Add Contract</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="divider mt-5"></div>

<div class="container-fluid text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <h2 class="">List of Contracts</h2>
    </div>
    <!-- <div class="col-3">
        <form>
            <div class="col-lg-12 d-lg-block d-md-none d-sm-none d-none">
                <input type="text" class="form-control search_contract" placeholder="Search here by Name & ID">
            </div>
        </form>
    </div> -->
    </div>
</div>
 
<!-- Table of list -->
<!-- <button class="btn btn-warning" id="exportButton">Export To Excel</button> -->
<div class="container-fluid mt-4 shadow-lg p-4">
    <!-- <div class=" table-responsive" id="contract-table">
    </div> -->
    <div class="row">
        <div class="col">
        <table class="table table-striped " id="contract-table">
        <thead>
            <tr>
                <th>ID#</th>
                <th>Employee Name</th>
                <th>Gross Salary</th>
                <th>Currency</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Position</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        </table>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="contract-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contract</h1>
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
<div class="modal fade" id="contract-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Contract</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="contract-update-form">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <select class="form-control employee" id="employee">
                        <option class="disabled" value="0">Choose Employee</option>
                    
                    <?php
                        $sql = "SELECT employee_id,firstname FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                    <input type="hidden" name="" class="contract_id">
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="number" class="form-control salary" id="salary" placeholder="Gross Salary">
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3">
                    <select class="form-control currency" disabled id="currency" >
                        <option class="disabled" value="0">Choose Currency</option>
                        <option value="1"> Afghani</option>
                        <!-- <option value="2"> $ Dollor</option> -->
                    </select>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3">
                    <input type="text" class="form-control  position" id="position" placeholder="Position">
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3">
                    <select class="form-control  contract_type" id="contract_type">
                        <option value="0">Choose Type</option>
                        <option value="12"> Permanent</option>
                        <option value="6"> fixed-term</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-3 mb-sm-3 mt-lg-4  text-center">
                    <label class="my-1">Start Date:</label>
                </div>
                
                <div class="col-lg-3 col-md-9 col-sm-9 mb-sm-3 mt-lg-4">
                    <input type="Date" class="form-control start_date" id="start_date" >
                </div>

                <div class="col-lg-1 col-md-3 col-sm-3 mb-sm-3 mt-lg-4 text-center">
                    <label class="my-1">End Date:</label>
                </div>
    
                <div class="col-lg-3 col-md-9 col-sm-9 mb-sm-3 mt-lg-4">
                    <input type="Date" class="form-control end_date" id="end_date" >
                </div>

                
            <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-3">
                <button type="button" class="btn-all mt-lg-4 w-100" id="update_contract">Update Contract</button>
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
<?php require_once "partials/footer.php";?>
