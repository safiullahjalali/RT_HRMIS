<?php

require_once "db.php";



// Load Contract
if(isset($_POST['action']) && $_POST['action'] == "loadContract"){
    $sql = "SELECT contract.contract_id,contract.gross_salary,contract.currency, contract.date_start, contract.date_end, contract.position,contract.contract_type, employee.employee_id, employee.firstname FROM contract INNER JOIN employee ON contract.employee_id = employee.employee_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $contract_type = '';
    $currency = "";
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        if($row['currency'] == 1){$currency = "AFN";}
        if($row['contract_type'] == 12){$contract_type = "Permanent";}else{$contract_type = "Fixed-term";}
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['gross_salary']; 
        $subdata[]=$currency;
        $subdata[]=$row ['date_start'];
        $subdata[]=$row ['date_end'];
        $subdata[]=$row ['position'];
        $subdata[]=$contract_type;
        $button="<button type='button' class='btn btn-warning btn-update-contract' data-id='{$row["contract_id"]}'><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-contract' data-id='{$row["contract_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}


// if(isset($_POST['action']) && $_POST['action'] == "loadContract"){
//     $limit = 10;
//     $page = 0;

//     if(isset($_POST['page'])){
//         $page = $_POST['page'];
//     }else{
//         $page = 1;
//     }

//     $start_from = ($page - 1) * $limit;
//     $sql = "SELECT contract.contract_id,contract.gross_salary,contract.currency, contract.date_start, contract.date_end, contract.position,contract.contract_type, employee.employee_id, employee.firstname FROM contract INNER JOIN employee ON contract.employee_id = employee.employee_id LIMIT $start_from, $limit";

//     $result = mysqli_query($con, $sql);
//     $data = "";
//     $i = 1;
//     $currency = "";
//     $contract_type = "";
//     if (mysqli_num_rows($result) > 0) {
//         $data .= "<div class='table-responsive'>
//         <table class='table table-striped table-hover'>
//         <thead class='table-header text-center'>
//             <tr>
//             <th scope='col'>#</th>
//             <th scope='col'>Employee Name</th>
//             <th scope='col'>Gross Salary</th>
//             <th scope='col'>Currency</th>
//             <th scope='col'>Start Date</th>
//             <th scope='col'>End Date</th>
//             <th scope='col'>Position</th>
//             <th scope='col'>Contract Type</th>
//             <th scope='col' class='action'>Action</th>
//             </tr>
//         </thead>
//         <tbody>";
//         while ($row = mysqli_fetch_assoc($result)) {
//             if($row['currency'] == 1){$currency = "Afghani";}else{$currency = "$ Doller";}
//             if($row['contract_type'] == 12){$contract_type = "Permanent";}else{$contract_type = "Fixed-term";}
//             $data .= "<tbody>
//             <tr class='text-center'>
//                 <th scope='row'>". $i++ ."</th>
//                 <td scope='row'>{$row["firstname"]}</td>
//                 <td scope='row'>{$row["gross_salary"]}</td>
//                 <td scope='row'>{$currency}</td>
//                 <td scope='row'>{$row["date_start"]}</td>
//                 <td scope='row'>{$row["date_end"]}</td>
//                 <td scope='row'>{$row["position"]}</td>
//                 <td scope='row'>{$contract_type}</td>
//                 <td><button type='button' class='btn btn-warning btn-update-contract' data-id='{$row["contract_id"]}'><i class='fa fa-edit'></i></button> 
//                     <button type='button' class='btn btn-danger btn-delete-contract' data-id='{$row["contract_id"]}'><i class='fa fa-trash'></i></button>
//                 </td>
//             </tr>";
//         }
        
//         // mysqli_close($con);
//     } else {
//         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//     }
//     $data .= "
//         </tbody>
//         </table></div>";
//     $query = "SELECT contract.contract_id,contract.gross_salary,contract.currency, contract.date_start, contract.date_end, contract.position,contract.contract_type, employee.employee_id, employee.firstname FROM contract INNER JOIN employee ON contract.employee_id = employee.employee_id";
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


// Add Contract

