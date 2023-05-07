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
            <h1>Data Departemen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Departemen</li>
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
            <button type="button" class="btn btn-primary" id="tambahDepartemen"><i class="fa fa-plus mr-1"></i> Tambah Departemen</button>
          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Departemen</h3>

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
                      <th>ID Departemen</th>
                      <th>Nama Departemen</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM departemen";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[id_departemen]</td>";
                        echo "<td>$row[nama_departemen]</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a href='#' onclick='edit_departemen(".'"'."$row[id_departemen]".'","'."$row[nama_departemen]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
                          <a onclick='konfirmasi()' href='hapus_departemen.php?id_departemen=$row[id_departemen]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
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

      <div class="modal fade" id="formTambahDepartemen">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Departemen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="simpan_departemen.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="id_departemen">ID Departemen</label>
                      <input type="text" class="form-control" id="id_departemen" name="id_departemen" placeholder="Masukkan ID Departemen" required>
                    </div>
                    <div class="form-group">
                      <label for="nama_departemen">Nama Departemen</label>
                      <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" placeholder="Masukkan nama departemen" required>
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

      <div class="modal fade" id="formEditDepartemen">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Departemen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_departemen.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="e_id_departemen">ID Departemen</label>
                      <input type="text" class="form-control" id="e_id_departemen" name="e_id_departemen" placeholder="Masukkan ID Departemen" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                      <label for="e_nama_departemen">Nama Departemen</label>
                      <input type="text" class="form-control" id="e_nama_departemen" name="e_nama_departemen" placeholder="Masukkan nama departemen" required>
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
    $("#tambahDepartemen").click(function(){
      $("#formTambahDepartemen").modal();
    });
  });

  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_departemen.php", { kunci: ketikan }
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

  function edit_departemen(id_departemen,nama_departemen){
    $("#formEditDepartemen").modal();

    $('#e_id_departemen').val(id_departemen);
    $('#e_nama_departemen').val(nama_departemen);
  };
</script>

</body>
</html>