<?php
$dataStatusProject = $db->getProjectStatusCount();
$dataPesananProject = $db->getPesananStatusCount();
?>

<link href="/dist/dashboard.css" rel=" stylesheet">
<link rel="stylesheet" href="/dist/bootstrap-select/css/bootstrap-select.min.css">

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
        <h1 class="h2">Dashboard</h1>
        <div class="btn-group mr-2">
          <div class="form-group border border-dark">
            <select id="selectBulan" name="selectBulan" class="form-control selectpicker" required title="-Bulan Laporan-">
              <option value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
          <div class="form-group border border-dark">
            <select id="selectTahun" name="selectTahun" class="form-control selectpicker" required title="-Tahun Laporan-">
              <?php
              $tahunSekarang = date("Y");
              echo ("<option value='$tahunSekarang' selected>$tahunSekarang</option>");
              $tahunSekarang--;
              for ($i = 0; $i <= 10; $i++, $tahunSekarang -= 1) {
                echo ("<option value='$tahunSekarang'>$tahunSekarang</option>");
              }
              ?>
            </select>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="cetakLaporan">
          <span data-feather="printer"></span>
          Cetak Laporan
        </button>
      </div>

      <fieldset>
        <legend>Project Status</legend>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-info h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="alert-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataStatusProject['confirm'] ?></p>
                    <p class="font-weight-bold">Need<br>Confirm</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">All</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-warning h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="play-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataStatusProject['progress'] ?></p>
                    <p class="font-weight-bold">Progress</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Duration</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-success h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="check-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataStatusProject['done'] ?></p>
                    <p class="font-weight-bold">Done</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-danger h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="x-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataStatusProject['cancel'] ?></p>
                    <p class="font-weight-bold">Cancel</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card text-center badge-primary h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center w-100">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="align-justify" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataStatusProject['total'] ?></p>
                    <p class="font-weight-bold">Total</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Pesanan Status</legend>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-info h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="alert-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataPesananProject['confirm'] ?></p>
                    <p class="font-weight-bold">Need<br>Confirm</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">All</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-warning h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="play-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataPesananProject['progress'] ?></p>
                    <p class="font-weight-bold">Progress</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Duration</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-success h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="check-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataPesananProject['done'] ?></p>
                    <p class="font-weight-bold">Done</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card text-center badge-danger h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="x-circle" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataPesananProject['cancel'] ?></p>
                    <p class="font-weight-bold">Cancel</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card text-center badge-primary h-100">
              <div class="card-body d-flex align-items-center">
                <div class="row align-items-center w-100">
                  <div class="col-3">
                    <span class="statusIcon" data-feather="align-justify" style="width: 50px; height: 50px;"></span>
                  </div>
                  <div class="col-9">
                    <p class="card-count font-weight-bolder"><?= $dataPesananProject['total'] ?></p>
                    <p class="font-weight-bold">Total</p>
                  </div>
                </div>
              </div>
              <div class="pb-1">
                <span class="badge badge-light">Monthly</span>
              </div>
            </div>
          </div>
        </div>
      </fieldset>


  </div>
  </main>
</div>
</div>
<script src="/dist/js/feather.min.js"></script>
<script src="/dist/js/Chart.min.js"></script>
<script src="/dist/dashboard.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>
<script src="/dist/bootstrap-select/js/bootstrap-select.min.js"></script>