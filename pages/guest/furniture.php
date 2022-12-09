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
                <p class="font-weight-bolder">Kitchen Set</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Kabinet Pakaian</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Kabinet Pajangan</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Nakas</p>
              </td>
              <td>: Rp. 500.000 / meter</td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Meja Kerja</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Meja Rias</p>
              </td>
              <td>
                <p>: Rp. 1.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Meja Tamu</p>
              </td>
              <td>
                <p>: Rp. 1.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Dipan / Tempat tidur laci</p>
              </td>
              <td>
                <p>: Rp. 2.000.000</p>
              </td>
            </tr>
            <tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Partisi Ruangan</p>
              </td>
              <td>
                <p>: Rp. 2.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Backdrop TV / Backdrop dipan</p>
              </td>
              <td>
                <p>: Rp. 1.000.000 / meter</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Lantai Vinyl Kayu</p>
              </td>
              <td>
                <p>: Rp. 250.000 / meter persegi</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Wallpaper</p>
              </td>
              <td>
                <p>: Rp. 250.000 / rol</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Sofa</p>
              </td>
              <td>
                <p>: Rp. 1.500.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Kasur</p>
              </td>
              <td>
                <p>: Rp. 3.000.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Karpet</p>
              </td>
              <td>
                <p>: Rp. 200.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Bed Cover</p>
              </td>
              <td>
                <p>: Rp. 500.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Bantal Sofa</p>
              </td>
              <td>
                <p>: Rp. 100.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Cermin</p>
              </td>
              <td>
                <p>: Rp. 300.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Gordyn</p>
              </td>
              <td>
                <p>: Rp. 500.000</p>
              </td>
            </tr>
            <tr>
              <td>
                <p class="font-weight-bolder">Vas Bunga</p>
              </td>
              <td>
                <p>: Rp. 50.000</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-lg-4 sideTable">
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


      </div>


    </div>
  </div>

  <div class="row">
    <div class="full-layar-img px-2">
      <img src="/assets/material/orderproses.jpg" class="img-fluid" alt="">
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