<?php
include 'inc_koneksi.php';

// Ambil data antrean yang statusnya bukan 'menunggu'
$query = mysqli_query($koneksi, "
    SELECT a.nomor_antrean, p.nama, l.nama_layanan, a.status_antrean, a.tanggal
    FROM antrean a
    JOIN pasien p ON a.id_pasien = p.id_pasien
    JOIN layanan l ON a.id_layanan = l.id_layanan
    WHERE a.status_antrean != 'menunggu'
    ORDER BY a.tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Antrean</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #4DB6AC;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .status-dilayani {
            color: green;
            font-weight: bold;
        }
        .status-batal {
            color: red;
            font-weight: bold;
        }
        .riwayat {
            display: block;
            text-align: center;
            margin-top: 60px;
            color: #c0392b;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Riwayat Antrean MedQueue</h2>

<table>
    <tr>
        <th>Nomor Antrean</th>
        <th>Nama Pasien</th>
        <th>Layanan</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
    <tr>
        <td><?= $row['nomor_antrean'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['nama_layanan'] ?></td>
        <td class="status-<?= strtolower($row['status_antrean']) ?>">
            <?= ucfirst($row['status_antrean']) ?>
        </td>
        <td><?= $row['tanggal'] ?></td>
    </tr>
    <?php endwhile; ?>
    
</table>
<a class="riwayat" href="admin/dashboard_admin.php">kembali</a>

</body>
</html>
