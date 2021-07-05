<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/crud.php' ?>
<?php include '../proccess/hasil.php' ?>
<?php
$dataPengajuan = readDataAllRow($conn, "SELECT *,TB1.nama_pembimbing as penguji1,TB2.nama_pembimbing as penguji2 FROM tb_jadwal 
                                            JOIN tb_pengajuan ON tb_pengajuan.id_pengajuan = tb_jadwal.id_pengajuan
                                            JOIN tb_ruang ON tb_jadwal.id_ruang = tb_ruang.id_ruang
                                            JOIN tbl_judul_skripsi ON tb_pengajuan.id_judul = tbl_judul_skripsi.id_judul
                                            JOIN tbl_users ON tb_pengajuan.id_user = tbl_users.id_users
                                            JOIN tb_pembimbing ON tb_pengajuan.id_pembimbing = tb_pembimbing.id_pembimbing
                                            JOIN tb_pembimbing TB1 ON tb_ruang.dosen_1 = TB1.id_pembimbing
                                            JOIN tb_pembimbing TB2 ON tb_ruang.dosen_2 = TB2.id_pembimbing
                                            WHERE tb_pengajuan.status = 0 AND status_jadwal = 1 ORDER BY status_hasil");

$dataRuang = readDataAllRow($conn, "SELECT * FROM tb_ruang");


if (isset($_POST['submit_add_hasil'])) {
    addHasil($_POST, $conn, $BASE_URL);
}

if(isset($_POST['submit_change_hasil'])){
    changeHasil($_POST,$conn,$BASE_URL);
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
                            <li class="breadcrumb-item"><a href="">Hasil Sidang</a></li>
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
                    <h4 class="color-primary text-bold">Data Hasil Sidang</h4>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped dataTable js-exportable " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul</th>
                                <th>Studi Kasus</th>
                                <th>Pembimbing</th>
                                <th>Tanggal Sidang</th>
                                <th>Proposal</th>
                                <th>Status</th>
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
                                    <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                                    <td><a target="_blank" href="<?= $BASE_URL ?>assets/proposal/<?= $row['proposal'] ?>"><span class="badge badge-success">Lihat Proposal</span></a></td>
                                    <td>
                                        <?php if ($row['status_hasil'] == 0) { ?>
                                            <span class="badge badge-warning">Belum Dinilai</span>
                                        <?php } else { ?>
                                            <span class="badge badge-primary">Sudah Dinilai</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <?php if ($row['status_hasil'] == 0) { ?>
                                                <span class="mr-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Input Hasil">
                                                    <button onClick="addHasil('<?= $row['id_pengajuan'] ?>')" data-toggle="modal" data-target="#modalHasil" type="button" class="btn btn-outline-success btn-circle btn-icon btn-sm">
                                                        <i class="fa fa-plus"></i></button>
                                                </span>
                                            <?php } else { ?>
                                                <span class="mr-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Perbarui Hasil">
                                                    <button onClick="changeHasil('<?= $row['id_pengajuan'] ?>')" data-toggle="modal" data-target="#modalUbahHasil" type="button" class="btn btn-outline-success btn-circle btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i></button>
                                                </span>
                                                <span data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Detail Hasil">
                                                    <button onClick="detailHasilSidang('<?= $row['id_pengajuan'] ?>')" data-toggle="modal" data-target="#modalDetailHasil" type="button" class="btn btn-outline-primary btn-circle btn-icon btn-sm">
                                                        <i class="fa fa-list-alt"></i></button>
                                                </span>
                                            <?php } ?>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Detail Jadwal">
                                                <button onClick="detailJadwal('<?= $row['nama_ruang'] ?>','<?= $row['penguji1'] ?>','<?= $row['penguji2'] ?>','<?= date('d F Y', strtotime($row['tanggal'])) ?>')" data-toggle="modal" data-target="#modalJadwal" type="button" class="btn btn-outline-primary-2 btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-calendar"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                                <button onClick="detailMahasiswa('<?= $BASE_URL ?>','<?= $row['first_name'] ?>','<?= $row['last_name'] ?>','<?= $row['jk'] ?>','<?= $row['angkatan'] ?>','<?= $row['id_users'] ?>','<?= $row['image'] ?>','<?= $row['address'] ?>','<?= $row['semester'] ?>','<?= $row['email'] ?>','<?= $row['nim'] ?>')" data-toggle="modal" data-target="#modalDetail" type="button" class="btn btn-outline-info btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-table"></i></button>
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
<div class="modal fade" id="modalHasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title_hasil"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group row mt-4">
                        <label for="" class="col-sm-2">Hasil</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="hasil" id="hasil" required style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="">- Pilih Hasil -</option>
                                    <option value="Lulus">Lulus</option>
                                    <option value="Mengulang">Mengulang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="group">

                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="button" onClick="addRevisi('group')" class="btn btn-default"><i class="fa fa-plus"></i>Tambah Revisi</button>
                        </div>
                    </div>
                    <input type="hidden" name="id_pengajuan" id="id_pengajuan">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn_hasil"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetailHasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Detail Hasil Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group row mt-4">
                        <label for="" class="col-sm-2">Hasil</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input id="hasil_sidang" required style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="group3">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalUbahHasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Detail Jadwal Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group row mt-4">
                        <label for="" class="col-sm-2">Hasil</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="hasil" id="hasil_form" required style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="">- Pilih Hasil -</option>
                                    <option value="Lulus">Lulus</option>
                                    <option value="Mengulang">Mengulang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="group2">

                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="button" onClick="addRevisi('group2')" class="btn btn-default"><i class="fa fa-plus"></i>Tambah Revisi</button>
                        </div>
                    </div>
                    <input type="hidden" name="id_pengajuan" id="id_pengajuan2">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="submit_change_hasil" class="btn btn-primary">Perbarui Hasil</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Detail Jadwal Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group row ">
                        <label for="" class="col-sm-2">Nama Ruang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input readonly id="nama_ruang" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="" class="col-sm-2">Tanggal Sidang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="penguji_1" readonly id="tgl_sidang" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="" class="col-sm-2">Dosen Penguji 1</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="penguji_1" readonly id="penguji_1" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="" class="col-sm-2">Dosen Penguji 2</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="penguji_2" readonly id="penguji_2" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

    function detailJadwal(namaRuang, penguji1, penguji2, tgl) {
        document.getElementById("nama_ruang").value = namaRuang;
        document.getElementById("penguji_1").value = penguji1;
        document.getElementById("penguji_2").value = penguji2;
        document.getElementById("tgl_sidang").value = tgl;
    }

    function addHasil(idPengajuan) {
        document.getElementById("modal_title_hasil").innerHTML = "Form Input Nilai";
        document.getElementById("btn_hasil").innerHTML = "Tambah Nilai";
        document.getElementById("btn_hasil").name = "submit_add_hasil";
        document.getElementById("id_pengajuan").value = idPengajuan;
    }

    function updateHasil() {
        document.getElementById("modal_title_hasil").innerHTML = "Form Ubah Nilai";
        document.getElementById("btn_hasil").innerHTML = "Perbarui Nilai";
        document.getElementById("btn_hasil").name = "submit_update_hasil";
    }

    function addRevisi(group) {
        // $("#group div").remove();
        createElement(group);
    }

    function createElement(group) {
        var formGroup = document.createElement('div');
        formGroup.setAttribute('class', 'form-group row mt-1');
        var colFirst = document.createElement("label");
        colFirst.setAttribute('class', 'col-sm-2 col-form-label');
        colFirst.innerHTML = 'Revisi';
        var colSecond = document.createElement('div');
        colSecond.setAttribute('class', 'col-sm-10');
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('class', 'form-control new-form');
        input.setAttribute('name', 'revisi[]');
        input.setAttribute('placeholder', '');
        input.setAttribute('autocomplete', 'off');

        colSecond.appendChild(input);
        formGroup.appendChild(colFirst);
        formGroup.appendChild(colSecond);
        $("#"+group).append(formGroup);
    }

    function changeHasil(idPengajuan) {
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "http://localhost/seleksiskripsi/dashboard/read-hasil-ajax.php?id=" + idPengajuan,
            success: function(response) {
                // console.log(JSON.parse(response));
                let data = JSON.parse(response);
                document.getElementById("hasil_form").value = data[0].hasil
                document.getElementById("id_pengajuan2").value = data[0].id_pengajuan
                var html = `<div class="group>`;
                $("#group2 div").remove();
                let x= 0;
                let y = 0;
                for (let i = 0; i < data.length; i++) {
                    
                    var formGroup = document.createElement('div');
                    formGroup.setAttribute('class', 'form-group row mt-1');
                    var colFirst = document.createElement("label");
                    colFirst.setAttribute('class', 'col-sm-2 col-form-label');
                    colFirst.innerHTML = 'Revisi';
                    var colSecond = document.createElement('div');
                    colSecond.setAttribute('class', 'col-sm-10');
                    var input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('class', 'form-control new-form');
                    input.setAttribute('name', 'revisi[]');
                    input.setAttribute('placeholder', '');
                    input.setAttribute('autocomplete', 'off');
                    input.setAttribute('id','revisi_form'+i)
                    
                    colSecond.appendChild(input);
                    formGroup.appendChild(colFirst);
                    formGroup.appendChild(colSecond);
                    $("#group2").append(formGroup);
                    document.getElementById("revisi_form"+x).value = data[y].revisi;
                    y++;
                    x++
                }
            }
        })
    }
    function detailHasilSidang(idPengajuan) {
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "http://localhost/seleksiskripsi/dashboard/read-hasil-ajax.php?id=" + idPengajuan,
            success: function(response) {
                // console.log(JSON.parse(response));
                let data = JSON.parse(response);
                document.getElementById("hasil_sidang").value = data[0].hasil
                var html = `<div class="group>`;
                $("#group3 div").remove();
                let x= 0;
                let y = 0;
                for (let i = 0; i < data.length; i++) {
                    
                    var formGroup = document.createElement('div');
                    formGroup.setAttribute('class', 'form-group row mt-1');
                    var colFirst = document.createElement("label");
                    colFirst.setAttribute('class', 'col-sm-2 col-form-label');
                    colFirst.innerHTML = 'Revisi';
                    var colSecond = document.createElement('div');
                    colSecond.setAttribute('class', 'col-sm-10');
                    var input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('class', 'form-control new-form');
                    input.setAttribute('name', 'revisi[]');
                    input.setAttribute('placeholder', '');
                    input.setAttribute('autocomplete', 'off');
                    input.setAttribute('id','revisi'+i)
                    
                    colSecond.appendChild(input);
                    formGroup.appendChild(colFirst);
                    formGroup.appendChild(colSecond);
                    $("#group3").append(formGroup);
                    document.getElementById("revisi"+x).value = data[y].revisi;
                    y++;
                    x++
                }
            }
        })
    }

    
</script>
<?php include '../components/footer.php' ?>