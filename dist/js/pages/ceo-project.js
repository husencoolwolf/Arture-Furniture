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
      if (event.status == "menunggu hasil survey" || event.status == "proses produksi" || event.status == "pengiriman") {
        element.addClass("bg-warning");
        element.children().children().addClass("text-dark");
      } else if (event.status == "selesai") {
        element.addClass("bg-success");
        element.children().children().addClass("text-light");
      } else if (event.status == "menunggu konfirmasi dp" || event.status == "menunggu konfirmasi pelunasan") {
        element.addClass("bg-info");
        element.children().children().addClass("text-light");
      } else {
        element.addClass("bg-danger");
        element.children().children().addClass("text-light");
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

  $('#formBatalProject').on("submit", function (event) {
    event.preventDefault();
    let form = $(this);
    $.ajax({
      url: form.attr('action') + "&id=" + form.data('id') + "&type=batal",
      type: "POST",
      data: $('#formBatalProject input').serialize(),
      success: function (response) {
        if (response) {
          location.reload();
        } else {
          location.href.replace("/?page=project&error=" + response);
        }
      }
    });
  });

  $('#konfirmasiUpdate').click(function () {
    konfirmasiUpdate();
  });

  $('#konfirmasiUpdateProduksi').click(function () {
    let idTarget = $('#konfirmasiUpdateProduksi').data('id');
    let progres = {};
    let keterangan = {};
    let itemSelesai = 0;
    let tipeUpdate = "";
    let banyakItem = $('#tabelUpdateSurvey tbody tr').length;
    let pesanSebelumUpdate = "";
    $('table#tabelUpdateSurvey tbody tr').each(function () {
      let tempProgres = $(this).find("input#inputProgresProduksi").val();
      if (tempProgres == "100") {
        itemSelesai += 1;
      }
      progres[$(this).data('id')] = tempProgres;
      keterangan[$(this).data('id')] = $(this).find("input#inputKetProduksi").val();
    });
    if (itemSelesai == banyakItem) {
      tipeUpdate = "progres-selesai";
      pesanSebelumUpdate = "Item Telah Selesai Semua, Apakah ingin Update Status?";
    } else {
      tipeUpdate = "progres";
      pesanSebelumUpdate = "Apakah ingin Update Status?";
    }
    if (confirm(pesanSebelumUpdate)) { //tanya ingin update?
      $.ajax({ //proses update
        url: "/app/proses.php?aksi=update-status-project&id=" + idTarget + "&type=" + tipeUpdate,
        type: "POST",
        data: {
          dataProgres: progres,
          dataKeterangan: keterangan
        },
        success: function (response) {
          if (response) {
            location.reload();
          } else {
            location.href.replace("/?page=project&error=" + response);
          }
        }
      });
    } else {}

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
    let keluaran = "";
    let keluaran2 = "";
    dataItem.forEach(element => {
      // debugger;
      let progres = "";
      let inputProgres = "";
      let inputKeterangan = "";
      // if (element['status']['status'] == "3.proses produksi") { //cek jika status adalah produksi
      //   progres = ": " + element['status']['progres'].toString() + "%";
      // } else {
      //   progres = "";
      // }
      grandTotal += parseInt(element['harga_item']);
      //output detail project tabel itemnya
      keluaran += "<tr>\
      <td>" + element['nama_item_proyek'] + "</td>\
      <td>" + element['jumlah'] + "</td>\
      <td>" + element['keterangan'] + "</td>\
      <td>" + formatRupiah(element['harga_item'], "Rp. ") + "</td>\
      <td>" + element['status'] + "</td>\
      <td>" + element['keterangan_s'] + "</td>\
      </tr>";
      //output tabel update progres produksi project
      if (element['progres'] == "100") {
        inputProgres = "<input class='form-control' type='number' min=0 max=100 value='" + element['progres'] + "' name='inputProgresProduksi' id='inputProgresProduksi' disabled></td>";
        inputKeterangan = "<td><input class='form-control' type='text' name='inputKetProduksi' id='inputKetProduksi'></td>";
      } else {
        inputProgres = "<input class='form-control' type='number' min=0 max=100 value='" + element['progres'] + "' name='inputProgresProduksi' id='inputProgresProduksi'></td>";
        inputKeterangan = "<td><input class='form-control' type='text' name='inputKetProduksi' id='inputKetProduksi'></td>";
      }
      keluaran2 += "<tr data-id='" + element['id_item_proyek'] + "'>\
      <td>" + element['nama_item_proyek'] + "</td>\
      <td>" + element['jumlah'] + "</td>\
      <td>" + formatRupiah(element['harga_item'], "Rp. ") + "</td>\
      <td>\
        <div class='input-group'>\
          <div class='input-group-prepend'>\
            <div class='input-group-text'>%</div>\
          </div>" +
        inputProgres +
        "</div>\
      </td>" +
        inputKeterangan +
        "</tr>";

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
          let progres = "";
          if (detailProject['status']['status'] == "3.proses produksi") { //cek jika status adalah produksi
            progres = ": " + detailProject['status']['progres'].toString() + "%";
          } else {
            progres = "";
          }
          $(this).html(detailProject['status']['status'] + progres);
          break;
        case 'grandTotal':
          $(this).html(formatRupiah(grandTotal, "Rp."));
          break;
        case 'produksiGrandTotal':
          $(this).html(formatRupiah(grandTotal, "Rp."));
          break;
        case 'statusSesudah':
          let field = $(this);
          $.get("/dist/php/project-status-order.php?status=" + detailProject['status']['origin'], function (data) {
            data = JSON.parse(data);
            field.html(data['selanjutnya']);
            field.data("selanjutnya", data['selanjutnya']);
            field.data("id", detailProject['id_proyek']);
            $('#formBatalProject').data("id", detailProject['id_proyek']);
            $('#konfirmasiUpdateProduksi').data("id", detailProject['id_proyek']);
          });
          break;
        case 'statusSebelum':
          $(this).html(detailProject['status']['origin']);
          break;
        default:
          break;
      }
    });
    $('.modalAction').each(function () {
      $(this).data("id", detailProject['id_proyek']);
    });
    // debugger;
    if (detailProject['status']['origin'] == "selesai" || detailProject['status']['origin'] == "batal") {
      $('button#updateStatus').hide();
    } else {
      if (detailProject['status']['origin'] == "proses produksi") {
        $('button#updateStatus:eq(0)').attr("data-target", "#modalUpdateProgress");
      } else {
        $('button#updateStatus:eq(0)').attr("data-target", "#modalUpdateStatus");
      }
      $('button#updateStatus').show();
    }
    $("table#tabelDetailProdukProject tbody").html(keluaran);
    $('table#tabelUpdateSurvey tbody').html(keluaran2);
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
          $("table#tabelProject tbody").html("<tr><td colspan='12' class='text-center'>Project Yang Anda Cari Tidak Ditemukan!!!</td></tr>");
        } else if (responseData == "0") {
          $("table#tabelProject tbody").html("<tr><td colspan='12' class='text-center'>Ada kesalahan pada sistem, harap menghubungi IT Admin!!!</td></tr>");
        } else {
          tabelVar.clear();
          responseData.forEach(element => {
            let progres = "";
            if (element['status']['status'] == "3.proses produksi") { //cek jika status adalah produksi
              progres = ": " + element['status']['progres'].toString() + "%";
            } else {
              progres = "";
            }
            tabelVar.rows.add($(
              "<tr>\
              <td>" + element['id_proyek'] + "</td>\
              <td>" + element['nama_proyek'] + "</td>\
              <td>" + element['nama_klien'] + "</td>\
              <td>" + element['dimulai'] + "</td>\
              <td>" + element['target_selesai'] + "</td>\
              <td>" + element['lokasi'] + "</td>\
              <td><span class='badge badge-pill badge-" + element['status']['warna'] + "'>" + element['status']['status'] + progres + "</span></td>\
              <td class='text-center'>\
                <a href='' data-id='" + element['id_proyek'] + "' class='btn btn-info btn-sm detailBtn' data-toggle='modal' data-target='#detailProjectModal'>\
                  <span data-feather='eye'></span>\
                </a>\
                <a href='/pages/parts/print_view/quotation.php?id=" + element['id_proyek'] + "' class='my-1 btn btn-primary btn-sm cetakBtn'>\
                      <span data-feather='download'></span>\
                    </a>\
                </td>\
            </tr>"
            )).draw();
          });
          reloadFrontAPI();
          reloadEventButtonTabel();
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
        let idProject = $(this).data("id");
        if (confirm('Anda yakin hapus ' + "data " + ' [' + idProject + '] ??')) {
          window.location.href = '/app/proses.php?aksi=hapus-project&id=' + idProject;
        } else {}
      } else if ($(this).hasClass("editBtn")) {
        event.preventDefault();
        let idProject = $(this).data("id");
        window.location.href = '/?page=edit-project&project=' + idProject;
      } else if ($(this).hasClass("cetakBtn")) {
        event.preventDefault();
        let idProject = $(this).data("id");
        window.location.href = '/pages/parts/print_view/quotation.php?id=' + idProject;
      }

    });
  }

  function konfirmasiUpdate() {
    let field = $('span[data-setter="statusSesudah"');
    let statusSelanjutnya = field.data("selanjutnya");
    let idTarget = field.data("id");

    $.ajax({
      url: "/app/proses.php?aksi=update-status-project&id=" + idTarget + "&type=update",
      type: "POST",
      data: {
        selanjutnya: statusSelanjutnya
      },
      success: function (response) {
        if (response) {
          location.reload();
        } else {
          location.href.replace("/?page=project&error=" + response);
        }
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