(function () {
  feather.replace();


}())

$(document).ready(function () {
  //  updateKategori();
  var isEditing = false; // status lagi ngedit ato gk
  var valueBeforeEdit; //var wadah value data dari table ke input untuk di edit
  var listProduk = {};
  var hargaProduk = {};
  loadDataInit(GetURLParameter('project'));

  $('#addListBtn').on("click", function () {
    event.preventDefault();
    let idProduk;
    let inputItem = $('#inputItem');
    let inputJumlah = $('#inputJumlah');
    let inputHarga = $('#inputHarga');
    let inputKetItem = $('#inputKetItem');
    if (inputItem.val() !== "" && inputJumlah.val() !== "" && inputHarga.val() !== "") {

      let hargaItem = inputHarga.val();
      hargaItem = hargaItem.replaceAll("Rp.", "");
      hargaItem = hargaItem.replaceAll(".", "");
      let jumlahProduk = inputJumlah.val();
      let jumlahHarga = parseInt(hargaItem);
      $.ajax({
        url: "/app/proses.php?request=buat-id-unik&tabel=item_proyek",
        type: 'get',
        dataType: 'html',
        async: false,
        cache: false,
        success: function (data) {
          idProduk = data;
        }
      });
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
            .addClass("editable namaItem")
          )
          .append($('<td>')
            .text(jumlahProduk)
            .addClass("editable jumlah")
          )
          .append($('<td>')
            .text(inputKetItem.val())
            .addClass("editable keterangan")
          )
          .append($('<td>')
            .text(formatRupiah(jumlahHarga, "Rp. "))
            .addClass("editable harga")
          )
          .attr("data-id", idProduk)
        );
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
              item: listProduk,
              id: GetURLParameter('project')
            },
            success: function (response) {
              // if (response == true) {
              //   window.location.href = "/?page=project";
              // } else {
              //   window.location.href = "/?page=edit-project&error=" + response;
              // }
              console.log(JSON.parse(response));
            }
          });
        } else {}
      } else {
        alert("Harap isi list Item terlebih dahulu sebelum konfirmasi !");
      }
    }
  });

  $('table#produkList tbody tr td').on('click', 'button.removeList', function () {
    event.preventDefault();
    // console.log($(this).html());
    let barisProduk = $(this).parent().parent();
    let idProduk = barisProduk.data('id');
    delete listProduk[idProduk];
    barisProduk.remove();
    updateGrandTotal();
  });

  // Edit Tables event
  $("table#produkList tbody").on("dblclick", "td.editable", function () {
    // debugger;
    setEditing();
    valueBeforeEdit = $(this).html(); // ambil data di dalam table yg ingin ke edit ke global var di atas
    // let inputField; //var wadah inputan yang akan di clone untuk dimasukkan ke table td nantinya
    $(this).html(""); //kosoing table nya, value sudah di ambil di variable "value"
    if ($(this).hasClass("namaItem")) {
      // inputField = $("input#inputItem");
      $("input#inputItem").clone().appendTo(this).val(valueBeforeEdit).addClass('editing').focus();
    } else if ($(this).hasClass("jumlah")) {
      // inputField = $("input#inputJumlah");
      $("input#inputJumlah").clone().appendTo(this).val(valueBeforeEdit).addClass('editing').focus();
    } else if ($(this).hasClass("keterangan")) {
      // inputField = $("input#inputKetItem");
      $("#inputKetItem").clone().appendTo(this).val(valueBeforeEdit).addClass('editing').focus();
    } else if ($(this).hasClass("harga")) {
      // inputField = $("input#inputHarga");
      $("input#inputHarga").clone().appendTo(this).val(valueBeforeEdit).addClass('editing').focus();
    }
    $(this).addClass('editing');
    isEditing = true;
  });

  $('body').on('click', function () {
    if (!$(event.target).closest('.editing').length) {
      // ... clicked on the 'body', but not inside of #editing
      setEditing();
      isEditing = false;
    }
  });

  $('table#produkList tbody').on("keydown", "td.editing", function (event) {
    let type = $(this).children().attr('type');
    if (event.ctrlKey && event.keyCode == 13) {
      setEditing();
    } else if (type == "text" && event.keyCode == 13) {
      setEditing();
    } else if (event.keyCode == 27) {
      setEditing(true);
    }
  });

  $('table#produkList tbody').on("keyup", "input.rupiah", function () {
    $(this).val(formatRupiah($(this).val(), "Rp. "));
  });


  reloadFrontAPI();





  function setEditing(cancel = false) {
    if (isEditing) {
      let editField = $('.editable.editing');
      let inputField = editField.children();
      let trEditField = editField.parent();
      let editVal = inputField.val();
      if (cancel) {
        editVal = valueBeforeEdit;
      }
      inputField.remove(); //remove inputan bekas edit
      editField.removeClass("editing"); //remove class editing
      editField.html(editVal); // masukin dari hasil editan ke table td lagi.
      updateValueProduk(inputField, trEditField, editVal); //update variable
      //isEditing masih true karna yg di click adalah table lain yang juga bsa di edit
      console.log(listProduk);
    }
  }

  function updateValueProduk(inputElement, parentTr, value) {
    // debugger;
    let id = parentTr.data('id');
    switch (inputElement.attr('id')) {
      case "inputItem":
        listProduk[id]['nama'] = value;
        break;
      case "inputJumlah":
        listProduk[id]['jml'] = value;
        break;
      case "inputKetItem":
        listProduk[id]['ket'] = value;
        break;
      case "inputHarga":
        listProduk[id]['harga'] = value;
        break;
      default:
        break;
    }
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

  function loadDataInit(idProject) {

    $.ajax({
      url: '/app/proses.php?request=get-detail-project-modal-admin',
      type: "post",
      data: {
        id: idProject
      },
      success: function (response) {
        // console.log(JSON.parse(response));
        response = JSON.parse(response);
        let index = 0;

        response['itemData'].forEach(element => {
          listProduk[element['id_item_proyek']] = {
            jml: parseInt(element['jumlah']),
            harga: parseInt(element['harga_item']),
            nama: element['nama_item_proyek'],
            ket: element['keterangan']
          };
        });

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }
});