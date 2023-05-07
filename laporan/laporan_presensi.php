<?php
  require_once "../functions.php";
  check_login();
  if (cek_status() == 'Karyawan') {
    header("Location:".BASE_URL."login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Headscript -->
  <?php include "../contents/headscript.php"; ?>
  <!-- /.headscript -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "../contents/navbar.php"; ?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php include "../contents/sidebar.php"; ?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Presensi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Presensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
          <div class="col-md-6">

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Filter Tanggal</h3>
              </div>

              <form action="print_laporan_presensi.php" method="POST">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Dari Tanggal</label>
                      <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" placeholder="Dari tanggal" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sampai Tanggal</label>
                      <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" placeholder="Sampai tanggal" required>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                <button type="submit" name="print_tanggal" class="btn btn-default float-right"><i class="fa fa-print mr-1"></i> Print Laporan</button>
              </div>

              </form>

            </div>

          </div>

          <div class="col-md-6">

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Filter Bulan & Tahun</h3>
              </div>

              <form action="print_laporan_presensi.php" method="POST">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Bulan</label>
                      <select class="form-control" id="bulan" name="bulan" placeholder="Bulan">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun</label>
                      <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                <button type="submit" name="print_tahun" class="btn btn-default float-right"><i class="fa fa-print mr-1"></i> Print Laporan</button>
              </div>

              </form>

            </div>

          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <?php include "../contents/footer.php"; ?>
  <!-- /.footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Footscript -->
<?php include "../contents/footscript.php"; ?>
<!-- /.footscript -->

</body>
</html>