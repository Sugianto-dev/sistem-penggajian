<?php
  require_once "functions.php";
  check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Headscript -->
  <?php include "contents/headscript.php"; ?>
  <!-- /.headscript -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="SIPenggajianLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include "contents/navbar.php"; ?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php include "contents/sidebar.php"; ?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>About Us</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">About Us</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Sugianto</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membuat dan merancang hampir keseluruhan dari web ini.</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jl.Kaliabang Bungur Rt.03/01 Kota Bekasi</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943500947</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/sugianto.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+6281953011992" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Wijayanto</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943501112</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/wijayanto.jpeg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Riyan Budi Darmawan</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943501146</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/default.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Yan Bachtiar</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943500916</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/yan_bachtiar.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Shabilah</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943501072</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/default.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Tegar Putranta</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943501048</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/default.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Teknik Informatika
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Wendy</b></h2>
                      <p class="text-muted text-sm"><b>Kontribusi: </b> Membantu ide perancangan halaman website</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: Jakarta</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-hashtag"></i></span> NPM: 201943501038</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="dist/img/default.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="https://wa.me/+628" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i> Chat On WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->
  <?php include "contents/footer.php"; ?>
  <!-- /.footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Footscript -->
<?php include "contents/footscript.php"; ?>
<!-- /.footscript -->

</body>
</html>