<?php 
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}
include '../koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $harga = mysqli_real_escape_string($koneksi, trim($_POST['harga']));
    $stok = mysqli_real_escape_string($koneksi, trim($_POST['stok']));
    $deskripsi = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));

    if (empty($nama) || empty($harga) || empty($stok)) {
        $error = "Nama, harga, dan stok produk wajib diisi.";
    } elseif (!is_numeric($harga) || $harga <= 0 || !is_numeric($stok) || $stok < 0) {
        $error = "Harga harus angka positif dan stok minimal 0.";
    } elseif (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        $error = "Gambar produk wajib diupload.";
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['gambar']['type'];
        if (!in_array($file_type, $allowed_types)) {
            $error = "Tipe file gambar harus JPG, PNG, atau GIF.";
        } else {
            $tmpName = $_FILES['gambar']['tmp_name'];
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $newFileName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext; 
            $targetDir = '../image/';
            $targetFile = $targetDir . $newFileName;

            if (!move_uploaded_file($tmpName, $targetFile)) {
                $error = "Gagal mengupload gambar.";
            }
        }
    }

    if ($error === '') {
        $query = "INSERT INTO produk (nama, harga, stok, deskripsi, gambar) 
                  VALUES ('$nama', $harga, $stok, '$deskripsi', '$newFileName')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Produk berhasil ditambahkan.'); window.location='dashboard.php';</script>";
            exit;
        } else {
            $error = "Gagal menambahkan produk: " . mysqli_error($koneksi);
            if (file_exists($targetFile)) {
                unlink($targetFile);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambah Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    body {
        background-color: #fff7f0; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 3rem 2rem;
        color: #5a3e36; 
    }
    .container {
        max-width: 600px;
        margin: auto;
    }
    h2 {
        text-align: center;
        margin-bottom: 2rem;
        text-transform: uppercase;
        color: #7a5c48; 
        font-weight: 700;
        user-select: none;
    }
    form {
        background-color: #f3e6dc; 
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(122, 92, 72, 0.3); 
    }
    label {
        font-weight: 600;
        color: #7a5c48;
    }
    .btn-submit {
        background-color: #d7bcae; 
        color: #5a3e36;
        border: none;
        padding: 0.5rem 1.6rem;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(215, 188, 174, 0.5);
        transition: background-color 0.3s ease;
        user-select: none;
    }
    .btn-submit:hover {
        background-color: #c9a98e; 
        color: #422b22;
    }
    .btn-cancel {
        margin-left: 1rem;
        background-color: #a1897a; 
        color: white;
        border: none;
        padding: 0.5rem 1.6rem;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 3px 6px rgba(161, 137, 122, 0.5);
        transition: background-color 0.3s ease;
        user-select: none;
        text-decoration: none;
        display: inline-block;
    }
    .btn-cancel:hover {
        background-color: #8c7968; 
        color: white;
    }
    .error-msg {
        margin-bottom: 1rem;
        padding: 0.75rem 1rem;
        background-color: #f6d1cc; 
        color: #842029;
        border-radius: 6px;
        border: 1px solid #f5c2c7;
        user-select: none;
    }
    input.form-control, textarea.form-control {
        border: 1px solid #d7bcae;
        background-color: #fffaf5;
        color: #5a3e36;
        transition: border-color 0.3s ease;
    }
    input.form-control:focus, textarea.form-control:focus {
        border-color: #c9a98e;
        box-shadow: 0 0 5px rgba(201, 169, 142, 0.6);
        outline: none;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Tambah Produk</h2>

    <?php if (!empty($error)): ?>
    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Produk (angka)</label>
            <input type="number" class="form-control" id="harga" name="harga" required min="1" value="<?= isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Produk</label>
            <input type="number" class="form-control" id="stok" name="stok" required min="0" value="<?= isset($_POST['stok']) ? htmlspecialchars($_POST['stok']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar Produk</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
        <a href="produk.php" class="btn-cancel">Batal</a>
    </form>
</div>
</body>
</html>
