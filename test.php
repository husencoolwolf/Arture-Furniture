<?php
$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/private/telegram.json");
$parsed = json_decode($data);
var_dump($parsed->id);
