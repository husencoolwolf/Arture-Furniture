<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/telegram.php";
$db = new database;
$controller = new controller;
$tg = new Telegram(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/private/telegram.json"));
$aksi = "";
$request = "";
$api = "";
if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
}
if (isset($_GET['request'])) {
  $request = $_GET['request'];
}
if (isset($_GET['api'])) {
  $api = $_GET['api'];
}

if ($aksi == "daftarKlien") {
  $idAkun = $controller->pembuatIDUnik($db->getKoneksi(), "akun", "id_akun");
  $data = array(
    "id" => $idAkun,
    "nama" => $_POST['inputNama'],
    "username" => $_POST['inputUsername'],
    "nope" => $_POST['selectCodeNegara'] . $_POST['inputNope'],
    "email" => $_POST['inputEmail'],
    "password" => $_POST['inputPassword'],
    "alamat" => $_POST['inputAlamat']
  );
  $dataAlamat = array(
    "idAkun" => $idAkun,
    "alamat" => $_POST['inputAlamat'],
    "provinsi" => $_POST['selectProvinsi'],
    "kota" => $_POST['selectKota'],
    "kecamatan" => $_POST['selectKecamatan']
  );
  $respon1 = $db->daftarKlien($data);
  $respon2 = $db->tambahAlamatKlien($dataAlamat);
  ($respon1 && $respon2) == "0" ? $respon = "0" : $respon = $respon1 . $respon2;
  if ($respon == "0") {
    header("Location: /?page=login&daftar=1");
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
} elseif ($aksi == "tambah-produk-admin") {
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
    $namaFile = $_FILES['inputGambar']['name'];
    $respon = $db->tambahProduk($_POST, $namaFile);
    // Return array[@keberhasilan, @encryptednamefile]
    if ($respon[0] == "0") {
      $uploadfile = $uploaddir . $respon[1];
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
  if (isset($_GET['id']) && $_SESSION['id_hak_akses'] == "2") {
    $respon = $db->hapusProduk($_GET['id']);
    if ($respon == "0") {
      header("Location: /?page=produk");
    } elseif ($respon == "1") {
      header("Location: /?page=produk&error=2");
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
    "id_klien" => $_SESSION['id_akun'],
    "pesanan" => $_GET['pesanan'],
    "bank" => $_POST['selectBank'],
    "norek" => $_POST['inputNorek'],
    "nasabah" => $_POST['inputNasabah']
  );
  $klien = mysqli_fetch_assoc($db->getDataKlien($_SESSION['id_akun']));

  $respon = $db->tambahInfoPembayaran($data);

  echo (json_encode(array($respon, $data, $klien)));
} elseif ($aksi == "tambah-pesanan-admin") {
  $respon = $db->tambahPesananAdmin($_POST['pesanan'], $_POST['produk']);
  echo ($respon);
  if ($respon) {
    header("Location: /?page=pesanan");
  } else {
    header("Location: /?page=tambah-pesanan&error=$respon");
  }
} elseif ($aksi == "tambah-project-admin") {
  $respon = $db->tambahProjectAdmin($_POST['project'], $_POST['item']);
  // var_dump($_POST);\
  if ($respon) {
    header("Location: /?page=project");
  } else {
    header("Location: /?page=tambah-project&error=$respon");
  }
} elseif ($aksi == "tambah-pembayaran-admin") {
  $idPembayaran = $controller->pembuatIDUnik($db->getKoneksi(), "pembayaran", "id_pembayaran");
  $respon = $db->tambahPembayaranAdmin($_POST, $idPembayaran);
  if ($respon) {
    header("Location: /?page=pembayaran");
  } else {
    header("Location: /?page=tambah-pembayaran&error=1");
  }
  // print_r($_POST);
} elseif ($aksi == "edit-pesanan-admin") {
  $respon = $db->editPesananAdmin($_POST['pesanan'], $_POST['produk'], $_POST['id']);
  echo ($respon);
} elseif ($aksi == "edit-project-admin") {
  $respon = $db->editProjectAdmin($_POST['project'], $_POST['item'], $_POST['id']);
  echo ($respon);
} elseif ($aksi == "daftar-akun-admin") {
  $data = array(
    "id" => $controller->pembuatIDUnik($db->getKoneksi(), "akun", "id_akun"),
    "nama" => $_POST['inputNama'],
    "username" => $_POST['inputUsername'],
    "nope" => $_POST['inputNope'],
    "email" => $_POST['inputEmail'],
    "password" => $_POST['inputPassword'],
    "alamat" => $_POST['inputAlamat'],
    "privilege" => $_POST['selectHakAkses']
  );
  $respon = $db->tambahAkunAdmin($data);
  if ($respon) {
    header("Location: /?page=akun");
  } elseif ($respon == "1062") {
    header("Location: /?page=tambah-akun&error=$respon");
  } else {
    header("Location: /?page=tambah-akun&error=-1");
  }
} elseif ($aksi == "hapus-akun") {
  if (isset($_GET['id'])) {
    $idAkun = $_GET['id'];
    $respon = $db->deleteAkunAdmin($idAkun);
    if ($respon) {
      header("Location: /?page=akun");
    } else {
      header("Location: /?page=akun&error=-1");
    }
  } else {
    echo (0);
  }
} elseif ($aksi == "hapus-pembayaran") {
  if (isset($_GET['id'])) {
    $idPembayaran = $_GET['id'];
    $respon = $db->deletePembayaranAdmin($idPembayaran);
    if ($respon) {
      header("Location: /?page=pembayaran");
    } else {
      header("Location: /?page=pembayaran&error=-1");
    }
  } else {
    echo (0);
  }
} elseif ($aksi == "hapus-pesanan") {
  if (isset($_GET['id'])) {
    $idPesanan = $_GET['id'];
    $respon = $db->deletePesananAdmin($idPesanan);
    if ($respon) {
      header("Location: /?page=pesanan");
    } else {
      header("Location: /?page=pesanan&error=-1");
    }
  } else {
    echo (0);
  }
} elseif ($aksi == "hapus-project") {
  if (isset($_GET['id'])) {
    $idProject = $_GET['id'];
    $respon = $db->deleteProjectAdmin($idProject);
    if ($respon) {
      header("Location: /?page=project");
    } else {
      header("Location: /?page=project&error=-1");
    }
  } else {
    echo (0);
  }
} elseif ($aksi == "edit-akun-admin") {
  $respon = $db->editAkunAdmin($_GET['id'], $_POST);
  if ($respon) {
    header("Location: /?page=akun");
  } else {
    header("Location: /?page=edit-akun&akun=" . $_GET['id'] . "&error=" . $respon);
  }
} elseif ($aksi == "edit-profil-admin") {
  $respon = $db->editProfilAdmin($_SESSION['id_akun'], $_POST);
  if ($respon) {
    header("Location: /?page=profil&sukses=1");
  } else {
    header("Location: /?page=edit-akun&error=" . $respon);
  }
} elseif ($aksi == "edit-profil-klien") {
  $respon = $db->editProfilKlien($_SESSION['id_akun'], $_POST);
  if ($respon) {
    header("Location: /?page=profil&sukses=1");
  } else {
    header("Location: /?page=edit-akun&error=" . $respon);
  }
} elseif ($aksi == "edit-pembayaran-admin") {
  $respon = $db->editPembayaranAdmin($_GET['id'], $_POST);
  if ($respon) {
    header("Location: /?page=pembayaran");
  } else {
    header("Location: /?page=edit-pembayaran&pembayaran=" . $_GET['id'] . "&error=" . $respon);
  }
} elseif ($aksi == "update-status-pesanan") {
  $respon = $db->updateStatusPesanan($_POST, $_GET['id']);
  echo (json_encode($_POST));
} elseif ($aksi == "update-status-project") {
  $respon = $db->updateStatusProject($_POST, $_GET['id'], $_GET['type']);
  echo ($respon);
} elseif ($aksi == "konfirmasi-pengiriman") {
  $id = $_POST['id'];
  $respon = $db->konfirmasiPengirimanKlien($id, $_SESSION['id_akun']);
  echo ($respon);
}
// start of request

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
} elseif ($request == "buat-id-unik") {
  $erormsg = "Butuh parameter tabel!";
  if (!isset($_GET['tabel'])) {
    echo $errormsg;
  } else {
    switch ($_GET['tabel']) {
      case 'item_proyek':
        echo ($db->pembuatIDUnik($db->getKoneksi(), "item_proyek", "id_item_proyek"));
        break;
      default:
        echo ("tabel tidak terdaftar di proses.php");
        break;
    }
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
} elseif ($request == "req-harga-produk-admin") {
  $respon = $db->getHargaProdukAdmin();
  if ($respon) {
    echo ($respon);
  } else {
    echo ("0");
  }
} elseif ($request == "get-data-pesanan") {
  $respon = $db->getDataPesanan($_GET['id'], $_SESSION['id_akun']);
  if ($respon) {
    echo (json_encode($respon));
  } elseif ($respon == false) {
    echo ("0");
  }
  // echo $respon;
} elseif ($request == "generate-cara-pembayaran") {
  $data = $db->getDataPembayaran($_POST['id'], $_SESSION['id_akun']);
  echo ('<table class="table">
    <tr>
      <td>
        Metode Pembayaran :
      </td>
      <td>
        ' . $data['metode'] . '
      </td>
    </tr>
    <tr>
      <td>
        Bank :
      </td>
      <td>
        ' . $data['bank_pemilik'] . '
      </td>
    </tr>
    <tr>
      <td>
        No. Rekening :
      </td>
      <td>
        ' . $data['no_rekening'] . '
      </td>
    </tr>
    <tr>
      <td>
        Nama Nasabah :
      </td>
      <td>
        ' . $data['nama_pemilik'] . '
      </td>
    </tr>
  </table>');
} elseif ($request == "update-tabel-pesanan-admin") {
  $dari = $_POST['dari'];
  $sampai = $_POST['sampai'];
  $respon = $db->updateDataTabelPesananAdmin($dari, $sampai);
  if ($respon) {
    echo (json_encode($respon));
  } elseif ($respon == "-1") {
    echo ($respon);
  } else {
    echo ("0");
  }
} elseif ($request == "update-tabel-pembayaran-admin") {
  $dari = $_POST['dari'];
  $sampai = $_POST['sampai'];
  $respon = $db->updateDataTabelPembayaranAdmin($dari, $sampai);
  if ($respon) {
    echo (json_encode($respon));
  } elseif ($respon == "-1") {
    echo ($respon);
  } else {
    echo ("0");
  }
} elseif ($request == "get-detail-pesananan-modal-admin") {
  $idPesanan = $_POST['id'];
  $idKlien = $_SESSION['id_akun'];
  $respon = $db->getDataDetailPesananModalAdmin($idPesanan);
  echo (json_encode($respon));
} elseif ($request == "get-detail-project-modal-admin") {
  $idProject = $_POST['id'];
  $respon = $db->getDataDetailProjectModalAdmin($idProject);
  echo (json_encode($respon));
} elseif ($request == "get-detail-akun-modal-admin") {
  $idAkun = $_POST['id'];
  $respon = $db->getDataDetailAkunModalAdmin($idAkun);
  echo (json_encode($respon));
} elseif ($request == "req-produk-pesanan-admin") {
  $idPesanan = $_POST['id'];
  $respon = $db->getDetailPesananAdmin($idPesanan);
  $returnArr = array();
  while ($x = mysqli_fetch_assoc($respon)) {
    $returnArr[$x['id_produk']] = (int)$x['jumlah'];
  }
  echo (json_encode($returnArr));
} elseif ($request == "get-calendar-project") {
  $respon = $db->getProjectCalendarFormat();
  if ($respon == false) {
    echo (json_encode(array()));
  } else {
    echo (json_encode($respon));
  }
  // echo json_encode($respon);
} elseif ($request == "update-tabel-project-admin") {
  $dari = $_POST['dari'];
  $sampai = $_POST['sampai'];
  $respon = $db->updateDataTabelProjectAdmin($dari, $sampai);
  if ($respon) {
    echo (json_encode($respon));
  } elseif ($respon == "-1") {
    echo ($respon);
  } else {
    echo ("0");
  }
} elseif ($request == "get-pesanan-akun-list-pembayaran-admin") {
  $respon = $db->getDataPesananListAddPembayaranAdmin();
  echo (json_encode($respon));
} elseif ($request == "req-data-pesanan-klien") {
  $respon = $db->getDataPesananKlien($_SESSION['id_akun']);
  echo (json_encode($respon));
}
// end of request

//start of API
switch ($api) {
  case "telegram-notif-klien-buat-pesanan":
    $klien = $_POST['dataKlien'];
    $data = $_POST['dataPembayaran'];
    $r = $tg->SendMessage(
      "<b><u>Pesanan Baru<u></b>" .
        "\nAtas Nama : " . $klien['nama'] . " dengan ID Pesanan: <code>" . $data['pesanan'] . "</code>." .
        "\nDetail Klien :" .
        "\n-No. HP : <code>" . $klien['nomor_hp'] . "</code>" .
        "\n-Email : <code>" . $klien['email'] . "</code>" .
        "\nHarap untuk verifikasi pembayaran pesanan secara berkala!!!",
      [1],
      ['akuntansi_group']
    );
    echo ($r);
    break;
  case "telegram-update-status-pesanan":
    $statusSelanjutnya = "";
    $keterangan = "";
    if (isset($_POST['inputAlasan'])) { // kalo batal
      $statusSelanjutnya = "batal";
    } else { //kalo tidak batal
      $statusSelanjutnya = $_POST['selanjutnya'];
    }
    $idPesanan = $_GET['id'];
    switch ($statusSelanjutnya) {
      case "pembuatan":

        break;
      case "pengiriman":

        break;
      case "selesai":

        break;

      case "batal":
        if (isset($_POST['inputAlasan'])) {
          $klien = $db->getDataDetailPesananModalAdmin($idPesanan)['detail_pesanan'];
          $response = $tg->SendMessage(
            "<b>Ada pesanan yang dibatalkan</b>\n" .
              "Dengan ID Pesanan : <code>$idPesanan</code>\n" .
              "dengan alasan : " . $_POST['inputAlasan'] . "\n" .
              "<u>detail</u>\n" .
              "Nama Klien : " . $klien['nama'] . "\n" .
              "No.Hp : " . $klien['nomor_hp'] . "\n" .
              "Email : " . $klien['email'],
            [],
            [
              "marketing_group",
              "akuntansi_group",
              "produksi_group"
            ]
          );
        }
        break;
    }
    break;
}
//end of API
if ($aksi = "" && $request == "" && $api = "") {
  echo ('<div class="alert alert-warning" role="alert">
        Terjadi kesalahan 404: parameter hilang!
        </div>');
}
