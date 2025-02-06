<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    echo "<h2>Informasi tidak ditemukan!</h2>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM information WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "<h2>Informasi tidak ditemukan!</h2>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Informasi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2><?= htmlspecialchars($data['title']); ?></h2>
        <p><?= nl2br(htmlspecialchars($data['description'])); ?></p>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
