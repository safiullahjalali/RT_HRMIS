<?php
  if(isset($_GET['s']) ){
    if($_GET['s'] == '1'){
      require_once('partials/sidebar.php');
    }
    if($_GET['s'] == '2'){
      require_once('partials/sidebar-supervisor.php');
    }
    if($_GET['s'] == '4'){
      require_once('partials/sidebar-finance.php');
    }
    if($_GET['s'] == '8'){
      require_once('partials/sidebar-project.php');
    }
    if($_GET['s'] == '10'){
      require_once('partials/sidebar-user.php');
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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Edit Profile</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mx-auto">
        <div class="card border border-0 shadow-lg" style="width: 100%; margin-top:20%">
            <img src="upload-img-employee/<?php echo $_SESSION['photo'];?>" style=" border-radius: 50%;" width="150" height="150" class="mx-auto mt-3" alt="...">
            <div class="card-body">
                <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
                    <form method="post" id="updateUsers" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="usernameUser" class="form-label text-muted ">Username</label>
                        <input type="text" class="form-control text-muted usernameUser" name="usernameUser" id="usernameUser" value="<?php echo $_SESSION['username'];?>" placeholder="Enter Username">
                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $_SESSION['employee_id'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="passwordUser" class="form-label text-muted">Change Password</label>
                        <input type="password" class="form-control text-muted passwordUser" name="passwordUser" id="passwordUser" placeholder="Enter Password">
                    </div>
                        <button type="button" id="update-user" class="btn-all mt-3 w-100 px-5">Update</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>



<!-- Message Modal -->
<div class="modal fade" id="setting-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contract</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnOk" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<?php require_once "partials/footer.php";?>