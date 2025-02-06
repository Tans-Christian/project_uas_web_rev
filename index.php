<?php
include 'config/koneksi.php';
include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Company Info</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Selamat Datang di Perusahaan Kami</h2>
        <a href="login.php" class="btn btn-primary">Login</a>
        <a href="register.php" class="btn btn-success">Register</a>

        <h3 class="mt-4">Informasi Perusahaan</h3>
        <div class="list-group">
            <?php
            $stmt = $conn->prepare("SELECT * FROM information");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
               echo "<a href='detail.php?id=" . $row['id'] . "' class='btn btn-primary btn-block mb-2'>" . htmlspecialchars($row['title']) . "</a>";
             }
             ?>
        </div>

    </div>
</body>
</html>

<?php include 'includes/footer.php';