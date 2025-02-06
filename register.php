<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $email, $password);
    if ($query->execute()) {
        header("Location: login.php");
    } else {
        $error = "Gagal mendaftar!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Registrasi</h2>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Nama" class="form-control mb-2" required>
            <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
            <button type="submit" class="btn btn-success">Daftar</button>
        </form>
    </div>
</body>
</html>
