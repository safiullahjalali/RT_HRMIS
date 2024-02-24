<?php require_once "partials/sidebar.php";
 require_once "php/db.php";?>


<nav class="navbar navbar-expand-lg header-department">
  <div class="container-fluid">
  <div class="toggle text-white mx-3">
             <i class="fa-solid fa-bars" style="font-size: 1.5rem ;"></i>
        </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Users Information</h2>
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
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
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
                
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <input type="text" class="form-control username" id="username"  required placeholder="Username">
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                    <input type="password" class="form-control password" id="password"  required placeholder="Password">
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 col-12">
                        <select class="form-control user_level" id="user_level">
                            <option class='disabled' value="0">Choose User Level</option>
                            <option value="1">Admin</option>
                            <option value="2">Supervisor</option>
                            <option value="4">Finance</option>
                            <option value="8">Project Manager</option>
                            <option value="10">User Employee</option>
                        </select>
                </div>
              
            <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3 mb-3 col-12">
                <button type="button" class="btn-all w-100" id="add_user">Add User</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-2 col-md-4 col-sm-4 mb-sm-3 mb-3 col-4">
        <h4 class="">List of Users</h4>
    </div>
    <div class="col-lg-6 col-md-2 col-sm-2 mb-sm-3 mb-3 col-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav text-light">
                    <a class="nav-link active" aria-current="page" href="employee-visa.php">Employee Visa</a>
                    <a class="nav-link" href="employee-resign.php">Resign</a>
                    <a class="nav-link" href="employee-over-time.php">Over Time</a>
                    <a class="nav-link" href="users.php">Users</a>
                    <a class="nav-link dis-link" href="assign_project.php">Assign Project</a>
                </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-lg-3 d-lg-block d-md-none d-sm-none d-none mb-sm-3">
        <form>
            <div class="col">
                <input type="text" class="form-control search_user" placeholder="Search here by Name & ID">
            </div>
        </form>
    </div>
    </div>
</div>
<!-- Table of list -->

<div class="container mt-4 ">
        <div id='users-table'></div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="users-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="users-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Contract</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="">
            <div class="row">
                <div class="col-3">
                    <select class="form-control employee" disabled id="employee">
                        <option class="disabled" value="0">Choose Employee</option>
                    <?php
                        $sql = "SELECT employee_id,firstname FROM employee";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $row['employee_id'];?>"><?php echo $row['firstname'];?></option>
                   <?php } ?>
                    </select>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control username" id="username" required placeholder="Username">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control password" id="password"  required placeholder="Password">
                </div>
                <div class="col-2">
                        <select class="form-control user_level" id="user_level">
                            <option class='disabled' value="0">Choose User Level</option>
                            <option value="1">Admin</option>
                            <option value="2">Supervisor</option>
                            <option value="4">Finance</option>
                            <option value="8">Project Manager</option>
                            <option value="10">User Employee</option>
                        </select>
                </div>
              
            <div class="col-2">
                <button type="button" class="btn-all w-100 update_user">Update User</button>
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