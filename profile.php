<?php
include 'config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $update = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $update->bind_param("ssi", $name, $email, $user_id);

        if ($update->execute()) {
            $_SESSION['name'] = $name;
            header("Location: profile.php?success=Profil diperbarui!");
        } else {
            echo "Gagal memperbarui profil!";
        }
    }

    if (isset($_POST['update_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        if (password_verify($old_password, $user['password'])) {
            $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->bind_param("si", $new_password, $user_id);

            if ($update->execute()) {
                header("Location: profile.php?success=Password diperbarui!");
            } else {
                echo "Gagal mengubah password!";
            }
        } else {
            echo "Password lama salah!";
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
        <form method="post">
            <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control mb-2" required>
            <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control mb-2" required>
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
