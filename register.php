<?php
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $query->execute([$name, $email, $password]);

    if ($query) {
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
            <div class="input-group mb-2">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁</button>
            </div>
            <button type="submit" class="btn btn-success">Daftar</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
