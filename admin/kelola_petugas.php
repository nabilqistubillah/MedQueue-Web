<?php
session_start();
include '../inc_koneksi.php';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Proses tambah petugas
if (isset($_POST['tambah'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($koneksi, "INSERT INTO petugas (nama, username, password) 
                            VALUES ('$nama', '$username', '$password')");
    header("Location: kelola_petugas.php");
    exit;
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas = '$id'");
    header("Location: kelola_petugas.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Petugas</title>
    <style>
        body {
            background-color: #e0f7f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #00796B;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        input[type="text"], input[type="password"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #00796B;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005f52;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #b2dfdb;
            color: #004d40;
        }

        a {
            color: #c0392b;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .back a {
            color: #00796B;
            font-weight: bold;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kelola Petugas</h2>

        <form method="post">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="tambah">Tambah</button>
        </form>

        <table>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM petugas");
            while ($data = mysqli_fetch_assoc($query)) :
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['username']; ?></td>
                <td>
                    <a href="kelola_petugas.php?hapus=<?= $data['id_petugas']; ?>" onclick="return confirm('Hapus petugas ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="back">
            <a href="dashboard_admin.php">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
