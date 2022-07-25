$(document).ready(function () {
  var dataAkun;
  var dataPesanan;

  $.ajax({
    url: "/app/proses.php?request=get-pesanan-akun-list-pembayaran-admin",
    type: "POST",
    success: function (response) {
      response = JSON.parse(response);
      // console.log(response);
      dataAkun = response['akun'];
      dataPesanan = response['pesanan'];
      setKlien();
    }
  });


  $('#selectKlien').on("change", function () {
    if (dataPesanan[$(this).val()] === undefined) {
      setPesanan();
    } else {
      setPesanan($(this).val());
    }
  });

  function setKlien() {
    let klienField = $('#selectKlien');
    let output = '';
    Object.keys(dataAkun).forEach(key => {
      output += '<option value="' + key + '">' + key + ' | ' + dataAkun[key]['nama'] + '</option>';
    });
    klienField.html("");
    klienField.html(output);
    klienField.selectpicker('refresh');
  }

  function setPesanan(k = false) {
    let pesananField = $('#selectPesanan');
    let output = '';
    if (k != false) {
      dataPesanan[k].forEach(key => {
        output += '<option value="' + key + '">' + key + '</option>';
      });
    }
    pesananField.html("");
    pesananField.html(output);
    pesananField.val('').selectpicker("refresh");
  }
});

(function () {
  feather.replace()


}())