<?php
if(!isset($_GET['status'])){

}else{
  $statusstring = $_GET['status'];
  switch ($statusstring) {
      case 'menunggu info bank':
          echo(json_encode(array("status" => "1." . $statusstring, "warna" => "warning", "selanjutnya"=> "menunggu verifikasi bayar"))); 
          break;
      case 'menunggu verifikasi bayar':
          echo(json_encode(array("status" => "2." . $statusstring, "warna" => "primary", "selanjutnya"=> "pembuatan"))); 
          break;
      case 'pembuatan':
          echo(json_encode(array("status" => "3." . $statusstring, "warna" => "warning", "selanjutnya"=> "pengiriman"))); 
          break;
      case 'pengiriman':
          echo(json_encode(array("status" => "4." . $statusstring, "warna" => "warning", "selanjutnya"=> "selesai"))); 
          break;
      case 'selesai':
          echo(json_encode(array("status" => "5." . $statusstring, "warna" => "success", "selanjutnya"=> false))); 
          break;
      case 'batal':
          echo(json_encode(array("status" => "6." . $statusstring, "warna" => "danger", "selanjutnya"=> false))); 
          break;
  }
}
