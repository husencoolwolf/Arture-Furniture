<?php
$dataProduk = $db->getDataProdukAdmin();
$dataKlien = $db->getDataKlienAdmin();
?>
<link href="/dist/dashboard.css" rel="stylesheet">

<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
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
        <h1 class="h2">Tambah Project</h1>
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
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Proyek]</div>';
        } else if ($_GET['error'] == "-2") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query detail_proyek]</div>';
        } else if ($_GET['error'] == "-3") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Item Proyek]</div>';
        } else if ($_GET['error'] == "-4") {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database : [Query Status Proyek]</div>';
        }
      }
      ?>
      <!--  -->
      <form id="formProject" action="/app/proses.php?aksi=tambah-project-admin" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputNamaProject">Nama Proyek<span class="text-danger">*</span></label>
          <input class="form-control" type="text" name="inputNamaProject" id="inputNamaProject" required>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label for="inputDimulai">Mulai Proyek<span class="text-danger">*</span></label>
            </div>
            <div class="col-6">
              <label for="inputSelesai">Deadline Proyek<span class="text-danger">*</span></label>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <input class="form-control" type="date" name="inputDimulai" id="inputDimulai" required>
            </div>
            <div class="col-6">
              <input class="form-control" type="date" name="inputSelesai" id="inputSelesai" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputLokasi">Lokasi Proyek<span class="text-danger">*</span></label>
          <input class="form-control" type="text" name="inputLokasi" id="inputLokasi" required>
        </div>
        <div class="form-group">
          <label for="inputAlamat">Alamat Proyek (Optional)</label>
          <textarea class="form-control" name="inputAlamat" id="inputAlamat" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <label for="inputNama">Nama Klien<span class="text-danger">*</span></label>
          <input class="form-control" type="text" name="inputNama" id="inputNama" required>
        </div>
        <div class="form-group">
          <label for="inputEmail">Email Klien (Optional)</label>
          <input class="form-control" type="email" name="inputEmail" id="inputEmail">
        </div>
        <div class="form-group">
          <label for="inputNope">Nomor HP Klien (Optional)</label>
          <input class="form-control" type="text" name="inputNope" id="inputNope">
        </div>

        <hr class="border-dark">
        <div class="border p-3 border-dark">

          <legend class="mb-4">Item Proyek</legend>

          <div class="form-group">
            <div class="row">
              <div class="col-4 text-center">
                <label for="inputItem">Item Proyek<span class="text-danger">*</span></label>
              </div>
              <div class="col-4 text-center">
                <label for="inputJumlah">Jumlah Item<span class="text-danger">*</span></label>
              </div>
              <div class="col-4 text-center">
                <label for="inputHarga">Harga Item<span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="row justify-content-between">
              <div class="col-4">
                <input type="text" name="inputItem" id="inputItem" class="form-control">
              </div>
              <div class="col-4">
                <input type="number" name="inputJumlah" id="inputJumlah" class="form-control" min="1">
              </div>
              <div class="col-4">
                <input type="text" name="inputHarga" id="inputHarga" class="form-control rupiah">
              </div>
            </div>
            <div class="row text-center my-2">
              <div class="col">
                <label for="inputKetItem">Keterangan Item<span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <textarea name="inputKetItem" id="inputKetItem" cols="30" rows="3" class="form-control"></textarea>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <button id="addListBtn" class="btn btn-primary w-100 font-weight-bold">Tambahkan ke List <span data-feather="arrow-down"></span></button>
              </div>
            </div>


          </div>


          <div class="form-group">
            <table class="table table-striped border" id="produkList" style="max-height: 16rem;">
              <thead>
                <th></th>
                <th>Nama Item</th>
                <th>Harga Item</th>
                <th>Qty</th>
                <th>Keterangan</th>
                <th>Jumlah Harga</th>
              </thead>
              <tbody>

              </tbody>
              <tfoot class="table-bordered thead-dark">
                <th class="text-center" colspan="5">Jumlah</th>
                <th id="grandTotal">Rp. 0</th>
              </tfoot>
            </table>
          </div>

          <input type="submit" class="btn btn-primary mb-4 bottom" value="Tambah Proyek">
        </div>
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
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/integer-to-rupiah.js"></script>