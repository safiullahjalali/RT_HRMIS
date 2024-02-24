<?php
    require_once("db.php");
// Load Assing Project
if(isset($_POST['action']) && $_POST['action'] == "LoadAssignProject"){
    $sql = "SELECT assign_project.assign_project_id,assign_project.date_start,assign_project.date_end, employee.firstname, project.project_name FROM (( assign_project INNER JOIN employee on assign_project.employee_id = employee.employee_id)
    INNER JOIN project on assign_project.project_id = project.project_id)";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['project_name']; 
        $subdata[]=$row ['date_start'];
        $subdata[]=$row ['date_end'];

        $button="<button type='button' class='btn btn-warning  btn-update-assign-project' data-id='{$row["assign_project_id"]}' ><i class='fa fa-edit'></i></button> ";
        $button .=" <button type='button' class='btn btn-danger btn-delete-assign-project' data-id='{$row["assign_project_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}
    // if(isset($_POST['action']) && $_POST['action'] == "LoadAssignProject"){
    //     $limit = 10;
    //     $page = 0;

    //     if(isset($_POST['page'])){
    //         $page = $_POST['page'];
    //     }else{
    //         $page = 1;
    //     }
    //     $start_from = ($page - 1) * $limit;

    //     $sql = "SELECT assign_project.assign_project_id,assign_project.date_start,assign_project.date_end, employee.firstname, project.project_name FROM (( assign_project INNER JOIN employee on assign_project.employee_id = employee.employee_id)
    //     INNER JOIN project on assign_project.project_id = project.project_id) LIMIT $start_from, $limit";
    //     $res = mysqli_query($con,$sql);
    //     $data = "";
    //     $i = 1;
    //     if(mysqli_num_rows($res) > 0){
    //         $data .= "<div class='table-responsive'>
    //         <table class='table table-striped table-hover'>
    //         <thead class='table-header text-center'>
    //            <tr>
    //            <th scope='col'>#</th>
    //            <th scope='col'>Employee Name</th>
    //            <th scope='col'>Project Name</th>
    //            <th scope='col'>End Date</th>
    //            <th scope='col'>Project Cost</th>
    //            <th scope='col'>Action</th>
    //            </tr>
    //        </thead>
    //        <tbody class='text-center'>";
        
    //        while($row = mysqli_fetch_assoc($res)){
    //         $data .= "<tbody class='text-center'>
    //             <tr>
    //             <th>".$i++."</th>
    //             <td>{$row["firstname"]}</td>
    //             <td>{$row["project_name"]}</td>
    //             <td>{$row["date_start"]}</td>
    //             <td>{$row['date_end']}</td>
    //             <td><button type='button' class='btn btn-warning  btn-update-assign-project' data-id='{$row["assign_project_id"]}' ><i class='fa fa-edit'></i></button>
    //                 <button type='button' class='btn btn-danger btn-delete-assign-project' data-id='{$row["assign_project_id"]}'><i class='fa fa-trash'></i></button>
    //             </td>
    //             </tr>";
    //        }
    //        $data .= "
    //        </tbody>
    //        </table></div>";
           
        
    //     }else{
    //         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
    //     }
    
    //     $query = "SELECT assign_project.assign_project_id,assign_project.date_start,assign_project.date_end, employee.firstname, project.project_name FROM (( assign_project INNER JOIN employee on assign_project.employee_id = employee.employee_id)
    //     INNER JOIN project on assign_project.project_id = project.project_id)";
    //     $result = mysqli_query($con, $query);
    //     $total_records = mysqli_num_rows($result);
    //     $total_page = ceil($total_records/$limit);
    //     $data .= '<ul class="pagination mt-3 justify-content-center">';

    //     if($page > 1){
    //         $prev = $page - 1;
    //         $data .='<li class="page-item" id="1" ><span class="page-link" >First Page</span></li>';
    //         $data .='<li class="page-item" id="'.$prev.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
    //     }

    //     for($i = 1; $i <= $total_page; $i++) {
    //         $active_class = '';
    //         if( $i == $page){
    //             $active_class = 'active';
    //         }
    //         $data .= '<li class="page-item '.$active_class.'" id="'.$i.'" ><span class="page-link">'.$i.'</span></li>';
    //     }

    //     if($page < $total_page){
    //         $page++;
    //         $data .= '<li class="page-item " id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
    //         $data .= '<li class="page-item " id="'.$total_page.'"><span class="page-link">Last Page</span></li>';
    //     }

    //     $data .= '</ul>';
    //     echo $data;
    // }

