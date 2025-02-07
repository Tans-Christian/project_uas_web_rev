<?php
include 'includes/header.php';
?>
  <!-- Main Content Section -->
    <div class="container mt-4">
        <h2>Selamat Datang di Perusahaan Kami</h2>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-success">Register</a>
        <?php endif; ?>

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
<?php
include 'includes/footer.php';
?>
