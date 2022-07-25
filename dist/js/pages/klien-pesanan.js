$(document).ready(function () {

  $.ajax({
    url: '/app/proses.php?request=req-data-pesanan-klien',
    type: "post",
    success: function (response) {
      setTabel(response);

    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    }
  });

  function setTabel(response) {

    let dataResponse = JSON.parse(response);
    dataPesanan = dataResponse['dataPesanan'];
    dataItem = dataResponse['dataProduk'];

    Object.keys(dataItem).forEach(element => {
      // console.log(dataItem[element][0]['gambar']);
      let jmlHarga = 0;
      let namaProduk = "";
      let gambar = "";
      //foreach setiap produk pada suatu pesanan
      dataItem[element].forEach(element => {
        console.log(element);
        gambar = element['gambar'];
        jmlHarga += parseInt(element['harga_produk']);
        namaProduk += element['nama_produk'] + " ";
      });
      //set tabel
      $("table#tabelPesanan")
        .append($("<tr>")
          .append($("<td>")
            .append($("<img>")
              .attr("src", "/assets/produk/" + gambar)
              .addClass("img-preview")
            )
          )
          .append($("<td>")
            .text(namaProduk)
            .addClass('text-elipsis')
          )
          .append($("<td>")
            .text(dataPesanan[element]['item'])
          )
          .append($("<td>")
            .text(jmlHarga)
          )
          .append($("<td>")
            .text(dataPesanan[element]['status'])
          )
        );

    });
  }
});