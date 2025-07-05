<?php
include 'inc_koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT a.nomor_antrean, p.nama, l.nama_layanan, a.status_antrean
    FROM antrean a
    JOIN pasien p ON a.id_pasien = p.id_pasien
    JOIN layanan l ON a.id_layanan = l.id_layanan
    ORDER BY a.tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Antrean</title>
</head>
<body>
    <h2>Daftar Antrean</h2>
    <a href="kelola_antrean.php"><button>Kelola Antrean</button></a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nomor Antrean</th>
            <th>Nama Pasien</th>
            <th>Layanan</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $row['nomor_antrean'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_layanan'] ?></td>
            <td><?= $row['status_antrean'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="daftar.php"><button>< Daftar</button></a>

</body>
</html>
