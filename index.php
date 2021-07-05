<?php session_start() ?>
<?php include 'config/config.php' ?>
<?php include 'config/database.php' ?>
<?php include 'proccess/users.php' ?>
<?php
if (isset($_POST['submit'])) {
  proccessLogin($_POST, $conn, $BASE_URL);
}
if(isset($_SESSION['users_data'])){
  $link = $BASE_URL.'dashboard';
  Redirect($link);
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pengecekan Skripsi | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/dist/css/adminlte.min.css">
</head>

<body class="login-page" style="min-height: 496.391px;">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= $BASE_URL ?>assets/index2.html"><b>Universitas Darma Persada</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan Login terlebih dahulu !</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="<?= $BASE_URL ?>register.php" class="text-center">Register new Account</a>
        </p>
        <?php if (isset($_SESSION['message'])) { ?>
          <p style="display: none;" id="message"><?= $_SESSION['message'] ?></p>
          <p style="display: none;" id="type"><?= $_SESSION['type'] ?></p>
          <p style="display: none;" id="title"><?= $_SESSION['title'] ?></p>
        <?php } ?>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['type']);
        unset($_SESSION['title']);
        ?>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= $BASE_URL ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= $BASE_URL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= $BASE_URL ?>assets/dist/js/adminlte.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    let message = document.getElementById('message');
    if (message != null) {
      let title = document.getElementById('title').innerHTML;
      let type = document.getElementById('type').innerHTML;
      swal({
        title: title,
        text: message.innerHTML,
        icon: type,
      });
    }
  </script>

</body>

</html>