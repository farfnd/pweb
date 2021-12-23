<?php 
 
session_start();
 
if (!isset($_SESSION['user']['nama'])) {
    header("Location: /login.php");
} else if ($_SESSION['user']['role'] == 'siswa') {
    header("Location: /siswa");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin</title>
  </head>
<body>
    <?php echo "<h1>Selamat Datang, " . $_SESSION['user']['nama'] ."!". "</h1>"; ?> 
    <ul>
        <li><a href="daftar_guru.php">Daftar Guru</a></li>
    </ul>
    <a href="/logout.php" class="btn btn-primary">Logout</a>
</body>
</html>