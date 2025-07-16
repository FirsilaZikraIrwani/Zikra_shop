<?php
include 'koneksi.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    echo "Produk tidak tersedia.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= htmlspecialchars($produk['nama']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fef9f4;
            color: #5c4a3d;
            margin: 0;
            padding: 20px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #a97456;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            background-color: #f2eadb;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .back-link:hover {
            background-color: #7f5a38;
            color: #fff;
        }

        .product-container {
            max-width: 1000px;
            margin: auto;
            background: #fff8ef;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(167, 116, 86, 0.15);
        }

        .product-image img {
            width: 100%;
            max-width: 300px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .product-details {
            flex: 1;
            min-width: 300px;
        }

        .product-details h2 {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            color: #7f5a38;
            margin-top: 0;
            text-shadow: 0 1px 1px #d9cbb2;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #a97456;
            margin: 15px 0;
        }

        .product-details p {
            line-height: 1.4;
            font-size: 1rem;
            color: #5c4a3d;
            white-space: pre-line;
        }

        .button-group {
            margin-top: 25px;
        }

        .btn {
            padding: 10px 18px;
            background: #a97456;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #7f5a38;
        }

        @media (max-width: 700px) {
            .product-container {
                flex-direction: column;
                padding: 20px;
            }

            .product-image img {
                max-width: 100%;
            }

            .product-details h2 {
                font-size: 1.6rem;
            }

            .price {
                font-size: 1.3rem;
            }

            .btn {
                padding: 10px 14px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<a href="index.php" class="back-link">← Kembali ke Beranda</a>

<div class="product-container">
    <div class="product-image">
        <img src="image/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama']) ?>">
    </div>
    <div class="product-details">
        <h2><?= htmlspecialchars($produk['nama']) ?></h2>
        <div class="price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
        <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>

        <div class="button-group">
            <form method="POST" action="cart.php" style="display:inline;">
                <input type="hidden" name="id_produk" value="<?= $produk['id'] ?>">
                <button class="btn" type="submit">🛒 Tambah ke Keranjang</button>
            </form>
            <form method="POST" action="cart.php" style="display:inline;">
                <input type="hidden" name="id_produk" value="<?= $produk['id'] ?>">
                <button class="btn" type="submit">💳 Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
