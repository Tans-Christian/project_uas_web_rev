<?php
include 'config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style-dashboard.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Dashboard - Selamat Datang, <?= $_SESSION['name']; ?></h2>
        <a href="profile.php" class="btn btn-warning">Edit Profil</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <h3 class="mt-4">Kelola Informasi</h3>
        <a href="index.php" class="btn btn-primary">Home</a>
        <a href="add_info.php" class="btn btn-primary">Tambah Informasi</a>
        <a href="edit_info.php" class="btn btn-warning">Edit Informasi</a>
        <a href="delete_info.php" class="btn btn-danger">Delete Informasi</a>
    </div>
</body>
</html>
