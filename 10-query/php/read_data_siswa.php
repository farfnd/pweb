<?php

include("config.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = str_replace("'", "\'", $_GET['id']);
    $sql = "SELECT * FROM calon_siswa WHERE id = $id";
    $query = mysqli_query($db, $sql);

    while ($siswa = mysqli_fetch_array($query)) {
        echo json_encode([
            "id" => $siswa["id"],
            "nama" => $siswa["nama"],
            "jenis_kelamin" => $siswa["jenis_kelamin"],
            "agama" => $siswa["agama"],
            "sekolah_asal" => $siswa["sekolah_asal"],
            "alamat" => $siswa["alamat"],
            "foto" => $siswa["foto"],
        ]);
        echo "\n";
        break;
    }
}else{
    die("Method not allowed");
}