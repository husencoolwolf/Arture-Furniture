<?php
// coolwolf wa token : EAALB4wBPZA4sBAKrSbwlqoVyR5Jhq5fbAsIRpc8oM9eN3mx9wLnmqdueWg8JxqrDMt7X9tEi5uHDxbxEgE3QxWu3ZBVdIEXjPC8YjDQeZAB81yLGZB0wQPyRN2malbORaiJm23zsLjyn1nQOpBCf5KqTBsM4MjAPYFUk1ZCj14pOz4o0IS1QV
$waToken = "EAALB4wBPZA4sBALH2ZC1gBdsjSJsq4ovVpplUzk3DV5oROUZBn5Yy5KTxB0Uyt2ZBPsAr5Ci3A1ZCHYEklnOyRKxptqcRjKs69w8G9IjmDcmceao0RUph0JcZCBoG6a3VrKAbrXXwc3JrBe3e2kYFFVKsZCpBJBF4W7E5BvQwSyh0V4cPC9epGzEG9iP44r2MfIoYVkuP9iyvRLTkUiZBn2ZCXRCOpqWfWEUZD";
// coolwolf wa id : 111896601660196 
//wa test id : 103874192471361
$phoneId = "103874192471361";

$noTarget = "6285891674705";

$header = array(
  "Authorization: Bearer $waToken",
  'Content-Type: application/json'
);

$lang = array(
  'code' => "en_US"
);

$parameterTemplate = array(
  'type' => 'body',
  "parameters" => [array(
    'type' => 'text',
    'text' => "Nama Orang"
  )]
);
$templateArr = array(
  'name' => "notifikasi_pesanan",
  'language' => $lang,
  'components' => [$parameterTemplate]
);

// $fields = array(
//   'messaging_product' => 'whatsapp',
//   'recipient_type' => 'individual',
//   'to' => '6287771236822',
//   'type' => 'text',
//   'text' => $text_arr
// );
$fields = array(
  'messaging_product' => 'whatsapp',
  'recipient_type' => 'individual',
  'to' => $noTarget,
  'type' => 'template',
  'template' => $templateArr
);
// persiapkan curl
$ch = curl_init();

// set url 
// curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v14.0/103874192471361/messages");

// return the transfer as a string 
curl_setopt_array($ch, array(
  CURLOPT_URL => "https://graph.facebook.com/v13.0/$phoneId/messages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => $header,
));

// $output contains the output string 
// $output = curl_exec($ch);
$response = json_decode(curl_exec($ch), true);

// menampilkan hasil curl
// echo $output;
var_dump($response);
// curl -i -X POST `
//  `
// -H 'Authorization: Bearer EAALB4wBPZA4sBAGDnhQslZChJS8B1vOBYYOs0FKbp2TJjEMteaj6kpMwPfHvp1FihcIeoQ601FeliRWwIZAxz4eBBZAZAybu97ZBm3taIQGID2wveVON0Fjg88XTxeHoRIQ6CoZAuInbLyGwCxY9pSD636viUw58xut3cbUKsRnd1xsN5qZBcdrAoh5uFmHVpEaZCPbZAtacOGzQZDZD' `
// -H 'Content-Type: application/json' `
// -d '{ \"messaging_product\": \"whatsapp\", \"to\": \"6287771236822\", \"type\": \"template\", \"template\": { \"name\": \"hello_world\", \"language\": { \"code\": \"en_US\" } } }'

// $noTarget = "6285891674705";
// $lang = array(
//   'code' => "en_US"
// );

// $parameterTemplate = array(
//   'type' => 'body',
//   "parameters" => [array(
//     'type' => 'text',
//     'text' => "12345"
//   )]
// );
// $templateArr = array(
//   'name' => "notifikasi_pesanan",
//   'language' => $lang,
//   'components' => [$parameterTemplate]
// );
// $fields = array(
//   'messaging_product' => 'whatsapp',
//   'recipient_type' => 'individual',
//   'to' => $noTarget,
//   'type' => 'template',
//   'template' => $templateArr
// );

// var_dump(json_encode($fields));
// 
?>

<script>
  console.log(<?php echo (json_encode($fields)) ?>);
  // 
</script>