$(document).ready(function () {
  $(".search_box").selectpicker();
  // Load Employee Data

  function loadEmployee(page) {
    $.ajax({
      url: "php/employee.php",
      type: "post",
      data: { page: page, action: "loadEmployee" },
      success: function (response) {
        if (response == 0) {
          $("#employee-modal-message .modal-body").text("Data Not Found!");
        } else {
          $("#employee-table").html(response);
        }
      },
    });
  }
  loadEmployee();

  $("#employee-table").on("click", ".page-item", function () {
    var page = $(this).attr("id");
    loadEmployee(page);
  });

  // Add Employee
  $("#employee-add-button").click(function (e) {
    e.preventDefault();

    var fname = $("#emp-fname");
    var lname = $("#emp-lname");
    var phone = $("#emp-phone");
    var email = $("#emp-email");
    var bod = $("#emp-bod");
    var emp_type = $("#emp-type");
    var emp_degree = $("#emp-degree");
    var emp_gender = $("input[name='gender']:checked");
    var photo = $("#emp-file");
    var emp_department = $("#emp-department");
    var data = new FormData($("#formEmployee")[0]);
    data.append("action", "AddEmployee");
    fname.removeClass("error");
    lname.removeClass("error");
    phone.removeClass("error");
    email.removeClass("error");
    bod.removeClass("error");
    emp_type.removeClass("error");
    emp_degree.removeClass("error");
    emp_gender.removeClass("error");
    photo.removeClass("error");
    emp_department.removeClass("error");
    if (fname.val() == "") {
      fname.addClass("error");
    } else if (lname.val() == "") {
      lname.addClass("error");
    } else if (email.val() == "") {
      email.addClass("error");
    } else if (phone.val() == "") {
      phone.addClass("error");
    } else if (bod.val() == "") {
      bod.addClass("error");
    } else if (emp_type.val() == 0) {
      emp_type.addClass("error");
    } else if (emp_degree.val() == 0) {
      emp_degree.addClass("error");
    } else if (photo.val() == "") {
      photo.addClass("error");
    } else if (emp_department.val() == "") {
      emp_department.addClass("error");
    } else {
      $.ajax({
        url: "php/employee.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == 2) {
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Allowed Just png,jpeg,gif & jpg!"
            );
          } else if (response == 1) {
            $("#formEmployee")[0].reset();
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Successfully Added Employee!"
            );
            loadEmployee();
          } else {
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Failed To Added Employee!"
            );
          }
        },
      });
    }

    fname.removeClass("error");
    lname.removeClass("error");
    phone.removeClass("error");
    email.removeClass("error");
    bod.removeClass("error");
    emp_type.removeClass("error");
    emp_degree.removeClass("error");
    emp_gender.removeClass("error");
    photo.removeClass("error");
    emp_department.removeClass("error");
    if (fname.val() == "") {
      fname.addClass("error");
    } else if (lname.val() == "") {
      lname.addClass("error");
    } else if (email.val() == "") {
      email.addClass("error");
    } else if (phone.val() == "") {
      phone.addClass("error");
    } else if (bod.val() == "") {
      bod.addClass("error");
    } else if (emp_type.val() == 0) {
      emp_type.addClass("error");
    } else if (emp_degree.val() == 0) {
      emp_degree.addClass("error");
    } else if (photo.val() == "") {
      photo.addClass("error");
    } else if (emp_department.val() == "") {
      emp_department.addClass("error");
    } else {
      $.ajax({
        url: "php/employee.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == 2) {
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Allowed Just png,jpeg,gif & jpg!"
            );
          } else if (response == 1) {
            $("#formEmployee")[0].reset();
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Successfully Added Employee!"
            );
            loadEmployee();
          } else {
            $("#employee-modal-message").modal("show");
            $("#employee-modal-message .modal-body").text(
              "Failed To Added Employee!"
            );
          }
        },
      });
    }
  });
  // End Add Employee

  //  Delete Employee
  $("#employee-table").on("click", ".btn-delete-employee", function () {
    var employee_id = $(this).data("id");
    $.ajax({
      url: "php/employee.php",
      type: "POST",
      data: { employee_id: employee_id, action: "delete_Employee" },
      success: function (response) {
        if (response == 1) {
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").text(
            "Successfully Delete Employee!"
          );
          loadEmployee();
        } else {
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").text(
            "Failed To Delete Employee!, It Exist In Other Task"
          );
        }
      },
    });
  });

  //  End Delete Employee

  // Veiw More

  $(document).on("click", ".btn-view-employee", function () {
    var employee_id = $(this).data("id");

    $.ajax({
      url: "php/employee.php",
      type: "POST",
      data: { employee_id: employee_id, action: "View_more_Employee" },
      success: function (response) {
        if (response != 0) {
          $("#modal-veiw-more").modal("show");
          $("#modal-veiw-more .modal-body").html(response);
        } else {
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").html(
            "Can't Find Employee Details!"
          );
        }
      },
    });
  });

  // End Veiw More

  // Edit Employee

  // Retrieve Data Employee visa
  $("#employee-table").on("click", ".btn-update-employee", function () {
    var employee_id = $(this).data("id");

    $.ajax({
      url: "php/employee.php",
      type: "POST",
      dataType: "json",
      data: { employee_id: employee_id, action: "employee-fetch-data" },
      success: function (response) {
        $("#employee-modal-update").modal("show");
        $("#employee-modal-update .modal-body .employee_id").val(
          response[0].employee_id
        );
        $("#employee-modal-update .modal-body .fname").val(
          response[0].firstname
        );
        $("#employee-modal-update .modal-body .lname").val(
          response[0].lastname
        );
        $("#employee-modal-update .modal-body .phone").val(response[0].phone);
        $("#employee-modal-update .modal-body .email").val(response[0].email);
        $("#employee-modal-update .modal-body .employee_type").val(
          response[0].employee_type
        );
        $("#employee-modal-update .modal-body .employee_degree").val(
          response[0].edu_degree
        );
        $("#employee-modal-update .modal-body .department").val(
          response[0].department_id
        );
        $("#employee-modal-update .modal-body .bod").val(response[0].bod);
        $("#employee-modal-update .modal-body input[name='gender']").each(
          function () {
            if (response[0].gender == $(this).val()) {
              $(this).attr("checked", "checked");
              // $("#employee-modal-update .modal-body input[name='gender'").prop("checked", true);
              //  $(this).attr('checked', 'checked');
            } else {
              //$("#employee-modal-update .modal-body .male").prop("checked", true);
              $(this).removeAttr("checked");
            }
          }
        );
      },
    });
  });
  // End Retrieve Data Employee visa
  // Update Employee
  $("#formEmployeeUpdate .update-employee-button").click(function (e) {
    e.preventDefault();
    //        var emp_gender = $("#formEmployeeUpdate input[name='gender']:checked").val();
    var data = new FormData($("#employee-modal-update #formEmployeeUpdate")[0]);
    data.append("action", "updateEmployee");
    $.ajax({
      url: "php/employee.php",
      type: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data == 1) {
          $("#formEmployeeUpdate")[0].reset();
          $("#employee-modal-update").modal("hide");
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").text(
            "Successfully Updated Employee!"
          );
          loadEmployee();
        } else {
          $("#employee-modal-update").modal("hide");
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").text(
            "Failed To Update Employee!"
          );
        }
      },
    });
  });

  // End Update Employee

  // End Edit Employee

  // Search Live Employee
  $(".search_employee").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/employee.php",
      type: "POST",
      data: { search: search, action: "search-employe" },
      success: function (response) {
        if (response == 0) {
          $("#employee-modal-message").modal("show");
          $("#employee-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#employee-table").html(response);
        }
      },
    });
  });
  // End Search Live Employee
});
