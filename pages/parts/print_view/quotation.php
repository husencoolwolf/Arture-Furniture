<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/app/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/dist/php/dompdf/autoload.inc.php';
$db = new database;

use Dompdf\Dompdf;

if (!isset($_SESSION['id_hak_akses']) || $_SESSION['id_hak_akses'] == '1' || !isset($_GET['id'])) {
  header("Location: /");
  // die($_SESSION['id_hak_akses'] . " " . $_GET['id']);
} else {
  $data = $db->getDataDetailProjectModalAdmin($_GET['id']);
  $dataItem = $data['itemData'];
  $dataProject = $data['projectData'];
  ob_start();
  $grandTotal = 0;
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
        margin-top: 3.7cm;
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
        font-size: 12px;
      }

      table#tabelQuotation th {
        border: 1px solid black !important;
        background-color: #ffd966;
        font-size: 13px;
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
              <p><?= $dataProject['nama_klien'] ?><br>Di <?= $dataProject['lokasi'] ?></p>
            </td>
            <td>
              <table>
                <tbody>
                  <tr>
                    <td>
                      <p>No</p>
                    </td>
                    <td>
                      <p>: AR/QUO/<?= date('Y', strtotime($dataProject['dibuat'])) ?>/<?= date('m', strtotime($dataProject['dibuat'])) ?>/<?= $dataProject['id_proyek'] ?></p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Tanggal</p>
                    </td>
                    <td>
                      <p>: <?= $db->tanggalIndo(date('Y-m-d')) ?></p>
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
            <th>Nama Item</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Harga</th>


          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($dataItem as $k => $v) {
              $i++;
              $grandTotal += (int)$v['harga_item'];
            ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $v['nama_item_proyek'] ?></td>
                <td><?= $v['keterangan'] ?></td>
                <td><?= $v['jumlah'] ?></td>
                <td><?= $db->intToRupiah($v['harga_item']) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
          <tfoot>
            <th colspan="4">
              Total
            </th>
            <th><?= $db->intToRupiah($grandTotal) ?></th>
          </tfoot>
        </table>
      </div>



    </main>
  </body>

  </html>


<?php
  dom_pdf($dataProject['nama_klien']);
}
// $html = ob_get_contents();
// ob_end_clean();\
function dom_pdf($namaKlien)
{
  $html = ob_get_clean();
  $pdf = new Dompdf();
  $pdf->load_html($html);
  $pdf->set_option('isRemoteEnabled', TRUE);
  $pdf->set_paper("A4", "potrait");
  // $pdf->set_option('viewport-size', '1024x768');
  $pdf->render();
  $pdf->stream('Quotation ' . $namaKlien . '.pdf', array('Attachment' => true));
  exit(0);
}

?>