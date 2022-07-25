<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "dashboard") echo (" active"); ?>" href="/?page=dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "produk") echo (" active"); ?>" href="/?page=produk">
          <span data-feather="shopping-cart"></span>
          Products
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "akun") echo (" active"); ?>" href="/?page=akun">
          <span data-feather="users"></span>
          Accounts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "pesanan") echo (" active"); ?>" href="/?page=pesanan">
          <span data-feather="list"></span>
          Orders
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "pembayaran") echo (" active"); ?>" href="/?page=pembayaran">
          <span data-feather="credit-card"></span>
          Payments
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($getPageStatus == "project") echo (" active"); ?>" href="/?page=project">
          <span data-feather="calendar"></span>
          Projects
        </a>
      </li>
    </ul>


  </div>
</nav>