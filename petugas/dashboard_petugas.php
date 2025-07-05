<?php
session_start();
require_once '../inc_koneksi.php';

if (!isset($_SESSION['id_petugas'])) {
    header("Location: login_petugas.php");
    exit;
}

$id_petugas = $_SESSION['id_petugas'];
$nama_petugas = $_SESSION['nama_petugas'];
$tanggal = date('Y-m-d');

// Proses "Layani"
if (isset($_GET['layani'])) {
    $id_antrean = $_GET['layani'];
    $waktu = date('Y-m-d H:i:s');

    // Ubah status antrean
    mysqli_query($koneksi, "UPDATE antrean SET status_antrean = 'dilayani' WHERE id_antrean = '$id_antrean'");

    // Catat ke riwayat layanan
    mysqli_query($koneksi, "INSERT INTO riwayat_layanan (id_antrean, id_petugas, waktu_dilayani) VALUES ('$id_antrean', '$id_petugas', '$waktu')");

    header("Location: dashboard_petugas.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Petugas</title>
</head>
<body>
    <h2>Selamat Datang, <?= $nama_petugas; ?></h2>
    <h3>Daftar Antrean Hari Ini</h3>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nomor Antrean</th>
            <th>Pasien</th>
            <th>Layanan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "
            SELECT a.id_antrean, a.nomor_antrean, a.status_antrean, 
                   p.nama AS nama_pasien, l.nama_layanan 
            FROM antrean a
            JOIN pasien p ON a.id_pasien = p.id_pasien
            JOIN layanan l ON a.id_layanan = l.id_layanan
            WHERE a.tanggal = '$tanggal' AND a.status_antrean = 'menunggu'
            ORDER BY a.nomor_antrean ASC
        ");

        while ($data = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nomor_antrean']; ?></td>
                <td><?= $data['nama_pasien']; ?></td>
                <td><?= $data['nama_layanan']; ?></td>
                <td><?= $data['status_antrean']; ?></td>
                <td>
                    <a href="?layani=<?= $data['id_antrean']; ?>" 
                       onclick="return confirm('Yakin ingin melayani antrean ini?')">
                       Layani
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
