<?php   require_once("db.php");

if(isset($_POST['action']) && $_POST['action'] == "payrollLoad"){
    $sql = "SELECT payroll.payroll_id,payroll.employee_id, payroll.date_year,payroll.date_month,payroll.tax,payroll.overtime_amount,payroll.bonus,payroll.allowance, payroll.net_salary, payroll.pay_date,employee.firstname, employee.lastname FROM payroll INNER JOIN employee on payroll.employee_id = employee.employee_id";

    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row["firstname"];
        $subdata[]=$row ['lastname']; 
        $subdata[]=$row['date_year'];
        $subdata[]=$row ['date_month'];
        $subdata[]=$row ['tax'];
        $subdata[]=$row ['overtime_amount'];
        $subdata[]=$row ['bonus'];
        $subdata[]=$row ['allowance'];
        $subdata[]=$row['net_salary'];
        $subdata[]=$row['pay_date'];
        $button="<button type='button' class='btn btn-warning  btn-update-payroll' data-id='{$row["payroll_id"]}'' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-payroll' data-id='{$row["payroll_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}

// Load Payroll
// if(isset($_POST['action']) && $_POST['action'] == "payrollLoad"){
//         $limit = 10;
//         $page = 0;
    
//         if(isset($_POST['page'])){
//             $page = $_POST['page'];
//         }else{
//             $page = 1;
//         }
    
//         $start_from = ($page - 1) * $limit;
//         $sql = "SELECT payroll.payroll_id,payroll.employee_id, payroll.date_year,payroll.date_month,payroll.tax,payroll.overtime_amount,payroll.bonus,payroll.allowance, payroll.net_salary, payroll.pay_date,employee.firstname, employee.lastname FROM payroll INNER JOIN employee on payroll.employee_id = employee.employee_id LIMIT $start_from,$limit
//         ";
//         $result = mysqli_query($con, $sql);
//         $data = "";
//         $i = 1;
//         if (mysqli_num_rows($result) > 0) {
//             $data .= "<div class='table-responsive'>
//             <table class='table table-striped table-hover'>
//             <thead class='table-header text-center'>
//                <tr>
//                <th scope='col'>#</th>
//                <th scope='col'>Name</th>
//                <th scope='col'>Last Name</th>
//                <th scope='col'>Year</th>
//                <th scope='col'>Month</th>
//                <th scope='col'>Tax</th>
//                <th scope='col'>Overtime</th>
//                <th scope='col'>Bonus</th>
//                <th scope='col'>Allowance</th>
//                <th scope='col'>Net Salary</th>
//                <th scope='col'>Pay Date</th>
//                <th scope='col'>Action</th>
//                </tr>
//             </thead>
//             <tbody>";
                    
//             while ($row = mysqli_fetch_assoc($result)) {
                
//                 $data .= "<tbody class='text-center'>
//                 <tr>
//                 <th>".$i++."</th>
//                 <td>{$row["firstname"]}</td>
//                 <td>{$row["lastname"]}</td>
//                 <td>{$row['date_year']}</td>
//                 <td>{$row['date_month']}</td>
//                 <td>{$row['tax']}</td>
//                 <td>{$row['overtime_amount']}</td>
//                 <td>{$row['bonus']}</td>
//                 <td>{$row['allowance']}</td>
//                 <td>{$row['net_salary']}</td>
//                 <td>{$row['pay_date']}</td>
//                 <td><button type='button' class='btn btn-warning  btn-update-payroll' data-id='{$row["payroll_id"]}'' ><i class='fa fa-edit'></i></button>
//                     <button type='button' class='btn btn-danger btn-delete-payroll' data-id='{$row["payroll_id"]}'><i class='fa fa-trash'></i></button>
//                 </td>
//                 </tr>";
            
                
//             }

          
//         } else {
//             echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//         }
//         $data .= "
//             </tbody>
//             </table></div>";
            
//             $query = "SELECT payroll.payroll_id,payroll.employee_id, payroll.date_year,payroll.date_month,payroll.tax,payroll.overtime_amount,payroll.bonus,payroll.allowance, payroll.net_salary, payroll.pay_date,employee.firstname, employee.lastname FROM payroll INNER JOIN employee on payroll.employee_id = employee.employee_id
//             ";
//             $result = mysqli_query($con, $query);
//             $total_records = mysqli_num_rows($result);
//             $total_page = ceil($total_records/$limit);

//             $data .= '<ul class="pagination mt-3 justify-content-center">';
        
//             if($page > 1){
//                 $prev = $page - 1;
//                 $data .='<li class="page-item" id="1" ><span class="page-link" >First Page</span></li>';
//                 $data .='<li class="page-item" id="'.$prev.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
//             }
        
//             for($i = 1; $i <= $total_page; $i++) {
//                 $active_class = '';
//                 if( $i == $page){
//                     $active_class = 'active';
//                 }
//                 $data .= '<li class="page-item '.$active_class.'" id="'.$i.'" ><span class="page-link">'.$i.'</span></li>';
//             }
        
//             if($page < $total_page){
//                 $page++;
//                 $data .= '<li class="page-item " id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
//                 $data .= '<li class="page-item " id="'.$total_page.'"><span class="page-link">Last Page</span></li>';
//             }
        
//             $data .= '</ul>';

//     echo $data;
// }

// Single Load Payroll

