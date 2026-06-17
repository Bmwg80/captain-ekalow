<?php
// Database connectie
// Dit moet je misschien aanpassen als je XAMPP anders hebt ingesteld

$host = "localhost";
$user = "root";
$password = "";
$database = "promoteit";

// Probeer verbinding te maken
$conn = mysqli_connect($host, $user, $password, $database);

// Check of het gelukt is
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

// Zorg dat we Nederlands kunnen gebruiken
mysqli_set_charset($conn, "utf8mb4");
?>