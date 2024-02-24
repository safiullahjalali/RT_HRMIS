<?php require_once "php/db.php";?>
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


<nav class="navbar navbar-expand-lg header-department">
  <div class="container-fluid">
  <div class="toggle text-white mx-3">
             <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
        </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Employees Information</h2>
      <h4 class="d-flex ms-5"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="formEmployee" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="text" class="form-control mt-lg-2 mb-sm-2" onkeydown="return /[a-zA-Z\s]/.test(event.key)" pattern="[a-zA-Z\s]+" required
                     id="emp-fname" name="fname"  placeholder="First Name" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="text" class="form-control mt-lg-2 my-md-0 my-sm-2" onkeydown="return /[a-zA-Z\s]/.test(event.key)" pattern="[a-zA-Z\s]+" required
                    id="emp-lname" name="lname" placeholder="Last Name" >
                </div>
                 <div class="col-lg-4 col-md-12 col-sm-12 my-md-2 mb-sm-3 mb-3">
                    <div class="input-group ">
                        <label class="input-group-text" for="emp-file">Select Image</label>
                        <input type="file" class="form-control emp-photo" id="emp-file" name="emp_image" >
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="email" class="form-control my-md-2 my-sm-2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required
                     id="emp-email" name="email"  placeholder="Email" >
                </div>
               <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="tel" class="form-control my-md-2 my-sm-2" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" required id="emp-phone" name="phone"  placeholder="Phone" >
                </div>
              <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="number" class="form-control mt-lg-4 my-md-2 my-sm-2" min="1960" max='3000' id="emp-bod" name="bod"  placeholder="Birth Year" >
                </div>
                 <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <select class="form-control mt-lg-4 my-md-2 my-sm-2" id="emp-type" name="emp_type">
                        <option class="disabled" value="0">Choose Type</option>
                        <option value="100" >Foreign</option>
                        <option value="101">Local</option>
                    </select>
                </div>
                 <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <select class="form-control mt-lg-4 my-md-2 my-sm-2 " id="emp-degree" name="emp_degree">
                        <option class="disabled" value="0">Choose Degree</option>
                        <option value="phd">Phd</option>
                        <option value="master"> Master</option>
                        <option value="bachelor"> Bachelor</option>
                        <option value="baccalaureate">Baccalaureate</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="basic">basic</option>
                        <option value="illiterate">Illiterate</option>
                    </select>
                </div>
               <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <div class="row mt-3">
                        <div class="col-5 mt-lg-3 my-md-2 mb-sm-3 mb-3">
                            <input class="form-check-input male" type="radio" id="emp-gender" value="0" checked name="gender" ><label class="ps-2">Male</label>
                        </div>
                        <div class="col-6 mt-lg-3 my-md-2 mb-sm-3 mb-3">
                            <input class="form-check-input female" type="radio" id="emp-gender" value="1" name="gender" ><label class="ps-2">Female</label>
                        </div>
                    </div>
                </div>
                  <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3"> 
                    <select class="form-control mt-lg-4 my-md-2 my-sm-2 search_box" data-live-search="true" id="emp-department" name="emp_department" >
                        <option class="disabled" value="0">Choose Department</option>
                        <?php
                            $sql = "SELECT * FROM department";
                            $res = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {?>
                            <option value="<?php echo $row['department_id']; ?>"> <?php echo $row['department_name']; ?></option>
                        <?php }?>
                    </select>
                </div>
            <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                <button type="submit" id="employee-add-button" name="submit" class="btn-all mt-lg-4 mt-md-2 mt-sm-2 w-100">Add Employee</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
        <h4 class="">List of Employees</h4> 
    </div>
    <div class="col-lg-6 col-3 col-md-2 col-sm-2 ms-auto">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler text-light"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" >
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
    <div class="col-lg-3 d-lg-block d-md-none d-sm-none d-none">
        <form>
            <div class="col">
                <input type="text" class="form-control search_employee" placeholder="Search here by Name & ID" >
            </div>
        </form>
    </div>
    </div>
</div>



<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <div id='employee-table' class="responsive-table"></div>
</div>

<!--  Message Modal -->
<div class="modal fade" id="employee-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Veiw more Modal -->

<div class="modal fade" id="modal-veiw-more" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Employee Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center m-auto">

      </div>

    </div>
  </div>
</div>
<!-- End Veiw more Modal -->


<!-- Update Modal -->

<div class="modal fade" id="employee-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="formEmployeeUpdate" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="text" class="form-control fname" id="emp-fname" name="fname"  placeholder="First Name" >
                    <input type="hidden" name="employee_id" class="employee_id">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="text" class="form-control lname" id="emp-lname" name="lname" placeholder="Last Name" >
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-sm-3">
                    <div class="input-group mb-lg-3">
                        <label class="input-group-text" for="emp-file">Select Image</label>
                        <input type="file" class="form-control emp-photo" id="emp-file" name="emp_image" >
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="email" class="form-control email" id="emp-email" name="email"  placeholder="Email" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="text" class="form-control phone" id="emp-phone" name="phone"  placeholder="Phone" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <input type="number" class="form-control mt-lg-4 bod" id="emp-bod" name="bod"  placeholder="Birth Year" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <select class="form-control mt-lg-4 employee_type" id="emp-type" name="emp_type">
                        <option class="disabled" value="0">Choose Type</option>
                        <option value="100"> Foreign</option>
                        <option value="101"> Local</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3">
                    <select class="form-control mt-lg-4 employee_degree" id="emp-degree" name="emp_degree">
                        <option class="disabled" value="0">Choose Degree</option>
                        <option value="phd">Phd</option>
                        <option value="master"> Master</option>
                        <option value="bachelor"> Bachelor</option>
                        <option value="baccalaureate">Baccalaureate</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="basic">basic</option>
                        <option value="illiterate">Illiterate</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3">
                    <div class="row mt-3">
                        <div class="col-5 mt-lg-3">
                            <input class="form-check-input male" type="radio" id="emp-gender" value="0" checked name="gender" ><label class="ps-2">Male</label>
                        </div>
                        <div class="col-6 mt-lg-3">
                            <input class="form-check-input female" type="radio" id="emp-gender" value="1" name="gender" ><label class="ps-2">Female</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-3">
                    <select class="form-control mt-lg-4 department" id="emp-department" name="emp_department" >
                        <option class="disabled" value="0">Choose Department</option>
                        <?php
                        $sql = "SELECT * FROM department";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {?>
                        <option value="<?php echo $row['department_id']; ?>"> <?php echo $row['department_name']; ?></option>
                        <?php }?>
                    </select>
                </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <button type="submit" id="employee-add-button " name="submit" class="btn-all mt-lg-4 update-employee-button w-100">Update Employee</button>
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

<?php require_once "partials/footer.php"?>;
