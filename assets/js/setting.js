$(document).ready(function(){

// update users owen
    $("#update-user").click(function(){
        var username = $("#usernameUser").val();
        var password = $("#passwordUser").val();
        var employee_id = $("#employee_id").val();
        
        $("#passwordUser").removeClass("error");
        $("#usernameUser").removeClass("error");
        
        if(username == ""){
            $("#usernameUser").addClass("error");
        }
        if(password == ""){
            $("#passwordUser").addClass("error");
        }else{
            $.ajax({
                url: "php/update-setting.php",
                type: "POST",
                data : {
                    employee_id : employee_id,
                    username : username,
                    password : password,
                    action: "updateUser"
                },
                success: function(response){
                    if(response == 1){
                        $("#setting-modal-message").modal('show');
                        $("#setting-modal-message .modal-body").text('Successfully Updated!');
                        $("#setting-modal-message .btnOk").click(function(){
                            window.location.href = "../index.php";
                        });
                    }else{
                        $("#setting-modal-message").modal('show');
                        $("#setting-modal-message .modal-body").text('Failed To Updated!');
                    }
                }
            });
        }

    });

    // End update users owen
});