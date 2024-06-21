<?php
include 'config.php';

// Ambil ID tugas dari URL
$id = $_GET['id'];

// Query untuk mengambil data tugas
$sql_tugas = "SELECT * FROM tugas WHERE id = $id";
$result_tugas = mysqli_query($mysqli, $sql_tugas);

// Periksa apakah query berhasil dieksekusi
if (!$result_tugas) {
    die("Query Error: " . mysqli_error($mysqli));
}

// Ambil data tugas
$tugas = mysqli_fetch_assoc($result_tugas);

// Query untuk mengambil data progres
$sql_progres = "SELECT * FROM progres WHERE tugas_id = $id";
$result_progres = mysqli_query($mysqli, $sql_progres);

// Periksa apakah query berhasil dieksekusi
if (!$result_progres) {
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
    <title>Detail Tugas</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Detail Tugas</h1>
      <div class="card mb-3">
        <div class="card-header">
          <h3><?php echo $tugas['nama_tugas']; ?></h3>
        </div>
        <div class="card-body">
          <p><strong>Deskripsi:</strong> <?php echo $tugas['deskripsi']; ?></p>
          <p><strong>Tanggal Pengumpulan:</strong> <?php echo $tugas['tanggal_pengumpulan']; ?></p>
                <?php if ($tugas['github_link']) : ?>
                    <p>
                        <strong>GitHub Link:</strong>
                        <a href="<?php echo $tugas['github_link']; ?>" target="_blank">
                            <i class="bi bi-github"></i> GitHub
                        </a>
                    </p>
                <?php endif; ?>
                <?php if ($tugas['google_meet_link']) : ?>
                    <p>
                        <strong>Google Meet Link:</strong>
                        <a href="<?php echo $tugas['google_meet_link']; ?>" target="_blank">
                            <i class="bi bi-camera-video"></i> Google Meet
                        </a>
                    </p>
                <?php endif; ?>
                <?php if ($tugas['whatsapp_link']) : ?>
                    <p>
                        <strong>Link Lainnya:</strong>
                        <a href="<?php echo $tugas['whatsapp_link']; ?>" target="_blank">
                            <i class="bi bi-chat-dots"></i> Link lainnya
                        </a>
                    </p>
                <?php endif; ?>
        </div>
      </div>

      <h2 class="text-center mb-4">Progres Tugas</h2>
      <div class="card mb-3">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Deskripsi Progres</th>
                <th>File</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1; // Initialize the counter
              if ($result_progres->num_rows > 0) {
                  while ($row = $result_progres->fetch_assoc()) {
                      echo "<tr>
                              <td>{$counter}</td> <!-- Use the counter for numbering -->
                              <td>{$row['deskripsi']}</td>
                              <td>";
                      if ($row['file_path']) {
                          echo "<a href='download.php?file=".urlencode(basename($row['file_path']))."' target='_blank'>Download</a>";
                      } else {
                          echo "No file";
                      }
                      echo "</td>
                              <td>{$row['tanggal']}</td>
                              <td>
                                  <a href='delete-progres.php?id={$row['id']}&tugas_id={$id}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus progres ini?\")'>Delete</a>
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

      <h2 class="text-center mb-4">Tambah Progres</h2>
      <div class="card mb-3">
        <div class="card-body">
          <form action="create-progres.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi Progres</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="file" class="form-label">Upload File (Opsional)</label>
              <input class="form-control" type="file" id="file" name="file">
            </div>
            <input type="hidden" name="tugas_id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Tambah Progres</button>
          </form>
        </div>
      </div>

      <a href="tugas.php" class="btn btn-secondary">Kembali ke Daftar Tugas</a>
    </div>
  </body>
</html>

<?php
$mysqli->close();
?>
