<?php
include 'config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM information WHERE id = ?");
$stmt->execute([$id]);

header("Location: dashboard.php");
exit;
?>
