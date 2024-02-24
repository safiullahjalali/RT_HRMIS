<?php require_once "db.php";

// Load Employee Resign
if(isset($_POST['action']) && $_POST['action'] == "loadEmployeeResign"){
    $sql = "SELECT resign.resign_id,resign.employee_id, resign.resign_date,resign.reason, employee.firstname, employee.lastname FROM resign INNER JOIN employee on resign.employee_id = employee.employee_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
       
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['lastname']; 
        $subdata[]=$row ['resign_date'];
        $subdata[]=$row ['reason'];
        $button="<button type='button' class='btn btn-warning  btn-update-employee-resign' data-id='{$row["resign_id"]}'' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-employee-resign' data-id='{$row["resign_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}

// if(isset($_POST['action']) && $_POST['action'] =='loadEmployeeResign'){
//     $limit = 10;
//     $page = 0;

//     if(isset($_POST['page'])){
//         $page = $_POST['page'];
//     }else{
//         $page = 1;
//     }

//     $start_from = ($page - 1) * $limit;
    
//     $sql = "SELECT resign.resign_id,resign.employee_id, resign.resign_date,resign.reason, employee.firstname, employee.lastname FROM resign INNER JOIN employee on resign.employee_id = employee.employee_id LIMIT $start_from,$limit
//     "; 
//     $result = mysqli_query($con, $sql);
//     $data = "";
//     // $gender = "";
//     $i = 1;
//     if (mysqli_num_rows($result) > 0) {
//         $data .= "<table class='table table-striped table-hover' id='employee-resign-table'>
//         <thead class='table-header text-center'>
//                 <tr>
//                 <th scope='col'>#</th>
//                 <th scope='col'>Employee Name</th>
//                 <th scope='col'>Last Name</th>
//                 <th scope='col'>Resign Date</th>
//                 <th scope='col-3' colspan='2'>Reason</th>
//                 <th scope='col'>Action</th>
//                 </tr>
//             </thead>
//         <tbody>";
                
//         while ($row = mysqli_fetch_assoc($result)) {
            
//             $data .= "<tbody class='text-center'>
//             <tr>
//             <th>".$i++."</th>
//             <td>{$row["firstname"]}</td>
//             <td>{$row["lastname"]}</td>
//             <td>{$row['resign_date']}</td>
//             <td scope='col-3' colspan='2'>{$row['reason']}</td>
//             <td><button type='button' class='btn btn-warning  btn-update-employee-resign' data-id='{$row["resign_id"]}'' ><i class='fa fa-edit'></i></button>
//                 <button type='button' class='btn btn-danger btn-delete-employee-resign' data-id='{$row["resign_id"]}'><i class='fa fa-trash'></i></button>
//             </td>
//             </tr>";
        
            
//         }
        
//     } else {
//         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//     }
//     $data .= "
//         </tbody>
//         </table>";
//         $query = "SELECT resign.resign_id,resign.employee_id, resign.resign_date,resign.reason, employee.firstname, employee.lastname FROM resign INNER JOIN employee on resign.employee_id = employee.employee_id";
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

// Add Employee Visa
if(isset($_POST['action']) and $_POST['action'] == 'addEmployeeResign'){
        
    $employee_id = $_POST['employee_id'];
    $resign_date = $_POST['resign_date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO resign VALUES(null,{$employee_id},'{$resign_date}','{$reason}')";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}


// Delete Employee Visa
if(isset($_POST['action']) && $_POST['action'] == 'deleteEmployeeResign'){

    $resign_id = $_POST['resign_id'];

    $sql = "DELETE FROM resign WHERE resign_id = '$resign_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}


// Retrieve Edit Employee Visa
if(isset($_POST['action']) && $_POST['action'] == 'retrieveEmployeeResign'){
    $resign_id = $_POST['resign_id'];
    $sql = "SELECT * FROM resign WHERE resign_id = {$resign_id}";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    
    $employee_id = $row['employee_id'];
    $resign_id = $row['resign_id'];
    $resign_date = $row['resign_date'];
    $reason = $row['reason'];
    $return_array[] = array("resign_id" =>$resign_id,"employee_id"=>$employee_id,"resign_date"=>$resign_date,"reason"=>$reason);
    echo json_encode($return_array);
    exit(); 

}


// Update Employee Visa
if(isset($_POST['action']) && $_POST['action'] == 'employeeResignUpdate'){
    $employee_id = $_POST['employee_id'];
    $resign_id = $_POST['resign_id'];
    $resign_date = $_POST['resign_date'];
    $reason = $_POST['reason'];
    $query = "UPDATE resign SET employee_id = {$employee_id}, resign_date = '{$resign_date}', reason = '{$reason}' WHERE resign_id = $resign_id";

    $result = mysqli_query($con,$query);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}


// Search Live Employee Visa
if(isset($_POST["action"]) && $_POST["action"] == "search-employe-resign"){
    $search = $_POST['search'];
        $sql = "SELECT resign.resign_id,resign.employee_id, resign.resign_date,resign.reason, employee.firstname, employee.lastname FROM resign INNER JOIN employee on resign.employee_id = employee.employee_id WHERE resign.resign_id LIKE '%{$search}%' or employee.firstname LIKE '%{$search}%'";
        $result = mysqli_query($con, $sql);
        $data = "";
        $i = 1;
        if (mysqli_num_rows($result) > 0) {
            $data .= "<table class='table table-striped table-hover' id='employee-resign-table'>
            <thead class='table-header text-center'>
                    <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Employee Name</th>
                    <th scope='col'>Last Name</th>
                    <th scope='col'>Resign Date</th>
                    <th scope='col-3' colspan='2'>Reason</th>
                    <th scope='col'>Action</th>
                    </tr>
                </thead>
            <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                $data .= "<tbody class='text-center'>
                <tr>
                <th>".$i++."</th>
                <td>{$row["firstname"]}</td>
                <td>{$row["lastname"]}</td>
                <td>{$row['resign_date']}</td>
                <td scope='col-3' colspan='2'>{$row['reason']}</td>
                <td><button type='button' class='btn btn-warning  btn-update-employee-resign' data-id='{$row["resign_id"]}'' ><i class='fa fa-edit'></i></button>
                    <button type='button' class='btn btn-danger btn-delete-employee-resign' data-id='{$row["resign_id"]}'><i class='fa fa-trash'></i></button>
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