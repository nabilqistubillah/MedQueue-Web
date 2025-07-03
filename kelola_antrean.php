<?php
include 'inc_koneksi.php';

    if (isset($_GET['layani'])) {
        $id = $_GET['layani'];
        mysqli_query($koneksi, "UPDATE antrean SET status_antrean = 'dilayani' WHERE id_antrian = $id");
        header("Location: kelola_antrean.php");
    }

    if (isset($_GET['batal'])) {
        $id = $_GET['batal'];
        mysqli_query($koneksi, "UPDATE antrean SET status_antrean = 'batal' WHERE id_antrian = $id");
        header("Location: kelola_antrean.php");
    }

    $query = mysqli_query($koneksi, "
        SELECT a.id_antrian, a.nomor_antrean, p.nama, l.nama_layanan, a.status_antrean
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
</head>
<body>
    <h2>Kelola Antrean</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nomor Antrean</th>
            <th>Nama Pasien</th>
            <th>Layanan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $row['nomor_antrean'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_layanan'] ?></td>
            <td>
                <a href="kelola_antrean.php?layani=<?= $row['id_antrian'] ?>" onclick="return confirm('Yakin ingin melayani pasien ini?')">Layani</a> |
                <a href="kelola_antrean.php?batal=<?= $row['id_antrian'] ?>" onclick="return confirm('Yakin ingin membatalkan antrean ini?')">Batal</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
