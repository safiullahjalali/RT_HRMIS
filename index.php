<?php
     session_start();
     if(isset($_GET['logout']) && $_GET['logout'] == true){
         session_destroy();
     }
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="icon" href="assets/img/tab-logo.png">
    <link rel="stylesheet" href="assets/bootstrap5/css/bootstrap.min.css">
    <style>
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        }
        body{
        margin: 0;
        padding: 0;
        background: linear-gradient(120deg,#2980b9, #2a2185);
        height: 100vh;
        overflow: hidden;
        }
        .center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: white;
        border-radius: 10px;
        box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
        }
        .center h1{
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid silver;
        }
        .center form{
        padding: 0 40px;
        box-sizing: border-box;
        }
        form .txt_field{
        position: relative;
        border-bottom: 2px solid #adadad;
        margin: 30px 0;
        }
        .txt_field input{
        width: 100%;
        padding: 0 5px;
        height: 40px;
        font-size: 16px;
        border: none;
        background: none;
        outline: none;
        }
        .txt_field label{
        position: absolute;
        top: 50%;
        left: 5px;
        color: #adadad;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        transition: .5s;
        }
        .txt_field span::before{
        content: '';
        position: absolute;
        top: 40px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #2691d9;
        transition: .5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
        top: -5px;
        color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
        width: 100%;
        }
        .pass{
        margin: -5px 0 20px 5px;
        color: #a6a6a6;
        cursor: pointer;
        }
        .pass:hover{
        text-decoration: underline;
        }
        input[type="submit"]{
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 700;
        cursor: pointer;
        outline: none;
        }
        input[type="submit"]:hover{
        border-color: #2691d9;
        transition: .5s;
        }
    </style>
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" required class="username" id="username">
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required class="password" id="password">
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" id="loginButton" value="Login" class="mb-4">
      </form>
    </div>

<!-- Message Modal -->
<div class="modal fade" id="Login-modal-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/bootstrap5/js/bootstrap.bundle.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#loginButton").click(function(even){
            even.preventDefault();
            var username, password, user_level;
            username = $("#username").val();
            password = $("#password").val();
            if(username == "" || password == ""){
                $("#Login-modal-message").modal('show');
                $("#Login-modal-message .modal-body").text('All Fields Are Required!');
            }else{
                $.ajax({
                    url: "assets/php/login.php",
                    type: "POST",
                    data: {username: username, password: password,action:"login"},
                    success: function(data){
                        if(data == 1){
                            $(location).attr("href","assets/admin-panel.php");
                        }else if(data == 2){
                            $(location).attr("href","assets/supervisor-panel.php");
                        }
                        else if(data == 4){
                            $(location).attr("href","assets/finance-panel.php");
                        }
                        else if(data == 8){
                            $(location).attr("href","assets/project-panel.php");
                        }
                        else if(data == 10){
                            $(location).attr("href","assets/user-panel.php");
                        }
                        else{
                            $("#Login-modal-message").modal('show');
                            $("#Login-modal-message .modal-body").text('Username Or Password Are Inccorrect, Please Try Again!');
                        }
                    }
                });
            }
        })
    })
</script>
