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
            <h1>Data Tunjangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tunjangan</li>
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
            <button type="button" class="btn btn-primary" id="tambahTunjangan"><i class="fa fa-plus mr-1"></i> Tambah Tunjangan</button>
          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Tunjangan</h3>

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
                      <th>ID Tunjangan</th>
                      <th>Nama Tunjangan</th>
                      <th>Tunjangan</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="hasil_pencarian">

                    <?php 
                      require_once "../koneksi.php";
                      $conn = open_connection();

                      $query = "SELECT * FROM tunjangan";
                      $hasil = mysqli_query($conn, $query);
                      $i = 1;
                      while($row = mysqli_fetch_assoc($hasil) ){
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td>$row[id_tunjangan]</td>";
                        echo "<td>$row[nama_tunjangan]</td>";
                        echo "<td>$row[tunjangan]</td>";
                        echo "<td> 
                        <div class='btn-group'>
                          <a href='#' onclick='edit_tunjangan(".'"'."$row[id_tunjangan]".'","'."$row[nama_tunjangan]".'",'."$row[tunjangan])' class='btn btn-info'><i class='fas fa-edit'></i></a>
                          <a onclick='konfirmasi()' href='hapus_tunjangan.php?id_tunjangan=$row[id_tunjangan]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
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

      <div class="modal fade" id="formTambahTunjangan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Tunjangan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="simpan_tunjangan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="id_tunjangan">ID Tunjangan</label>
                      <input type="text" class="form-control" id="id_tunjangan" name="id_tunjangan" placeholder="Masukkan ID Tunjangan" required>
                    </div>
                    <div class="form-group">
                      <label for="nama_tunjangan">Nama Tunjangan</label>
                      <input type="text" class="form-control" id="nama_tunjangan" name="nama_tunjangan" placeholder="Masukkan nama tunjangan" required>
                    </div>
                    <div class="form-group">
                      <label for="tunjangan">Tunjangan</label>
                      <input type="number" class="form-control" id="tunjangan" name="tunjangan" placeholder="Masukkan tunjangan" required>
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

      <div class="modal fade" id="formEditTunjangan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Tunjangan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="edit_tunjangan.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="e_id_tunjangan">ID Tunjangan</label>
                      <input type="text" class="form-control" id="e_id_tunjangan" name="e_id_tunjangan" placeholder="Masukkan ID Tunjangan" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                      <label for="e_nama_tunjangan">Nama Tunjangan</label>
                      <input type="text" class="form-control" id="e_nama_tunjangan" name="e_nama_tunjangan" placeholder="Masukkan nama tunjangan" required>
                    </div>
                    <div class="form-group">
                      <label for="e_tunjangan">Tunjangan</label>
                      <input type="number" class="form-control" id="e_tunjangan" name="e_tunjangan" placeholder="Masukkan tunjangan" required>
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
    $("#tambahTunjangan").click(function(){
      $("#formTambahTunjangan").modal();
    });
  });

  $( document ).ready(function() {
    $("#kata_kunci").keyup(function(){
      var ketikan = this.value
      $.post( 
        "cari_tunjangan.php", { kunci: ketikan }
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

  function edit_tunjangan(id_tunjangan,nama_tunjangan,tunjangan){
    $("#formEditTunjangan").modal();

    $('#e_id_tunjangan').val(id_tunjangan);
    $('#e_nama_tunjangan').val(nama_tunjangan);
    $('#e_tunjangan').val(tunjangan);
  };
</script>

</body>
</html>