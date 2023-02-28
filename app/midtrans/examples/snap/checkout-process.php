<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview
// item details Format
// "item_details": [{
//     "id": "a1",
//     "price": 50000,
//     "quantity": 2,
//     "name": "Apel",
//     "brand": "Fuji Apple",
//     "category": "Fruit",
//     "merchant_name": "Fruit-store",
//     "tenor": "12",
//     "code_plan": "000",
//     "mid": "123456",
//     "url": "https://tokobuah.com/apple-fuji"
//   }]

namespace Midtrans;

use database;
use Services\EnvParser;

require_once dirname(__FILE__) . '/../../Midtrans.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
$db = new database;

// fetch items details
$detail_produk = $db->getDetailProdukWithIDs($_POST['id']);

(new EnvParser($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load(); //Environment Parser
?>
<?php
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = getenv('MT_SERVER_KEY');
Config::$clientKey = getenv('MT_CLIENT_KEY');

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$transaction_details = array(
  'order_id' => rand(),
  'gross_amount' => 94000, // no decimal allowed for creditcard
);

// inisiasi @array item_details
$item_details = array();

// foreach ($detail_produk as $key => $value) {
//   $item_details[] = array_map(function ($detail_produk) {
//     return array(
//       'id' => $detail_produk['id_produk'],
//       'name' => $detail_produk['nama_produk'],
//       'price' => $detail_produk['harga_produk'],
//       'category' => $detail_produk['kategori']
//     );
//   }, $item_details);
// }
$detail_produk = array_map(function ($produk) {
  return array(
    'id' => $produk['id_produk'],
    'name' => $produk['nama_produk'],
    'price' => $produk['harga_produk'],
    'category' => $produk['kategori']
  );
}, $detail_produk);
$item_details = $detail_produk;
$jml = explode(",", $_POST['jml']);

foreach ($item_details as $key => $value) {
  $item_details[$key]['quantity'] = $jml[$key];
}
// foreach ($detail_produk as $key => $value) {
//   $temp = [];//@array temp untuk menampung data baru 
//   foreach ($value as $k => $v) {
//     echo "[$k] = [$v]<br>";
//   }
//   $
// }
// $item1_details = array(
//   'id' => 'a1',
//   'price' => 18000,
//   'quantity' => 3,
//   'name' => "Apple"
// );

// // Optional
// $item2_details = array(
//   'id' => 'a2',
//   'price' => 20000,
//   'quantity' => 2,
//   'name' => "Orange"
// );

// // Optional
// $item_details = array($item1_details, $item2_details);

// Optional
$billing_address = array(
  'first_name'    => "Andri",
  'last_name'     => "Litani",
  'address'       => "Mangga 20",
  'city'          => "Jakarta",
  'postal_code'   => "16602",
  'phone'         => "081122334455",
  'country_code'  => 'IDN'
);

// Optional
$shipping_address = array(
  'first_name'    => "Obet",
  'last_name'     => "Supriadi",
  'address'       => "Manggis 90",
  'city'          => "Jakarta",
  'postal_code'   => "16601",
  'phone'         => "08113366345",
  'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
  'first_name'    => "Andri",
  'last_name'     => "Litani",
  'email'         => "andri@litani.com",
  'phone'         => "081122334455",
  'billing_address'  => $billing_address,
  'shipping_address' => $shipping_address
);

// Optional, remove this to display all available payment methods
// $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');

// Fill transaction details
$transaction = array(
  // 'enabled_payments' => $enable_payments,
  'transaction_details' => $transaction_details,
  'customer_details' => $customer_details,
  'item_details' => $item_details,
);

$snap_token = '';
try {
  $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
  echo $e->getMessage();
}

echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
  if (strpos(Config::$serverKey, 'your ') != false) {
    echo "<code>";
    echo "<h4>Please set your server key from sandbox</h4>";
    echo "In file: " . __FILE__;
    echo "<br>";
    echo "<br>";
    echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
    die();
  }
}

?>

<!DOCTYPE html>
<html>

<body>
  <div><?= var_dump($item_details) ?></div>
  <button id="pay-button">Pay!</button>
  <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

  <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
  <script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
      // SnapToken acquired from previous step
      snap.pay('<?php echo $snap_token ?>', {
        // Optional
        onSuccess: function(result) {
          /* You may add your own js here, this is just example */
          document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result) {
          /* You may add your own js here, this is just example */
          document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result) {
          /* You may add your own js here, this is just example */
          document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
      });
    };
  </script>
</body>

</html>