<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/init.php";
$db = new database;
$controller = new controller;
$aksi = $_GET['aksi'];

if ($aksi == "daftarKlien") {
    $data = array(
        "id" => $controller->pembuatIDUnik($db->getKoneksi(), "akun", "id_akun"),
        "nama" => $_POST['inputNama'],
        "username" => $_POST['inputUsername'],
        "nope" => $_POST['inputNope'],
        "email" => $_POST['inputEmail'],
        "password" => $_POST['inputPassword'],
        "alamat" => $_POST['inputAlamat']
    );
    $respon = $db->daftarKlien($data);
    if ($respon == "0") {
        header("Location: /");
    } else {
        echo ("Oh no,, Ada yang salah dengan query daftar klien! : " . $respon);
    }
} elseif ($aksi = "login") {
    $respon = $db->verified_login($_POST['inputUsername'], $_POST['inputPassword']);
    if ($respon == "0") {
        header("Location: /");
    } else {
        header("Location: /?page=login&error=$respon");
    }
}
