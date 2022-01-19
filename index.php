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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Arture Furniture</title>
  <link rel="stylesheet" href="/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/dist/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/dist/DataTables/datatables.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/dist/css/font-setting.css">
  <?php echo ($ctr->cssImporter($getPage, $getHakAkses)); ?>
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
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/guest/home.php';
      }
    }
  } elseif ($getHakAkses == "1") {
    //--------------klien pages ---------------------
    if (empty($getPage || $getPage == "home")) {
      include $_SERVER['DOCUMENT_ROOT'] . '/pages/klien/home.php';
    }
  }
  ?>

</body>
<script src="/dist/js/jquery-3.5.1.js"></script>
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>
<script src="/dist/js/bootstrap.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>
<?php echo ($ctr->jsImporter($getPage, $getHakAkses)); ?>

</html>