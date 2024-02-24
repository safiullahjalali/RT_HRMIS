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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Departments Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
         <form>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 mb-sm-3 col-12 mb-3">
                    <input type="text" class="form-control" id="department-name" placeholder="Department Name" aria-label="First name">
                </div>
            <div class="col-lg-5 col-12">
                <button type="button" id="department-button" class="btn-all w-100" data-bs-toggle="modal" data-bs-target="#department-modal">Add Department</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-12 col-lg-4">
        <h2 class="">List of Departments</h2>
    </div>
    <div class="col-3 d-lg-block d-none">
        <form id="department-form">
            <div class="col">
                <input type="text" class="form-control" id= "search" placeholder="Search here by Name & ID" >
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Table of list -->

<div class="container-fluid mt-4 ">
    <div id="department-table"></div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="department-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Department</h1>
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
<div class="modal fade" id="department-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Department</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 mb-sm-3">
                        <input type="text" class="form-control dep_name" id="department-name" placeholder="Department Name" aria-label="First name">
                        <input type="hidden" class="department_edit_id">
                    </div>
                <div class="col-lg-4">
                    <button type="button" id="update-department-button" class="btn-all w-100" data-bs-toggle="modal" data-bs-target="#department-modal">Update Department</button>
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
