<?php
session_start();
include './config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNS Company</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to right, #007bff, #00bcd4);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <span class="font-weight-bold" style="font-size: 1.5rem;">TNS Company</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white" href="index.php" style="transition: 0.3s;">Home</a>
                </li>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-4 py-2 rounded-3 mx-2" href="login.php" style="transition: 0.3s;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-4 py-2 rounded-3 mx-2" href="register.php" style="transition: 0.3s;">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger px-4 py-2 rounded-3 mx-2" href="logout.php" style="transition: 0.3s;">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-4 py-2 rounded-3 mx-2" href="dashboard.php" style="transition: 0.3s;">Profile</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
