<?php
  require_once "../functions.php";
  check_login();
  if (cek_status() != 'HRD') {
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
            <h1>Form Penggajian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
              <li class="breadcrumb-item active">Form Penggajian</li>
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
            <h3 class="card-title">Form Penggajian</h3>
          </div>

          <form action="simpan_penggajian.php" method="POST">

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No Slip</label>
                  <input type="text" class="form-control" id="no_slip" name="no_slip" placeholder="Masukkan no slip" value="<?php generate_no_slip(); ?>" readonly="readonly" required>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NIK</label>
                      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Karyawan</label>
                      <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama karyawan" readonly="readonly" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                  <input type="hidden" class="form-control" id="bulan" name="bulan" placeholder="Masukkan bulan" value="<?php echo date('m'); ?>" required>
                  <input type="hidden" class="form-control" id="tahun" name="tahun" placeholder="Masukkan tahun" value="<?php echo date('Y'); ?>" required>
                </div>
                <div class="form-group">
                  <label>Gaji Pokok (1 Bulan)</label>
                  <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Masukkan gaji pokok" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>Total Tunjangan (1 Bulan)</label>
                  <input type="text" class="form-control" id="total_tunjangan" name="total_tunjangan" placeholder="Masukkan total tunjangan" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>Uang Lembur (1 Bulan)</label>
                  <input type="text" class="form-control" id="uang_lembur" name="uang_lembur" placeholder="Masukkan uang lembur" readonly="readonly" required>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Total Absen (1 Bulan)</label>
                  <input type="number" class="form-control" id="total_absen" name="total_absen" placeholder="Masukkan total absen" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>PPh 21 (1 Bulan)</label>
                  <input type="text" class="form-control" id="pph21" name="pph21" placeholder="Masukkan PPh 21" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>BPJS Ketenagakerjaan (1 Bulan)</label>
                  <input type="text" class="form-control" id="bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan" placeholder="Masukkan BPJS Ketenagakerjaan" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>BPJS Kesehatan (1 Bulan)</label>
                  <input type="text" class="form-control" id="bpjs_kesehatan" name="bpjs_kesehatan" placeholder="Masukkan BPJS Kesehatan" readonly="readonly" required>
                </div>
                <div class="form-group">
                  <label>Total Gaji (1 Bulan)</label>
                  <input type="text" class="form-control" id="total_gaji" name="total_gaji" placeholder="Masukkan total gaji" readonly="readonly" required>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-info float-right"><i class="fa fa-save mr-1"></i> Simpan</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </div>

          </form>

        </div>
        <!-- /.card -->

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Penggajian</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="kata_kunci" name="kata_kunci" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Slip</th>
                      <th>NIK</th>
                      <th>Tanggal</th>
                      <th>Gaji Pokok</th>
                      <th>Total Tunjangan</th>
                      <th>Uang Lembur</th>
                      <th>Total Absen</th>
                      <th>PPh 21</th>
                      <th>BPJS Ketenagakerjaan</th>
                      <th>BPJS Kesehatan</th>
                      <th>Total Gaji</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM penggajian";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[no_slip]</td>";
                        echo "<td>$row[nik]</td>";
                        echo "<td>$row[tanggal]</td>";
                        echo "<td>".rupiah($row['gaji_pokok'])."</td>";
                        echo "<td>".rupiah($row['total_tunjangan'])."</td>";
                        echo "<td>".rupiah($row['uang_lembur'])."</td>";
                        echo "<td>$row[total_absen]</td>";
                        echo "<td>".rupiah($row['pph21'])."</td>";
                        echo "<td>".rupiah($row['bpjs_ketenagakerjaan'])."</td>";
                        echo "<td>".rupiah($row['bpjs_kesehatan'])."</td>";
                        echo "<td>".rupiah($row['total_gaji'])."</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a onclick='konfirmasi()' href='hapus_penggajian.php?no_slip=$row[no_slip]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
                        </div>
                        </td>";
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

      <div class="modal fade" id="formEditPenggajian">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Penggajian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_penggajian.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                  <label for="e_no_slip">No Slip</label>
                    <input type="text" class="form-control" id="e_no_slip" name="e_no_slip" placeholder="Masukkan no slip" readonly="readonly" required>
                  </div>
                  <div class="form-group">
                    <label for="e_tanggal_keluar">Tanggal</label>
                    <div id="t"></div>
                  </div>
                </div>
                  <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
        "cari_penggajian.php", { kunci: ketikan }
      ).done(function( data ) {
        $("#hasil_pencarian").html(data)
      }); 
    });

    $("#nik").keyup(function(){
      var ketikan = this.value
      $.post( 
        "auto_input.php", { nik: ketikan }
      ).done(function( data ) {
        var json = data
        obj = JSON.parse(json)
        $("#nama_karyawan").val(obj.nama_karyawan)
        $("#gaji_pokok").attr('value',obj.gaji_pokok)
        $("#total_tunjangan").attr('value',obj.total_tunjangan)
        $("#uang_lembur").attr('value',obj.uang_lembur)
        $("#total_absen").attr('value',obj.total_absen)
        $("#pph21").attr('value',obj.pph21)
        $("#bpjs_ketenagakerjaan").attr('value',obj.bpjs_ketenagakerjaan)
        $("#bpjs_kesehatan").attr('value',obj.bpjs_kesehatan)
        $("#total_gaji").attr('value',obj.total_gaji)
      }); 
    });
  });

  function konfirmasi() {
    var konfirmasi = confirm('Yakin ingin menghapus data?');
    if (!konfirmasi) {
      event.preventDefault();
    }
  }

  function edit_penggajian(no_slip,tanggal){
    $("#t").html('<input type="date" class="form-control" id="e_tanggal" name="e_tanggal" value="'+tanggal+'" placeholder="Masukkan tanggal">');

    $("#formEditPenggajian").modal();

    $('#e_no_slip').val(no_slip);
  };
</script>

</body>
</html>