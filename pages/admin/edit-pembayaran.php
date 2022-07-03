<?php
$dataPembayaran = $db->getDataPembayaranDetail($_GET['pembayaran']);
if ($dataPembayaran) {
  $dataPembayaran = mysqli_fetch_assoc($dataPembayaran);
}
?>
<link href="/dist/dashboard.css" rel="stylesheet">

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
<?php
if (!$dataPembayaran) {
?>
  <script>
    alert("Data pembayaran tidak ditemukan");
    window.location.replace("/");
  </script>
<?php
}
?>
<div class="container-fluid">
  <div class="row">
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/administrator-navbar.php';
    ?>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Produk</h1>
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
        if ($_GET['error'] == 1) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database</div>';
        } else {
          echo '<div class="alert alert-danger">Gambar Gagal diupload!!</div>';
        }
      }
      ?>
      <form action="/app/proses.php?aksi=edit-pembayaran-admin&id=<?= $_GET['pembayaran'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="selectPesanan">Pesanan<span class="text-danger">*</span></label>
          <select id="selectPesanan" name="selectPesanan" class="form-control selectpicker" required title="-- Pesanan --" data-live-search="true" disabled>
            <option value="<?= $dataPembayaran['id_pesanan'] ?>" selected><?= $dataPembayaran['id_pesanan'] ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="selectBank">Bank Pemilik<span class="text-danger">*</span></label>
          <select id="selectBank" name="selectBank" class="form-control selectpicker" required title="-- Bank Pemilik --">
            <option value="bri" <?= ($dataPembayaran['bank_pemilik'] == "bri") ? "selected" : "" ?>>BRI</option>
            <option value="mandiri" <?= ($dataPembayaran['bank_pemilik'] == "mandiri") ? "selected" : "" ?>>Mandiri</option>
            <option value="bca" <?= ($dataPembayaran['bank_pemilik'] == "bca") ? "selected" : "" ?>>BCA</option>
            <option value="bni" <?= ($dataPembayaran['bank_pemilik'] == "bni") ? "selected" : "" ?>>BNI</option>
          </select>
        </div>

        <div class="form-group">
          <label for="inputNama">Nama Pemilik<span class="text-danger">*</span></label>
          <input class="form-control" type="text" name="inputNama" id="inputNama" value="<?= $dataPembayaran['nama_pemilik'] ?>" required>
        </div>

        <div class="form-group">
          <label for="inputNorek">Nomer Rekening<span class="text-danger">*</span></label>
          <input class="form-control" type="text" name="inputNorek" id="inputNorek" value="<?= $dataPembayaran['no_rekening'] ?>" required>
        </div>

        <input type="submit" class="btn btn-primary mb-4" value="Edit Produk">
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