<?php    require_once("db.php");

// Load Users
if(isset($_POST['action']) && $_POST['action'] == "loadUsers"){
        $limit = 10;
        $page = 0;

        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }else{
            $page = 1;
        }

        $start_from = ($page - 1) * $limit;
        $sql = "SELECT users.employee_id,users.username,users.user_level,employee.employee_id,employee.firstname,employee.lastname FROM users INNER JOIN employee ON users.employee_id = employee.employee_id LIMIT $start_from,$limit";

        $res = mysqli_query($con, $sql);

        $data = "";
        $i = 1;
        $user_level = "";
        if(mysqli_num_rows($res) > 0 ){
            $data .= "<div class='table-responsive'>
            <table class='table table-striped table-hover' id='users-table'>
            <thead class='table-header text-center'>
               <tr>
               <th scope='col'>#</th>
               <th scope='col'>Employee Name</th>
               <th scope='col'>Last Name</th>
               <th scope='col'>Username</th>
               <th scope='col'>User Level</th>
               <th scope='col'>Action</th>
               </tr>
           </thead>";
        
        while($row = mysqli_fetch_assoc($res)){ 
            if($row['user_level'] == 1){
                $user_level = "Admin";   
            }else if($row['user_level'] == 2){
                $user_level = "Supervisor";   
            }
            else if($row['user_level'] == 4){
                $user_level = "Finance";   
            }
            else if($row['user_level'] == 8){
                $user_level = "Project Manager";    
            }else{
                $user_level = "Employee User";
            }
            $data .="<tbody class='text-center'>
            <tr>
            <th>".$i++."</th>
            <td>{$row["firstname"]}</td>
            <td>{$row["lastname"]}</td>
            <td>{$row['username']}</td>
            <td>{$user_level}</td>
            <td><button type='button' class='btn btn-warning  btn-update-users' data-id='{$row["employee_id"]}'' ><i class='fa fa-edit'></i></button>
                <button type='button' class='btn btn-danger btn-delete-users' data-id='{$row["employee_id"]}'><i class='fa fa-trash'></i></button>
            </td>
            </tr>";
        
            
        }
        
        
    } else {
        echo "<h2 class='text-danger text-center mt-2 fw-bold'>Data Not Found...</h2>";
    }
    $data .= "
        </tbody>
        </table></div>";
        $query = "SELECT users.employee_id,users.username,users.user_level,employee.employee_id,employee.firstname,employee.lastname FROM users INNER JOIN employee ON users.employee_id = employee.employee_id";

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

// Add Users

if(isset($_POST['action']) && $_POST['action'] == "addUsers"){
    $employee_id = $_POST['employee_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_level = $_POST['user_level'];
    $sql = "INSERT INTO users VALUES ($employee_id,'{$username}','{$password}',{$user_level})";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Delete Users
if(isset($_POST['action']) && $_POST['action'] == 'deleteUsers'){
    $employee_id = $_POST['employee_id'];
    $sql = "DELETE FROM users WHERE employee_id = {$employee_id}";
    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
}

// Retrieve Edit Users
if(isset($_POST['action']) && $_POST['action'] == "retrieveUsers"){
    $employee_id = $_POST['employee_id'];
    $sql =  "SELECT * FROM users WHERE employee_id = {$employee_id}";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $employee_id = $row['employee_id'];
    $username = $row['username'];
    $password = $row['password'];
    $user_level = $row['user_level'];

    $return_array[] = array(
        "employee_id" => $employee_id,
        "username" => $username,
        "password" => $password,
        "user_level" => $user_level,
    );

    echo json_encode($return_array);
    exit();
}

// Update Users
if(isset($_POST['action']) && $_POST['action'] == "updateUsers"){
    $employee_id = $_POST['employee_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_level = $_POST['user_level'];

    $sql ="UPDATE users SET 
    employee_id = {$employee_id},
    username = '{$username}',
    password = '{$password}',
    user_level = {$user_level} WHERE employee_id = {$employee_id}";

    if(mysqli_query($con, $sql)){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}

// Search Live Users
if(isset($_POST['action']) && $_POST['action'] == "search-user"){
    $search = $_POST['search'];
    $sql = "SELECT users.employee_id,users.username,users.user_level,employee.employee_id,employee.firstname,employee.lastname FROM users INNER JOIN employee ON users.employee_id = employee.employee_id WHERE users.employee_id LIKE '%{$search}%' or users.username LIKE '%{$search}%'  or employee.firstname LIKE '%{$search}%'";

    $res = mysqli_query($con, $sql);

    $data = "";
    $i = 1;
    $user_level = "";
    if(mysqli_num_rows($res) > 0 ){
        $data .= "<div class='table-responsive'>
        <table class='table table-striped table-hover' id='users-table'>
        <thead class='table-header text-center'>
           <tr>
           <th scope='col'>#</th>
           <th scope='col'>Employee Name</th>
           <th scope='col'>Last Name</th>
           <th scope='col'>Username</th>
           <th scope='col'>User Level</th>
           <th scope='col'>Action</th>
           </tr>
       </thead>";
    
    while($row = mysqli_fetch_assoc($res)){ 
        if($row['user_level'] == 1){
            $user_level = "Admin";   
        }else if($row['user_level'] == 2){
            $user_level = "Supervisor";   
        }
        else if($row['user_level'] == 4){
            $user_level = "Finance";   
        }
        else if($row['user_level'] == 8){
            $user_level = "Project Manager";    
        }else{
            $user_level = "Employee User";
        }
        $data .="<tbody class='text-center'>
        <tr>
        <th>".$i++."</th>
        <td>{$row["firstname"]}</td>
        <td>{$row["lastname"]}</td>
        <td>{$row['username']}</td>
        <td>{$user_level}</td>
        <td><button type='button' class='btn btn-warning  btn-update-users' data-id='{$row["employee_id"]}'' ><i class='fa fa-edit'></i></button>
            <button type='button' class='btn btn-danger btn-delete-users' data-id='{$row["employee_id"]}'><i class='fa fa-trash'></i></button>
        </td>
        </tr>";
    }
    
    $data .= "
    </tbody>
    </table>";
    echo $data;
    
} else {
    echo "<h3 class='text-danger'>Data Not Found!</h3>";
}
   
}

