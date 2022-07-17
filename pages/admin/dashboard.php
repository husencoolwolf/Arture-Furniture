<?php
$dataStatusProject = $db->getProjectStatusCount();
$dataPesananProject = $db->getPesananStatusCount();
?>

<link href="/dist/dashboard.css" rel=" stylesheet">

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
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
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

      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<script src="/dist/js/feather.min.js"></script>
<script src="/dist/js/Chart.min.js"></script>
<script src="/dist/dashboard.js"></script>
<script src="/dist/DataTables/datatables.min.js"></script>