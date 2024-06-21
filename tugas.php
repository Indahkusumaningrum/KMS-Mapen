<?php
include 'config.php';

// Query untuk mengambil data tugas
$sql = "SELECT * FROM tugas";
$result = mysqli_query($mysqli, $sql);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Query Error: " . mysqli_error($mysqli));
}
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
      .btn-outline-primary {
          margin-bottom: 20px;
          border-color: #2c3e50;
          color: #2c3e50;
          border-radius: 8px;
          border-width: 2px;
        }
        .btn-outline-primary:hover {
          background-color: #2c3e50;
          color: white;
        }
        table {
          background-color: #ffffff;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          border-radius: 8px;
          overflow: hidden;
        }
        th {
          background-color: #a79277;
          color: #2c3e50;
          border-radius: 0;
        }
        th:first-child {
          border-top-left-radius: 8px;
        }
        th:last-child {
          border-top-right-radius: 8px;
        }
        td:last-child {
          display: flex;
          gap: 5px;
        }

        footer {
                margin-bottom: 0;
                background-color: #2c3e50;
                color: white;
                text-align: center;
                padding: 10px 0;
        }
        .fa-edit, .fa-trash, .fa-eye {
              margin-right: 5px;
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
            <li class="nav-item dropdown">
            </li>
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
              <a href="dashboard.php" class="nav-link px-3 mt-4">
                <span class="me-2"><i class="bi bi-columns"></i></span>
                <span>Dashboard</span>
              </a>

            <!-- Mata Kuliah -->
            <a class="nav-link px-3 sidebar-link" href="mata-kuliah.php">
                <span class="me-2"><i class="bi bi-book"></i></span>
                <span>Mata Kuliah</span>
            </a>
            </li>
            <!-- end of Mata Kuliah -->

            <!-- Tugas -->
            <li>
            <a class="nav-link px-3 active sidebar-link" href="tugas.php">
                <span class="me-2"><i class="bi bi-list-task"></i></span>
                <span>Tugas</span>
            </a>
            </li>
            <!-- end of Tugas -->

            <!-- Catatan -->
            <li>
              <a class="nav-link px-3 sidebar-link" href="Catatan.php">
                  <span class="me-2"><i class="bi bi-kanban"></i></span>
                  <span>Catatan</span>
              </a>
            </li>

            <!-- Jadwal -->
            <li>
            <a class="nav-link px-3 sidebar-link" href="jadwal-kuliah.php">
                <span class="me-2"><i class="bi bi-calendar-check-fill"></i></span>
                <span>Jadwal Kuliah</span>
            </a>
            </li>
            <!-- end of Jadwal -->

            <!-- Logout -->
            <li>
              <a class="nav-link px-3 sidebar-link" id="logoutButton" href="#">
                <span class="me-2"><i class="bi bi-box-arrow-right"></i></span>
                <span>Logout</span>
              </a>
            </li>
            <!-- end of Logout -->
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid" style="margin-top: 50px;">
        <h1 style="text-align: center; margin-bottom: 20px; color: #2c3e50; font-weight: bold; display: flex; justify-content: center; align-items: center;">
          <i class="fas fa-book" style="margin-right: 10px;"></i> Daftar Tugas
        </h1>
        <a class="btn btn-outline-primary" href="create-tugas.php"><i class="fas fa-plus"></i> Tambah Tugas</a>
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Tugas
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Tugas</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Pengumpulan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $counter = 1; // Initialize the counter
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo "<tr>
                                      <td>{$counter}</td> <!-- Use the counter for numbering -->
                                      <td>{$row['nama_tugas']}</td>
                                      <td>{$row['deskripsi']}</td>
                                      <td>{$row['tanggal_pengumpulan']}</td>
                                      <td>
                                          <a href='view-tugas.php?id={$row['id']}' class='btn btn-info'><i class='fas fa-eye'></i> View</a>
                                          <a href='edit-tugas.php?id={$row['id']}' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>
                                          <a href='delete-tugas.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'><i class='fas fa-trash'></i> Delete</a>
                                      </td>
                                    </tr>";
                              $counter++; // Increment the counter
                          }
                      } else {
                          echo "<tr><td colspan='5'>No data available</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <p>&copy; 2024 Scholarly: Stay Organized, Stay Ahead.</p>
      </footer>
      <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
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
