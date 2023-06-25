<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="http://localhost/penjualanhp_two/index.php?page=home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <?php
    echo '<p style="font-size: 18px; color: #555;">Selamat Datang, ' . $namayanglogin . '!</p>';
?>
<br>
  <div class="row mb-3">
            <!-- Total Invoice Card-->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Invoice</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                          include("koneksi.php"); // Menghubungkan ke file koneksi.php

                          // Mengambil data total invoice dari tabel invoice
                          $query = "SELECT COUNT(*) AS total_inv FROM invoice_utama";
                          $result = mysqli_query($koneksi, $query);
                          $row = mysqli_fetch_assoc($result);
                          $total_inv = $row['total_inv'];

                          // Menampilkan total invoice
                          echo $total_inv;
                          ?></div>
                      <div class="mt-2 mb-0 text-muted text-s">
                      <a href="index.php?page=inv_utama" class="text-primary mr-2"><i class="fas fa fa-info-circle"></i> Lihat</a>
                      
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa fa-book fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total HP Card-->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total HP</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                          include("koneksi.php"); // Menghubungkan ke file koneksi.php

                          // Mengambil data total hp dari tabel hp
                          $query = "SELECT COUNT(*) AS total_hp FROM tabel_hp";
                          $result = mysqli_query($koneksi, $query);
                          $row = mysqli_fetch_assoc($result);
                          $total_hp = $row['total_hp'];

                          // Menampilkan total hp
                          echo $total_hp;
                          ?></div>
                      <div class="mt-2 mb-0 text-muted text-s">
                      <a href="index.php?page=hp" class="text-success mr-2"><i class="fas fa fa-info-circle"></i> Lihat</a>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-mobile-alt fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Costumer Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Costumer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                          include("koneksi.php"); // Menghubungkan ke file koneksi.php

                          // Mengambil data total costumer dari tabel costumer
                          $query = "SELECT COUNT(*) AS total_cost FROM tabel_costumer";
                          $result = mysqli_query($koneksi, $query);
                          $row = mysqli_fetch_assoc($result);
                          $total_cost = $row['total_cost'];

                          // Menampilkan total costumer
                          echo $total_cost;
                          ?></div>
                      <div class="mt-2 mb-0 text-muted text-s">
                      <a href="index.php?page=costumer" class="text-info mr-2"><i class="fas fa fa-info-circle"></i> Lihat</a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Staff Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Staff</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                          include("koneksi.php"); // Menghubungkan ke file koneksi.php

                          // Mengambil data total staff dari tabel staff
                          $query = "SELECT COUNT(*) AS total_staff FROM tabel_staff";
                          $result = mysqli_query($koneksi, $query);
                          $row = mysqli_fetch_assoc($result);
                          $total_staff = $row['total_staff'];

                          // Menampilkan total staff
                          echo $total_staff;
                          ?></div>
                      <div class="mt-2 mb-0 text-muted text-s">
                     
                      <a href="index.php?page=staff" class="text-warning mr-2"><i class="fas fa fa-info-circle"></i> Lihat</a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-tie fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

  <!--Row-->