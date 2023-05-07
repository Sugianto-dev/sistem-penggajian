<?php
  require_once "../functions.php";
  check_login();
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
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header"> 
          <center>LAPORAN PRESENSI KARYAWAN</center>
          <small><center>PT. UNINDRA JAKARTA</center></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <div class="row invoice-info">
      <?php
        if (isset($_POST['print_tanggal'])) {
          $dari_tanggal = $_POST['dari_tanggal'];
          $sampai_tanggal = $_POST['sampai_tanggal'];
          echo '<div class="col-sm-6 invoice-col">
            <b>Laporan #'.generate_laporan().'</b><br>
            <br>
            <table border="0">
              <tr>
                <td><b>Laporan</b></td>
                <td><b> : </b></td>
                <td>Presensi Karyawan</td>
              </tr>
              <tr>
                <td><b>Filter Laporan</b></td>
                <td><b> : </b></td>
                <td>'.$dari_tanggal.' s/d '.$sampai_tanggal.'</td>
              </tr>
              <tr>
                <td><b>NIK Login</b></td>
                <td><b> : </b></td>
                <td>'.get_data_login2('nik').'</td>
              </tr>
            </table>
          </div>';
        }

        if (isset($_POST['print_tahun'])) {
          $bulan = $_POST['bulan'];
          if ($bulan == '') {
            $bulan = 'Semua Bulan';
          }
          if ($bulan == 1) {
            $bulan = 'Januari';
          } else if ($bulan == 2) {
            $bulan = 'Februari';
          } else if ($bulan == 3) {
            $bulan = 'Maret';
          } else if ($bulan == 4) {
            $bulan = 'April';
          } else if ($bulan == 5) {
            $bulan = 'Mei';
          } else if ($bulan == 6) {
            $bulan = 'Juni';
          } else if ($bulan == 7) {
            $bulan = 'Juli';
          } else if ($bulan == 8) {
            $bulan = 'Agustus';
          } else if ($bulan == 9) {
            $bulan = 'September';
          } else if ($bulan == 10) {
            $bulan = 'Oktober';
          } else if ($bulan == 11) {
            $bulan = 'November';
          } else if ($bulan == 12) {
            $bulan = 'Desember';
          }
          $tahun = $_POST['tahun'];
          echo '<div class="col-sm-6 invoice-col">
            <b>Laporan #'.generate_laporan().'</b><br>
            <br>
            <table border="0">
              <tr>
                <td><b>Laporan</b></td>
                <td><b class="ml-5 mr-2"> : </b></td>
                <td>Presensi Karyawan</td>
              </tr>
              <tr>
                <td><b>Filter Laporan</b></td>
                <td><b class="ml-5 mr-2"> : </b></td>
                <td>'.$bulan.' Tahun '.$tahun.'</td>
              </tr>
              <tr>
                <td><b>NIK Login</b></td>
                <td><b class="ml-5 mr-2"> : </b></td>
                <td>'.get_data_login2('nik').'</td>
              </tr>
            </table>
          </div>';
        }
      ?>

      <div class="col-sm-6 invoice-col">
        <span class="float-right"><b>Tanggal</b><b class="ml-5 mr-2">:</b> <?php echo date('d/m/Y'); ?></span>
      </div>
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Presensi</th>
              <th>NIK</th>
              <th>Tanggal</th>
              <th>Jam Masuk</th>
              <th>Jam Keluar</th>
              <th>Lembur (Jam)</th>
              <th>Ket.Lembur</th>
              <th>Absen</th>
            </tr>
          </thead>
          <tbody id="hasil_pencarian">

            <?php 
              require_once "../koneksi.php";
              $conn = open_connection();

              if (isset($_POST['print_tanggal'])) {
                $dari_tanggal = $_POST['dari_tanggal'];
                $sampai_tanggal = $_POST['sampai_tanggal'];
                $query = "SELECT * FROM presensi WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'";
                $hasil = mysqli_query($conn, $query);
              }

              if (isset($_POST['print_tahun'])) {
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
                if ($bulan == '') {
                  $query = "SELECT * FROM presensi WHERE tahun = '$tahun'";
                  $hasil = mysqli_query($conn, $query);
                } else {
                  $query = "SELECT * FROM presensi WHERE bulan = '$bulan' AND tahun = '$tahun'";
                  $hasil = mysqli_query($conn, $query);
                }
              }

              $i = 1;
              while($row = mysqli_fetch_assoc($hasil) ){
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>$row[id_presensi]</td>";
                echo "<td>$row[nik]</td>";
                echo "<td>$row[tanggal]</td>";
                echo "<td>$row[jam_masuk]</td>";
                echo "<td>$row[jam_keluar]</td>";
                echo "<td>$row[lembur]</td>";
                echo "<td>$row[keterangan_lembur]</td>";
                echo "<td>$row[absen]</td>";
                echo "</tr>";
              }
            ?>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-7">
      </div>
      <!-- /.col -->
      <div class="col-5">
        <div class="table-responsive">
          <?php 
              require_once "../koneksi.php";
              $conn = open_connection();

              if (isset($_POST['print_tanggal'])) {
                $dari_tanggal = $_POST['dari_tanggal'];
                $sampai_tanggal = $_POST['sampai_tanggal'];
                $query = "SELECT *, count(nik) AS jumlah_nik FROM presensi WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'";
                $hasil = mysqli_query($conn, $query);
              }

              if (isset($_POST['print_tahun'])) {
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
                if ($bulan == '') {
                  $query = "SELECT *, count(nik) AS jumlah_nik FROM presensi WHERE tahun = '$tahun'";
                  $hasil = mysqli_query($conn, $query);
                } else {
                  $query = "SELECT *, count(nik) AS jumlah_nik FROM presensi WHERE bulan = '$bulan' AND tahun = '$tahun'";
                  $hasil = mysqli_query($conn, $query);
                }
              }

              $i = 1;
              while($row = mysqli_fetch_assoc($hasil) ){
                echo '<table class="table">
                        <tr>
                          <th style="width:50%">Total Karyawan</th>
                          <td>'.$row['jumlah_nik'].' Karyawan</td>
                        </tr>
                      </table>';
              }
            ?>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- Footscript -->
<?php include "../contents/footscript.php"; ?>
<!-- /.footscript -->

<script>
  window.addEventListener("load", window.print());
</script>

</body>
</html>