(function () {
  feather.replace()

}())

$(document).ready(function () {
  let filterDari = $("#tanggalDari").val(),
    filterSampai = $("#tanggalSampai").val();
  reloadEventButtonTabel();

  var tabelVar = $('#tabelPesanan').DataTable({
    // opsi fungsi yang di pakai datatables
    "paging": false,
    "info": false,
    "fixedHeader": true,
    "scrollY": "500px",
    "sScrollX": "100%",
    "sScrollXInner": "100%",
    "scrollCollapse": true,
    "order": [
      [1, "desc"]
    ]
  });

  $(".filterTabel").change(function () {
    updateTabel();
  });

  function updateTabel() {
    filterDari = $("#tanggalDari").val();
    filterSampai = $("#tanggalSampai").val();
    $.ajax({
      url: '/app/proses.php?request=update-tabel-pesanan-admin',
      type: "post",
      data: {
        dari: filterDari,
        sampai: filterSampai
      },
      success: function (response) {
        let responseData = JSON.parse(response);
        if (responseData == "-1") {
          $("table#tabelPesanan tbody").html("<tr><td colspan='12' class='text-center'>Pesanan Yang Anda Cari Tidak Ditemukan!!!</td></tr>");
        } else if (responseData == "0") {
          $("table#tabelPesanan tbody").html("<tr><td colspan='12' class='text-center'>Ada kesalahan pada sistem, harap menghubungi IT Admin!!!</td></tr>");
        } else {
          let outputan = "";
          responseData.forEach(element => {
            outputan += "\
            <tr>\
              <td>" + element['id_pesanan'] + "</td>\
              <td>" + element['tanggal_dibuat'] + "</td>\
              <td>" + element['metode'] + "</td>\
              <td>" + element['item'] + "</td>\
              <td>" + element['nama'] + "</td>\
              <td>" + element['status'] + "</td>\
              <td class='text-center'>\
                <a href='/?page=edit-pesanan&pesanan=" + element['id_pesanan'] + "' class='btn btn-success btn-sm'>\
                  <span data-feather='edit'></span>\
                </a>\
                <a href='' data-id='" + element['id_pesanan'] + "' class='btn btn-danger btn-sm hapusBtn'>\
                  <span data-feather='trash'></span>\
                </a>\
                <a href='' data-id='" + element['id_pesanan'] + "' class='btn btn-info btn-sm detailBtn' data-toggle='modal' data-target='#detailPesananModal'>\
                  <span data-feather='eye'></span>\
                </a>\
                </td>\
            </tr>";

          });
          $("table#tabelPesanan tbody").html(outputan);
          reloadFrontAPI();
          reloadEventButtonTabel();
          // tabelVar.draw();
        }


      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function reloadEventButtonTabel() {
    $('table#tabelPesanan tbody > tr > td .hapusBtn').click(function () {
      // console.log();
      event.preventDefault();
      let idPesanan = $(this).data("id")
      if (confirm('Anda yakin hapus ' + "data " + ' [' + idPesanan + '] ??')) {
        window.location.href = '/app/proses.php?aksi=hapus-pesanan&id=' + idPesanan;
      } else {}
    });

    $('table#tabelPesanan tbody > tr > td .detailBtn').on("click", function () {
      $('#detailPesananModal .modal-body .lds-ring div').css("border-color", "#000000 transparent transparent transparent");
      let loading = $('#detailPesananModal .modal-body .lds-ring').css("display", "inline-block");
      let isiModal = $('#detailPesananModal .modal-body .modal-isi').hide();
      let idPesanan = $(this).data("id")
      setDetailPesananModal(idPesanan, loading, isiModal);
    });
  }

  function setDetailPesananModal(idPesanaan, loading, isiModal) {
    $.ajax({
      url: '/app/proses.php?request=get-detail-pesananan-modal-admin',
      type: "post",
      data: {
        id: idPesanaan
      },
      success: function (response) {
        loading.hide();
        isiModal.show();
        setDataPesananModal(response);

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function setDataPesananModal(response) {
    responseData = JSON.parse(response);
    let detailPesanan = responseData['detail_pesanan'];
    let historyStatus = responseData['history_status'];
    let dataProduk = responseData['produk_pesanan'];
    let dataPembayaran = responseData['detail_pembayaran'];
    let grandTotal = 0;
    let keluaran;
    let keluaran2;
    historyStatus.forEach(element => {
      keluaran += "<tr>\
      <td>" + element['status'] + "</td>\
      <td>" + element['tanggal'] + "</td>\
      <td>" + element['keterangan'] + "</td>\
      </tr>\
      ";
    });
    dataProduk.forEach(element => {
      // Hitung grand total setiap row db
      grandTotal += (parseInt(element['jumlah']) * parseInt(element['harga_produk']));
      keluaran2 += "<tr>\
      <td><img class='produk-thumbnail' src='/assets/produk/" + element['gambar'] + "'></td>\
      <td>" + element['nama_produk'] + "</td>\
      <td>" + element['jumlah'] + "</td>\
      <td>" + formatRupiah(element['harga_produk'], "Rp. ") + "</td>\
      <td>" + formatRupiah((parseInt(element['jumlah']) * parseInt(element['harga_produk'])).toString(), "Rp. ") + "</td>\
      </tr>\
      ";
    });
    console.log(grandTotal);
    $("[data-setter]").each(function () {
      switch ($(this).data('setter')) {
        case 'idPesanan':
          $(this).html(detailPesanan['id_pesanan']);
          break;
        case 'tanggalPesanan':
          $(this).html(detailPesanan['tanggal_pesan']);
          break;
        case 'idKlien':
          $(this).html(detailPesanan['id_klien']);
          break;
        case 'namaKlien':
          $(this).html(detailPesanan['nama']);
          break;
        case 'alamatKlien':
          $(this).html(detailPesanan['alamat']);
          break;
        case 'emailKlien':
          $(this).html(detailPesanan['email']);
          break;
        case 'nopeKlien':
          $(this).html(detailPesanan['nomor_hp']);
          break;
        case 'metodePesanan':
          $(this).html(detailPesanan['metode']);
          break;
        case 'statusPesanan':
          $(this).html(detailPesanan['status']);
          break;
        case 'grandTotal':
          $(this).html(formatRupiah(grandTotal, "Rp."));
          break;
        default:
          break;
      }
    });
    $("table#tabelHistoryStatus tbody").html(keluaran);
    $("table#tabelDetailProdukPesanan tbody").html(keluaran2);
    $("table#subDetailPembayaran tbody").html(dataPembayaran);
  }

  function reloadFrontAPI(Tabel = false) {
    feather.replace();
    if (Tabel != false) {
      Tabel.draw();
    }
  }
});