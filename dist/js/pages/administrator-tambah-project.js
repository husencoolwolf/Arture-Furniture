(function () {
  feather.replace();


}())

$(document).ready(function () {
  //  updateKategori();
  var listProduk = {};
  var hargaProduk = {};


  $('#addListBtn').on("click", function () {
    event.preventDefault();
    let inputItem = $('#inputItem');
    let inputJumlah = $('#inputJumlah');
    let inputHarga = $('#inputHarga');
    let inputKetItem = $('#inputKetItem');
    if (inputItem.val() !== "" && inputJumlah.val() !== "" && inputHarga.val() !== "") {
      let idProduk = Object.keys(listProduk).length + 1;
      idProduk = idProduk.toString();
      let hargaItem = inputHarga.val();
      hargaItem = hargaItem.replaceAll("Rp.", "");
      hargaItem = hargaItem.replaceAll(".", "");
      let jumlahProduk = inputJumlah.val();
      let jumlahHarga = parseInt(hargaItem);
      listProduk[idProduk] = {
        jml: parseInt(jumlahProduk),
        harga: parseInt(hargaItem),
        nama: inputItem.val(),
        ket: inputKetItem.val()
      };
      // hargaProduk[idProduk] = parseInt(hargaItem);
      $('#produkList').find('tbody')
        .append($('<tr>')
          .append($('<td>')
            .append($('<button>')
              .addClass('btn-sm btn-danger removeList')
              .append($('<span>')
                .attr('data-feather', 'x')
              )
            )
          )
          .append($('<td>')
            .text(inputItem.val())
          )
          .append($('<td>')
            .text(formatRupiah(hargaItem, "Rp. "))
          )
          .append($('<td>')
            .text(jumlahProduk)
          )
          .append($('<td>')
            .text(inputKetItem.val())
          )
          .append($('<td>')
            .text(formatRupiah(jumlahHarga, "Rp. "))
          )
          .attr("data-id", idProduk)
        );
      setButtonEvent();
      resetPilihanProduk();



    } else if (inputItem.val() == "") {
      alert('silahkan Masukkan Nama Item terlebih dahulu!!');
    } else if (inputJumlah.val() == "") {
      alert('jangan lupa mengisi jumlah item!');
    } else if (inputHarga.val() == "") {
      alert('jangan lupa mengisi harga item!');
    }
    reloadFrontAPI();
    updateGrandTotal();

  });
  //costum method
  $.validator.addMethod('strongNope', function (value, element) {
    return this.optional(element) || (value.length >= 10 && value.length <= 13);
  }, 'Nomor HP minimal 10 - 13 Digit Angka');

  $('#formProject').validate({

    rules: {
      inputItem: {
        required: false
      },
      inputKetItem: {
        required: false
      },
      inputJumlah: {
        required: false
      },
      inputHarga: {
        required: false
      },
      inputNamaProject: {
        required: true
      },
      inputNope: {
        required: false,
        strongNope: true
      }
    },
    submitHandler: function (form) {
      // debugger;
      let jumlah = $('#produkList tbody tr').length;
      if (jumlah > 0) {
        if (confirm('Apakah data sudah benar ?')) {
          $.ajax({
            url: form.action,
            type: form.method,
            data: {
              project: $(form).serializeArray(),
              item: listProduk
            },
            success: function (response) {
              if (response == true) {
                window.location.href = "/?page=project";
              } else {
                window.location.href = "/?page=tambah-project&error=" + response;
              }
            }
          });
        } else {}
      } else {
        alert("Harap isi list Item terlebih dahulu sebelum konfirmasi !");
      }

      // $.ajax({
      //   url: form.action,
      //   type: form.method,
      //   data: $(form).serialize(),
      //   success: function (response) {
      //     $('.toast > .toast-body').html(response);
      //     $('#modalAddKategori').modal('toggle');
      //     $('.toast').toast('show');
      //     updateKategori();
      //   }
      // });
    }
  });





  function setButtonEvent() {
    $('.removeList').on('click', function () {
      let barisProduk = $(this).parent().parent();
      let idProduk = barisProduk.data('id');
      delete listProduk[idProduk];
      barisProduk.remove();
      updateGrandTotal();
    });
  }

  function resetPilihanProduk() {
    $('#inputItem').val('');
    $('#inputJumlah').val('');
    $('#inputHarga').val('');
    $('#inputKetItem').val('');
  }

  function updateGrandTotal() {
    let grandTotal = 0;
    let keyProduk = Object.keys(listProduk);
    // console.log(listProduk);
    // console.log(keyProduk);
    for (let index = 0; index < keyProduk.length; index++) {
      grandTotal += parseInt(listProduk[keyProduk[index]]['harga']);
    }
    $('th#grandTotal').html(formatRupiah(grandTotal, "Rp. "));
  }

  function reloadFrontAPI() {
    feather.replace();
  }
});