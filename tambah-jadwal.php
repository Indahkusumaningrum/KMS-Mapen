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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mata_kuliah = $_POST["mata_kuliah"];
    $dosen = $_POST["dosen"];
    $hari = $_POST["hari"];
    $jam_mulai = $_POST["jam_mulai"];
    $jam_selesai = $_POST["jam_selesai"];
    $ruang = $_POST["ruang"];

    $sql = "INSERT INTO jadwal_kuliah (mata_kuliah, dosen, hari, jam_mulai, jam_selesai, ruang) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $mata_kuliah, $dosen, $hari, $jam_mulai, $jam_selesai, $ruang);

    if ($stmt->execute()) {
        header("Location: jadwal-kuliah.php");
        exit();
    } else {
        echo "<p class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
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
    <title>Tambah Jadwal Kuliah</title>
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
                        Tambah Jadwal Kuliah
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="mb-3">
                                <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                                <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
                            </div>
                            <div class="mb-3">
                                <label for="dosen" class="form-label">Dosen</label>
                                <input type="text" class="form-control" id="dosen" name="dosen" required>
                            </div>
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <input type="text" class="form-control" id="hari" name="hari" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang" class="form-label">Ruang</label>
                                <input type="text" class="form-control" id="ruang" name="ruang" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                        </form>
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
