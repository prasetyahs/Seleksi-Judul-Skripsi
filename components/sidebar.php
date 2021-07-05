<?php
function active($currect_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);

  if ($currect_page == $url) {
    echo 'active'; //class name in css 
  }
}
// $dataUsers = getDataRow("SELECT * FROM tbl_users WHERE email = '$emailUsers'", $conn);

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= $BASE_URL ?>assets/logo.png" style="width: auto; height:70px;" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="">
    <span class="brand-text font-weight-light" style="font-size:16px;">Universitas Darma Persada</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="image">
        <?php if ($_SESSION['users_data']['image'] == null) { ?>
          <img class="d-block mx-auto" style="width: 35px; height:35px" src="<?= $BASE_URL ?>assets/image/user.png" alt="">
        <?php } else { ?>
          <img style="width: 35px; height:35px" src="<?= $BASE_URL ?>assets/image/<?= $_SESSION['users_data']['image'] ?>" alt="">
        <?php } ?>
        <!-- <img src="<?= $BASE_URL ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <a href="#" class="d-block">Halo, <?= $_SESSION['users_data']['first_name'] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu">
          <a href="<?= $BASE_URL ?>dashboard/index.php" class="nav-link <?php active("index.php") ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <?php if ($_SESSION['admin'] == true) { ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/data-ruang.php" class="nav-link <?php active("data-ruang.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Ruang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/data-dosen.php" class="nav-link <?php active("data-dosen.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Dosen Pembimbing
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/data-mahasiswa.php" class="nav-link <?php active("data-mahasiswa.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Mahasiswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/data-skripsi.php" class="nav-link <?php active("data-skripsi.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Skripsi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/buat-jadwal.php" class="nav-link <?php active("buat-jadwal.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Buat Jadwal
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/hasil-sidang.php" class="nav-link <?php active("hasil-sidang.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Hasil Sidang
              </p>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/profile.php" class="nav-link <?php active("profile.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Diri
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/cari-jurnal.php" class="nav-link <?php active("cari-jurnal.php") ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Cari Jurnal
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/daftar-skripsi.php" class="nav-link <?php active("daftar-skripsi.php") ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Daftar Skirpsi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard/jadwal-sidang.php" class="nav-link <?php active("jadwal-sidang.php") ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Jadwal Sidang
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-header">lain-lain</li>

        <li class="nav-item has-treeview menu">
          <a href="<?= $BASE_URL ?>dashboard/logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>