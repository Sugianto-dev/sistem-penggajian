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
            <h1>Data Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
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

        <div class="row mb-2">
          <div class="col-12">
            <button type="button" class="btn btn-primary" id="tambahKaryawan"><i class="fa fa-plus mr-1"></i> Tambah Karyawan</button>
          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Karyawan</h3>

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
                      <th>NIK</th>
                      <th>Jabatan</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Jenis Kelamin</th>
                      <th>No Telepon</th>
                      <th>PTKP</th>
                      <th>NPWP</th>
                      <th>Tgl Masuk</th>
                      <th>Tgl Keluar</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM karyawan";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){

                        $query_j = "SELECT * FROM jabatan WHERE id_jabatan = '$row[id_jabatan]'";
                        $hasil_j = mysqli_query($conn, $query_j);
                        $row_j = mysqli_fetch_assoc($hasil_j);

                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[nik]</td>";
                        echo "<td>$row_j[nama_jabatan]</td>";
                        echo "<td>$row[nama_karyawan]</td>";
                        echo "<td>$row[alamat]</td>";
                        echo "<td>$row[jenis_kelamin]</td>";
                        echo "<td>$row[no_telepon]</td>";
                        echo "<td>$row[ptkp]</td>";
                        echo "<td>$row[npwp]</td>";
                        echo "<td>$row[tanggal_masuk]</td>";
                        echo "<td>$row[tanggal_keluar]</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a href='#' onclick='edit_karyawan($row[nik],".'"'."$row[id_jabatan]".'","'."$row_j[nama_jabatan]".'","'."$row[nama_karyawan]".'","'."$row[alamat]".'","'."$row[jenis_kelamin]".'","'."$row[no_telepon]".'","'."$row[ptkp]".'","'."$row[npwp]".'","'."$row[foto]".'","'."$row[tanggal_masuk]".'","'."$row[tanggal_keluar]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
                          <a onclick='konfirmasi()' href='hapus_karyawan.php?nik=$row[nik]&foto=$row[foto]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
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

      <div class="modal fade" id="formTambahKaryawan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="simpan_karyawan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="nik">NIK</label>
                      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required>
                    </div>
                    <div class="form-group">
                      <label for="id_jabatan">Jabatan</label>
                      <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                        <option value="">Pilih jabatan</option>
                        <?php
                          $list_jabatan = get_data_jabatan();
                          if(count($list_jabatan) > 0){
                            foreach($list_jabatan as $id_jabatan => $nama_jabatan){
                              $terpilih = '';
                              if($jabatan == $id_jabatan){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_jabatan' $terpilih> $nama_jabatan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="nama_karyawan">Nama Karyawan</label>
                      <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama karyawan" required>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat"></textarea required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <div class="row">
                        <div class="col-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki">
                            <label class="form-check-label">Laki-laki</label>
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                            <label class="form-check-label">Perempuan</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="no_telepon">No Telepon</label>
                      <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan no telepon" required>
                    </div>
                    <div class="form-group">
                      <label for="ptkp">PTKP</label>
                      <select class="form-control" id="ptkp" name="ptkp" required>
                        <option value="">Pilih PTKP</option>
                        <option value="TK/0">TK/0</option>
                        <option value="TK/1">TK/1</option>
                        <option value="TK/2">TK/2</option>
                        <option value="TK/3">TK/3</option>
                        <option value="K/0">K/0</option>
                        <option value="K/1">K/1</option>
                        <option value="K/2">K/2</option>
                        <option value="K/3">K/3</option>
                        <option value="K/I/0">K/I/0</option>
                        <option value="K/I/1">K/I/1</option>
                        <option value="K/I/2">K/I/2</option>
                        <option value="K/I/3">K/I/3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="npwp">NPWP</label>
                      <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukkan NPWP">
                    </div>
                    <div class="form-group">
                      <label for="foto">Foto</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="foto" name="foto" required>
                          <label class="custom-file-label" for="foto">Pilih foto</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tanggal_masuk">Tanggal Masuk</label>
                      <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Masukkan tanggal masuk" required>
                    </div>
                  </div>
                  <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="formEditKaryawan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_karyawan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="e_nik">NIK</label>
                      <input type="text" class="form-control" id="e_nik" name="e_nik" placeholder="Masukkan NIK" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                      <label for="e_id_jabatan">Jabatan</label>
                      <select class="form-control" id="e_id_jabatan" name="e_id_jabatan" required>
                        <option id="ij" value="">Pilih jabatan</option>
                        <?php
                          $list_jabatan = get_data_jabatan();
                          if(count($list_jabatan) > 0){
                            foreach($list_jabatan as $id_jabatan => $nama_jabatan){
                              $terpilih = '';
                              if($jabatan == $id_jabatan){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_jabatan' $terpilih> $nama_jabatan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="e_nama_karyawan">Nama Karyawan</label>
                      <input type="text" class="form-control" id="e_nama_karyawan" name="e_nama_karyawan" placeholder="Masukkan nama karyawan" required>
                    </div>
                    <div class="form-group">
                      <label for="e_alamat">Alamat</label>
                      <textarea class="form-control" id="e_alamat" name="e_alamat" rows="3" placeholder="Masukkan alamat"></textarea required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <div id="jk" class="row">
                        <div class="col-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Laki-laki">
                            <label class="form-check-label">Laki-laki</label>
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Perempuan">
                            <label class="form-check-label">Perempuan</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="e_no_telepon">No Telepon</label>
                      <input type="text" class="form-control" id="e_no_telepon" name="e_no_telepon" placeholder="Masukkan no telepon" required>
                    </div>
                    <div class="form-group">
                      <label for="e_ptkp">PTKP</label>
                      <select class="form-control" id="e_ptkp" name="e_ptkp" required>
                        <option id="p" value="">Pilih PTKP</option>
                        <option value="TK/0">TK/0</option>
                        <option value="TK/1">TK/1</option>
                        <option value="TK/2">TK/2</option>
                        <option value="TK/3">TK/3</option>
                        <option value="K/0">K/0</option>
                        <option value="K/1">K/1</option>
                        <option value="K/2">K/2</option>
                        <option value="K/3">K/3</option>
                        <option value="K/I/0">K/I/0</option>
                        <option value="K/I/1">K/I/1</option>
                        <option value="K/I/2">K/I/2</option>
                        <option value="K/I/3">K/I/3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="e_npwp">NPWP</label>
                      <input type="text" class="form-control" id="e_npwp" name="e_npwp" placeholder="Masukkan NPWP">
                    </div>
                    <div class="form-group">
                      <label for="e_foto">Foto</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="e_foto" name="e_foto">
                          <label class="custom-file-label" for="e_foto">Pilih foto</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="e_tanggal_masuk">Tanggal Masuk</label>
                      <div id="tm"></div>
                    </div>
                    <div class="form-group">
                      <label for="e_tanggal_keluar">Tanggal Keluar</label>
                      <div id="tk"></div>
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
  // tampilkan modal
  $(document).ready(function(){
    $("#tambahKaryawan").click(function(){
      $("#formTambahKaryawan").modal();
    });
  });

  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_karyawan.php", { kunci: ketikan }
      ).done(function( data ) {
        $("#hasil_pencarian").html(data)
      }); 
    });
  });

  function konfirmasi() {
    var konfirmasi = confirm('Yakin ingin menghapus data?');
    if (!konfirmasi) {
      event.preventDefault();
    }
  }

  function edit_karyawan(nik,id_jabatan,nama_jabatan,nama_karyawan,alamat,jenis_kelamin,no_telepon,ptkp,npwp,foto,tanggal_masuk,tanggal_keluar){
    $("#tm").html('<input type="date" class="form-control" id="e_tanggal_masuk" name="e_tanggal_masuk" value="'+tanggal_masuk+'" placeholder="Masukkan tanggal masuk" required>');
    $("#tk").html('<input type="date" class="form-control" id="e_tanggal_keluar" name="e_tanggal_keluar" value="'+tanggal_keluar+'" placeholder="Masukkan tanggal keluar">');
    $("#ij").text(nama_jabatan);
    $("#ij").val(id_jabatan);
    $("#p").text(ptkp);
    $("#p").val(ptkp);
    if (jenis_kelamin == "Laki-laki") {
      $("#jk").html('<div class="col-3"><div class="form-check"><input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Laki-laki" checked><label class="form-check-label">Laki-laki</label></div></div><div class="col-9"><div class="form-check"><input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Perempuan"><label class="form-check-label">Perempuan</label></div></div>');
    }else{
      $("#jk").html('<div class="col-3"><div class="form-check"><input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Laki-laki"><label class="form-check-label">Laki-laki</label></div></div><div class="col-9"><div class="form-check"><input class="form-check-input" type="radio" name="e_jenis_kelamin" value="Perempuan" checked><label class="form-check-label">Perempuan</label></div></div>');
    }

    $("#formEditKaryawan").modal();

    $('#e_nik').val(nik);
    $('#e_nama_karyawan').val(nama_karyawan);
    $('#e_alamat').val(alamat);
    $('#e_no_telepon').val(no_telepon);
    $('#e_npwp').val(npwp);
    $('#e_tanggal_masuk').val(tanggal_masuk);
  };
</script>

</body>
</html>