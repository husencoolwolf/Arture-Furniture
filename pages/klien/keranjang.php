<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pages/parts/navbars/klien-navbar.php';
$dataKeranjang = $db->getDataKeranjangUser($_SESSION['id_akun']);
?>

<script src="/dist/js/pages/klien-navbar.js"></script>
<script src="/dist/js/integer-to-rupiah.js"></script>
<script src="/dist/js/jquery.redirect.js"></script>
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <!-- <img src="" class="rounded mr-2" alt="..."> -->
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>

<div class="mb-4"></div>
<form action="/?page=checkout" method="post" id="formKeranjang">
  <div class="row mx-5">
    <div class="col-md-8 mb-3">
      <?php
      if (!$dataKeranjang) {
        echo ("<div class='w-100 h-100 p-5'>
        <div class='mx-auto my-auto text-center'>
        <h2>Keranjang Kamu Kosong Nih!!! <span?><i class='fa fa-frown-o' aria-hidden='true'></i></span></h2>
        <h2>Tambah Keranjang Kamu yuk</h2>
        <a href='/?page=home#catalog' class='btn btn-primary'>Lihat Catalog</a>'
        </div>
      </div>");
      } else {
        while ($row = mysqli_fetch_array($dataKeranjang)) {
      ?>
          <div class="list-group" data-id="<?= $row['id_produk'] ?>">
            <div class="list-group-item">
              <div class="row">
                <div class="col-1 my-auto">
                  <div class="checkbox">
                    <input class="align-items-center" type="checkbox" name="checkedProduk[]" id="" value="<?= $row['id_produk'] ?>">

                  </div>
                </div>
                <div class="col-3">
                  <img class="img-thumbnail" src="/assets/produk/<?= $row['gambar'] ?>" alt="">
                </div>

                <div class="col-8">
                  <div class="row">
                    <div class="col">
                      <p class="font-weight-bold"><?= $row['nama_produk'] ?></p>

                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="btn border-arture-emas quantity-control" id="minus-quantity" style="font-size: 15px;"><i class=" fa fa-minus" aria-hidden="true"></i></div>
                    <span>
                      <input type="number" name="quantity" id="quantity" class="input text-center border-arture-emas" style="width: 30px;line-height: 30px;font-size:14px;" value="<?= $row['jumlah'] ?>" min="1" max="10">
                    </span>

                    <div class="btn border-arture-emas quantity-control" id="plus-quantity" style="font-size: 15px;"><i class="fa fa-plus" aria-hidden="true"></i></div>
                    <button class="btn border-arture-emas ml-2 hapusBtn" style="font-size: 15px;" title="Hapus dari keranjang"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <button class="btn border-arture-emas ml-2 viewBtn" style="font-size: 15px;" title="Lihat Produk"><i class="fa fa-eye" aria-hidden="true"></i></button>


                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="font-weight-bold totalHarga">Total : <?= $db->intToRupiah((int)$row['harga_produk'] * (int)$row['jumlah']) ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>

    </div>
    <div class="col-md-4 mb-3">
      <h4>Total Belanja</h4>
      <div class="border border-arture-emas p-3">
        <div class="d-flex justify-content-between">
          <p class="font-weight-bold">Subtotal </p>
          <p class="font-weight-bold rupiah" id="subtotal">Rp.0</p>
        </div>
        <div class="d-flex justify-content-between">
          <p class="font-weight-bold">Pajak </p>
          <p class="font-weight-bold rupiah">Rp.0</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <p class="font-weight-bold">Grandtotal </p>
          <p class="font-weight-bold rupiah" id="grandtotal">Rp.0</p>
        </div>
      </div>
      <button class="btn btn-arture-emas w-100 my-4" id="checkout">
        <p class="font-weight-bold my-auto">Checkout</p>
      </button>
    </div>

  </div>
</form>