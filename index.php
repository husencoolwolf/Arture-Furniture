<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
$db = new database;
$ctr = new controller;
$getPage = "";
$getHakAkses = "";

if (isset($_GET['page'])) {
  $getPage = $_GET['page'];
}
if (isset($_SESSION['id_hak_akses'])) {
  $getHakAkses = $_SESSION['id_hak_akses'];
}
$getPageStatus = "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Arture Furniture</title>
  <link rel="stylesheet" href="/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/dist/DataTables/datatables.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/dist/css/font-setting.css">
  <?php echo ($ctr->cssImporter($getPage, $getHakAkses)); ?>

  <script src="/dist/js/jquery-3.5.1.js"></script>
  <script src="/dist/js/popper.min.js"></script>
  <script src="/dist/js/bootstrap.js"></script>

</head>

<body class="bg-light">

  <?php
  if (empty($getHakAkses)) { // guest
    //--------------guest pages ---------------------
    if (empty($getPage)) {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/home.php';
    } elseif ($getPage == "login") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/login.php';
    } elseif ($getPage == "daftar") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/daftar.php';
    } elseif ($getPage == "produk") {
      if (isset($_GET['produk'])) {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/produk.php';
      } else {
        header("Location: /");
      }
    } else {
      header("Location: /");
    }
    //--------------end of guest pages ---------------------
  } elseif ($getHakAkses == "1") { //klien
    //--------------klien pages ---------------------
    if (empty($getPage) || $getPage == "home") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/home.php';
    } elseif ($getPage == "produk") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/produk.php';
    } elseif ($getPage == "keranjang") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/keranjang.php';
    } elseif ($getPage == "profil") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/profil.php';
    } elseif ($getPage == "checkout") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/checkout.php';
    } elseif ($getPage == "co-sukses") {
      if (isset($_GET['pesanan'])) {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/co-sukses.php';
      } else {
  ?>
        <script>
          alert("Maaf pesanan yang anda cari tidak ada!");
          window.location.href = "/";
        </script>
  <?php
      }
    } elseif ($getPage == "co-gagal") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/co-gagal.php';
    } else {
      header("Location: /");
    }
    //--------------end of klien pages ---------------------
  } elseif ($getHakAkses == "2") { // admin
    //--------------admin pages ---------------------
    if (empty($getPage) || $getPage == "dashboard") {
      $getPageStatus = "dashboard";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/dashboard.php';
    }
    //Start of produks
    elseif ($getPage == "produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/produk.php';
    } elseif ($getPage == "tambah-produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/tambah-produk.php';
    } elseif ($getPage == "edit-produk") {
      if (isset($_GET['produk'])) {
        $getPageStatus = "produk";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/edit-produk.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Produks
    //Start of pesanan
    elseif ($getPage == "pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/pesanan.php';
    } elseif ($getPage == "tambah-pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/tambah-pesanan.php';
    } elseif ($getPage == "edit-pesanan") {
      if (isset($_GET['pesanan'])) {
        $getPageStatus = "pesanan";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/edit-pesanan.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Pesanan
    //Start of Akun
    elseif ($getPage == "akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/akun.php';
    } elseif ($getPage == "tambah-akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/tambah-akun.php';
    } elseif ($getPage == "edit-akun") {
      if (isset($_GET['akun'])) {
        $getPageStatus = "akun";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/edit-akun.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Akun
    //Start of Pembayaran
    elseif ($getPage == "pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/pembayaran.php';
    } elseif ($getPage == "tambah-pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/tambah-pembayaran.php';
    } elseif ($getPage == "edit-pembayaran") {
      if (isset($_GET['pembayaran'])) {
        $getPageStatus = "pembayaran";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/edit-pembayaran.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Pembayaran
    //Start of Project Monitoring
    elseif ($getPage == "project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/project.php';
    } elseif ($getPage == "tambah-project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/tambah-project.php';
    }
    //End of Project Monitoring
    else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of admin pages ---------------------
  }
  ?>

</body>


<?php echo ($ctr->jsImporter($getPage, $getHakAkses)); ?>

</html>