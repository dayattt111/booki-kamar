<?php
session_start();

// Data pengguna disimpan dalam array

//ada 3 key : username, password, role
$users = [
    ["username" => "user", "password" => "user123", "role" => "user"],
    ["username" => "cai", "password" => "sudirman", "role" => "user"],
];

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include "data.php";

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['role'] = $user['role'];
            if ($user['role'] === 'user') {
                session_start();
                $_SESSION['kamar']=$kamar;
                header("Location: user.php");
                exit;
            }
        }
    }
    $error = "Username atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