if(isset($_POST['action']) && $_POST['action'] == 'payrollSingleLoad'){

    $employee_id = $_POST['employee_id'];

   // $sql = "SELECT payroll.employee_id, overtime.hours,contract.gross_salary from (( payroll INNER JOIN overtime on payroll.employee_id = overtime.employee_id ) INNER JOIN contract on payroll.employee_id = contract.employee_id) WHERE payroll.employee_id = {$employee_id}";
    $sql = "SELECT contract.employee_id, overtime.hours,contract.gross_salary from contract LEFT JOIN overtime on contract.employee_id = overtime.employee_id WHERE contract.employee_id = {$employee_id}";
    $result = mysqli_query($con,$sql);
        
        $tax = 0;
        $overtime = 0;
        while($row = mysqli_fetch_assoc($result)){
            
            $hours = $row['hours'];
            $gross_salary = $row['gross_salary'];
            if(isset($hours) || isset($gross_salary)){
                if($gross_salary >= 0 && $gross_salary <= 5000){
                    
                    $tax = $gross_salary + 0;

                }else if($gross_salary >= 5001 && $gross_salary <= 12500){
                    
                    $tax = (($gross_salary - 5000)/100 * 2);
                
                }else if($gross_salary >= 12501 && $gross_salary <= 100000){
                
                    $tax = (($gross_salary - 12500)/100 * 10) + 150;

                
                }else if($gross_salary > 100000){
                
                    $tax = (($gross_salary - 100000)/100 * 20) + 8900;
                
                }
                    $overtime = $hours * 300;   
                
                
            }else if($gross_salary == ""){
                echo 0;
            }
            else{
                if($gross_salary >= 0 && $gross_salary <= 5000){
                    
                    $tax = $gross_salary + 0;

                }else if($gross_salary >= 5001 && $gross_salary <= 12500){
                    
                    $tax = (($gross_salary - 5000)/100 * 2);
                
                }else if($gross_salary >= 12501 && $gross_salary <= 100000){
                
                    $tax = (($gross_salary - 12500)/100 * 10) + 150;

                
                }else if($gross_salary > 100000){
                
                    $tax = (($gross_salary - 100000)/100 * 20) + 8900;
                
                }

                $overtime = $hours + 0;
            }

            $return_array[] = array(
                "overtime" => $overtime,
                "gross_salary" => $gross_salary,
                "tax" => $tax
            );
        
            echo json_encode($return_array);
            exit();

        }

    
        echo 0;
    

}

// Add Payroll
if(isset($_POST['action']) && $_POST['action'] == "payrollAdd"){
    $employee_id = $_POST['employee_id'];
    $date_year = $_POST['date_year'];
    $date_month = $_POST['date_month'];
    $overtime = $_POST['overtime'];
    $tax = $_POST['tax'];
    $bonus = $_POST['bonus'];
    $net_salary = $_POST['net_salary'];
    $allowance = $_POST['allowance'];
    $pay_date = $_POST['pay_date'];

    $sql = "INSERT INTO payroll VALUES(null,{$employee_id},{$date_year},'{$date_month}',{$tax},{$overtime},{$bonus},{$allowance},{$net_salary},'{$pay_date}')";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Delete Payroll
if(isset($_POST['action']) && $_POST['action'] == 'DeletePayroll'){
    $payroll_id = $_POST['payroll_id'];

    $sql = "DELETE FROM payroll WHERE payroll_id = {$payroll_id}";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Retrieve Edit Payroll
if(isset($_POST['action']) && $_POST['action'] == 'RetrievePayroll'){
    $payroll_id = $_POST['payroll_id'];

    $sql = "SELECT payroll.payroll_id,payroll.employee_id,payroll.net_salary,payroll.overtime_amount,payroll.tax,payroll.bonus,payroll.allowance,payroll.pay_date,contract.gross_salary FROM payroll
    INNER JOIN contract on contract.employee_id = payroll.employee_id WHERE payroll_id = {$payroll_id}";

    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($result);

    $payroll_id = $row['payroll_id'];
    $employee_id = $row['employee_id'];
    $tax = $row['tax'];
    $overtime = $row['overtime_amount'];
    $bonus = $row['bonus'];
    $pay_date = $row['pay_date'];
    $gross_salary = $row['gross_salary'];
    $allowance = $row['allowance'];
    $net_salary = $row['net_salary'];


    $return_array [] = array (
        "payroll_id" => $payroll_id,
        "employee_id" => $employee_id,
        "tax" => $tax,
        "overtime" => $overtime,
        "bonus" => $bonus,
        "pay_date" => $pay_date,
        "gross_salary" => $gross_salary,
        "allowance" => $allowance,
        "net_salary" => $net_salary
    );

    echo json_encode($return_array);
    exit();

}

// Update Payroll
if(isset($_POST['action']) && $_POST['action'] == 'updatePayroll'){
    $payroll_id = $_POST['payroll_id'];
    $employee_id = $_POST['employee_id'];
    $allowance = $_POST['allowance'];
    $bonus = $_POST['bonus'];
    $net_salary = $_POST['net_salary'];

    $sql = "UPDATE payroll SET 
            employee_id = {$employee_id},
            allowance = {$allowance},
            bonus = {$bonus},
            net_salary = {$net_salary} WHERE payroll_id = {$payroll_id}";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }

}

// Search Live Payroll
if(isset($_POST['action']) && $_POST['action'] == 'search'){
    
}