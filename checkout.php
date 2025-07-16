<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu untuk melakukan checkout.'); window.location='login.php';</script>";
    exit;
}

$username = $_SESSION['username'];
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "<script>alert('Keranjang kosong!'); window.location='index.php';</script>";
    exit;
}

$total = 0;
$items = [];
foreach ($cart as $id_produk => $qty) {
    $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id_produk");
    if ($row = mysqli_fetch_assoc($result)) {
        $subtotal = $row['harga'] * $qty;
        $total += $subtotal;
        $items[] = [
            'id' => $id_produk,
            'nama' => $row['nama'],
            'harga' => $row['harga'],
            'qty' => $qty,
            'subtotal' => $subtotal
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fef9f4;
            color: #5c4a3d;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff8ef;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #7f5a38;
            margin-bottom: 25px;
        }

        .welcome {
            text-align: right;
            font-size: 14px;
            color: #8c7768;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th, td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #e3d2c4;
        }

        th {
            background-color: #d9cbb2;
            color: #5c4a3d;
        }

        tr:last-child td {
            font-weight: bold;
            color: #7f5a38;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 16px;
            color: #5c4a3d;
        }

        input[type="text"], select {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ccb7a3;
            background-color: #fdf7f2;
            box-sizing: border-box;
            color: #5c4a3d;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            background-color: #a97456;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #7f5a38;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            table th, table td {
                font-size: 13px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="welcome">Halo, <strong><?= htmlspecialchars($username) ?></strong></div>
    <h2>Checkout</h2>

    <form method="POST" action="proses_checkout.php">
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
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nama']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <label for="alamat">Alamat Pengiriman</label>
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap kamu..." required>

        <label for="metode">Metode Pembayaran</label>
        <select id="metode" name="metode" required>
            <option value="">-- Pilih Metode Pembayaran --</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="COD">Bayar di Tempat (COD)</option>
            <option value="ShopeePay">ShopeePay</option>
            <option value="DANA">DANA</option>
            <option value="OVO">OVO</option>
        </select>

        <button type="submit">Buat Pesanan</button>
    </form>
</div>

</body>
</html>
