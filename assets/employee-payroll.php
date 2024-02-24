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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Employees Payroll Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
            <form method="post" action="" id="formPayroll">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <select class="form-control search_box  employee_id" id="employee_id" data-live-search="true" >
                        <option value="0" class="disabled">Choose Employee</option>
                        <?php
                            $sql = "SELECT employee_id, firstname FROM employee";
                            $result = mysqli_query($con,$sql);

                            while($row = mysqli_fetch_assoc($result)){?>
                                <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                            <?php }?>
                        </select>
                        <input type="hidden" class="payroll_id">
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="text" class="form-control date_year" id="date_year" disabled value="<?php echo date('Y'); ?>" id="date_year" name=""  placeholder="Date Year" >
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="text" class="form-control date_month" id="date_month" disabled value="<?php echo date('F, m'); ?>" name=""  placeholder="Date Month" >
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3" >
                        <input type="number" class="form-control tax" id="tax" disabled name=""  placeholder="Tax">
                    </div>           
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="number" class="form-control overtime" id="overtime" disabled name="overtime"  placeholder="Overtime" >
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="number" class="form-control bonus" id="bonus" placeholder="Bonus" >
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                    <input type="number" class="gross-salary-fetch form-control mt-lg-4" id="gross-salary-fetch" placeholder="Gross Salary" disabled>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="number" class="form-control allowance mt-lg-4" id="allowance" placeholder="Allowance" >
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 col-12 mb-3">
                        <input type="number" class="form-control net_salary mt-lg-4" id="net_salary" disabled  placeholder="Net Salary" >
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 mb-sm-3 text-lg-center my-1 col-3 mb-3">
                        <label for="" class="mt-lg-4"> Pay Date:</label>
                    </div>
                    <div class="col-lg-3 col-md-10 col-sm-9 mb-sm-3 col-9 mb-3">
                        <input type="Date" class="form-control pay_date mt-lg-4" id="pay_date"  name="pay_date" >
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 col-12">
                        <button type="button" id="payroll-add-button" class="btn-all mt-lg-4 w-100">Add Payroll</button>
                    </div>
                </div>
            </form>
    </div>
</div>
<div class="divider mt-5"></div>

<!-- Navbar  -->

<div class="container-fluid mt-2">
<div class="row department-list">
    <div class="col-lg-7 col-md-6 col-sm-12 mb-sm-3 mt-3 ">
        <h2 >List of Payroll</h2>
    </div>
    <!-- <div class="col-5 d-sm-none d-md-6 d-lg-block d-none me-auto">
        <form>
            <div class="col-12 mt-3 ">
                <input type="text" class="form-control search_payroll" placeholder="Search here by Name & ID">
            </div>
        </form>
    </div> -->
    </div>
</div>

<!-- Table of list -->

<!-- <div class="container-fluid mt-4 ">
        <div id='employee-payroll-table'></div> 
        
</div> -->

<div class="container-fluid mt-4 shadow-lg p-4">
    <!-- <div class=" table-responsive" id="contract-table">
    </div> -->
    <div class="row">
        <div class="col">
        <table class="table table-striped display" id="employee-payroll-table">
        <thead>
            <tr>
               <th scope='col'>#</th>
               <th scope='col'>Name</th>
               <th scope='col'>Last Name</th>
               <th scope='col'>Year</th>
               <th scope='col'>Month</th>
               <th scope='col'>Tax</th>
               <th scope='col'>Overtime</th>
               <th scope='col'>Bonus</th>
               <th scope='col'>Allowance</th>
               <th scope='col'>Net Salary</th>
               <th scope='col'>Pay Date</th>
               <th scope='col'>Action</th>
            </tr>
        </thead>
    </table>
        </div>
    </div>
</div>

<!--  Message Modal -->
<div class="modal fade" id="payroll-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Payroll</h1>
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

<div class="modal fade" id="payroll-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="formPayrollUpdate">
            <div class="row pb-3">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <select class="form-control  employee_id" id="employee_id" >
                    <option value="0" class="disabled">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id, firstname FROM employee";
                        $result = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['firstname']; ?></option>
                        <?php }?>
                    </select>
                    <input type="hidden" class="payroll_id">
                    <input type="hidden" class="tax" id="tax">
                    <input type="hidden" class="overtime" id="overtime">
                    <input type="hidden" class="gross_salary" id="gross_salary">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="number" class="form-control bonus" id="bonus" placeholder="Bonus" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="number" class="form-control allowance" id="allowance" placeholder="Allowance" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="number" class="form-control net_salary" id="net_salary" disabled  placeholder="Net Salary" >
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3 mb-sm-3 text-center my-1">
                    <label for="" class=""> Pay Date:</label>
                </div>
                <div class="col-lg-3 col-md-9 col-sm-9 mb-sm-3">
                    <input type="Date" class="form-control pay_date" id="pay_date"  name="pay_date" >
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-3">
                    <button type="button" id="payroll-update-button" class="btn-all mt-lg-4 w-100">Update Payroll</button>
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
