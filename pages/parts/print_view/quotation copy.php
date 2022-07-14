<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/database.php';
// include_once $_SERVER['DOCUMENT_ROOT'] . '/dist/php/dompdf/autoload.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dist/php/html2pdf/vendor/autoload.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/dist/php/html2pdf/vendor/spipu/html2pdf/src/Html2Pdf.php';
$db = new database;
$base = $_SERVER['DOCUMENT_ROOT'];


ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
  <table class="table">
    <thead>
      <tr>
        <th>a</th>
        <th>b</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>2</td>
      </tr>
    </tbody>
  </table>
</body>

</html>

<?php

// $html = ob_get_clean();
$html = ob_get_contents();
ob_end_clean();

// use Dompdf\Dompdf;


// $pdf = new Dompdf();
// $pdf->load_html($html);
// $pdf->set_option('isRemoteEnabled', TRUE);
// $pdf->set_paper("A4", "potrait");
// $pdf->set_option('viewport-size', '1024x768');
// $pdf->render();
// $pdf->stream('Laporan ' . date("F j, Y") . '.pdf', array('Attachment' => 0));
// exit(0);



use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


try {
  $html2pdf = new Html2Pdf('P', 'A4', 'en');
  $html2pdf->setTestTdInOnePage(false);
  $html2pdf->writeHTML($html);
  $html2pdf->output();
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}

// try {
//   use Spipu\Html2Pdf\Html2Pdf;
//   use Spipu\Html2Pdf\Exception\Html2PdfException;
//   use Spipu\Html2Pdf\Exception\ExceptionFormatter;

//   $html2pdf = new Html2Pdf('P', 'A4', 'fr');
//   $html2pdf->setDefaultFont('Arial');
//   $html2pdf->writeHTML($html);
//   $html2pdf->output();
// } catch (Html2PdfException $e) {
//   $html2pdf->clean();

//   $formatter = new ExceptionFormatter($e);
//   echo $formatter->getHtmlMessage();
// }
?>