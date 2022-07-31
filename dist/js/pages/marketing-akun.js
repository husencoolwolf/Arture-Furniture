(function () {
  feather.replace()

}())

$(document).ready(function () {
  // $(".tersediaBtn").replaceWith(feather.icons['stop-circle'].toSvg());
  reloadEventButtonTabel();
  var tabelVar = $('#tabelAkun').DataTable({
    // opsi fungsi yang di pakai datatables
    "paging": false,
    "info": false,
    "fixedHeader": true,
    "scrollY": "500px",
    "sScrollX": "100%",
    "sScrollXInner": "100%",
    "scrollCollapse": true,
    "order": [
      [3, "desc"]
    ]
  });

  function reloadEventButtonTabel() {
    $('table#tabelAkun tbody > tr > td .hapusBtn').click(function () {
      // console.log();
      event.preventDefault();
      let idAkun = $(this).data("id")
      if (confirm('Anda yakin hapus ' + "data " + ' [' + idAkun + '] ??')) {
        window.location.href = '/app/proses.php?aksi=hapus-akun&id=' + idAkun;
      } else {}
    });

    $('table#tabelAkun tbody > tr > td .detailBtn').on("click", function () {
      $('#detailAkunModal .modal-body .lds-ring div').css("border-color", "#000000 transparent transparent transparent");
      let loading = $('#detailAkunModal .modal-body .lds-ring').css("display", "inline-block");
      let isiModal = $('#detailAkunModal .modal-body .modal-isi').hide();
      let idAkun = $(this).data("id")
      setdetailAkunModal(idAkun, loading, isiModal);
    });
  }

  function setdetailAkunModal(idAkun, loading, isiModal) {
    $.ajax({
      url: '/app/proses.php?request=get-detail-akun-modal-admin',
      type: "post",
      data: {
        id: idAkun
      },
      success: function (response) {
        // console.log(response);
        loading.hide();
        isiModal.show();
        setDataAkunModal(response);

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      }
    });
  }

  function setDataAkunModal(response) {
    responseData = JSON.parse(response);
    $("[data-setter]").each(function () {
      switch ($(this).data('setter')) {
        case 'idAkun':
          $(this).html(responseData['id_akun']);
          break;
        case 'usernameAkun':
          $(this).html(responseData['username']);
          break;
        case 'namaAkun':
          $(this).html(responseData['nama']);
          break;
        case 'passwordAkun':
          $(this).html(responseData['password']);
          break;
        case 'privilegeAkun':
          $(this).html(responseData['nama_hak_akses']);
          break;
        case 'alamatAkun':
          $(this).html(responseData['alamat']);
          break;
        case 'emailAkun':
          $(this).html(responseData['email']);
          break;
        case 'nope':
          $(this).html(responseData['nomor_hp']);
          break;
        default:
          break;
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