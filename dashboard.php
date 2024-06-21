<?php

include "config.php";

$sql = "SELECT * FROM mata_kuliah";

$result = mysqli_query($mysqli, $sql);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
  die("Query Error: " . mysqli_error($mysqli));
}

// Query untuk mengambil data jumlah mata kuliah
$sql_mata_kuliah = "SELECT COUNT(*) as total_mata_kuliah FROM mata_kuliah";
$result_mata_kuliah = mysqli_query($mysqli, $sql_mata_kuliah);
$row_mata_kuliah = mysqli_fetch_assoc($result_mata_kuliah);
$totalMataKuliah = $row_mata_kuliah['total_mata_kuliah'];

// Query untuk mengambil data jumlah SKS
$sql_sks = "SELECT SUM(sks) as total_sks FROM mata_kuliah";
$result_sks = mysqli_query($mysqli, $sql_sks);
$row_sks = mysqli_fetch_assoc($result_sks);
$totalSKS = $row_sks['total_sks'];

// Query untuk mengambil data jumlah tugas
$sql_tugas = "SELECT COUNT(*) as total_tugas FROM tugas";
$result_tugas = mysqli_query($mysqli, $sql_tugas);
$row_tugas = mysqli_fetch_assoc($result_tugas);
$totalTugas = $row_tugas['total_tugas'];

// Query untuk mengambil data jumlah catatan
$sql_catatan = "SELECT COUNT(*) as total_catatan FROM catatan";
$result_catatan = mysqli_query($mysqli, $sql_catatan);
$row_catatan = mysqli_fetch_assoc($result_catatan);
$totalCatatan = $row_catatan['total_catatan'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style2.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Scholarly</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>
    <style>
      .card-body i {
        font-size: 4rem !important; 
        color: #a0a0a0; 
      }
    </style>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #e7eef5;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample" style="border-color: #2c3e50; border-width: 3px;">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar" style="background-color: #2c3e50"></span>
        </button>
        <img class="ms-1" src="logo.png" alt="ScholarlyLogo" width="135px"/>
        <a class="navbar-brand me-auto ms-lg-0 ms-2 text-uppercase fw-bold" href="#" style="color: #2c3e50;">Stay Organized, Stay Ahead</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown"></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-light mt-3" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0" style="background-color: #e7eef5;">
        <nav class="navbar-light">
          <ul class="navbar-nav">
            <!-- Dashboard -->
            <li>
              <a href="#" class="nav-link px-3 active mt-4">
                <span class="me-2"><i class="bi bi-columns"></i></span>
                <span>Dashboard</span>
              </a>

            <!-- Mata Kuliah -->
            <a class="nav-link px-3 sidebar-link" href="mata-kuliah.php">
                <span class="me-2"><i class="bi bi-book"></i></span>
                <span>Mata Kuliah</span>
                <span class="ms-auto">
                <span class="right-icon"></span>
                </span>
            </a>
            <!-- end of Mata Kuliah -->

            <!-- Tugas -->
            <li>
            <a class="nav-link px-3 sidebar-link" href="tugas.php">
                <span class="me-2"><i class="bi bi-list-task"></i></span>
                <span>Tugas</span>
                <span class="ms-auto">
                <span class="right-icon"></span>
                </span>
            </a>
            </li>
            <!-- end of Tugas -->

            <!-- Project -->
            <li>
              <a class="nav-link px-3 sidebar-link" href="Catatan.php">
                  <span class="me-2"><i class="bi bi-card-text"></i></span>
                  <span>Catatan</span>
                  <span class="ms-auto">
                  <span class="right-icon"></span>
                  </span>
              </a>
            </li>

            <!-- Jadwal -->
            <li>
            <a class="nav-link px-3 sidebar-link" href="jadwal-kuliah.php">
                <span class="me-2"><i class="bi bi-calendar-check-fill"></i></span>
                <span>Jadwal Kuliah</span>
                <span class="ms-auto">
                <span class="right-icon"></span>
                </span>
            </a>
            </li>
            <!-- end of Jadwal -->

            <!-- Logout -->
            <li>
            <a class="nav-link px-3 sidebar-link" id="logoutButton" href="#">
                <span class="me-2"><i class="bi bi-box-arrow-right"></i></span>
                <span>Logout</span>
                <span class="ms-auto">
                <span class="right-icon"></span>
                </span>
            </a>
            </li>
            <!-- end of Logout --> 

          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="breadcrumb mt-4 ms-3">
              <span class="breadcrumb-item active">DASHBOARD</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card text-white h-100 active" style="background-color: #2c3e50;">
              <div class="card-body d-flex justify-content-between align-items-center py-5">
                <div>
                  Mata Kuliah
                  <h2><?php echo $totalMataKuliah; ?></h2>
                </div>
                <i class="bi bi-book" style="font-size: 2rem;"></i>
              </div>
              <a style="text-decoration: none; color:#fff;" href="mata-kuliah.php">
                <div class="card-footer d-flex">
                  <span>View Details</span>
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-white h-100 " style="background-color: #2c3e50;">
              <div class="card-body d-flex justify-content-between align-items-center py-5">
                <div>
                  SKS
                  <h2><?php echo $totalSKS; ?></h2>
                </div>
                <i class="bi bi-bookmark" style="font-size: 2rem;"></i>
              </div>
              <a style="text-decoration: none; color:#fff;" href="mata-kuliah.php">
                <div class="card-footer d-flex">
                  <span>View Details</span>
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-white h-100 " style="background-color: #2c3e50;">
              <div class="card-body d-flex justify-content-between align-items-center py-5">
                <div>
                  Tugas
                  <h2><?php echo $totalTugas; ?></h2>
                </div>
                <i class="bi bi-list-task" style="font-size: 2rem;"></i>
              </div>
              <a style="text-decoration: none; color:#fff;" href="tugas.php">
                <div class="card-footer d-flex">
                  <span>View Details</span>
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-white h-100 " style="background-color: #2c3e50;">
              <div class="card-body d-flex justify-content-between align-items-center py-5">
                <div>
                  Catatan
                  <h2><?php echo $totalCatatan; ?></h2>
                </div>
                <i class="bi bi-card-text" style="font-size: 2rem;"></i>
              </div>
              <a style="text-decoration: none; color:#fff;" href="Catatan.php">
                <div class="card-footer d-flex">
                  <span>View Details</span>
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <!-- Tabel data -->
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Nama Mata Kuliah</th>
              <th>SKS</th>
              <th>Dosen Pengampu</th>
              <th>Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $result = $mysqli->query("SELECT * FROM mata_kuliah"); 
            while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['nama_matkul']; ?></td>
              <td><?php echo $row['sks']; ?></td>
              <td><?php echo $row['dosen_pengampu']; ?></td>
              <td><?php echo $row['deskripsi']; ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
    <script>
      document.getElementById('logoutButton').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
          title: 'Konfirmasi Logout',
          text: 'Apakah Anda yakin ingin logout?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Iya, Logout',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'logout.php';
          }
        });
      });
    </script>
  </body>
</html>

<?php
$mysqli->close();
?>
