<?php include '../config/config.php' ?>
<?php include '../components/header.php' ?>
<?php include '../components/navbar.php' ?>
<?php include '../components/sidebar.php' ?>
<?php  
  if($_SESSION['users_data'] == null){
    
    Redirect($BASE_URL);
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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
      <?php if ($_SESSION['admin'] == true) { ?>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="fas fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mahasiswa</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Judul Skripsi</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-purple">
              <span class="info-box-icon"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">...</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">...</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row justify-content-center">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-money-bill-wave-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">...</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">...</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      <?php } else { ?>
      <?php } ?>

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../components/footer.php' ?>