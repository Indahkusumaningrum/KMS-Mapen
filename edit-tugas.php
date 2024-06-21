<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM tugas WHERE id='$id'");
    $tugas = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_tugas = $_POST['nama_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_pengumpulan = $_POST['tanggal_pengumpulan'];
    $github_link = $_POST['github_link'];
    $google_meet_link = $_POST['google_meet_link'];
    $whatsapp_link = $_POST['whatsapp_link'];

    $stmt = $mysqli->prepare("UPDATE tugas SET nama_tugas=?, deskripsi=?, tanggal_pengumpulan=?, github_link=?, google_meet_link=?, whatsapp_link=? WHERE id=?");
    $stmt->bind_param("ssssssi", $nama_tugas, $deskripsi, $tanggal_pengumpulan, $github_link, $google_meet_link, $whatsapp_link, $id);

    if ($stmt->execute()) {
        header("Location: tugas.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
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
                        Edit Tugas
                    </div>
                    <div class="card-body">
                        <form action="edit-tugas.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $tugas['id']; ?>">
                            <div class="mb-3">
                                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" value="<?php echo $tugas['nama_tugas']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?php echo $tugas['deskripsi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengumpulan" class="form-label">Tanggal Pengumpulan</label>
                                <input type="date" class="form-control" id="tanggal_pengumpulan" name="tanggal_pengumpulan" value="<?php echo $tugas['tanggal_pengumpulan']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="github_link" class="form-label">GitHub Link</label>
                                <input type="url" class="form-control" id="github_link" name="github_link" value="<?php echo $tugas['github_link']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="google_meet_link" class="form-label">Google Meet Link</label>
                                <input type="url" class="form-control" id="google_meet_link" name="google_meet_link" value="<?php echo $tugas['google_meet_link']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp_link" class="form-label">Link Lainnya (GoogleColab, grup chat, dll)</label>
                                <input type="url" class="form-control" id="whatsapp_link" name="whatsapp_link" value="<?php echo $tugas['whatsapp_link']; ?>">
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
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
