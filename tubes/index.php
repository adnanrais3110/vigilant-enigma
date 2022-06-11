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

$listsabun = query("SELECT * FROM data_sabun_muka");
?>
<!DOCTYPE html>
<html>

<head>
  <title>AdnanRise facial shop web</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.es5.min.js" integrity="sha512-ssPi1cTYTwYV0e6IRdIId4ytENOrTDvixXo8l0DaTBAwYw9yD6rk9HU06pWRCoSWSRKwrucdVS/2fMC1getgcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="asset/css/style3.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <style>
    .loading {
      width: 100px;
      position: absolute;
      top: 1px;
      left: 285px;
      z-index: -1;
      display: none;
    }

    .foto {
      width: auto;
      height: 50px;
    }

    .gallery {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      width: 90%;
      margin: 0 auto;
    }

    .gallery a {
      height: 200px;
      width: 300px;
      margin: 20px;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 3px 5px black;
    }

    .gallery a img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }

    .gallery a img:hover {
      transform: scale(0.9);
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    /*  */
    .social-link {
      width: 30px;
      height: 30px;
      border: 1px solid #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #666;
      border-radius: 50%;
      transition: all 0.3s;
      font-size: 0.9rem;
    }

    .social-link:hover,
    .social-link:focus {
      background: #ddd;
      text-decoration: none;
      color: #555;
    }

    .progress {
      height: 10px;
    }
  </style>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
  };

  ?>
  <nav id="navbar-example2" class="navbar navbar-light bg-info fixed-top px-3 fs-3">
    <a class="navbar-brand fs-2 text-center" href="#"><i class="bi bi-droplet-half"></i>AdnanRise</a>
    <ul class="nav nav-pills fs-2 text-center">
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading1" style="color:black; background-color: #0DCAF0;">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php" style="color:black;">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registrasi.php" style="color:black;">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tentangkami.php" style="color:black;" target="_blank">Tentang Kami</a>
      </li>
    </ul>
  </nav>
  <br><br>
  <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
    <div class="container-xl mt-5 fs-2">
      <h2 class="font-weight-bold mb-2">Daftar Sabun Kesehatan</h2>
      <p class="font-italic text-muted mb-4">Oleh AdnanRise personal group</p>
      <br><br>
      <div class="row">
        <div id="tabel-sabun">
          <!--  -->
          <div class="row pb-5 mb-4 mt-5">
            <?php $i = 1; ?>
            <?php foreach ($listsabun as $row) : ?>
              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Card-->
                <form action="" method="post">
                  <div class="card rounded shadow-sm border-0">
                    <span><input type="hidden" name="product_harga" value="<?= $row["harga_sabun_muka"]; ?>"><?= $row["harga_sabun_muka"]; ?></span>
                    <div class="card-body p-4"><input type="hidden" name="product_gambar" value="../asset/uploaded-img/<?= $row["gambar_sabun_muka"]; ?>"><img src="asset/uploaded-img/<?= $row["gambar_sabun_muka"]; ?>" class="img-fluid d-block mx-auto mb-3" width="auto" height="50px">
                      <h5 class="text-dark"><input type="hidden" name="product_nama" value="<?= $row["nama_sabun_muka"]; ?>"><?= $row["nama_sabun_muka"]; ?></h5>
                      <p class="text-muted font-italic border-bottom"><input type="hidden" name="product_kegunaan" value="<?= $row["kegunaan_sabun_muka"]; ?>"><?= $row["kegunaan_sabun_muka"]; ?></p>
                      <p class="small font-italic"><input type="hidden" name="product_bahan" value="<?= $row["bahan_sabun_muka"]; ?>"><?= $row["bahan_sabun_muka"]; ?></p>
                      <ul class="list-inline small">
                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i><a href="login.php" class="btn btn-sm text-black bg-info">Detail</a></li>
                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i>|</li>
                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i><a href="login.php" class="btn btn-sm text-black bg-info"><i class="bi bi-cart-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </form>
                <!-- akhir card -->
              </div>
              <?php $i++; ?>
            <?php endforeach;  ?>
          </div>
          <!--  -->
        </div>
      </div><br><br>


    </div>
    <footer class="mt-auto text-dark-50 text-center">
      <p>COPYRIGHT &copy; 2022 <a href="#" class=" text-dark">AdnanRise</a> ALL RIGHTS RESERVED.</p>
    </footer>
  </div><br><br>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.min.js" integrity="sha512-+cRLP8t0rsqPalRf//6kfVwRVPzxvwtgLOm8XoSw+M/ND6/0aODP3WFs8m4EPtqsJ9aurqbYq4q/0u8lRJSldA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
  lightGallery(document.getElementById('animated-thumbnails-gallery'), {
    thumbnail: true,
  });
</script>

</html>