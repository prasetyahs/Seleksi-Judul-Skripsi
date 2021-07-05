<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/crud.php' ?>
<?php include '../proccess/hasil.php' ?>
<!-- Content Wrapper. Contains page content -->

<?php
$userData  = $_SESSION['users_data'];
if (empty($userData)) {
    header("Location: " . $BASE_URL);
}
$idUsers = $userData['id_users'];
$schedule = readDataPerRow($conn, "SELECT * FROM tb_jadwal join tb_pengajuan on tb_jadwal.id_pengajuan = tb_pengajuan.id_pengajuan join tb_pembimbing on
 tb_pengajuan.id_pembimbing = tb_pembimbing.id_pembimbing join tbl_users on tb_pengajuan.id_user = tbl_users.id_users join tbl_judul_skripsi on tb_pengajuan.id_judul = 
 tbl_judul_skripsi.id_judul join tb_ruang on tb_jadwal.id_ruang = tb_ruang.id_ruang
 where tb_pengajuan.id_user = '$idUsers'");

$penguji = [];
$idPenguji = $schedule['dosen_1'];
$dosendua = $schedule['dosen_2'];
$pengujifirst = readDataPerRow($conn, "SELECT * FROM tb_pembimbing where id_pembimbing = '$idPenguji'");
$pengujiLast = readDataPerRow($conn, "SELECT * FROM tb_pembimbing where id_pembimbing = '$dosendua'");


$hasil = readDataAllRow($conn, "SELECT * FROM tbl_hasil join tb_pengajuan on tbl_hasil.id_pengajuan = tb_pengajuan.id_pengajuan where tb_pengajuan.id_user = '$idUsers'");

$hasilAkhir = readDataPerRow($conn, "SELECT tbl_hasil.hasil FROM tbl_hasil join tb_pengajuan on tbl_hasil.id_pengajuan = tb_pengajuan.id_pengajuan WHERE tb_pengajuan.id_user ='$idUsers'  AND id_hasil=(SELECT MAX(id_hasil) FROM tbl_hasil)");
?>
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
                            <li class="breadcrumb-item"><a href="">Jadwal Sidang</a></li>
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
                <div class="col-md-6 col-sm-12 col-12 mt-2">
                    <div class="bg-white shadow p-5 min-vh-50">
                        <h4 style="color:#002171;font-weight:bold;font-size:18px;width:100%;">Jadwal Sidang Skripsi Anda</h4>
                        <!-- <div class="input-group mb-3 mt-3">
                            <input style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Cari Jurnal" aria-label="Cari Jurnal" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                <span style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                        </div> -->

                        <div class="form-group row mt-3">
                            <label for="name" class="col-sm-2">Nama Anda</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?= $schedule['first_name'] . ' ' . $schedule['last_name'] ?>" readonly name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2">Nim</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name='nim' class="form-control" value="<?= $schedule['nim'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2">Judul</label>
                            <div class="col-sm-10">
                                <textarea type="text" readonly rows="3" name='judul' class="form-control"><?= $schedule['judul_skripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kasus" class="col-sm-2">Studi kasus</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name='kasus' value="<?= $schedule['studi_kasus'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pembimbing" class="col-sm-2">Pembimbing</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name='pembimbing' value="<?= $schedule['nama_pembimbing'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jadwal" class="col-sm-2">jadwal</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name='jadwal' class="form-control" value="<?= $schedule['tanggal'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_sidang" class="col-sm-2">Ruangan</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name="url_sidang" value="<?= $schedule['nama_ruang'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_sidang" class="col-sm-2">Penguji 1</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name="url_sidang" value="<?= $pengujifirst['nama_pembimbing'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_sidang" class="col-sm-2">Penguji 2</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name="url_sidang" value="<?= $pengujiLast['nama_pembimbing'] ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12 mt-2">
                    <div class="bg-white shadow p-5">
                        <div class="row justify-content-between">
                            <h4 style="color:#002171;font-weight:bold;font-size:18px;">Daftar Revisi</h4>
                            <div class="align-content-center" style="font-size:12px; ;">
                                <?php
                                if (!empty($hasilAkhir)) {
                                    if ($hasilAkhir['hasil'] != 'Mengulang') { ?>
                                        <span class="pl-4 pr-4 pt-1 pb-1 rounded-pill align-middle bg-success"><?= $hasilAkhir['hasil'] ?></span>
                                    <?php } else { ?>
                                        <span class="pl-4 pr-4 pt-1 pb-1 rounded-pill  align-middle bg-danger"><?= $hasilAkhir['hasil'] ?></span>
                                    <?php }
                                } else { ?>
                                    
                                <?php } ?>
                            </div>
                        </div>
                        <!-- <div class="input-group mb-3 mt-3">
                            <input style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Cari Jurnal" aria-label="Cari Jurnal" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                <span style="background-color: #f2f4f6;border: 0;" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                        </div> -->
                        <table class="table table-bordered table-striped dataTable js-exportable mt-2" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Revisi/catatan</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($hasil as $dt) { ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td><?= $dt['revisi'] ?></td>
                                        <?php if ($dt['hasil'] != "Mengulang") { ?>
                                            <td> <span class="bg-success pl-3 pr-3 rounded-pill pt-1 pb-1"><?= $dt['hasil'] ?></span></td>
                                        <?php } else { ?>
                                            <td> <span class="bg-danger pl-3 pr-3 rounded-pill pt-1 pb-1"><?= $dt['hasil'] ?></span></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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