<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Toko Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fef9f4;
        color: #5c4a3d;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    a {
        text-decoration: none;
        color: #a97456;
        transition: color 0.3s ease;
    }
    a:hover {
        color: #7f5a38;
    }

    .top-bar {
        background-color: #f2eadb;
        padding: 10px 20px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        font-size: 14px;
        color: #7f5a38;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .top-bar-right > a,
    .top-bar-right > span {
        margin-left: 15px;
    }
    .top-bar-right a:hover {
        text-decoration: underline;
    }

    .admin-bar {
        background-color: #e9dccc;
        padding: 8px 0;
        text-align: center;
        font-weight: 600;
        color: #5c4a3d;
        box-shadow: inset 0 -1px 3px rgba(0,0,0,0.1);
    }
    .admin-bar a {
        color: #7f5a38;
        font-weight: 700;
    }
    .admin-bar a:hover {
        text-decoration: underline;
    }

    .main-header {
        background-color: #f2eadb;
        padding: 30px 20px 15px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border-radius: 0 0 20px 20px;
    }

    .main-header h1 {
        margin: 0;
        font-size: 3rem;
        font-weight: 900;
        color: #a97456;
        font-family: 'Georgia', serif;
        text-shadow: 1px 1px 2px #cbb991;
    }

    .main-header > .header-controls {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    input[type="text"] {
        padding: 10px 15px;
        border: 2px solid #a97456;
        border-radius: 30px;
        width: 260px;
        font-size: 16px;
        transition: border-color 0.3s ease;
        outline: none;
    }
    input[type="text"]:focus {
        border-color: #7f5a38;
        box-shadow: 0 0 8px #d9cbb2;
    }

    button[type="submit"] {
        padding: 10px 18px;
        border: none;
        border-radius: 30px;
        background-color: #a97456;
        color: #fff;
        font-weight: 700;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #7f5a38;
    }

    .btn-cart {
        position: relative;
        font-size: 24px;
        color: #a97456;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    .btn-cart:hover {
        color: #7f5a38;
    }

    #cart-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background: #e94f37;
        color: white;
        font-size: 13px;
        border-radius: 50%;
        padding: 3px 7px;
        font-weight: 700;
        user-select: none;
        display: none;
    }

    nav {
        margin-top: 25px;
        display: flex;
        justify-content: center;
        gap: 30px;
        font-weight: 600;
        font-size: 17px;
    }
    nav a {
        color: #a97456;
        padding: 8px 14px;
        border-radius: 12px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover {
        background-color: #7f5a38;
        color: #fff;
    }

    main {
        flex: 1; 
    }
    section.products {
        max-width: 1200px;
        margin: 40px auto 60px;
        padding: 0 20px;
    }
    section.products h2 {
        text-align: center;
        font-size: 2.2rem;
        margin-bottom: 30px;
        color: #7f5a38;
        text-shadow: 0 1px 1px #dcd1bb;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 28px;
    }
    .product-card {
        background-color: #f9f4ef;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.07);
        padding: 18px 14px 20px;
        text-align: center;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.14);
    }
    .product-card img {
        max-width: 100%;
        height: 240px;
        object-fit: contain;
        margin-bottom: 14px;
        border-radius: 10px;
        background: #fff;
        padding: 8px;
    }
    .product-card p {
        font-weight: 600;
        font-size: 1.15rem;
        color: #5c4a3d;
        margin-bottom: 8px;
    }
    .price {
        font-weight: 700;
        color: #a97456;
        margin-bottom: 14px;
        display: block;
        font-size: 1.05rem;
    }
    .product-card .actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .product-card .btn {
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 80px;
    }
    .btn-cart {
        background: transparent;
        font-size: 18px;
        color: #a97456;
        padding: 6px 12px;
        border-radius: 8px;
    }
    .btn-cart:hover {
        color: #7f5a38;
    }
    .btn-beli {
        background-color: #a97456;
        color: #fff;
    }
    .btn-beli:hover {
        background-color: #7f5a38;
    }
    .btn-detail {
        background-color: #fff;
        color: #a97456;
        border: 1.8px solid #a97456;
    }
    .btn-detail:hover {
        background-color: #f5f0e8;
    }

    footer {
        background-color: #222;
        color: #ddd;
        padding: 40px 20px;
        font-size: 14px;
        line-height: 1.6;
    }
    .footer-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }
    .footer-newsletter {
        flex: 1 1 300px;
        min-width: 280px;
    }
    .footer-newsletter h3 {
        color: #fff;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }
    .footer-newsletter p {
        margin-bottom: 16px;
        color: #ccc;
    }
    .footer-newsletter form {
        display: flex;
        gap: 8px;
    }
    .footer-newsletter input[type="email"] {
        flex: 1;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
    }
    .footer-newsletter button {
        padding: 8px 16px;
        background-color: #a97456;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .footer-newsletter button:hover {
        background-color: #7f5a38;
    }

    .footer-links {
        flex: 3 1 600px;
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }
    .footer-column {
        flex: 1 1 140px;
        min-width: 120px;
    }
    .footer-column h4 {
        color: #fff;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .footer-column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-column ul li {
        margin-bottom: 8px;
    }
    .footer-column ul li a {
        color: #ccc;
        font-size: 0.95rem;
    }
    .footer-column ul li a:hover {
        color: #fff;
        text-decoration: underline;
    }

    .footer-bottom {
        margin-top: 40px;
        border-top: 1px solid #444;
        padding-top: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .footer-bottom .copy {
        color: #aaa;
        font-size: 0.9rem;
    }
    .footer-bottom .social-icons,
    .footer-bottom .payment-icons {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .footer-bottom .social-icons a,
    .footer-bottom .payment-icons img {
        color: #ccc;
    }
    .footer-bottom select {
        background: #333;
        color: #ccc;
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
        margin-left: 8px;
    }
    .footer-bottom select option {
        background: #fff;
        color: #333;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
        }
        .footer-links {
            flex-direction: column;
        }
        .footer-column {
            margin-bottom: 20px;
        }
        .footer-bottom {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }
    }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-right">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <div class="admin-bar">
            <a href="admin/dashboard.php">🛠 Dashboard Admin</a>
        </div>
    <?php endif; ?>

    <div class="main-header">
        <h1>Cika Shop</h1>
        <div class="header-controls">
            <form method="GET" action="" style="display: flex; align-items: center; gap: 10px;">
                <input type="text" name="search" placeholder="Cari nama produk..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">Search</button>
            </form>
            <a href="cart.php" class="btn-cart" title="Keranjang Belanja" style="margin-left: 12px; position: relative;">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count">0</span>
            </a>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="profil.php">Profil</a>
        </nav>
    </div>

    <main>
        <section class="products">
            <h2>New Arrivals</h2>
            <div class="product-grid">
                <?php
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

if (!empty($search)) {
    $query = "SELECT * FROM produk WHERE nama LIKE '%$search%' ORDER BY id DESC LIMIT 8";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC LIMIT 8";
}

$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='product-card'>";
    echo "<img src='image/".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['nama'])."'>";
    echo "<p>".htmlspecialchars($row['nama'])."</p>";
    echo "<span class='price'>Rp" . number_format($row['harga'], 0, ',', '.') . "</span>";
    echo "<div class='actions'>";
    echo "<button type='button' class='btn btn-cart add-to-cart' data-id='".htmlspecialchars($row['id'])."' title='Tambah ke keranjang'>
            <i class='fas fa-shopping-cart'></i>
          </button>";
    echo "<form method='POST' action='cart.php' style='display:inline;'>
            <input type='hidden' name='id_produk' value='".htmlspecialchars($row['id'])."'>
            <button type='submit' class='btn btn-beli'>Beli</button>
          </form>";
    echo "<a href='detail.php?id=".htmlspecialchars($row['id'])."' class='btn btn-detail'>Detail</a>";
    echo "</div>";
    echo "</div>";
}
?>
            </div>
        </section>
    </main>

 <footer style="background-color: #f8f4f0; padding: 30px 20px; font-family: sans-serif; color: #5c4a3f;">
    <div class="footer-links" style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-bottom: 20px;">
        <div>
            <h4 style="margin-bottom: 10px;">Tentang Kami</h4>
            <ul style="list-style: none; padding: 0;">
                <li><a href="about.php" style="text-decoration: none; color: #5c4a3f;">About Us</a></li>
                <li><a href="#" style="text-decoration: none; color: #5c4a3f;">Kebijakan Privasi</a></li>
                <li><a href="#" style="text-decoration: none; color: #5c4a3f;">Syarat & Ketentuan</a></li>
            </ul>
        </div>
        <div>
            <h4 style="margin-bottom: 10px;">Bantuan</h4>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="text-decoration: none; color: #5c4a3f;">FAQ</a></li>
                <li><a href="#" style="text-decoration: none; color: #5c4a3f;">Pengembalian</a></li>
                <li><a href="contact.php" style="text-decoration: none; color: #5c4a3f;">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>

    <div style="text-align: center; font-size: 14px; border-top: 1px solid #ddd; padding-top: 15px;">
        © 2025 Cika Shop
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        function updateCartCount(count) {
            if (count > 0) {
                $('#cart-count').text(count).show();
            } else {
                $('#cart-count').hide();
            }
        }

        updateCartCount(<?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?>);

        $('.add-to-cart').click(function() {
            const id_produk = $(this).data('id');

            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: { id_produk: id_produk },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        updateCartCount(response.total_items);
                        alert('Produk berhasil ditambahkan ke keranjang!');
                    } else {
                        alert('Gagal menambahkan produk ke keranjang.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
                }
            });
        });
    });
    </script>
    <!-- Live Chat WhatsApp -->
<a href="https://wa.me/6283169155515?text=Halo%20admin%20Cika%20Shop%2C%20saya%20mau%20tanya..." class="whatsapp-float" target="_blank" title="Chat Admin">
    <i class="fab fa-whatsapp"></i> Chat Admin
</a>

<style>
.whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background-color: #25d366;
    color: white;
    font-size: 16px;
    font-weight: 600;
    padding: 12px 18px;
    border-radius: 40px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 9999;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-family: 'Segoe UI', sans-serif;
}
.whatsapp-float i {
    font-size: 20px;
}
.whatsapp-float:hover {
    background-color: #1ebe5d;
    transform: scale(1.05);
}
@media screen and (max-width: 768px) {
    .whatsapp-float {
        font-size: 14px;
        padding: 10px 14px;
    }
    .whatsapp-float i {
        font-size: 18px;
    }
}
</style>

</body>
</html>
