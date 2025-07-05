<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {
                background-color: #e0f7f4; /* soft teal */
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
        .container {
            max-width: 600px;
            height: 400px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #00796B;
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            font-size: 16px;
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
            text-align: center;
        }
         ul li {
            margin: 30px 0;
        }
        a {
            background-color:#4db6ac;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #005f52;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 60px;
            color: #c0392b;
            font-weight: bold;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?= $_SESSION['nama_admin']; ?> 👋</h2>
        <p>Ini adalah halaman dashboard admin <strong>MedQueue</strong>.</p>

        <ul>
            <li><a href="kelola_antrean.php">Kelola Antrean</a></li>
            <li><a href="kelola_petugas.php">Kelola Petugas</a></li>
            <li><a href="kelola_layanan.php">Kelola Layanan</a></li>
            <li><a href="../riwayat.php">Riwayat Antrian</a></li>
        </ul>

        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