// Add Assign Project
    if(isset($_POST['action']) && $_POST['action'] == "addAssignProject"){
        $employee_id = $_POST['employee_id'];
        $project_id = $_POST['project_id'];
        $date_start = $_POST['start_date'];
        $date_end = $_POST['end_date'];

        $sql = "INSERT INTO assign_project VALUES(NULL,{$project_id}, {$employee_id}, '{$date_start}', '{$date_end}')";
        $result = mysqli_query($con,$sql);
        if($result)
            echo 1;
        else
            echo 0;
    }  
    
    // Delete Assign Project
    if(isset($_POST['action']) && $_POST['action'] == "deleteAssignProject"){
        $assign_id = $_POST['assign_id'];
        $sql = "DELETE FROM assign_project WHERE assign_project_id = {$assign_id}";
        if(mysqli_query($con,$sql)){
            echo 1;
        }else{
            echo 0;
        }
    }
 // Fetch Assign Project
    if(isset($_POST['action']) && $_POST['action'] == "fetchAssignProject"){
        $assign_id = $_POST['assign_id'];
        $sql = "SELECT * FROM assign_project WHERE assign_project_id = {$assign_id}";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);

            $return_array = array(
                "assign_id" => $row["assign_project_id"],
                "employee_id" => $row["employee_id"],
                "project_id" => $row["project_id"],
                "date_start" => $row["date_start"],
                "date_end" => $row["date_end"],
            );

            echo json_encode($return_array);
            exit();
        }

    }
     // Update Assign Project
    if(isset($_POST['action']) && $_POST['action'] == "updateAssignProject"){
        $assign_id = $_POST['assign_id'];
        $project_id = $_POST['project_id'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $employee_id = $_POST['employee_id'];

        $query = "UPDATE assign_project SET 
                employee_id = {$employee_id},
                project_id = {$project_id},
                date_start = '{$date_start}',
                date_end = '{$date_end}'
                WHERE assign_project_id = {$assign_id}";
        if(mysqli_query($con, $query)){
            echo 1;
        }else{
            echo 0;
        }
    }

     // Search Live Assign Project
     if(isset($_POST['action']) && $_POST['action'] == "searchAssignProject"){
        $search = $_POST['search'];
        $limit = 10;
        $page = 0;

        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }else{
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;

        $sql = "SELECT assign_project.assign_project_id,assign_project.date_start,assign_project.date_end, employee.firstname, project.project_name FROM (( assign_project INNER JOIN employee on assign_project.employee_id = employee.employee_id)
        INNER JOIN project on assign_project.project_id = project.project_id) WHERE employee.firstname LIKE '%{$search}%' OR assign_project.employee_id LIKE '%{$search}%' LIMIT $start_from, $limit";
        $res = mysqli_query($con,$sql);
        $data = "";
        $i = 1;
        $currency = "";
        $project_type = "";
        if(mysqli_num_rows($res) > 0){
            $data .= "<div class='table-responsive'>
            <table class='table table-striped table-hover'>
            <thead class='table-header text-center'>
               <tr>
               <th scope='col'>#</th>
               <th scope='col'>Employee Name</th>
               <th scope='col'>Project Name</th>
               <th scope='col'>End Date</th>
               <th scope='col'>Project Cost</th>
               <th scope='col'>Action</th>
               </tr>
           </thead>
           <tbody class='text-center'>";
        
           while($row = mysqli_fetch_assoc($res)){
            $data .= "<tbody class='text-center'>
                <tr>
                <th>".$i++."</th>
                <td>{$row["firstname"]}</td>
                <td>{$row["project_name"]}</td>
                <td>{$row["date_start"]}</td>
                <td>{$row['date_end']}</td>
                <td><button type='button' class='btn btn-warning  btn-update-assign-project' data-id='{$row["assign_project_id"]}' ><i class='fa fa-edit'></i></button>
                    <button type='button' class='btn btn-danger btn-delete-assign-project' data-id='{$row["assign_project_id"]}'><i class='fa fa-trash'></i></button>
                </td>
                </tr>";
           }
           $data .= "
           </tbody>
           </table></div>";
           
        
        }else{
            echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
        }
    
        $query = "SELECT assign_project.assign_project_id,assign_project.date_start,assign_project.date_end, employee.firstname, project.project_name FROM (( assign_project INNER JOIN employee on assign_project.employee_id = employee.employee_id)
        INNER JOIN project on assign_project.project_id = project.project_id)";
        $result = mysqli_query($con, $query);
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

?>