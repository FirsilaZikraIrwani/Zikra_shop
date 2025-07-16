<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}
include '../koneksi.php';

$produk = mysqli_query($koneksi, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Kelola Produk</title>
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
    h2 {
        font-weight: 700;
        letter-spacing: 1.2px;
        margin-bottom: 1.5rem;
        text-align: center;
        color: #6e5841; 
        text-transform: uppercase;
        user-select: none;
        text-shadow: 0 1px 0 #c9ad87;
    }

    .btn-wrapper {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn-tambah, .btn-kembali {
        background-color: #c9ad87; 
        color: #3f2f1f; 
        font-weight: 600;
        padding: 0.55rem 1.5rem;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(201, 173, 135, 0.4);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        display: inline-block;
        user-select: none;
        text-decoration: none;
        font-size: 1rem;
    }
    .btn-tambah:hover, .btn-kembali:hover {
        background-color: #b4955f;
        box-shadow: 0 6px 16px rgba(180, 146, 95, 0.6);
        color: #3f2f1f;
        text-decoration: none;
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
        user-select: none;
        font-weight: 700;
        font-size: 1.05rem;
    }

    thead th {
        padding: 16px 22px;
        text-align: left;
        border-bottom: 2px solid #c9ad87;
    }

    tbody tr {
        transition: background-color 0.3s ease;
    }

    tbody tr:hover {
        background-color: #f7ede2; 
    }

    tbody td {
        padding: 14px 20px;
        border-bottom: 1px solid #e3d7c3;
        vertical-align: middle;
    }

    .aksi-group {
        display: flex;
        gap: 12px;
    }

    .btn-edit, .btn-delete {
        font-weight: 600;
        padding: 7px 18px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        text-decoration: none;
        color: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn-edit {
        background-color: #a17c56;
    }

    .btn-edit:hover {
        background-color: #7f6340;
    }

    .btn-delete {
        background-color: #5c462d;
    }

    .btn-delete:hover {
        background-color: #3f2f1f;
    }

    @media (max-width: 600px) {
        .container {
            padding: 1.5rem 1.5rem;
        }

        table {
            font-size: 0.9rem;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .btn-wrapper {
            flex-direction: column;
        }
    }
</style>
</head>
<body>
<div class="container">
    <h2>Manajemen Produk</h2>

    <div class="btn-wrapper">
        <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
        <a href="tambah_produk.php" class="btn-tambah">+ Tambah Produk</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($produk)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td>
                    <div class="aksi-group">
                        <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="hapus_produk.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>
</body>
</html>
