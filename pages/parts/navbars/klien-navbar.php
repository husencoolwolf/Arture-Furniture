<!-- Navbar Atas -->
<nav id="navbar-atas" class="navbar navbar-expand p-0">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!--   Show this only lg screens and up   -->
    <ul class="navbar-nav ml-auto link-navbar-atas">
        <li class="nav-item dropdown mr-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['nama']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/logout.php">Logout</a>
                <a class="dropdown-item" href="#">Profil</a>
                <a class="dropdown-item" href="#">else</a>
            </div>
        </li>
        <li>
            <a href="/?page=keranjang">
                <button class="btn px-0 pl-1">
                    <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
                    <span class="badge badge-light cart-notification" id="jmlKeranjang">0</span>
                </button>
            </a>
        </li>
    </ul>

    </div>
</nav>
<!-- ----------------------------------------------------------------- -->

<!-- Navbar Bawah-->
<nav id="navbar-bawah" class="navbar navbar-expand-md navbar-light shadow-sm border-top">

    <!--  Show this only on mobile to medium screens  -->
    <a class="navbar-brand d-lg-none" href="/">
        <img class="" src="/assets/material/Arture-header-transparent.png" alt="Arture Furniture" style="width: 100px">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!--  Use flexbox utility classes to change how the child elements are justified  -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

        <!--   Show this only lg screens and up   -->
        <ul class="navbar-nav">
            <a class="navbar-brand d-none d-lg-block" href="/">
                <img class="" src="/assets/material/Arture-header-transparent.png" alt="Arture Furniture" style="width: 200px">
            </a>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item px-3 ml-auto">
                <a class="nav-link active" href="#catalog">CATALOG <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item px-3 ml-auto">
                <a class="nav-link" href="#carouselExampleControls">PROMO</a>
            </li>
            <li class="nav-item px-3 ml-auto">
                <a class="nav-link" href="#profil">PROFIL</a>
            </li>
            <li class="nav-item px-3 ml-auto">
                <a class="nav-link" href="#contact">HUBUNGI KAMI</a>
            </li>
        </ul>

    </div>
</nav>