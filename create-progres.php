<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tugas_id = $_POST['tugas_id'];
    $deskripsi = $_POST['deskripsi'];
    $file = $_FILES['file'];

    // Handle file upload
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);
    $fileUploaded = false;

    if ($file['size'] > 0) {
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $fileUploaded = true;
        } else {
            echo "File upload failed.";
        }
    }

    // Insert data into database
    $sql = "INSERT INTO progres (tugas_id, deskripsi, file_path) VALUES ('$tugas_id', '$deskripsi', '".($fileUploaded ? $uploadFile : "")."')";

    if (mysqli_query($mysqli, $sql)) {
        header("Location: view-tugas.php?id=$tugas_id");
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
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
    <title>Tambah Progres</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Tambah Progres</h1>
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
            <input type="hidden" name="tugas_id" value="<?php echo $_GET['tugas_id']; ?>">
            <button type="submit" class="btn btn-primary">Tambah Progres</button>
          </form>
        </div>
      </div>
      <a href="view-tugas.php?id=<?php echo $_GET['tugas_id']; ?>" class="btn btn-secondary">Kembali ke Detail Tugas</a>
    </div>
  </body>
</html>
