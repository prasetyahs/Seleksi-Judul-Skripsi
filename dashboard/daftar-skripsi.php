<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/users.php' ?>
<?php include '../proccess/judul_skripsi.php' ?>
<?php include '../proccess/pembimbing.php' ?>
<?php include '../proccess/pengajuan.php' ?>
<?php

$dataPembimbing = fetchPembimbing($conn);
$emailUsers = $_SESSION['users_data']['email'];
$dataUsers = getDataRow("SELECT * FROM tbl_users WHERE email = '$emailUsers'", $conn);
$kemiripan = null;
if (isset($_POST['submit_add_skripsi'])) {
    $kemiripan = addDataSkripsi($conn, $BASE_URL, $dataUsers['id_users']);
}

$dataPengajuan = resultDataPengajuan($conn, $dataUsers['id_users']);
$dataPengajuanAcc =  array_filter($dataPengajuan, function ($var) {
    return ($var['status'] == 1);
});
$tab2 = "";
$tab1 = "";
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
                            <li class="breadcrumb-item"><a href="">Daftar Skripsi</a></li>
                        </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <?php if (empty($dataPengajuanAcc)) {
                            $tab2 = "";
                            $tab1 = "active show";
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Daftar Skripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pengajuan Skripsi</a>
                            </li>
                        <?php } else {
                            $tab2 = "active show";
                            $tab1 = "";
                        } ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade <?= $tab1 ?>" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="pl-5 pr-5 pt-2 pb-2">
                                            <h4 style="color:#002171;font-weight:bold;font-size:18px;width:100%;">Silahkan Daftar Skripsi disini </h4>
                                            <form action="daftar-skripsi.php" method="post" enctype="multipart/form-data">
                                                <div class="input-group mb-3 mt-3">
                                                    <input name="judul_skripsi" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Judul Skripsi" aria-label="Judul" aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <span style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-book"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group" style="margin-bottom: 1.3%;">
                                                    <input name="studi_kasus" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Studi Kasus" aria-label="kasus" aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <span style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group" style="margin-bottom: 1.3%;">
                                                    <input readonly value="<?= periode() ?>" name="periode" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Periode" aria-label="kasus" aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <span style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-date"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group" style="margin-bottom: 1.3%;">
                                                    <select name="angkatan" required class="form-control" style="background-color: #f2f4f6;border: 0;">
                                                        <?php if ($dataUsers['angkatan'] == null) { ?>
                                                            <option value="">-- Pilih Angkatan --</option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dataUsers['angkatan'] ?>"><?= $dataUsers['angkatan'] ?></option>
                                                        <?php } ?>
                                                        <!-- <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option> -->
                                                    </select>
                                                </div>
                                                <div class="input-group" style="margin-bottom: 1.3%;">
                                                    <select name="pembimbing" required class="form-control" style="background-color: #f2f4f6;border: 0;">
                                                        <option value="">-- Pembimbing --</option>
                                                        <?php
                                                        foreach ($dataPembimbing as $dp) {
                                                        ?>
                                                            <option style="background-color: #f2f4f6;border: 0;" value="<?= $dp['id_pembimbing'] ?>"><?= $dp['nama_pembimbing'] ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="proposal" type="file" class="custom-file-input" id="inputGroupFile04" style="background-color: #f2f4f6;border: 0;">
                                                        <label class="custom-file-label" for="inputGroupFile04" style="background-color: #f2f4f6;border: 0;">Upload Proposal</label>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <span class="mb-4 text-danger text-bold">*pdf, doc,docx</span>
                                                </div>
                                                <!-- <div class="input-group mb-4">
                                <label for=""><?= $persentaseKemiripan != null ? $persentaseKemiripan : null ?></label>
                            </div> -->
                                                <div class="row" style="margin-left: 0.1%;">
                                                    <button type="submit" name="submit_add_skripsi" class="btn btn-primary mb-1 mr-4" style="min-width: 10%;max-width:50%"><i class="fa fa-save"><br>Simpan</i></button>
                                                    <button type="clear" name="submit_profile" class="btn btn-warning mb-1 text-white" style="min-width: 10%;max-width:50%"><i class="fa fa-eraser"><br>Ulang Pengisian</i></button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade <?= $tab2 ?>" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            <div class="col-12">
                                <div class="pl-2 pr-2 pt-2 pb-2">
                                    <div class="row justify-content-between">
                                        <h4 style="color:#002171;font-weight:bold;font-size:18px;">Daftar Pengajuan Skripsi Anda</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-2">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;font-size: 14px;">No</th>
                                                    <th style="width: 40%;font-size: 14px;">Judul Skripsi</th>
                                                    <th style="font-size: 14px;">Studi Kasus</th>
                                                    <th style="font-size: 14px;">Pembimbing</th>
                                                    <th style="width: 50px;font-size: 14px;">Tanggal Pengajuan</th>
                                                    <th style="font-size: 14px;">Status</th>
                                                    <th style="font-size: 14px;font-size: 14px;">Jadwal Sidang</th>
                                                </tr>
                                            </thead>
                                            <?php if ($dataPengajuan != null) { ?>
                                                <tbody>
                                                    <?php
                                                    $num = 1;
                                                    foreach ($dataPengajuan as $pj) {
                                                    ?>
                                                        <tr>
                                                            <td style="font-size: 14px;"><?= $num ?>.</td>
                                                            <td style="font-size: 14px;"><?= $pj['judul_skripsi'] ?></td>
                                                            <td style="font-size: 14px;"><?= $pj['studi_kasus'] ?></td>
                                                            <td style="font-size: 14px;"><?= $pj['nama_pembimbing'] ?></td>
                                                            <td style="font-size: 14px;"><?= $pj['tanggal_pengajuan'] ?></td>
                                                            <?php if ($pj['status'] == 0) { ?>
                                                                <td><span class="bg-info pl-2 pr-2 pt-1 pb-1 rounded" style="font-size: 11px;">Menunggu Konfirmasi</span></td>
                                                                <td><span style="font-size: 14px;" class="text-muted">Jadwal Sidang</span></td>
                                                            <?php } else if ($pj['status'] == 1) { ?>
                                                                <td><span class="bg-success pl-2 pr-2 pt-1 pb-1 rounded" style="font-size: 11px;">Diterima</span></td>
                                                                <td><a style="font-size: 14px;" href="<?= $BASE_URL ?>dashboard/jadwal-sidang.php">Jadwal Sidang</a></td>
                                                            <?php } else { ?>
                                                                <td><span class="bg-danger pl-2 pr-2 pt-1 pb-1 rounded" style="font-size: 11px;">Ditolak</span></td>
                                                                <td><span style="font-size: 14px;" class="text-muted">Jadwal Sidang</span></td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php $num++;
                                                    }
                                                    ?>
                                                </tbody>
                                            <?php } else { ?>
                                                <tbody>
                                                    <tr class="bg-light">
                                                        <td colspan="7">
                                                            <center>
                                                                <div class="col-12">
                                                                    <span style="font-weight: 800;" class="text-danger">Data Tidak Tersedia</span>
                                                                </div>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

</div>
<!-- /.content-wrapper -->
<?php include '../components/footer.php' ?>