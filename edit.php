<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $mata_kuliah = $_POST["mata_kuliah"];
    $hari = $_POST["hari"];
    $jam_mulai = $_POST["jam_mulai"];
    $jam_selesai = $_POST["jam_selesai"];
    $ruangan = $_POST["ruangan"];

    $sql = "UPDATE jadwal_kuliah SET mata_kuliah='$mata_kuliah', hari='$hari', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', ruangan='$ruangan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    header("Location: index.php"); // Redirect to main page
    exit();
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM jadwal_kuliah WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            Mata Kuliah: <input type="text" name="mata_kuliah" value="<?php echo $row["mata_kuliah"]; ?>"><br>
            Hari: <input type="text" name="hari" value="<?php echo $row["hari"]; ?>"><br>
            Jam Mulai: <input type="time" name="jam_mulai" value="<?php echo $row["jam_mulai"]; ?>"><br>
            Jam Selesai: <input type="time" name="jam_selesai" value="<?php echo $row["jam_selesai"]; ?>"><br>
            Ruangan: <input type="text" name="ruangan" value="<?php echo $row["ruangan"]; ?>"><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "No record found";
    }

    $conn->close();
}
?>
