$(document).ready(function () {
  $(".search_box").selectpicker();

  var Records = $("#assign-project-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/assign-project.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "LoadAssignProject",
      },
    },
  });

  // function LoadAssignProject(page) {
  //   $.ajax({
  //     url: "php/assign-project.php",
  //     type: "POST",
  //     data: { page: page, action: "LoadAssignProject" },
  //     success: function (data) {
  //       if (data != 0) {
  //         $("#assign-project-table").html(data);
  //       } else {
  //         $("#assign-project-modal-message").modal("show");
  //         $("#assign-project-modal-message .modal-body").text(
  //           "Data Note Found!"
  //         );
  //       }
  //     },
  //   });
  // }

  // LoadAssignProject();

  // $("#assign-project-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   LoadAssignProject(page);
  // });

  // Add assign project

  $("#project-assign-button").click(function () {
    var employee_id = $("#employee_id").val();
    var project_id = $("#project_id").val();
    var start_date = $("#date_start").val();
    var end_date = $("#date_end").val();

    if (
      employee_id == 0 ||
      project_id == 0 ||
      start_date == "" ||
      end_date == ""
    ) {
      $("#assign-project-modal-message").modal("show");
      $("#assign-project-modal-message .modal-body").text(
        "All Fields Are Reqiured!"
      );
    } else {
      $.ajax({
        url: "php/assign-project.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          project_id: project_id,
          start_date: start_date,
          end_date: end_date,
          action: "addAssignProject",
        },
        success: function (data) {
          if (data == 1) {
            $("#formAssignProject")[0].reset();
            $("#assign-project-modal-message").modal("show");
            $("#assign-project-modal-message .modal-body").text(
              "Successfully Assign!"
            );
            Records.ajax.reload();
          } else {
            $("#assign-project-modal-message").modal("show");
            $("#assign-project-modal-message .modal-body").text(
              "Failed To Assign!"
            );
          }
        },
      });
    }
  });

  // Delete assign project
  $("#assign-project-table").on(
    "click",
    ".btn-delete-assign-project",
    function () {
      var assign_id = $(this).data("id");
      if (confirm("Are you sure you want to delete") == true) {
        $.ajax({
          url: "php/assign-project.php",
          type: "POST",
          data: { assign_id: assign_id, action: "deleteAssignProject" },
          success: function (data) {
            if (data == 1) {
              $("#assign-project-modal-message").modal("show");
              $("#assign-project-modal-message .modal-body").text(
                "Successfully Deleted!"
              );
              Records.ajax.reload();
            } else {
              $("#assign-project-modal-message").modal("show");
              $("#assign-project-modal-message .modal-body").text(
                "Failed To Delete!"
              );
            }
          },
        });
      }
    }
  );

  // Edit assign Project

  // Fetch assign project Data

  $("#assign-project-table").on(
    "click",
    ".btn-update-assign-project",
    function () {
      var assign_id = $(this).data("id");
      $.ajax({
        url: "php/assign-project.php",
        type: "POST",
        dataType: "json",
        data: { assign_id: assign_id, action: "fetchAssignProject" },
        success: function (data) {
          $("#assign-project-modal-update").modal("show");
          $("#assign-project-modal-update .modal-body .assign_id").val(
            data.assign_id
          );
          $("#assign-project-modal-update .modal-body .employee_id").val(
            data.employee_id
          );
          $("#assign-project-modal-update .modal-body .project_id").val(
            data.project_id
          );
          $("#assign-project-modal-update .modal-body .date_start").val(
            data.date_start
          );
          $("#assign-project-modal-update .modal-body .date_end").val(
            data.date_end
          );
        },
      });
    }
  );

  // Update Assign project

  $(
    "#assign-project-modal-update .modal-body #update-project-assign-button"
  ).click(function () {
    var assign_id = $(
      "#assign-project-modal-update .modal-body .assign_id"
    ).val();
    var employee_id = $(
      "#assign-project-modal-update .modal-body .employee_id"
    ).val();
    var project_id = $(
      "#assign-project-modal-update .modal-body .project_id"
    ).val();
    var date_start = $(
      "#assign-project-modal-update .modal-body .date_start"
    ).val();
    var date_end = $(
      "#assign-project-modal-update .modal-body .date_end"
    ).val();

    if (
      employee_id == 0 ||
      project_id == 0 ||
      date_start == "" ||
      date_end == ""
    ) {
      $("#assign-project-modal-update").modal("hide");
      $("#assign-project-modal-message").modal("show");
      $("#assign-project-modal-message .modal-body").text(
        "All Fileds Are Required!"
      );
    } else {
      $.ajax({
        url: "php/assign-project.php",
        type: "POST",
        data: {
          assign_id: assign_id,
          project_id: project_id,
          employee_id: employee_id,
          date_start: date_start,
          date_end: date_end,
          action: "updateAssignProject",
        },
        success: function (data) {
          if (data == 1) {
            $("#assign-project-modal-update").modal("hide");
            $("#assign-project-modal-message").modal("show");
            $("#assign-project-modal-message .modal-body").text(
              "Successfully Updated!"
            );
            Records.ajax.reload();
          } else {
            $("#assign-project-modal-update").modal("hide");
            $("#assign-project-modal-message").modal("show");
            $("#assign-project-modal-message .modal-body").text(
              "Failed To Update!"
            );
          }
        },
      });
    }
  });

  // Search Live Assign Project

  $(".search_user").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/assign-project.php",
      type: "POST",
      data: { search: search, action: "searchAssignProject" },
      success: function (response) {
        if (response == 0) {
          $("#assign-project-modal-message").modal("show");
          $("#assign-project-modal-message").html("No Data Found!");
        } else {
          $("#assign-project-table").html(response);
        }
      },
    });
  });
});
