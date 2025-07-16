<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin/dashboard.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        .login-box {
            background: #fff8f0; 
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 8px 22px rgba(139, 111, 71, 0.3); 
            width: 360px;
            border: 1px solid #d7c4a3; 
            box-sizing: border-box;
        }
        .login-box h2 {
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
        .register-link {
            margin-top: 24px;
            text-align: center;
            font-size: 15px;
            color: #6b4e3d;
        }
        .register-link a {
            color: #8b6f47;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }
        .register-link a:hover {
            color: #6f5435;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>
