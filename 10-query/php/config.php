<?php

$server = "sql208.epizy.com";
$user = "epiz_30593970";
$password = "gw8dkDzn0Wpe";
$nama_database = "epiz_30593970_pendaftaran_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>