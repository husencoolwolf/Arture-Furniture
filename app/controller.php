<?php
class controller
{
  var $aktorcss = array("guest", "klien", "administrator", "marketing", "produksi", "akuntansi", "ceo");
  var $halamancss = array(
    array("home", "login", "daftar", "produk", "catalog-furniture"),
    array("home", "produk", "keranjang", "checkout", "co-sukses", "co-gagal", "profil", "pesanan"),
    array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil")
  );

  var $aktorjs = array("guest", "klien", "administrator", "marketing", "produksi", "akuntansi", "ceo");
  var $halamanjs = array(
    array("daftar", "produk"),
    array("produk", "keranjang", "co-sukses", "profil", "pesanan"),
    array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil"),
    array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun", "tambah-akun", "edit-akun", "pembayaran", "tambah-pembayaran", "edit-pembayaran", "project", "tambah-project", "edit-project", "profil")
  );

  function __construct()
  {
  }

  function cssImporter($getParam, $getSession)
  {
    $css = ""; //output css code

    if (empty($getParam)) {
      $getParam = "home";
    }
    if (empty($getSession)) {
      $getSession = "guest";
    } else {
      $getSession = $this->kodeHakAksesToStringCSS($getSession);
    }


    //
    for ($i = 0; $i < count($this->aktorcss); $i++) {
      if ($getSession == $this->aktorcss[$i]) {
        for ($j = 0; $j < count($this->halamancss[$i]); $j++) {
          if ($getParam == $this->halamancss[$i][$j]) {  // gk ada parameter
            $css = '<link rel="stylesheet" href="/dist/css/pages/' . $this->aktorcss[$i] . '-' . $this->halamancss[$i][$j] . '.css">';
          }
        }
      }
    }
    return $css;
  }

  function jsImporter($getParam, $getSession)
  {
    $js = ""; //output css code

    if (empty($getParam)) {
      $getParam = "home";
    }
    if (empty($getSession)) {
      $getSession = "guest";
    } else {
      $getSession = $this->kodeHakAksesToStringJS($getSession);
    }

    //
    for ($i = 0; $i < count($this->aktorjs); $i++) {
      if ($getSession == $this->aktorjs[$i]) {
        for ($j = 0; $j < count($this->halamanjs[$i]); $j++) {
          if ($getParam == $this->halamanjs[$i][$j]) {  // gk ada parameter
            $js = '<script src="/dist/js/pages/' . $this->aktorjs[$i] . '-' . $this->halamanjs[$i][$j] . '.js"></script>';
          }
        }
      }
    }
    return $js;
  }

  function kodeHakAksesToStringCSS($index)
  {
    $index = (int)$index;
    // var_dump($index);
    return $this->aktorcss[$index];
  }

  function kodeHakAksesToStringJS($index)
  {
    $index = (int)$index;
    // var_dump($index);
    return $this->aktorjs[$index];
  }

  function pembuatIDUnik($connection, $tabelName, $fieldID, $id = null, $max = 6)
  {
    if ($id == null) {
      $id = '';
      for ($i = 0; $i < $max; $i++) {
        $id = $id . rand(0, 9);
      }
    }

    //
    $cekid = mysqli_query($connection, "SELECT $fieldID FROM $tabelName WHERE $fieldID = '$id'");
    if (mysqli_num_rows($cekid) == 0) {
      return $id;
    } else {
      $id2 = createId(8);
      $this->pembuatIDUnik($connection, $tabelName, $fieldID, $id);
    }
  }

  function intToRupiah($angka)
  {
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
  }

  function WhatsappSentMany($noTarget)
  {
    // coolwolf wa token : EAALB4wBPZA4sBAKrSbwlqoVyR5Jhq5fbAsIRpc8oM9eN3mx9wLnmqdueWg8JxqrDMt7X9tEi5uHDxbxEgE3QxWu3ZBVdIEXjPC8YjDQeZAB81yLGZB0wQPyRN2malbORaiJm23zsLjyn1nQOpBCf5KqTBsM4MjAPYFUk1ZCj14pOz4o0IS1QV
    $waToken = "EAALB4wBPZA4sBAKrSbwlqoVyR5Jhq5fbAsIRpc8oM9eN3mx9wLnmqdueWg8JxqrDMt7X9tEi5uHDxbxEgE3QxWu3ZBVdIEXjPC8YjDQeZAB81yLGZB0wQPyRN2malbORaiJm23zsLjyn1nQOpBCf5KqTBsM4MjAPYFUk1ZCj14pOz4o0IS1QV";
    // coolwolf wa id : 111896601660196 
    //wa test id : 103874192471361
    $phoneId = "111896601660196";

    $header = array(
      "Authorization: Bearer $waToken",
      'Content-Type: application/json'
    );

    $lang = array(
      'code' => "en_US"
    );

    $templateArr = array(
      'name' => "hello_world",
      'language' => $lang
    );

    // $fields = array(
    //   'messaging_product' => 'whatsapp',
    //   'recipient_type' => 'individual',
    //   'to' => '6287771236822',
    //   'type' => 'text',
    //   'text' => $text_arr
    // );
    $fields = array(
      'messaging_product' => 'whatsapp',
      'recipient_type' => 'individual',
      'to' => $noTarget,
      'type' => 'template',
      'template' => $templateArr
    );
    // persiapkan curl
    $ch = curl_init();

    // set url 
    // curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v14.0/103874192471361/messages");

    // return the transfer as a string 
    curl_setopt_array($ch, array(
      CURLOPT_URL => "https://graph.facebook.com/v13.0/$phoneId/messages",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => $header,
    ));

    // $output contains the output string 
    // $output = curl_exec($ch);
    $response = json_decode(curl_exec($ch), true);

    // tutup curl 
    curl_close($ch);
    if (!isset($response['error'])) {
      return true;
    } else {
      return false;
    }
  }
}
