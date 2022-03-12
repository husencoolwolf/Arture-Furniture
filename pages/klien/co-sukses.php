<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$data = $db->getDataKlien($_SESSION['id_akun']);
$dataPesanan = $db->getDetailPesanan($_GET['pesanan'], $_SESSION['id_akun']);
$dataKlien = array();
while ($x = mysqli_fetch_array($data)) {
  $dataKlien['nama'] = $x['nama'];
  $dataKlien['alamat'] = $x['alamat'];
  $dataKlien['nomor_hp'] = $x['nomor_hp'];
}
?>
<div class="container">
  <div class="mb-4"></div>
  <div class="row justify-content-between">
    <div class="col-6">
      <p><strong>No.Pesanan</strong> : <?= $_GET['pesanan'] ?></p>
      <p><strong>Pemesan</strong> : <?= $dataKlien['nama'] ?></p>
      <p><strong>Tanggal</strong> : Tanggal</p>
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
                <button class="w-100 btn btn-arture-emas font-weight-bolder mt-3">Bayar Sekarang</button>
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

<script src="/dist/DataTables/datatables.min.js"></script>