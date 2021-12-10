<?php

include("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = str_replace("'", "\'", $_POST['nama']);
    $jenis_kelamin = str_replace("'", "\'", $_POST['jenis_kelamin']);
    $agama = str_replace("'", "\'", $_POST['agama']);
    $sekolah_asal = str_replace("'", "\'", $_POST['sekolah_asal']);
    $alamat = str_replace("'", "\'", $_POST['alamat']);

    $sql = "INSERT INTO calon_siswa (nama, jenis_kelamin, agama, sekolah_asal, alamat)
            VALUE ('$nama', '$jenis_kelamin', '$agama', '$sekolah_asal', '$alamat')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        die(json_encode([
            "error" => 0,
            "status" => "OK"
        ]));
    } else {
        die(json_encode([
            "error" => 500,
            "status" => "Internal Server Error"
        ]));
    }
}else{
    die("Method not allowed");
}