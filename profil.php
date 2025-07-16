<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Saya - Cika Shop</title>
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
            text-align: center;
        }

        main h2 {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #7f5a38;
            text-shadow: 0 1px 1px #d9cbb2;
        }

        main p {
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .icon-user {
            font-size: 80px;
            color: #a97456;
            margin-bottom: 20px;
        }

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
                font-size: 1rem;
                margin-bottom: 16px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        Profil Saya
        <nav>
            <a href="index.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="profil.php">Profil</a>
        </nav>
    </header>

    <main>
        <div class="icon-user"><i class="fas fa-user-circle"></i></div>
        <h2>Halo, <?= htmlspecialchars($username) ?>!</h2>
        <p>Selamat datang di profil Anda di Cika Shop.</p>
        <p>Halaman ini menampilkan informasi akun Anda. Jangan ragu untuk menjelajahi fitur lainnya di Cika Shop.</p>
    </main>
</body>
</html>
