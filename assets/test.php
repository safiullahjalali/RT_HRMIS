
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="img/tab-logo.png">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap-select.min.css">

</head>
<body>

    <div class="">
      <select class="form-control search_box" data-live-search="true">
        <option value="">AFG</option>
        <option value="">PK</option>
        <option value="">IND</option>
        <option value="">IR</option>
        <option value="">CH</option>
      </select>
    </div>


    <script src="js/jquery.js"></script>
<script src="bootstrap5/js/bootstrap.bundle.js"></script>
<script src="bootstrap5/js/bootstrap4.bundle.min.js"></script>
<script src="bootstrap5/bootstrap-select.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
</body>
</html>

<script>
    $(document).ready(function(){
        $(".search_box").selectpicker();
    });
</script>