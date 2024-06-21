<?php
include 'config.php';

$id = $_GET['id'];
$tugas_id = $_GET['tugas_id'];

// Query untuk menghapus progres
$sql = "DELETE FROM progres WHERE id = $id";

if (mysqli_query($mysqli, $sql)) {
    header("Location: view-tugas.php?id=$tugas_id");
} else {
    die("Error: " . mysqli_error($mysqli));
}

$mysqli->close();
?>
