<?php
$dataProduk = $db->getDataProdukAdmin();
$dataKlien = $db->getDataKlienAdmin();
$detailPesanan = $db->getDetailPesananAdmin($_GET['pesanan']);
$dataPesanan = $db->getDataPesananAdminDetailed($_GET['pesanan']);
$grandTotal = 0;

?>
<link href="/dist/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="/dist/bootstrap-select/css/bootstrap-select.min.css">

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <!-- <img src="" class="rounded mr-2" alt="..."> -->
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Arture Furniture</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
  <div class="d-flex justify-content-between">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">
          <span data-feather="user" class="border rounded-circle"></span>
          <span><?= $_SESSION['username'] ?></span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="/logout.php">Sign out</a>
      </li>
    </ul>
  </div>

</nav>

<div class="container-fluid">
  <div class="row">
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/administrator-navbar.php';
    ?>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pesanan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <!-- <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div> -->
          <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button> -->
        </div>
      </div>


      <!-- <h2>daftar produk</h2> -->
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "-1") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Pesanan]</div>';
        } else if ($_GET['error'] == "-2") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Produk - produk]</div>';
        } else if ($_GET['error'] == "-3") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Status Awal]</div>';
        }
      }
      ?>
      <!--  -->
      <form id="formPesanan" action="/app/proses.php?aksi=edit-pesanan-admin" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="selectKlien">Klien<span class="text-danger">*</span></label>

          <select id="selectKlien" name="selectKlien" class="form-control selectpicker" data-live-search="true" title="-- Pilih Klien --">
            <?php
            while ($x = mysqli_fetch_assoc($dataKlien)) {
            ?>
              <option value="<?= $x['id_akun'] ?>" <?= ($x['id_akun'] == $dataPesanan['id_akun']) ? "selected" : "" ?>><?= $x['id_akun'] ?> | <?= $x['username'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="selectMetode">Metode<span class="text-danger">*</span></label>
          <select id="selectMetode" name="selectMetode" class="form-control selectpicker" required title="-- Metode Pembayaran --">
            <option value="transfer" <?= ($dataPesanan['metode'] == "transfer") ? "selected" : "" ?>>Transfer</option>
          </select>
        </div>
        <div class="form-group">
          <label for="selectStatus">Status<span class="text-danger">*</span></label>
          <select id="selectStatus" name="selectStatus" class="form-control selectpicker" required title="-- Status Pesanan --">
            <option value="menunggu info bank" <?= ($dataPesanan['status'] == "menunggu info bank") ? "selected" : "" ?>>1. Menunggu Info Bank</option>
            <option value="menunggu verifikasi bayar" <?= ($dataPesanan['status'] == "menunggu verifikasi bayar") ? "selected" : "" ?>>2. Menunggu Verifikasi Bayar</option>
            <option value="pembuatan" <?= ($dataPesanan['status'] == "pembuatan") ? "selected" : "" ?>>3. Pembuatan</option>
            <option value="pengiriman" <?= ($dataPesanan['status'] == "pengiriman") ? "selected" : "" ?>>4. Pengiriman</option>
            <option value="selesai" <?= ($dataPesanan['status'] == "selesai") ? "selected" : "" ?>>4. Selesai</option>
            <option value="batal" <?= ($dataPesanan['status'] == "batal") ? "selected" : "" ?>>-1. Batal</option>
          </select>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label for="selectProduk">Produk Pesanan<span class="text-danger">*</span></label>
            </div>
            <div class="col-2">
              <label for="inputJumlah">jumlah<span class="text-danger">*</span></label>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <select id="selectProduk" name="selectProduk" class="form-control selectpicker show-tick" data-live-search="true" title="-- Pilih Produk --" data-container="body">
                <?php
                while ($x = mysqli_fetch_assoc($dataProduk)) {
                ?>
                  <option value="<?= $x['id_produk'] ?>" data-content="<span><img src='/assets/produk/<?= $x['gambar'] ?>' class='img-preview-dropdown mr-2'><?= $x['nama_produk'] ?></span>" data-harga-produk="<?= $x['harga_produk'] ?>" data-gambar="<?= $x['gambar'] ?>"><?= $x['nama_produk'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="col-2">
              <input type="number" class="form-control h-100 border border-dark" name="inputJumlah" id="inputJumlah" max="10" min="1">

            </div>
            <div class="col-4">
              <button id="addListBtn" class="btn btn-dark h-100 font-weight-bold">Tambahkan ke List</button>
            </div>
          </div>

        </div>


        <div class="form-group">
          <table class="table table-striped border" id="produkList" style="max-height: 16rem;">
            <thead>
              <th></th>
              <th>gambar</th>
              <th>ID Produk</th>
              <th>Nama Produk</th>
              <th>Harga Produk</th>
              <th>Qty</th>
              <th>Jumlah Harga</th>
            </thead>
            <tbody>
              <?php
              while ($x = mysqli_fetch_assoc($detailPesanan)) {
              ?>
                <tr data-id="<?= $x['id_produk'] ?>">
                  <td>
                    <button class="btn btn-danger removeList"><span data-feather="x"></span></button>
                  </td>
                  <td><img src="/assets/produk/<?= $x['gambar'] ?>" class="img-preview-dropdown"></td>
                  <td><?= $x['id_produk'] ?></td>
                  <td><?= $x['nama_produk'] ?></td>
                  <td><?= $x['harga_produk'] ?></td>
                  <td><?= $x['jumlah'] ?></td>
                  <td><?= $db->intToRupiah((int)$x['harga_produk'] * (int)$x['jumlah']) ?></td>
                </tr>
              <?php
                $grandTotal += (int)$x['harga_produk'] * (int)$x['jumlah'];
              }
              ?>
            </tbody>
            <tfoot class="table-bordered thead-dark">
              <th class="text-center" colspan="6">Jumlah</th>
              <th id="grandTotal"><?= $db->intToRupiah($grandTotal) ?></th>
            </tfoot>
          </table>
        </div>

        <input type="submit" class="btn btn-primary mb-4 bottom" value="Edit Pesanan">
      </form>
    </main>
  </div>
</div>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="modalAddKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/app/proses.php?aksi=tambah-kategori" method="POST" enctype="multipart/form-data" id="formAddKategori">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="inputKategori">Nama Kategori</label>
            <input class="form-control border-dark" type="text" name="inputKategori" id="inputKategori">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Simpan">
        </div>
      </form>
    </div>
  </div>
</div>
<script src="/dist/js/feather.min.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>
<script src="/dist/js/integer-to-rupiah.js"></script>
<script src="/dist/js/url-param-getter.js"></script>
<script src="/dist/bootstrap-select/js/bootstrap-select.min.js"></script>