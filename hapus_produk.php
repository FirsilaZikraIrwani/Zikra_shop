<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

include '../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = "DELETE FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Produk berhasil dihapus.'); window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk.'); window.location='index.php';</script>";
}
?>
