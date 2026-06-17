<?php
// Database connectie
$host = "localhost";
$user = "root";
$password = "";
$database = "promoteit";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>