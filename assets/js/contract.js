$(document).ready(function () {
  $(".search_box").selectpicker();
  var Records = $("#contract-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/contract.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "loadContract",
      },
    },
  });
  
  function clearForm() {
    $("#employee").val(0);
    $("#salary").val("");
    $("#currency").val(0);
    $("#start_date").val("");
    $("#end_date").val("");
    $("#position").val("");
    $("#contract_type").val(0);
  }

  // Add Contract

  $("#add_contract").click(function () {
    var employee_id = $("#employee");
    var salary = $("#salary");
    var currency = $("#currency");
    var start_date = $("#start_date");
    var end_date = $("#end_date");
    var position = $("#position");
    var contract_type = $("#contract_type");
    salary.removeClass("error");
    // currency.removeClass("error");
    start_date.removeClass("error");
    end_date.removeClass("error");
    position.removeClass("error");
    contract_type.removeClass("error");
    if (employee_id.val() == 0) {
      $("#contract-modal-message").modal("show");
      $("#contract-modal-message .modal-body").text("Please select Employee!");
    } else if (salary.val() == "") {
      salary.addClass("error");
    } else if (start_date.val() == "") {
      start_date.addClass("error");
    } else if (end_date.val() == "") {
      end_date.addClass("error");
    } else if (position.val() == "") {
      position.addClass("error");
    } else if (contract_type.val() == 0) {
      contract_type.addClass("error");
    } else {
      $.ajax({
        url: "php/contract.php",
        type: "POST",
        data: {
          employee_id: employee_id.val(),
          salary: salary.val(),
          currency: currency.val(),
          start_date: start_date.val(),
          end_date: end_date.val(),
          position: position.val(),
          contract_type: contract_type.val(),
          action: "AddContract",
        },
        success: function (response) {
          if (response == 1) {
            $("#contract-modal-message").modal("show");
            $("#contract-modal-message .modal-body").text(
              "Successfully Added Contract!"
            );
            Records.ajax.reload();
            clearForm();
          } else {
            $("#contract-modal-message").modal("show");
            $("#contract-modal-message .modal-body").text(
              "Failed To Added Contract!"
            );
          }
        },
      });
    }
  });

  // End Add Contract

  // Delete Contract
  $("#contract-table").on("click", ".btn-delete-contract", function () {
    var contract_id = $(this).data("id");
    $.ajax({
      url: "php/contract.php",
      type: "POST",
      data: { contract_id: contract_id, action: "DeleteContract" },
      success: function (data) {
        if (data == 1) {
          $("#contract-modal-message").modal("show");
          $("#contract-modal-message .modal-body").text(
            "Successfully Deleted Contract!"
          );
          Records.ajax.reload();
        } else {
          $("#contract-modal-message").modal("show");
          $("#contract-modal-message .modal-body").text(
            "Failed To Deleted Contract!"
          );
        }
      },
    });
  });
  // End Delete Contract

  // Edit Contract

  // Retrieve Data

  $("#contract-table").on("click", ".btn-update-contract", function () {
    var contract_id = $(this).data("id");
    $.ajax({
      url: "php/contract.php",
      type: "POST",
      dataType: "json",
      data: { contract_id: contract_id, action: "contract-retrieve" },
      success: function (response) {
        $("#contract-modal-update").modal("show");
        $("#contract-modal-update  .contract_id").val(response.contract_id);
        $("#contract-modal-update  .employee").val(response.employee_id);
        $("#contract-modal-update  .start_date").val(response.start_date);
        $("#contract-modal-update  .end_date").val(response.end_date);
        $("#contract-modal-update  .position").val(response.position);
        $("#contract-modal-update  .salary").val(response.salary);
        $("#contract-modal-update  .contract_type").val(response.contract_type);
        $("#contract-modal-update  .currency").val(response.currency);
      },
    });
  });
  // End Retrieve Data

  // Update Contract
  $("#contract-update-form").on("click", "#update_contract", function () {
    var contract_id = $("#contract-modal-update  .contract_id").val();
    var employee_id = $("#contract-modal-update  .employee").val();
    var start_date = $("#contract-modal-update  .start_date").val();
    var end_date = $("#contract-modal-update  .end_date").val();
    var position = $("#contract-modal-update  .position").val();
    var salary = $("#contract-modal-update  .salary").val();
    var contract_type = $("#contract-modal-update  .contract_type").val();
    var currency = $("#contract-modal-update  .currency").val();
    if (
      employee_id == 0 ||
      start_date == "" ||
      end_date == "" ||
      position == "" ||
      salary == 0 ||
      contract_type == 0 ||
      currency == ""
    ) {
      $("#contract-modal-message").modal("show");
      $("#contract-modal-message .modal-body").text("All Fileds Are Required!");
    } else {
      $.ajax({
        url: "php/contract.php",
        type: "POST",
        data: {
          contract_id: contract_id,
          employee_id: employee_id,
          start_date: start_date,
          end_date: end_date,
          position: position,
          salary: salary,
          contract_type: contract_type,
          currency: currency,
          action: "contract-update",
        },
        success: function (response) {
          if (response == 1) {
            $("#contract-modal-update").modal("hide");
            $("#contract-modal-message").modal("show");
            $("#contract-modal-message .modal-body").text(
              "Successfully Upated Contract Employee!"
            );
            Records.ajax.reload();
          } else {
            $("#contract-modal-update").modal("hide");
            $("#contract-modal-message").modal("show");
            $("#contract-modal-message .modal-body").text(
              "Failed To Updated Contract Employee!"
            );
          }
        },
      });
    }
  });

  // End Update Contract

  //End Edit Contract

  // Search Live Contract
  $(".search_contract").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/contract.php",
      type: "POST",
      data: { search: search, action: "search-contract" },
      success: function (response) {
        if (response == 0) {
          $("#contract-table").html("No Data Found!");
        } else {
          $("#contract-table").html(response);
        }
      },
    });
  });

  // Export To Excel
  $("#exportButton").click(function () {
    var reportname = prompt("Enter the report name");
    var text;
    if (reportname != null || reportname != "") {
      $("#contract-table").table2excel({
        exclude: ".action",
        name: "Date",
        filename: reportname,
      });
    }
  });
});
