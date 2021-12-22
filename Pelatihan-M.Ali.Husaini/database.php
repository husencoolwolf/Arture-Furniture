<?php
    class database{
        var $host = "localhost";
        var $username = "root";
        var $pass = "";
        var $db ="pelatihan_mohammad_ali_vellayati_husaini";
        function __construct(){
            $this->koneksi = mysqli_connect($this->host, $this->username, $this->pass, $this->db);
        }
        
        function tampil_data(){
            $data = mysqli_query($this->koneksi,"select * from beli_formulir");
            if (mysqli_num_rows($data)>0){
                while($d = mysqli_fetch_array($data)){
                    $hasil[] = $d;
                }
                return $hasil;
            }
        }

        function input($nik, $jalur, $akademik, $password, $nama, $nope, $petugas, $tahun, $biaya){
            mysqli_query($this->koneksi, "insert into beli_formulir values('$nik', '$jalur', '$akademik', '$password', '$nama', '$nope', '$petugas', '$tahun', '$biaya', current_timestamp())");
        }

        function hapus($nik){
            mysqli_query($this->koneksi, "delete from beli_formulir where nik='$nik'");
        }

        function update($nik, $jalur, $akademik, $password, $nama, $nope, $petugas, $tahun, $biaya){
            mysqli_query($this->koneksi, "update beli_formulir set jalur = '$jalur', akademik = '$akademik', password = '$password', nama = '$nama', no_hp = '$nope', petugas = '$petugas', tahun = '$tahun', biaya = '$biaya' where nik='$nik'");
        }

        function edit($nik){
            $data = mysqli_query($this->koneksi, "select * from beli_formulir where nik = '$nik'");
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }
    }
?>