<?php
include 'includes/header.php';
?>

<!-- Tambahkan Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hero-section {
        position: relative;
        background: url('assets/1583054483510.jpg') center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }

    /* Overlay untuk efek blur */
    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
    }

    /* Tombol Login & Register */
    .auth-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .btn-auth {
        font-size: 18px;
        font-weight: 600;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        text-decoration: none;
        display: inline-block;
    }

    /* Warna dan efek untuk tombol Login */
    .btn-login {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
    }

    .btn-login:hover {
        background: linear-gradient(45deg, #0056b3, #004494);
        transform: scale(1.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    /* Warna dan efek untuk tombol Register */
    .btn-register {
        background: linear-gradient(45deg, #28a745, #1e7e34);
        color: white;
    }

    .btn-register:hover {
        background: linear-gradient(45deg, #1e7e34, #165a26);
        transform: scale(1.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    .team-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
    }

    .card {
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-block {
        font-weight: 600;
        border-radius: 8px;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1>Selamat Datang di Perusahaan Kami</h1>
        <p>Inovasi & Teknologi untuk Masa Depan</p>
    </div>
</div>

<div class="container mt-4">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="auth-buttons">
            <a href="login.php" class="btn-auth btn-login">🔑 Login</a>
            <a href="register.php" class="btn-auth btn-register">📝 Register</a>
        </div>
    <?php endif; ?>

    <!-- Profil Perusahaan -->
    <section class="mt-5">
        <h3>Profil Perusahaan</h3>
        <p>Perusahaan Kami adalah perusahaan yang bergerak di bidang teknologi dan inovasi. Kami berkomitmen untuk memberikan solusi terbaik bagi pelanggan dengan layanan berkualitas tinggi.</p>
    </section>

    <!-- Sejarah Perusahaan -->
    <section class="mt-5">
        <h3>Sejarah Perusahaan</h3>
        <p>Didirikan pada tahun 2000, perusahaan kami telah berkembang pesat dari sebuah startup kecil menjadi pemimpin industri dengan berbagai pencapaian inovatif.</p>
    </section>

    <!-- CEO & Manajer -->
    <section class="mt-5">
        <h3>CEO & Manajer</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <img src="assets/Mark_Zuckerberg.jpg" class="team-img mb-2" alt="CEO">
                    <h5>Mark Zuckerberg</h5>
                    <p>CEO</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <img src="assets/Sergey Brin.png" class="team-img mb-2" alt="Manager">
                    <h5>Sergey Brin</h5>
                    <p>General Manager</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Perusahaan -->
    <section class="mt-5">
        <h3>Tim Kami</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <img src="assets/oktan.jpg" class="team-img mb-2" alt="Tim 1">
                    <h6>Oktan</h6>
                    <p>Lead Developer</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <img src="assets/adit.jpg" class="team-img mb-2" alt="Tim 2">
                    <h6>Adit</h6>
                    <p>UI/UX Designer</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <img src="assets/azis.jpg" class="team-img mb-2" alt="Tim 3">
                    <h6>Azis</h6>
                    <p>Project Manager</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <img src="assets/gingin.jpg" class="team-img mb-2" alt="Tim 4">
                    <h6>GinGin</h6>
                    <p>Marketing Specialist</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Perusahaan -->
    <section class="mt-5">
        <h3>Informasi Perusahaan</h3>
        <div class="list-group">
            <?php
            require 'config/koneksi.php'; // Pastikan koneksi database disertakan

            $stmt = $conn->prepare("SELECT * FROM information");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                echo "<a href='detail.php?id=" . $row['id'] . "' class='btn btn-primary btn-block mb-2'>" . htmlspecialchars($row['title']) . "</a>";
            }
            ?>
        </div>
    </section>

</div>

<?php
include 'includes/footer.php';
?>
