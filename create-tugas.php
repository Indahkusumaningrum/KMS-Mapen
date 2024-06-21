<?php
    include 'config.php';

    $query_matkul = "SELECT * FROM mata_kuliah";
    $result_matkul = mysqli_query($mysqli, $query_matkul);

    $matkul_option = [];
    while ($row = mysqli_fetch_assoc($result_matkul)) {
        $matkul_option[] = $row;
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
        /* align-items: center; */
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
</head>
<body>
    <div class="container mt-5">
        <div class="logo-container">
            <img src="logo.png" alt="Logo" class="logo" width="150">
        </div>        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Tambah Tugas
                    </div>
                    <div class="card-body">
                        <form action="proses-create-tugas.php" method="POST">
                            <div class="mb-3">
                                <label for="nama_matkul" class="form-label">Mata Kuliah</label>
                                <select id="nama_matkul" name="nama_matkul" class="form-select" required>
                                    <option value="" disabled selected>Pilih Mata Kuliah</option>
                                    <?php foreach($matkul_option as $matkul) { ?>
                                        <option value="<?php echo $matkul['nama_matkul']; ?>"><?php echo $matkul['nama_matkul']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi tugas" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengumpulan" class="form-label">Tanggal Pengumpulan</label>
                                <input type="date" class="form-control" id="tanggal_pengumpulan" name="tanggal_pengumpulan" required>
                            </div>
                            <div class="mb-3">
                                <label for="github_link" class="form-label">GitHub Link</label>
                                <input type="url" class="form-control" id="github_link" name="github_link">
                            </div>
                            <div class="mb-3">
                                <label for="google_meet_link" class="form-label">Google Meet Link</label>
                                <input type="url" class="form-control" id="google_meet_link" name="google_meet_link">
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp_link" class="form-label">WhatsApp Link</label>
                                <input type="url" class="form-control" id="whatsapp_link" name="whatsapp_link">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <footer>
      <p>&copy; 2024 Scholarly: Stay Organized, Stay Ahead.</p>
  </footer>
</body>
</html>
