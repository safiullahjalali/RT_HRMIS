$(document).ready(function () {
  $(".search_box").selectpicker();
  // Load Timesheet Employee
  function loadTimeSheetEmployee(page) {
    var employee_id = $(".emp_id").val();
    $.ajax({
      url: "php/employee-timesheet.php",
      type: "POST",
      data: {
        page: page,
        employee_id: employee_id,
        action: "employeeTimesheetLoad",
      },
      success: function (data) {
        if (data == 0) {
          alert("Not Found");
        } else {
          $("#employee-timesheet-table").html(data);
        }
      },
    });
  }
  loadTimeSheetEmployee();
  // Pagination Section
  $("#employee-timesheet-table").on("click", ".page-item", function () {
    var page = $(this).attr("id");
    loadTimeSheetEmployee(page);
  });
  // Add Employee Timesheet
  $("#timesheet-employee-add-button").click(function () {
    var employee_id = $(".emp_id").val();
    var project_id = $("#project_name").val();
    var task_date = $("#task_date").val();
    var task = $("#task").val();

    if (
      employee_id == 0 ||
      project_id == 0 ||
      task_date == "" ||
      task_date == ""
    ) {
      $("#employee-timesheet-modal-message").modal("show");
      $("#employee-timesheet-modal-message .modal-body").text(
        "All Fields Are Required!"
      );
    } else {
      $.ajax({
        url: "php/employee-timesheet.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          project_id: project_id,
          task_date: task_date,
          task: task,
          action: "addEmployeeTimesheet",
        },
        success: function (data) {
          if (data == 1) {
            $("#employee-timesheet-modal-message").modal("show");
            $("#employee-timesheet-modal-message .modal-body").text(
              "Successfully Added Timesheet!"
            );
            loadTimeSheetEmployee();
          } else {
            $("#employee-timesheet-modal-message").modal("show");
            $("#employee-timesheet-modal-message .modal-body").text(
              "Failed To Add Timesheet!"
            );
          }
        },
      });
    }
  });
});
