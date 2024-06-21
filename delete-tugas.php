<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM tugas WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: tugas.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
