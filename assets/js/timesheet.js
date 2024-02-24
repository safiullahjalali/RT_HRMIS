$(document).ready(function () {
  $(".search_box").selectpicker();

  var Records = $("#timesheet-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/timesheet.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "timesheetLoad",
      },
    },
  });

  // function timesheetLoad(page) {
  //   $.ajax({
  //     url: "php/timesheet.php",
  //     type: "POST",
  //     data: { page: page, action: "timesheetLoad" },
  //     success: function (data) {
  //       if (data == 0) {
  //         $("#timesheet-modal-message").modal("show");
  //         $("#timesheet-modal-message .modal-body").text("Data Not Found!");
  //       } else {
  //         $("#timesheet-table").html(data);
  //       }
  //     },
  //   });
  // }
  // timesheetLoad();

  // $("#timesheet-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   timesheetLoad(page);
  // });

  function clearTimesheet() {
    $("#employee_id").val(0);
    $("#project_code").val(0);
    $("#task_date").val("");
    $("#details").val("");
  }

  // Add Timesheet

  $("#timesheet-add-button").click(function () {
    var employee_id = $("#employee_id").val();
    var project_code = $("#project_code").val();
    var task_date = $("#task_date").val();
    var details = $("#details").val();

    if (
      employee_id == 0 ||
      project_code == 0 ||
      task_date == "" ||
      details == ""
    ) {
      $("#timesheet-modal-message").modal("show");
      $("#timesheet-modal-message .modal-body").text("All Fields Required!");
    } else {
      $.ajax({
        url: "php/timesheet.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          project_code: project_code,
          task_date: task_date,
          details: details,
          action: "timesheetAdd",
        },
        success: function (data) {
          if (data == 1) {
            $("#timesheet-modal-message").modal("show");
            $("#timesheet-modal-message .modal-body").text(
              "Successfully Added Time Sheet!"
            );
            Records.ajax.reload();
            clearTimesheet();
          } else {
            $("#timesheet-modal-message").modal("show");
            $("#timesheet-modal-message .modal-body").text(
              "Failed To Added Time Sheet!"
            );
          }
        },
      });
    }
  });

  // End Add Time Sheet
  // Delete Time Sheet
  $("#timesheet-table").on("click", ".btn-delete-timesheet", function () {
    var timesheet_id = $(this).data("id");
    $.ajax({
      url: "php/timesheet.php",
      type: "POST",
      data: { timesheet_id: timesheet_id, action: "timesheetDelete" },
      success: function (data) {
        if (data == 1) {
          $("#timesheet-modal-message").modal("show");
          $("#timesheet-modal-message .modal-body").text(
            "Successfully Deleted Time Sheet!"
          );
          Records.ajax.reload();
        } else {
          $("#timesheet-modal-message").modal("show");
          $("#timesheet-modal-message .modal-body").text(
            "Failed To Deleted Time Sheet!"
          );
        }
      },
    });
  });
  // End Delete Time Sheet

  // Edit Time Sheet

  // Retrieve Time Sheet
  $("#timesheet-table").on("click", ".btn-update-timesheet", function () {
    var timesheet_id = $(this).data("id");
    $.ajax({
      url: "php/timesheet.php",
      type: "POST",
      dataType: "json",
      data: { timesheet_id: timesheet_id, action: "timesheetRetrieve" },
      success: function (data) {
        $("#timesheet-modal-update").modal("show");
        $("#timesheet-modal-update .modal-body .employee_id").val(
          data[0].employee_id
        );
        $("#timesheet-modal-update .modal-body .project_code").val(
          data[0].project_id
        );
        $("#timesheet-modal-update .modal-body .task_date").val(
          data[0].task_date
        );
        $("#timesheet-modal-update .modal-body .details").val(data[0].details);
        $("#timesheet-modal-update .modal-body .timesheet_id").val(
          data[0].timesheet_id
        );
      },
    });
  });
  // End Retrieve Time Sheet

  // Update Time Sheet
  $("#formUpdateTimesheet").on(
    "click",
    ".timesheet-update-button",
    function () {
      var employee_id = $("#formUpdateTimesheet .employee_id").val();
      var project_id = $("#formUpdateTimesheet .project_code").val();
      var task_date = $("#formUpdateTimesheet .task_date").val();
      var details = $("#formUpdateTimesheet .details").val();
      var timesheet_id = $("#formUpdateTimesheet .timesheet_id").val();
      $.ajax({
        url: "php/timesheet.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          project_id: project_id,
          task_date: task_date,
          details: details,
          timesheet_id: timesheet_id,
          action: "timesheetUpdate",
        },
        success: function (data) {
          if (data == 1) {
            $("#timesheet-modal-update").modal("hide");
            $("#timesheet-modal-message").modal("show");
            $("#timesheet-modal-message .modal-body").text(
              "Successfully Updated Time Sheet!"
            );
            Records.ajax.reload();
          } else {
            $("#timesheet-modal-update").modal("hide");
            $("#timesheet-modal-message").modal("show");
            $("#timesheet-modal-message .modal-body").text(
              "Failed To Updated Time Sheet!"
            );
          }
        },
      });
    }
  );
  // End Update Time Sheet

  // End Edit Time Sheet

  // Search Live Time Sheet
  $(".search_timesheet").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/timesheet.php",
      type: "POST",
      data: { search: search, action: "searchTimesheet" },
      success: function (data) {
        if (data == 0) {
          $("#timesheet-modal-message").modal("show");
          $("#timesheet-modal-message .modal-body").text("Data Not Found!");
        } else {
          $("#timesheet-table").html(data);
        }
      },
    });
  });
});
