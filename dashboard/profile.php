<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/users.php' ?>
<?php
if (isset($_POST['submit_profile'])) {
    changeProfile($_POST, $_FILES, $conn, $BASE_URL);
}

if (isset($_POST['submit_password'])) {
    changePassword($_POST, $conn, $BASE_URL);
}
$emailUsers = $_SESSION['users_data']['email'];
$dataUsers = getDataRow("SELECT * FROM tbl_users WHERE email = '$emailUsers'", $conn);



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1><span style="font-size: 14px;">Selamat Datang di Sistem Informasi Pendaftaran Skripsi</span>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="">Profile</a></li>
                        </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row mb-4">
                <div class="col-md-4 col-sm-12 col-12">
                    <div class="bg-white shadow p-3">
                        <div class="col-sm-12 ">
                            <div class="d-flex justify-content-center">
                                <?php if ($dataUsers['image'] == null) { ?>
                                    <img class="d-block mx-auto" style="width: 150px; height:150px" src="<?= $BASE_URL ?>assets/image/user.png" alt="">
                                <?php } else { ?>
                                    <img style="width: auto; height:150px" src="<?= $BASE_URL ?>assets/image/<?= $dataUsers['image'] ?>" alt="">
                                <?php } ?>
                            </div>
                            <h4 class="text-center mt-2 text-uppercase"><?= $dataUsers['first_name'] ?> <?= $dataUsers['last_name'] ?></h4>
                            <h6 class="text-center ">Teknik Informatika</h6>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-8 col-sm-12 col-12 ">
                    <div class="bg-white shadow ">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Data Diri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Password</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">NIM</label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly value="<?= $dataUsers['nim'] ?>" name="nim" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Nama Depan</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $dataUsers['first_name'] ?>" name="first_name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Nama Belakang</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $dataUsers['last_name'] ?>" name="last_name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $dataUsers['email'] ?>" name="email" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Angkatan</label>
                                            <div class="col-sm-10">
                                                <select name="angkatan" required class="form-control">
                                                    <?php if ($dataUsers['angkatan'] == null) { ?>
                                                        <option value="">-- Pilih Angkatan --</option>
                                                    <?php } else { ?>
                                                        <option value="<?= $dataUsers['angkatan'] ?>"><?= $dataUsers['angkatan'] ?></option>
                                                    <?php } ?>
                                                    <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2012">2012</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Semester</label>
                                            <div class="col-sm-10">
                                                <select name="semester" required class="form-control">
                                                    <?php if ($dataUsers['semester'] == null) { ?>
                                                        <option value="">-- Pilih Semester --</option>
                                                    <?php } else { ?>
                                                        <option value="<?= $dataUsers['semester'] ?>"><?= $dataUsers['semester'] ?></option>
                                                    <?php } ?>
                                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                        <option value="Semester <?= $i ?>">Semester <?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                                <select name="jk" required class="form-control">
                                                    <?php if ($dataUsers['angkatan'] == null) { ?>
                                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <?php } else { ?>
                                                        <option value="<?= $dataUsers['jk'] ?>"><?= $dataUsers['jk'] ?></option>
                                                    <?php } ?>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea name="address" required id="address" cols="10" rows="5" class="form-control"><?= $dataUsers['address'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Foto</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit_profile" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Password Lama</label>
                                            <div class="col-sm-10">
                                                <input type="password" required name="old_password" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="password" required name="new_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2">Konfirmasi Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" required name="confirm_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit_password" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../components/footer.php' ?>