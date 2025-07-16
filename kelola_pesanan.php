<?php
session_start();
include '../koneksi.php';

// Cek admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

// Query gabung orders dan users
$query = "SELECT orders.id, orders.tanggal, orders.total, orders.alamat, orders.metode, users.username 
          FROM orders 
          JOIN users ON orders.user_id = users.id";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Pesanan</title>
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
            margin-bottom: 2.5rem;
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
            cursor: default;
        }

        tbody tr:hover {
            background-color: #f7ede2; 
        }

        tbody td {
            padding: 14px 20px;
            border-bottom: 1px solid #e3d7c3;
            vertical-align: middle;
            color: #5a4329;
        }

        .btn-detail {
            background-color: #c9ad87; 
            color: #3f2f1f; 
            font-weight: 600;
            padding: 6px 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(201, 173, 135, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            background-color: #b4955f;
            box-shadow: 0 6px 16px rgba(180, 146, 95, 0.6);
            color: #3f2f1f;
            text-decoration: none;
        }

        .btn-back {
            background-color: #a97f61;
            color: #fff;
            font-weight: 600;
            padding: 0.55rem 1.5rem;
            border: none;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: inline-block;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(169, 127, 97, 0.3);
        }

        .btn-back:hover {
            background-color: #8f674e;
            text-decoration: none;
            color: #fff;
            box-shadow: 0 6px 16px rgba(143, 103, 78, 0.5);
        }

        @media (max-width: 600px) {
            .container {
                padding: 1.5rem 1.5rem;
            }

            table {
                font-size: 0.9rem;
            }

            .btn-detail {
                padding: 5px 10px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pesanan</h2>

        <a href="dashboard.php" class="btn-back">&#8592; Kembali ke Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Alamat</th>
                    <th>Metode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td><?= htmlspecialchars($row['metode']); ?></td>
                    <td>
                        <a href="detail_pesanan.php?id=<?= $row['id']; ?>" class="btn-detail">Detail</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
