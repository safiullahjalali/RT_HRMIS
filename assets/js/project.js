$(document).ready(function () {
  var Records = $("#project-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/project.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "projectLoad",
      },
    },
  });
  // function projectLoad(page) {
  //   $.ajax({
  //     url: "php/project.php",
  //     type: "POST",
  //     data: { page: page, action: "projectLoad" },
  //     success: function (data) {
  //       if (data == 0) {
  //         $("#project-modal-message").modal("show");
  //         $("#project-modal-message .modal-body").text("Data Not Found!");
  //       } else {
  //         $("#project-table").html(data);
  //       }
  //     },
  //   });
  // }
  function clearProject() {
    $("#project_name").val("");
    $("#donor_name").val("");
    $("#project_type").val(0);
    $("#date_start").val("");
    $("#date_end").val("");
    $("#project_cost").val("");
    $("#projcet_currency").val(0);
  }

  // projectLoad();

  // $("#project-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   projectLoad(page);
  // });

  // Add Project
  $("#project-add-button").click(function () {
    var project_name = $("#project_name");
    var donor_name = $("#donor_name");
    var project_type = $("#project_type");
    var start_date = $("#date_start");
    var end_date = $("#date_end");
    var project_cost = $("#project_cost");
    var currency = $("#projcet_currency");
    var project_code = $("#projcet_code");
    project_code.removeClass("error");
    project_name.removeClass("error");
    donor_name.removeClass("error");
    project_cost.removeClass("error");
    currency.removeClass("error");
    start_date.removeClass("error");
    end_date.removeClass("error");
    project_type.removeClass("error");
    if (project_code.val() == "") {
      project_code.addClass("error");
    } else if (project_name.val() == "") {
      project_name.addClass("error");
    } else if (donor_name.val() == "") {
      donor_name.addClass("error");
    } else if (project_type.val() == 0) {
      project_type.addClass("error");
    } else if (project_cost.val() == "") {
      project_cost.addClass("error");
    } else if (currency.val() == 0) {
      currency.addClass("error");
    } else if (start_date.val() == 0) {
      start_date.addClass("error");
    } else if (end_date.val() == 0) {
      end_date.addClass("error");
    } else {
      $.ajax({
        url: "php/project.php",
        type: "POST",
        data: {
          project_name: project_name.val(),
          donor_name: donor_name.val(),
          project_type: project_type.val(),
          start_date: start_date.val(),
          end_date: end_date.val(),
          project_cost: project_cost.val(),
          currency: currency.val(),
          project_code: project_code.val(),
          action: "projectAdd",
        },
        success: function (data) {
          if (data == 1) {
            $("#project-modal-message").modal("show");
            $("#project-modal-message .modal-body").text(
              "Successfully Added Project!"
            );
            Records.ajax.reload();
            clearProject();
          } else {
            $("#project-modal-message").modal("show");
            $("#project-modal-message .modal-body").text(
              "Failed To Added Project!"
            );
          }
        },
      });
    }
  });
  // End Add Project
  // Delete Project
  $("#project-table").on("click", ".btn-delete-project", function () {
    var project_id = $(this).data("id");
    $.ajax({
      url: "php/project.php",
      type: "POST",
      data: { project_id: project_id, action: "deleteProject" },
      success: function (data) {
        if (data == 1) {
          $("#project-modal-message").modal("show");
          $("#project-modal-message .modal-body").text(
            "Successfully Deleted Project!"
          );
          Records.ajax.reload();
        } else {
          $("#project-modal-message").modal("show");
          $("#project-modal-message .modal-body").text(
            "Failed To Deleted Project!"
          );
        }
      },
    });
  });

  // End Delete Project

  // Edit Project
  // Retrieve Project
  $("#project-table").on("click", ".btn-update-project", function () {
    var project_id = $(this).data("id");
    $.ajax({
      url: "php/project.php",
      type: "POST",
      dataType: "json",
      data: { project_id: project_id, action: "retrieveProject" },
      success: function (data) {
        $("#project-modal-update").modal("show");
        $("#project-modal-update  .modal-body .project_id").val(
          data[0].project_id
        );
        $("#project-modal-update  .modal-body .project_code").val(
          data[0].project_code
        );
        $("#project-modal-update  .modal-body .project_name").val(
          data[0].project_name
        );
        $("#project-modal-update  .modal-body .project_type").val(
          data[0].project_type
        );
        $("#project-modal-update  .modal-body .donor_name").val(
          data[0].donor_name
        );
        $("#project-modal-update  .modal-body .project_cost").val(
          data[0].project_cost
        );
        $("#project-modal-update  .modal-body .date_start").val(
          data[0].start_date
        );
        $("#project-modal-update  .modal-body .date_end").val(data[0].end_date);
        $("#project-modal-update  .modal-body .projcet_currency").val(
          data[0].currency
        );
      },
    });
  });

  // End Retrieve Project
  // Update Project

  $("#project-modal-update #project-update-button").click(function () {
    var project_id = $("#project-modal-update  .modal-body .project_id").val();
    var project_code = $(
      "#project-modal-update  .modal-body .project_code"
    ).val();
    var project_name = $(
      "#project-modal-update  .modal-body .project_name"
    ).val();
    var project_type = $(
      "#project-modal-update  .modal-body .project_type"
    ).val();
    var donor_name = $("#project-modal-update  .modal-body .donor_name").val();
    var project_cost = $(
      "#project-modal-update  .modal-body .project_cost"
    ).val();
    var start_date = $("#project-modal-update  .modal-body .date_start").val();
    var end_date = $("#project-modal-update  .modal-body .date_end").val();
    var currency = $(
      "#project-modal-update  .modal-body .projcet_currency"
    ).val();

    $.ajax({
      url: "php/project.php",
      type: "POST",
      data: {
        project_id: project_id,
        project_code: project_code,
        project_name: project_name,
        project_type: project_type,
        donor_name: donor_name,
        project_cost: project_cost,
        start_date: start_date,
        end_date: end_date,
        currency: currency,
        action: "udpateProject",
      },
      success: function (response) {
        if (response == 1) {
          $("#project-modal-update").modal("hide");
          $("#project-modal-message").modal("show");
          $("#project-modal-message .modal-body").text(
            "Successfully Updated Project!"
          );
          Records.ajax.reload();
        } else {
          $("#project-modal-update").modal("hide");
          $("#project-modal-message").modal("show");
          $("#project-modal-message .modal-body").text(
            "Failed To Updated Project!"
          );
        }
      },
    });
  });
  // End Update Project
  // End Edit Project

  // Search Live Projects

  $(".search_project").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/project.php",
      type: "POST",
      data: { search: search, action: "searchProject" },
      success: function (response) {
        if (response == 0) {
          $("#project-modal-message").modal("show");
          $("#project-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#project-table").html(response);
        }
      },
    });
  });

  // End Search Live Projects
});
