<?php   require_once("db.php");

// Load Project
if(isset($_POST['action']) && $_POST['action'] == "projectLoad"){
    $sql = "SELECT * FROM project";
    $result = mysqli_query($con, $sql);
    $data = array();
    $project_type = '';
    $currency = "";
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        if($row['currency'] == 1){$currency = "Afghani";}else{$currency = "$ Dollor";}
        if($row['project_type'] == 100){
            $project_type = "Manufacturing";
        }else if($row['project_type'] == 101){
            $project_type = "Construction";
        }else if($row['project_type'] == 102){
            $project_type = "Management";
        }else if($row['project_type'] == 103){
            $project_type = "Research";
        }else if($row['project_type'] == 104){
            $project_type = "Business implementation";
        }else if($row['project_type'] == 105){
            $project_type = "IT infrastructure improvement";
        }else if($row['project_type'] == 106){
            $project_type = "Product development (IT)";
        }else if($row['project_type'] == 107){
            $project_type = "Physical engineering/construction";
        }else if($row['project_type'] == 108){
            $project_type = "Procurement";
        }else if($row['project_type'] == 109){
            $project_type = "Research and Development (R&D)";
        }else if($row['project_type'] == 110){
            $project_type = "Service development";
        }else if($row['project_type'] == 111){
            $project_type = "Transformation/Reengineering";
        }
        $subdata = array();
        $subdata[]=$i++;
        $subdata[]=$row ['project_code'];
        $subdata[]=$row ['project_name']; 
        $subdata[]=$project_type;
        $subdata[]=$row ['donor_name'];
        $subdata[]=$row ['date_start'];
        $subdata[]=$row ['date_end'];
        $subdata[]=$row['project_cost'];
        $subdata[]=$currency;
        $button="<button type='button' class='btn btn-warning  btn-update-project' data-id='{$row["project_id"]}' ><i class='fa fa-edit'></i></button> ";
        $button .="<button type='button' class='btn btn-danger btn-delete-project' data-id='{$row["project_id"]}'><i class='fa fa-trash'></i></button>";
        $subdata[]=$button;
        $data[]=$subdata;
    }
    echo json_encode($data);
}

// if(isset($_POST['action']) && $_POST['action'] == "projectLoad"){
//         $limit = 10;
//         $page = 0;

//         if(isset($_POST['page'])){
//             $page = $_POST['page'];
//         }else{
//             $page = 1;
//         }
//         $start_from = ($page - 1) * $limit;

//         $sql = "SELECT * FROM project LIMIT $start_from, $limit";
//         $res = mysqli_query($con,$sql);
//         $data = "";
//         $i = 1;
//         $currency = "";
//         $project_type = "";
//         if(mysqli_num_rows($res) > 0){
//             $data .= "<div class='table-responsive'>
//             <table class='table table-striped table-hover'>
//             <thead class='table-header text-center'>
//                <tr>
//                <th scope='col'>#</th>
//                <th scope='col'>Project Code</th>
//                <th scope='col'>Project Name</th>
//                <th scope='col'>Project Type</th>
//                <th scope='col'>Donor Name</th>
//                <th scope='col'>Start Date</th>
//                <th scope='col'>End Date</th>
//                <th scope='col'>Project Cost</th>
//                <th scope='col'>Currency</th>
//                <th scope='col'>Action</th>
//                </tr>
//            </thead>
//            <tbody class='text-center'>";
        
//            while($row = mysqli_fetch_assoc($res)){
//             if($row['currency'] == 1){$currency = "Afghani";}else{$currency = "$ Dollor";}
//             if($row['project_type'] == 100){
//                 $project_type = "Manufacturing";
//             }else if($row['project_type'] == 101){
//                 $project_type = "Construction";
//             }else if($row['project_type'] == 102){
//                 $project_type = "Management";
//             }else if($row['project_type'] == 103){
//                 $project_type = "Research";
//             }else if($row['project_type'] == 104){
//                 $project_type = "Business implementation";
//             }else if($row['project_type'] == 105){
//                 $project_type = "IT infrastructure improvement";
//             }else if($row['project_type'] == 106){
//                 $project_type = "Product development (IT)";
//             }else if($row['project_type'] == 107){
//                 $project_type = "Physical engineering/construction";
//             }else if($row['project_type'] == 108){
//                 $project_type = "Procurement";
//             }else if($row['project_type'] == 109){
//                 $project_type = "Research and Development (R&D)";
//             }else if($row['project_type'] == 110){
//                 $project_type = "Service development";
//             }else if($row['project_type'] == 111){
//                 $project_type = "Transformation/Reengineering";
//             }
//             $data .= "<tbody class='text-center'>
//             <tr>
//             <th>".$i++."</th>
//             <td>{$row["project_code"]}</td>
//             <td>{$row["project_name"]}</td>
//             <td>{$project_type}</td>
//             <td>{$row["donor_name"]}</td>
//             <td>{$row["date_start"]}</td>
//             <td>{$row['date_end']}</td>
//             <td>{$row['project_cost']}</td>
//             <td>{$currency}</td>
//             <td><button type='button' class='btn btn-warning  btn-update-project' data-id='{$row["project_id"]}' ><i class='fa fa-edit'></i></button>
//                 <button type='button' class='btn btn-danger btn-delete-project' data-id='{$row["project_id"]}'><i class='fa fa-trash'></i></button>
//             </td>
//             </tr>";
//            }
//            $data .= "
//            </tbody>
//            </table></div>";
           
        
//         }else{
//             echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
//         }
    
