<?php
include('config.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (mysqli_query($mysqli, $sql)) {
        header('Location: login.html');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
}