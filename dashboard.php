<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin yang bisa mengakses halaman ini.'); window.location='../login.php';</script>";
    exit;
}
function getJumlah($tabel) {
    include '../koneksi.php'; 
    $result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM $tabel");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard - Cika Shop</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #fdf6e3;
    color: #5a4329;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background-color: #d6bfa6;
    color: #3f2f1f;
    display: flex;
    flex-direction: column;
    padding: 30px 20px;
    box-shadow: 3px 0 15px rgba(107, 82, 57, 0.6);
    overflow-y: auto;
  }

  .sidebar h2 {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 40px;
    text-align: center;
    letter-spacing: 1.5px;
    color: #3f2f1f;
  }

  .sidebar nav a,
  .sidebar .dropdown-toggle {
    display: flex;
    align-items: center;
    color: #6e5841;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    padding: 14px 18px;
    margin-bottom: 14px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .sidebar nav a i,
  .sidebar .dropdown-toggle i {
    margin-right: 15px;
    font-size: 18px;
    width: 22px;
    text-align: center;
  }

  .sidebar nav a:hover,
  .sidebar nav a.active,
  .sidebar .dropdown-toggle:hover {
    background-color: #c9ad87;
    color: #3f2f1f;
  }

  .dropdown {
    display: flex;
    flex-direction: column;
  }

  .dropdown-menu {
    display: none;
    flex-direction: column;
    padding-left: 20px;
  }

  .dropdown-menu a {
    font-size: 14px;
    padding: 8px 0;
    color: #6e5841;
    text-decoration: none;
  }

  .dropdown-menu a:hover {
    color: #3f2f1f;
    text-decoration: underline;
  }

  .sidebar .btn-user-page {
    margin-top: auto;
    background-color: transparent;
    border: 2px solid #3f2f1f;
    color: #3f2f1f;
    font-weight: 600;
    text-align: center;
    padding: 12px 0;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    text-decoration: none;
  }

  .sidebar .btn-user-page:hover {
    background-color: #3f2f1f;
    color: #fdf6e3;
  }

  .logout {
    margin-top: 30px;
    font-size: 14px;
    color: #7d6c58;
    text-align: center;
    line-height: 1.4;
  }

  .logout strong {
    color: #3f2f1f;
  }

  .logout a {
    color: #6e5841;
    font-weight: 600;
    text-decoration: none;
  }

  .logout a:hover {
    color: #3f2f1f;
    text-decoration: underline;
  }

  .main-content {
    margin-left: 250px;
    padding: 40px 50px;
    min-height: 100vh;
    background-color: #fff5e6; 
    box-shadow: -5px 0 15px rgba(107, 82, 57, 0.15);
    color: #5a4329;
  }

  h1 {
    font-weight: 700;
    font-size: 36px;
    margin-bottom: 30px;
    color: #5a4329;
  }

  .dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 28px;
    margin-bottom: 45px;
  }

  .card {
    background-color: #f7ede2;
    border-radius: 15px;
    padding: 30px 25px;
    box-shadow: 0 6px 18px rgba(107, 82, 57, 0.1);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s ease;
    color: #5a4329;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(107, 82, 57, 0.2);
  }

  .card-icon {
    background: #c9ad87;
    color: #3f2f1f;
    font-size: 36px;
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
  }

  .card-content h4 {
    margin: 0 0 5px 0;
    font-weight: 700;
    font-size: 18px;
    color: #7d6c58; 
  }

  .card-content p {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #5a4329;
    letter-spacing: 1px;
  }

  .info-box {
    background-color: #f0e5d8;
    padding: 25px 30px;
    border-radius: 15px;
    color: #6e5841;
    font-size: 16px;
    box-shadow: 0 5px 15px rgba(107, 82, 57, 0.05);
  }

  .btn-back-to-user {
    display: inline-block;
    margin-bottom: 30px;
    padding: 12px 24px;
    border: 2px solid #5a4329;
    color: #5a4329;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .btn-back-to-user:hover {
    background-color: #5a4329;
    color: #fdf6e3;
  }
</style>
</head>
<body>

<div class="sidebar">
  <h2>Cika Shop</h2>
  <nav>
    <a href="dashboard.php" class="active"><i class="fa fa-home"></i> Dashboard</a>
    <a href="produk.php"><i class="fa fa-box-open"></i> Kelola Produk</a>
    <a href="kelola_pesanan.php"><i class="fa fa-shopping-cart"></i> Kelola Pesanan</a>
    <a href="kelola_pengguna.php"><i class="fa fa-users"></i> Kelola Pengguna</a>
    <div class="dropdown">
      <a href="#" class="dropdown-toggle"><i class="fa fa-file-alt"></i> Laporan <i class="fa fa-caret-down" style="margin-left:auto;"></i></a>
      <div class="dropdown-menu">
        <a href="laporan_stok.php">Laporan Stok</a>
        <a href="laporan_harian.php">Laporan Harian</a>
        <a href="laporan_bulanan.php">Laporan Bulanan</a>
        <a href="laporan_tahunan.php">Laporan Tahunan</a>
      </div>
    </div>
    <a href="chat_admin.php"><i class="fa fa-comments"></i> Pesan Pengguna</a>
  </nav>
  <a href="../index.php" class="btn-user-page">Halaman User</a>
  <div class="logout">
    Login sebagai: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong><br />
    <a href="../logout.php">Logout</a>
  </div>
</div>

<div class="main-content">
  <h1>Selamat Datang, Admin!</h1>

  <div class="dashboard-grid">
    <div class="card">
      <div class="card-icon"><i class="fa fa-box-open"></i></div>
      <div class="card-content">
        <h4>Total Produk</h4>
        <p><?= getJumlah('produk') ?></p>
      </div>
    </div>

    <div class="card">
      <div class="card-icon"><i class="fa fa-shopping-cart"></i></div>
      <div class="card-content">
        <h4>Total Pesanan</h4>
        <p><?= getJumlah('orders') ?></p>
      </div>
    </div>

    <div class="card">
      <div class="card-icon"><i class="fa fa-users"></i></div>
      <div class="card-content">
        <h4>Total Pengguna</h4>
        <p><?= getJumlah('users') ?></p>
      </div>
    </div>
  </div>

  <div class="info-box">
    <p>Gunakan menu di sebelah kiri untuk mengelola data produk, pesanan, dan pengguna dengan mudah dan efisien.</p>
  </div>
</div>

<script>
  document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      const menu = this.nextElementSibling;
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    });
  });
</script>

</body>
</html>
