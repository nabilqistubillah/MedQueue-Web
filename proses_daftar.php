<?php
include 'inc_koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama       = $_POST['nama'];
    $nomor_hp   = $_POST['nomor_hp'];
    $email      = $_POST['email'];
    $id_layanan = $_POST['id_layanan'];

    // 1. Cek apakah pasien sudah pernah daftar
    $cek = mysqli_query($koneksi, "SELECT id_pasien FROM pasien WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_assoc($cek);
        $id_pasien = $data['id_pasien'];
    } else {
        // 2. Simpan ke tabel pasien
        $insert_pasien = mysqli_query($koneksi, "INSERT INTO pasien (nama, nomor_hp, email, tanggal_daftar) VALUES ('$nama', '$nomor_hp', '$email', CURDATE())");

        if (!$insert_pasien) {
            echo "Gagal insert ke tabel pasien: " . mysqli_error($koneksi);
            exit;
        }

        $id_pasien = mysqli_insert_id($koneksi);
    }

    // 3. Buat nomor antrean otomatis
    $q_last = mysqli_query($koneksi, "SELECT nomor_antrean FROM antrean WHERE tanggal = CURDATE() ORDER BY id_antrean DESC LIMIT 1");
    if (mysqli_num_rows($q_last) > 0) {
        $last = mysqli_fetch_assoc($q_last);
        $angka = (int)substr($last['nomor_antrean'], 1) + 1;
    } else {
        $angka = 1;
    }

    $nomor_antrean = 'A' . str_pad($angka, 3, '0', STR_PAD_LEFT);

    // 4. Simpan ke tabel antrean
    $insert_antrean = mysqli_query($koneksi, "INSERT INTO antrean (id_pasien, id_layanan, nomor_antrean, tanggal, status_antrean) VALUES ('$id_pasien', '$id_layanan', '$nomor_antrean', CURDATE(), 'menunggu')");

    if (!$insert_antrean) {
        echo "Gagal daftar antrean: " . mysqli_error($koneksi);
        exit;
    }

    // 5. Redirect ke halaman antrean
    echo "<script>
        alert('Pendaftaran berhasil! Nomor Antrean Anda: $nomor_antrean');
        window.location.href = 'antrean.php';
    </script>";
}
?>
