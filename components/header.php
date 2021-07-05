<?php session_start();

if ($_SESSION == null) {
  header("Location: " . $BASE_URL);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/style.css">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/style.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .swal-text {
      text-align: center;
    }

    .bg-white {
      background-color: #FFF;
      border: none;
      border-radius: 10px;
    }
    .color-primary{
      color: #002171;
    }
    #example1_wrapper > .dt-buttons.btn-group.flex-wrap{
      display: none !important;
    }
    #example1 > thead{
      background: #002171;
      color: white;
    }
    .page-item.active .page-link{
      background-color: #002171 !important;
      border : none;
    }
    .btn-circle{
      border-radius: 80%;
    }
    .btn-outline-primary-2{
      background-color: transparent;
      border-color: #002171;
      color: #002171;
    }
    .btn-outline-primary-2:hover{
      background-color: #002171;
      border-color: #002171;
      color: #FFF;
    }
    .bg-primary2{
      background-color: #002171;
      border-color: #002171;
      color: #FFF;
    }
    .text-title {
      font-size: 18px;
    }
    tbody > tr > td{
      font-size: 13px !important;
    }

    .new-form{
      background-color: #f2f4f6;
      border: 0;
    }
    .new-form:focus{
      background-color: #f2f4f6;
      border: 0;
    }


  </style>
</head>