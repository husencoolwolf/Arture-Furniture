<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/dist/php/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

ob_start();
?>

<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
    table {
      width: 100%;
    }

    /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/

    /** Define now the real margins of every page in the PDF **/
    body {
      margin-top: 5cm;
      margin-left: 0cm;
      margin-right: 0cm;
      margin-bottom: 2.1cm;
    }

    /** Define the header rules **/
    header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;

      /** Extra personal styles **/
      /* background-color: #03a9f4;
      color: white;
      text-align: center;
      line-height: 1.5cm; */
    }

    /** Define the footer rules **/
    footer {
      position: fixed;
      bottom: 0cm;
      left: 0cm;
      right: 0cm;
      height: 2cm;

      /** Extra personal styles **/
      /* background-color: #03a9f4;
      color: white;
      text-align: center;
      line-height: 1.5cm; */
    }

    table#tabelQuotation.table-bordered tr td {
      border: 1px solid black !important;
    }
  </style>
</head>

<body>
  <!-- Define header and footer blocks before your content -->
  <header class="header-page">
    <div class="row">
      <img src="https://i.imgur.com/YuJoqed.jpg" width="160px" height="auto">
    </div>
    <div class="row mt-0">
      <div class="p-0 text-right text-center" style="width: 100%; height: 1.5rem;line-height: 20px;background-color: #ffd966;">
        <span class="p-1 bg-white" style="position: relative;float: right; margin-right: 50px;width: auto; font-size: 40px;font-weight: lighter;">
          <p class="text-center">QUOTATION</p>
        </span>
      </div>
    </div>
  </header>

  <footer class="footer-page">
    <table class="w-100">
      <tr>
        <td colspan="2">
          <div class="w-100" style="height: 5px;background-color: #ffd966;"></div>
        </td>
      </tr>
      <tr>
        <td>
          <p class="m-1" style="font-size: 14px;">Jl. Tebet Timur Dalam VIII E no.4</p>
          <p class="m-1" style="font-size: 14px;">Jakarta Selatan. 12820</p>
          <p class="m-1" style="font-size: 14px;"><a href="mailto:arture.furniture@gmail.com">Arture.furniture@gmail.com</a> / <a href="https://api.whatsapp.com/send?phone=6287888525264">+62 878 8852 5264</a></p>
        </td>
        <td>
          <img src="https://i.imgur.com/YuJoqed.jpg" class="ml-auto" height="auto" width="100px" style="vertical-align: middle;">
        </td>
      </tr>
    </table>
  </footer>

  <!-- Wrap the content of your PDF inside a main tag -->
  <main>


    <div id="pendahuluan1">
      <table>
        <tr>
          <td>
            <p>Kepada Yth,</p>
            <p>Bapak Amran<br>Di Bekasi</p>
          </td>
          <td>
            <table>
              <tbody>
                <tr>
                  <td>
                    <p>No</p>
                  </td>
                  <td>
                    <p>: AR/QUO/2021/10/XXVIII</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Tanggal</p>
                  </td>
                  <td>
                    <p>: 11 November 2021</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>

    </div>
    <div id="pendahuluan2">
      <table>
        <tr>
          <td>
            <p>Perihal : Penawaran harga <span>pengisian 1 rumah</span></p>
          </td>
        </tr>
        <tr>
          <td>
            <p>Dengan hormat,<br>Berdasarkan info yang diterima, kami lampirkan penawaran dengan harga terbaik
              sebagai berikut:</p>
          </td>
        </tr>
      </table>
    </div>
    <div>
      <table id="tabelQuotation" class="table table-bordered table-sm border-dark">
        <thead>
          <th>No.</th>

        </thead>
        <?php
        for ($i = 0; $i < 100; $i++) {
        ?>
          <tr>
            <td>a</td>
            <td>b</td>
            <td>c</td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>



  </main>
</body>

</html>


<?php
dom_pdf();
// $html = ob_get_contents();
// ob_end_clean();\
function dom_pdf()
{
  $html = ob_get_clean();
  $pdf = new Dompdf();
  $pdf->load_html($html);
  $pdf->set_option('isRemoteEnabled', TRUE);
  $pdf->set_paper("A4", "potrait");
  // $pdf->set_option('viewport-size', '1024x768');
  $pdf->render();
  $pdf->stream('Laporan ' . date("F j, Y") . '.pdf', array('Attachment' => false));
  exit(0);
}

?>