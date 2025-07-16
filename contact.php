<?php
include 'koneksi.php';
$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));

    if (!empty($nama) && !empty($email) && !empty($pesan)) {
        $query = "INSERT INTO kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Pesan berhasil dikirim!";
        } else {
            $error = "Gagal menyimpan pesan.";
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kontak Kami - Cika Shop</title>
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

        .contact-form {
            max-width: 500px;
            margin: 40px auto 60px;
            background: #fff8ef;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(167, 116, 86, 0.15);
            color: #5c4a3d;
        }

        .contact-form h2 {
            margin-bottom: 30px;
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 2rem;
            color: #7f5a38;
            text-shadow: 0 1px 1px #d9cbb2;
        }

        .contact-form input, 
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #d3c5a9;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            color: #5c4a3d;
            background-color: #fffefb;
            transition: border-color 0.3s ease;
        }

        .contact-form input:focus, 
        .contact-form textarea:focus {
            border-color: #a97456;
            outline: none;
            background-color: #fff8ef;
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 120px;
        }

        .contact-form button {
            background-color: #7f5a38;
            color: #fff;
            border: none;
            padding: 14px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 700;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .contact-form button:hover {
            background-color: #a97456;
        }

        .contact-form .alert {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            font-size: 1rem;
        }

        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }

        @media (max-width: 700px) {
            .main-header {
                font-size: 2rem;
                padding: 25px 15px 20px;
            }

            nav {
                flex-wrap: wrap;
                gap: 15px;
                font-size: 14px;
            }

            .contact-form {
                padding: 25px 20px;
                margin: 30px auto 40px;
            }

            .contact-form h2 {
                font-size: 1.6rem;
                margin-bottom: 25px;
            }

            .contact-form input, 
            .contact-form textarea {
                font-size: 0.95rem;
                padding: 10px;
                margin-bottom: 14px;
            }

            .contact-form button {
                font-size: 1rem;
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        Kontak Kami
        <nav>
            <a href="index.php">Home</a>
            <a href="collection.php">Collection</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="profil.php">Profil</a>
        </nav>
    </header>

    <div class="contact-form">
        <h2>Hubungi Kami</h2>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="nama" placeholder="Nama Anda" required>
            <input type="email" name="email" placeholder="Email Anda" required>
            <textarea name="pesan" placeholder="Tulis pesan anda..." required></textarea>
            <button type="submit">Kirim Pesan</button>
        </form>
    </div>
</body>
</html>
