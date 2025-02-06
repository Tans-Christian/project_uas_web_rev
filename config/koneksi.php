<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=project_uas", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
