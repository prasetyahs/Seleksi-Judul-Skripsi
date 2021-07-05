<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/crud.php' ?>
<?php include '../proccess/ruang.php' ?>
<?php
$dataRuang = readDataAllRow($conn, "SELECT nama_ruang,PB1.id_pembimbing as id_1,PB2.id_pembimbing as id_2,PB1.nama_pembimbing as penguji_1, PB2.nama_pembimbing as penguji_2,id_ruang,tanggal FROM tb_ruang,tb_pembimbing PB1,tb_pembimbing PB2
                                        WHERE PB1.id_pembimbing = tb_ruang.dosen_1 AND
                                              PB2.id_pembimbing = tb_ruang.dosen_2 ");
$dosenPenguji = readDataAllRow($conn, "SELECT * FROM tb_pembimbing");

if(isset($_POST['submit_add'])){
    addRuang($_POST,$conn,$BASE_URL);
}

if(isset($_POST['submit_update'])){
    updateRuang($_POST,$conn,$BASE_URL);
}

if(isset($_GET['id'])){
    deleteRuang($_GET['id'],$BASE_URL,$conn);
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ml-3 mr-3">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1><span style="font-size: 14px;">Selamat Datang di Sistem Informasi Pendaftaran Skripsi</span>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="">Data Ruang</a></li>
                        </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ml-3 mr-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-white shadow p-4">
                    <div class="row">
                        <div class="col">
                            <h4 class="color-primary text-bold mr-auto">Data Ruang</h4>
                        </div>
                        <div class="col">
                            <button onClick="addData('<?= $BASE_URL ?>')" data-toggle="modal" data-target="#modalEdit" style="float: right;" class="btn btn-outline-primary-2"> <i class="fa fa-plus"></i> Tambah Data</button>
                        </div>
                    </div>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped dataTable js-exportable " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang</th>
                                <th>Tanggal</th>
                                <th>Dosen Penguji 1</th>
                                <th>Dosen Penguju 2</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($dataRuang as $row) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['nama_ruang'] ?></td>
                                    <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                                    <td><?= $row['penguji_1'] ?></td>
                                    <td><?= $row['penguji_2'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                                <button onClick="updateData('<?= $row['nama_ruang'] ?>','<?= $row['id_1'] ?>','<?= $row['id_2'] ?>','<?= $row['tanggal'] ?>','<?= $row['id_ruang'] ?>')" data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-outline-info btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-edit"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                                <button onClick="deleteData('<?= $BASE_URL ?>','<?= $row['id_ruang'] ?>')" data-toggle="modal" data-target="#modalDelete" type="button" class="btn btn-outline-danger btn-circle btn-icon btn-sm">
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary2">
                <h5 class="modal-title" id="modal_title">Form Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: #fff;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="mt-3 pr-2 pl-2" method="post">
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Nama Depan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="nama_ruang" id="nama_ruang" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Nama Ruang" a>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Nama Belakang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="tanggal" id="tanggal" style="background-color: #f2f4f6;border: 0;" type="date" class="form-control" placeholder="Nama Belakang" a>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Penguji 1</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="penguji_1" id="penguji_1" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="">- Pilih Dosen Penguji 1 -</option>
                                    <?php foreach ($dosenPenguji as $row) { ?>
                                        <option value="<?= $row['id_pembimbing'] ?>"><?= $row['nama_pembimbing'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Penguji 2</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select id="penguji_2" name="penguji_2" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="">- Pilih Dosen Penguji 2 -</option>
                                    <?php foreach ($dosenPenguji as $row) { ?>
                                        <option value="<?= $row['id_pembimbing'] ?>"><?= $row['nama_pembimbing'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_ruang" id="id_ruang">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
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
    function addData(base_url){
        document.getElementById("submit").name = "submit_add";
        document.getElementById("submit").innerHTML = "Tambah Data";
        document.getElementById("modal_title").innerHTML = "Form Tambah Data";
        document.getElementById("nama_ruang").value = "";
        document.getElementById("penguji_1").value = "";
        document.getElementById("penguji_2").value = "";
        document.getElementById("tanggal").value = "";
    }

    function updateData(namaRuang,id_1,id_2,tanggal,ruang){
        document.getElementById("submit").name = "submit_update";
        document.getElementById("submit").innerHTML = "Perbarui Data";
        document.getElementById("modal_title").innerHTML = "Form Ubah Data";
        document.getElementById("nama_ruang").value = namaRuang;
        document.getElementById("penguji_1").value = id_1;
        document.getElementById("penguji_2").value = id_2;
        document.getElementById("tanggal").value = tanggal;
        document.getElementById("id_ruang").value = ruang;
    }

    function deleteData(BASE_URL,idRuang){
        document.getElementById("delete_id").href = BASE_URL +'dashboard/data-ruang.php?id='+idRuang
    }
</script>
<?php include '../components/footer.php' ?>