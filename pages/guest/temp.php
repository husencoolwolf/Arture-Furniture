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