<?php
  require_once "functions.php";
  check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Headscript -->
  <?php include "contents/headscript.php"; ?>
  <!-- /.headscript -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="SIPenggajianLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include "contents/navbar.php"; ?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php include "contents/sidebar.php"; ?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php hitung_karyawan(); ?></h3>

                <p>Karyawan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              
              <?php 
                $status = cek_status();
                if ($status == 'HRD'){
                  echo '<a href="'.BASE_URL.'data_master/data_karyawan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
                }
              ?>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php hitung_jabatan(); ?></h3>

                <p>Jabatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
              
              <?php 
                $status = cek_status();
                if ($status == 'HRD'){
                  echo '<a href="'.BASE_URL.'data_master/data_jabatan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
                }
              ?>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php hitung_departemen(); ?></h3>

                <p>Departement</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
              
              <?php 
                $status = cek_status();
                if ($status == 'HRD'){
                  echo '<a href="'.BASE_URL.'data_master/data_departemen.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
                }
              ?>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php hitung_admin(); ?></h3>

                <p>Admin</p>
              </div>
              <div class="icon">
                <i class="ion ion-unlocked"></i>
              </div>
              
              <?php 
                $status = cek_status();
                if ($status == 'HRD'){
                  echo '<a href="'.BASE_URL.'data_master/data_admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
                }
              ?>

            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->
  <?php include "contents/footer.php"; ?>
  <!-- /.footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Footscript -->
<?php include "contents/footscript.php"; ?>
<!-- /.footscript -->

</body>
</html>