if(isset($_POST['action']) && $_POST['action'] == "AddContract"){
    $employee_id = $_POST['employee_id'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $contract_type = $_POST['contract_type'];
    $currency = $_POST['currency'];
    $sql = "INSERT INTO contract VALUES(null, '{$employee_id}','{$salary}','{$currency}','{$start_date}','{$end_date}','{$position}','{$contract_type}')";

    $result = mysqli_query($con, $sql);

    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

// // Delete Contract

if(isset($_POST['action']) && $_POST['action'] == 'DeleteContract'){

    $contract_id = $_POST['contract_id'];

    $sql = "DELETE FROM contract WHERE contract_id = '$contract_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}

// // Retrieve Edit Contract

if(isset($_POST['action']) && $_POST['action'] == 'contract-retrieve'){
    $contract_id = $_POST['contract_id'];
    $sql = "SELECT contract.contract_id,contract.gross_salary,contract.currency, contract.date_start, contract.date_end, contract.position,contract.contract_type, employee.employee_id FROM contract INNER JOIN employee ON contract.employee_id = employee.employee_id WHERE contract.contract_id = {$contract_id}";

    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    $contract_id = $row['contract_id'];
    $salary = $row['gross_salary'];
    $currency = $row['currency'];
    $start_date = $row['date_start'];
    $end_date = $row['date_end'];
    $position = $row['position'];
    $contract_type = $row['contract_type'];
    $employee_id = $row['employee_id'];

    $return_array = array("contract_id" =>$contract_id,"salary" =>$salary,"currency" =>$currency,"start_date" =>$start_date,"end_date" =>$end_date,"position" =>$position,"contract_type" =>$contract_type,"employee_id" =>$employee_id);
    echo json_encode($return_array);
    exit();
}

// Update Contract
if(isset($_POST['action']) && $_POST['action'] == 'contract-update'){
    $contract_id = $_POST['contract_id'];
    $salary = $_POST['salary'];
    $currency = $_POST['currency'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $position = $_POST['position'];
    $contract_type = $_POST['contract_type'];
    $employee_id = $_POST['employee_id'];

    $query = "UPDATE contract SET 
            employee_id = {$employee_id},
            gross_salary = '{$salary}',
            currency = '{$currency}',
            date_start = '{$start_date}',
            date_end = '{$end_date}',
            position = '{$position}',
            contract_type = '{$contract_type}'
            WHERE contract_id = {$contract_id}";
    if(mysqli_query($con, $query)){
        echo 1;
    }else{
        echo 0;
    }
}

// // Search Live Contract

if(isset($_POST["action"]) && $_POST["action"] == "search-contract"){
    $search = $_POST['search'];
    $sql = "SELECT contract.contract_id,contract.gross_salary,contract.currency, contract.date_start, contract.date_end, contract.position,contract.contract_type, employee.employee_id, employee.firstname FROM contract INNER JOIN employee ON contract.employee_id = employee.employee_id WHERE contract.contract_id LIKE '%{$search}%' OR employee.firstname LIKE '%{$search}%'";  
   
    $result = mysqli_query($con, $sql);
    $data = "";
    $i = 1;
    $currency = "";
    $contract_type = "";
    if (mysqli_num_rows($result) > 0) {
        $data .= "<table class='table table-striped table-hover' id='contract-table'>
        <thead class='table-header text-center'>
            <tr>
            <th scope='col'>#</th>
            <th scope='col'>Employee Name</th>
            <th scope='col'>Gross Salary</th>
            <th scope='col'>Currency</th>
            <th scope='col'>Start Date</th>
            <th scope='col'>End Date</th>
            <th scope='col'>Position</th>
            <th scope='col'>Contract Type</th>
            <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['currency'] == 1){$currency = "Afghani";}else{$currency = "$ Doller";}
            if($row['contract_type'] == 12){$contract_type = "Permanent";}else{$contract_type = "Fixed-term";}
            $data .= "<tbody>
            <tr class='text-center'>
                <th scope='row'>". $i++ ."</th>
                <td scope='row'>{$row["firstname"]}</td>
                <td scope='row'>{$row["gross_salary"]}</td>
                <td scope='row'>{$currency}</td>
                <td scope='row'>{$row["date_start"]}</td>
                <td scope='row'>{$row["date_end"]}</td>
                <td scope='row'>{$row["position"]}</td>
                <td scope='row'>{$contract_type}</td>
                <td><button type='button' class='btn btn-warning btn-update-contract' data-id='{$row["contract_id"]}'><i class='fa fa-edit'></i></button> 
                    <button type='button' class='btn btn-danger btn-delete-contract' data-id='{$row["contract_id"]}'><i class='fa fa-trash'></i></button>
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