<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$data = $db->getDataKlien($_SESSION['id_akun']);
$dataPesan = $db->getDataPesanan($_GET['pesanan'], $_SESSION['id_akun']);
$dataPesanan = $db->getDetailPesanan($_GET['pesanan'], $_SESSION['id_akun']);
$dataKlien = array();
while ($x = mysqli_fetch_array($data)) {
  $dataKlien['nama'] = $x['nama'];
  $dataKlien['alamat'] = $x['alamat'];
  $dataKlien['nomor_hp'] = $x['nomor_hp'];
}
?>
<link rel="stylesheet" href="/dist/css/skeleton-placeholder.css">

<script src="/dist/js/url-param-getter.js"></script>


<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="20000">
  <div class="toast-header">
    <!-- <img src="" class="rounded mr-2" alt="..."> -->
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">

  </div>
</div>

<!-- Modal Alasan Batal -->
<div class="modal fade" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form data-id="<?= $_GET['pesanan'] ?>" id="formBatalPesanan" action="/app/proses.php?aksi=update-status-pesanan" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Alasan Batal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select class="form-control" name="inputAlasan" id="inputAlasan" required>
              <option value="" disabled selected>-- Alasan dibatalkan --</option>
              <option value="Ingin mengubah pesanan">Ingin mengubah pesanan</option>
              <option value="Tidak bisa melanjutkan pembayaran">Tidak bisa melanjutkan pembayaran</option>
              <option value="Tertarik dengan barang dari toko lain">Tertarik dengan barang dari toko lain</option>
              <option value="Tidak ingin membeli lagi">Tidak ingin membeli lagi</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Batalkan pesanan">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="info-warning">

</div>

<div class="container">
  <div class="mb-4"></div>
  <div class="row justify-content-between">
    <div class="col-6">
      <p><strong>No.Pesanan</strong> : <span class="pesanan-data" data-type="noPesanan">-</span></p>
      <p><strong>Pemesan</strong> : <span class="pesanan-data" data-type="namaPemesan">-</span></p>
      <p><strong>Tanggal</strong> : <span class="pesanan-data" data-type="tanggalPesanan">-</span></p>
      <p><strong>Status</strong> : <span class="pesanan-data" data-type="statusPesanan">-</span></p>
    </div>
    <div class="col-6">
      <p class="font-weight-bold">Tujuan Pengiriman :</p>
      <div>
        <p><span class="pesanan-data" data-type="alamat">-</span></p>
        <p><span class="pesanan-data" data-type="nope">-</span></p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="table-responsive my-3">
      <table class="table w-100" id="dataProduk">
        <thead class="bg-arture-emas text-white">
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga Barang</th>
          <th>Subtotal</th>
        </thead>
        <tbody>
          <?php
          if ($dataPesanan == "-1") {
          ?>
            <script>
              alert("Maaf pesanan yang anda cari tidak ditemukan");
              window.location.href = "/";
            </script>
          <?php
          } elseif (!$dataPesanan) {
          ?>
            <tr>
              <td class="w-100 alert alert-warning">Error Data Pesanan tidak memiliki barang!</td>
            </tr>
            <?php
          } else {
            $grandtotal = 0;
            $ongkir = 35000;
            while ($x = mysqli_fetch_array($dataPesanan)) {
              $subtotal = (int)$x['harga_produk'] * (int)$x['jumlah'];
              $grandtotal += $subtotal;
            ?>
              <tr>
                <td><img class="produk-thumbnail" src="/assets/produk/<?= $x['gambar'] ?>" alt="<?= $x['nama_produk'] ?>"></td>
                <td><?= $x['nama_produk'] ?></td>
                <td><?= $x['jumlah'] ?></td>
                <td><?= $db->intToRupiah((int)$x['harga_produk']) ?></td>
                <td><?= $db->intToRupiah($subtotal) ?></td>
              </tr>
            <?php
            }
            ?>
            <tr>
              <td colspan="5" class="">
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">Subtotal Barang : </p>
                  <p class="font-weight-bold"><?= $db->intToRupiah($grandtotal) ?></p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">Ongkos Kirim : </p>
                  <p class="font-weight-bold"><?= $db->intToRupiah($ongkir) ?></p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">Grand Total : </p>
                  <p class="font-weight-bold"><?= $db->intToRupiah($grandtotal + $ongkir) ?></p>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <button class="w-100  btn btn-arture-emas font-weight-bolder mt-3 actionBtn animated-background" data-toggle="modal" data-target="" disabled></button>

                <button class="w-100  btn btn-danger font-weight-bolder mt-3 actionBtn animated-background" data-toggle="modal" data-target="#modalBatal" disabled></button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- Modal -->
<form action="" method="post" id="formBayar">
  <div class="modal fade" id="pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content pembayaran">
        <div class="modal-header bg-arture-emas">
          <h5 class="modal-title" id="exampleModalLabel">Input Info Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-floating mb-3">
            <label for="selectBank">Bank<span class="text-danger">*</span></label>
            <select name="selectBank" id="selectBank" class="form-control mb-2" required>
              <option value="">--Pilih Bank--</option>
              <option value="bri">BRI</option>
              <option value="mandiri">Mandiri</option>
              <option value="bca">BCA</option>
              <option value="bni">BNI</option>
            </select>
          </div>
          <div class="form-floating mb-3">
            <label for="inputNorek">No.Rekening<span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="inputNorek" id="inputNorek" placeholder="No. Rekening Anda" required>
          </div>
          <div class="form-floating mb-3">
            <label for="inputNasabah">Nama Nasabah<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="inputNasabah" id="inputNasabah" placeholder="Example John Kenny" required>
          </div>
          <div class="d-flex alert alert-info justify-content-between mb-3">
            <p class="font-weight-bolder">Total Tagihan : </p>
            <p class="font-weight-bolder"><?= $db->intToRupiah(($grandtotal + $ongkir)) ?></p>
          </div>
          <div class="alert alert-info mb-3">
            <p class="font-weight-bolder">Harap tambahkan No.Pesanan di berita transaksi</p>
            <div class="">
              <p id="targetSalin"><?= $_GET['pesanan'] ?></p>
              <div class="btn btn-light btn-sm" data-clipboard-action="copy" data-clipboard-target="#targetSalin" id="salinKode">Salin Kode</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <input id="submitModal" class="btn btn-primary" type="submit" value="">
          <button class="hide btn btn-success" id="konfirmasiBtn">Barang telah diterima</button>
        </div>
      </div>
    </div>
  </div>
</form>


<script src="/dist/js/url-param-getter.js"></script>
<script src="/dist/js/copyToClipboard.js"></script>
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>