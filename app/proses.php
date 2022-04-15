<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
$db = new database;
$controller = new controller;
$aksi = "";
$request = "";
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
}
if (isset($_GET['request'])) {
  $request = $_GET['request'];
}

if ($aksi == "daftarKlien") {
  $data = array(
    "id" => $controller->pembuatIDUnik($db->getKoneksi(), "akun", "id_akun"),
    "nama" => $_POST['inputNama'],
    "username" => $_POST['inputUsername'],
    "nope" => $_POST['inputNope'],
    "email" => $_POST['inputEmail'],
    "password" => $_POST['inputPassword'],
    "alamat" => $_POST['inputAlamat']
  );
  $respon = $db->daftarKlien($data);
  if ($respon == "0") {
    header("Location: /");
  } else {
    echo ("Oh no,, Ada yang salah dengan query daftar klien! : " . $respon);
  }
} elseif ($aksi == "login") {
  $respon = $db->verified_login($_POST['inputUsername'], $_POST['inputPassword']);
  if ($respon == "0") {
    header("Location: /");
  } else {
    header("Location: /?page=login&error=$respon");
  }
} elseif ($aksi == "tambah-kategori") {
  $respon = $db->tambahKategori($_POST);
  if ($respon == "0") { // berhasil
    echo ('<div class="alert alert-success" role="alert">
        Kategori Berhasil ditambahkan!!!
        </div>');
  } else {
    echo ('<div class="alert alert-success" role="alert">
        ' . $respon . '
        </div>');
  }
} elseif ($aksi == "tambah-produk") {
  if (!file_exists($_FILES['inputGambar']['tmp_name']) || !is_uploaded_file($_FILES['inputGambar']['tmp_name'])) {
    $respon = $db->tambahProduk($_POST, "default.jpg");
    if ($respon == "0") {
      header("Location: /?page=produk");
    } else {
      header("Location: /?page=tambah-produk&error=1");
    }
  } else {
    // ada file
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/assets/produk/';
    $uploadfile = $uploaddir . basename($_FILES['inputGambar']['name']);
    $namaFile = $_FILES['inputGambar']['name'];
    $respon = $db->tambahProduk($_POST, $namaFile);
    if ($respon == "0") {
      if (move_uploaded_file($_FILES['inputGambar']['tmp_name'], $uploadfile)) {
        // echo "File is valid, and was successfully uploaded.\n";
        header("Location: /?page=produk");
      } else {
        header("Location: /?page=tambah-produk&error=2");
        // echo "Upload failed";
      }
    } else {
      header("Location: /?page=tambah-produk&error=1"); //db error
    }
  }
} elseif ($aksi == "edit-produk") {
  if (!file_exists($_FILES['inputGambar']['tmp_name']) || !is_uploaded_file($_FILES['inputGambar']['tmp_name'])) {
    $respon = $db->editProduk($_POST, false, $_GET['id']);
    if ($respon == "0") {
      header("Location: /?page=produk&produk=" . $_GET['id']);
    } else {
      header("Location: /?page=edit-produk&produk=" . $_GET['id'] . "&error=1");
    }
  } else {
    // ada file
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/assets/produk/';
    $uploadfile = $uploaddir . basename($_FILES['inputGambar']['name']);
    $namaFile = $_FILES['inputGambar']['name'];
    $respon = $db->editProduk($_POST, $namaFile, $_GET['id']);
    if ($respon == "0") {
      if (move_uploaded_file($_FILES['inputGambar']['tmp_name'], $uploadfile)) {
        // echo "File is valid, and was successfully uploaded.\n";
        header("Location: /?page=produk&produk=" . $_GET['id']);
      } else {
        header("Location: /?page=edit-produk&produk=" . $_GET['id'] . "&error=2");
        // echo "Upload failed";
      }
    } else {
      header("Location: /?page=edit-produk&produk=" . $_GET['id'] . "&error=1"); //db error
    }
  }
} elseif ($aksi == "hapus-produk") {
  if (isset($_GET['id'])) {
    $respon = $db->hapusProduk($_GET['id']);
    if ($respon == "0") {
      header("Location: /?page=produk");
    } else {
      header("Location: /?page=produk&error=1");
    }
  } else {
    header("Location: /?page=produk");
  }
} elseif ($aksi == "tambah-keranjang") {
  if (isset($_POST['id']) && isset($_SESSION['id_akun'])) {
    $respon = $db->tambahKeranjang($_POST['id'], $_SESSION['id_akun'], $_POST['quantity']);
    if ($respon == "0") {
      echo ('<div class="alert alert-success" role="alert">
        Keranjang Berhasil ditambahkan!!!
        </div>');
    } elseif ($respon == "1") {
      echo ('<div class="alert alert-warning" role="alert">
        Warning: Batas quantity per produk 10 sekali pesan!!!
        </div>');
    } else {
      echo ('<div class="alert alert-danger" role="alert">
        Ada yang salah pada sistem query!!! harap laporkan masalah ini pada administrator!!!
        </div>');
    }
  }
} elseif ($aksi == "hapus-keranjang-user") {
  if (isset($_SESSION['id_akun']) && isset($_POST['id'])) {
    $respon = $db->hapusKeranjangUser($_SESSION['id_akun'], $_POST['id']);
    if ($respon == "0") {
      echo ('<div class="alert alert-success" role="alert">
        Produk Berhasil dihapus dari keranjang!!!
        </div>');
    } else {
      echo ('<div class="alert alert-danger" role="alert">
        Ada yang salah pada sistem query!!! harap laporkan masalah ini pada administrator!!!
        </div>');
    }
  }
} elseif ($aksi == "buat-pesanan") {
  $data = array(
    "id" => $controller->pembuatIDUnik($db->getKoneksi(), "pesanan", "id_pesanan"),
    "akun" => $_SESSION['id_akun'],
    "produk" => $_POST['id'],
    "jumlah" => $_POST['jml'],
    "metode" => $_POST['metode']
  );
  $respon = $db->tambahPesanan($data);
  // var_dump($data);
  if ($respon) {
    header("Location:/?page=co-sukses&pesanan=" . $data['id']);
  } elseif (!$respon) {
    header("Location:/?page=co-gagal");
  } else {
    header("Location:/?page=co-gagal");
  }
  // var_dump($_POST);
} elseif ($aksi == "buat-pembayaran") {
  $data = array(
    "id" => $controller->pembuatIDUnik($db->getKoneksi(), "pembayaran", "id_pembayaran"),
    "pesanan" => $_GET['pesanan'],
    "bank" => $_POST['selectBank'],
    "norek" => $_POST['inputNorek'],
    "nasabah" => $_POST['inputNasabah']
  );
  $respon = $db->tambahInfoPembayaran($data);
  // var_dump($data);
  return $respon;
  // var_dump($_POST);
}
// request

if ($request == "updateKategori") {
  $dataKategori = $db->getDataKategori();
  if ($dataKategori == false) { //kalau gagal
    echo json_encode(array());
  } else {
    $data = array();
    while ($x = mysqli_fetch_array($dataKategori)) {
      $data[$x['id_kategori']] = $x['kategori'];
    }
    echo json_encode($data);
  }
} elseif ($request == "update-keranjang") {
  $respon = $db->getJumlahKeranjangUser($_SESSION['id_akun']);
  if ($respon == false) { //kalau gagal
    echo "0";
  } else {
    echo $respon;
  }
} elseif ($request == "set-tersedia") {
  $respon = $db->setProdukTersedia($_POST['id']);
  echo ($respon);
} elseif ($request == "harga-produk-banyak-id") {
  if (isset($_POST['id'])) {
    $respon = $db->getHargaProdukWithIDs($_POST['id']);
  } else {
    $respon = $db->getHargaProdukWithIDs(array());
  }

  print(json_encode($respon));
} elseif ($request == "req-harga-jml-produk") {
  $respon = $db->getHargaJumlahProdukAll($_SESSION['id_akun']);
  if ($respon) {
    echo ($respon);
  } else {
    echo ("0");
  }
} elseif ($request == "get-data-pesanan") {
  $respon = $db->getDataPesanan($_POST['id'], $_SESSION['id_akun']);
  if ($respon) {
    echo (json_encode($respon));
  } else {
    echo ("0");
  }
  // echo $respon;
}

if ($aksi = "" && $request == "") {
  echo ('<div class="alert alert-warning" role="alert">
        Terjadi kesalahan 404: parameter hilang!
        </div>');
}
