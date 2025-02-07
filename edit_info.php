<?php
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE information SET title = :title, description = :description WHERE id = :id");
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: detail.php?id=" . $id);
        exit;
    } else {
        echo "Gagal memperbarui informasi!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Informasi</h2>
    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($data['title']); ?>" class="form-control mb-2" required>
        <textarea name="description" class="form-control mb-2" required><?= htmlspecialchars($data['description']); ?></textarea>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="detail.php?id=<?= $id; ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
