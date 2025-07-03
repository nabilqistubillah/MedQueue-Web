<?php
include 'inc_koneksi.php';

if (isset($_POST['submit'])) {
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
        mysqli_query($koneksi, "INSERT INTO pasien (nama, nomor_hp, email, tanggal_daftar) VALUES ('$nama', '$nomor_hp', '$email', CURDATE())");
        $id_pasien = mysqli_insert_id($koneksi); // ambil ID terakhir yang baru dimasukkan
    }

    // 3. Buat nomor antrean otomatis (misal: A001, A002, ...)
    $q_last = mysqli_query($koneksi, "SELECT nomor_antrean FROM antrean WHERE tanggal = CURDATE() ORDER BY id_antrean DESC LIMIT 1");
    if (mysqli_num_rows($q_last) > 0) {
        $last = mysqli_fetch_assoc($q_last);
        $angka = (int)substr($last['nomor_antrean'], 1) + 1;
    } else {
        $angka = 1;
    }
    $nomor_antrian = 'A' . str_pad($angka, 3, '0', STR_PAD_LEFT);

    // 4. Simpan ke tabel antrean
    mysqli_query($koneksi, "INSERT INTO antrean (id_pasien, id_layanan, nomor_antrian, tanggal, status_antrean) VALUES ('$id_pasien', '$id_layanan', '$nomor_antrian', CURDATE(), 'menunggu')");

    // 5. Redirect atau tampilkan pesan
    echo "<script>
        alert('Pendaftaran berhasil! Nomor Antrian Anda: $nomor_antrian'); window.location='antrean.php';
    </script>";
}
?>
