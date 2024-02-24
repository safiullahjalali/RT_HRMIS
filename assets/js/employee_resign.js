$(document).ready(function () {
  $(".search_box").selectpicker();
  function clearForm() {
    $(".employee_id").val(0);
    $("#resign_date").val("");
    $("#reason").val("");
  }

  var Records = $("#employee-resign-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/employee-resign.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "loadEmployeeResign",
      },
    },
  });

  // function loadResignEmployee(page) {
  //   $.ajax({
  //     url: "php/employee-resign.php",
  //     type: "POST",
  //     data: { page: page, action: "loadEmployeeResign" },
  //     success: function (response) {
  //       if (response) {
  //         $("#employee-resign-table").html(response);
  //       }
  //     },
  //   });
  // }
  // loadResignEmployee();

  // $("#employee-resign-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   loadResignEmployee(page);
  // });

  // Add employee resign
  $("#add_resign").click(function () {
    var employee_id = $("#employee_id");
    var resign_date = $("#resign_date");
    var reason = $("#reason");
    resign_date.removeClass("error");
    reason.removeClass("error");
    if (employee_id.val() == 0) {
      $("#employee-resign-modal-message").modal("show");
      $("#employee-resign-modal-message .modal-body").text(
        "Please Select Employee!"
      );
    } else if (resign_date.val() == "") {
      resign_date.addClass("error");
    } else if (reason.val() == "") {
      reason.addClass("error");
    } else {
      $.ajax({
        url: "php/employee-resign.php",
        type: "POST",
        data: {
          employee_id: employee_id.val(),
          resign_date: resign_date.val(),
          reason: reason.val(),
          action: "addEmployeeResign",
        },
        success: function (response) {
          if (response == 1) {
            $("#employee-resign-modal-message").modal("show");
            $("#employee-resign-modal-message .modal-body").text(
              "Successfully Added Employee Resign!"
            );
            Records.ajax.reload();
            clearForm();
          } else {
            $("#employee-resign-modal-message").modal("show");
            $("#employee-resign-modal-message .modal-body").text(
              "Failed To Added Employee Resign!"
            );
          }
        },
      });
    }
  });

  // End Add employee resign

  // Delete employee resign
  $(document).on("click", ".btn-delete-employee-resign", function () {
    var resign_id = $(this).data("id");
    $.ajax({
      url: "php/employee-resign.php",
      type: "POST",
      data: { resign_id: resign_id, action: "deleteEmployeeResign" },
      success: function (response) {
        if (response == 1) {
          $("#employee-resign-modal-message").modal("show");
          $("#employee-resign-modal-message .modal-body").text(
            "Successfully Deleted Resign Employee!"
          );
          Records.ajax.reload();
        } else {
          $("#employee-resign-modal-message").modal("show");
          $("#employee-resign-modal-message .modal-body").text(
            "Failed To Deleted Resign Employee!"
          );
        }
      },
    });
  });

  // End Delete employee resign

  // Edit employee resign

  // Retrieve employee resign
  $(document).on("click", ".btn-update-employee-resign", function () {
    var resign_id = $(this).data("id");
    $.ajax({
      url: "php/employee-resign.php",
      type: "POST",
      dataType: "json",
      data: { resign_id: resign_id, action: "retrieveEmployeeResign" },
      success: function (response) {
        $("#employee-resign-modal-update").modal("show");
        $("#employee-resign-modal-update .employee_id").val(
          response[0].employee_id
        );
        $("#employee-resign-modal-update .resign_id").val(
          response[0].resign_id
        );
        $("#employee-resign-modal-update .resign_date").val(
          response[0].resign_date
        );
        $("#employee-resign-modal-update .reason").val(response[0].reason);
      },
    });
  });

  // End Retrieve employee resign

  // Update employee resign
  $("#update_resign").on("click", function () {
    var employee_id = $("#employee-resign-form .employee_id").val();
    var resign_id = $("#employee-resign-form .resign_id").val();
    var resign_date = $("#employee-resign-form .resign_date").val();
    var reason = $("#employee-resign-form .reason").val();

    $.ajax({
      url: "php/employee-resign.php",
      type: "POST",
      data: {
        resign_id: resign_id,
        employee_id: employee_id,
        resign_date: resign_date,
        reason: reason,
        action: "employeeResignUpdate",
      },
      success: function (response) {
        if (response == 1) {
          $("#employee-resign-modal-update").modal("hide");
          $("#employee-resign-modal-message").modal("show");
          $("#employee-resign-modal-message .modal-body").text(
            "Successfully Update Employee Resign!"
          );
          Records.ajax.reload();
        } else {
          $("#employee-resign-modal-update").modal("hide");
          $("#employee-resign-modal-message").modal("show");
          $("#employee-resign-modal-message .modal-body").text(
            "Failed To Update Employee Resign!"
          );
        }
      },
    });
  });

  // End Update employee resign

  // Search Live employee resign
  $(".search_resign").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/employee-resign.php",
      type: "POST",
      data: { search: search, action: "search-employe-resign" },
      success: function (response) {
        if (response == 0) {
          $("#employee-resign-modal-message").modal("show");
          $("#employee-resign-modal-message .modal-body").html(
            "No Data Found!"
          );
        } else {
          $("#employee-resign-table").html(response);
        }
      },
    });
  });
  // End Search Live employee resign
});
