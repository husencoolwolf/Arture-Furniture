<?php
$dataPembayaran = $db->getDataPembayaranAdmin();
?>
<link href="/dist/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="/dist/css/misc/loading.css">

<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="detailPembayaranModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailPembayaranModalLabel">Detail Pembayaran</h5>
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
            <table id="table-detail-pesanan" class="table table-sm w-100" style="max-width: none !important;">
              <tr>
                <td>No.Pesanan</td>
                <td>: <span data-setter="idPesanan"></span></td>
              </tr>
              <tr>
                <td>Tanggal Pesanan</td>
                <td>: <span data-setter="tanggalPesanan"></span></td>
              </tr>
              <tr class="bg-dark text-white">
                <td class="align-middle">Detail Pemesan</td>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#detailKlien" aria-expanded="false" aria-controls="detailKlien">Lihat Detail <span data-feather="chevron-down"></span></button></td>

              </tr>
              <tr class="collapse" id="detailKlien">
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-dark table-striped">
                    <tr>
                      <td class="align-middle">ID Pelanggan</td>
                      <td>: <span data-setter="idKlien"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Nama</td>
                      <td>: <span data-setter="namaKlien"></span></td>
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
                <td>Metode Pembelian</td>
                <td>: <span data-setter="metodePesanan"></span></td>
              </tr>
              <tr class="bg-dark text-white">
                <td class="align-middle">Detail Pembayaran</td>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#detailPembayaran" aria-expanded="false" aria-controls="detailPembayaran">Lihat Detail <span data-feather="chevron-down"></span></button></td>

              </tr>
              <tr class="collapse" id="detailPembayaran">
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-dark table-striped" id="subDetailPembayaran">
                    <tr>
                      <td class="align-middle">ID Pembayaran</td>
                      <td>: <span data-setter="idPembayaran"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Bank Pemilik</td>
                      <td>: <span data-setter="bankPemilik"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">Nama Pemilik</td>
                      <td>: <span data-setter="namaPemilik"></span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">No. Rekening</td>
                      <td>: <span data-setter="norek"></span></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>Status</td>
                <td>: <span data-setter="statusPesanan"></span></td>
              </tr>
              <tr class="bg-dark text-white">
                <td class="align-middle">History Status</td>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#historyStatus" aria-expanded="false" aria-controls="historyStatus">Lihat History <span data-feather="chevron-down"></span></button></td>
              </tr>
              <tr class="collapse" id="historyStatus">
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-dark table-striped" id="tabelHistoryStatus">
                    <thead>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                    </thead>
                    <tbody>
                      <tr></tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" class="p-0">
                  <table class="table table-sm m-0 table-light table-striped my-2" id="tabelDetailProdukPembayaran">
                    <thead class="thead-dark">
                      <th>Gambar</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Harga Produk</th>
                      <th>SubTotal</th>
                    </thead>
                    <tbody>
                      <tr></tr>
                    </tbody>
                    <tfoot class="thead-dark">
                      <th colspan="4">Total</th>
                      <th><span data-setter="grandTotal"></span></th>
                    </tfoot>
                  </table>
                </td>
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
        <h1 class="h2">Payments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
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
        <a href="/?page=tambah-pembayaran">
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
        <table class="table table-striped table-sm table-bordered" id="tabelPembayaran">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID Pembayaran</th>
              <th class="text-center">ID Pesanan</th>
              <th class="text-center">Tanggal Input</th>
              <th class="text-center">Bank Pemilik</th>
              <th class="text-center">Nama Pemilik</th>
              <th class="text-center">No. Rekening</th>
              <th class="text-center">aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!$dataPembayaran) {
            ?>
              <tr>
                <td class="text-center alert-danger" colspan="100%">Belum Ada Pembayaran</td>
              </tr>
              <?php
            } else {
              while ($x = mysqli_fetch_array($dataPembayaran)) {
              ?>
                <tr>
                  <td><?= $x['id_pembayaran'] ?></td>
                  <td><?= $x['id_pesanan'] ?></td>
                  <td><?= date("Y-m-d", strtotime($x['tanggal'])) ?></td>
                  <td><?= $x['bank_pemilik'] ?></td>
                  <td><?= $x['nama_pemilik'] ?></td>
                  <td><?= $x['no_rekening'] ?></td>
                  <td class="text-center">
                    <a href="/?page=edit-pembayaran&pembayaran=<?= $x['id_pembayaran'] ?>" class="btn btn-success btn-sm">
                      <span data-feather="edit"></span>
                    </a>
                    <a href="" data-id="<?= $x['id_pembayaran'] ?>" class="btn btn-danger btn-sm hapusBtn">
                      <span data-feather="trash"></span>
                    </a>
                    <a href="" data-id="<?= $x['id_pesanan'] ?>" class="btn btn-info btn-sm detailBtn" data-toggle="modal" data-target="#detailPembayaranModal">
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
<script src="/dist/js/integer-to-rupiah.js"></script>