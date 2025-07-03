<?php
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $dbname = "medqueue";


    $koneksi = mysqli_connect($host, $user, $pass, $dbname);
    if (!$koneksi) {
        die("Koneksi gagal");
    }else {
        echo "";
    }
?>