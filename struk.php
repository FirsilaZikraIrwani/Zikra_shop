<?php
session_start();
include 'koneksi.php';

$order_id = $_GET['order_id'] ?? '';
if (!$order_id) {
    echo "<script>alert('ID Pesanan tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}

$order = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM orders WHERE id = '$order_id'"));
$order_items = mysqli_query($koneksi, "SELECT od.*, p.nama FROM order_details od JOIN produk p ON od.produk_id = p.id WHERE od.order_id = '$order_id'");

if (!$order) {
    echo "<script>alert('Pesanan tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fefaf5;
            padding: 30px;
            color: #3b2f2f;
        }

        .success-box {
            max-width: 700px;
            margin: auto;
            background: #fffdf9;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h2 {
            color: #6b4e3d;
            text-align: center;
        }

        .section {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #d5bfa3;
            color: #3b2f2f;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .button-group a,
        .button-group button {
            display: inline-block;
            margin: 0 10px;
            padding: 12px 20px;
            background: #8b6f47;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .button-group a:hover,
        .button-group button:hover {
            background: #6f5435;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-style: italic;
        }

        .footer .name {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* === CETAK SAJA === */
        @media print {
            .button-group {
                display: none;
            }
            body {
                background: white;
                color: black;
                padding: 0;
            }
            .success-box {
                box-shadow: none;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="success-box">
    <h2>✅ Pesanan Berhasil!</h2>

    <div class="section">
        <strong>ID Pesanan:</strong> <?= htmlspecialchars($order['id']) ?><br>
        <strong>Nama Pengguna:</strong> <?= htmlspecialchars($_SESSION['username'] ?? 'Pengguna') ?><br>
        <strong>Alamat:</strong> <?= htmlspecialchars($order['alamat']) ?><br>
        <strong>Metode Pembayaran:</strong> <?= htmlspecialchars($order['metode']) ?><br>
        <strong>Tanggal Pesanan:</strong> <?= htmlspecialchars($order['tanggal']) ?><br>
        <strong>Estimasi Pengiriman:</strong> 2–4 hari kerja
    </div>

    <div class="section">
        <h3>Rincian Pesanan:</h3>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; while ($item = mysqli_fetch_assoc($order_items)): 
                    $subtotal = $item['harga'] * $item['qty'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama']) ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="button-group">
        <a href="index.php">Kembali ke Beranda</a>
        <button onclick="window.print()">🧾 Cetak Struk</button>
    </div>
</div>

</body>
</html>
