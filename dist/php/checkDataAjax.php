<?php
// file ini digunakan untuk mengecek jquery  validator data
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/database.php";
$db = new database;

if ($_POST['tipe'] == "username") {
  echo ($db->checkUsername($_POST['username']));
} elseif ($_POST['tipe'] == "email") {
  echo ($db->checkEmail($_POST['email']));
} elseif ($_POST['tipe'] == "nope") {
  echo ($db->checkNope($_POST['nope']));
} elseif ($_POST['tipe'] == "password") {
  echo ($db->checkPassword($_POST['password'], $_POST['id']));
}
