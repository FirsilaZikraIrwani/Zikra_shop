<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin.'); window.location='login.php';</script>";
    exit;
}

$bulan = $_GET['bulan'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$total_bulanan = 0;

if ($bulan && $tahun) {
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
        WHERE MONTH(o.tanggal) = '$bulan' AND YEAR(o.tanggal) = '$tahun'
        ORDER BY o.tanggal DESC
    ";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan</title>
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
            max-width: 500px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff8ef;
            color: #5c4a3d;
        }

        button {
            padding: 10px 20px;
            background-color: #a97456;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #8a5c3d;
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

        .cetak-btn {
            text-align: center;
            margin-top: 30px;
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

<h2>Laporan Penjualan Bulanan</h2>

<form method="GET">
    <select name="bulan" required>
        <option value="">-- Bulan --</option>
        <?php
        $nama_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        for ($i = 1; $i <= 12; $i++) {
            $selected = ($bulan == $i) ? 'selected' : '';
            echo "<option value='$i' $selected>{$nama_bulan[$i - 1]}</option>";
        }
        ?>
    </select>
    <select name="tahun" required>
        <option value="">-- Tahun --</option>
        <?php
        $tahun_sekarang = date('Y');
        for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 5; $i--) {
            $selected = ($tahun == $i) ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
        }
        ?>
    </select>
    <button type="submit">Tampilkan</button>
</form>

<?php if ($bulan && $tahun): ?>
    <?php if (mysqli_num_rows($result) > 0): ?>

        <div style="text-align: left; margin-top: 10px;">
        <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Username</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $total_bulanan += $row['subtotal'];
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
                    <td colspan="6">Total Penjualan Bulan Ini</td>
                    <td>Rp <?= number_format($total_bulanan, 0, ',', '.') ?></td>
                </tr>
            </tbody>
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
        <p style="text-align:center; margin-top:20px;">Tidak ada transaksi pada bulan ini.</p>
    <?php endif; ?>
<?php else: ?>
    <p style="text-align:center; margin-top:40px;">Silakan pilih bulan dan tahun terlebih dahulu.</p>
<?php endif; ?>

</body>
</html>
