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
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
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