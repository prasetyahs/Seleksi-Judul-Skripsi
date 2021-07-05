<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/crud.php' ?>
<?php include '../proccess/dosen.php' ?>
<?php
$dosenPenguji = readDataAllRow($conn, "SELECT * FROM tb_pembimbing");

if(isset($_POST['submit_add'])){
    addDosen($_POST,$conn,$BASE_URL);
}

if(isset($_POST['submit_update'])){
    updateDosen($_POST,$conn,$BASE_URL);
}

if(isset($_GET['id'])){
    deleteDosen($_GET['id'],$BASE_URL,$conn);
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
                                <th>Nama Dosen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($dosenPenguji as $row) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['nama_pembimbing'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                                <button onClick="updateData('<?= $row['nama_pembimbing'] ?>','<?= $row['id_pembimbing'] ?>')" data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-outline-info btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-edit"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                                <button onClick="deleteData('<?= $BASE_URL ?>','<?= $row['id_pembimbing'] ?>')" data-toggle="modal" data-target="#modalDelete" type="button" class="btn btn-outline-danger btn-circle btn-icon btn-sm">
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
                                <input name="nama_dosen" id="nama_dosen" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Nama Dosen" a>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_pembimbing" id="id_pembimbing">

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
        document.getElementById("nama_dosen").value = "";
    }

    function updateData(namaPembimbing,id){
        document.getElementById("submit").name = "submit_update";
        document.getElementById("submit").innerHTML = "Perbarui Data";
        document.getElementById("modal_title").innerHTML = "Form Ubah Data";
        document.getElementById("nama_dosen").value = namaPembimbing;
        document.getElementById("id_pembimbing").value = id;
    }

    function deleteData(BASE_URL,idRuang){
        document.getElementById("delete_id").href = BASE_URL +'dashboard/data-dosen.php?id='+idRuang
    }
</script>
<?php include '../components/footer.php' ?>