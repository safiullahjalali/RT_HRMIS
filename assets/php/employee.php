<?php   require_once "db.php";

// Load Employee
if(isset($_POST['action']) && $_POST['action'] == 'loadEmployee'){
    $limit = 10;
    $page = 0;

    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }else{
        $page = 1;
    } 

    $start_from = ($page - 1) * $limit;
    $sql = "SELECT employee.employee_id,employee.firstname, employee.lastname, employee.photo, employee.gender, department.department_name FROM employee INNER JOIN department on employee.department_id = department.department_id order by employee.employee_id ASC LIMIT $start_from, $limit "; 

    $result = mysqli_query($con, $sql);
    $gender = "";
    $data = "";
    $i = 1;

    if (mysqli_num_rows($result) > 0) {
        $data .= "<div class='table-responsive'>
        <table class='table table-striped table-hover'>
        <thead class='table-header text-center'>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Employee Name</th>
                <th scope='col'>Last Name</th>
                <th scope='col'>Image</th>
                <th scope='col'>Gender</th>
                <th scope='col'>Department</th>
                <th scope='col'>Action</th>
                </tr>
            </thead>
        <tbody>";
                
        while ($row = mysqli_fetch_assoc($result)) {
            
            if($row['gender'] == 0) { $gender = "Male";}else{$gender = "Female";}
            
            $data .= "<tbody class='text-center'>
            <tr>
            <th>".$i++."</th>
            <td>{$row["firstname"]}</td>
            <td>{$row["lastname"]}</td>
            <td><img src='upload-img-employee/{$row["photo"]}' style= 'width: 80px; height:80px; border-radius:10px' alt=''></td>
            <td>$gender</td>
            <td>{$row['department_name']}</td>
            <td><button type='button' class='btn btn-warning  btn-update-employee' data-id='{$row["employee_id"]}'' ><i class='fa fa-edit'></i></button>
                <button type='button' class='btn btn-info btn-view-employee' data-id='{$row["employee_id"]}' ><i class='fa fa-info'></i></button>
                <button type='button' class='btn btn-danger btn-delete-employee' data-id='{$row["employee_id"]}'><i class='fa fa-trash'></i></button>
            </td>
            </tr>";
        
            
        }
       
    } else {
        echo "<h2 class='text-danger text-center fw-bold mt-2'>Data Not Found...</h2>";
    }
    $data .= "
        </tbody>
        </table></div>";
    
     $query = "SELECT employee.employee_id,employee.firstname, employee.lastname, employee.photo, employee.gender, department.department_name FROM employee INNER JOIN department on employee.department_id = department.department_id";
    
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


// Add Employee

