/* 
To DO : 
- Buat fungsi setDataController berjalan dimana dikasih argumen status pesanan. Dimana dia request data pesanan sesuai dengan status nya.
  Contoh : Button Bayar di bawah kalau status masih awal (menunggu info bank), Tulisan "Bayar Sekarang", sedangkan kalau sudah status ke 2 (menunggu verifikasi bayar), berubah jadi update info bayar
*/



$(document).ready(function () {
  // new ClipboardJS('#salinKode');
  Init($("#targetSalin").html());

  $('#salinKode').click(function () {
    copyToClipboard($("#targetSalin").html());
    alert('kode pesanan disalin');
  });

  // $('.actionBtn:eq(1)').on("click", function () {
  //   if (confirm("Anda yakin akan membatalkan pesanan ini?")) {

  //   } else {}
  // });

  $('#formBatalPesanan').on("submit", function (event) {
    event.preventDefault();
    if (confirm("Anda yakin akan membatalkan pesanan ini?")) {
      let form = $(this);
      $.ajax({
        url: form.attr('action') + "&id=" + form.data('id'),
        type: "POST",
        data: $('#formBatalPesanan select').serialize(),
        success: function (response) {
          if (response) {
            $.ajax({
              url: "/app/proses.php?api=telegram-update-status-pesanan&id=" + form.data('id'),
              type: "POST",
              data: $('#formBatalPesanan select').serialize(),
              success: function (response) {
                // console.log(JSON.parse(response));
                location.reload();
              }
            });
          } else {
            location.href.replace("/?page=pesanan&error=" + response);
          }
        }
      });
    } else {}

  });


  function Init(idTarget) {

    $.ajax({
      url: "/app/proses.php?request=get-data-pesanan&id=" + idTarget,
      type: "post",
      dataType: "json",
      data: {
        id: idTarget
      },
      success: function (response) {
        // debugger;
        if (response == "0") {
          alert("ERROR ! : Terjadi Kesalahan dalam pengambilan data pesanan anda!");
          window.location.replace("/");
        } else { //kasus berhasil
          // console.log(response);
          // response = JSON.parse(response);
          setDataController(response);
          setKondisiPagePesanan(response["status"]);
        }

      }
    });
  }


  function setDataController(dataPesanan) {
    // set info dalam page ketika di panggil init
    $(".pesanan-data").each(function () {
      switch ($(this).data("type")) {
        case "noPesanan":
          $(this).html(dataPesanan["id_pesanan"]);
          break;
        case "namaPemesan":
          $(this).html(dataPesanan["nama"]);
          break;
        case "tanggalPesanan":
          $(this).html(dataPesanan["tanggal_pesan"]);
          break;
        case "statusPesanan":
          $(this).html(dataPesanan["status"]);
          break;
        case "alamat":
          $(this).html(dataPesanan["alamat"]);
          break;
        case "nope":
          $(this).html(dataPesanan["nomor_hp"]);
        default:
          break;
      }
    })
    // console.log(dataHolder.eq(1).data("type"));
  }

  function enableButtons() {
    $(".actionBtn").each(function () {
      $(this).removeAttr('disabled');
      $(this).removeClass('animated-background');
    });


  }

  function setKondisiPagePesanan(statusPesanan) {
    switch (statusPesanan) {
      case "menunggu info bank":
        kondisiMenungguInfoBank();
        break;
      case "menunggu verifikasi bayar":
        kondisiMenungguVerifikasiBayar();
        break;
      case "pembuatan":
        kondisiPembuatan();
        break;
      case "pengiriman":
        kondisiPengiriman();
        break;
      case "selesai":
        kondisiSelesai();
        break;
      case "batal":
        kondisiSelesai();
        break;
      default:
        console.log("Status pesanan tidak ditemukan");
        break;
    }
  }

  function kondisiMenungguInfoBank() {
    $(".info-warning").html("<div class='alert alert-info' role='alert'>Harap mengisi informasi pembayaran anda dengan klik tombol 'Bayar Sekarang' di bawah !!</div>");
    $(".actionBtn").eq(0).html("Bayar Sekarang");
    $(".actionBtn").eq(1).html("Batalkan Pesanan");
    $("form#formBayar").attr("action", "/app/proses.php?aksi=buat-pembayaran&pesanan=" + GetURLParameter("pesanan"));
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $("#submitModal").val("Bayar Sekarang");
    $('#konfirmasiBtn').hide();
    enableButtons();
  }

  function kondisiMenungguVerifikasiBayar() {
    $(".info-warning").html("<div class='alert alert-success' role='alert'>Silahkan cek cara pembayaran anda dengan klik tombol 'Cara Pembayaran'</div>\
    <div class='alert alert-warning' role='alert'>Harap Melakukan pembayaran sebelum 24 jam!</div>");
    $(".actionBtn").eq(0).html("Cara Pembayaran");
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $(".actionBtn").eq(1).html("Batalkan Pesanan");
    $(".modal-content.pembayaran .modal-header .modal-title").html("Cara Pembayaran")
    // $("form#formBayar").attr("action", "/app/proses.php?aksi=update-pembayaran&pesanan=" + GetURLParameter("pesanan"));
    $("#submitModal").hide();
    $('#konfirmasiBtn').hide();
    enableButtons();
    $.ajax({
      url: "/app/proses.php?request=generate-cara-pembayaran",
      type: "post",
      data: {
        id: GetURLParameter("pesanan")
      },
      success: function (response) {
        response += "<div class='container'>\
        <div class='text-justify mb-2' >Harap melakukan pembayaran sebelum besok pukul 23:00<br>Kami akan melakukan pengecekan pembayaran secara berkala<br>Pembayaran dapat di transfer ke rekening sebagai berikut :</div>\
        <ul>\
        <li>Bank Mandiri : 125-00-1056-2759 A.N. Andi Shandy</li>\
        <li>Bank BCA : 633-1207-265 A.N. Andi Shandy</li>\
        <li>Bank BNI : 053-5749-268 A.N. Andi Shandy</li>\
        </ul>\
        </div>";
        $(".modal-content.pembayaran .modal-body").html(response);
      }
    });
  }

  function kondisiPembuatan() {
    $(".actionBtn").eq(0).html("Sedang dibuat");
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $(".actionBtn").eq(1).html("Batalkan Pesanan");
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $(".modal-content.pembayaran .modal-header .modal-title").html("");
    $(".modal-content.pembayaran .modal-body").html("<div class='text-justify'>Barang Anda sedang dalam proses produksi, Harap menunggu dan cek secara berkala, dan pastikan alamat yang anda punya benar!!</div>");
    $("#submitModal").hide();
    $('#konfirmasiBtn').hide();
    enableButtons();
  }

  function kondisiPengiriman() {
    $(".actionBtn").eq(0).html("Konfirmasi Pengiriman");
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $(".actionBtn").eq(1).html("Batalkan Pesanan");
    $(".actionBtn").eq(0).attr("data-target", "#pembayaran");
    $(".modal-content.pembayaran .modal-header .modal-title").html("Konfirmasi Pengiriman");
    $(".modal-content.pembayaran .modal-body").html("<div class='text-justify'><div class='text-justify'>Jika barang sudah sampai dan diinstalasi, Silahkan klik 'Barang telah diterima'</div>");
    $('#submitModal').hide();
    $('#konfirmasiBtn').show();
    enableButtons();
    $(".actionBtn").eq(1).attr("disabled", "disabled");
    $("#konfirmasiBtn").click(function (event) {
      event.preventDefault();
      $.ajax({
        url: "/app/proses.php?aksi=konfirmasi-pengiriman",
        type: "post",
        data: {
          id: GetURLParameter("pesanan")
        },
        success: function (response) {
          if (response == true) {
            $('.toast-body').html("<div class='alert alert-success'>" + "Pesanan telah dikonfirmasi, Terima kasih telah berbelanja di Arture Furniture :)" + "</div>");
            $('.toast').toast('show');
            $('.modal').modal('hide');
            Init(GetURLParameter("pesanan"));
            // kalau berhasil, Jalanin init lagi yang setting info dalam page
            // harap ganti
            // window.location.href = window.location.href;
          } else {
            $('.toast-body').html("<div class='alert alert-danger'>" + "Terjadi kesalahan : Harap hubungi kami beserta Screenshot kesalahan!" + "</div>");
            $('.toast').toast('show');
          }
        }
      });
    });
  }

  function kondisiSelesai() {
    $('#konfirmasiBtn').hide();
    $(".actionBtn").each(function () {
      $(this).hide();
    });
  }

  $(function () {
    $.validator.addMethod("letterandspace", function (value, element) {
      return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    }, "Hanya Huruf diperbolehkan!");

    $('#formBayar').validate({

      rules: {
        inputNorek: {
          required: true,
          number: true,
        },
        selectBank: {
          required: true,
        },
        inputNasabah: {
          required: true,
          letterandspace: true
        }
      },

      submitHandler: function (form) {
        $("#submitModal").attr("disabled", "disabled");
        $.ajax({
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          success: function (response) {
            // console.log(response);
            response = JSON.parse(response);
            if (response[0] == true) {
              $('.toast-body').html("<div class='alert alert-success'>" + "Info Bank telah ditambahkan, silahkan melanjutkan pembayaran pada bank yang dipilih!" + "</div>");
              $('.toast').toast('show');
              $('.modal').modal('hide');
              $.ajax({
                url: "/app/proses.php?api=telegram-notif-klien-buat-pesanan",
                type: "POST",
                data: {
                  dataPembayaran: response[1],
                  dataKlien: response[2]
                }
              });
              Init($("#targetSalin").html());
              // kalau berhasil, Jalanin init lagi yang setting info dalam page
              // harap ganti
              // window.location.href = window.location.href;
            } else {
              $('.toast-body').html("<div class='alert alert-danger'>" + response + "</div>");
              $('.toast').toast('show');
            }
          }
        });
      }
    });
  });
});