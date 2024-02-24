<?php require_once "php/db.php";
  require_once("php/checkUser.php");
    if(isset($_SESSION['sidebarStatus'])){
        if($_SESSION['sidebarStatus'] == 'project'){
            require_once "partials/sidebar-project.php";
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
      <h2 class="navbar-nav me-auto mb-2 mb-lg-0 text-align-center">Projects Information</h2>
      <h4 class="d-flex"><?php echo date("d F Y"); ?>
      </h4>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col">
         <form method="post" action="" id="formProject">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="number" min="1000"  class="form-control projcet_code" id="projcet_code" placeholder="Project Code" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="text" class="form-control project_name" id="project_name" placeholder="Project Name" >
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <input type="text" class="form-control donor_name" id="donor_name"  placeholder="Donor Name" >
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <select class="form-control project_type" id="project_type">
                    <option class="disabled" value="0">Choose Project Type</option>
                    <option  value="100">Manufacturing </option>
                    <option  value="101">Construction </option>
                    <option  value="102">Management </option>
                    <option  value="103">Research </option>
                    <option  value="104">Business implementation</option>
                    <option  value="105">IT infrastructure improvement</option>
                    <option  value="106">Product development (IT)</option>
                    <option  value="107">Physical engineering/construction</option>
                    <option  value="108">Procurement</option>
                    <option  value="109">Research and Development (R&D)</option>
                    <option  value="110">Service development</option>
                    <option  value="111">Transformation/reengineering</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3 =">
                    <input type="number" name="" id="project_cost" min="1" class="form-control project_cost" placeholder="Project Cost"> 
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-sm-3 mb-3">
                    <select class="form-control projcet_currency mt-lg-4" id="projcet_currency" >
                        <option class="disabled" value="0">Choose Currency</option>
                        <option value="1"> Afghani</option>
                        <option value="2">$ Dollor</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3 mb-sm-3 text-center mt-lg-4 col-3 mb-3">
                    <label for="" class="my-2">Start Date</label>
                </div>
                <div class="col-lg-2 col-md-9 col-sm-9 mb-sm-3 col-9">
                    <input type="date" name="" id="date_start" class="form-control mt-lg-4 date_start">
                </div>
                <div class="col-lg-1 col-md-3 col-sm-3 mb-sm-3 text-center mt-lg-4 col-3">
                    <label for="" class="my-2">End Date</label>
                </div>
                <div class="col-lg-2 col-md-9 col-sm-9 mb-sm-3 col-9 mb-3">
                    <input type="date" name="" id="date_end" class="form-control mt-lg-4 date_end">
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 mb-sm-3">
                    <button type="button" id="project-add-button" class="btn-all mt-lg-4 w-100">Add Project</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="divider mt-5"></div>

<div class="container-fluid  text-center mt-2">
<div class="row department-list p-2 d-flex justify-content-between align-items-center">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-sm-3">
        <h2 class="">List of Projects</h2>
    </div>
    <!-- <div class="col-3 d-sm-none d-md-none d-lg-block d-none">
        <form>
            <div class="col">
                <input type="text" class="form-control search_project" placeholder="Search here by Project Name & ID" >
            </div>
        </form>
    </div> -->
    </div>
</div>



<!-- Table of list -->

<div class="container-fluid mt-4 ">
        <!-- <div id='project-table'></div> -->
    <div class="row">
        <div class="col">
        <table class="table table-striped display" id="project-table">
        <thead>
        <tr>
               <th scope='col'>#</th>
               <th scope='col'>Project Code</th>
               <th scope='col'>Project Name</th>
               <th scope='col'>Project Type</th>
               <th scope='col'>Donor Name</th>
               <th scope='col'>Start Date</th>
               <th scope='col'>End Date</th>
               <th scope='col'>Project Cost</th>
               <th scope='col'>Currency</th>
               <th scope='col'>Action</th>
               </tr>
        </thead>
        </table>
        </div>
    </div>
  
</div>

<!--  Message Modal -->
<div class="modal fade" id="project-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Project</h1>
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

<!-- Update Modal -->

<div class="modal fade" id="project-modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" id="formUpdateProject">
            <div class="row">
                <div class="col-2">
                    <input type="text" min="1000"  class="form-control project_code" id="projcet_code" placeholder="Project Code" >
                    <input type="hidden" name="" class="project_id">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control project_name" id="project_name" placeholder="Project Name" >
                </div>
                <div class="col-2">
                    <input type="text" class="form-control donor_name" id="donor_name"  placeholder="Donor Name" >
                </div>
                <div class="col-4">
                    <select class="form-control project_type" id="project_type">
                    <option class="disabled" value="0">Choose Project Type</option>
                    <option  value="100">Manufacturing </option>
                    <option  value="101">Construction </option>
                    <option  value="102">Management </option>
                    <option  value="103">Research </option>
                    <option  value="104">Business implementation</option>
                    <option  value="105">IT infrastructure improvement</option>
                    <option  value="106">Product development (IT)</option>
                    <option  value="107">Physical engineering/construction</option>
                    <option  value="108">Procurement</option>
                    <option  value="109">Research and Development (R&D)</option>
                    <option  value="110">Service development</option>
                    <option  value="111">Transformation/reengineering</option>
                    </select>
                </div>

                <div class="col-2">
                    <input type="number" name="" id="project_cost" min="1" class="form-control project_cost" placeholder="Project Cost"> 
                </div>
                <div class="col-2">
                    <select class="form-control projcet_currency mt-4" id="projcet_currency" >
                        <option class="disabled" value="0">Choose Currency</option>
                        <option value="1"> Afghani</option>
                        <option value="2">$ Dollor</option>
                    </select>
                </div>
                <div class="col-1 text-center mt-4 px-2">
                    <label for="" class="my-2">Start Date</label>
                </div>
                <div class="col-2">
                    <input type="date" name="" id="date_start" class="form-control mt-4 date_start">
                </div>
                <div class="col-1 text-center mt-4">
                    <label for="" class="my-2">End Date</label>
                </div>
                <div class="col-2">
                    <input type="date" name="" id="date_end" class="form-control mt-4 date_end">
                </div>
                <div class="col-3">
                    <button type="button" id="project-update-button" class="btn-all mt-4">Update Project</button>
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
<script src="js/bs.custom-file.js"></script>

<?php require_once "partials/footer.php"?>;