if(isset($_POST['action']) && $_POST['action'] == 'AddEmployee'){
     
     
    $fname = $_POST['fname']; 
    $lname = $_POST['lname'];  
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $bod = $_POST['bod']; 
    $emp_type = $_POST['emp_type']; 
    $emp_gender = $_POST['gender']; 
    $emp_department = $_POST['emp_department']; 
    $emp_degree = $_POST['emp_degree']; 
    $photo = $_FILES['emp_image']['name'];
    $tmp_name = $_FILES['emp_image']['tmp_name'];
    $ext = array('gif','png','jpg','jpeg');
    $fileExtension = pathinfo($photo,PATHINFO_EXTENSION);
    if(!in_array($fileExtension,$ext)){
        echo 2;
    }else{
        $filename = time().".png";
        $uploadfile = move_uploaded_file($tmp_name,"../upload-img-employee/".$filename);
        if($uploadfile){ 
            $sql = "INSERT INTO employee (employee_id,firstname,lastname,photo,email,phone,edu_degree,employee_type,birth_year,gender,department_id) VALUES(null,'{$fname}','{$lname}','{$filename}','{$email}','{$phone}','{$emp_degree}',{$emp_type},'{$bod}',{$emp_gender},{$emp_department})";
            $result = mysqli_query($con,$sql);
    
            if($result){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    
}


// View More Employee
if(isset($_POST['action']) && $_POST['action'] == 'View_more_Employee'){
    $employee_id = $_POST['employee_id'];


    $sql = "SELECT employee.employee_id,employee.firstname, employee.lastname, employee.photo, employee.gender,employee.phone,employee.email,employee. edu_degree,employee.employee_type, employee.birth_year,department.department_name FROM employee INNER JOIN department on employee.department_id = department.department_id WHERE employee_id = {$employee_id}"; 
    $result = mysqli_query($con, $sql);
    $data = "";
    $gender = "";
    $emp_type = "";
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        
        if($row['gender'] == 0) { $gender = "Male";}else{$gender = "Female";}
        if($row['employee_type'] == 100) { $emp_type = "Foreign";}else{$emp_type = "Local";}
        $data .= "
                <div class='card' style='max-width: 640px;'>
                <div class='row g-0 shadow-lg'>
                <div class='col-md-5 m-auto'>
                <img src='upload-img-employee/".$row['photo']."' width='100' height='100' class=' rounded mt-1' style='border-radius:20px' alt='...'>
                </div>
                <div class='col-md-8 m-auto'>
                    <div class='card-body'>
                    <table class='table text-start'>
                    <tbody>
                        <tr>
                            <th><label>ID#:</label></th>
                            <td><label>{$row['employee_id']}</label></td>
                        </tr>
                        <tr>
                            <th><label>First Name:</label></th>
                            <td><label>{$row['firstname']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Last Name:</label></th>
                            <td><label>{$row['lastname']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Gender:</label></th>
                            <td><label>{$gender}</label></td>
                        </tr>
                        <tr>
                            <th><label>Email:</label></th>
                            <td><label>{$row['email']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Phone#:</label></th>
                            <td><label>{$row['phone']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Education Degree:</label></th>
                            <td><label>{$row['edu_degree']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Employee Type:</label></th>
                            <td><label>{$emp_type}</label></td>
                        </tr>
                        <tr>
                            <th><label>Birth Year:</label></th>
                            <td><label>{$row['birth_year']}</label></td>
                        </tr>
                        <tr>
                            <th><label>Department:</label></th>
                            <td><label>{$row['department_name']}</label></td>
                        </tr>
                    
                
    ";
        $data .= "
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>";
        mysqli_close($con);
        echo $data;
    } 
    }
    else {
        echo 0;
    }

}


// Delete Employee
if(isset($_POST['action']) && $_POST['action'] == 'delete_Employee'){

    $employee_id = $_POST['employee_id'];
    $query = "SELECT * FROM employee WHERE employee_id = $employee_id";
    $row = mysqli_fetch_assoc(mysqli_query($con,$query));
    $sql = "DELETE FROM employee WHERE employee_id = {$employee_id}";

    $result = mysqli_query($con, $sql);
    if($result) {
        unlink("../upload-img-employee/".$row['photo']);
        echo 1;
    } else {
        echo 0;
    }
}


// Retrieve Edit Employee
if(isset($_POST['action']) && $_POST['action']== "employee-fetch-data"){

    $employee_id = $_POST['employee_id'];

    $sql = "SELECT employee.employee_id,employee.firstname, employee.lastname, employee.photo, employee.gender,employee.phone,employee.email,employee. edu_degree,employee.employee_type, employee.birth_year,department.department_id FROM employee INNER JOIN department on employee.department_id = department.department_id WHERE employee_id = {$employee_id}";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    
    $employee_id = $row['employee_id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $gender = $row['gender'];
    $phone = $row['phone'];
    $email = $row['email'];
    $edu_degree = $row['edu_degree'];
    $employee_type = $row['employee_type'];
    $bod = $row['birth_year'];
    $department_id = $row['department_id'];
    
    $return_array[] = array(
        "employee_id"=>$employee_id,
        "firstname"=>$firstname,
        "lastname"=>$lastname,
        "gender"=>$gender,
        "phone"=>$phone,
        "email"=>$email,
        "edu_degree"=>$edu_degree,
        "employee_type"=>$employee_type,
        "bod"=>$bod,
        "department_id"=>$department_id,
    );

    echo json_encode($return_array);
    exit(); 
}


// Update Employee
if(isset($_POST['action']) && $_POST['action'] == "updateEmployee"){
   
    $employee_id = $_POST['employee_id'];
    $fname = $_POST['fname']; 
    $lname = $_POST['lname'];  
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $bod = $_POST['bod']; 
    $emp_type = $_POST['emp_type']; 
    $emp_gender = $_POST['gender']; 
    $emp_department = $_POST['emp_department']; 
    $emp_degree = $_POST['emp_degree']; 
    $photo = $_FILES['emp_image']['name'];
    $tmp_name = $_FILES['emp_image']['tmp_name'];
    $realname ="";
    $query = "SELECT * FROM employee WHERE employee_id = $employee_id";
    $row = mysqli_fetch_assoc(mysqli_query($con,$query));
    if($_FILES['emp_image']['name'] == ""){
        $realname = $row['photo'];
        $sql = "UPDATE employee SET 
                firstname = '{$fname}',
                lastname = '{$lname}',
                photo = '{$realname}',
                email = '{$email}', 
                phone = '{$phone}',
                edu_degree = '{$emp_degree}',
                employee_type = '{$emp_type}',
                birth_year = '{$bod}',
                gender = '{$emp_gender}',
                department_id = '{$emp_department}' WHERE employee_id = $employee_id";
            if(mysqli_query($con,$sql)){
                echo 1;
            }else{
                echo 0;
            }
    }else{
        $realname=time().".png";
        $uploadfile = move_uploaded_file($tmp_name,"../upload-img-employee/".$realname);
        if($uploadfile){
            unlink("../upload-img-employee/".$row['photo']);
            $sql = "UPDATE employee SET 
                    firstname = '{$fname}',
                    lastname = '{$lname}',
                    photo = '{$realname}',
                    email = '{$email}', 
                    phone = '{$phone}',
                    edu_degree = '{$emp_degree}',
                    employee_type = '{$emp_type}',
                    birth_year = '{$bod}',
                    gender = '{$emp_gender}',
                    department_id = '{$emp_department}' WHERE employee_id = {$employee_id}";
            if(mysqli_query($con,$sql)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}


// Search Live Employee
if(isset($_POST['action']) && $_POST['action'] == "search-employe"){
    $search = $_POST['search'];
    $sql = "SELECT employee.employee_id,employee.firstname, employee.lastname, employee.photo, employee.gender, department.department_name FROM employee INNER JOIN department on employee.department_id = department.department_id WHERE employee.employee_id LIKE '%{$search}%' or employee.firstname LIKE '%{$search}%'"; 
    $result = mysqli_query($con, $sql);
    $data = "";
    $gender = "";
    $i = 1;
    if (mysqli_num_rows($result) > 0) {
        $data .= "<table class='table table-striped table-hover'>
        <thead class='table-header text-center'>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Employee Name</th>
                <th scope='col'>Last Name</th>
                <th scope='col'>Image</th>
                <th scope='col'>Gender</th>
                <th scope='col'>Department</th>
                <th scope='col'>Action</th>
                </tr>
            </thead>
        <tbody>";
                
        while ($row = mysqli_fetch_assoc($result)) {
            
            if($row['gender'] == 0) { $gender = "Male";}else{$gender = "Female";}
            
            $data .= "<tbody class='text-center'>
            <tr>
            <th>".$i++."</th>
            <td>{$row["firstname"]}</td>
            <td>{$row["lastname"]}</td>
            <td><img src='upload-img-employee/{$row["photo"]}' style= 'width: 80px; height:80px; border-radius:10px' alt=''></td>
            <td>$gender</td>
            <td>{$row['department_name']}</td>
            <td><button type='button' class='btn btn-warning  btn-update-employee' data-id='{$row["employee_id"]}'' ><i class='fa fa-edit'></i></button>
                <button type='button' class='btn btn-outline-info btn-view-employee' data-id='{$row["employee_id"]}' ><i class='fa fa-info'></i></button>
                <button type='button' class='btn btn-danger btn-delete-employee' data-id='{$row["employee_id"]}'><i class='fa fa-trash'></i></button>
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