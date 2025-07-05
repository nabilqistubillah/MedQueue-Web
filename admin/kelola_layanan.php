<?php
session_start();
include '../inc_koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Tambah layanan
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($koneksi, "INSERT INTO layanan (id_admin, nama_layanan, deskripsi) VALUES ('{$_SESSION['id_admin']}', '$nama', '$deskripsi')");
    header("Location: kelola_layanan.php");
    exit;
}

// Hapus layanan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM layanan WHERE id_layanan='$id'");
    header("Location: kelola_layanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Layanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7f6f2;
            padding: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #b2dfdb;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4db6ac;
            color: white;
        }
        .form-box {
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border: 1px solid #cfd8dc;
            width: 400px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 6px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4db6ac;
            color: white;
            border: none;
            padding: 8px 14px;
            cursor: pointer;
        }
        a {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h2>Kelola Layanan</h2>

    <div class="form-box">
        <form method="post">
            <label>Nama Layanan</label><br>
            <input type="text" name="nama" required><br>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="3" required></textarea><br>
            <input type="submit" name="tambah" value="Tambah Layanan">
        </form>
    </div>

    <table>
        <tr>
            <th>No.</th>
            <th>Nama Layanan</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY id_layanan ASC");
        while ($data = mysqli_fetch_assoc($query)) :
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama_layanan']; ?></td>
            <td><?= $data['deskripsi']; ?></td>
            <td>
                <a href="?hapus=<?= $data['id_layanan']; ?>" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br><br>
    <a href="dashboard_admin.php">⬅ Kembali ke Dashboard</a>

</body>
</html>
