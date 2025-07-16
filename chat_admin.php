<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin yang bisa mengakses halaman ini.'); window.location='../login.php';</script>";
    exit;
}
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Pengguna - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fdf6e3;
      color: #5a4329;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 3rem 2rem;
    }

    .container {
      max-width: 960px;
      margin: auto;
      background-color: #fff5e6;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(107, 82, 57, 0.1);
      padding: 2.5rem 3rem;
    }

    .btn-back {
      background-color: #a97f61;
      color: #fff;
      font-weight: 600;
      padding: 0.55rem 1.5rem;
      border: none;
      border-radius: 10px;
      margin: 1rem 0 2rem 0;
      display: inline-block;
      text-decoration: none;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 12px rgba(169, 127, 97, 0.3);
    }

    .btn-back:hover {
      background-color: #8f674e;
      color: #fff;
      text-decoration: none;
      box-shadow: 0 6px 16px rgba(143, 103, 78, 0.5);
    }

    h2 {
      font-weight: 700;
      letter-spacing: 1.2px;
      margin-bottom: 1rem;
      text-align: center;
      color: #6e5841;
      text-transform: uppercase;
      user-select: none;
      text-shadow: 0 1px 0 #c9ad87;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(107, 82, 57, 0.12);
      font-size: 1rem;
      background-color: #fff5e6;
      color: #5a4329;
    }

    thead tr {
      background-color: #d6bfa6;
      color: #3f2f1f;
      font-weight: 700;
      font-size: 1.05rem;
    }

    th, td {
      padding: 14px 20px;
      border-bottom: 1px solid #e3d7c3;
      text-align: left;
      vertical-align: top;
    }

    tbody tr:hover {
      background-color: #f7ede2;
    }

    @media (max-width: 600px) {
      .container {
        padding: 1.5rem 1.5rem;
      }

      table {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Pesan dari Pengguna</h2>

  <a href="dashboard.php" class="btn-back">&#8592; Kembali ke Dashboard</a>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Pesan</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM kontak ORDER BY tanggal DESC";
      $result = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>" . htmlspecialchars($row['nama']) . "</td>
                  <td>" . htmlspecialchars($row['email']) . "</td>
                  <td>" . nl2br(htmlspecialchars($row['pesan'])) . "</td>
                  <td>" . htmlspecialchars($row['tanggal']) . "</td>
                </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
