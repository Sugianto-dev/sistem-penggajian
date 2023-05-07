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
            <h1>Data Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Admin</li>
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
            <button type="button" class="btn btn-primary" id="tambahAdmin"><i class="fa fa-plus mr-1"></i> Tambah Admin</button>
          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Admin</h3>

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
                      <th>ID Admin</th>
                      <th>NIK</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM admin";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){

                        $query_k = "SELECT * FROM karyawan WHERE nik = '$row[nik]'";
                        $hasil_k = mysqli_query($conn, $query_k);
                        $row_k = mysqli_fetch_assoc($hasil_k);

                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[id_admin]</td>";
                        echo "<td>$row[nik]</td>";
                        echo "<td>$row[username]</td>";
                        echo "<td>$row[password]</td>";
                        echo "<td>$row[status]</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a href='#' onclick='edit_admin(".'"'."$row[id_admin]".'","'."$row_k[nama_karyawan]".'","'."$row[nik]".'","'."$row[username]".'","'."$row[password]".'","'."$row[status]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
                          <a onclick='konfirmasi()' href='hapus_admin.php?id_admin=$row[id_admin]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
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

      <div class="modal fade" id="formTambahAdmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="simpan_admin.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="id_admin">ID Admin</label>
                      <input type="text" class="form-control" id="id_admin" name="id_admin" placeholder="Masukkan ID Admin" required>
                    </div>
                    <div class="form-group">
                      <label for="nik">NIK</label>
                      <select class="form-control" id="nik" name="nik" required>
                        <option value="">Pilih NIK</option>
                        <?php
                          $list_karyawan = get_data_karyawan();
                          if(count($list_karyawan) > 0){
                            foreach($list_karyawan as $nik => $nama_karyawan){
                              $terpilih = '';
                              if($karyawan == $nik){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$nik' $terpilih> $nik | $nama_karyawan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="HRD">HRD</option>
                        <option value="Manager">Manager</option>
                        <option value="Karyawan">Karyawan</option>
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

      <div class="modal fade" id="formEditAdmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_admin.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="e_id_admin">ID Admin</label>
                      <input type="text" class="form-control" id="e_id_admin" name="e_id_admin" placeholder="Masukkan ID Admin" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                      <label for="e_nik">NIK</label>
                      <select class="form-control" id="e_nik" name="e_nik" required>
                        <option id="n" value="">Pilih NIK</option>
                        <?php
                          $list_karyawan = get_data_karyawan();
                          if(count($list_karyawan) > 0){
                            foreach($list_karyawan as $nik => $nama_karyawan){
                              $terpilih = '';
                              if($karyawan == $nik){
                                $terpilih = ' selected';
                              }
                              echo "<option value='$nik' $terpilih> $nik | $nama_karyawan </option>";
                            }
                          }

                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="e_username">Username</label>
                      <input type="text" class="form-control" id="e_username" name="e_username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                      <label for="e_password">Password</label>
                      <input type="password" class="form-control" id="e_password" name="e_password" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                      <label for="e_status">Status</label>
                      <select class="form-control" id="e_status" name="e_status" required>
                        <option id="s" value="">Pilih Status</option>
                        <option value="HRD">HRD</option>
                        <option value="Manager">Manager</option>
                        <option value="Karyawan">Karyawan</option>
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
    $("#tambahAdmin").click(function(){
      $("#formTambahAdmin").modal();
    });
  });

  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_admin.php", { kunci: ketikan }
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

  function edit_admin(id_admin,nama_karyawan,nik,username,password,status){
    $("#n").text(nik+' | '+nama_karyawan);
    $("#n").val(nik);
    $("#s").text(status);
    $("#s").val(status);

    $("#formEditAdmin").modal();

    $('#e_id_admin').val(id_admin);
    $('#e_nik').val(nik);
    $('#e_username').val(username);
    $('#e_password').val(password);
    $('#e_status').val(status);
  };
</script>

</body>
</html>