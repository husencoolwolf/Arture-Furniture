<?php
$dataPesanan = $db->getDataPesananKlien($_SESSION['id_akun']);
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
?>

<script src="/dist/js/pages/klien-navbar.js"></script>

<div class="container">
  <div class="row">



    <main role="main" class="col-md">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profil</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>


      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == -1) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query Akun Database</div>';
        } elseif ($_GET['error'] == -2) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query Detail Akun Database</div>';
        }
      }
      ?>
      <table class="table table-bordered table-warning table-hover" id="tabelPesanan">
        <thead class="bg-arture-emas" style="background-color: #ffd966;">
          <th>Gambar</th>
          <th>Nama Pesanan</th>
          <th>Jml Pesanan</th>
          <th>Harga</th>
          <th>Status</th>
        </thead>
        <tbody>

        </tbody>
      </table>
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
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>