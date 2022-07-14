(function () {
  feather.replace()

}())

$(document).ready(function () {
  let filterDari = $("#tanggalDari").val(),
    filterSampai = $("#tanggalSampai").val();
  reloadEventButtonTabel();
  setEventButtonModal()

  $('#calendar').fullCalendar({
    displayEventTime: false,
    editable: false,
    selectHelper: true,
    eventLimit: true, // allow "more" link when too many events
    header: {
      left: 'prev, next today',
      center: 'title',
      right: 'month, agendaWeek, agendaDay'
    },
    events: '/app/proses.php?request=get-calendar-project',
    eventClick: function (event) {
      $('#detailProjectModal .modal-body .lds-ring div').css("border-color", "#000000 transparent transparent transparent");
      let loading = $('#detailProjectModal .modal-body .lds-ring').css("display", "inline-block");
      let isiModal = $('#detailProjectModal .modal-body .modal-isi').hide();
      $('#detailProjectModal').modal('show');
      let idProject = event.id;
      setDetailProjectModal(idProject, loading, isiModal);
    },
    eventRender: function (event, element) {
      switch (event.status) {
        case "selesai":
          element.addClass("bg-success");
          element.children().children().addClass("text-light");
          break;

        default:
          element.addClass("bg-warning");
          element.children().children().addClass("text-dark");
          break;
      }
    }
  });

  var tabelVar = $('#tabelProject').DataTable({
    // opsi fungsi yang di pakai datatables
    "paging": false,
    "info": true,
    "fixedHeader": true,
    "scrollY": "500px",
    "sScrollX": "100%",
    "sScrollXInner": "100%",
    "scrollCollapse": true,
    "order": [
      [6, "asc"]
    ]
  });

  $(".filterTabel").change(function () {
    updateTabel();
  });



  function setDetailProjectModal(idProject, loading, isiModal) {

    $.ajax({
      url: '/app/proses.php?request=get-detail-project-modal-admin',
      type: "post",
      data: {
        id: idProject
      },
      success: function (response) {
        loading.hide();
        isiModal.show();
        setDataProjectModal(response);

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function setDataProjectModal(response) {
    responseData = JSON.parse(response);
    console.log(responseData);
    let detailProject = responseData['projectData'];
    let dataItem = responseData['itemData'];
    let grandTotal = 0;
    let keluaran;
    let keluaran2;
    dataItem.forEach(element => {
      grandTotal += parseInt(element['harga_item']);
      keluaran += "<tr>\
      <td>" + element['nama_item_proyek'] + "</td>\
      <td>" + element['jumlah'] + "</td>\
      <td>" + element['keterangan'] + "</td>\
      <td>" + formatRupiah(element['harga_item'], "Rp. ") + "</td>\
      <td>" + element['status'] + "</td>\
      </tr>\
      ";
    });

    $("[data-setter]").each(function () {
      switch ($(this).data('setter')) {
        case 'idProject':
          $(this).html(detailProject['id_proyek']);
          break;
        case 'namaProyek':
          $(this).html(detailProject['nama_proyek']);
          break;
        case 'lokasiProyek':
          $(this).html(detailProject['lokasi']);
          break;
        case 'tanggalInput':
          $(this).html(detailProject['dibuat']);
          break;
        case 'tanggalProyek':
          $(this).html(detailProject['dimulai'] + " / " + detailProject['target_selesai']);
          break;
        case 'namaKlien':
          $(this).html(detailProject['nama_klien']);
          break;
        case 'alamatKlien':
          $(this).html(detailProject['alamat']);
          break;
        case 'emailKlien':
          $(this).html(detailProject['email']);
          break;
        case 'nopeKlien':
          $(this).html(detailProject['nomor_hp']);
          break;
        case 'statusProyek':
          $(this).html(detailProject['status']);
          break;
        case 'grandTotal':
          $(this).html(formatRupiah(grandTotal, "Rp."));
          break;
        default:
          break;
      }
    });
    $('.modalAction').data("id", detailProject['id_proyek']);
    $("table#tabelDetailProdukProject tbody").html(keluaran);
  }

  function updateTabel() {
    filterDari = $("#tanggalDari").val();
    filterSampai = $("#tanggalSampai").val();
    $.ajax({
      url: '/app/proses.php?request=update-tabel-project-admin',
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
              <td>" + element['id_proyek'] + "</td>\
              <td>" + element['nama_proyek'] + "</td>\
              <td>" + element['nama_klien'] + "</td>\
              <td>" + element['dimulai'] + "</td>\
              <td>" + element['target_selesai'] + "</td>\
              <td>" + element['lokasi'] + "</td>\
              <td>" + element['status'] + "</td>\
              <td class='text-center'>\
                <a href='/?page=edit-project&project=" + element['id_proyek'] + "' class='btn btn-success btn-sm'>\
                  <span data-feather='edit'></span>\
                </a>\
                <a href='' data-id='" + element['id_proyek'] + "' class='btn btn-danger btn-sm hapusBtn'>\
                  <span data-feather='trash'></span>\
                </a>\
                <a href='' data-id='" + element['id_proyek'] + "' class='btn btn-info btn-sm detailBtn' data-toggle='modal' data-target='#detailProjectModal'>\
                  <span data-feather='eye'></span>\
                </a>\
                </td>\
            </tr>";

          });
          $("table#tabelProject tbody").html(outputan);
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
    $('table#tabelProject tbody > tr > td .hapusBtn').click(function () {
      // console.log();
      event.preventDefault();
      let idProject = $(this).data("id")
      if (confirm('Anda yakin hapus ' + "data " + ' [' + idProject + '] ??')) {
        window.location.href = '/app/proses.php?aksi=hapus-project&id=' + idProject;
      } else {}
    });

    $('table#tabelProject tbody > tr > td .detailBtn').on("click", function () {
      $('#detailProjectModal .modal-body .lds-ring div').css("border-color", "#000000 transparent transparent transparent");
      let loading = $('#detailProjectModal .modal-body .lds-ring').css("display", "inline-block");
      let isiModal = $('#detailProjectModal .modal-body .modal-isi').hide();
      let idProject = $(this).data("id")
      setDetailProjectModal(idProject, loading, isiModal);
    });
  }

  function setEventButtonModal() {
    $(".modalAction").click(function () {
      if ($(this).hasClass("hapusBtn")) {
        event.preventDefault();
        let idProject = $(this).data("id")
        if (confirm('Anda yakin hapus ' + "data " + ' [' + idProject + '] ??')) {
          window.location.href = '/app/proses.php?aksi=hapus-project&id=' + idProject;
        } else {}
      } else {
        alert("edit");
      }
    });
  }

  function reloadFrontAPI(Tabel = false) {
    feather.replace();
    if (Tabel != false) {
      Tabel.draw();
    }
  }
});