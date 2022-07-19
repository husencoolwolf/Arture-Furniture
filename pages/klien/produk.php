<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$detailProduk = $db->getDetailProduk($_GET['produk']);
if ($detailProduk <> false) {
  while ($x = mysqli_fetch_array($detailProduk)) { ?>
    <script src="/dist/js/url-param-getter.js"></script>
    <script src="/dist/js/jquery.redirect.js"></script>
    <!-- toast -->
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

    <div class="mb-4"></div>

    <div class="row">
      <div class="col-lg-8 mb-4">
        <div class="row mx-auto">
          <img src="/assets/produk/<?= $x['gambar'] ?>" class="mx-auto produk" alt="Responsive image">
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="container">
          <div id="info-produk" class="border border-secondary mr-4">

            <div class="text-white text-center bg-arture-emas p-4" id="header-info-produk">
              <h4 class=""><?= $x['nama_produk'] ?></h4>
            </div>
            <div class="container">
              <div>
                <table class="w-100">
                  <tr>
                    <td class="text-right" colspan="2">
                      <h4 class="text-danger font-weight-bold"><?= $ctr->intToRupiah($x['harga_produk']) ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>Kategori</td>
                    <td>: <?= $x['kategori'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?= $x['deskripsi'] ?></td>
                  </tr>
                </table>
              </div>
              <div class="mb-4"></div>
              <div class="order-tab">
                <div class="btn bg-arture-emas quantity-control" id="minus-quantity"><i class="fa fa-minus" aria-hidden="true"></i></div>
                <span>
                  <input type="number" name="quantity" id="quantity" class="input text-center " style="width: 40px;line-height: 32px;" value="1" min="1" max="10">
                </span>

                <div class="btn bg-arture-emas quantity-control" id="plus-quantity"><i class="fa fa-plus" aria-hidden="true"></i></div>
                <div class="mb-4"></div>
                <div class="row">
                  <div class="col">
                    <div class="border rounded bg-arture-emas p-2 text-center text-white ">
                      <div class="mx-auto"><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></div>
                      <div class="mx-auto">2 Hari Pengiriman</div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="border rounded bg-arture-emas p-2 text-center text-white ">
                      <i class="fa fa-wrench fa-2x" aria-hidden="true"></i>
                      <div class="mx-auto">2 Hari Produksi</div>
                    </div>
                  </div>
                </div>
                <hr>

                <div class="mb-4"></div>
                <div data-produk="<?= $_GET['produk'] ?>" class="btn btn-secondary w-100" id="orderBtn">
                  Pesan Sekarang
                </div>
                <div class="mb-2"></div>
                <div class="btn btn-secondary w-100" id="keranjangBtn">
                  Masukkan Keranjang
                </div>
                <div class="mb-2"></div>

              </div>
            </div>
          </div>
        </div>
      </div>
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
<?php
  }
} else {
  echo "<h1>Maaf Data yang anda cari tidak ditemukan / tidak tersedia.</h1><br>
        <a class='btn btn-dark' href='/'>Kembali</a>";
}

?>