<?php
session_start();
include '../Database/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = $conn->prepare("SELECT * FROM admin WHERE nama = ?");
    $query->bind_param("s", $nama);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        //verfikasi tanpa tanpa password yang di hawsh
        if ($password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nama'] = $admin['nama'];
            header("Location: admin.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nama tidak ditemukan.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #1c3d5a;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login {
            width: 350px;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 2px 4px 15px rgba(0, 0, 0, 0.5);
        }
        .login h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label, input {
            display: block;
            width: 100%;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
        }
        button {
            padding: 10px;
            width: 100%;
            background-color: #1c3d5a;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login">
        <h2>Login Admin</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
