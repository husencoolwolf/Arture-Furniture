<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/guest-navbar.php';
$dataProduk = $db->getDataProduk();
$dataKategori = $db->getDataKategori();
if (isset($_GET['cari'])) {
  $dataProduk = $db->getDataProdukCariSearch($_GET['cari']);
} elseif (isset($_GET['kategori'])) {
  $dataProduk = $db->getDataProdukCariKategori($_GET['kategori']);
}
?>
<script src="/dist/js/pages/guest-navbar.js"></script>
<div>

  <div class="row bg-kuning text-center">
    <div class="garis-kuning bg-dark"></div>

    <div class="col my-3">
      <h1 class="">DAFTAR HARGA</h1>
    </div>
    <div class="garis-kuning bg-dark"></div>

  </div>
  <div class="container">

    <div class="row py-3" id="daftarHarga">
      <div class="col-8">
        <table class="table table-sm">
          <tbody>
            <tr>
              <td>
                <p class="font-weight-bolder">Konsultasi</p>
              </td>
              <td>
                <p>: Rp. 60.000 / meter persegi (Diatas 90 m2 Discount)</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Pengurusan Surat Izin Membangun</p>
              </td>
              <td>
                <p>: Rp. 4.000.000 / Properti</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Rumah Standard (1 Lantai)</p>
              </td>
              <td>
                <p>: Rp. 4.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Rumah Premium (2 Lantai)</p>
              </td>
              <td>: Rp. 5.000.000 / meter persegi</td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Rumah Gaya American Classic</p>
              </td>
              <td>
                <p>: Rp. 6.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Full Renovasi Rumah</p>
              </td>
              <td>
                <p>: Rp. 4.200.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Buat Ruangan</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Cluster / Perumahan</p>
              </td>
              <td>
                <p>: Rp. 4.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Kolam Renang</p>
              </td>
              <td>
                <p>: Rp. 3.700.000 / meter kubik</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Taman / Landscape</p>
              </td>
              <td>
                <p>: Rp. 300.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Atap</p>
              </td>
              <td>
                <p>: Rp. 200.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Plafond</p>
              </td>
              <td>
                <p>: Rp. 200.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Railing / Hand Railing Tangga</p>
              </td>
              <td>
                <p>: Rp. 300.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Pengecatan</p>
              </td>
              <td>
                <p>: Rp. 40.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Pintu Garasi</p>
              </td>
              <td>
                <p>: Rp. 1.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Pintu & Jendela</p>
              </td>
              <td>
                <p>: Rp. 1.000.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Batu susun lantai garasi</p>
              </td>
              <td>
                <p>: Rp. 250.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Bata Roster</p>
              </td>
              <td>
                <p>: Rp. 500.000 / meter persegi</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <div class="col-lg-4 sideTable">
        <div class="sideTableContent mb-4">
          <p class="font-weight-bolder mb-2">Bahan yang digunakan :</p>
          <p>Multiplek / Blockboard</p>
          <p>Finishing HPL</p>
          <p>Engsel slowmotion</p>
          <p>Rel double track</p>
        </div>
        <div class="sideTableContent mb-3">
          <p class="font-weight-bolder mb-2">Bonus kitchen set :</p>
          <p>Rak piring</p>
          <p>Rak sendok</p>
          <p>Laci roda untuk kabinet area tabung gas</p>
        </div>


      </div> -->


    </div>
  </div>

  <div class="row">
    <div class="full-layar-img px-2">
      <img src="/assets/material/orderproses2.jpg" class="img-fluid" alt="">
    </div>
  </div>

  <!-- <div style="height: 1000px;"></div> -->




</div>



<!-- Modal -->
<div class="modal fade" id="warningPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Maaf!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Harap untuk login / daftar untuk dapat memesan atau menggunakan keranjang
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="/?page=login"><button type="button" class="btn btn-primary">Login</button></a>
        <a href="/?page=daftar"><button type="button" class="btn btn-primary">Daftar</button></a>
      </div>
    </div>
  </div>
</div>

<button type="button" id="waContact" class="btn btn-white bg-white border rounded-circle p-0">
  <span class="fa fa-whatsapp fa-3x text-success text-center" role="button">
  </span>
</button>