<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matkul = $_POST['nama_matkul'];  // Mengambil nilai dari dropdown
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $file_path = "";

    if ($_FILES['file']['name']) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES['file']['name']);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_path = $target_dir . uniqid() . "." . $file_type;

        // Validasi tipe file
        $allowed_types = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                $sql = "INSERT INTO catatan (matkul, deskripsi, tanggal, file_path) VALUES ('$matkul', '$deskripsi', '$tanggal', '$file_path')";
                if ($mysqli->query($sql)) {
                    echo "<script>alert('Catatan berhasil ditambahkan'); window.location.href='catatan.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan catatan');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengunggah file');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak didukung');</script>";
        }
    }
}

$query_matkul = "SELECT * FROM mata_kuliah";
$result_matkul = mysqli_query($mysqli, $query_matkul);

$matkul_option = [];
while ($row = mysqli_fetch_assoc($result_matkul)) {
    $matkul_option[] = $row;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Tambah Catatan</title>
    <link rel="icon" href="Scholarly.png" type="image/png"/>

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

        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Tambah Catatan
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
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
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
