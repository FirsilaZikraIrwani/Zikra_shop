<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Produk - Cika Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #fef9f4;
            color: #5c4a3d;
            padding: 0 15px;
        }

        .main-header {
            background-color: #f2eadb;
            padding: 30px 20px 20px;
            text-align: center;
            border-bottom: 1px solid #d8cbb1;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            color: #a97456;
            font-family: 'Georgia', serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 1px 1px 2px #cbb991;
        }

        nav {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 25px;
            font-weight: 600;
            font-size: 16px;
        }

        nav a {
            color: #a97456;
            padding: 10px 16px;
            border-radius: 12px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a:hover {
            background-color: #7f5a38;
            color: #fff;
        }

        main {
            max-width: 1100px;
            margin: 40px auto 60px;
            background: #fff8ef;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(167, 116, 86, 0.15);
        }

        main h2 {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #7f5a38;
            text-align: center;
            text-shadow: 0 1px 1px #d9cbb2;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .product-card {
            background-color: #fffdf8;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 6px 14px rgba(167, 116, 86, 0.12);
            text-align: center;
            transition: 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(167, 116, 86, 0.2);
        }

        .img-wrapper {
            background: #fff;
            padding: 10px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 15px;
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-card h4 {
            font-size: 1rem;
            margin: 12px 0 6px;
            color: #5c4a3d;
            font-family: 'Georgia', serif;
            min-height: 48px;
        }

        .product-card .price {
            font-weight: bold;
            color: #a97456;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .button-row {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-beli, .btn-detail {
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-beli {
            background-color: #a97456;
            color: white;
            border: none;
        }

        .btn-beli:hover {
            background-color: #7f5a38;
        }

        .btn-detail {
            background-color: #ffffff;
            color: #5c4a3d;
            border: 2px solid #e0d5c5;
        }

        .btn-detail:hover {
            background-color: #f2eadb;
        }

        @media (max-width: 600px) {
            .main-header {
                font-size: 1.8rem;
                padding: 25px 15px 20px;
            }

            nav {
                flex-wrap: wrap;
                gap: 15px;
                font-size: 14px;
            }

            main {
                padding: 20px 15px;
            }

            .product-card img {
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        Daftar Produk
        <nav>
            <a href="index.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="profil.php">Profil</a>
        </nav>
    </header>

    <main>
        <h2>Semua Produk</h2>
        <div class="product-grid">
            <?php
            $query = "SELECT * FROM produk ORDER BY id DESC";
            $result = mysqli_query($koneksi, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product-card'>";
                    echo "<div class='img-wrapper'><img src='image/" . htmlspecialchars($row['gambar']) . "' alt='" . htmlspecialchars($row['nama']) . "'></div>";
                    echo "<h4>" . htmlspecialchars($row['nama']) . "</h4>";
                    echo "<div class='price'>Rp" . number_format($row['harga'], 0, ',', '.') . "</div>";
                    echo "<div class='button-row'>";
                    echo "<form action='cart.php' method='POST'>
                            <input type='hidden' name='id_produk' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit' class='btn-beli'><i class='fas fa-cart-plus'></i> Beli</button>
                          </form>";
                    echo "<a href='detail.php?id=" . htmlspecialchars($row['id']) . "' class='btn-detail'></i> Detail</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align:center;'>Belum ada produk yang tersedia.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
