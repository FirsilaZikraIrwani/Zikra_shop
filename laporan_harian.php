<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin.'); window.location='../login.php';</script>";
    exit;
}

$tanggal = $_GET['tanggal'] ?? null;
$total_harian = 0;

if ($tanggal) {
    $query = "
        SELECT 
            o.id AS order_id,
            u.username,
            o.tanggal,
            p.nama AS nama_produk,
            od.qty,
            od.harga,
            (od.qty * od.harga) AS subtotal
        FROM orders o
        JOIN users u ON o.user_id = u.id
        JOIN order_details od ON o.id = od.order_id
        JOIN produk p ON od.produk_id = p.id
        WHERE DATE(o.tanggal) = '$tanggal'
        ORDER BY o.tanggal DESC
    ";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Harian</title>
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
            margin-bottom: 20px;
        }

        form {
            max-width: 420px;
            margin: 0 auto 30px;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        input[type="date"] {
            flex: 1;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #c9ad87;
            background: #fff8ef;
            color: #5c4a3d;
        }

        button {
            background-color: #a97456;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #8a5c3d;
        }

        .btn-kembali {
            background-color: #5c4a3d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 16px;
            box-shadow: 0 4px 10px rgba(92, 70, 45, 0.2);
            transition: background-color 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: #7f5a38;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fffefb;
            box-shadow: 0 6px 18px rgba(107, 82, 57, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #e3d7c3;
            text-align: center;
        }

        th {
            background-color: #e8d7c3;
            color: #3f2f1f;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f2ea;
        }

        .total {
            font-weight: bold;
            background-color: #f0e2cd;
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
            .btn-cetak,
            form {
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

<h2>Laporan Penjualan Harian</h2>

<form method="GET" action="">
    <input type="date" name="tanggal" value="<?= htmlspecialchars($tanggal ?? '') ?>" required>
    <button type="submit">Tampilkan</button>
</form>

<?php if ($tanggal): ?>
    <?php if (mysqli_num_rows($result) > 0): ?>

        <div style="text-align: left; margin-top: 10px;">
        <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Username</th>
                    <th>Waktu</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $total_harian += $row['subtotal'];
                ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; ?>
                <tr class="total">
                    <td colspan="6">Total Penjualan</td>
                    <td>Rp <?= number_format($total_harian, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>

        <div class="ttd">
            <p>Padang, <?= date('d F Y') ?></p>
            <p>Pimpinan Toko</p>
            <p class="nama">Firsila Zikra Irwani</p>
        </div>

        <button class="btn-cetak" onclick="window.print()">🖨️ Cetak Laporan</button>

    <?php else: ?>
        <p style="text-align:center; margin-top:30px;">Tidak ada transaksi pada tanggal <strong><?= $tanggal ?></strong>.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="text-align:center; margin-top:40px;">Silakan pilih tanggal terlebih dahulu untuk melihat laporan.</p>
<?php endif; ?>

</body>
</html>
