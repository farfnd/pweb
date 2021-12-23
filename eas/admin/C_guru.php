<?php

include("../config.php");

if (!file_exists('images')) {
    mkdir('images', 0777, true);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = str_replace("'", "\'", $_POST['nama']);
    $tempat_lahir = str_replace("'", "\'", $_POST['tempat_lahir']);
    $tanggal_lahir = str_replace("'", "\'", $_POST['tanggal_lahir']);
    $id = str_replace("'", "\'", $_POST['id']);
    $kode_guru = str_replace("'", "\'", $_POST['kode_guru']);
    $jenis_kelamin = str_replace("'", "\'", $_POST['jenis_kelamin']);
    $agama = str_replace("'", "\'", $_POST['agama']);
    $kelas = str_replace("'", "\'", $_POST['kelas']);
    $mapel = str_replace("'", "\'", $_POST['mapel']);
    $alamat = str_replace("'", "\'", $_POST['alamat']);
    $foto = "";

    if(isset($_FILES['foto']['name'])){

        if($_FILES['foto']['size'] > 3*1048576) { //3 MB (size is also in bytes)
            die(json_encode([
                "error" => 500,
                "status" => "File is too large (> 3 MB)"
            ]));
            exit;
        }

        /* Getting file name */
        $filename = $_FILES['foto']['name'];
        
        /* Location */
        $location = "../images/".$filename;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        $imageNewFileName = md5(time()).'.'.$imageFileType;
        $location = "../images/".$imageNewFileName;

        /* Valid extensions */
        $valid_extensions = array("jpg","jpeg","png");
     
        $response = 0;
        /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
           /* Upload file */
           if(move_uploaded_file($_FILES['foto']['tmp_name'], $location)){
              $response = $location;
              $foto = $imageNewFileName;
           }
        }else{
            die(json_encode([
                "error" => 500,
                "status" => "Invalid file type"
            ]));
            exit;
        }     
    }

    $sql = "INSERT INTO users (id, nama, tempat_lahir, tanggal_lahir, kode_guru, jenis_kelamin, agama, kelas, mapel, alamat, foto, role)
            VALUE ($id, '$nama', '$tempat_lahir', '$tanggal_lahir', '$kode_guru', '$jenis_kelamin', '$agama', '$kelas', '$mapel', '$alamat', '$foto', 'guru')";
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