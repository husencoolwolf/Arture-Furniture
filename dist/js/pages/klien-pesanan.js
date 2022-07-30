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
    let counter = {
      "Belumbayar": 0,
      "Dibuat": 0,
      "Dikirim": 0,
      "Selesai": 0,
      "Batal": 0
    }
    Object.keys(dataItem).forEach(element => {
      // console.log(dataItem[element][0]['gambar']);

      let status = dataPesanan[element]['status'];
      let jmlHarga = 0;
      let namaProduk = "";
      let gambar = "";
      //foreach setiap produk pada suatu pesanan
      dataItem[element].forEach(element => {
        console.log(element);
        gambar = element['gambar'];
        jmlHarga += parseInt(element['harga_produk']);
        namaProduk += "-" + element['nama_produk'] + "<br>";
      });
      //set tabel
      if (status['status'] == "1.menunggu info bank" || status['status'] == "2.menunggu verifikasi bayar") {
        setDataTabel($('#tabelBelumbayar'), gambar, namaProduk, dataPesanan[element]['item'], formatRupiah(jmlHarga, "Rp. "), status['warna'], status['status'], dataPesanan[element]['id_pesanan']);
        counter['Belumbayar'] += 1;
      } else if (status['status'] == "3.pembuatan") {
        setDataTabel($('#tabelDibuat'), gambar, namaProduk, dataPesanan[element]['item'], formatRupiah(jmlHarga, "Rp. "), status['warna'], status['status'], dataPesanan[element]['id_pesanan']);
        counter['Dibuat'] += 1;
      } else if (status['status'] == "4.pengiriman") {
        setDataTabel($('#tabelDikirim'), gambar, namaProduk, dataPesanan[element]['item'], formatRupiah(jmlHarga, "Rp. "), status['warna'], status['status'], dataPesanan[element]['id_pesanan']);
        counter['Dikirim'] += 1;
      } else if (status['status'] == "5.selesai") {
        setDataTabel($('#tabelSelesai'), gambar, namaProduk, dataPesanan[element]['item'], formatRupiah(jmlHarga, "Rp. "), status['warna'], status['status'], dataPesanan[element]['id_pesanan']);
        counter['Selesai'] += 1;
      } else if (status['status'] == "6.batal") {
        setDataTabel($('#tabelBatal'), gambar, namaProduk, dataPesanan[element]['item'], formatRupiah(jmlHarga, "Rp. "), status['warna'], status['status'], dataPesanan[element]['id_pesanan']);
        counter['Batal'] += 1;
      }

    });
    checkKosong(counter);
    reloadFrontAPI();

  }

  function setDataTabel(tabel, gambar, nama, item, harga, warna, statusPesanan, idPesanan) {
    tabel
      .append($("<tr>")
        .append($("<td>")
          .append($("<img>")
            .attr("src", "/assets/produk/" + gambar)
            .addClass("img-preview")
          )
        )
        .append($("<td>")
          .html(nama.slice(0, -4))
          .addClass('text-elipsis')
        )
        .append($("<td>")
          .text(item)
          .css("width", "50px")
        )
        .append($("<td>")
          .text(harga)
        )
        .append($("<td>")
          .append($("<span>")
            .addClass("badge badge-pill badge-" + warna)
            .text(statusPesanan)
          )

        )
        .append($("<td>")
          .append($("<a>")
            .append($("<span>")
              .attr("data-feather", "eye")
            )
            .addClass("btn btn-sm btn-info mr-1")
            .attr("href", "/?page=co-sukses&pesanan=" + idPesanan)
            .attr("title", "Lihat Detail")
          )
          .append($("<a>")
            .append($("<span>")
              .attr("data-feather", "x-circle")
            )
            .addClass("btn btn-sm btn-danger batalBtn")
            .attr("href", "#")
            .attr("title", "Lihat Detail")
          )
        )
        .data("id", idPesanan)
      );
  }

  function checkKosong(counter) {
    console.log(counter);
    Object.keys(counter).forEach(element => {
      if (counter[element] == 0) {
        $('#tabel' + element)
          .append($("<tr>")
            .append($("<td>")
              .attr("colspan", "6")
              .css("text-align", "center")
              .append($("<span>")
                .attr("data-feather", "shopping-bag")
                .css("width", "200px")
                .css("height", "200px")
              )
              .append($("<p>")
                .text("Belum Ada Pesanan")
              )
            )
          )
      }
    });
  }

  function reloadFrontAPI(Tabel = false, element = false) {
    feather.replace();

  }
});