<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM mata_kuliah WHERE id = $id");
    if ($result->num_rows > 0) {
        $mata_kuliah = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];
    $dosen_pengampu = $_POST['dosen_pengampu'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $mysqli->prepare("UPDATE mata_kuliah SET nama_matkul = ?, sks=?, dosen_pengampu=?, deskripsi=? WHERE id = ?");
    $stmt->bind_param("sissi", $nama_matkul, $sks, $dosen_pengampu, $deskripsi, $id);
    if ($stmt->execute()) {
        header("Location: mata-kuliah.php?status=success");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mata Kuliah</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
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
                        Update Mata Kuliah
                    </div>
                    <div class="card-body">
                        <form action="update-mataKuliah.php?id=<?php echo $id; ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $mata_kuliah['id']; ?>">
                            <div class="mb-3">
                                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="<?php echo $mata_kuliah['nama_matkul']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="text" class="form-control" id="sks" name="sks" value="<?php echo $mata_kuliah['sks']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="dosen_pengampu" class="form-label">Dosen Pengampu</label>
                                <input type="text" class="form-control" id="dosen_pengampu" name="dosen_pengampu" value="<?php echo $mata_kuliah['dosen_pengampu']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <select class="form-select" id="deskripsi" name="deskripsi" required>
                                    <option value="" disabled selected>Pilih Deskripsi</option>
                                    <option value="Wajib" <?php if($mata_kuliah['deskripsi'] == 'Wajib') echo 'selected'; ?>>Wajib</option>
                                    <option value="Peminatan" <?php if($mata_kuliah['deskripsi'] == 'Peminatan') echo 'selected'; ?>>Peminatan</option>
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
