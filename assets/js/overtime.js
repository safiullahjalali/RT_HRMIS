$(document).ready(function () {
  $(".search_box").selectpicker();

  var Records = $("#overtime-table").DataTable({
    dom: "Bfrtip",
    responsive: false,
    buttons: ["excel", "pdf", "print"],
    ajax: {
      url: "php/overtime.php",
      Processing: true,
      serverSide: true,
      dataSrc: "",
      paging: true,
      type: "post",
      data: {
        action: "overtimeLoad",
      },
    },
  });

  // function overtimeLoad(page) {
  //   $.ajax({
  //     url: "php/overtime.php",
  //     type: "POST",
  //     data: { page: page, action: "overtimeLoad" },
  //     success: function (data) {
  //       if (data == 0) {
  //         $("#overtime-modal-message").modal("show");
  //         $("#overtime-modal-message .modal-body").text("Data Not Found!");
  //       } else {
  //         $("#overtime-table").html(data);
  //       }
  //     },
  //   });
  // }
  // overtimeLoad();

  // $("#overtime-table").on("click", ".page-item", function () {
  //   var page = $(this).attr("id");
  //   overtimeLoad(page);
  // });

  function claerOvertime() {
    $("#employee_id").val(0);
    // $("#date_year").val();
    $("#date_month").val(0);
    $("#date_day").val("");
    $("#hour").val("");
  }

  // Add Overtime

  $("#btn-add-overtime").click(function () {
    var employee_id = $("#employee_id").val();
    var date_year = $("#date_year").val();
    var date_month = $("#date_month").val();
    var date_day = $("#date_day").val();
    var hours = $("#hour").val();
    if (employee_id == 0 || date_month == 0 || date_day == "" || hours == "") {
      $("#overtime-modal-message").modal("show");
      $("#overtime-modal-message .modal-body").text("All Fileds Are Required!");
    } else {
      $.ajax({
        url: "php/overtime.php",
        type: "POST",
        data: {
          employee_id: employee_id,
          date_year: date_year,
          date_month: date_month,
          date_day: date_day,
          hours: hours,
          action: "overtimeAdd",
        },
        success: function (response) {
          if (response == 1) {
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Successfully Added Overtime!"
            );
            Records.ajax.reload();
            claerOvertime();
          } else {
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Failed To Add Overtime!"
            );
          }
        },
      });
    }
  });

  // End Add Overtime
  // Delete Overtime
  $("#overtime-table").on("click", ".btn-delete-overtime", function () {
    var overtime_id = $(this).data("id");
    if (confirm("Are You Sure To Delete Overtime?")) {
      $.ajax({
        url: "php/overtime.php",
        type: "post",
        data: { overtime_id: overtime_id, action: "overtimeDelete" },
        success: function (data) {
          if (data == 1) {
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Successfully Added Overtime!"
            );
            Records.ajax.reload();
          } else {
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Failed To Add Overtime!"
            );
          }
        },
      });
    }
  });

  // End Delete Overtime
  // Edit Overtime
  // Retrieve Overtime

  $("#overtime-table").on("click", ".btn-update-overtime", function () {
    var overtime_id = $(this).data("id");
    $.ajax({
      url: "php/overtime.php",
      type: "POST",
      dataType: "json",
      data: { overtime_id: overtime_id, action: "overtimeRetrieve" },
      success: function (data) {
        $("#overtime-modal-update").modal("show");
        $("#overtime-modal-update #overtime-form .employee_id").val(
          data[0].employee_id
        );
        $("#overtime-modal-update #overtime-form .date_year").val(
          data[0].date_year
        );
        $("#overtime-modal-update #overtime-form .date_month").val(
          data[0].date_month
        );
        $("#overtime-modal-update #overtime-form .date_day").val(
          data[0].date_day
        );
        $("#overtime-modal-update #overtime-form .hour").val(data[0].hours);
        $("#overtime-modal-update #overtime-form .overtime_id").val(
          data[0].overtime_id
        );
      },
    });
  });

  // End Retrieve Overtime
  // Update Overtime

  $("#overtime-modal-update #overtime-form").on(
    "click",
    ".btn-modal-update-overtime",
    function () {
      var employee_id = $(
        "#overtime-modal-update #overtime-form .employee_id"
      ).val();
      var date_year = $(
        "#overtime-modal-update #overtime-form .date_year"
      ).val();
      var date_month = $(
        "#overtime-modal-update #overtime-form .date_month"
      ).val();
      var date_day = $("#overtime-modal-update #overtime-form .date_day").val();
      var hour = $("#overtime-modal-update #overtime-form .hour").val();
      var overtime_id = $(
        "#overtime-modal-update #overtime-form .overtime_id"
      ).val();
      $.ajax({
        url: "php/overtime.php",
        type: "POST",
        data: {
          overtime_id: overtime_id,
          employee_id: employee_id,
          date_year: date_year,
          date_month: date_month,
          date_day: date_day,
          hour: hour,
          action: "overtimeUpdate",
        },
        success: function (data) {
          if (data == 1) {
            $("#overtime-modal-update").modal("hide");
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Successfully Updated Overtime!"
            );
            Records.ajax.reload();
          } else {
            $("#overtime-modal-update").modal("hide");
            $("#overtime-modal-message").modal("show");
            $("#overtime-modal-message .modal-body").text(
              "Failed To Updated Overtime!"
            );
          }
        },
      });
    }
  );
  // End Update Overtime
  // End Edit Overtime

  // Search Live Overtime
  $(".search_overtime").on("keyup", function () {
    var search = $(this).val();
    $.ajax({
      url: "php/overtime.php",
      type: "POST",
      data: { search: search, action: "overtimeSearch" },
      success: function (response) {
        if (response == 0) {
          $("#overtime-modal-message").modal("show");
          $("#overtime-modal-message .modal-body").html("No Data Found!");
        } else {
          $("#overtime-table").html(response);
        }
      },
    });
  });
  // End Search Live Overtime
});
