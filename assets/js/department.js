$(document).ready(function () {
  // Departement section

  function clearForm() {
    $("#department-name").val("");
  }
  function loadDepartement(page) {
    $.ajax({
      url: "php/department.php",
      type: "post",
      data: { page: page, action: "loadDepartment" },
      success: function (response) {
        if (response) {
          $("#department-table").html(response);
        } else {
          $("#department-table .tbody-department").html("Data Not Found!");
        }
      },
    });
  }

  loadDepartement();

  $("#department-table").on("click", ".page-item", function () {
    var page = $(this).attr("id");
    loadDepartement(page);
  });

  // Add Departement
  $("#department-button").click(function () {
    var dep_name = $("#department-name");
    dep_name.removeClass("error");
    if (dep_name.val() == "") {
      dep_name.addClass("error");
    } else {
      $.ajax({
        url: "php/department.php",
        type: "POST",
        data: { dep_name: dep_name.val(), action: "add-department" },
        action: "add-department",
        success: function (response) {
          if (response == 1) {
            $("#department-modal-message").modal("show");
            $("#department-modal-message .modal-body").html(
              "Successfully Added Department!"
            );
            clearForm();
            loadDepartement();
          } else {
            $("#department-modal-message").modal("show");
            $("#department-modal-message .modal-body").html(
              "Failed To Add Department!"
            );
          }
        },
      });
    }
  });
  // End Add department

  // Delete department

  $(document).on("click", ".btn-delete-department", function () {
    var department_id = $(this).data("id");
    $.ajax({
      url: "php/department.php",
      type: "POST",
      data: { department_id: department_id, action: "delete_department" },
      success: function (response) {
        if (response == 1) {
          $("#department-modal-message").modal("show");
          $("#department-modal-message .modal-body").html(
            "Successfully Delete Department!"
          );
          loadDepartement();
        } else {
          $("#department-modal-message").modal("show");
          $("#department-modal-message .modal-body").html(
            "Failed To Delete Department!"
          );
        }
      },
    });
  });

  // End Delete Department

  // Update department

  $("#department-table").on("click", ".btn-update-department", function () {
    var department_id = $(this).data("id");
    $.ajax({
      url: "php/department.php",
      type: "POST",
      dataType: "json",
      data: { department_id: department_id, action: "department-fetch-data" },
      success: function (response) {
        $("#department-modal-update").modal("show");
        $("#department-modal-update .modal-body .dep_name").val(
          response[0].department_name
        );
        $("#department-modal-update .modal-body .department_edit_id").val(
          response[0].department_id
        );
      },
    });
  });

  $("#department-modal-update #update-department-button").click(function () {
    var dep_name = $("#department-modal-update .dep_name").val();
    var dep_id = $("#department-modal-update .department_edit_id").val();

    if (dep_name == "") {
      $("#department-modal-message")
        .modal("show")
        .html("Please Fill the fields!");
    } else {
      $.ajax({
        url: "php/department.php",
        type: "POST",
        data: {
          dep_id: dep_id,
          dep_name: dep_name,
          action: "update_department",
        },
        success: function (response) {
          if (response == 1) {
            $("#department-modal-update").modal("hide");
            $("#department-modal-message").modal("show");
            $("#department-modal-message .modal-body").html(
              "Successfully Update Department!"
            );
            loadDepartement();
          } else {
            $("#department-modal-update").modal("hide");
            $("#department-modal-message").modal("show");
            $("#department-modal-message .modal-body").html(
              "Failed To Update Department!"
            );
          }
        },
      });
    }
  });

  // End Update  Department

  // Search Live

  $("#search").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/department.php",
      type: "POST",
      data: { search: search, action: "search-department" },
      success: function (response) {
        if (response == 0) {
          $("#department-modal-message").modal("show");
          $("#department-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#department-table").html(response);
        }
      },
    });
  });

  // End Department section
});
