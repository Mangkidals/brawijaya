<?php
$conn = new mysqli("localhost", "root", "", "universitas_brawijaya");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
