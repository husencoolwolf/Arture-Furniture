$(document).ready(function () {
  updateKeranjang(); //inisiasi jumlah keranjang
  $('.quantity-control').click(function () {
    var quantity = Number($('#quantity').val());
    if ($(this).attr('id') == 'minus-quantity') {
      // console.log($('#quantity').val());
      if (quantity > 1) {
        $('#quantity').val(quantity - 1);
      }

    } else {
      if (quantity < 10) {
        $('#quantity').val(quantity + 1);
      }
    }
  });

  $('#quantity').change(function () {
    var val = $(this).val();
    if (val < 1) {
      $(this).val(1);
    } else if (val > 10) {
      $(this).val(10);
    }
  });

  $('#keranjangBtn').click(function () {
    $.ajax({
      url: "/app/proses.php?aksi=tambah-keranjang",
      type: "post",
      data: {
        id: GetURLParameter('produk'),
        quantity: $('#quantity').val()
      },
      success: function (response) {
        updateKeranjang();
        $('.toast-body').html(response);
        $('.toast').toast('show');
      }
    });
  });

  $('#orderBtn').click(function () {
    $.redirect("/?page=checkout", {
      'id': $(this).data("produk"),
      'jml': $('#quantity').val()
    });
  });

  function updateKeranjang() {
    $.ajax({
      type: "GET",
      url: "/app/proses.php?request=update-keranjang",
      dataType: "html",
      success: function (response) {
        $("#jmlKeranjang").html(response);
      }
    });
  }

});