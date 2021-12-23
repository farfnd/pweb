<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if($_SESSION['user']['role'] == 'admin'){
  var_dump($_SESSION);
  header("Location: admin");
} else if($_SESSION['user']['role'] == 'siswa'){
  header("Location: siswa");
}
 
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE id='$id' AND password='$password'";
    
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        if($row['role'] == 'admin'){
          header("Location: admin");
        } else if($row['role'] == 'siswa'){
          header("Location: siswa");
        }
    } else {
        $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ID atau Password salah!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
}
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body class="bg-primary">
    <div class="container mt-5">
      <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <?php if (!empty($error)) echo $error; ?>
            <div class="card px-5 py-5" id="form1">
              <form method="POST">
                <div class="mb-3">
                  <label for="id" class="form-label">ID</label>
                  <input type="text" name="id" class="form-control" id="id" value="<?php echo $id; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
      </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
