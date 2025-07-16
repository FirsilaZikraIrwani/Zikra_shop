<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produk'], $_POST['action'])) {
    $id_produk = (int)$_POST['id_produk'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$id_produk])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$id_produk]++;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$id_produk]--;
            if ($_SESSION['cart'][$id_produk] <= 0) {
                unset($_SESSION['cart'][$id_produk]);
            }
        }
    }
    header("Location: cart.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produk']) && !isset($_POST['action'])) {
    $id_produk = (int)$_POST['id_produk'];

    $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id_produk");
    if (mysqli_num_rows($result) > 0) {
        if (isset($_SESSION['cart'][$id_produk])) {
            $_SESSION['cart'][$id_produk] += 1;
        } else {
            $_SESSION['cart'][$id_produk] = 1;
        }
    }
    header("Location: cart.php");
    exit;
}

if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: cart.php");
    exit;
}

$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <style>
        body {
            background-color: #fef9f4;
            color: #5c4a3d;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #7f5a38;
        }

        table {
            width: 90%;
            margin: 0 auto 40px;
            border-collapse: collapse;
            background-color: #fff8ef;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0d3c2;
            text-align: center;
        }

        th {
            background-color: #d9cbb2;
            color: #5c4a3d;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
            font-weight: bold;
            color: #7f5a38;
        }

        a {
            color: #a97456;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #7f5a38;
            text-decoration: underline;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 40px;
            color: #9d8b7d;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn-back, .btn-buy {
            width: 150px;
            padding: 12px 0;
            border-radius: 8px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-back {
            background-color: #a97456;
        }

        .btn-back:hover {
            background-color: #7f5a38;
        }

        .btn-buy {
            background-color: #c7b198;
            color: #5c4a3d;
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
        }

        .btn-buy:hover {
            background-color: #bfa68a;
        }

        button.qty-btn {
            padding: 5px 12px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            background-color: #e6d6c3;
            border: 1px solid #d0bda8;
            border-radius: 6px;
            margin: 0 4px;
            user-select: none;
            color: #5c4a3d;
        }

        button.qty-btn:hover {
            background-color: #d4c1ad;
        }

        @media(max-width: 600px) {
            table {
                width: 100%;
                font-size: 14px;
            }
            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
            .btn-back, .btn-buy {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>Keranjang Belanja</h2>

    <?php if (empty($cart)): ?>
        <p class="empty-cart">Keranjang kosong. <a href="index.php">Lanjut belanja</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sisa Stok</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $stok_aman = true;
                foreach ($cart as $id_produk => $qty):
                    $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id_produk");
                    if ($row = mysqli_fetch_assoc($result)) {
                        $subtotal = $row['harga'] * $qty;
                        $total += $subtotal;

                        if ($qty > $row['stok']) {
                            $stok_aman = false;
                        }
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td>Rp <?= number_format($row['harga'],0,",",".") ?></td>
                    <td>
                        <form method="POST" action="cart.php" style="display:inline;">
                            <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                            <button type="submit" name="action" value="decrease" class="qty-btn">-</button>
                            <?= $qty ?>
                            <button type="submit" name="action" value="increase" class="qty-btn">+</button>
                        </form>
                    </td>
                    <td><?= $row['stok'] ?></td>
                    <td>Rp <?= number_format($subtotal,0,",",".") ?></td>
                    <td>
                        <a href="cart.php?remove=<?= $id_produk ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    }
                endforeach;
                ?>
                <tr>
                    <td colspan="4" align="right">Total</td>
                    <td colspan="2">Rp <?= number_format($total,0,",",".") ?></td>
                </tr>
            </tbody>
        </table>

        <div class="btn-group">
            <a href="index.php" class="btn-back">Lanjut Belanja</a>
            <?php if ($stok_aman): ?>
                <a href="checkout.php" class="btn-buy">Beli Sekarang</a>
            <?php else: ?>
                <a href="#" class="btn-buy" onclick="alert('Terdapat produk dengan jumlah melebihi stok! Silakan periksa kembali.'); return false;" style="background-color: #ccc; cursor: not-allowed;">Stok Tidak Cukup</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>