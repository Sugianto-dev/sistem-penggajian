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
            <h1>Data Jabatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Jabatan</li>
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
            <button type="button" class="btn btn-primary" id="tambahJabatan"><i class="fa fa-plus mr-1"></i> Tambah Jabatan</button>
          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Jabatan</h3>

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
                      <th>ID Jabatan</th>
                      <th>Nama Jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>ID Tunjangan</th>
                      <th>ID Departemen</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM jabatan ORDER BY id_jabatan";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){

                        $query_t = "SELECT * FROM tunjangan WHERE id_tunjangan = '$row[id_tunjangan]'";
                        $hasil_t = mysqli_query($conn, $query_t);
                        $row_t = mysqli_fetch_assoc($hasil_t);

                        $query_d = "SELECT * FROM departemen WHERE id_departemen = '$row[id_departemen]'";
                        $hasil_d = mysqli_query($conn, $query_d);
                        $row_d = mysqli_fetch_assoc($hasil_d);

                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[id_jabatan]</td>";
                        echo "<td>$row[nama_jabatan]</td>";
                        echo "<td>$row[gaji_pokok]</td>";
                        echo "<td>$row_t[nama_tunjangan]</td>";
                        echo "<td>$row_d[nama_departemen]</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a href='#' onclick='edit_jabatan(".'"'."$row[id_jabatan]".'","'."$row[nama_jabatan]".'",'."$row[gaji_pokok]".',"'."$row_t[nama_tunjangan]".'","'."$row_t[id_tunjangan]".'","'."$row_d[nama_departemen]".'","'."$row_d[id_departemen]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
                          <a onclick='konfirmasi()' href='hapus_jabatan.php?id_jabatan=$row[id_jabatan]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
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

      <div class="modal fade" id="formTambahJabatan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Jabatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="simpan_jabatan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="id_jabatan">ID Jabatan</label>
                      <input type="text" class="form-control" id="id_jabatan" name="id_jabatan" placeholder="Masukkan ID Jabatan" required>
                    </div>
                    <div class="form-group">
                      <label for="nama_jabatan">Nama Jabatan</label>
                      <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukkan nama jabatan" required>
                    </div>
                    <div class="form-group">
                      <label for="gaji_pokok">Gaji Pokok</label>
                      <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Masukkan gaji pokok" required>
                    </div>
                    <div class="form-group">
                      <label for="id_tunjangan">Tunjangan</label>
                      <select class="form-control" id="id_tunjangan" name="id_tunjangan">
                        <option value="">Pilih Tunjangan</option>
                        <?php
                          $list_tunjangan = get_data_tunjangan();
                          if(count($list_tunjangan) > 0){
                            foreach($list_tunjangan as $id_tunjangan => $nama_tunjangan){
                              $terpilih = '';
                              if($tunjangan == $id_tunjangan){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_tunjangan' $terpilih> $nama_tunjangan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="id_departemen">Departemen</label>
                      <select class="form-control" id="id_departemen" name="id_departemen" required>
                        <option value="">Pilih Departemen</option>
                        <?php
                          $list_departemen = get_data_departemen();
                          if(count($list_departemen) > 0){
                            foreach($list_departemen as $id_departemen => $nama_departemen){
                              $terpilih = '';
                              if($departemen == $id_departemen){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_departemen' $terpilih> $nama_departemen </option>";
                            }
                          }

                        ?>
                      </select>
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

      <div class="modal fade" id="formEditJabatan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Jabatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_jabatan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="e_id_jabatan">ID Jabatan</label>
                      <input type="text" class="form-control" id="e_id_jabatan" name="e_id_jabatan" placeholder="Masukkan ID Jabatan" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                      <label for="e_nama_jabatan">Nama Jabatan</label>
                      <input type="text" class="form-control" id="e_nama_jabatan" name="e_nama_jabatan" placeholder="Masukkan nama jabatan" required>
                    </div>
                    <div class="form-group">
                      <label for="e_gaji_pokok">Gaji Pokok</label>
                      <input type="number" class="form-control" id="e_gaji_pokok" name="e_gaji_pokok" placeholder="Masukkan gaji pokok" required>
                    </div>
                    <div class="form-group">
                      <label for="e_id_tunjangan">Tunjangan</label>
                      <select class="form-control" id="e_id_tunjangan" name="e_id_tunjangan">
                        <option id="it" value="">Pilih Tunjangan</option>
                        <?php
                          $list_tunjangan = get_data_tunjangan();
                          if(count($list_tunjangan) > 0){
                            foreach($list_tunjangan as $id_tunjangan => $nama_tunjangan){
                              $terpilih = '';
                              if($tunjangan == $id_tunjangan){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_tunjangan' $terpilih> $nama_tunjangan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="e_id_departemen">Departemen</label>
                      <select class="form-control" id="e_id_departemen" name="e_id_departemen" required>
                        <option id="id" value="">Pilih Departemen</option>
                        <?php
                          $list_departemen = get_data_departemen();
                          if(count($list_departemen) > 0){
                            foreach($list_departemen as $id_departemen => $nama_departemen){
                              $terpilih = '';
                              if($departemen == $id_departemen){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$id_departemen' $terpilih> $nama_departemen </option>";
                            }
                          }

                        ?>
                      </select>
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
    $("#tambahJabatan").click(function(){
      $("#formTambahJabatan").modal();
    });
  });

  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_jabatan.php", { kunci: ketikan }
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

  function edit_jabatan(id_jabatan,nama_jabatan,gaji_pokok,nama_tunjangan,id_tunjangan,nama_departemen,id_departemen){
    $("#it").text(nama_tunjangan);
    $("#it").val(id_tunjangan);
    $("#id").text(nama_departemen);
    $("#id").val(id_departemen);

    $("#formEditJabatan").modal();

    $('#e_id_jabatan').val(id_jabatan);
    $('#e_nama_jabatan').val(nama_jabatan);
    $('#e_gaji_pokok').val(gaji_pokok);
    $('#e_id_tunjangan').val(id_tunjangan);
    $('#e_id_departemen').val(id_departemen);
  };
</script>

</body>
</html>