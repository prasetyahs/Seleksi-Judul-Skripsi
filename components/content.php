
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
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
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="fas fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number"><?= count($data_product) ?></span>

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
                <span class="info-box-text">Pelanggan (terdaftar)</span>
                <span class="info-box-number"><?= count($data_customer) ?></span>

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
                <span class="info-box-text">Jumlah Tipe Truk</span>
                <span class="info-box-number"><?= count($data_type) ?></span>

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
                <span class="info-box-text">Jumlah Merk</span>
                <span class="info-box-number"><?= count($data_merk) ?></span>

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
                <span class="info-box-text">Jumlah Pendapatan (perbulan)</span>
                <span class="info-box-number">Rp <?= number_format($data_profit) ?></span>

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
                <span class="info-box-text">Jumlah Transaksi (perbulan)</span>
                <span class="info-box-number"><?= $data_transaction ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->