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
  $pajak = 35000;
  for ($i = 0; $i < count($dataHarga); $i++) {
    $subtotal += $dataHarga[$i] * $quantity[$i];
  }
  $grandtotal = $subtotal + $pajak;
?>
  <form action="/app/proses.php?aksi=buat-pesanan" method="post">
    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    <input type="hidden" name="jml" value="<?= $_POST['jml'] ?>">
    <div class="mb-5"></div>
    <div class="row">
      <div class="col-3 m-3">
        <h5>Alamat Pengiriman</h5>
        <div class="border border-arture-emas px-3 py-2">
          <p class="font-weight-bold"><?= $dataKlien['nama'] ?></p>
          <p><?= $dataKlien['alamat'] ?></p>
          <br>
          <p><?= $dataKlien['nomor_hp'] ?></p>
        </div>
      </div>
      <div class="col-3 m-3">
        <h5>Metode Pembayaran</h5>
        <div class="border border-arture-emas px-3 py-2">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="metode" id="metode1" value="transfer" checked>
            <label class="form-check-label" for="metode1">
              Transfer Bank
            </label>
          </div>

        </div>
      </div>
      <div class="col-4 m-3">
        <h5>Grand Total</h5>
        <div class="border border-arture-emas px-3 py-2">
          <div class="d-flex justify-content-between">
            <p class="font-weight-bold">Subtotal</p>
            <p class="font-weight-bold rupiah" id="subtotal"><?= $db->intToRupiah($subtotal) ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="font-weight-bold">Pajak</p>
            <p class="font-weight-bold rupiah" id="subtotal">Rp.0</p>
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