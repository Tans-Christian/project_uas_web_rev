<?php
include 'config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM information WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $update = $conn->prepare("UPDATE information SET title = ?, description = ? WHERE id = ?");
    if ($update->execute([$title, $description, $id])) {
        header("Location: dashboard.php");
    } else {
        echo "Gagal mengedit informasi!";
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="container mt-4">
    <h2>Edit Informasi</h2>
    <form method="post">
        <input type="text" name="title" value="<?= $data['title']; ?>" class="form-control mb-2" required>
        <textarea name="description" class="form-control mb-2" required><?= $data['description']; ?></textarea>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
