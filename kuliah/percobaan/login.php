<?php
require 'php/functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  //ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id ='$id'");
  $rows = mysqli_fetch_assoc($result);

  //cek cookie dan id
  if ($key === hash('sha256', $rows['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION['login'])) {
  if ($_SESSION['user'] = true) {
    header("Location: user/user.php");
  }
}

if (isset($_SESSION['login'])) {
  if ($_SESSION['admin'] = true) {
    header("Location: admin/admin.php");
  }
}

?>
<html>

<head>
  <title>Login Keira SoapFactory</title>
  <link rel="stylesheet" type="text/css" href="asset/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style3.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>

  <nav id="navbar-example2" class="navbar navbar-light bg-info px-3 fs-3">
    <a class="navbar-brand fs-2 text-center" href="#"><i class="bi bi-droplet-half"></i>AdnanRise</a>
    <ul class="nav nav-pills fs-2 text-center">
      <li class="nav-item">
        <a class="nav-link" href="index.php#scrollspyHeading1" style="color:black;">Beranda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registrasi.php" style="color:black;">Registrasi</a>
      </li>
    </ul>
  </nav>

  <?php

  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
      echo "<div class='alert'>Username dan Password Salah !</div>";
    }
  }
  ?>
  <div class="panel_login fs-2">
    <p class="tulisan_atas">Silahkan Masuk</p>

    <form action="php/checkrole.php" method="post">

      <div class="form-floating mb-5">
        <input type="text" class="form-control fs-3" id="floatingInput" placeholder="Username" name="username" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Username :</label>
      </div>

      <div class="form-floating mb-5">
        <input type="password" class="form-control fs-3" id="floatingInput" placeholder="Username" name="password" style="height: 50px" required autocomplete="off">
        <label for="floatingInput">Password :</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">
          Login selama 30 hari
        </label>
      </div> <br>

      <input type="submit" class="tombol_login" name="login" value="LOGIN" style="color:black; background-color: #0DCAF0;">
      <br />
      <br />
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>