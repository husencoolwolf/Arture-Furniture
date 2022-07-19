<?php
if (!isset($_GET['status'])) {
} else {
  $statusstring = $_GET['status'];

  switch ($statusstring) {
    case 'menunggu hasil survey':
      echo (json_encode(array("status" => "1." . $statusstring, "warna" => "warning", "selanjutnya" => 'menunggu konfirmasi dp')));
      break;
    case 'menunggu konfirmasi dp':
      echo (json_encode(array("status" => "2." . $statusstring, "warna" => "primary", "selanjutnya" => 'proses produksi')));
      break;
    case 'proses produksi':
      echo (json_encode(array("status" => "3." . $statusstring, "warna" => "warning", "selanjutnya" => 'pengiriman')));
      break;
    case 'pengiriman':
      echo (json_encode(array("status" => "4." . $statusstring, "warna" => "warning", "selanjutnya" => 'menunggu konfirmasi pelunasan')));
      break;
    case 'menunggu konfirmasi pelunasan':
      echo (json_encode(array("status" => "5." . $statusstring, "warna" => "primary", "selanjutnya" => 'selesai')));
      break;
    case 'selesai':
      echo (json_encode(array("status" => "6." . $statusstring, "warna" => "success", "selanjutnya" => false)));
      break;
    case 'batal':
      echo (json_encode(array("status" => "7." . $statusstring, "warna" => "danger", "selanjutnya" => false)));
      break;
  }
}
