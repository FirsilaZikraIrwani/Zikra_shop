<?php
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $error = "Password tidak cocok!";
    } else {
        $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_hash', 'user')";
            if (mysqli_query($koneksi, $query)) {
                $success = "Registrasi berhasil! Silakan login di bawah ini.";
            } else {
                $error = "Terjadi kesalahan, coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register & Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f9f5f0; 
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .box {
            background: #fff8f0; 
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 8px 22px rgba(139, 111, 71, 0.3); 
            width: 360px;
            border: 1px solid #d7c4a3; 
            box-sizing: border-box;
        }
        h2 {
            margin-bottom: 28px;
            color: #6b4e3d; 
            text-align: center;
            font-weight: 700;
            font-size: 28px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 20px;
            border: 1.5px solid #d7c4a3; 
            border-radius: 10px;
            font-size: 16px;
            background: #fffefb;
            color: #6b4e3d;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #8b6f47; 
            background: #fff;
        }
        button {
            padding: 14px;
            background: #8b6f47; 
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #6f5435; 
        }
        .error {
            background: #fbe9e7; 
            padding: 12px;
            color: #a43f3f;
            border-radius: 10px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 600;
        }
        .success {
            background: #dff0d8; 
            padding: 12px;
            color: #3c763d;
            border-radius: 10px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 600;
        }
        .login-link {
            margin-top: 24px;
            text-align: center;
            font-size: 15px;
            color: #6b4e3d;
        }
        .login-link a {
            color: #8b6f47;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }
        .login-link a:hover {
            color: #6f5435;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="box">
        <?php if ($success): ?>
            <h2>Login</h2>
            <div class="success"><?= htmlspecialchars($success) ?></div>
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <div class="login-link">
                <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
            </div>
        <?php else: ?>
            <h2>Register</h2>

            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Konfirmasi Password" required>
                <button type="submit">Daftar</button>
            </form>
            <div class="login-link">
                <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
