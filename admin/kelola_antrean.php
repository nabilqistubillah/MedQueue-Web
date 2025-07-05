<?php
include '../inc_koneksi.php';

// Tangani aksi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_antrean = $_POST['id_antrean'];
    $aksi = $_POST['aksi'];

    if ($aksi == "layani") {
        mysqli_query($koneksi, "UPDATE antrean SET status_antrean='dilayani' WHERE id_antrean='$id_antrean'");
    } elseif ($aksi == "batal") {
        mysqli_query($koneksi, "UPDATE antrean SET status_antrean='batal' WHERE id_antrean='$id_antrean'");
    }
}

// Ambil daftar antrean yang menunggu
$query = mysqli_query($koneksi, "
    SELECT a.id_antrean, a.nomor_antrean, p.nama, l.nama_layanan, a.status_antrean
    FROM antrean a
    JOIN pasien p ON a.id_pasien = p.id_pasien
    JOIN layanan l ON a.id_layanan = l.id_layanan
    WHERE a.status_antrean = 'menunggu'
    ORDER BY a.tanggal ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Antrean</title>
    <style>
        table { width: 90%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: center; }
        button { padding: 5px 10px; margin: 2px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Manajemen Antrean oleh Petugas</h2>

     <a href="../antrean.php"><button>antrean</button></a>
     <a href="dashboard_admin.php"><button>< Dashboard admin</button></a>
    <table>
        <tr>
            <th>No.</th>
            <th>Nomor Antrean</th>
            <th>Nama Pasien</th>
            <th>Layanan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nomor_antrean'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_layanan'] ?></td>
            <td><?= $row['status_antrean'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_antrean" value="<?= $row['id_antrean'] ?>">
                    <button type="submit" name="aksi" value="layani">Layani</button>
                    <button type="submit" name="aksi" value="batal" onclick="return confirm('Yakin ingin membatalkan antrean?')">Batal</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
