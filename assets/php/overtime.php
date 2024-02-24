<?php  require_once("db.php");

// Load Overtime
if(isset($_POST['action']) && $_POST['action'] == "overtimeLoad"){
    $sql = "SELECT overtime.overtime_id,overtime.employee_id,overtime.date_year,overtime.date_month,overtime.date_day,overtime.hours,employee.employee_id,employee.firstname,employee.lastname FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id";
    $result = mysqli_query($con, $sql);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        if($row['date_month'] == 1){
            $month = "January";
        }else if($row['date_month'] == 2){
            $month = "February";
        }else if($row['date_month'] == 3){
            $month = "March";
        }else if($row['date_month'] == 4){
            $month = "April";
        }else if($row['date_month'] == 5){
            $month = "May";
        }else if($row['date_month'] == 6){
            $month = "June";
        }else if($row['date_month'] == 7){
            $month = "July";
        }else if($row['date_month'] == 8){
            $month = "August";
        }else if($row['date_month'] == 9){
            $month = "September";
        }else if($row['date_month'] == 10){
            $month = "October";
        }else if($row['date_month'] == 11){
            $month = "November";
        }else{
            $month = "December";
        }
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['firstname'];
        $subdata[]=$row ['lastname']; 
        $subdata[]=$row ['date_year'];
        $subdata[]=$month;
        $subdata[]=$row ['date_day'];
        $subdata[]=$row ['hours'];

        $button="<button type='button' class='btn btn-warning  btn-update-overtime' data-id='{$row["overtime_id"]}'' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-overtime' data-id='{$row["overtime_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}
// if(isset($_POST['action']) && $_POST['action'] == "overtimeLoad"){
//         $limit = 10;
//         $page = 0;

//         if(isset($_POST['page'])){
//             $page = $_POST['page'];
//         }else{
//             $page = 1;
//         }

//         $start_from = ($page - 1) * $limit;
//         $sql = "SELECT overtime.overtime_id,overtime.employee_id,overtime.date_year,overtime.date_month,overtime.date_day,overtime.hours,employee.employee_id,employee.firstname,employee.lastname FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id LIMIT $start_from,$limit";

//         $res = mysqli_query($con, $sql);

//         $data = "";
//         $i = 1;
//         $month = "";
//         if(mysqli_num_rows($res) > 0 ){
//             $data .= "<div class='table-responsive'>
//             <table class='table table-striped table-hover' id='overtime-table'>
//             <thead class='table-header text-center'>
//                <tr>
//                <th scope='col'>#</th>
//                <th scope='col'>Employee Name</th>
//                <th scope='col'>Last Name</th>
//                <th scope='col'>Year</th>
//                <th scope='col'>Month</th>
//                <th scope='col'>Day</th>
//                <th scope='col'>Overtime Hours</th>
//                <th scope='col'>Action</th>
//                </tr>
//            </thead>";
        
//         while($row = mysqli_fetch_assoc($res)){ 
//             if($row['date_month'] == 1){
//                 $month = "January";
//             }else if($row['date_month'] == 2){
//                 $month = "February";
//             }else if($row['date_month'] == 3){
//                 $month = "March";
//             }else if($row['date_month'] == 4){
//                 $month = "April";
//             }else if($row['date_month'] == 5){
//                 $month = "May";
//             }else if($row['date_month'] == 6){
//                 $month = "June";
//             }else if($row['date_month'] == 7){
//                 $month = "July";
//             }else if($row['date_month'] == 8){
//                 $month = "August";
//             }else if($row['date_month'] == 9){
//                 $month = "September";
//             }else if($row['date_month'] == 10){
//                 $month = "October";
//             }else if($row['date_month'] == 11){
//                 $month = "November";
//             }else{
//                 $month = "December";
//             }
//             $data .="<tbody class='text-center'>
//             <tr>
//             <th>".$i++."</th>
//             <td>{$row["firstname"]}</td>
//             <td>{$row["lastname"]}</td>
//             <td>{$row['date_year']}</td>
//             <td>{$month}</td>
//             <td>{$row['date_day']}</td>
//             <td>{$row['hours']}</td>
//             <td><button type='button' class='btn btn-warning  btn-update-overtime' data-id='{$row["overtime_id"]}'' ><i class='fa fa-edit'></i></button>
//                 <button type='button' class='btn btn-danger btn-delete-overtime' data-id='{$row["overtime_id"]}'><i class='fa fa-trash'></i></button>
//             </td>
//             </tr>";
        
            
//         }
//         $data .= "
//         </tbody>
//         </table></div>";
//     } else {
//         echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//     }
//     $query = "SELECT overtime.overtime_id,overtime.employee_id,overtime.date_year,overtime.date_month,overtime.date_day,overtime.hours,employee.employee_id,employee.firstname,employee.lastname FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id";
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

