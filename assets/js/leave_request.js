$(document).ready(function () {
  $(".search_box").selectpicker();

  var Records = $("#leave-request-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/leave-request.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "loadLeaveRequest",
      },
    },
  });

  function clearLeaveRequest() {
    $("#employee").val(0);
    $("#start_date").val("");
    $("#end_date").val("");
    $("#request_date").val("");
    $("#remark").val("");
  }

  // Add Leave Request
  $("#add_leave").click(function () {
    var employee_id = $("#employee");
    var start_date = $("#start_date");
    var end_date = $("#end_date");
    var request_date = $("#request_date");
    var remark = $("#remark");

    request_date.removeClass("error");
    start_date.removeClass("error");
    end_date.removeClass("error");
    remark.removeClass("error");

    if (employee_id.val() == 0) {
      $("#leave-modal-message").modal("show");
      $("#leave-modal-message .modal-body").text("Please Select Employee!");
    } else if (request_date.val() == "") {
      request_date.addClass("error");
    } else if (start_date.val() == "") {
      start_date.addClass("error");
    } else if (end_date.val() == "") {
      end_date.addClass("error");
    } else if (remark.val() == "") {
      remark.addClass("error");
    } else {
      $.ajax({
        url: "php/leave-request.php",
        type: "POST",
        data: {
          employee_id: employee_id.val(),
          start_date: start_date.val(),
          end_date: end_date.val(),
          request_date: request_date.val(),
          remark: remark.val(),
          action: "leaveRequestAdd",
        },
        success: function (response) {
          if (response == 1) {
            $("#leave-modal-message").modal("show");
            $("#leave-modal-message .modal-body").text(
              "Successfully Added Leave Request!"
            );
            Records.ajax.reload();
            clearLeaveRequest();
          } else {
            $("#leave-modal-message").modal("show");
            $("#leave-modal-message .modal-body").text(
              "Failed To Added Leave Request!"
            );
          }
        },
      });
    }
  });

  // End Add Leave Request

  // Delete Leave Request
  $("#leave-request-table").on("click", ".btn-delete-leave", function () {
    var request_id = $(this).data("id");
    $.ajax({
      url: "php/leave-request.php",
      type: "post",
      data: {
        request_id: request_id,
        action: "leaveRequestDelete",
      },
      success: function (response) {
        if (response == 1) {
          $("#leave-modal-message").modal("show");
          $("#leave-modal-message .modal-body").text(
            "Successfully Deleted Leave Request!"
          );
          Records.ajax.reload();
        } else {
          $("#leave-modal-message").modal("show");
          $("#leave-modal-message .modal-body").text(
            "Faile To Deleted Leave Request!"
          );
        }
      },
    });
  });
  // End Delete Leave Request

  // Edit Leave Request
  // Retrieve Leave Request
  $("#leave-request-table").on("click", ".btn-update-leave", function () {
    var request_id = $(this).data("id");
    $.ajax({
      url: "php/leave-request.php",
      type: "post",
      dataType: "json",
      data: {
        request_id: request_id,
        action: "leaveRequestRetrieve",
      },
      success: function (response) {
        $("#leave-modal-update").modal("show");
        $("#leave-modal-update .modal-body .employee").val(
          response[0].employee_id
        );
        $("#leave-modal-update .modal-body .request_date").val(
          response[0].request_date
        );
        $("#leave-modal-update .modal-body .start_date").val(
          response[0].start_date
        );
        $("#leave-modal-update .modal-body .end_date").val(
          response[0].end_date
        );
        $("#leave-modal-update .modal-body .remark").val(response[0].remark);
        $("#leave-modal-update .modal-body .request_id").val(
          response[0].request_id
        );
      },
    });
  });
  // End Retrieve Leave Request
  // Update Leave Request
  $("#leave-modal-update .update-leave").click(function () {
    var employee_id = $("#leave-modal-update .employee").val();
    var start_date = $("#leave-modal-update .start_date").val();
    var end_date = $("#leave-modal-update .end_date").val();
    var request_date = $("#leave-modal-update .request_date").val();
    var remark = $("#leave-modal-update .remark").val();
    var request_id = $("#leave-modal-update .request_id").val();

    $.ajax({
      url: "php/leave-request.php",
      type: "POST",
      data: {
        employee_id: employee_id,
        start_date: start_date,
        end_date: end_date,
        request_date: request_date,
        remark: remark,
        request_id: request_id,
        action: "leaveRequestUpdate",
      },
      success: function (response) {
        if (response == 1) {
          $("#leave-modal-update").modal("hide");
          $("#leave-modal-message").modal("show");
          $("#leave-modal-message .modal-body").text(
            "Successfully Updated Leave Request!"
          );
          Records.ajax.reload();
        } else {
          $("#leave-modal-update").modal("hide");
          $("#leave-modal-message").modal("show");
          $("#leave-modal-message .modal-body").text(
            "Failed To Updated Leave Request!"
          );
        }
      },
    });
  });
  // End Update Leave Request
  // End Edit Leave Request

  // Search Live Leave Request
  $(".search_leave").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/leave-request.php",
      type: "POST",
      data: { search: search, action: "searchLeaveRequest" },
      success: function (response) {
        if (response == 0) {
          $("#leave-modal-message").modal("show");
          $("#leave-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#leave-request-table").html(response);
        }
      },
    });
  });
});
