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
        <h2>Dashboard - Selamat Datang, <?= htmlspecialchars($_SESSION['name']); ?></h2>
        <a href="profile.php" class="btn btn-warning">Edit Profil</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>

        <h3 class="mt-4">Kelola Informasi</h3>
        <a href="index.php" class="btn btn-primary">Home</a>
        <a href="add_info.php" class="btn btn-success">Tambah Informasi</a>

        <!-- Tabel Daftar Informasi -->
        <h3 class="mt-4">Daftar Informasi</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM information ORDER BY created_at DESC");
                $stmt->execute();
                $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($infos as $info):
                ?>
                    <tr>
                        <td><?= $info['id']; ?></td>
                        <td><?= htmlspecialchars($info['title']); ?></td>
                        <td><?= htmlspecialchars(substr($info['description'], 0, 50)) . '...'; ?></td>
                        <td><?= $info['created_at']; ?></td>
                        <td>
                            <a href="detail.php?id=<?= $info['id']; ?>" class="btn btn-info btn-sm">Lihat</a>
                            <a href="edit_info.php?id=<?= $info['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_info.php?id=<?= $info['id']; ?>" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus informasi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
