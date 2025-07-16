<?php
include '../koneksi.php';
session_start();

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    echo "Produk tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../image/$gambar");

        $query = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
    } else {
        $query = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok', deskripsi='$deskripsi' WHERE id=$id";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: produk.php");
        exit;
    } else {
        echo "Gagal update produk: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #fff7f0;
            margin: 0;
            padding: 40px 0;
            color: #5a3e36;
        }

        .edit-container {
            max-width: 600px;
            margin: auto;
            background-color: #f3e6dc;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(122, 92, 72, 0.15);
            padding: 32px;
        }

        h2 {
            text-align: center;
            color: #7a5c48;
            margin-bottom: 30px;
            font-weight: 700;
            user-select: none;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #7a5c48;
            user-select: none;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d7bcae;
            border-radius: 8px;
            background-color: #fffaf5;
            font-size: 14px;
            color: #5a3e36;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #c9a98e;
            outline: none;
            box-shadow: 0 0 5px rgba(201, 169, 142, 0.6);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .preview-img {
            margin-top: 12px;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid #d7bcae;
            box-shadow: 0 2px 6px rgba(122, 92, 72, 0.15);
            user-select: none;
        }

        .btn {
            display: inline-block;
            background-color: #d7bcae;
            color: #5a3e36;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .btn:hover {
            background-color: #c9a98e;
            color: #422b22;
        }

        @media (max-width: 640px) {
            .edit-container {
                padding: 20px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $produk['harga'] ?>" required>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $produk['stok'] ?>" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Gambar Produk (opsional)</label>
            <input type="file" name="gambar" accept="image/*">
            <img src="../image/<?= $produk['gambar'] ?>" alt="Gambar Produk" class="preview-img">
        </div>
        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
