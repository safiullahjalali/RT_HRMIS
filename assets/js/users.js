$(document).ready(function () {
  $(".search_box").selectpicker();
  function loadUsers(page) {
    $.ajax({
      url: "php/users.php",
      type: "POST",
      data: { page: page, action: "loadUsers" },
      success: function (data) {
        if (data == 0) {
          $("#users-modal-message").modal("show");
          $("#users-modal-message .modal-body").text("Data Note Found");
        } else {
          $("#users-table").html(data);
        }
      },
    });
  }
  loadUsers();

  $("#users-table").on("click", ".page-item", function () {
    var page = $(this).attr("id");
    loadUsers(page);
  });

  function clearUsers() {
    $("#employee").val(0);
    $("#username").val("");
    $("#password").val("");
    $("#user_level").val(0);
  }

  // Add Users
  $("#add_user").click(function () {
    var employee_id = $("#employee").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var user_level = $("#user_level").val();

    if (
      employee_id == 0 ||
      username == "" ||
      password == "" ||
      user_level == 0
    ) {
      $("#users-modal-message").modal("show");
      $("#users-modal-message .modal-body").text("All Fields Are Required!");
    } else {
      $.ajax({
        url: "php/users.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          username: username,
          password: password,
          user_level: user_level,
          action: "addUsers",
        },
        success: function (data) {
          if (data == 1) {
            $("#users-modal-message").modal("show");
            $("#users-modal-message .modal-body").text(
              "Successfully Added Users!"
            );
            loadUsers();
            clearUsers();
          } else {
            $("#users-modal-message").modal("show");
            $("#users-modal-message .modal-body").text(
              "Failed To Added Users!"
            );
          }
        },
      });
    }
  });

  // End Add Users
  // Delete Users
  $("#users-table").on("click", ".btn-delete-users", function () {
    var employee_id = $(this).data("id");
    $.ajax({
      url: "php/users.php",
      type: "POST",
      data: { employee_id: employee_id, action: "deleteUsers" },
      success: function (data) {
        if (data == 1) {
          $("#users-modal-message").modal("show");
          $("#users-modal-message .modal-body").text(
            "Successfully Deleted Users!"
          );
          loadUsers();
        } else {
          $("#users-modal-message").modal("show");
          $("#users-modal-message .modal-body").text(
            "Failed To Deleted Users!"
          );
        }
      },
    });
  });
  // End Delete Users

  // Edit Users
  // Retrieve Users
  $("#users-table").on("click", ".btn-update-users", function () {
    var employee_id = $(this).data("id");
    $.ajax({
      url: "php/users.php",
      type: "POST",
      dataType: "json",
      data: { employee_id: employee_id, action: "retrieveUsers" },
      success: function (data) {
        $("#users-modal-update").modal("show");
        $("#users-modal-update .modal-body .employee").val(data[0].employee_id);
        $("#users-modal-update .modal-body .username").val(data[0].username);
        $("#users-modal-update .modal-body .password").val(data[0].password);
        $("#users-modal-update .modal-body .user_level").val(
          data[0].user_level
        );
      },
    });
  });
  // End Retrieve Users
  // Update Users
  $("#users-modal-update .update_user").click(function () {
    var employee_id = $("#users-modal-update .employee").val();
    var username = $("#users-modal-update .username").val();
    var password = $("#users-modal-update .password").val();
    var user_level = $("#users-modal-update .user_level").val();
    $.ajax({
      url: "php/users.php",
      type: "POST",
      data: {
        employee_id: employee_id,
        username: username,
        password: password,
        user_level: user_level,
        action: "updateUsers",
      },
      success: function (data) {
        if (data == 1) {
          $("#users-modal-update").modal("hide");
          $("#users-modal-message").modal("show");
          $("#users-modal-message .modal-body").text(
            "Successfully Updated Users!"
          );
          loadUsers();
        } else {
          $("#users-modal-update").modal("hide");
          $("#users-modal-message").modal("show");
          $("#users-modal-message .modal-body").text(
            "Failed To Updated Users!"
          );
        }
      },
    });
  });
  // End Update Users
  // End Edit Users

  //Search Live
  $(".search_user").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/users.php",
      type: "POST",
      data: { search: search, action: "search-user" },
      success: function (response) {
        if (response == 0) {
          $("#users-table").html(response);
        } else {
          $("#users-table").html(response);
        }
      },
    });
  });
});
