<?php   require_once "db.php";

// Load Employee Visa
if(isset($_POST['action']) && $_POST['action'] == "employeeVisaLoad"){
    $sql = "SELECT employee_visa.visa_id,employee_visa.issue_date, employee_visa.expire_date, employee.firstname, employee.lastname FROM employee_visa INNER JOIN employee on employee_visa.employee_id = employee.employee_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
       
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['lastname']; 
        $subdata[]=$row ['issue_date'];
        $subdata[]=$row ['expire_date'];
        $button="<button type='button' class='btn btn-warning  btn-update-employee-visa' data-id='{$row["visa_id"]}'' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-employee-visa' data-id='{$row["visa_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}
// if(isset($_POST['action']) && $_POST['action'] =='employeeVisaLoad'){
//     $limit = 10;
//     $page = 0;

//     if(isset($_POST['page'])){
//         $page = $_POST['page'];
//     }else{
//         $page = 1;
//     }

//     $start_from = ($page - 1) * $limit;
//     $sql = "SELECT employee_visa.visa_id,employee_visa.issue_date, employee_visa.expire_date, employee.firstname, employee.lastname FROM employee_visa INNER JOIN employee on employee_visa.employee_id = employee.employee_id LIMIT $start_from, $limit
//     "; 
//     $result = mysqli_query($con, $sql);
//     $data = "";
//     $i = 1;
//     if (mysqli_num_rows($result) > 0) {
//         $data .= "<div class='table-responsive'>
//         <table class='table table-striped table-hover'>
//         <thead class='table-header text-center'>
//                 <tr>
//                 <th scope='col'>#</th>
//                 <th scope='col'>Employee Name</th>
//                 <th scope='col'>Last Name</th>
//                 <th scope='col'>Issue Date</th>
//                 <th scope='col'>Expire Date</th>
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
//             <td>{$row['issue_date']}</td>
//             <td>{$row['expire_date']}</td>
//             <td><button type='button' class='btn btn-warning  btn-update-employee-visa' data-id='{$row["visa_id"]}'' ><i class='fa fa-edit'></i></button>
//                 <button type='button' class='btn btn-danger btn-delete-employee-visa' data-id='{$row["visa_id"]}'><i class='fa fa-trash'></i></button>
//             </td>
//             </tr>";
        
            
//         }
    
//     } else {
//         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//     }
//     $data .= "
//     </tbody>
//     </table></div>";
    
//     $query = "SELECT employee_visa.visa_id,employee_visa.issue_date, employee_visa.expire_date, employee.firstname, employee.lastname FROM employee_visa INNER JOIN employee on employee_visa.employee_id = employee.employee_id";
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

// Add Employee Visa
if(isset($_POST['action']) and $_POST['action'] == 'addEmployeeVisa'){
        
    $employee_id = $_POST['employee_id'];
    $issue_date = $_POST['issue_date'];
    $expire_date = $_POST['expire_date'];
    // note Count the different between the date into yare month day in numeric
    $sql = "INSERT INTO employee_visa VALUES(null,{$employee_id},'{$issue_date}','{$expire_date}')";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}


// Delete Employee Visa
if(isset($_POST['action']) && $_POST['action'] == 'deleteEmployeeVisa'){

    $visa_id = $_POST['visa_id'];

    $sql = "DELETE FROM employee_visa WHERE visa_id = '$visa_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}


// Retrieve Edit Employee Visa
if(isset($_POST['action']) && $_POST['action']== "employeeVisaFetchData"){

    $visa_id = $_POST['visa_id'];
    $sql = "SELECT * FROM employee_visa WHERE visa_id = {$visa_id}";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    
    $employee_id = $row['employee_id'];
    $issue_date = $row['issue_date'];
    $expire_date = $row['expire_date'];
    $visa_id = $row['visa_id'];
    $return_array[] = array("visa_id" =>$visa_id,"employee_id"=>$employee_id,"issue_date"=>$issue_date,"expire_date"=>$expire_date,);
    echo json_encode($return_array);
    exit(); 
}



// Update Employee Visa
if(isset($_POST["action"]) && $_POST["action"] == "employeeVisaUpdate"){
    $visa_id = $_POST["visa_id"];
    $employee_id = $_POST["employee_id"];
    $issue_date = $_POST["issue_date"];
    $expire_date = $_POST["expire_date"];

    $query = "UPDATE employee_visa SET employee_id = '{$employee_id}', issue_date = '{$issue_date}',expire_date = '{$expire_date}' WHERE visa_id = {$visa_id}";

    if(mysqli_query($con, $query)){
        echo 1;
    }else{
        echo 0;
    }
}



// Search Live Employee Visa
if(isset($_POST["action"]) && $_POST["action"] == "search-employe-visa"){
    $search = $_POST['search'];
        $sql = "SELECT employee_visa.visa_id,employee_visa.issue_date, employee_visa.expire_date, employee.firstname, employee.lastname FROM employee_visa INNER JOIN employee on employee_visa.employee_id = employee.employee_id WHERE employee_visa.visa_id LIKE '%{$search}%' or employee.firstname LIKE '%{$search}%'";
        $result = mysqli_query($con, $sql);
        $data = "";
        $i = 1;
        if (mysqli_num_rows($result) > 0) {
            $data .= "<table class='table table-striped table-hover' id='employee-visa-table'>
            <thead class='table-header text-center'>
                    <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Employee Name</th>
                    <th scope='col'>Last Name</th>
                    <th scope='col'>Issue Date</th>
                    <th scope='col'>Expire Date</th>
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
                <td>{$row['issue_date']}</td>
                <td>{$row['expire_date']}</td>
                <td><button type='button' class='btn btn-warning  btn-update-employee-visa' data-id='{$row["visa_id"]}'' >Edit</button>
                    <button type='button' class='btn btn-danger btn-delete-employee-visa' data-id='{$row["visa_id"]}'>Delete</button>
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
