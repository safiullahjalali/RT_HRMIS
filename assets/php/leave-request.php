<?php   require_once "db.php";

// Load Leave Request
if(isset($_POST['action']) && $_POST['action'] == "loadLeaveRequest"){
    $sql = "SELECT leave_request.request_id,leave_request.request_date,leave_request.date_start,leave_request.date_end,leave_request.remark,employee.firstname FROM leave_request INNER JOIN employee ON leave_request.employee_id = employee.employee_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['request_date']; 
        $subdata[]=$row ['date_start'];
        $subdata[]=$row ['date_end'];
        $subdata[]=$row ['remark'];
        $button="<button type='button' class='btn btn-warning btn-update-leave' data-id='{$row["request_id"]}'><i class='fa fa-edit'></i></button>";
        $button .="<button type='button' class='btn btn-danger btn-delete-leave' data-id='{$row["request_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}
// if(isset($_POST['action']) && $_POST['action'] == "loadLeaveRequest"){
//     $limit = 10;
//     $page = 0;

//     if(isset($_POST['page'])){
//         $page = $_POST['page'];
//     }else{
//         $page = 1;
//     }

//     $start_from = ($page - 1) * $limit;
    
//     $sql = "SELECT leave_request.request_id,leave_request.request_date,leave_request.date_start,leave_request.date_end,leave_request.remark,employee.firstname FROM leave_request INNER JOIN employee ON leave_request.employee_id = employee.employee_id LIMIT $start_from, $limit";
//     $result = mysqli_query($con, $sql);
//     $data = "";
//     $i = 1;
//     if (mysqli_num_rows($result) > 0) {
//         $data .= "<div class='table-responsive'>
//         <table class='table table-striped table-hover' id='leave-request-table'>
//         <thead class='table-header text-center'>
//             <tr>
//             <th scope='col'>#</th>
//             <th scope='col'>Employee Name</th>
//             <th scope='col'>Request Date</th>
//             <th scope='col'>Start Date</th>
//             <th scope='col'>End Date</th>
//             <th scope='col'>Remark & Reason</th>
//             <th scope='col'>Action</th>
//             </tr>
//         </thead>
//         <tbody>";
//         while ($row = mysqli_fetch_assoc($result)) {
//             $data .= "<tbody>
//             <tr class='text-center'>
//                 <th scope='row'>". $i++ ."</th>
//                 <td scope='row'>{$row["firstname"]}</td>
//                 <td scope='row'>{$row["request_date"]}</td>
//                 <td scope='row'>{$row["date_start"]}</td>
//                 <td scope='row'>{$row["date_end"]}</td>
//                 <td scope='row'>{$row['remark']}</td>
//                 <td><button type='button' class='btn btn-warning btn-update-leave' data-id='{$row["request_id"]}'><i class='fa fa-edit'></i></button> 
//                     <button type='button' class='btn btn-danger btn-delete-leave' data-id='{$row["request_id"]}'><i class='fa fa-trash'></i></button>
//                 </td>
//             </tr>";
//         }
        
//     } else {
//         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//     }
//     $data .= "
//         </tbody>
//         </table></div>";

//         $query = "SELECT leave_request.request_id,leave_request.request_date,leave_request.date_start,leave_request.date_end,leave_request.remark,employee.firstname FROM leave_request INNER JOIN employee ON leave_request.employee_id = employee.employee_id";
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

//     echo $data;
// }

// Add Leave Request
if(isset($_POST['action']) and $_POST['action'] == 'leaveRequestAdd'){
        
    $employee_id = $_POST['employee_id'];
    $request_date = $_POST['request_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $remark = $_POST['remark'];

    $sql = "INSERT INTO leave_request VALUES(null,'{$employee_id}','{$request_date}','{$start_date}','{$end_date}','{$remark}')";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Delete Leave Request
if(isset($_POST['action']) && $_POST['action'] == 'leaveRequestDelete'){

    $request_id = $_POST['request_id'];

    $sql = "DELETE FROM leave_request WHERE request_id = '$request_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

// Retrieve Edit Leave Request
if(isset($_POST['action']) && $_POST['action'] == "leaveRequestRetrieve"){
    $request_id = $_POST['request_id'];
    $sql = "SELECT leave_request.request_id,leave_request.request_date,leave_request.date_start,leave_request.date_end,leave_request.remark,employee.employee_id,employee.firstname FROM leave_request INNER JOIN employee ON leave_request.employee_id = employee.employee_id WHERE request_id = {$request_id}";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $request_id = $row['request_id'];
    $employee_id = $row['employee_id'];
    $request_date = $row['request_date'];
    $start_date = $row['date_start'];
    $end_date = $row['date_end'];
    $remark = $row['remark'];

    $return_array[] = array(
        "request_id" => $request_id,
        "employee_id" => $employee_id,
        "request_date" => $request_date,
        "start_date" => $start_date,
        "end_date" => $end_date,
        "remark" => $remark,
        "request_id" => $request_id
    );

    echo json_encode($return_array);
    exit();
}


// Update Leave Request
if(isset($_POST['action']) && $_POST['action'] == "leaveRequestUpdate"){
    $request_id = $_POST['request_id'];
    $employee_id = $_POST['employee_id'];
    $request_date = $_POST['request_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $remark = $_POST['remark'];

    $sql ="UPDATE leave_request SET 
    employee_id = {$employee_id},
    request_date = '{$request_date}',
    date_start = '{$start_date}',
    date_end = '{$end_date}',
    remark = '{$remark}' WHERE request_id = {$request_id}";

    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}

// Search Live Leave Request
if(isset($_POST["action"]) && $_POST["action"] == "searchLeaveRequest"){
    $search = $_POST['search'];
    $sql = "SELECT leave_request.request_id,leave_request.request_date,leave_request.date_start,leave_request.date_end,leave_request.remark,employee.firstname FROM leave_request INNER JOIN employee ON leave_request.employee_id = employee.employee_id WHERE leave_request.request_id LIKE '%{$search}%' OR employee.firstname LIKE '%{$search}%'";  
    
    $result = mysqli_query($con, $sql);
    $data = "";
    $i = 1;
    $currency = "";
    $contract_type = "";
    if (mysqli_num_rows($result) > 0) {
        $data .= "<table class='table table-striped table-hover' id='leave-request-table'>
        <thead class='table-header text-center'>
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
    <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
            $data .= "<tbody>
            <tr class='text-center'>
                <th scope='row'>". $i++ ."</th>
                <td scope='row'>{$row["firstname"]}</td>
                <td scope='row'>{$row["request_date"]}</td>
                <td scope='row'>{$row["date_start"]}</td>
                <td scope='row'>{$row["date_end"]}</td>
                <td scope='row'>{$row['remark']}</td>
                <td><button type='button' class='btn btn-warning btn-update-leave' data-id='{$row["request_id"]}'><i class='fa fa-edit'></i></button> 
                    <button type='button' class='btn btn-danger btn-delete-leave' data-id='{$row["request_id"]}'><i class='fa fa-trash'></i></button>
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