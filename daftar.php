<?php
require_once 'inc_koneksi.php';

$query_layanan = mysqli_query($koneksi, "SELECT * FROM layanan");

if (isset($_POST['submit'])) {
    $nama         = $_POST['nama'];
    $nomor_hp     = $_POST['nomor_hp'];
    $email        = $_POST['email'];
    $id_layanan   = $_POST['id_layanan'];
    $tanggal      = date('Y-m-d');

    // Simpan data pasien
    $query_pasien = mysqli_query($koneksi, "INSERT INTO pasien (nama, nomor_hp, email, tanggal_daftar) VALUES ('$nama', '$nomor_hp', '$email', '$tanggal')");
    $id_pasien    = mysqli_insert_id($koneksi); // ambil ID pasien yang baru dimasukkan

    // Hitung nomor antrean hari ini
    $result_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM antrean WHERE tanggal = '$tanggal' AND id_layanan = '$id_layanan'");
    $data_count   = mysqli_fetch_assoc($result_count);
    $nomor_antrean = $data_count['total'] + 1;

    $query_antrean = mysqli_query($koneksi, "INSERT INTO antrean (id_pasien, id_layanan, nomor_antrean, tanggal, status_antrean) VALUES ('$id_pasien', '$id_layanan', '$nomor_antrean', '$tanggal', 'menunggu')");

    echo "<script>alert('Pendaftaran berhasil. Nomor antrean Anda: $nomor_antrean');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Antrean</title>
</head>
<body>
    <h2>Form Pendaftaran Antrean</h2>
    <form action="proses_daftar.php" method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="nomor_hp" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Pilih Layanan:</label><br>
        <select name="id_layanan" required>
            <option value="">-- Pilih --</option>
             <?php
                $layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
                while ($row = mysqli_fetch_assoc($layanan)) {
                    echo "<option value='{$row['id_layanan']}'>{$row['nama_layanan']}</option>";
                }
            ?>
        </select><br><br>

        <button type="submit" name="submit">Daftar</button>

    </form>
</body>
</html>