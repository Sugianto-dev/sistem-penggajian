<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASE_URL ?>" class="brand-link">
      <img src="<?= BASE_URL ?>dist/img/logo.png" alt="SIPenggajian Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>SI</b>Penggajian v1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= BASE_URL ?>dist/uploads/<?php get_data_login('foto'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php get_data_login('nama_karyawan'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= BASE_URL ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">

            <!-- Hak master -->
            <?php hak_master(); ?>

              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master

                <!-- Keterangan hak master -->
                <?php ket_hak_master(); ?>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL ?>data_master/data_karyawan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>data_master/data_jabatan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>data_master/data_tunjangan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Tunjangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>data_master/data_departemen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Departemen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>data_master/data_admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Admin</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-pen-alt"></i>
              <p>
                Input Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">

                <!-- Hak penggajian -->
                <?php hak_penggajian(); ?>

                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Penggajian

                    <!-- Keterangan hak penggajian -->
                    <?php ket_hak_penggajian(); ?>

                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>transaksi/transaksi_presensi.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            
            <!-- Hak laporan -->
            <?php hak_laporan(); ?>

              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Laporan
                
                <!-- Keterangan hak laporan -->
                <?php ket_hak_laporan(); ?>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL ?>laporan/laporan_penggajian.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penggajian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL ?>laporan/laporan_presensi.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Presensi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL ?>logout.php" onclick="return confirm('Yakin ingin keluar?')" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
                <i class="right fas"></i>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>