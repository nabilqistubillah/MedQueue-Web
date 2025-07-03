<?php
require_once 'inc_koneksi.php';

$status = "";

if (isset($_POST['cek'])) {
    $nomor_hp = $_POST['nomor_hp'];
    $tanggal  = date('Y-m-d');

    // Ambil data antrean hari ini berdasarkan nomor HP
    $query = mysqli_query($koneksi, "
        SELECT a.nomor_antrean, a.status_antrean, l.nama_layanan
        FROM antrean a
        JOIN pasien p ON a.id_pasien = p.id_pasien
        JOIN layanan l ON a.id_layanan = l.id_layanan
        WHERE p.nomor_hp = '$nomor_hp' AND a.tanggal = '$tanggal'
        ORDER BY a.id_antrean DESC
        LIMIT 1
    ");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $status = "Nomor Antrean: <strong>" . $data['nomor_antrean'] . "</strong><br>Layanan: " . $data['nama_layanan'] . "<br>Status: <strong>" . strtoupper($data['status_antrean']) . "</strong>";
    } else {
        $status = "Data antrean tidak ditemukan untuk hari ini.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cek Status Antrean</title>
</head>
<body>
    <h2>Cek Status Antrean</h2>
    <form method="POST">
        <label>Masukkan Nomor HP Anda:</label><br>
        <input type="text" name="nomor_hp" required>
        <button type="submit" name="cek">Cek</button>
    </form>
    <br>

    <?php if ($status !== ""): ?>
        <div style="border:1px solid #ccc; padding:10px;">
            <?= $status ?>
        </div>
    <?php endif; ?>
</body>
</html>
