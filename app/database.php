<?php
class database
{
    var $hostname = "localhost";
    var $username = "root";
    var $password = "";
    var $db = "arture_furniture";


    function __construct()
    {
        $this->koneksi = mysqli_connect($this->hostname, $this->username, $this->password, $this->db);
    }

    function getKoneksi()
    {
        return $this->koneksi;
    }

    function generateID($tabel, $field)
    {
        $queryCheck = "SELECT $field from $tabel;";
        $dataID = mysqli_query($this->koneksi, $queryCheck);
        $daftar_ID = array();
        while ($row = mysqli_fetch_array($dataID)) {
            $daftar_ID[] = $row[$field];
        }

        $newID = rand(0, 999999);
        while (in_array($newID, $daftar_ID)) {
            $newID = rand(0, 999999);
        }

        return $newID;
    }

    function rupiahToInt($string)
    {
        $string = str_replace("Rp.", "", $string);
        $string = str_replace(".", "", $string);
        return $string;
    }

    function intToRupiah($angka)
    {
        $hasil_rupiah = "Rp." . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

    function brToEnter($string)
    {
        $string = str_replace("<br>", "", $string);
        return $string;
    }

    function verified_login($username, $pass)
    {
        $cekuser = mysqli_query($this->koneksi, "SELECT * FROM akun WHERE username = '$username'");
        if (!$cekuser) {
            die("Data User Kosong" . mysqli_error($this->koneksi));
        } else {
            $hasil = mysqli_fetch_array($cekuser);
            if (mysqli_num_rows($cekuser) == 0) {
                return '1';
            } else {
                if (md5($pass) <> $hasil['password']) {
                    return '2';
                } else {
                    $_SESSION['id_akun'] = $hasil['id_akun'];
                    $_SESSION['nama'] = $hasil['nama'];
                    $_SESSION['username'] = $hasil['username'];
                    $_SESSION['id_hak_akses'] = $hasil['id_hak_akses'];
                    return "0";
                }
            }
        }
    }

    function daftarKlien($data)
    {
        $query = "insert into akun values ('" . $data['id'] . "', 
        '" . $data['nama'] . "', 
        '" . $data['username'] . "', 
        '" . $data['password'] . "', 
        '" . $data['alamat'] . "', 
        '" . $data['email'] . "', 
        '" . $data['nope'] . "', 
            '1');";
        $inputKlien = mysqli_query($this->koneksi, $query);
        if ($inputKlien) {
            //Jika Sukses
            //input user
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function tambahKategori($data)
    {
        $query = "Insert into kategori values('', '" . $data['inputKategori'] . "')";
        $inputKategori = mysqli_query($this->koneksi, $query);
        if ($inputKategori) {
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function tambahProduk($data, $gambar)
    {
        $idProduk = $this->generateID("produk", "id_produk");
        $deskripsi = $data['inputDeskripsi'];
        $deskripsi = str_replace("\n", "<br>", $deskripsi);
        $query = "INSERT INTO produk values ('$idProduk', '" . $data['selectKategori'] . "', '" . $data['inputNamaProduk'] . "', '" . $this->rupiahToInt($data['inputHargaProduk']) . "', '" . $deskripsi . "', '$gambar')";
        $inputProduk = mysqli_query($this->koneksi, $query);
        if ($inputProduk) {
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function editProduk($data, $gambar, $idProduk)
    {
        $deskripsi = $data['inputDeskripsi'];
        $deskripsi = str_replace("\n", "<br>", $deskripsi);
        $query = "";
        if ($gambar == false) {
            $query = "UPDATE produk set nama_produk='" . $data['inputNamaProduk'] . "', id_kategori='" . $data['selectKategori'] . "', harga_produk='" . $this->rupiahToInt($data['inputHargaProduk']) . "', deskripsi='$deskripsi' where id_produk='$idProduk';";
        } else {
            $query = "UPDATE produk set nama_produk='" . $data['inputNamaProduk'] . "', id_kategori='" . $data['selectKategori'] . "', harga_produk='" . $this->rupiahToInt($data['inputHargaProduk']) . "', deskripsi='$deskripsi', gambar='$gambar' where id_produk='$idProduk';";
        }
        $editProduk = mysqli_query($this->koneksi, $query);
        if ($editProduk) {
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function hapusProduk($id)
    {
        $query = "DELETE FROM produk where id_produk='$id'";
        $deleteProduk = mysqli_query($this->koneksi, $query);
        if ($deleteProduk) {
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function checkUsername($username)
    {
        $cekusername = mysqli_query($this->koneksi, "SELECT username FROM akun WHERE username = '$username'");
        if (mysqli_num_rows($cekusername) > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    function checkEmail($email)
    {
        $cekemail = mysqli_query($this->koneksi, "SELECT email FROM akun WHERE email = '$email'");
        if (mysqli_num_rows($cekemail) > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    function checkNope($nope)
    {
        $ceknope = mysqli_query($this->koneksi, "SELECT nomor_hp FROM akun WHERE nomor_hp = '$nope'");
        if (mysqli_num_rows($ceknope) > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    function getDataProduk()
    {
        $query = "SELECT * from produk p inner join kategori k on p.id_kategori=k.id_kategori ORDER by p.id_produk;";
        $dataProduk = mysqli_query($this->koneksi, $query);
        if ($dataProduk) {
            if (mysqli_num_rows($dataProduk) > 0) {
                return $dataProduk;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataProdukCariSearch($key)
    {
        $key = str_replace("+", " ", $key);
        $query = "select * from produk where nama_produk LIKE '%$key%' OR deskripsi LIKE '%$key%'";
        $dataProduk = mysqli_query($this->koneksi, $query);
        if ($dataProduk) {
            if (mysqli_num_rows($dataProduk) > 0) {
                return $dataProduk;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataProdukCariKategori($key)
    {
        $key = str_replace("+", " ", $key);
        $query = "select * from produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori where kategori.kategori LIKE '%$key%'";
        $dataProduk = mysqli_query($this->koneksi, $query);
        if ($dataProduk) {
            if (mysqli_num_rows($dataProduk) > 0) {
                return $dataProduk;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataKategori()
    {
        $query = "SELECT * from kategori";
        $dataKategori = mysqli_query($this->koneksi, $query);
        if ($dataKategori) {
            if (mysqli_num_rows($dataKategori) > 0) {
                return $dataKategori;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDetailProduk($id)
    {
        $query = "SELECT p.id_kategori, p.nama_produk, p.harga_produk, p.deskripsi, p.gambar, k.id_kategori, k.kategori from produk p INNER JOIN kategori k ON p.id_kategori = k.id_kategori where id_produk = '$id';";
        $detailProduk =  mysqli_query($this->koneksi, $query);
        if ($detailProduk) {
            if (mysqli_num_rows($detailProduk) > 0) {
                return $detailProduk;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
