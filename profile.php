<?php
include 'includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $update = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :user_id");
        $update->bindParam(':name', $name, PDO::PARAM_STR);
        $update->bindParam(':email', $email, PDO::PARAM_STR);
        $update->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($update->execute()) {
            $_SESSION['name'] = $name;
            header("Location: profile.php?success=Profil diperbarui!");
            exit;
        } else {
            header("Location: profile.php?error=Gagal memperbarui profil!");
            exit;
        }
    }

    if (isset($_POST['update_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        if (password_verify($old_password, $user['password'])) {
            $update = $conn->prepare("UPDATE users SET password = :new_password WHERE id = :user_id");
            $update->bindParam(':new_password', $new_password, PDO::PARAM_STR);
            $update->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($update->execute()) {
                header("Location: profile.php?success=Password diperbarui!");
                exit;
            } else {
                header("Location: profile.php?error=Gagal mengubah password!");
                exit;
            }
        } else {
            header("Location: profile.php?error=Password lama salah!");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Profil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Profil</h2>
        
        <!-- Notifikasi -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']); ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" class="form-control mb-2" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control mb-2" required>
            <button type="submit" name="update_profile" class="btn btn-warning">Update Profil</button>
        </form>

        <h2 class="mt-4">Ubah Password</h2>
        <form method="post">
            <input type="password" name="old_password" placeholder="Password Lama" class="form-control mb-2" required>
            <input type="password" name="new_password" placeholder="Password Baru" class="form-control mb-2" required>
            <button type="submit" name="update_password" class="btn btn-danger">Ubah Password</button>
        </form>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>
