<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin.'); window.location='../login.php';</script>";
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Stok Barang</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fef9f4;
            color: #5c4a3d;
            padding: 40px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #7f5a38;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .btn-kembali {
            display: inline-block;
            background-color: #5c4a3d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(92, 70, 45, 0.3);
            transition: background-color 0.3s ease;
            margin-bottom: 12px;
        }

        .btn-kembali:hover {
            background-color: #7f5a38;
        }

        .table-container {
            margin-top: 10px;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fffefb;
            box-shadow: 0 6px 18px rgba(107, 82, 57, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 20px;
            border: 1px solid #e3d7c3;
            text-align: center;
        }

        th {
            background-color: #e8d7c3;
            color: #3f2f1f;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f1e9;
        }

        .btn-cetak {
            display: block;
            margin: 40px auto 0 auto;
            background-color: #5c4a3d;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(92, 70, 45, 0.3);
            transition: background-color 0.3s ease;
        }

        .btn-cetak:hover {
            background-color: #7f5a38;
        }

        .ttd {
            margin-top: 60px;
            width: 300px;
            text-align: center;
            align-self: flex-end;
            color: #5c4a3d;
        }

        .ttd .nama {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            .btn-kembali,
            .btn-cetak {
                display: none;
            }

            body {
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<h2>Laporan Stok Barang</h2>

    <div class="table-container">
    <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= $row['stok'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="ttd">
    <p>Padang, <?= date('d F Y') ?></p>
    <p>Pimpinan Toko</p>
    <p class="nama">Firsila Zikra Irwani</p>
</div>

<button class="btn-cetak" onclick="window.print()">🖨️ Cetak Laporan</button>

</body>
</html>
