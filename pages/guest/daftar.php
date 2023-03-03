<?php

?>
<link rel="stylesheet" href="/dist/bootstrap-select/css/bootstrap-select.min.css">


<div class="container" id="main-frame">
  <div class="row">
    <div class="mx-auto w-100">
      <div class="card border-0 shadow rounded-3 my-2">
        <div class="card-body p-4 p-sm-5">
          <div class="w-100 text-center">
            <a href="/index.php">
              <img src="/assets/material/Logo-transparent.png" style="width: 220px">
            </a>
          </div>
          <h5 class="card-title text-center mb-2 fw-light fs-5">Daftar</h5>
          <form id="formInput" action="/app/proses.php?aksi=daftarKlien" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
              <label for="inputNama">Name</label>
              <input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Example John Kenny">
            </div>
            <div class="form-floating mb-3">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="john123">
            </div>
            <div class="form-floating mb-3">
              <label for="inputEmail">Email address</label>
              <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="name@example.com">
            </div>
            <div class="form-floating mb-3">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-floating mb-3">
                  <label for="selectProvinsi">Province / Provinsi</label><br>
                  <select title="Select Province" id="selectProvinsi" name="selectProvinsi" class="selectpicker w-100" data-size="5" data-live-search="true" data-style="bg-white text-dark border border-gray" required>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mb-3">
                  <label for="selectKota">Regency / Kota</label><br>
                  <select title="Select Regency" id="selectKota" name="selectKota" class="selectpicker w-100 d-block" data-size="5" data-live-search="true" data-style="bg-white text-dark border border-gray" required>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mb-3">
                  <label for="selectKecamatan">District / Kabupaten</label><br>
                  <select title="Select District" id="selectKecamatan" name="selectKecamatan" class="selectpicker w-100" data-size="5" data-live-search="true" data-style="bg-white text-dark border border-gray" required>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-floating mb-3">
              <label for="inputAlamat">Address</label>
              <textarea class="form-control" name="inputAlamat" id="inputAlamat" rows="4" placeholder="Your Addressx" maxlength="255"></textarea>
            </div>
            <div>
              <label for="inputNope">Phone Number</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                    <select id="selectCodeNegara" name="selectCodeNegara" class="selectpicker" data-width="fit" data-size="5" data-live-search="true">
                    </select>
                  </span>
                </div>
                <input type="number" class="form-control" name="inputNope" id="inputNope" placeholder="877xxxxxx">
              </div>
            </div>



            <div class="mb-3">
              <p>Sudah terdaftar?, silahkan <a href="/?page=login">Login</a></p>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign up</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/dist/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/dist/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/dist/js/jquery-validate/additional-methods.min.js"></script>