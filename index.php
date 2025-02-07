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

    <!-- Footer Section -->
    <footer class="bg-light py-3 mt-4">
        <div class="container text-center">
            <p>&copy; 2025 Company Name. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS (Optional for navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
