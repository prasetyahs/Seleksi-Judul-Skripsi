<?php include 'config/config.php' ?>
<?php include 'proccess/users.php' ?>
<?php include 'config/database.php' ?>
<?php
session_start();
if (isset($_POST['submit'])) {
    addData($_POST, $conn, $BASE_URL);
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
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="nim" placeholder="NIM">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="first_name" placeholder="Nama Depan" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="last_name" placeholder="Nama Belakang" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="angkatan" class="form-control" id="">
                            <option value="">-- Pilih Angkatan --</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="semester" class="form-control" id="">
                            <option value="">-- Pilih Semester --</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="Semester <?= $i ?>">Semester <?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Daftar Akun</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->

                <p class="mb-0">
                    <a href="<?= $BASE_URL ?>" class="text-center">Login Kembali</a>
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