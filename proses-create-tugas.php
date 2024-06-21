<?php
include 'config.php';

// Ambil data yang dikirim melalui formulir
$nama_tugas = $_POST['nama_matkul'];
$deskripsi = $_POST['deskripsi'];
$tanggal_pengumpulan = $_POST['tanggal_pengumpulan'];

// Query untuk menyimpan data ke database
$sql = "INSERT INTO tugas (nama_tugas, deskripsi, tanggal_pengumpulan) VALUES ('$nama_tugas', '$deskripsi', '$tanggal_pengumpulan')";

// Eksekusi query
if (mysqli_query($mysqli, $sql)) {
    // Redirect ke halaman utama dengan pesan sukses
    header("Location: tugas.php?status=success");
} else {
    // Redirect ke halaman utama dengan pesan error
    header("Location: tugas.php?status=error");
}

// Tutup koneksi database
$mysqli->close();
?>
