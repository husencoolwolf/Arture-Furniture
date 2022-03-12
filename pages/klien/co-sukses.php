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

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <!-- <img src="" class="rounded mr-2" alt="..."> -->
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">

  </div>
</div>

<div class="container">
  <div class="mb-4"></div>
  <div class="row justify-content-between">
    <div class="col-6">
      <p><strong>No.Pesanan</strong> : <?= $_GET['pesanan'] ?></p>
      <p><strong>Pemesan</strong> : <?= $dataKlien['nama'] ?></p>
      <p><strong>Tanggal</strong> : <?= $dataPesan['tanggal'] ?></p>
    </div>
    <div class="col-6">
      <p class="font-weight-bold">Tujuan Pengiriman :</p>
      <div>
        <p><?= $dataKlien['alamat'] ?></p>
        <p><?= $dataKlien['nomor_hp'] ?></p>
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
                <button class="w-100  btn btn-arture-emas font-weight-bolder mt-3" data-toggle="modal" data-target="#pembayaran">Bayar Sekarang</button>
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
<div class="modal fade" id="pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Input Info Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">

          <label for="selectKategori">Kategori<span class="text-danger">*</span></label>
          <select name="selectKategori" id="selectKategori" class="form-control mb-2" required>
            <option value="">--Pilih Bank--</option>
            <option value="bri">BRI</option>
            <option value="mandiri">Mandiri</option>
            <option value="bca">BCA</option>
            <option value="bni">BNI</option>
          </select>

          <div class="form-floating mb-3">
            <label for="inputNorek">No.Rekening</label>
            <input type="number" class="form-control" name="inputNorek" id="inputNorek" placeholder="No. Rekening Anda">
          </div>
          <div class="form-floating mb-3">
            <label for="inputNasabah">Nama Nasabah</label>
            <input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Example John Kenny">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="/?page=login"><button type="button" class="btn btn-primary">Login</button></a>
        <a href="/?page=daftar"><button type="button" class="btn btn-primary">Daftar</button></a>
      </div>
    </div>
  </div>
</div>

<script src="/dist/DataTables/datatables.min.js"></script>