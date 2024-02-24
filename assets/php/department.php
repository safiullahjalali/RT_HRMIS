<?php     require_once "db.php";

    // Load Department

    if(isset($_POST['action']) && $_POST['action'] == 'loadDepartment'){
        $data = "";
        $limit = 10;
        $page = 0;

        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }else{
            $page = 1;
        }

        $start_from = ($page - 1) * $limit;

        $sql = "SELECT * FROM department order by department_id asc LIMIT $start_from,$limit ";

        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $data .= "<div class='table-responsive'>
            <table class='table table-striped table-hover' id='department-table'>
            <thead class='table-header text-center'>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Department Name</th>
                <th scope='col'>Action</th>
                </tr>
            </thead>
            <tbody>";
            $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $data .= "<tbody>
                    <tr class='text-center'>
                        <th scope='row'>".$i++."</th>
                        <td>{$row["department_name"]}</td>
                        <td><button type='button' class='btn btn-warning btn-update-department' data-id='{$row["department_id"]}'><i class='fa fa-edit'></i></button> 
                            <button type='button' class='btn btn-danger btn-delete-department' data-id='{$row["department_id"]}'><i class='fa fa-trash'></i></button>
                        </td>
                    </tr>";
                }
            
            } else {
                echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
            }
            $data .= "
            </tbody>
            </table></div>";
            // Pagination Code

            $result = mysqli_query($con, "SELECT * FROM department");
            $total_records = mysqli_num_rows($result);
            $total_page = ceil($total_records/$limit);
            $data .= '<ul class="pagination mt-3 justify-content-center">';

            if($page > 1){
                $prev = $page - 1;
                $data .='<li class="page-item" id="1" ><span class="page-link" >First Page</span></li>';
                $data .='<li class="page-item" id="'.$prev.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
            }

            for($i = 1; $i <= $total_page; $i++) {
                $active_class = '';
                if( $i == $page){
                    $active_class = 'active';
                }
                $data .= '<li class="page-item '.$active_class.'" id="'.$i.'" ><span class="page-link">'.$i.'</span></li>';
            }

            if($page < $total_page){
                $page++;
                $data .= '<li class="page-item " id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
                $data .= '<li class="page-item " id="'.$total_page.'"><span class="page-link">Last Page</span></li>';
            }

            $data .= '</ul>';
            echo $data;

    }

    // Add Department
    if(isset($_POST['action']) and $_POST['action'] == 'add-department'){
            
        $dep_name = $_POST['dep_name'];

        $sql = "INSERT INTO department VALUES(null,'{$dep_name}')";
        if(mysqli_query($con, $sql)){
            echo 1;
        }else{
            echo 0;
        }
    }

    // Delete department

    if(isset($_POST['action']) && $_POST['action'] == 'delete_department'){

        $department_id = $_POST['department_id'];

        $sql = "DELETE FROM department WHERE department_id = '$department_id'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // Retireve Edit department

    if(isset($_POST['action']) && $_POST['action']== "department-fetch-data"){

        $department_id = $_POST['department_id'];

        $sql = "SELECT * FROM department WHERE department_id = {$department_id}";
        $res = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($res);
        
        $department_name = $row['department_name'];
        
        $return_array[] = array("department_name"=>$department_name,"department_id"=>$department_id);
        echo json_encode($return_array);
        exit(); 
    }

    // Update Departement

    if(isset($_POST["action"]) && $_POST["action"] == "update_department"){
        $department_id = $_POST["dep_id"];
        $department_name = $_POST["dep_name"];

        $query = "UPDATE department SET department_name = '{$department_name}' WHERE department_id = {$department_id}";

        if(mysqli_query($con, $query)){
            echo 1;
        }else{
            echo 0;
        }
    }

    // Search Live Department

    if(isset($_POST['action']) && $_POST['action'] == "search-department"){
        $search = $_POST['search'];
        $sql = "SELECT * FROM department WHERE department_id LIKE '%{$search}%' or department_name LIKE '%{$search}%'";
        $result = mysqli_query($con, $sql);
        $data = "";
        if (mysqli_num_rows($result) > 0) {
            $data .= "<table class='table table-striped table-hover' id='department-table'>
                <thead class='table-header text-center'>
                    <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Department Name</th>
                    <th scope='col'>Action</th>
                    </tr>
                </thead>
            <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                $data .= "<tbody>
                    <tr class='text-center'>
                        <th scope='row'>{$row["department_id"]}</th>
                        <td>{$row["department_name"]}</td>
                        <td><button type='button' class='btn btn-warning btn-update-department' data-id='{$row["department_id"]}'><i class='fa fa-edit'></i></button> 
                            <button type='button' class='btn btn-danger btn-delete-department' data-id='{$row["department_id"]}'><i class='fa fa-trash'></i></button>
                        </td>
                    </tr>";
            }
            $data .= "
            </tbody>
            </table>";
            mysqli_close($con);
            echo $data;
        } else {
            echo 0;
        }
    }

?>