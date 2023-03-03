<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Makanan Rumahan - Pre-Order</title>
  <!-- Menambahkan Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Style tambahan */
    .header {
      background-color: #fff;
      padding: 40px 0;
      text-align: center;
    }

    .header h1 {
      color: #333;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .header p {
      color: #777;
    }

    .menu {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 40px;
    }

    .menu div {
      width: 20%;
      padding: 20px;
      text-align: center;
    }

    .menu img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .menu h2 {
      color: #333;
      font-weight: bold;
      margin: 20px 0 10px;
    }

    .menu p {
      color: #777;
    }

    .btn-order {
      display: block;
      margin: 40px auto 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      text-align: center;
      border-radius: 50px;
    }

    .btn-order:hover {
      background-color: #444;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <h1>Makanan Rumahan</h1>
    <p>Pre-Order Sekarang</p>
  </header>
  <!-- Menu -->
  <section class="menu">
    <!-- Contoh menu -->
    <div>
      <img src="https://via.placeholder.com/300x200" alt="menu 1">
      <h2>Menu 1</h2>
      <p>Harga: Rp. 10.000</p>
    </div>
    <div>
      <img src="https://via.placeholder.com/300x200" alt="menu 2">
      <h2>Menu 2</h2>
      <p>Harga: Rp. 12.000</p>
    </div>
    <!-- dst -->
  </section>
  <!-- Tombol Pre-Order -->
  <a href="https://wa.me/nomor_whatsapp_anda" class="btn-