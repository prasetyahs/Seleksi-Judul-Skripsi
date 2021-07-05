<?php include '../config/config.php' ?>
<?php include '../config/database.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php include '../proccess/users.php' ?>
<?php include '../proccess/crud.php' ?>
<?php
$dataMahasiswa = readDataAllRow($conn, "SELECT * FROM tbl_users WHERE role = 0");

if (isset($_POST['submit_update'])) {
    updateData($conn, $_POST, $BASE_URL);
}

if(isset($_GET['id'])){
    deleteData($conn,$_GET['id'],$BASE_URL);
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
                            <li class="breadcrumb-item"><a href="">Data Mahasiswa</a></li>
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
                    <h4 class="color-primary text-bold">Data Mahasiswa</h4>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped dataTable js-exportable " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Angkatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($dataMahasiswa as $row) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['jk'] ?></td>
                                    <td><?= $row['angkatan'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <span data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                                                <button onClick="detailMahasiswa('<?= $BASE_URL ?>','<?= $row['first_name'] ?>','<?= $row['last_name'] ?>','<?= $row['jk'] ?>','<?= $row['angkatan'] ?>','<?= $row['id_users'] ?>','<?= $row['image'] ?>','<?= $row['address'] ?>','<?= $row['semester'] ?>','<?= $row['email'] ?>','<?= $row['nim'] ?>')" data-toggle="modal" data-target="#modalDetail" type="button" class="btn btn-outline-primary-2 btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-table"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Ubah Data">
                                                <button onClick="updateDataMahasiswa('<?= $BASE_URL ?>','<?= $row['first_name'] ?>','<?= $row['last_name'] ?>','<?= $row['jk'] ?>','<?= $row['angkatan'] ?>','<?= $row['id_users'] ?>')" data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-outline-info btn-circle btn-icon btn-sm">
                                                    <i class="fa fa-edit"></i></button>
                                            </span>
                                            <span class="ml-1" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                                <button  onClick="deleteData('<?= $BASE_URL ?>','<?= $row['id_users'] ?>')" data-toggle="modal" data-target="#modalDelete" type="button" class="btn btn-outline-danger btn-circle btn-icon btn-sm">
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
                                <input name="first_name" id="first_name" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Nama Depan" a>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Nama Belakang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input name="last_name" id="last_name" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control" placeholder="Nama Belakang" a>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select name="jk" id="jk" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Angkatan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select id="angkatan" name="angkatan" style="background-color: #f2f4f6;border: 0;" type="text" class="form-control">
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_users" id="id_users">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="submit_update" class="btn btn-primary">Perbarui Data</button>
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
<script>
    function updateDataMahasiswa(BASE_URL, firstName, lastName, jk, angkatan, idUsers) {
        document.getElementById("first_name").value = firstName;
        document.getElementById("last_name").value = lastName;
        document.getElementById("jk").value = jk;
        document.getElementById("angkatan").value = angkatan;
        document.getElementById("id_users").value = idUsers;
    }

    function deleteData(BASE_URL,idUsers){
        document.getElementById('delete_id').href = BASE_URL +'dashboard/data-mahasiswa.php?id='+idUsers;
    }
    function detailMahasiswa(BASE_URL,firstName,lastName,jk,angkatan,id_users,image,address,semester,email,nim){
        if(image == ''){
            document.getElementById("image_users").src = BASE_URL + 'assets/image/user.png';
        }else{
            document.getElementById("image_users").src = BASE_URL + 'assets/image/'+image;
        }
        document.getElementById("nim_detail").innerHTML = ": " + nim;
        document.getElementById("full_name").innerHTML = ": " + firstName+' ' + lastName;
        document.getElementById("jk_detail").innerHTML = ": " + jk;
        document.getElementById("semester_detail").innerHTML = ": " + semester;
        document.getElementById("angkatan_detail").innerHTML = ": " + angkatan;
        document.getElementById("email_detail").innerHTML = ": " + email;
        document.getElementById("alamat_detail").innerHTML = ": " + address;
    }
</script>
<?php include '../components/footer.php' ?>