// Add Overtime
if(isset($_POST['action']) && $_POST['action'] == "overtimeAdd"){
    $employee_id = $_POST['employee_id'];
    $date_year = $_POST['date_year'];
    $date_month = $_POST['date_month'];
    $date_day = $_POST['date_day'];
    $hours = $_POST['hours'];
    $sql = "INSERT INTO overtime VALUES(null,{$employee_id},{$date_year},{$date_month},{$date_day},{$hours})";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Delete Overtime
if(isset($_POST['action']) && $_POST['action'] == 'overtimeDelete'){
    $overtime_id = $_POST['overtime_id'];

    $sql = "DELETE FROM overtime WHERE overtime_id = {$overtime_id}";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Retrieve Edit Overtime
if(isset($_POST['action']) && $_POST['action'] == "overtimeRetrieve"){
    $overtime_id = $_POST['overtime_id'];
    $sql =  "SELECT * FROM overtime WHERE overtime_id = {$overtime_id}";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $employee_id = $row['employee_id'];
    $date_year = $row['date_year'];
    $date_month = $row['date_month'];
    $date_day = $row['date_day'];
    $hours = $row['hours'];

    $return_array[] = array(
        "employee_id" => $employee_id,
        "date_year" => $date_year,
        "date_month" => $date_month,
        "date_day" => $date_day,
        "hours" => $hours,
        "overtime_id" => $overtime_id
    );

    echo json_encode($return_array);
    exit();
}

// Update Overtime
if(isset($_POST['action']) && $_POST['action'] == "overtimeUpdate"){
    $overtime_id = $_POST['overtime_id'];
    $employee_id = $_POST['employee_id'];
    $date_year = $_POST['date_year'];
    $date_month = $_POST['date_month'];
    $date_day = $_POST['date_day'];
    $hours = $_POST['hour'];

    $sql ="UPDATE overtime SET 
    employee_id = {$employee_id},
    date_year = {$date_year},
    date_month = {$date_month},
    date_day = {$date_day},
    hours = {$hours} WHERE overtime_id = {$overtime_id}";

    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}

// Search Overtime
if(isset($_POST["action"]) && $_POST["action"] == "overtimeSearch"){
        $search = $_POST['search'];
        $sql = "SELECT overtime.overtime_id,overtime.employee_id,overtime.date_year,overtime.date_month,overtime.date_day,overtime.hours,employee.employee_id,employee.firstname,employee.lastname FROM overtime INNER JOIN employee ON employee.employee_id = overtime.employee_id WHERE overtime.overtime_id LIKE '%{$search}%' OR employee.firstname LIKE '%{$search}%'";

        $res = mysqli_query($con, $sql);

        $data = "";
        $i = 1;
        $month = "";
    if(mysqli_num_rows($res) > 0 ){
            $data .= "<table class='table table-striped table-hover' id='overtime-table'>
            <thead class='table-header text-center'>
            <tr>
            <th scope='col'>#</th>
            <th scope='col'>Employee Name</th>
            <th scope='col'>Last Name</th>
            <th scope='col'>Year</th>
            <th scope='col'>Month</th>
            <th scope='col'>Day</th>
            <th scope='col'>Overtime Hours</th>
            <th scope='col'>Action</th>
            </tr>
        </thead>";
        
        while($row = mysqli_fetch_assoc($res)){ 
            if($row['date_month'] == 1){
                $month = "January";
            }else if($row['date_month'] == 2){
                $month = "February";
            }else if($row['date_month'] == 3){
                $month = "March";
            }else if($row['date_month'] == 4){
                $month = "April";
            }else if($row['date_month'] == 5){
                $month = "May";
            }else if($row['date_month'] == 6){
                $month = "June";
            }else if($row['date_month'] == 7){
                $month = "July";
            }else if($row['date_month'] == 8){
                $month = "August";
            }else if($row['date_month'] == 9){
                $month = "September";
            }else if($row['date_month'] == 10){
                $month = "October";
            }else if($row['date_month'] == 11){
                $month = "November";
            }else{
                $month = "December";
            }
            $data .="<tbody class='text-center'>
            <tr>
            <th>".$i++."</th>
            <td>{$row["firstname"]}</td>
            <td>{$row["lastname"]}</td>
            <td>{$row['date_year']}</td>
            <td>{$month}</td>
            <td>{$row['date_day']}</td>
            <td>{$row['hours']}</td>
            <td><button type='button' class='btn btn-warning  btn-update-overtime' data-id='{$row["overtime_id"]}'' ><i class='fa fa-edit'></i></button>
                <button type='button' class='btn btn-danger btn-delete-overtime' data-id='{$row["overtime_id"]}'><i class='fa fa-trash'></i></button>
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