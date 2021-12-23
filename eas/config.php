<?php

$server = "localhost";
$user = "root";
$password = "farhan";
$nama_database = "eas";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

?>