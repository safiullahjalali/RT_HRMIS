$(document).ready(function () {
  $(".search_box").selectpicker();

  // function load Employee Visa

  var Records = $("#employee-visa-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/employee_visa.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "employeeVisaLoad",
      },
    },
  });
  // function loadEmployeeVisa(page) {
  //   $.ajax({
  //     url: "php/employee_visa.php",
  //     type: "post",
  //     data: { page: page, action: "employeeVisaLoad" },
  //     success: function (response) {
  //       if (response) {
  //         $("#employee-visa-table").html(response);
  //       }
  //     },
  //   });
  // }

  // loadEmployeeVisa();

  // $("#employee-visa-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   loadEmployeeVisa(page);
  // });

  // Clear Form

  function clearForm() {
    $(".employee_id").val(0);
    $(".issue_date").val("");
    $(".expire_date").val("");
  }

  //  Add Employee Visa
  $("#add_visa").click(function () {
    var employee_id = $("#employee_id");
    var issue_date = $(".issue_date");
    var expire_date = $(".expire_date");
    employee_id.removeClass("error");
    issue_date.removeClass("error");
    expire_date.removeClass("error");

    if (employee_id.val() == 0) {
      $("#employee_visa-modal-message").modal("show");
      $("#employee_visa-modal-message .modal-body").text(
        "Please Select Employee!"
      );
    } else if (issue_date.val() == "") {
      issue_date.addClass("error");
    } else if (expire_date.val() == "") {
      expire_date.addClass("error");
    } else {
      $.ajax({
        url: "php/employee_visa.php",
        type: "post",
        data: {
          employee_id: employee_id.val(),
          issue_date: issue_date.val(),
          expire_date: expire_date.val(),
          action: "addEmployeeVisa",
        },
        success: function (data) {
          if (data == 1) {
            $("#employee_visa-modal-message").modal("show");
            $("#employee_visa-modal-message .modal-body").text(
              "Successfully Added Employee Visa!"
            );
            Records.ajax.reload();
          } else {
            $("#employee_visa-modal-message").modal("show");
            $("#employee_visa-modal-message .modal-body").text(
              "Failed To Add Employee Visa!"
            );
          }
        },
      });
    }
  });

  // Delete employee visa

  $(document).on("click", ".btn-delete-employee-visa", function () {
    var visa_id = $(this).data("id");
    if (confirm("Are you sure want to delete Employee visa?")) {
      $.ajax({
        url: "php/employee_visa.php",
        type: "POST",
        data: { visa_id: visa_id, action: "deleteEmployeeVisa" },
        success: function (response) {
          if (response == 1) {
            $("#employee_visa-modal-message").modal("show");
            $("#employee_visa-modal-message .modal-body").text(
              "Successfully Delete Employee Visa!"
            );
            Records.ajax.reload();
          } else {
            $("#employee_visa-modal-message").modal("show");
            $("#employee_visa-modal-message .modal-body").text(
              "Failed To Delete Employee Visa!"
            );
          }
        },
      });
    }
  });

  // Edit Employee Visa
  // Update retrive Employee visa

  $(document).on("click", ".btn-update-employee-visa", function () {
    var visa_id = $(this).data("id");
    $.ajax({
      url: "php/employee_visa.php",
      type: "POST",
      dataType: "json",
      data: { visa_id: visa_id, action: "employeeVisaFetchData" },
      success: function (response) {
        $("#employee-visa-modal-update").modal("show");
        $("#employee-visa-form .employee_id").val(response[0].employee_id);
        $("#employee-visa-form .issue_date").val(response[0].issue_date);
        $("#employee-visa-form .expire_date").val(response[0].expire_date);
        $("#employee-visa-form .visa_id").val(response[0].visa_id);
      },
    });
  });
  // End Update retrive Employee visa

  //  Update Data
  $("#employee-visa-form").on("click", "#update_visa", function () {
    var visa_id = $("#employee-visa-form .visa_id").val();
    var employee_id = $("#employee-visa-form .employee_id").val();
    var issue_date = $("#employee-visa-form .issue_date").val();
    var expire_date = $("#employee-visa-form .expire_date").val();

    $.ajax({
      url: "php/employee_visa.php",
      type: "POST",
      data: {
        visa_id: visa_id,
        employee_id: employee_id,
        issue_date: issue_date,
        expire_date: expire_date,
        action: "employeeVisaUpdate",
      },
      success: function (response) {
        if (response == 1) {
          $("#employee-visa-modal-update").modal("hide");
          $("#employee_visa-modal-message").modal("show");
          $("#employee_visa-modal-message .modal-body").text(
            "Successfully Update Employee Visa!"
          );
          Records.ajax.reload();
        } else {
          $("#employee-visa-modal-update").modal("hide");
          $("#employee_visa-modal-message").modal("show");
          $("#employee_visa-modal-message .modal-body").text(
            "Failed To Update Employee Visa!"
          );
        }
      },
    });
  });
  //  End Update Data

  // Edit Employee Visa

  // Search Live Visa
  $(".search_visa").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/employee_visa.php",
      type: "POST",
      data: { search: search, action: "search-employe-visa" },
      success: function (response) {
        if (response == 0) {
          $("#employee_visa-modal-message").modal("show");
          $("#employee_visa-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#employee-visa-table").html(response);
        }
      },
    });
  });
});
