<?php
$dataAkun = $db->getDataDetailAkunModalAdmin($_SESSION['id_akun']);
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';

?>

<div class="container">

  <h2 class="d-1 mt-3">Edit Akun</h2>
  <hr>
  <form action="/app/proses.php" method="post">
    <div class="form-group">
      <label for="inputNama">Nama Anda</label>
      <input type="text" class="form-control" id="inputNama" placeholder="Nama Anda">
    </div>
    <div class="form-group">
      <label for="inputEmail">Alamat Email</label>
      <input type="text" class="form-control" id="inputEmail" placeholder="Email Pengguna">
    </div>
    <div class="form-group">
      <label for="inputNope">Nomor HP</label>
      <input type="text" class="form-control" id="inputNope" placeholder="Nomor HP">
    </div>
  </form>
</div>