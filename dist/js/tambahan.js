$(document).ready(function () {
  $('a svg.feather-user').parent().click(function () {
    window.location.href = "/?page=profil";
  });

  $('#waContact').on("click", function () {
    window.open("https://api.whatsapp.com/send?phone=6287888525264", '_blank').focus();
  });

  $('#cetakLaporan').on("click", function (event) {
    event.preventDefault();

    let bulan = $('select#selectBulan').val();
    let tahun = $('select#selectTahun').val();
    // console.log("pages/parts/print_view/laporan.php?bulan" + bulan + "&tahun=" + tahun);
    // console.log(tahun);

    if (tahun != "" && bulan != "") {
      window.location.href = "pages/parts/print_view/laporan.php?bulan=" + bulan + "&tahun=" + tahun;
      // window.location.href = "www.google.com";
    } else {
      alert("Pilih Bulan / Tahun dahulu sebelum print Laporan");
    }
  });
});