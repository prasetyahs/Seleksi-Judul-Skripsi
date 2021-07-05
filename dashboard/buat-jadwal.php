<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/crud.php' ?>
<?php include '../proccess/pengajuan.php' ?>
<?php
$dataPengajuan = readDataAllRow($conn, "SELECT * FROM tb_pengajuan 
                                            JOIN tbl_judul_skripsi ON tb_pengajuan.id_judul = tbl_judul_skripsi.id_judul
                                            JOIN tbl_users ON tb_pengajuan.id_user = tbl_users.id_users
                                            JOIN tb_pembimbing ON tb_pengajuan.id_pembimbing = tb_pembimbing.id_pembimbing
                                            WHERE tb_pengajuan.status = 0 AND status_jadwal = 0");

$dataRuang = readDataAllRow($conn, "SELECT * FROM tb_ruang");


if (isset($_GET['id'])) {
    deletePengajuan($conn, $BASE_URL, $_GET['id']);
}

if(isset($_POST['submit_jadwal'])){
    addJadwal($_POST,$conn,$BASE_URL);
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
                            <li class="breadcrumb-item"><a href="">Buat Jadwal</a></li>
                        </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-white shadow p-4">
                    <h4 class="color-primary text-bold">Data Jadwal Skripsi</h4>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped dataTable js-exportable " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul</th>
                                <th>Studi Kasus</th>
                                <th>Pembimbing</th>
                                <th>Tanggal</th>
                                <th>Proposal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($dataPengajuan as $row) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>
                                    <td><?= $row['judul_skripsi'] ?></td>
                                    <td><?= $row['studi_kasus'] ?></td>
                                    <td><?= $row['nama_pembimbing'] ?></td>
                                    <td><?= date('d F Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                    <td><a target="_blank" href="<?= $BASE_URL ?>assets/proposal/<?= $row['proposal'] ?>"><span class="badge badge-success">Lihat Proposal</span></a></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <span data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Buat Jadwal">
                                                <button onClick="insertJadwal('<?= $row['id_pengajuan'] ?>')" data-toggle="modal" data-target="#modalJadwal" type="button" class="btn btn-outline-primary-2 btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-edit"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                                <button onClick="detailMahasiswa('<?= $BASE_URL ?>','<?= $row['first_name'] ?>','<?= $row['last_name'] ?>','<?= $row['jk'] ?>','<?= $row['angkatan'] ?>','<?= $row['id_users'] ?>','<?= $row['image'] ?>','<?= $row['address'] ?>','<?= $row['semester'] ?>','<?= $row['email'] ?>','<?= $row['nim'] ?>')" data-toggle="modal" data-target="#modalDetail" type="button" class="btn btn-outline-info btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-table"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                                <button onClick="deleteData('<?= $BASE_URL ?>','<?= $row['id_pengajuan'] ?>')" data-toggle="modal" data-target="#modalDelete" type="button" class="btn btn-outline-danger btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-trash"></i></button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Buat Jadwal Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group row mt-4">
                    <label for="" class="col-sm-2">Ruang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select onChange="selectRuang(this)" name="ruang" id="ruang" required style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                <option value="">- Pilih Ruang -</option>
                                <?php foreach ($dataRuang as $row) { ?>
                                    <option value="<?= $row['id_ruang'] ?>"><?= $row['nama_ruang'] ?> - <?= date('d F Y',strtotime($row['tanggal'])) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="" class="col-sm-2">Dosen Penguji 1</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input  name="penguji_1" readonly id="penguji_1" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="" class="col-sm-2">Dosen Penguji 2</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input  name="penguji_2" readonly id="penguji_2" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_pengajuan" id="id_pengajuan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" id="submit" name="submit_jadwal" class="btn btn-primary">Buat Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Detail Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row m-4">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center">
                            <img style="width: auto; height:200px" src="" id="image_users" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">NIM</span>
                            </div>
                            <div class="col-md-8">
                                <span id="nim_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Nama Lengkap</span>
                            </div>
                            <div class="col-md-8">
                                <span id="full_name" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Email</span>
                            </div>
                            <div class="col-md-8">
                                <span id="email_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Jenis Kelamin</span>
                            </div>
                            <div class="col-md-8">
                                <span id="jk_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Angkatan</span>
                            </div>
                            <div class="col-md-8">
                                <span id="angkatan_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Semester</span>
                            </div>
                            <div class="col-md-8">
                                <span id="semester_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-title">Alamat Lengkap</span>
                            </div>
                            <div class="col-md-8">
                                <span id="alamat_detail" class="text-title text-bold">: </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Form Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-3">Anda yakin ingin menghapus data tersebut ?</h4 class="text-center">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a id="delete_id" name="submit_update" class="btn btn-primary">Hapus Data</a>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteData(BASE_URL, idUsers) {
        document.getElementById('delete_id').href = BASE_URL + 'dashboard/data-skripsi.php?id=' + idUsers;
    }

    function detailMahasiswa(BASE_URL, firstName, lastName, jk, angkatan, id_users, image, address, semester, email, nim) {
        if (image == '') {
            document.getElementById("image_users").src = BASE_URL + 'assets/image/user.png';
        } else {
            document.getElementById("image_users").src = BASE_URL + 'assets/image/' + image;
        }
        document.getElementById("nim_detail").innerHTML = ": " + nim;
        document.getElementById("full_name").innerHTML = ": " + firstName + ' ' + lastName;
        document.getElementById("jk_detail").innerHTML = ": " + jk;
        document.getElementById("semester_detail").innerHTML = ": " + semester;
        document.getElementById("angkatan_detail").innerHTML = ": " + angkatan;
        document.getElementById("email_detail").innerHTML = ": " + email;
        document.getElementById("alamat_detail").innerHTML = ": " + address;
    }

    function selectRuang(id){
        var value = id.value;  
        $.ajax({
            type : "GET",
            url : "http://localhost/seleksiskripsi/dashboard/read-data-ajax.php?id="+value,
            dataType : 'HTML',
            success : function(response){
                console.log(JSON.parse(response));
                var data = JSON.parse(response);
                document.getElementById("penguji_1").value = data.penguji_1
                document.getElementById("penguji_2").value = data.penguji_2
            }
        })
    }

    function insertJadwal(idRuang){
        document.getElementById("id_pengajuan").value = idRuang;
    }
</script>
<?php include '../components/footer.php' ?>