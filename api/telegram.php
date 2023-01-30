<?php
class Telegram
{
  private $_telegramData;

  // static protected $id = array(
  //   "marketing_group" => "-715431168",
  //   "coolwolf" => "1262080550"
  // );

  function __construct($data)
  {
    $data = json_decode($data);
    $this->_telegramData = $data;
    // $this->_telegramData->token = "5438148499:AAEoXDPqr_A5ihXyD_2nfrZ7zSrzHwJQHkc";
  }

  function __getData()
  {
    $returnVar = $this->_telegramData;
    return $returnVar;
  }


  function GetUpdates()
  {
    $token = $this->_telegramData->token;
    $method = "getUpdates";
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => "https://api.telegram.org/bot$token/$method",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
    ));

    $response = json_decode(curl_exec($ch), true);
    return $response;
  }

  function SendMessage($text, $elements = [], $targets = [])
  {
    // $targets = marketing_group;
    // https://api.telegram.org/bot<token>/METHOD_NAME
    if (is_array($elements)) {
      if (count($elements) > 0) {
        $encodedKeyboard = $this->encodeKeyboard($elements);
      }
    }
    $token = $this->_telegramData->token;
    $method = "sendMessage";
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => "https://api.telegram.org/bot$token/$method",
      // CURLOPT_RETURNTRANSFER => false,
      // CURLOPT_ENCODING => "",
      // CURLOPT_MAXREDIRS => 10,
      // CURLOPT_TIMEOUT => 0,
      // CURLOPT_FOLLOWLOCATION => false,
      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      // CURLOPT_CUSTOMREQUEST => "POST"
    ));
    foreach ($targets as $key => $value) {
      $fields = array(
        "chat_id" => $this->_telegramData->id->$value,
        "text" => $text,
        "parse_mode" => "HTML"
      );
      if (isset($encodedKeyboard)) {
        $fields["reply_markup"] = $encodedKeyboard;
      }
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
      $response = json_decode(curl_exec($ch), true);
    }
    curl_close($ch);
    //$response["ok"];
    return $response;
  }

  private function encodeKeyboard($elements = [0])
  {
    $templates = [
      [
        'text' => 'Forward Pesan Ini',
        'switch_inline_query' => 'this is a message'
      ],
      [
        'type' => 'url',
        'text' => 'Web Arture Living',
        'url' => 'https://artureliving.com/'
      ]
    ];
    $keyboardUsed = array();
    foreach ($elements as $key => $value) {
      array_push($keyboardUsed, $templates[$value]);
    }
    $keyboard = [
      'inline_keyboard' => [
        $keyboardUsed
      ]
    ];
    print_r($keyboardUsed);

    return json_encode($keyboard);
  }
}
