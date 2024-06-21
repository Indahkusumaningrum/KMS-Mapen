<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM mata_kuliah WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: mata-kuliah.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
