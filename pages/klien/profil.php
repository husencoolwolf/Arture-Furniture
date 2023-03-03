<?php
$dataAkun = $db->getDataDetailAkunModalAdmin($_SESSION['id_akun']);
$alamatKlien = $db->getAlamatAktifKlienUser($_SESSION['id_akun']);
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
?>
<style>
  table.tabel-padding tr td {
    padding: 8px;
  }
</style>

<script src="/dist/js/pages/klien-navbar.js"></script>

<div class="container">
  <div class="row">



    <main role="main" class="col-md">


      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == -1) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query Akun Database</div>';
        } elseif ($_GET['error'] == -2) {
          echo '<div class="alert alert-danger">Data tidak masuk, Harap periksa Query Detail Akun Database</div>';
        }
      }
      if (isset($_GET['sukses'])) {
        if ($_GET['sukses'] == '1') {
          echo '<div class="alert alert-success">Profil berhasil diubah</div>';
        }
      }
      ?>
      <form id="formEditAkun" action="/app/proses.php?aksi=edit-profil-klien" method="post" enctype="multipart/form-data">
        <div class="row justify-content-md-between justify-content-center my-5">
          <div class="col-6-md text-center mb-3 border border-dark p-3">
            <div class="text-left">
              <div class="p-2">
                <p><strong>Detail Akun</strong></p>
                <hr>
              </div>
              <table class="tabel-padding text-left mb-4">
                <tr>
                  <td><img src="/assets/akun/foto-profil/user.svg" width="50px" height="50px" class="border rounded-circle"></td>
                  <td><?= $dataAkun['username'] ?></td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>: <span><?= $dataAkun['nama'] ?></span></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: <span><?= $ctr->blurEmail($dataAkun['email']) ?></span></td>
                </tr>
                <tr>
                  <td>Nomor HP</td>
                  <td>: <span><?= $ctr->blurNomorHP($dataAkun['nomor_hp']) ?></span></td>
                </tr>
              </table>
              <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-dark">Edit Akun<span> | <i class="fa fa-pencil" aria-hidden="true"></i></span></a>
              </div>
            </div>
          </div>
          <div class="col-6-md mb-3">
            <div class="border border-dark p-3">
              <p><strong>Alamat</strong></p>
              <hr>
              <table>
                <tr>
                  <td><strong><?= $alamatKlien['provinsi'] ?></strong></td>
                </tr>
                <tr>
                  <td><strong><?= $alamatKlien['kota'] ?></strong></td>
                </tr>
                <tr>
                  <td><strong><?= $alamatKlien['kecamatan'] ?></strong></td>
                </tr>
              </table>
              <br>
              <p><?= $alamatKlien['alamat'] ?></p>
              <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-dark">Setel Alamat<span> | <i class="fa fa-wrench" aria-hidden="true"></i></span></a>
              </div>
            </div>
          </div>
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
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>