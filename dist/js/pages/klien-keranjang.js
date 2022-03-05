$(document).ready(function () {
//inisiasi semua produk jangan di check
$('input[name="checkedProduk[]"]:checked').each(function(){
  $(this).prop('checked', false);
});

  var hargaProduk = [];
  var jmlProduk = [];
  var produkChecked = [];
  var hrgProdukChecked = [];
  var jmlProdukChecked = [];

  setHargaJumlahProduk();

  $('.quantity-control').click(function () {
    jmlProdukChecked = [];
    var indexBaris = $(this).parent().parent().parent().parent().parent().index();
    var inputNomor = $('.list-group').eq(indexBaris).children().children().children().eq(2).children().eq(1).children().eq(1).children();
    var quantity = Number(inputNomor.val());
    if ($(this).attr('id') == 'minus-quantity') {
      // console.log($('#quantity').val());
      if (quantity > 1) {
        quantity = quantity - 1;
        inputNomor.val(quantity);
      }

    } else {
      if (quantity < 10) {
        quantity = quantity + 1;
        inputNomor.val(quantity); 
      }
    }
    jmlProduk[indexBaris]=quantity;
    $('input[name="checkedProduk[]"]:checked').each(function () {
      jmlProdukChecked.push(Number($(this).parent().parent().parent().find('div').eq(3).children().eq(1).children("span").children("input").val()));
    });

    //update subtotal

    setSubtotal();
    setGrandtotal()
    setTotal(indexBaris);
  });

  $('.input').change(function () {
    jmlProdukChecked= [];
    var indexBaris = $(this).parent().parent().parent().parent().parent().parent().index();

    var val = $(this).val();
    if (val < 1) {
      $(this).val(1);
    } else if (val > 10) {
      $(this).val(10);
    }

    jmlProduk[indexBaris] = $(this).val();
    $('input[name="checkedProduk[]"]:checked').each(function () {
      jmlProdukChecked.push(Number($(this).parent().parent().parent().find('div').eq(3).children().eq(1).children("span").children("input").val()));
    });
    
    setSubtotal();
    setGrandtotal()
    setTotal(indexBaris);
  });


  $('input[name="checkedProduk[]"]').change(function () {
    // console.log($('input[name="checkedProduk"]:checked').parent().parent().parent().parent().parent().data('id'));
    produkChecked = [];
    hrgProdukChecked = [];
    jmlProdukChecked = [];
    $('input[name="checkedProduk[]"]:checked').each(function () {
      produkChecked.push($(this).parent().parent().parent().parent().parent().data('id'));
      jmlProdukChecked.push(Number($(this).parent().parent().parent().find('div').eq(3).children().eq(1).children("span").children("input").val()));
    });
    $.ajax({
      url: "/app/proses.php?request=harga-produk-banyak-id",
      type: "post",
      data: {
        id: produkChecked
      },
      success: function (response) {
        hrgProdukChecked = JSON.parse(response);
        setSubtotal();
        setGrandtotal()
      }
    });
    // console.log(produkChecked);
  });

  $('.viewBtn').click(function(){
    event.preventDefault();
    var listParent = $(this).parent().parent().parent().parent().parent();
    var idProduk = listParent.data('id');

    window.location.href="/?page=produk&produk="+idProduk;
  });

  $('.hapusBtn').click(function(){
    event.preventDefault();
    var listParent = $(this).parent().parent().parent().parent().parent();
    var idProduk = listParent.data('id');
    if(confirm("Hapus produk ini dari keranjang?")){
      $.ajax({
        url: "/app/proses.php?aksi=hapus-keranjang-user",
        type: "post",
        data: {
          id: idProduk
        },
        success: function (response) {
          $('.toast > .toast-body').html(response);
          $('.toast').toast('show');
          listParent.remove();
          updateKeranjang();
        }
      });

    }else{
    }
    
  });

  $('#checkout').click(function(){
    event.preventDefault();
    if(produkChecked.length>0){
      // $.ajax({
      //   url: "/app/proses.php?aksi=checkout",
      //   type: "post",
      //   data: {
      //     id: produkChecked
      //   },
      //   success: function (response) {
      //     $('#formKeranjang').submit();
      //   }
      // });
      $.redirect("/?page=checkout", {'id':produkChecked.toString(), 'jml':jmlProdukChecked.toString()});
    }else{
      alert("Harap pilih produk yang akan di checkout!!");
    }
    
  });

  //fungsi
  function setSubtotal(){
    if (hrgProdukChecked.length > 0) {
      var total = 0;
      for (let i = 0; i < hrgProdukChecked.length; i++) {
        total = total + (hrgProdukChecked[i] * jmlProdukChecked[i]);
      }
      $('#subtotal').html(formatRupiah(total.toString(), 'Rp. '));
    } else {
      $('#subtotal').html("Rp.0");
    }
  }

  function setGrandtotal(){
    if (hrgProdukChecked.length > 0) {
      var total = 0;
      for (let i = 0; i < hrgProdukChecked.length; i++) {
        total = total + (hrgProdukChecked[i] * jmlProdukChecked[i]);
      }
      $('#grandtotal').html(formatRupiah(total.toString(), 'Rp. '));
    } else {
      $('#grandtotal').html("Rp.0");
    }
  }

  function setHargaJumlahProduk(){
    $.ajax({
      url: "/app/proses.php?request=req-harga-jml-produk",
      type: "post",
      success: function (response) {
        data = response.split("|");
        hargaProduk = JSON.parse(data[0]);
        jmlProduk = JSON.parse(data[1]);
      }
    });
  }

  function setTotal(ind){
    total = hargaProduk[ind] * jmlProduk[ind];
    // console.log("a");
    $('.totalHarga').eq(ind).html("Total : " + formatRupiah(total.toString(), 'Rp. '));
  }
  
  function updateKeranjang(){
    $.ajax({  
      type: "GET",
      url: "/app/proses.php?request=update-keranjang",             
      dataType: "html",                
      success: function(response){                    
          $("#jmlKeranjang").html(response); 
      }
    });
  }
});