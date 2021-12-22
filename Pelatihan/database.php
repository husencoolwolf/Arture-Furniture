<?php
    class database{
        var $host = "localhost";
        var $username = "root";
        var $pass = "";
        var $db ="pelatihan19desember";
        function __construct(){
            $this->koneksi = mysqli_connect($this->host, $this->username, $this->pass, $this->db);
        }
        
        function tampil_data(){
            $data = mysqli_query($this->koneksi,"select * from user");
            if (mysqli_num_rows($data)>0){
                while($d = mysqli_fetch_array($data)){
                    $hasil[] = $d;
                }
                return $hasil;
            }
        }

        function input($username, $password, $nama){
            mysqli_query($this->koneksi, "insert into user values('', '$username', '$password', '$nama')");
        }

        function hapus($id){
            mysqli_query($this->koneksi, "delete from user where id='$id'");
        }

        function update($id, $username, $password, $nama){
            mysqli_query($this->koneksi, "update user set username = '$username', password = '$password', nama = '$nama' where id='$id'");
        }

        function edit($id){
            $data = mysqli_query($this->koneksi, "select * from user where id = '$id'");
            while($d = mysqli_fetch_array($data)){
                $hasil[] = $d;
            }
            return $hasil;
        }
    }
?>