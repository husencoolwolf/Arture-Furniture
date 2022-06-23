<?php
$dataAkun = $db->getDataAkunAdmin();
?>
<link href="/dist/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="/dist/css/misc/loading.css">


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

<!-- Modal -->
<div class="modal fade" id="detailAkunModal" tabindex="-1" role="dialog" aria-labelledby="detailAkunModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailAkunModalLabel">Detail Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <div class="lds-ring">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <div class="modal-isi text-left">
          <div class="table-responsive">
            <table id="table-detail-akun" class="table table-sm w-100" style="max-width: none !important;">
              <tr>
                <td>ID Akun</td>
                <td>: <span data-setter="idAkun"></span></td>
              </tr>
              <tr>
                <td>Username</td>
                <td>: <span data-setter="usernameAkun"></span></td>
              </tr>

              <tr>
                <td>Nama</td>
                <td>: <span data-setter="namaAkun"></span></td>
              </tr>
              <tr>
                <td>Password</td>
                <td>: <span data-setter="passwordAkun"></span></td>
              </tr>
              <tr>
                <td>Privilege</td>
                <td>: <span data-setter="privilegeAkun"></span></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>: <span data-setter="alamatAkun"></span></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>: <span data-setter="emailAkun"></span></td>
              </tr>
              <tr>
                <td>Nomor HP</td>
                <td>: <span data-setter="nope"></span></td>
              </tr>

            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- end of modal -->

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
        <h1 class="h2">Accounts</h1>
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
        switch ($_GET['error']) {
          case '-1':
            echo ("<div class='alert alert-danger'>ERROR : Terjadi kesalahan pada proses database!</div>");
            break;
        }
      }
      ?>
      <div class="table-responsive my-3">
        <a href="/?page=tambah-akun">
          <button class="btn btn-dark">Tambah Data</button>
        </a>
        <table class="table table-striped table-sm table-bordered" id="tabelAkun">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID Akun</th>
              <th class="text-center">Username</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Privilege</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!$dataAkun) {
            ?>
              <tr>
                <td class="text-center alert-danger" colspan="100%">Belum Ada Akun</td>
              </tr>
              <?php
            } else {
              while ($x = mysqli_fetch_array($dataAkun)) {
              ?>
                <tr>
                  <td><?= $x['id_akun'] ?></td>
                  <td><?= $x['username'] ?></td>
                  <td><?= $x['nama'] ?></td>
                  <td><?= $x['nama_hak_akses'] ?></td>
                  <td class="text-center" data-id="<?= $x['id_akun'] ?>">
                    <a href="/?page=edit-akun&akun=<?= $x['id_akun'] ?>" class="btn btn-success btn-sm">
                      <span data-feather="edit"></span>
                    </a>
                    <a href="" data-id="<?= $x['id_akun'] ?>" class="btn btn-danger btn-sm hapusBtn">
                      <span data-feather="trash"></span>
                    </a>
                    <a href="" class="btn btn-dark btn-sm detailBtn" data-id="<?= $x['id_akun'] ?>" data-toggle="modal" data-target="#detailAkunModal">
                      <span data-feather="eye"></span>
                    </a>
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