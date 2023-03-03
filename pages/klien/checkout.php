<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$data = $db->getDataKlien($_SESSION['id_akun']);
$dataKlien = array();
while ($x = mysqli_fetch_array($data)) {
  $dataKlien['nama'] = $x['nama'];
  $dataKlien['alamat'] = $x['alamat'];
  $dataKlien['nomor_hp'] = $x['nomor_hp'];
}
?>

<script src="/dist/js/pages/klien-navbar.js"></script>

<?php
// var_dump(explode(",", $_POST['id']));
if (isset($_POST['id'])) {
  $dataHarga = $db->getHargaProdukWithIDs(explode(",", $_POST['id']));
  $quantity = explode(",", $_POST['jml']);
  $subtotal = 0;
  $biayaAdmin = 7000;
  $ongkir = 35000;
  for ($i = 0; $i < count($dataHarga); $i++) {
    $subtotal += $dataHarga[$i] * $quantity[$i];
  }
  $grandtotal = $subtotal + $ongkir + $biayaAdmin;
?>
  <!-- <form action="/app/proses.php?aksi=buat-pesanan" method="post"> -->
  <form action="/app/midtrans/examples/snap/checkout-process.php" method="post">

    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    <input type="hidden" name="jml" value="<?= $_POST['jml'] ?>">
    <div class="mb-5"></div>
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-5 m-3">
          <h5>Alamat Pengiriman</h5>
          <hr>
          <div class="border border-arture-emas px-3 py-2">
            <p class="font-weight-bold"><?= $dataKlien['nama'] ?></p>
            <p><?= $dataKlien['alamat'] ?></p>
            <br>
            <p><?= $dataKlien['nomor_hp'] ?></p>

          </div>
        </div>
        <div class="col-5 m-3">
          <h5>Grand Total</h5>
          <hr>
          <div class="border border-arture-emas px-3 py-2">
            <div class="d-flex justify-content-between">
              <p class="font-weight-bold">Subtotal</p>
              <p class="font-weight-bold rupiah" id="subtotal"><?= $db->intToRupiah($subtotal) ?></p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="font-weight-bold">Admin</p>
              <p class="font-weight-bold rupiah" id="subtotal">Rp.7.000</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="font-weight-bold">Ongkos Kirim</p>
              <p class="font-weight-bold rupiah" id="subtotal">Rp.35.000</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
              <p class="font-weight-bold">Grand Total</p>
              <p class="font-weight-bold rupiah" id="subtotal"><?= $db->intToRupiah($grandtotal) ?></p>
            </div>
          </div>
          <button class="btn btn-arture-emas w-100 my-4" id="checkout">
            <p class="font-weight-bold my-auto">Checkout</p>
          </button>
        </div>
      </div>
    </div>
  </form>

<?php
} else {
?>
  <script>
    alert("Oops, proses checkout anda bermasalah, Harap coba lagi!");
    window.location.href = "/?page=keranjang";
  </script>
<?php
}
?>