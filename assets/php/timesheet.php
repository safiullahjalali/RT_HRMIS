<?php     require_once("db.php");

// Load Timesheet
if(isset($_POST['action']) && $_POST['action'] == "timesheetLoad"){
    $sql = "SELECT timesheet.timesheet_id, timesheet.timesheet_date,timesheet.task,
    employee.employee_id, employee.firstname, project.project_name FROM ((
    timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
    INNER JOIN project ON timesheet.project_id = project.project_id) order by timesheet.timesheet_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['project_name']; 
        $subdata[]=$row ['timesheet_date'];
        $subdata[]=$row ['task'];
        $button="<button type='button' class='btn btn-warning btn-update-timesheet' data-id='{$row["timesheet_id"]}'' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-timesheet' data-id='{$row["timesheet_id"]}' ><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}
// if(isset($_POST['action']) && $_POST['action'] == "timesheetLoad"){
//         $limit = 10;
//         $page = 0;
    
//         if(isset($_POST['page'])){
//             $page = $_POST['page'];
//         }else{
//             $page = 1;
//         }
//         $start_from = ($page - 1) * $limit;

//         $sql = "SELECT timesheet.timesheet_id, project.project_code, timesheet.timesheet_date,timesheet.task,
//                 employee.employee_id, employee.firstname, project.project_name FROM ((
//                 timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
//                 INNER JOIN project ON timesheet.project_id = project.project_id) order by timesheet.timesheet_id LIMIT $start_from, $limit";
//         $res = mysqli_query($con,$sql);
//         $data = "";
//         $i = 1;
//         if(mysqli_num_rows($res) > 0){
//             $data .= " <div class='table-responsive'>
//             <table class='table table-striped table-hover' id='timesheet-table'>
//             <thead class='table-header text-center'>
//                <tr>
//                <th scope='col'>#</th>
//                <th scope='col'>Emloyee Name</th>
//                <th scope='col'>Project Name</th>
//                <th scope='col'>Date</th>
//                <th scope='col'>Task & Details</th>
//                <th scope='col'>Action</th>
//                </tr>
//            </thead>
//            ";
//             while($row = mysqli_fetch_assoc($res)){
//                 $data .=" <tbody class='text-center'>
//                 <tr>
//                     <th>".$i++."</th>
//                     <td>{$row['firstname']}</td>
//                     <td>{$row['project_name']}</td>
//                     <td>{$row['timesheet_date']}</td>
//                     <td>{$row['task']}</td>
//                     <td >
//                         <button type='button' class='btn btn-warning btn-update-timesheet' data-id='{$row["timesheet_id"]}'' ><i class='fa fa-edit'></i></button>
//                         <button type='button' class='btn btn-danger btn-delete-timesheet' data-id='{$row["timesheet_id"]}' ><i class='fa fa-trash'></i></button>
//                     </td>
//                 </tr>";
//             }
            
//         }else{
//             echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//         }
//         $data .=" </tbody> 
//             </table></div>";

//         $query = "SELECT timesheet.timesheet_id, project.project_code, timesheet.timesheet_date,timesheet.task,
//         employee.employee_id, employee.firstname, project.project_name FROM ((
//         timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
//         INNER JOIN project ON timesheet.project_id = project.project_id) order by timesheet.timesheet_id    ";
//         $result = mysqli_query($con, $query);
//         $total_records = mysqli_num_rows($result);
//         $total_page = ceil($total_records/$limit);
//         $data .= '<ul class="pagination mt-3 justify-content-center">';
    
//         if($page > 1){
//             $prev = $page - 1;
//             $data .='<li class="page-item" id="1" ><span class="page-link" >First Page</span></li>';
//             $data .='<li class="page-item" id="'.$prev.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
//         }
    
//         for($i = 1; $i <= $total_page; $i++) {
//             $active_class = '';
//             if( $i == $page){
//                 $active_class = 'active';
//             }
//             $data .= '<li class="page-item '.$active_class.'" id="'.$i.'" ><span class="page-link">'.$i.'</span></li>';
//         }
    
//         if($page < $total_page){
//             $page++;
//             $data .= '<li class="page-item " id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
//             $data .= '<li class="page-item " id="'.$total_page.'"><span class="page-link">Last Page</span></li>';
//         }
    
//         $data .= '</ul>';

//         echo $data;
// }

// Add Timesheet
if(isset($_POST['action']) && $_POST['action'] == "timesheetAdd"){
    $employee_id = $_POST['employee_id'];
    $project_code = $_POST['project_code'];
    $task_date = $_POST['task_date'];
    $details = $_POST['details'];
    $sql = "INSERT INTO timesheet VALUES (null,{$employee_id},'{$project_code}','{$task_date}','{$details}')";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
} 

// Delete Timesheet
if(isset($_POST['action']) && $_POST['action'] == 'timesheetDelete'){
    $timesheet_id = $_POST['timesheet_id'];
    $sql = "DELETE FROM timesheet WHERE timesheet_id = {$timesheet_id}";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Retrieve Edit Timesheet
if(isset($_POST['action']) && $_POST['action'] == "timesheetRetrieve"){
    $timesheet_id = $_POST['timesheet_id'];
    $sql = "SELECT * FROM timesheet WHERE timesheet_id = {$timesheet_id}";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $timesheet_id = $row['timesheet_id'];
    $employee_id = $row['employee_id'];
    $task_date = $row['timesheet_date'];
    $project_id = $row['project_id'];
    $details = $row['task'];


    $return_array[] = array(
        "employee_id" => $employee_id,
        "task_date" => $task_date,
        "project_id" => $project_id,
        "details" => $details,
        "timesheet_id" => $timesheet_id
    );

    echo json_encode($return_array);
    exit();
}

// Update Timesheet
if(isset($_POST['action']) && $_POST['action'] == "timesheetUpdate"){
    $timesheet_id = $_POST['timesheet_id'];
    $employee_id = $_POST['employee_id'];
    $task_date = $_POST['task_date'];
    $details = $_POST['details'];
    $project_id = $_POST['project_id'];

    $sql ="UPDATE timesheet SET 
    employee_id = {$employee_id},
    project_id = '{$project_id}',
    timesheet_date = '{$task_date}',
    task = '{$details}' WHERE timesheet_id = {$timesheet_id}";

    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}

// Search Live Timesheet
if(isset($_POST["action"]) && $_POST["action"] == "searchTimesheet"){
    $search = $_POST['search'];
    $sql = "SELECT timesheet.timesheet_id, timesheet.project_code, timesheet.timesheet_date,timesheet.task,
    employee.employee_id, employee.firstname, project.project_name FROM ((
    timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
    INNER JOIN project ON timesheet.project_code = project.project_code) WHERE timesheet.timesheet_id LIKE '%$search%' OR employee.firstname LIKE '%$search%'";
    $res = mysqli_query($con,$sql);
    $data = "";
    $i = 1;
    if(mysqli_num_rows($res) > 0){
    $data .= " <table class='table table-striped table-hover' id='timesheet-table'>
    <thead class='table-header text-center'>
    <tr>
    <th scope='col'>#</th>
    <th scope='col'>Emloyee Name</th>
    <th scope='col'>Project Name</th>
    <th scope='col'>Date</th>
    <th scope='col'>Task & Details</th>
    <th scope='col'>Action</th>
    </tr>
    </thead>
    ";
    while($row = mysqli_fetch_assoc($res)){
        $data .=" <tbody class='text-center'>
        <tr>
            <th>".$i++."</th>
            <td>{$row['firstname']}</td>
            <td>{$row['project_name']}</td>
            <td>{$row['timesheet_date']}</td>
            <td>{$row['task']}</td>
            <td >
                <button type='button' class='btn btn-warning btn-update-timesheet' data-id='{$row["timesheet_id"]}'' ><i class='fa fa-edit'></i></button>
                <button type='button' class='btn btn-danger btn-delete-timesheet' data-id='{$row["timesheet_id"]}' ><i class='fa fa-trash'></i></button>
            </td>
        </tr>";
    }
    $data .=" </tbody> 
    </table>";
    mysqli_close($con);
    echo $data;
    }else{
    echo 0;
    }

}
?>