<?php

include("config.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sql = "SELECT * FROM calon_siswa";
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
    }
}else{
    die("Method not allowed");
}

?>