<?php
$dataProject = $db->getDataProjectAdmin();
?>
<link href="/dist/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="/dist/css/misc/loading.css">
<link rel="stylesheet" href="/dist/fullcalendar-3.10.5/fullcalendar.min.css">
<!-- <link rel="stylesheet" href="/dist/fullcalendar-3.10.5/fullcalendar.print.min.css"> -->





<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
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
<div class="modal fade" id="detailProjectModal" tabindex="-1" role="dialog" aria-labelledby="detailProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailProjectModalLabel">Detail Proyek</h5>
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
            <table id="table-detail-proyek" class="table table-sm w-100" style="max-width: none !important;">
              <tr>
                <td></td>
              </tr>
              <tr>
                <td>ID Project</td>
                <td>: <span data-setter="idProject"></span></td>
              </tr>
              <tr>
                <td>Nama Proyek</td>
                <td>: <span data-setter="namaProyek"></span></td>
              </tr>
              <tr>
                <td>Lokasi Proyek</td>
                <td>: <span data-setter="lokasiProyek"></span></td>
              </tr>
              <tr>
                <td>Tanggal Input</td>
                <td>: <span data-setter="tanggalInput"></span></td>
              </tr>
              <tr>
                <td>tgl Mulai / Deadline</td>
                <td>: <span data-setter="tanggalProyek"></span></td>
              </tr>
              <tr class="bg-dark text-white">
                <td class="align-middle">Detail Proyek</td>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#detailProject" aria-expanded="false" aria-controls="detailProject">Lihat Detail <span data-feather="chevron-down"></span></button></td>

              </tr>
              <tr class="collapse" id="detailProject">
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-dark table-striped">
                    <tr>
                      <td class="align-middle">Nama Klien</td>
                      <td>: <span data-setter="namaKlien"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Lokasi</td>
                      <td>: <span data-setter="lokasiProyek"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Alamat</td>
                      <td>: <span data-setter="alamatKlien"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">E-mail</td>
                      <td>: <span data-setter="emailKlien"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Nomor Hp/Telp</td>
                      <td>: <span data-setter="nopeKlien"></span></td>
                    </tr>

                  </table>
                </td>
              </tr>

              <tr>
                <td>Status</td>
                <td>: <span data-setter="statusProyek"></span></td>
              </tr>
              <tr>
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-light table-striped my-2" id="tabelDetailProdukProject">
                    <thead class="thead-dark">
                      <th>Nama Item</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <th>Harga Item</th>
                      <th>Status</th>
                      <th>Ket</th>
                    </thead>
                    <tbody>
                      <tr></tr>
                    </tbody>
                    <tfoot class="thead-dark">
                      <th colspan="3">Total</th>
                      <th colspan="3"><span data-setter="grandTotal"></span></th>
                    </tfoot>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div>
          <button type="button" class="btn btn-info" id="updateStatus" data-toggle="modal" data-target="#modalUpdateStatus">Update Status Project</button>
          <button type="button" class="btn btn-danger" id="updateStatus" data-toggle="modal" data-target="#modalBatal">Batalkan Project</button>
        </div>
        <div>
          <button data-id="" class="my-1 h-100 btn btn-primary btn-sm modalAction cetakBtn">
            <span data-feather="download"></span>
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Update Status -->
<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Status Project Akan diupdate!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="w-100 font-weight-bold">
          <tr>
            <td style="border: 1px solid black; padding: 2px">
              <span data-setter="statusSebelum"></span>
            </td>
            <td class="text-center">
              ========>>
            </td>
            <td style="border: 1px solid black; padding: 2px">
              <span data-setter="statusSesudah"></span>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="konfirmasiUpdate">Simpan Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Alasan Batal -->
<div class="modal fade" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="formBatalProject" action="/app/proses.php?aksi=update-status-project" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Alasan Batal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input class="form-control" type="text" name="inputAlasan" id="inputAlasan">
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Simpan Update">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal update progress produksi -->
<div class="modal fade" id="modalUpdateProgress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Progress Produksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body overflow-auto">
        <table class="w-100 table table-bordered table-info" id="tabelUpdateSurvey">
          <thead class="thead-dark">
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Keterangan</th>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <th colspan="2">Total</th>
            <th><span data-setter="produksiGrandTotal"></span></th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="konfirmasiUpdateProduksi">Simpan Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
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
        <h1 class="h2">Projects</h1>
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

      <div class="table-responsive my-3 overflow-hidden">
        <a href="/?page=tambah-project">
          <button class="btn btn-dark">Tambah Data</button>
        </a>
        <hr>


        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label class="form-check-label" for="tanggalDari">Dari</label>
              <input class="form-control filterTabel" type="date" name="tanggalDari" id="tanggalDari" placeholder="Tanggal Dari">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-check-label" for="tanggalSampai">Sampai</label>
              <input class="form-control filterTabel" type="date" name="tanggalSampai" id="tanggalSampai" placeholder="Tanggall Sampai">
            </div>
          </div>
        </div>
        <table class="table table-striped table-sm table-bordered" id="tabelProject">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID Project</th>
              <th class="text-center">Nama Proyek</th>
              <th class="text-center">Nama Klien</th>
              <th class="text-center">Mulai</th>
              <th class="text-center">Deadline</th>
              <th class="text-center">Lokasi</th>
              <th class="text-center">Status</th>
              <th class="text-center">aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!$dataProject) {
            ?>
              <tr>
                <td class="text-center alert-danger" colspan="100%">Belum Ada Project</td>
              </tr>
              <?php
            } else {
              while ($x = mysqli_fetch_assoc($dataProject)) {
              ?>
                <tr>
                  <td><?= $x['id_proyek'] ?></td>
                  <td><?= $x['nama_proyek'] ?></td>
                  <td><?= $x['nama_klien'] ?></td>
                  <td><?= date("Y-m-d", strtotime($x['dimulai'])) ?></td>
                  <td><?= date("Y-m-d", strtotime($x['target_selesai'])) ?></td>
                  <td><?= $x['lokasi'] ?></td>
                  <?php
                  $stat = $db->projectStatusOrder($x['status'], $x['id_proyek']);
                  if ($x['status'] == "proses produksi") {
                    echo ('<td class="text-center"><span class="badge badge-pill badge-' . $stat["warna"] . '">' . $stat['status'] . ': ' . $stat['progres'] . '%</span></td>');
                  } else {
                    echo ('<td class="text-center"><span class="badge badge-pill badge-' . $stat["warna"] . '">' . $stat['status'] . '</span></td>');
                  }
                  ?>

                  <td class="text-center">
                    <a href="" data-id="<?= $x['id_proyek'] ?>" class="my-1 btn btn-info btn-sm detailBtn" data-toggle="modal" data-target="#detailProjectModal">
                      <span data-feather="eye"></span>
                    </a>
                    <a href="/pages/parts/print_view/quotation.php?id=<?= $x['id_proyek'] ?>" class="my-1 btn btn-primary btn-sm cetakBtn">
                      <span data-feather="download"></span>
                    </a>

                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
        <hr>
        <div id="calendar"></div>
      </div>
    </main>
  </div>
</div>
<script src="/dist/fullcalendar-3.10.5/lib/moment.min.js"></script>
<script src="/dist/js/feather.min.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>
<script src="/dist/js/integer-to-rupiah.js"></script>
<script src="/dist/fullcalendar-3.10.5/fullcalendar.min.js"></script>