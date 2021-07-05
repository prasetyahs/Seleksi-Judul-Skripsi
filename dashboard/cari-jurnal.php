<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/users.php' ?>
<?php include '../proccess/judul_skripsi.php' ?>
<?php include '../proccess/test.php' ?>
<?php

$dataSkripsi = null;
$percent = 0;
if (isset($_POST['search'])) {
    $dataSkripsi = resultSearchWithPresentase($conn,$BASE_URL);
}
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
                            <li class="breadcrumb-item"><a href="">Cari Jurnal</a></li>
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
            <div class="row">
                <div class="col-12">
                    <div class="bg-white shadow p-5">
                        <h4 style="color:#002171;font-weight:bold;font-size:18px;width:100%;">Judul Skripsi apa yang ingin Anda Cari ?</h4>
                        <form action="cari-jurnal.php" method="post">
                            <div class="input-group mb-3 mt-3">
                                <input required name="judul_skripsi" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Cari Jurnal" aria-label="Cari Jurnal" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button type="submit" name="search" style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <?php if (!empty($dataSkripsi)) { ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Judul Skripsi</th>
                                        <!-- <th>Kategori</th> -->
                                        <th>kemiripan</th>
                                        <th>Jurnal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num = 1;
                                    foreach ($dataSkripsi as $skripsi) {
                                        similar_text(str_replace(' ', '', strtolower($skripsi['judul_skripsi'])), str_replace(' ', '', strtolower($_POST['judul_skripsi'])), $percent);
                                    ?>
                                        <tr>
                                            <td><span style="font-size: 13px;"><?= $num++ ?></span></td>
                                            <td><span style="font-size: 13px;"><?= strtoupper($skripsi['judul_skripsi']) ?></span></td>
                                            <!-- <td><a class="badge text-primary" style="font-size: 13px;"><?= $skripsi['label'] ?></a></td> -->
                                            <?php if ((int) $percent >= 75) { ?>
                                                <td><span class=" bg-danger pl-2 rounded pr-2 pt-1 pb-1" style="font-size: 13px;"><?= $skripsi['presentasi'] ?> %</span></td>
                                            <?php } else { ?>
                                                <td><span class=" bg-primary pl-2 rounded pr-2 pt-1 pb-1" style="font-size: 13px;"><?= $skripsi['presentasi'] ?> %</span></td>
                                            <?php } ?>
                                            <?php if (!empty($skripsi['proposal'])) { ?>
                                                <td><a href="<?= $BASE_URL ?>assets/proposal/<?= $skripsi['proposal'] ?>" download="<?= $skripsi['proposal'] ?>" class="badge text-primary" style="font-size: 13px;">Download Jurnal</a></td>
                                            <?php } else { ?>
                                                <td><a class="badge text-muted" style="font-size: 13px;">Download Jurnal</a></td>

                                            <?php } ?>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../components/footer.php' ?>