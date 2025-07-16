<?php
session_start();
include '../koneksi.php';

// Cek apakah ada parameter ID
if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit;
}

$id_order = $_GET['id'];

// Ambil data pesanan
$orderQuery = "SELECT o.id, o.tanggal, o.total, o.alamat, o.metode, u.username 
               FROM orders o
               JOIN users u ON o.user_id = u.id
               WHERE o.id = $id_order";
$orderResult = mysqli_query($koneksi, $orderQuery);
$order = mysqli_fetch_assoc($orderResult);

// Ambil detail produk dari pesanan
$detailQuery = "SELECT od.qty, od.harga, p.nama 
                FROM order_details od 
                JOIN produk p ON od.produk_id = p.id 
                WHERE od.order_id = $id_order";
$detailResult = mysqli_query($koneksi, $detailQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pesanan</title>
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

        h2, h3 {
            color: #6e5841;
            font-weight: 700;
            text-transform: uppercase;
            text-shadow: 0 1px 0 #c9ad87;
            margin-bottom: 1.5rem;
        }

        p {
            margin: 6px 0;
            font-size: 1rem;
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
            margin-top: 1rem;
        }

        thead tr {
            background-color: #d6bfa6;
            color: #3f2f1f;
            font-weight: 700;
            font-size: 1.05rem;
        }

        thead th, tbody td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #e3d7c3;
        }

        tbody tr:hover {
            background-color: #f7ede2;
        }

        .btn-back {
            background-color: #a97f61;
            color: #fff;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 2rem;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(169, 127, 97, 0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-back:hover {
            background-color: #8f674e;
            box-shadow: 0 6px 16px rgba(143, 103, 78, 0.5);
            color: #fff;
            text-decoration: none;
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
    <h2>Detail Pesanan #<?= $order['id']; ?></h2>
    <p><strong>Nama User:</strong> <?= htmlspecialchars($order['username']); ?></p>
    <p><strong>Tanggal:</strong> <?= $order['tanggal']; ?></p>
    <p><strong>Alamat:</strong> <?= htmlspecialchars($order['alamat']); ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= $order['metode']; ?></p>
    <p><strong>Total:</strong> Rp <?= number_format($order['total'], 0, ',', '.'); ?></p>

    <h3>Produk Dipesan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($item = mysqli_fetch_assoc($detailResult)) : ?>
                <?php $subtotal = $item['qty'] * $item['harga']; ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($item['nama']); ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['qty']; ?></td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="kelola_pesanan.php" class="btn-back">&#8592; Kembali ke Daftar Pesanan</a>
</div>

</body>
</html>
