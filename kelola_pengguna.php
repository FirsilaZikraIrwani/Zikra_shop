<?php
session_start();
include '../koneksi.php';

// Cek akses admin
if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    echo "<script>alert('Akses ditolak. Halaman hanya untuk admin.'); window.location='../login.php';</script>";
    exit;
}

// Ambil data user
$query = "SELECT id, username, role FROM users";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdf6e3;
            color: #5a4329;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 3rem 2rem;
        }

        .container {
            max-width: 960px;
            margin: auto;
            background-color: #fff5e6;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(107, 82, 57, 0.1);
            padding: 2.5rem 3rem;
        }

        h2 {
            font-weight: 700;
            letter-spacing: 1.2px;
            margin-bottom: 1rem;
            text-align: center;
            color: #6e5841;
            text-transform: uppercase;
            user-select: none;
            text-shadow: 0 1px 0 #c9ad87;
        }

        .btn-back {
            background-color: #a97f61;
            color: #fff;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            text-decoration: none;
            margin: 1rem 0 2rem;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(169, 127, 97, 0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-back:hover {
            background-color: #8f674e;
            box-shadow: 0 6px 16px rgba(143, 103, 78, 0.5);
            color: #fff;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(107, 82, 57, 0.12);
            font-size: 1rem;
            background-color: #fff5e6;
        }

        thead tr {
            background-color: #d6bfa6;
            color: #3f2f1f;
            font-weight: 700;
            font-size: 1.05rem;
        }

        thead th, tbody td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #e3d7c3;
        }

        tbody tr:hover {
            background-color: #f7ede2;
        }

        @media (max-width: 600px) {
            .container {
                padding: 1.5rem 1.5rem;
            }

            table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Pengguna</h2>
    
    <!-- Tombol kembali diletakkan di bawah judul, sebelum tabel -->
    <a href="dashboard.php" class="btn-back">&#8592; Kembali ke Dashboard</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($user = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($user['username']); ?></td>
                <td><?= htmlspecialchars($user['role']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
