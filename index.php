<?php

use Services\EnvParser;

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
(new EnvParser(__DIR__ . '/.env'))->load(); //Environment Parser
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
  <link rel="icon" type="image/png" href="/assets/material/Logo-transparent.png">
  <link rel="stylesheet" href="/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/dist/DataTables/datatables.min.css">
  <link rel="stylesheet" href="/dist/css/styles.css">
  <?php echo ($ctr->cssImporter($getPage, $getHakAkses)); ?>

  <script src="/dist/js/jquery-3.5.1.js"></script>
  <script src="/dist/js/popper.min.js"></script>
  <script src="/dist/js/bootstrap.js"></script>
  <script src="/dist/js/tambahan.js"></script>

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
    } elseif ($getPage == "catalog-furniture") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/catalog-furniture.php';
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
    } elseif ($getPage == "pesanan") {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/pesanan.php';
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
    } elseif ($getPage == "edit-project") {
      if (isset($_GET['project'])) {
        $getPageStatus = "project";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/edit-project.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Project Monitoring
    //Start of Profil
    elseif ($getPage == "profil") {
      $getPageStatus = "profil";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/profil.php';
    } else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of admin pages ---------------------
  } elseif ($getHakAkses == "3") { // marketing
    //--------------Marketing pages ---------------------
    if (empty($getPage) || $getPage == "dashboard") {
      $getPageStatus = "dashboard";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/dashboard.php';
    }
    //Start of produks
    elseif ($getPage == "produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/produk.php';
    } elseif ($getPage == "tambah-produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/tambah-produk.php';
    } elseif ($getPage == "edit-produk") {
      if (isset($_GET['produk'])) {
        $getPageStatus = "produk";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/edit-produk.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Produks
    //Start of pesanan
    elseif ($getPage == "pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/pesanan.php';
    }
    //End of Pesanan
    //Start of Akun
    elseif ($getPage == "akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/akun.php';
    }
    //End of Akun
    //Start of Pembayaran
    elseif ($getPage == "pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/pembayaran.php';
    }
    //End of Pembayaran
    //Start of Project Monitoring
    elseif ($getPage == "project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/project.php';
    } elseif ($getPage == "tambah-project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/tambah-project.php';
    } elseif ($getPage == "edit-project") {
      if (isset($_GET['project'])) {
        $getPageStatus = "project";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/edit-project.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Project Monitoring
    //Start of Profil
    elseif ($getPage == "profil") {
      $getPageStatus = "profil";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/marketing/profil.php';
    } else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of marketing pages ---------------------
  } elseif ($getHakAkses == "4") { // produksi
    //--------------produksi pages ---------------------
    if (empty($getPage) || $getPage == "dashboard") {
      $getPageStatus = "dashboard";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/dashboard.php';
    }
    //Start of produks
    elseif ($getPage == "produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/produk.php';
    }
    //End of Produks
    //Start of pesanan
    elseif ($getPage == "pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/pesanan.php';
    }
    //End of Pesanan
    //Start of Akun
    elseif ($getPage == "akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/akun.php';
    }
    //End of Akun
    //Start of Pembayaran
    elseif ($getPage == "pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/pembayaran.php';
    }
    //End of Pembayaran
    //Start of Project Monitoring
    elseif ($getPage == "project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/project.php';
    } elseif ($getPage == "tambah-project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/tambah-project.php';
    } elseif ($getPage == "edit-project") {
      if (isset($_GET['project'])) {
        $getPageStatus = "project";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/edit-project.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Project Monitoring
    //Start of Profil
    elseif ($getPage == "profil") {
      $getPageStatus = "profil";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/produksi/profil.php';
    } else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of produksi pages ---------------------
  } elseif ($getHakAkses == "5") { // Akuntansi
    //--------------akuntansi pages ---------------------
    if (empty($getPage) || $getPage == "dashboard") {
      $getPageStatus = "dashboard";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/dashboard.php';
    }
    //Start of produks
    elseif ($getPage == "produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/produk.php';
    }
    //End of Produks
    //Start of pesanan
    elseif ($getPage == "pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/pesanan.php';
    }
    //End of Pesanan
    //Start of Akun
    elseif ($getPage == "akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/akun.php';
    }
    //End of Akun
    //Start of Pembayaran
    elseif ($getPage == "pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/pembayaran.php';
    } elseif ($getPage == "tambah-pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/tambah-pembayaran.php';
    } elseif ($getPage == "edit-pembayaran") {
      if (isset($_GET['pembayaran'])) {
        $getPageStatus = "pembayaran";
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/edit-pembayaran.php';
      } else {
        $getPageStatus = "dashboard";
        header("Location: /");
      }
    }
    //End of Pembayaran
    //Start of Project Monitoring
    elseif ($getPage == "project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/project.php';
    }
    //End of Project Monitoring
    //Start of Profil
    elseif ($getPage == "profil") {
      $getPageStatus = "profil";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/akuntansi/profil.php';
    } else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of akuntansi pages ---------------------
  } elseif ($getHakAkses == "6") { // CEO
    //--------------CEO pages ---------------------
    if (empty($getPage) || $getPage == "dashboard") {
      $getPageStatus = "dashboard";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/dashboard.php';
    }
    //Start of produks
    elseif ($getPage == "produk") {
      $getPageStatus = "produk";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/produk.php';
    }
    //End of Produks
    //Start of pesanan
    elseif ($getPage == "pesanan") {
      $getPageStatus = "pesanan";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/pesanan.php';
    }
    //End of Pesanan
    //Start of Akun
    elseif ($getPage == "akun") {
      $getPageStatus = "akun";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/akun.php';
    }
    //End of Akun
    //Start of Pembayaran
    elseif ($getPage == "pembayaran") {
      $getPageStatus = "pembayaran";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/pembayaran.php';
    }
    //End of Pembayaran
    //Start of Project Monitoring
    elseif ($getPage == "project") {
      $getPageStatus = "project";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/project.php';
    }
    //End of Project Monitoring
    //Start of Profil
    elseif ($getPage == "profil") {
      $getPageStatus = "profil";
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/ceo/profil.php';
    } else {
      $getPageStatus = "dashboard";
      header("Location: /");
    }
    //--------------end of CEO pages ---------------------
  }
  ?>

</body>


<?php echo ($ctr->jsImporter($getPage, $getHakAkses)); ?>

</html>