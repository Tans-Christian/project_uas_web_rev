<?php
include 'config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO information (title, description) VALUES (:title, :description)");
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Gagal menambahkan informasi!";
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="container mt-4">
    <h2>Tambah Informasi</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Judul" class="form-control mb-2" required>
        <textarea name="description" placeholder="Deskripsi" class="form-control mb-2" required></textarea>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
