<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$dataProduk = $db->getDataProduk();
$dataKategori = $db->getDataKategori();
if (isset($_GET['cari'])) {
  $dataProduk = $db->getDataProdukCariSearch($_GET['cari']);
} elseif (isset($_GET['kategori'])) {
  $dataProduk = $db->getDataProdukCariKategori($_GET['kategori']);
}
?>
<script src="/dist/js/pages/klien-navbar.js"></script>
<div>
  <!-- Jumbotron -->
  <div class="jumbotron">
    <div class="spaces">
      <strong>
        <h1 id="quote">BUILD YOUR DREAM HOME TODAY</h1>
      </strong>
      <p class="lead">
        <a class="btn bg-emas-arture btn-lg" href="https://api.whatsapp.com/send?phone=6287888525264" target="_blank" role="button"><strong>Get Free Estimate</strong></a>
      </p>
    </div>

  </div>


  <!-- Cari Produk -->
  <section id="catalog">
    <div class="mb-4 w-100 d-flex align-content-end bg-light">
      <form action="" method="get">
        <div class="input-group cariProduk-input-grup mt-3 ml-3 mr-3">

          <input type="search" class="form-control border-arture-coklat" name="cari" id="cariProduk" aria-label="Searching" placeholder="Cari Produk">
          <div class="input-group-append">
            <button type="submit" class="input-group-text btn"><i class="fa fa-search" aria-hidden="true"></i></button>
          </div>

        </div>
      </form>
    </div>
    <div class="row w-100">
      <div class="col-lg-2 d-none d-lg-block p-0 mx-auto">
        <div class="list-group">
          <?php

          if ($dataKategori == false) {
          ?>
            <tr>
              <td>
                <div class="alert alert-danger">KATEGORI BELUM TERSEDIA, HARAP PERIKSA KEMBALI NANTI!</div>
              </td>
            </tr>
            <?php
          } else {
            while ($x = mysqli_fetch_array($dataKategori)) {
            ?>
              <a href="/?kategori=<?= $x['kategori'] ?>#catalog" class="list-group-item list-group-item-action"><?= $x['kategori'] ?></a>
          <?php
            }
          }
          ?>
        </div>
      </div>
      <div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
        <div class="row w-100">


          <?php

          if (isset($_GET['cari']) && $dataProduk == false) {
          ?>
            <tr>
              <td>
                <div class="alert alert-danger w-100 text-center"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                  MAAF, PRODUK YANG ANDA CARI SAAT INI BELUM TERSEDIA.</div>
              </td>
            </tr>
          <?php
          } elseif ($dataProduk == false) {
          ?>
            <tr>
              <td>
                <div class="alert alert-danger">STOK BELUM TERSEDIA, HARAP PERIKSA KEMBALI NANTI!</div>
              </td>
            </tr>
            <?php
          } else {
            while ($x = mysqli_fetch_array($dataProduk)) {
            ?>
              <div class="col-lg-4 col-md-4 col-sm-6 mb-3 justify-content-center">
                <a class="text-decoration-none text-dark" href="/?page=produk&produk=<?= $x['id_produk'] ?>">
                  <div class="card">
                    <img src="/assets/produk/<?= $x['gambar'] ?>" class="card-img-top img-fluid" alt="<?= $x['nama_produk'] ?>">
                    <div class="card-body">
                      <p class="card-title font-weight-bold productName"><?= $x['nama_produk'] ?></p>
                      <p class="font-weight-bold productPrice"><?= $db->intToRupiah($x['harga_produk']) ?></p>

                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>

</div>
<button type="button" id="waContact" class="btn btn-white bg-white border rounded-circle p-0">
  <span class="fa fa-whatsapp fa-3x text-success text-center" role="button">
  </span>
</button>