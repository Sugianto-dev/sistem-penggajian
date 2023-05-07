<?php require "functions.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Headscript -->
  <?php include "contents/headscript.php"; ?>
  <!-- /.headscript -->

</head>
<body class="hold-transition login-page">
<div class="login-box">

  <?php 
    if(isset($_SESSION['username'])){
      $url = BASE_URL . 'index.php';
      header("Location:$url");
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
      require "koneksi.php";
      //Buka koneksi
      $conn = open_connection();

      //membuat query mySQL
      $query = "SELECT * FROM admin WHERE username = '$_POST[username]' AND password = MD5('$_POST[password]')";

      //Eksekusi Query
      $hasil = mysqli_query($conn, $query);

      //Baca hasil, kalau berhasil kita pindah halaman, jika gagal muncul pesan
      if($isi = mysqli_fetch_assoc($hasil)){
        $_SESSION['username'] = $isi['username'];
        $url = BASE_URL . 'index.php';
        header("Location:$url");
      }else{
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Username dan Password salah.
              </div>';
      }

    }      
  ?>
  
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>SI</b>Penggajian</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in untuk memulai aplikasi</p>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- Footscript -->
<?php include "contents/footscript.php"; ?>
<!-- /.footscript -->

</body>
</html>
