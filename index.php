<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arture Furniture</title>
  <link rel="stylesheet" href="dist/css/bootstrap.css">

</head>

<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!--  Show this only on mobile to medium screens  -->
    <a class="navbar-brand d-lg-none" href="#">
      <img class="" src="/fargasa/assets/Fargasa Logo Circle.png" alt="Dashboard" style="width: 80px">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!--  Use flexbox utility classes to change how the child elements are justified  -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

      <!--   Show this only lg screens and up   -->
      <ul class="navbar-nav">
        <a class="navbar-brand d-none d-lg-block" href="#">
          <img class="" src="/fargasa/assets/Fargasa Logo Circle.png" alt="Dashboard" style="width: 80px">
        </a>
      </ul>
      <ul class="navbar-nav mx-auto">
        <li class="nav-item px-3 ml-0">
          <a class="nav-link active" href="#catalog">CATALOG <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item px-3 ml-0">
          <a class="nav-link" href="#carouselExampleControls">PROMO</a>
        </li>
        <li class="nav-item px-3 ml-0">
          <a class="nav-link" href="#profil">PROFIL</a>
        </li>
        <li class="nav-item px-3 ml-0">
          <a class="nav-link" href="#contact">HUBUNGI KAMI</a>
        </li>
      </ul>

    </div>
  </nav>
</body>
<script src="dist/js/jquery-3.5.1.js"></script>
<script src="dist/js/bootstrap.js"></script>


</html>