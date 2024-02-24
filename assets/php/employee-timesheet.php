<?php
    require_once("db.php");
    // Employee Timesheet Load
    if(isset($_POST['action']) && $_POST['action'] == 'employeeTimesheetLoad'){
        $limit = 10;
        $page = 0;
        $employee_id = $_POST['employee_id'];
        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }else{
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;

        $sql = "SELECT timesheet.timesheet_id, timesheet.timesheet_date,timesheet.task,
                employee.employee_id, project.project_name FROM ((
                timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
                INNER JOIN project ON timesheet.project_id = project.project_id) WHERE timesheet.employee_id = {$employee_id} order by timesheet.timesheet_id LIMIT $start_from, $limit";
        $res = mysqli_query($con,$sql);
        $data = "";
        $i = 1;
        if(mysqli_num_rows($res) > 0){
            $data .= " <div class='table-responsive'>
            <table class='table table-striped table-hover'>
            <thead class='table-header text-center'>
               <tr>
               <th scope='col'>#</th>
               <th scope='col'>Project Name</th>
               <th scope='col'>Date</th>
               <th scope='col'>Task & Details</th>
               <th scope='col'></th>
               </tr>
           </thead>
           ";
            while($row = mysqli_fetch_assoc($res)){
                $data .=" <tbody class='text-center'>
                <tr>
                    <th>".$i++."</th>
                    <td>{$row['project_name']}</td>
                    <td>{$row['timesheet_date']}</td>
                    <td>{$row['task']}</td>
                    <td >
                        <button type='button' class='btn btn-warning btn-update-employee-timesheet' data-id='{$row["timesheet_id"]}'' >Edit</button>
                        <button type='button' class='btn btn-danger btn-delete-employee-timesheet' data-id='{$row["timesheet_id"]}' >Delete</button>
                    </td>
                </tr>";
            }
            
        }else{
            echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
        }
        $data .=" </tbody> 
            </table></div>";

        $query = "SELECT timesheet.timesheet_id, timesheet.timesheet_date,timesheet.task,
        employee.employee_id, project.project_name FROM ((
        timesheet INNER JOIN employee ON timesheet.employee_id = employee.employee_id)
        INNER JOIN project ON timesheet.project_id = project.project_id) WHERE timesheet.employee_id = {$employee_id} order by timesheet.timesheet_id";
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

    // Retrieve Project name and employee name

    if(isset($_POST['action']) && $_POST['action'] == 'addEmployeeTimesheet'){
        $employee_id = $_POST['employee_id'];
        $project_id = $_POST['project_id'];
        $task_date = $_POST['task_date'];
        $task = $_POST['task'];
        
        $sql = "INSERT INTO timesheet VALUES(null, {$employee_id}, {$project_id}, '{$task_date}', '{$task}')";    
        if(mysqli_query($con,$sql)){
            echo 1;
        }else
            echo 0;
    }

?>