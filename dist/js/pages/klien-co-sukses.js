/* 
To DO : 
- Buat fungsi setDataController berjalan dimana dikasih argumen status pesanan. Dimana dia request data pesanan sesuai dengan status nya.
  Contoh : Button Bayar di bawah kalau status masih awal (menunggu info bank), Tulisan "Bayar Sekarang", sedangkan kalau sudah status ke 2 (menunggu verifikasi bayar), berubah jadi update info bayar
*/

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
          if (response == true) {
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
        } else {
          // console.log(response);
          setDataController(response);
        }

      }
    });
  }

  function setDataController(dataPesanan) {
    // set info dalam page ketika di panggil init
    dataPesanan = JSON.parse(dataPesanan);
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

  function setKondisiPagePesanan(statusPesanan) {
    switch (statusPesanan) {
      case value:

        break;

      default:
        break;
    }
  }
});