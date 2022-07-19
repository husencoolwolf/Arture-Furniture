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



  function Init(idTarget) {
    $.ajax({
      url: "/app/proses.php?request=get-data-pesanan",
      type: "post",
      data: {
        id: idTarget
      },
      success: function (response) {
        if (response == "0") {
          alert("ERROR ! : Terjadi Kesalahan dalam pengambilan data pesanan anda!");
          window.location.replace("/");
        } else { //kasus berhasil
          // console.log(response);
          response = JSON.parse(response);
          setDataController(response);
          setKondisiPagePesanan(response["status"]);
        }

      }
    });
  }

  function setDataController(dataPesanan) {
    // set info dalam page ketika di panggil init
    console.log(dataPesanan);
    $(".pesanan-data").each(function () {
      console.log($(this).data("type"));
      switch ($(this).data("type")) {
        case "noPesanan":
          $(this).html(dataPesanan["id_pesanan"]);
          break;
        case "namaPemesan":
          $(this).html(dataPesanan["nama"]);
          break
        case "tanggalPesanan":
          $(this).html(dataPesanan["tanggal_pesan"]);
          break

        case "statusPesanan":
          $(this).html(dataPesanan["status"]);
          break
        case "alamat":
          $(this).html(dataPesanan["alamat"]);
          break
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
    console.log(statusPesanan);
    switch (statusPesanan) {
      case "menunggu info bank":
        kondisiMenungguInfoBank();
        break;
      case "menunggu verifikasi bayar":
        kondisiMenungguVerifikasiBayar();
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
    enableButtons();

    $.ajax({
      url: "/app/proses.php?request=generate-cara-pembayaran",
      type: "post",
      data: {
        id: GetURLParameter("pesanan")
      },
      success: function (response) {
        response += "<div class='container'>\
        <div class='text-justify mb-2' >Pembayaran dilakukan di awal atau Down Payment (DP) sebesar 50%, kemudian 25% saat progress sudah berjalan setengahnya dan 25% sisanya dibayarkan ketika pemasangan sudah selesai. Pembayaran dapat di transfer ke rekening sebagai berikut :</div>\
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
        $.ajax({
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          success: function (response) {
            console.log(response);
            if (response == true) {
              $('.toast-body').html("<div class='alert alert-success'>" + "Info Bank telah ditambahkan, silahkan melanjutkan pembayaran pada bank yang dipilih!" + "</div");
              $('.toast').toast('show');
              $('.modal').modal('hide');
              Init($("#targetSalin").html());
              // kalau berhasil, Jalanin init lagi yang setting info dalam page
              // harap ganti
              // window.location.href = window.location.href;
            } else {
              $('.toast-body').html("<div class='alert alert-danger'>" + response + "</div");
              $('.toast').toast('show');
            }
          }
        });
      }
    });
  });
});