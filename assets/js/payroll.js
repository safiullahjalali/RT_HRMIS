$(document).ready(function () {
  $(".search_box").selectpicker();
  // function payrollLoad(page) {
  //   $.ajax({
  //     url: "php/payroll.php",
  //     type: "POST",
  //     data: { page: page, action: "payrollLoad" },
  //     success: function (response) {
  //       if (response == 0) {
  //         $("#payroll-modal-message").modal("show");
  //         $("#payroll-modal-message .modal-body").text("Data Not Found!");
  //       } else {
  //         $("#employee-payroll-table").html(response);
  //       }
  //     },
  //   });
  // }

  var Records = $("#employee-payroll-table").DataTable({
    dom: "Bfrtip",
    responsive: true,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/payroll.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "payrollLoad",
      },
    },
  });

  // payrollLoad();

  // $("#employee-payroll-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   payrollLoad(page);
  // });

  // fetch the employee overtime and tax
  $("#employee_id").change(function () {
    var employee_id = $("#employee_id").val();
    $.ajax({
      url: "php/payroll.php",
      type: "POST",
      dataType: "json",
      data: { employee_id: employee_id, action: "payrollSingleLoad" },
      success: function (data) {
        if (data == 0) {
          $("#formPayroll .tax").val("");
          $("#formPayroll .overtime").val("");
          $("#formPayroll .gross-salary-fetch").val("");
          $("#payroll-modal-message").modal("show");
          $("#payroll-modal-message .modal-body").text("Doesn't Exit Salary");
        } else {
          $("#formPayroll .tax").val(data[0].tax);
          $("#formPayroll .overtime").val(data[0].overtime);
          $("#formPayroll .gross-salary-fetch").val(data[0].gross_salary);
        }
      },
    });
  });

  // Calculate The bouns, gross salary, tax, overtime and allowance

  $("#bouns,#allowance").on("keyup", function () {
    var bonus_value = $("#bonus").val();
    var tax = parseInt($("#tax").val());
    var overtime = $("#overtime").val();
    var gross_salary = parseInt($("#gross-salary-fetch").val());
    var allowance_value = $("#allowance").val();
    var bonus, allowance, final_salary;
    if (bonus_value == "") {
      bonus = 0;
    } else {
      bonus = parseInt($("#bonus").val());
    }
    if (allowance_value == "") {
      allowance = 0;
    } else {
      allowance = parseInt($("#allowance").val());
    }
    if (overtime == "") {
      overtime = 0;
    } else {
      overtime = parseInt($("#overtime").val());
    }

    final_salary = gross_salary + bonus + allowance + overtime - tax;

    $("#net_salary").val(final_salary);
  });

  // payroll add
  $("#payroll-add-button").click(function () {
    var employee_id = $("#employee_id");
    var date_year = $("#date_year");
    var date_month = $("#date_month");
    var overtime = $("#overtime");
    var tax = $("#tax");
    var allowance = $("#allowance");
    var bonus = $("#bonus");
    var net_salary = $("#net_salary");
    var pay_date = $("#pay_date");
    pay_date.removeClass("error");
    bonus.removeClass("error");
    allowance.removeClass("error");
    if (employee_id.val() == 0) {
      $("#payroll-modal-message").modal("show");
      $("#payroll-modal-message .modal-body").text("Please Select Employee!");
    } else if (bonus.val() == "") {
      bonus.addClass("error");
    } else if (allowance.val() == "") {
      allowance.addClass("error");
    } else if (pay_date.val() == "") {
      pay_date.addClass("error");
    } else {
      $.ajax({
        url: "php/payroll.php",
        type: "POST",
        data: {
          employee_id: employee_id.val(),
          date_year: date_year.val(),
          date_month: date_month.val(),
          overtime: overtime.val(),
          tax: tax.val(),
          bonus: bonus.val(),
          allowance: allowance.val(),
          net_salary: net_salary.val(),
          pay_date: pay_date.val(),
          action: "payrollAdd",
        },
        success: function (data) {
          if (data == 1) {
            $("#formPayroll")[0].reset();
            $("#payroll-modal-message").modal("show");
            $("#payroll-modal-message .modal-body").text(
              "Successfully Added Payroll!"
            );
            Records.ajax.reload();
          } else {
            $("#payroll-modal-message").modal("show");
            $("#payroll-modal-message .modal-body").text(
              "Failed To Added Payroll!"
            );
          }
        },
      });
    }
  });

  // End payroll add

  // Delete Payroll

  $("#employee-payroll-table").on("click", ".btn-delete-payroll", function () {
    var payroll_id = $(this).data("id");
    if (confirm("Are you sure you want to delete payroll")) {
      $.ajax({
        url: "php/payroll.php",
        type: "POST",
        data: { payroll_id: payroll_id, action: "DeletePayroll" },
        success: function (response) {
          if (response == 1) {
            $("#payroll-modal-message").modal("show");
            $("#payroll-modal-message .modal-body").text(
              "Successfully Deleted Payroll!"
            );
            Records.ajax.reload();
          } else {
            $("#payroll-modal-message").modal("show");
            $("#payroll-modal-message .modal-body").text(
              "Failed To Deleted Payroll!"
            );
          }
        },
      });
    }
  });

  // End Delete Payroll

  // Edit Payroll

  // Retrieve Payroll Edit

  $("#employee-payroll-table").on("click", ".btn-update-payroll", function () {
    var payroll_id = $(this).data("id");
    $.ajax({
      url: "php/payroll.php",
      type: "POST",
      dataType: "json",
      data: { payroll_id: payroll_id, action: "RetrievePayroll" },
      success: function (response) {
        $("#payroll-modal-update").modal("show");
        $("#payroll-modal-update #formPayrollUpdate .payroll_id").val(
          response[0].payroll_id
        );
        $("#payroll-modal-update #formPayrollUpdate .employee_id").val(
          response[0].employee_id
        );
        $("#payroll-modal-update #formPayrollUpdate .bonus").val(
          response[0].bonus
        );
        $("#payroll-modal-update #formPayrollUpdate .allowance").val(
          response[0].allowance
        );
        $("#payroll-modal-update #formPayrollUpdate .pay_date").val(
          response[0].pay_date
        );
        $("#payroll-modal-update #formPayrollUpdate .tax").val(response[0].tax);
        $("#payroll-modal-update #formPayrollUpdate .overtime").val(
          response[0].overtime
        );
        $("#payroll-modal-update #formPayrollUpdate .gross_salary").val(
          response[0].gross_salary
        );
        $("#payroll-modal-update #formPayrollUpdate .net_salary").val(
          response[0].net_salary
        );
      },
    });
  });
  // End Retrieve Payroll

  // Calculation of Update Payroll
  $("#formPayrollUpdate .bonus , #formPayrollUpdate .allowance").on(
    "keyup",
    function () {
      var bonus_value = $("#formPayrollUpdate .bonus").val();
      var tax = parseInt($("#formPayrollUpdate .tax").val());
      var overtime = $("#formPayrollUpdate .overtime").val();
      var gross_salary = parseInt($("#formPayrollUpdate .gross_salary").val());
      var allowance_value = $("#formPayrollUpdate .allowance").val();
      var bonus, allowance, final_salary;
      if (bonus_value == "") {
        bonus = 0;
      } else {
        bonus = parseInt($("#formPayrollUpdate .bonus").val());
      }
      if (allowance_value == "") {
        allowance = 0;
      } else {
        allowance = parseInt($("#formPayrollUpdate .allowance").val());
      }
      if (overtime == "") {
        overtime = 0;
      } else {
        overtime = parseInt($("#formPayrollUpdate .overtime").val());
      }

      final_salary = gross_salary + bonus + allowance + overtime - tax;

      $("#formPayrollUpdate .net_salary").val(final_salary);
    }
  );
  // End Calculation of Update Payroll

  // Update Payroll
  $("#formPayrollUpdate #payroll-update-button").click(function () {
    var payroll_id = $("#formPayrollUpdate .payroll_id").val();
    var employee_id = $("#formPayrollUpdate .employee_id").val();
    var bonus = $("#formPayrollUpdate .bonus").val();
    var allowance = $("#formPayrollUpdate .allowance").val();
    var pay_date = $("#formPayrollUpdate .pay_date").val();
    var net_salary = $("#formPayrollUpdate .net_salary").val();
    $.ajax({
      url: "php/payroll.php",
      type: "POST",
      dataType: "json",
      data: {
        payroll_id: payroll_id,
        employee_id: employee_id,
        bonus: bonus,
        pay_date: pay_date,
        allowance: allowance,
        net_salary: net_salary,
        action: "updatePayroll",
      },
      success: function (response) {
        if (response == 1) {
          $("#payroll-modal-update").modal("hide");
          $("#payroll-modal-message").modal("show");
          $("#payroll-modal-message .modal-body").text(
            "Successfully Updated Payroll!"
          );
          Records.ajax.reload();
        } else {
          $("#payroll-modal-update").modal("hide");
          $("#payroll-modal-message").modal("show");
          $("#payroll-modal-message .modal-body").text(
            "Failed To Update Payroll!"
          );
        }
      },
    });
  });

  // End Update Payroll

  // End Edit Payroll

  // Search Live Payroll
  $(".search_payroll").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/payroll.php",
      type: "POST",
      data: { search: search, action: "searchPayroll" },
      success: function (response) {
        if (response == 0) {
          $("#payroll-modal-message").modal("show");
          $("#payroll-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#employee-payroll-table").html(response);
        }
      },
    });
  });
  // End Search Live Payroll
});
