<?php
    include 'database.php';
    $db = new database();

    $aksi = $_GET["aksi"];
    if($aksi == "tambah"){
        $db->input($_POST["username"], md5($_POST['password']), $_POST['nama']);
        header('location:tampil.php');
    }elseif($aksi=="hapus"){
        $db->hapus($_GET["id"]);
        header('location:tampil.php');
    }elseif($aksi=="update"){
        $db->update($_POST["id"], $_POST["username"], md5($_POST['password']), $_POST['nama']);
        header('location:tampil.php');
    }
?>