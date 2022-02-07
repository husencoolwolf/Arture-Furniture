(function () {
  feather.replace()

}())

$(document).ready( function () {
  $('#tabelProduk').DataTable({
    // opsi fungsi yang di pakai datatables
    "paging":   false,
    "info": false,
    "fixedHeader": true,
    "scrollY": "500px",
    "scrollCollapse": true
  });

  $('.hapusBtn').click(function(){
    // console.log();
    var idProduk = $(this).parent().parent().find('td').eq(0).html();
    var namaProduk = $(this).parent().parent().find('td').eq(2).html()
    if (confirm('Anda yakin hapus '+namaProduk+' ['+idProduk+'] ??')) {
        window.location.href = '/app/proses.php?aksi=hapus-produk&id='+idProduk;
    } else {
    }
  });
} );