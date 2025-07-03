<?php
session_start(); 
require_once 'inc_koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['nama_petugas'] = $data['nama'];
        header("Location: dashboard_petugas.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Petugas</title>
</head>
<body>
    <h2>Login Petugas</h2>

    <?php if ($error !== ""): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

