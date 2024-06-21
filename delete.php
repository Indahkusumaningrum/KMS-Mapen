<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "DELETE FROM jadwal_kuliah WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Record deleted successfully');
            window.location.href = 'index.php'; // Ganti dengan nama file yang menampilkan jadwal kuliah
          </script>";
} else {
    echo "<script>
            alert('Error deleting record: " . $conn->error . "');
            window.location.href = 'index.php'; // Ganti dengan nama file yang menampilkan jadwal kuliah
          </script>";
}

$conn->close();
?>

