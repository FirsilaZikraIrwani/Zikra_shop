<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tentang Kami - Cika Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #fef9f4; 
            color: #5c4a3d;
            line-height: 1.5;
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
            max-width: 900px;
            margin: 40px auto 60px;
            background: #fff8ef;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(167, 116, 86, 0.15);
            font-size: 1rem;
            color: #5c4a3d;
        }

        main h2 {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #7f5a38;
            text-align: center;
            text-shadow: 0 1px 1px #d9cbb2;
        }

        main p {
            margin-bottom: 20px;
            text-align: justify;
        }

        main p.highlight {
            font-style: italic;
            font-weight: 600;
            color: #a97456;
            text-align: center;
            font-size: 1.1rem;
            margin-top: 40px;
        }

        /* Responsive */
        @media (max-width: 700px) {
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
                margin: 30px auto 40px;
            }

            main h2 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            main p {
                font-size: 0.95rem;
                margin-bottom: 16px;
            }

            main p.highlight {
                font-size: 1rem;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        Tentang Kami
        <nav>
            <a href="index.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="profil.php">Profil</a>
        </nav>
    </header>

    <main>
        <h2>Selamat datang di Cika Shop!</h2>
        <p>
            Kami adalah toko online yang menyediakan berbagai pilihan pakaian pria dan wanita dengan gaya terkini dan harga terjangkau. 
            Fokus kami adalah memberikan pengalaman belanja yang mudah, aman, dan menyenangkan kepada setiap pelanggan.
        </p>
        <p>
            Dengan koleksi yang selalu diperbarui, kualitas produk yang terjamin, dan pelayanan pelanggan yang responsif, kami siap menjadi tujuan belanja favorit Anda.
        </p>
        <p>
            Terima kasih telah mempercayai kami. Selamat berbelanja!
        </p>

        <p class="highlight">"Cika Shop — Gaya terkini, kualitas terbaik, harga bersahabat."</p>
    </main>
</body>
</html>
