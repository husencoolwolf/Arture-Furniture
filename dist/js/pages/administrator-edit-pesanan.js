(function () {
  feather.replace();


}())

$(document).ready(function () {
  //  updateKategori();
  var listProduk = {};
  var hargaProduk = {};
  var hargaProdukSelected = 0;
  loadHargaProduk();
  loadProdukPesanan();
  setButtonEvent();

  console.log(listProduk);
  $('#selectProduk').on("change", function () {
    hargaProdukSelected = 0;
    hargaProdukSelected += parseInt(hargaProduk[$(this).val()]);
    // console.log($(this).find('option:selected').data('harga-produk'));
  });

  $('#addListBtn').on("click", function () {
    event.preventDefault();
    let selectProduk = $('#selectProduk');
    let inputJumlah = $('input#inputJumlah');
    if (selectProduk.val() !== "" && inputJumlah.val() !== "") {
      let idProduk = selectProduk.val();
      idProduk = idProduk.toString();
      let gambar = selectProduk.find('option:selected').data('gambar');
      let namaProduk = selectProduk.find('option:selected').html();
      let hargaProduk = selectProduk.find('option:selected').data('harga-produk');
      let jumlahProduk = inputJumlah.val();
      let jumlahHarga = parseInt(hargaProduk) * parseInt(jumlahProduk)
      if (selectProduk.val() in listProduk) {
        let hasilCheckk = checkBatasQuantity(idProduk, jumlahProduk);
        if (hasilCheckk == true) {
          listProduk[idProduk] += parseInt(jumlahProduk);
          $('#produkList tbody tr').each(function (index) {

            if ($(this).data('id') == idProduk) {
              $(this).html("");
              $(this).append($('<td>')
                  .append($('<button>')
                    .addClass('btn-sm btn-danger removeList')
                    .append($('<span>')
                      .attr('data-feather', 'x')
                    )
                  )
                ).append($('<td>')
                  .append($('<img>')
                    .attr('src', '/assets/produk/' + gambar)
                    .addClass('img-preview-dropdown')
                  )
                ).append($('<td>')
                  .text(selectProduk.val())
                )
                .append($('<td>')
                  .text(namaProduk)
                )
                .append($('<td>')
                  .text(formatRupiah(hargaProduk, "Rp. "))
                )
                .append($('<td>')
                  .text(listProduk[idProduk])
                )
                .append($('<td>')
                  .text(formatRupiah(hargaProduk * listProduk[idProduk], "Rp. "))
                );
              return false;
            }
          });
          setButtonEvent();
          resetPilihanProduk();
        } else {
          alert(hasilCheckk);
        }
      } else {
        listProduk[idProduk] = parseInt(jumlahProduk);
        //buat row baru pada table
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
              .append($('<img>')
                .attr('src', '/assets/produk/' + gambar)
                .addClass('img-preview-dropdown')
              )
            )
            .append($('<td>')
              .text(selectProduk.val())
            )
            .append($('<td>')
              .text(namaProduk)
            )
            .append($('<td>')
              .text(formatRupiah(hargaProduk, "Rp. "))
            )
            .append($('<td>')
              .text(jumlahProduk)
            )
            .append($('<td>')
              .text(formatRupiah(jumlahHarga, "Rp. "))
            )
            .attr("data-id", idProduk)
          );
        // end of buat row baru pada table
        setButtonEvent();
        resetPilihanProduk();
      }


    } else if (selectProduk.val() == "") {
      alert('silahkan pilih produk terlebih dahulu!!');
    } else if (inputJumlah.val() == "") {
      alert('jangan lupa mengisi jumlah produknya!');
    }

    console.log(listProduk);

    reloadFrontAPI();
    updateGrandTotal();

  });
  jQuery.validator.addMethod("checkTable", function () {
    let jumlah = $('#produkList tbody tr').length;
    if (jumlah > 1) {
      return true;
    } else {
      return false;
    }
  }, "List Produk masih kosong");

  $('#formPesanan').validate({

    rules: {
      selectProduk: {
        required: false
      },
      inputJumlah: {
        required: false
      },
      selectKlien: {
        required: true
      },
      selectMetode: {
        required: true
      }
    },
    submitHandler: function (form) {
      // debugger;
      event.preventDefault();
      let jumlah = $('#produkList tbody tr').length;
      if (jumlah > 0) {
        if (confirm('Apakah data sudah benar ?')) {
          // console.log($(form).serializeArray());
          $.ajax({
            url: form.action,
            type: form.method,
            data: {
              id: GetURLParameter('pesanan'),
              pesanan: $(form).serializeArray(),
              produk: listProduk
            },
            success: function (response) {
              if (response == true) {
                window.location.href = "/?page=pesanan";
              } else {
                window.location.href = "/?page=edit-pesanan&error=" + response;
              }
            }
          });
        } else {}
      } else {
        alert("Harap isi list produk terlebih dahulu sebelum konfirmasi !");
      }


    }
  });


  function updateKategori() {
    $.getJSON("/app/proses.php?request=updateKategori", function (data) {
      //      console.log("data");
      $("#selectKategori").html('<option value="">--Pilih Kategori--</option>');
      $.each(data, function (key, value) {
        $("#selectKategori").append('<option value="' + key + '">' + value + '</option>');
      });
    });
  }

  function setButtonEvent() {
    $('.removeList').on('click', function () {
      console.log(listProduk);
      let barisProduk = $(this).parent().parent();
      let idProduk = barisProduk.data('id');
      delete listProduk[idProduk];
      barisProduk.remove();
      updateGrandTotal();
    });
  }

  function loadHargaProduk() {
    $.ajax({
      url: '/app/proses.php?request=req-harga-produk-admin',
      type: "post",
      success: function (response) {
        // console.log(JSON.parse(response));
        hargaProduk = JSON.parse(response);

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function loadProdukPesanan() {
    $.ajax({
      url: '/app/proses.php?request=req-produk-pesanan-admin',
      type: "post",
      data: {
        id: GetURLParameter('pesanan')
      },
      success: function (response) {
        // console.log(JSON.parse(response));
        listProduk = JSON.parse(response);

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function checkBatasQuantity(id, jumlahBaru) {
    let checker = listProduk[id];
    checker += parseInt(jumlahBaru);
    if (checker > 10) {
      return 'Maksimal Quantity sekali pemesanan 10\nHarap periksa kembali Jumlah/Quantity barang anda!';
    } else if (checker < 1) {
      return 'Quantity / Jumlah barang tidak boleh kurang dari 1!\nHarap periksa kembali inputan anda!';
    } else {
      return true;
    }

  }

  function resetPilihanProduk() {
    $('#selectProduk').val('').selectpicker("refresh");
    $('#inputJumlah').val('');

  }

  function updateGrandTotal() {
    let grandTotal = 0;
    let keyProduk = Object.keys(listProduk);
    // console.log();
    for (let index = 0; index < keyProduk.length; index++) {
      grandTotal += parseInt(hargaProduk[keyProduk[index]]) * listProduk[keyProduk[index]];
    }
    $('th#grandTotal').html(formatRupiah(grandTotal, "Rp. "));
  }

  function reloadFrontAPI() {
    feather.replace();
  }
});