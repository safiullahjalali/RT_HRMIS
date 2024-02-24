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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Leave Requests Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="leave-request-form">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 mb-3">
                    <select class="form-control employee search_box" id="employee" data-live-search="true">
                        <option class="disabled" value="0">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id,firstname FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 mb-sm-3 my-1 col-4 mb-3">
                    <label class="ps-lg-4">Request Date:</label>
                </div>
                
                <div class="col-lg-2 col-md-9 col-sm-8 mb-sm-3 col-8 mb-3">
                    <input type="Date" class="form-control request_date" id="request_date" >
                </div>
                <div class="col-lg-1 col-md-3 col-sm-4 mb-sm-3 my-1 col-4 mb-3">
                    <label>Start Date:</label>
                </div>
                
                <div class="col-lg-2 col-md-9 col-sm-8 mb-sm-3 col-8 mb-3">
                    <input type="Date" class="form-control start_date" id="start_date" >
                </div>

                <div class="col-lg-1 col-md-3 col-sm-4 mb-sm-3 my-1 col-4 mb-3">
                    <label>End Date:</label>
                </div>
    
                <div class="col-lg-2 col-md-9 col-sm-8 mb-sm-3 col-8 mb-3">
                    <input type="Date" class="form-control end_date" id="end_date" >
                </div>

                <div class="col-lg-10 col-md-12 col-sm-12 mb-sm-3 mb-3">
                    <textarea id="remark" class="mt-lg-4 form-control py-lg-3 remark" cols="90" rows="4" placeholder="Remark & Reason"></textarea>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3">
                    <button type="button" class="btn-all w-100 mt-lg-4" id="add_leave">Add Leave</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="divider mt-5"></div>

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
        <h2 class="">List of Leave Requests</h2>
    </div>
    <!-- <div class="col-3">
        <form>
            <div class="col d-lg-block d-sm-none d-md-none d-none">
                <input type="text" class="form-control search_leave" placeholder="Search here by Name & ID">
            </div>
        </form>
    </div> -->
    </div>
</div>

<!-- Table of list -->

<div class="container mt-4 ">
        <!-- <div id='leave-request-table'></div> -->
        <div class="row">
        <div class="col">
        <table class="table table-striped display" id="leave-request-table">
        <thead>
        <tr>
             <th scope='col'>#</th>
             <th scope='col'>Employee Name</th>
             <th scope='col'>Request Date</th>
             <th scope='col'>Start Date</th>
             <th scope='col'>End Date</th>
             <th scope='col'>Remark & Reason</th>
             <th scope='col'>Action</th>
             </tr>
        </thead>
        </table>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="leave-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Request</h1>
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
<div class="modal fade" id="leave-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Leave Request</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="leave-request-form">
            <div class="row">
                <div class="col-2">
                    <select class="form-control employee" id="employee">
                        <option class="disabled" value="0">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id,firstname FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                    <input type="hidden" class="request_id">
                </div>

                <div class="col-2 my-1">
                    <label class="ps-4">Request Date:</label>
                </div>
                
                <div class="col-2">
                    <input type="Date" class="form-control request_date" id="request_date" >
                </div>
                <div class="col-2 my-1 ps-2 text-center">
                    <label class="px-2">Start Date:</label>
                </div>
                
                <div class="col-2">
                    <input type="Date" class="form-control start_date" id="start_date" >
                </div>

                <div class="col-1 my-1">
                    <label class="mt-4">End Date:</label>
                </div>
    
                <div class="col-2">
                    <input type="Date" class="form-control end_date mt-4" id="end_date" >
                </div>
                
                <div class="col-12">
                    <textarea id="remark" class="mt-4 form-control py-3 remark" cols="90" rows="4" placeholder="Remark & Reason"></textarea>
                </div>
                <div class="col-2">
                    <button type="button" class="btn-all mt-4 update-leave" id="">Update Leave</button>
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