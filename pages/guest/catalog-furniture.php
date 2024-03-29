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
    <div class="row">
      <div class="d-none d-lg-block col-lg-2 p-0 mx-auto">
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
        <div class="row">


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
              <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                <a class="text-decoration-none text-dark" href="/?page=produk&produk=<?= $x['id_produk'] ?>">
                  <div class="card h-100 border-dark">
                    <img src="/assets/produk/<?= $x['gambar'] ?>" class="card-img-top" alt="<?= $x['nama_produk'] ?>">
                    <div class="card-body">
                      <h4 class="card-title font-weight-bold"><?= $x['nama_produk'] ?></h4>
                      <p class="font-weight-bold"><?= $db->intToRupiah($x['harga_produk']) ?></p>

                    </div>
                    <div class="card-footer">
                      <p class="card-text"><?= $x['deskripsi'] ?></p>
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

<button type="button" id="waContact" class="btn btn-white border rounded-circle p-0">
  <span class="fa fa-whatsapp fa-3x text-success text-center" role="button">
  </span>
</button>