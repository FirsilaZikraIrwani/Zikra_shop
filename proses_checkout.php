<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$alamat = $_POST['alamat'] ?? '';
$metode = $_POST['metode'] ?? '';
if (empty($alamat) || empty($metode)) {
    echo "<script>alert('Alamat dan metode pembayaran harus diisi!'); window.history.back();</script>";
    exit;
}

$username = $_SESSION['username'];
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<script>alert('Keranjang kosong!'); window.location='index.php';</script>";
    exit;
}

$query_user = mysqli_query($koneksi, "SELECT id FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($query_user);
$user_id = $user['id'] ?? null;

if (!$user_id) {
    echo "<script>alert('Data pengguna tidak ditemukan.'); window.location='login.php';</script>";
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
            'id_produk' => $id_produk,
            'qty' => $qty,
            'harga' => $row['harga'],
            'subtotal' => $subtotal
        ];
    }
}

$tanggal = date('Y-m-d H:i:s');
mysqli_query($koneksi, "INSERT INTO orders (user_id, tanggal, total, alamat, metode) VALUES ('$user_id', '$tanggal', '$total', '$alamat', '$metode')");
$order_id = mysqli_insert_id($koneksi);

foreach ($items as $item) {
    $id = $item['id_produk'];
    $qty = $item['qty'];

    // Validasi stok terlebih dahulu
    $cek_stok = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id = $id");
    $data_stok = mysqli_fetch_assoc($cek_stok);

    if ($qty > $data_stok['stok']) {
        echo "<script>alert('Stok produk tidak mencukupi.'); window.location='cart.php';</script>";
        exit;
    }

    // Simpan detail dan kurangi stok
    mysqli_query($koneksi, "INSERT INTO order_details (order_id, produk_id, qty, harga) 
                            VALUES ('$order_id', '$id', '$qty', '{$item['harga']}')");

    mysqli_query($koneksi, "UPDATE produk SET stok = stok - $qty WHERE id = $id");
}

unset($_SESSION['cart']);

header("Location: struk.php?order_id=$order_id");
exit;
?>
