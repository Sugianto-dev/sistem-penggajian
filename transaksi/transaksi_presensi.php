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
<body class="hold-transition sidebar-mini" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
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
            <h1>Form Presensi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
              <li class="breadcrumb-item active">Form Presensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <?php if(isset($_SESSION['pesan_sukses'])) : ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <?php 
              echo $_SESSION['pesan_sukses'];
              unset($_SESSION['pesan_sukses']);
            ?>
          </div>
        <?php endif; ?>

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Form Presensi</h3>
          </div>

          <form action="simpan_presensi.php" method="POST">

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ID Presensi</label>
                  <input type="text" class="form-control" id="id_presensi" name="id_presensi" placeholder="Masukkan ID Presensi" value="<?php generate_id_presensi(); ?>" readonly="readonly" required>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NIK</label>
                      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?php get_data_login('nik'); ?>" readonly="readonly" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Karyawan</label>
                      <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama karyawan" value="<?php get_data_login('nama_karyawan'); ?>" readonly="readonly" required>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" required>
                  <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m'); ?>" required>
                  <input type="hidden" class="form-control" name="tahun" value="<?php echo date('Y'); ?>" required>
                </div>
                <div class="form-group">
                  <label>Waktu</label>
                  <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Masukkan waktu" readonly="readonly" required>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer">
            <?php 
              $nik_login = get_data_login2('nik');

              $cek_jam_masuk = cek_jam_masuk($nik_login);
              $cek_jam_keluar = cek_jam_keluar($nik_login);
              $cek_absen = cek_absen($nik_login);

              if ($cek_jam_keluar == '') {
                if ($cek_jam_masuk == '') {
                  echo '
                    <button type="submit" class="btn btn-info float-right ml-2" disabled><i class="fa fa-clock mr-1"></i> Jam Keluar</button>
                  ';
                } else {
                  echo '
                    <button type="submit" class="btn btn-info float-right ml-2"><i class="fa fa-clock mr-1"></i> Jam Keluar</button>
                  ';
                }
              } else {
                echo '
                  <button type="submit" class="btn btn-info float-right ml-2" disabled><i class="fa fa-clock mr-1"></i> Jam Keluar</button>
                ';
              }

              if ($cek_absen == '') {
                if ($cek_jam_masuk == '') {
                  echo '
                    <button type="submit" class="btn btn-info float-right"><i class="fa fa-clock mr-1"></i> Jam Masuk</button>
                  ';
                } else {
                  echo '
                    <button type="submit" class="btn btn-info float-right" disabled><i class="fa fa-clock mr-1"></i> Jam Masuk</button>
                  ';
                }
              } else {
                echo '
                  <button type="submit" class="btn btn-info float-right" disabled><i class="fa fa-clock mr-1"></i> Jam Masuk</button>
                ';
              }
            ?>
          </div>

          </form>

        </div>
        <!-- /.card -->

        <div class="row">
          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Lembur</h3>
              </div>

              <form action="simpan_lembur.php" method="POST">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Dari Jam</label>
                      <input type="time" class="form-control" id="dari_jam" name="dari_jam" placeholder="Dari jam" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sampai Jam</label>
                      <input type="time" class="form-control" id="sampai_jam" name="sampai_jam" placeholder="Sampai jam" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Keterangan Lembur</label>

                      <input type="hidden" class="form-control" id="id_presensi" name="id_presensi" placeholder="Masukkan ID Presensi" value="<?php generate_id_presensi(); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?php get_data_login('nik'); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m'); ?>" required>
                      <input type="hidden" class="form-control" name="tahun" value="<?php echo date('Y'); ?>" required>
                      <input type="hidden" class="form-control" id="waktu_lembur" name="waktu_lembur" placeholder="Masukkan waktu" readonly="readonly" required>

                      <textarea class="form-control" id="keterangan_lembur" name="keterangan_lembur" rows="1" placeholder="Masukkan Keterangan Lembur" required></textarea>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                <?php 
                  $nik_login = get_data_login2('nik');

                  $cek_absen = cek_absen($nik_login);

                  if ($cek_absen == 'Masuk') {
                    echo '
                      <button type="submit" class="btn btn-info float-right"><i class="fa fa-save mr-1"></i> Simpan Lembur</button>
                    ';
                  } else {
                    echo '
                      <button type="submit" class="btn btn-info float-right" disabled><i class="fa fa-save mr-1"></i> Simpan Lembur</button>
                    ';
                  }
                ?>
              </div>

              </form>

            </div>

          </div>
          <div class="col-md-6">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Form Tidak Masuk Kerja</h3>
              </div>

              <form action="simpan_absen.php" method="POST">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Absen</label>

                      <input type="hidden" class="form-control" id="id_presensi" name="id_presensi" placeholder="Masukkan ID Presensi" value="<?php generate_id_presensi(); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?php get_data_login('nik'); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" value="<?php echo date('Y-m-d'); ?>" readonly="readonly" required>
                      <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m'); ?>" required>
                      <input type="hidden" class="form-control" name="tahun" value="<?php echo date('Y'); ?>" required>

                      <select class="form-control" id="absen" name="absen" required>
                        <option value="">Pilih Keterangan</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
                        <option value="Cuti">Cuti</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <div class="card-footer">
                <?php 
                  $nik_login = get_data_login2('nik');

                  $cek_jam_masuk = cek_jam_masuk($nik_login);
                  $cek_absen = cek_absen($nik_login);

                  if ($cek_absen == '') {
                    if ($cek_jam_masuk == '') {
                      echo '
                        <button onclick="konfirmasi()" type="submit" class="btn btn-info float-right"><i class="fa fa-save mr-1"></i> Simpan Absen</button>
                      ';
                    } else {
                      echo '
                        <button onclick="konfirmasi()" type="submit" class="btn btn-info float-right" disabled><i class="fa fa-save mr-1"></i> Simpan Absen</button>
                      ';
                    }
                  } else {
                    echo '
                      <button onclick="konfirmasi()" type="submit" class="btn btn-info float-right" disabled><i class="fa fa-save mr-1"></i> Simpan Absen</button>
                    ';
                  }
                ?>
              </div>

              </form>

            </div>

          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Presensi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
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

                      $nik_login = get_data_login2('nik');
                      $tanggal_hari_ini = date('Y-m-d');

                      $query2 = "SELECT * FROM presensi WHERE nik = '$nik_login' AND tanggal = '$tanggal_hari_ini'";
                      $hasil2 = mysqli_query($conn, $query2);
                      while($row2 = mysqli_fetch_assoc($hasil2) ){
                        echo "<tr>";
                        echo "<td>$row2[id_presensi]</td>";
                        echo "<td>$row2[nik]</td>";
                        echo "<td>$row2[tanggal]</td>";
                        echo "<td>$row2[jam_masuk]</td>";
                        echo "<td>$row2[jam_keluar]</td>";
                        echo "<td>$row2[lembur]</td>";
                        echo "<td>$row2[keterangan_lembur]</td>";
                        echo "<td>$row2[absen]</td>";
                        echo "</tr>";
                      }
                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

<script>
  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_presensi.php", { kunci: ketikan }
      ).done(function( data ) {
        $("#hasil_pencarian").html(data)
      }); 
    });
  });

  function konfirmasi() {
    var konfirmasi = confirm('Apakah anda yakin?');
    if (!konfirmasi) {
      event.preventDefault();
    }
  }

  function tampilkanwaktu(){
    var waktu = new Date();
    var sh = waktu.getHours() + "";
    var sm = waktu.getMinutes() + "";
    var ss = waktu.getSeconds() + "";

    var hasil = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);

    $("#waktu").val(hasil);
    $("#waktu_lembur").val(hasil);
  }
</script>

</body>
</html>