//     $query = "SELECT * FROM project";
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

// Add Project
if(isset($_POST['action']) && $_POST['action'] == "projectAdd"){
    $project_name = $_POST['project_name'];
    $project_type = $_POST['project_type'];
    $donor_name = $_POST['donor_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $project_cost = $_POST['project_cost'];
    $currency = $_POST['currency'];
    $code = $_POST['project_code'];
    $sql = "INSERT INTO project VALUES (null,'{$code}','{$project_name}',{$project_type},'{$donor_name}','{$start_date}','{$end_date}',{$project_cost},{$currency})";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}


// Delete Project
if(isset($_POST['action']) && $_POST['action'] == 'deleteProject'){
    $project_id = $_POST['project_id'];
    $sql = "DELETE FROM project WHERE project_id = {$project_id}";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Retrieve Edit Project
if(isset($_POST['action']) && $_POST['action'] == "retrieveProject"){
    $project_id = $_POST['project_id'];
    $sql =  "SELECT * FROM project WHERE project_id = {$project_id}";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $project_id = $row['project_id'];
    $project_code = $row['project_code'];
    $project_name = $row['project_name'];
    $project_type = $row['project_type'];
    $donor_name = $row['donor_name'];
    $start_date = $row['date_start'];
    $end_date = $row['date_end'];
    $project_cost = $row['project_cost'];
    $currency = $row['currency'];

    $return_array[] = array(
        "project_id" => $project_id,
        "project_code" => $project_code,
        "project_name" => $project_name,
        "project_type" => $project_type,
        "donor_name" => $donor_name,
        "start_date" => $start_date,
        "end_date" => $end_date,
        "project_cost" => $project_cost,
        "currency" => $currency
    );

    echo json_encode($return_array);
    exit();
}

// Update Project
if(isset($_POST['action']) && $_POST['action'] == "udpateProject"){
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $project_code = $_POST['project_code'];
    $project_type = $_POST['project_type'];
    $donor_name = $_POST['donor_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $project_cost = $_POST['project_cost'];
    $currency = $_POST['currency'];

    $sql = "UPDATE project SET 
        project_code = '{$project_code}',
        project_name = '{$project_name}',
        project_type = '{$project_type}',
        donor_name = '{$donor_name}',
        date_start = '{$start_date}',
        date_end = '{$end_date}',
        project_cost = '{$project_cost}',
        currency = '{$currency}' WHERE project_id = {$project_id}
    ";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Search Live Project
if(isset($_POST['action']) && $_POST['action'] == "searchProject"){
    $search = $_POST['search'];
    $sql = "SELECT * FROM project WHERE project_id LIKE '%{$search}%' OR project_name LIKE '%{$search}%'";
    $res = mysqli_query($con,$sql);
    $data = "";
    $i = 1;
    $currency = "";
    $project_type = "";
    if(mysqli_num_rows($res) > 0){
        $data .= "<table class='table table-striped table-hover' id='project-table'>
        <thead class='table-header text-center'>
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
       <tbody class='text-center'>";
    
       while($row = mysqli_fetch_assoc($res)){
        if($row['currency'] == 1){$currency = "Afghani";}else{$currency = "$ Dollor";}
        if($row['project_type'] == 100){
            $project_type = "Manufacturing";
        }else if($row['project_type'] == 101){
            $project_type = "Construction";
        }else if($row['project_type'] == 102){
            $project_type = "Management";
        }else if($row['project_type'] == 103){
            $project_type = "Research";
        }else if($row['project_type'] == 104){
            $project_type = "Business implementation";
        }else if($row['project_type'] == 105){
            $project_type = "IT infrastructure improvement";
        }else if($row['project_type'] == 106){
            $project_type = "Product development (IT)";
        }else if($row['project_type'] == 107){
            $project_type = "Physical engineering/construction";
        }else if($row['project_type'] == 108){
            $project_type = "Procurement";
        }else if($row['project_type'] == 109){
            $project_type = "Research and Development (R&D)";
        }else if($row['project_type'] == 110){
            $project_type = "Service development";
        }else if($row['project_type'] == 111){
            $project_type = "Transformation/Reengineering";
        }
        $data .= "<tbody class='text-center'>
        <tr>
        <th>".$i++."</th>
        <td>{$row["project_code"]}</td>
        <td>{$row["project_name"]}</td>
        <td>{$project_type}</td>
        <td>{$row["donor_name"]}</td>
        <td>{$row["date_start"]}</td>
        <td>{$row['date_end']}</td>
        <td>{$row['project_cost']}</td>
        <td>{$currency}</td>
        <td><button type='button' class='btn btn-warning  btn-update-project' data-id='{$row["project_id"]}' ><i class='fa fa-edit'></i></button>
            <button type='button' class='btn btn-danger btn-delete-project' data-id='{$row["project_id"]}'><i class='fa fa-trash'></i></button>
        </td>
        </tr>";
       }
       $data .= "
       </tbody>
       </table>";
       mysqli_close($con);
       echo $data;
    
    }else{
        echo 0;
    }   
}

?>