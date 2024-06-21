<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];
    $dosen_pengampu = $_POST['dosen_pengampu'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $mysqli->prepare("INSERT INTO mata_kuliah (nama_matkul, sks, dosen_pengampu, deskripsi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama_matkul, $sks, $dosen_pengampu, $deskripsi);

    if ($stmt->execute()) {
        header('Location: mata-kuliah.php');
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Mata Kuliah</title>
  <link rel="icon" href="Scholarly.png" type="image/png"/>
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <style>
    body {
        background-color: #e7eef5;
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    .container {
        flex: 1;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        margin-bottom: 10px;
    }

    .logo-containter {
      flex: 1;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-bottom: 10px;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #2c3e50;
        color: white;
        font-weight: bold;
        text-align: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        background-color: #2c3e50;
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 16px;
    }
    .btn-primary:hover {
        background-color: #1a242f;
    }
    .logo {
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .form-control, .form-select {
        border-radius: 25px;
        padding: 10px 20px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2c3e50;
        box-shadow: none;
    }
    .form-control::placeholder {
        color: #adb5bd;
    }
    .mb-3 {
        text-align: left;
    }
    footer {
        margin-top: auto;
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: static;
    }
  </style>
  <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
      <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo" width="150">
      </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Tambah Mata Kuliah
                    </div>
                    <div class="card-body">
                        <form action="create-mataKuliah.php" method="POST">
                            <div class="mb-3">
                                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" placeholder="Masukkan nama mata kuliah" required>
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="text" class="form-control" id="sks" name="sks" rows="4" placeholder="Masukkan banyak sks" required>
                            </div>
                            <div class="mb-3">
                                <label for="dosen_pengampu" class="form-label">Dosen Pengampu</label>
                                <input type="text" class="form-control" id="dosen_pengampu" name="dosen_pengampu" placeholder="Masukkan nama dosen pengampu" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <select class="form-select" id="deskripsi" name="deskripsi" required>
                                    <option value="" disabled selected>Pilih Deskripsi</option>
                                    <option value="Wajib">Wajib</option>
                                    <option value="Peminatan">Peminatan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <footer>
      <p>&copy; 2024 Scholarly: Stay Organized, Stay Ahead.</p>
  </footer>
</body>
</html>
