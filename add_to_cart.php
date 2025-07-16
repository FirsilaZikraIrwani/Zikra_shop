<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'] ?? null;
    if ($id_produk) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id_produk])) {
            $_SESSION['cart'][$id_produk]++;
        } else {
            $_SESSION['cart'][$id_produk] = 1;
        }

        $total_items = array_sum($_SESSION['cart']);

        echo json_encode([
            'success' => true,
            'total_items' => $total_items
        ]);
        exit;
    }
}

echo json_encode(['success' => false]);
