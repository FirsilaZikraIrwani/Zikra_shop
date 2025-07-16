<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin.'); window.location='login.php';</script>";
    exit;
}

$tahun = $_GET['tahun'] ?? '';
$total_qty = 0;
$total_transaksi = 0;

if ($tahun) {
    $query = "
        SELECT 
            p.nama AS nama_produk,
            SUM(od.qty) AS total_qty,
            SUM(od.qty * od.harga) AS total_harga
        FROM orders o
        JOIN order_details od ON o.id = od.order_id
        JOIN produk p ON od.produk_id = p.id
        WHERE YEAR(o.tanggal) = '$tahun'
        GROUP BY p.nama
        ORDER BY p.nama ASC
    ";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tahunan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fef9f4;
            color: #5c4a3d;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #7f5a38;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        label {
            font-weight: bold;
        }

        select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff8ef;
            color: #5c4a3d;
        }

        .tampil-btn {
            padding: 10px 20px;
            background-color: #a97456;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .tampil-btn:hover {
            background-color: #7f5a38;
        }

        .btn-kembali,
        .btn-cetak {
            display: inline-block;
            background-color: #5c4a3d;
            color: white;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(92, 70, 45, 0.3);
            transition: background-color 0.3s ease;
            margin-bottom: 16px;
        }

        .btn-kembali:hover,
        .btn-cetak:hover {
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
            padding: 10px;
            border: 1px solid #d9cbb2;
            text-align: center;
        }

        th {
            background-color: #d9cbb2;
        }

        .total {
            font-weight: bold;
            background-color: #f0e2cd;
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

        .cetak-btn {
            text-align: center;
            margin-top: 30px;
        }

        @media print {
            form, .btn-kembali, .btn-cetak {
                display: none !important;
            }

            body {
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<h2>Laporan Penjualan Tahunan</h2>

<form method="GET">
    <label for="tahun"><strong>Pilih Tahun:</strong></label>
    <select name="tahun" id="tahun" required>
        <option value="">-- Pilih Tahun --</option>
        <?php
        $tahun_sekarang = date('Y');
        for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 5; $i--) {
            $selected = ($tahun == $i) ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
        }
        ?>
    </select>
    <button type="submit" class="tampil-btn">Tampilkan</button>
</form>

<?php if ($tahun): ?>
    <?php if (mysqli_num_rows($result) > 0): ?>

        <div class="table-container">
        <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Total Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $total_qty += $row['total_qty'];
                    $total_transaksi += $row['total_harga'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <td><?= $row['total_qty'] ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td><strong>Total Penjualan Tahun Ini</strong></td>
                    <td><?= $total_qty ?></td>
                    <td>Rp <?= number_format($total_transaksi, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="ttd">
            <p>Padang, <?= date('d F Y') ?></p>
            <p>Pimpinan Toko</p>
            <p class="nama">Firsila Zikra Irwani</p>
        </div>

        <div class="cetak-btn">
            <button class="btn-cetak" onclick="window.print()">🖨️ Cetak Laporan</button>
        </div>

    <?php else: ?>
        <p style="text-align:center; margin-top:20px;">Tidak ada transaksi pada tahun ini.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="text-align:center; margin-top:40px;">Silakan pilih tahun terlebih dahulu.</p>
<?php endif; ?>

</body>
</html>
