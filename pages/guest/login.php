<?php ?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-2">
        <div class="card-body p-4 p-sm-5">
          <div class="w-100 text-center">
            <a href="/index.php">
              <img src="/assets/material/Logo-transparent.png" style="width: 220px">
            </a>
          </div>
          <h5 class="card-title text-center mb-2 fw-light fs-5">Login</h5>

          <?php if (isset($_GET['error'])) {
            if ($_GET['error'] == "1") {
              echo "<div class='alert alert-danger'>Kami tidak mengenali Username ini !</div>";
            } elseif ($_GET['error'] == "2") {
              echo "<div class='alert alert-danger'>Password Salah!</div>";
            }
          }
          if (isset($_GET['daftar'])) {
            if ($_GET['daftar'] == '1') {
              echo "<div class='alert alert-success'>Registrasi berhasil, sekarang anda bisa login!</div>";
            }
          }
          ?>
          <form id="formInput" action="/app/proses.php?aksi=login" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
              <input type="username" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username" required autofocus>
              <label for="inputUsername">Username</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" required>
              <label for="inputPassword">Password</label>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
              <label class="form-check-label" for="rememberPasswordCheck">
                Remember password
              </label>
            </div>
            <div class="mb-3">
              <p>Belum punya akun?, Segera <a href="/?page=daftar">Daftar</a></p>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>