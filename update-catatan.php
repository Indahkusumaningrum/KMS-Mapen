<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_scholarly";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;
$matkul = "";
$deskripsi = "";
$tanggal = "";
$file_path = "";

if ($id) {
    $sql = "SELECT * FROM catatan WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $matkul = $row['matkul'];
        $deskripsi = $row['deskripsi'];
        $tanggal = $row['tanggal'];
        $file_path = $row['file_path'];
    } else {
        echo "Catatan tidak ditemukan!";
        exit;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $matkul = $_POST['matkul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $existing_file = $_POST['existing_file'];

    if (!empty($_FILES['file']['name'])) {
        $target_dir = "uploads/";
        $file_path = $target_dir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    } else {
        $file_path = $existing_file;
    }

    $sql = "UPDATE catatan SET matkul=?, deskripsi=?, tanggal=?, file_path=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $matkul, $deskripsi, $tanggal, $file_path, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Catatan berhasil diperbarui'); window.location.href='Catatan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui catatan');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
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
            margin-bottom: 10px;
        }
        .logo-container {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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
        .card-footer {
            cursor: pointer;
            background-color: #2c3e50;
            color: white;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-footer a {
            color: white;
            text-decoration: none;
        }
        .card-footer:hover {
            background-color: #1a242f;
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
                        Edit Catatan
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="mb-3">
                                <label for="matkul" class="form-label">Mata Kuliah</label>
                                <input type="text" class="form-control" name="matkul" id="matkul" value="<?= $matkul ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" required><?= $deskripsi ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $tanggal ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input type="file" class="form-control" name="file" id="file">
                                <?php if ($file_path): ?>
                                    <p>File saat ini: <a href="<?= $file_path ?>" target="_blank">Lihat File</a></p>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="existing_file" value="<?= $file_path ?>">
                            <button type="submit" name="edit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="card-footer d-flex" onclick="window.location.href='Catatan.php'">
                        <a href="Catatan.php" style="text-decoration: none; color:#fff;">View Details</a>
                        <span class="ms-auto">
                          <i class="bi bi-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Scholarly: Stay Organized, Stay Ahead.</p>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
