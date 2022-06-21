<?php
class controller
{
    var $aktorcss = array("guest", "klien", "administrator", "marketing", "produksi", "finance");
    var $halamancss = array(
        array("home", "login", "daftar", "produk"),
        array("home", "produk", "keranjang", "checkout", "co-sukses", "co-gagal"),
        array("dashboard", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun")
    );

    var $aktorjs = array("guest", "klien", "administrator");
    var $halamanjs = array(
        array("daftar", "produk"),
        array("produk", "keranjang", "co-sukses"),
        array("dashboard", "produk", "tambah-produk", "edit-produk", "pesanan", "tambah-pesanan", "edit-pesanan", "akun")
    );

    function __construct()
    {
    }

    function cssImporter($getParam, $getSession)
    {
        $css = ""; //output css code

        if (empty($getParam)) {
            $getParam = "home";
        }
        if (empty($getSession)) {
            $getSession = "guest";
        } else {
            $getSession = $this->kodeHakAksesToStringCSS($getSession);
        }


        //
        for ($i = 0; $i < count($this->aktorcss); $i++) {
            if ($getSession == $this->aktorcss[$i]) {
                for ($j = 0; $j < count($this->halamancss[$i]); $j++) {
                    if ($getParam == $this->halamancss[$i][$j]) {  // gk ada parameter
                        $css = '<link rel="stylesheet" href="/dist/css/pages/' . $this->aktorcss[$i] . '-' . $this->halamancss[$i][$j] . '.css">';
                    }
                }
            }
        }
        return $css;
    }

    function jsImporter($getParam, $getSession)
    {
        $js = ""; //output css code

        if (empty($getParam)) {
            $getParam = "home";
        }
        if (empty($getSession)) {
            $getSession = "guest";
        } else {
            $getSession = $this->kodeHakAksesToStringJS($getSession);
        }

        //
        for ($i = 0; $i < count($this->aktorjs); $i++) {
            if ($getSession == $this->aktorjs[$i]) {
                for ($j = 0; $j < count($this->halamanjs[$i]); $j++) {
                    if ($getParam == $this->halamanjs[$i][$j]) {  // gk ada parameter
                        $js = '<script src="/dist/js/pages/' . $this->aktorjs[$i] . '-' . $this->halamanjs[$i][$j] . '.js"></script>';
                    }
                }
            }
        }
        return $js;
    }

    function kodeHakAksesToStringCSS($index)
    {
        $index = (int)$index;
        // var_dump($index);
        return $this->aktorcss[$index];
    }

    function kodeHakAksesToStringJS($index)
    {
        $index = (int)$index;
        // var_dump($index);
        return $this->aktorjs[$index];
    }

    function pembuatIDUnik($connection, $tabelName, $fieldID, $id = null, $max = 6)
    {
        if ($id == null) {
            $id = '';
            for ($i = 0; $i < $max; $i++) {
                $id = $id . rand(0, 9);
            }
        }

        //
        $cekid = mysqli_query($connection, "SELECT $fieldID FROM $tabelName WHERE $fieldID = '$id'");
        if (mysqli_num_rows($cekid) == 0) {
            return $id;
        } else {
            $id2 = createId(8);
            $this->pembuatIDUnik($connection, $tabelName, $fieldID, $id);
        }
    }

    function intToRupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}
