<?php
$dataHakAkses = $db->getDataHakAksesAdmin();
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
        <h1 class="h2">Tambah Akun</h1>
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


      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == -1) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query database</div>';
        } elseif ($_GET['error'] == 1062) {
          echo '<div class="alert alert-danger">Username Sudah digunakan</div>';
        }
      }
      ?>
      <form id="formInput" action="/app/proses.php?aksi=daftar-akun-admin" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <label for="inputNama">Name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Example John Kenny">
        </div>
        <div class="form-floating mb-3">
          <label for="inputUsername">Username<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="john123">
        </div>
        <div class="form-floating mb-3">
          <label for="inputPassword">Password<span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
        </div>
        <div class="form-floating mb-3">
          <label for="selectHakAkses">Privilege / Hak Akses<span class="text-danger">*</span></label>
          <select id="selectHakAkses" name="selectHakAkses" class="form-control selectpicker" required title="-- Privilege / Hak Akses --">
            <?php
            while ($x = mysqli_fetch_assoc($dataHakAkses)) {
            ?>
              <option value="<?= $x['id_hak_akses'] ?>"><?= $x['id_hak_akses'] ?>. <?= $x['nama_hak_akses'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-floating mb-3">
          <label for="inputAlamat">Address</label>
          <textarea class="form-control" name="inputAlamat" id="inputAlamat" rows="4" placeholder="Your Addressx"></textarea>
        </div>
        <div class="form-floating mb-3">
          <label for="inputEmail">Email address</label>
          <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="name@example.com">
        </div>
        <div class="form-floating mb-3">
          <label for="inputNope">Phone Number</label>
          <input type="number" class="form-control" name="inputNope" id="inputNope" placeholder="08xxxxxxxx">
        </div>

        <input type="submit" class="btn btn-primary mb-4" value="Tambah Akun">
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
<script src="/dist/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/dist/js/integer-to-rupiah.js"></script>