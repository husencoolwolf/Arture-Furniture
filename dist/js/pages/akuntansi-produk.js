(function () {
  feather.replace()

}())

$(document).ready(function () {
  // $(".tersediaBtn").replaceWith(feather.icons['stop-circle'].toSvg());

  $('#tabelProduk').DataTable({
    // opsi fungsi yang di pakai datatables
    "paging": false,
    "info": false,
    "fixedHeader": true,
    "scrollY": "500px",
    "scrollCollapse": true
  });

  $('.hapusBtn').click(function () {
    // console.log();
    event.preventDefault();
    var idProduk = $(this).parent().parent().find('td').eq(0).html();
    var namaProduk = $(this).parent().parent().find('td').eq(2).html()
    if (confirm('Anda yakin hapus ' + namaProduk + ' [' + idProduk + '] ??')) {
      window.location.href = '/app/proses.php?aksi=hapus-produk&id=' + idProduk;
    } else {}
  });

  $('.tersediaBtn').click(function () {
    event.preventDefault();
    let idProduk = $(this).data("produk");
    var button = $(this);

    // console.log($(this).children().hasClass("feather-eye-off"));
    $.ajax({
      url: '/app/proses.php?request=set-tersedia',
      type: "post",
      data: {
        id: idProduk,
      },
      success: function (response) {
        console.log(response);
        if (response) {
          if (button.children().hasClass("feather-eye-off")) {
            button.children().replaceWith(feather.icons['eye'].toSvg());
          } else {
            button.children().replaceWith(feather.icons['eye-off'].toSvg());
          }
        } else {
          $(".toast-body").html("<div class='alert alert-danger'>terjadi kesalahan, Barang tidak ditemukan!!!</div>");
        }

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  });
});