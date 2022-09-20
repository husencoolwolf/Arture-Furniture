<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/telegram.php';

$config = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/private/telegram.json");
$telegram = new Telegram($config);
// $response = $telegram->GetUpdates();
switch ($_GET['cmd']) {
  case "SendMessage":
    $response = $telegram->SendMessage("<code>test message</code>\n
    Test 2", [1], ["marketing_group", "produksi_group"]);
    break;
  case "GetUpdates":
    $response = $telegram->GetUpdates();
    break;
  case "__getData":
    $response = $telegram->__getData();
    break;
  default:
    echo "need command";
    break;
}



var_dump($response);
