<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/guest-navbar.php';
$dataProduk = $db->getDataProduk();
$dataKategori = $db->getDataKategori();
if (isset($_GET['cari'])) {
  $dataProduk = $db->getDataProdukCariSearch($_GET['cari']);
} elseif (isset($_GET['kategori'])) {
  $dataProduk = $db->getDataProdukCariKategori($_GET['kategori']);
}
?>
<script src="/dist/js/pages/guest-navbar.js"></script>
<div>
  <!-- Jumbotron -->
  <div class="jumbotron">
    <div class="spaces">
      <strong>
        <h1 id="quote">BUILD YOUR DREAM HOME TODAY</h1>
      </strong>
      <p class="lead">
        <a class="btn bg-emas-arture btn-lg" href="https://api.whatsapp.com/send?phone=6287888525264" target="_blank" role="button"><strong>Get Free Estimate</strong></a>
      </p>
    </div>

  </div>
  <section id="profil">
    <div class="row w-100 mx-0" style="height: 100vh;">


      <div class="col-md-7 shadow-lg bg-white rounded">
        <div class="container mx-2">
          <h2 class="title"><strong>Tentang Perusahaan</strong></h2>
          <h3 class="subtitle"><strong>Arture (Art</strong> in <strong>Living)</strong></h3>
          <h5>CV. SHANDY MEGAH PERSADA</h5>
          <br>
          <p class="text-justify">Kami memulai usaha ini sejak tahun 2015, kami bergerak
            di bidang interior yang mencakup pekerjaan furniture. Awal
            mula tujuan usaha ini terbentuk atas dasar ingin mendapat
            kepuasan secara visual, kenyamanan dalam penggunaan,
            dan kualitas yang terjaga. Seiring berjalannya waktu,
            cakupan kami bertambah luas ke area perkantoran,
            restoran, dan cafe. Maka dari itu kami bertekad untuk
            memprioritaskan kualiatas yang terbaik untuk semua
            pekerjaan.
          </p>
          <p class="text-justify ml-5">
            Arture seperti tim yang tumbuh besar serta dilandasi oleh
            orang-orang yang memiliki jiwa dan budaya baik, adanya
            nilai-nilai artistik seperti keindahan, kesenian, keunikan,
            kreativitas, inovasi dalam bekerja serta selalu menjunjung
            semangat bekerja keras, kedisiplinan dan kejujuran.
            Sehingga layaknya sebuah pohon yang besar dan rindang
            maka tim ini dapat membawa kenyamanan, keteduhan,
            keindahan, serta menghasilkan produktifitas yang baik.
          </p>
        </div>

      </div>
      <div class="col-md-5 px-0">
        <div class="background h-100 w-100 half-bg konsepruangan1">
          <!-- <br><br><br><br> -->
        </div>
      </div>
    </div>
  </section>

  <section id="jasa" class="mt-5 mb-5 bg-bg-primary">
    <div class="container">
      <h1 class="mb-5 text-center">Jasa Layanan Kami</h1>
      <div class="row">
        <div class="col-md p-0 mt-2">
          <div class="card bg-dark text-white border-0">
            <!-- <img src="/assets/material/login-bg.jpg" class="card-img" alt="Furniture"> -->
            <div class="jasa-card" id="furniture">
              <div class="d-flex h-100 justify-content-center align-items-center text-jasa">
                <h2 class="text-dark">Furniture</h2>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md p-0 mt-2">
          <div class="card bg-dark text-white border-0">
            <!-- <img src="/assets/material/login-bg.jpg" class="card-img" alt="Furniture"> -->
            <div class="jasa-card" id="building">
              <div class="d-flex h-100 justify-content-center align-items-center text-jasa">
                <h2 class="text-dark">Building</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md p-0 mt-2">
          <div class="card bg-dark text-white border-0">
            <!-- <img src="/assets/material/login-bg.jpg" class="card-img" alt="Furniture"> -->
            <div class="jasa-card" id="interior">
              <div class="d-flex h-100 justify-content-center align-items-center text-jasa">
                <h2 class="text-dark text-center">Design Interior</h2>
              </div>

            </div>
          </div>
        </div>
        <!-- <div class="col-md p-0 mt-2">
          <div class="card bg-dark text-white border-0">
            <div class="jasa-card" id="iot">
              <div class="d-flex h-100 justify-content-center align-items-center text-jasa">
                <h2 class="text-dark">IOT</h2>
              </div>

            </div>
          </div>
        </div> -->
      </div>



    </div>
  </section>


  <section id="whyus" class="mt-5 bg-white shadow">
    <div class="container">
      <h2 class="text-center my-5 py-5 text-emas-arture font-weight-bolder">Kenapa Harus Memilih Kami?</h1>
        <div class="my-5"></div>
        <div class="row py-5 text-center">
          <div class="col-md">
            <h4 class="text-emas-arture mb-4 font-weight-bold">Free Survey & Estimating</h4>
            <p>Free for our first step to start and estimate in some places and cities in Indonesia. And we can estimate cost so fast.</p>
          </div>
          <div class="col-md">
            <h4 class="text-emas-arture mb-4 font-weight-bold">Free Consultations</h4>
            <p>Meeting or discuss with a professional or expert for purposes of gaining information, or the act or process of formally discussing and collaborating on something for free and low cost.</p>
          </div>
          <div class="col-md">
            <h4 class="text-emas-arture mb-4 font-weight-bold">Guarantee Services</h4>
            <p>We promise or assurance that something is of specified our quality, content, benefit, etc. for our products, or that it will perform satisfactorily for a given length of time.</p>
          </div>
          <div class="col-md">
            <h4 class="text-emas-arture mb-4 font-weight-bold">High Quality & Low Price</h4>
            <p>When you’re choosing products to buy, you have to consider the tradeoffs between price and quality. But in us, we can give you both.</p>
          </div>
        </div>
    </div>
  </section>

  <section id="contact">
    <div class="row bg-kuning text-center mt-4">
      <div class="garis-kuning bg-dark"></div>

      <div class="col my-3">
        <h1>TEMUKAN KAMI DI</h1>
      </div>
      <div class="garis-kuning bg-dark"></div>

    </div>
    <div class="container p-5">
      <div class="row justify-content-between">
        <div class="col-6">
          <H5>ALAMAT KANTOR</H5>
          <p>Jl. Vini Vidi Vici No. 40 RW.08, Klp Dua
            Wetan, Kec. Ciracas, Jakarta Timur,
            13730</p>
        </div>
        <div class="col-6">
          <H5>INSTAGRAM</H5>
          <p>Arture.furniture</p>
        </div>
      </div>
      <!-- baris ke 2 -->
      <div class="row justify-content-between">
        <div class="col-6">
          <H5>ALAMAT WORKSHOP</H5>
          <p>Jl. Vini Vidi Vici No. 40 RW.08, Klp Dua
            Wetan, Kec. Ciracas, Jakarta Timur,
            13730</p>
        </div>
        <div class="col-6">
          <H5>TOKOPEDIA</H5>
          <p>Arture Furniture</p>
        </div>
      </div>
      <!-- baris ke 3 -->
      <div class="row justify-content-between">
        <div class="col-6">
          <H5>NOMOR TELEPON</H5>
          <p>+62 878-8852-5264</p>
        </div>
        <div class="col-6">
          <H5>ALAMAT EMAIL</H5>
          <a class="link-statis" href="mailto:arture.furniture@gmail.com">
            <p>arture.furniture@gmail.com</p>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- <div style="height: 1000px;"></div> -->




</div>



<!-- Modal -->
<div class="modal fade" id="warningPesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Maaf!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Harap untuk login / daftar untuk dapat memesan atau menggunakan keranjang
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="/?page=login"><button type="button" class="btn btn-primary">Login</button></a>
        <a href="/?page=daftar"><button type="button" class="btn btn-primary">Daftar</button></a>
      </div>
    </div>
  </div>
</div>

<button type="button" id="waContact" class="btn btn-white bg-white border rounded-circle p-0">
  <span class="fa fa-whatsapp fa-3x text-success text-center" role="button">
  </span>
</button>