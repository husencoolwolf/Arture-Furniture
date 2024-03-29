<?php
$dataProduk = $db->getDataProdukAdmin();
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
        <h1 class="h2">Products</h1>
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
      <div class="table-responsive my-3">

        <table class="table table-striped table-sm table-bordered" id="tabelProduk">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID Produk</th>
              <th class="text-center">Gambar</th>
              <th class="text-center">Nama Produk</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center">Tersedia</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!$dataProduk) {
            ?>
              <tr>
                <td class="text-center alert-danger" colspan="100%">Belum Ada Produk</td>
              </tr>
              <?php
            } else {
              while ($x = mysqli_fetch_array($dataProduk)) {
              ?>
                <tr>
                  <td><?= $x['id_produk'] ?></td>
                  <td><img src="/assets/produk/<?= $x['gambar'] ?>" width="100px" height="100px"></td>
                  <td><?= $x['nama_produk'] ?></td>
                  <td><?= $x['kategori'] ?></td>
                  <td><?= $db->intToRupiah($x['harga_produk']) ?></td>
                  <td><?= $x['deskripsi'] ?></td>
                  <td class="text-center">
                    <?php
                    if ($x['tersedia'] == "1") {
                      echo ("Ya");
                    } else {
                      echo ("Tidak");
                    }
                    ?>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<script src="/dist/js/feather.min.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>