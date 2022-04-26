<?php

use JetBrains\PhpStorm\ArrayShape;

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
        '" . md5($data['password']) . "',
            '1');";
        $query2 = "INSERT INTO detail_klien VALUES('" . $data['id'] . "',
        '" . $data['id'] . "',
        '" . $data['alamat'] . "',
        '" . $data['email'] . "',
        '" . $data['nope'] . "')";
        $inputKlien = mysqli_query($this->koneksi, $query);
        $inputKlien2 = mysqli_query($this->koneksi, $query2);
        if ($inputKlien) {
            if ($inputKlien2) {
                //Jika Sukses
                //input user
                return "0";
            } else {
                return mysqli_error($this->koneksi);
            }
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
        $query = "INSERT INTO produk values ('$idProduk', '" . $data['selectKategori'] . "', '" . $data['inputNamaProduk'] . "', '" . $this->rupiahToInt($data['inputHargaProduk']) . "', '" . $deskripsi . "', '$gambar', '')";
        $inputProduk = mysqli_query($this->koneksi, $query);
        if ($inputProduk) {
            return "0";
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function tambahKeranjang($idProduk, $idKlien, $quantity)
    {
        $sudahAda = $this->checkKeranjangExists($idProduk, $idKlien);
        $query = "";
        if ($sudahAda) {
            $query = "UPDATE keranjang set jumlah=jumlah+$quantity where id_akun_kostumer='$idKlien' AND id_produk='$idProduk'";
        } else {
            $query = "INSERT INTO keranjang values('', '$idKlien', '$idProduk', now(), $quantity)";
        }
        if (((int)$sudahAda + (int)$quantity) > 10) { //barang yang dipesan lebih dari 10 total dari keranjang
            return "1";
        } else {
            $inputKeranjang = mysqli_query($this->koneksi, $query);
            if ($inputKeranjang) {
                return "0";
            } else {
                return mysqli_error($this->koneksi);
            }
        }
    }

    function tambahPesanan($data)
    {
        $produk = explode(",", $data['produk']);
        $jumlah = explode(",", $data['jumlah']);
        $detailPesananSuccess = 0;
        $query1 = "INSERT INTO pesanan values('" . $data['id'] . "', '" . $data['akun'] . "', now(), '" . $data['metode'] . "')";
        $query2 = array();
        for ($i = 0; $i < count($produk); $i++) {
            $query2[] = "INSERT INTO detail_pesanan values('', '" . $data['id'] . "', '" . $produk[$i] . "', '" . $jumlah[$i] . "')";
        }
        $respon1 = mysqli_query($this->koneksi, $query1);
        if ($respon1) {
            for ($i = 0; $i < count($produk); $i++) {
                $respon2 = mysqli_query($this->koneksi, $query2[$i]);
                if ($respon2) {
                    $detailPesananSuccess++;
                } else {
                    return mysqli_error($this->koneksi);
                }
            }
            if ($detailPesananSuccess === count($produk)) {
                $queryStatusAwal = "INSERT INTO status_pesanan VALUES ('', '". $data['id'] ."', 'menunggu info bank', now());";
                $responStatus = mysqli_query($this->koneksi, $queryStatusAwal);
                if($responStatus){
                  return true;
                }else{
                  return false;
                }

            } else {
                return false;
            }
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function tambahInfoPembayaran($data)
    {
        $queryMasuk = "INSERT INTO pembayaran VALUES('" . $data['id'] . "', '" . $data['pesanan'] . "', '" . $data['bank'] . "', '" . $data['norek'] . "', '" . $data['nasabah'] . "')";
        $responMasuk = mysqli_query($this->koneksi, $queryMasuk);
        if ($responMasuk) {
            $queryStatus = "INSERT INTO status_pesanan VALUES('', '" . $data['pesanan'] . "', 'menunggu verifikasi bayar', now(), '')";
            $responStatus = mysqli_query($this->koneksi, $queryStatus);
            if ($responStatus) {
                return true;
            } else {
                return mysqli_error($this->koneksi);
            }
        } else {
            return mysqli_error($this->koneksi);
        }
    }

    function checkAlamatUser($idKlien)
    {
        $query = "SELECT alamat from akun where id_produk='$idKlien'";
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

    function setProdukTersedia($idProduk)
    {
        $cekTersedia = mysqli_query($this->koneksi, "SELECT tersedia from produk where id_produk='$idProduk'");
        if ($cekTersedia) {
            if (mysqli_num_rows($cekTersedia) > 0) {
                $x = mysqli_fetch_array($cekTersedia);
                if ($x['tersedia'] == 0) {
                    $setTersedia = mysqli_query($this->koneksi, "UPDATE produk set tersedia='1' where id_produk='$idProduk'");
                    if ($setTersedia) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $setTersedia = mysqli_query($this->koneksi, "UPDATE produk set tersedia='0' where id_produk='$idProduk'");
                    if ($setTersedia) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
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

    function hapusKeranjangUser($idKlien, $idProduk)
    {
        $query = "DELETE FROM keranjang where id_akun_kostumer='$idKlien' AND id_produk='$idProduk'";
        $deleteKeranjang = mysqli_query($this->koneksi, $query);
        if ($deleteKeranjang) {
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
        $cekemail = mysqli_query($this->koneksi, "SELECT email FROM detail_klien WHERE email = '$email'");
        if (mysqli_num_rows($cekemail) > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    function checkNope($nope)
    {
        $ceknope = mysqli_query($this->koneksi, "SELECT nomor_hp FROM detail_klien WHERE nomor_hp = '$nope'");
        if (mysqli_num_rows($ceknope) > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    function checkKeranjangExists($idProduk, $idKlien)
    {
        $query = "select id_akun_kostumer, id_produk, jumlah from keranjang WHERE id_akun_kostumer='$idKlien' AND id_produk='$idProduk'";
        $respon = mysqli_query($this->koneksi, $query);
        if ($respon) {
            if (mysqli_num_rows($respon) > 0) {
                $jumlah = mysqli_fetch_assoc($respon);
                return $jumlah['jumlah'];
            } else {
                return false;
            }
        } else {
            die(mysqli_error($this->koneksi));
        }
    }

    function getDataProduk()
    {
        $query = "SELECT * from produk p inner join kategori k on p.id_kategori=k.id_kategori where tersedia='1' ORDER by p.id_produk;";
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
    // admin queries
    function getDataProdukAdmin()
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

    function getDataPesananAdmin()
    {
        $query = "SELECT p.id_pesanan, p.tanggal as tanggal_dibuat, p.metode, COUNT(d.id_pesanan) as item FROM pesanan p LEFT JOIN detail_pesanan d USING(id_pesanan);";
    }

    function getDetailProdukAdmin($id)
    {
        $query = "SELECT p.id_kategori, p.nama_produk, p.harga_produk, p.deskripsi, p.gambar, p.tersedia, k.id_kategori, k.kategori from produk p INNER JOIN kategori k ON p.id_kategori = k.id_kategori where id_produk = '$id'";
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

    // end of admin queries

    function getDataProdukCariSearch($key)
    {
        $key = str_replace("+", " ", $key);
        $query = "select * from produk where nama_produk LIKE '%$key%' OR deskripsi LIKE '%$key%' AND tersedia='1'";
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
        $query = "select * from produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori where kategori.kategori LIKE '%$key%' AND produk.tersedia = '1'";
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
        $query = "SELECT p.id_kategori, p.nama_produk, p.harga_produk, p.deskripsi, p.gambar, p.tersedia, k.id_kategori, k.kategori from produk p INNER JOIN kategori k ON p.id_kategori = k.id_kategori where id_produk = '$id' AND tersedia = '1';";
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


    function getJumlahKeranjangUser($idKlien)
    {
        $query = "SELECT * from keranjang where id_akun_kostumer='$idKlien'";
        $data = mysqli_query($this->koneksi, $query);
        if (!$data) {
            return false;
        } else {
            return mysqli_num_rows($data);
        }
    }

    function getDataKeranjangUser($idKlien)
    {
        $query = "SELECT * FROM keranjang INNER JOIN produk ON keranjang.id_produk=produk.id_produk where keranjang.id_akun_kostumer='$idKlien'";
        $dataKeranjang =  mysqli_query($this->koneksi, $query);
        if ($dataKeranjang) {
            if (mysqli_num_rows($dataKeranjang) > 0) {
                return $dataKeranjang;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getHargaProdukWithIDs($idProduk)
    {
        if (count($idProduk) > 0) {
            $query = "SELECT harga_produk from produk where id_produk in (";
            for ($i = 0; $i < count($idProduk); $i++) {
                $query = $query . "$idProduk[$i]";
                if($i == count($idProduk)-1){
                  $query .= ") ";
                }else{
                  $query .= ", ";
                }
            }
            $query .= "ORDER BY FIELD(id_produk, ";
            for($i = 0; $i < count($idProduk); $i++){
              $query = $query . "$idProduk[$i]";
              if($i == count($idProduk)-1){
                $query .= ");";
              }else{
                $query .= ", ";
              }
            }
            $dataHarga = mysqli_query($this->koneksi, $query);
            $returnHarga = array();
            if ($dataHarga) {
                if (mysqli_num_rows($dataHarga) > 0) {
                    while ($x = mysqli_fetch_array($dataHarga)) {
                        $returnHarga[] = $x['harga_produk'];
                    }
                    return $returnHarga;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return array();
        }
    }

    function getHargaJumlahProdukAll($idKostumer)
    {
        $query = "SELECT produk.harga_produk, keranjang.jumlah, keranjang.id_akun_kostumer from keranjang INNER JOIN produk ON produk.id_produk=keranjang.id_produk where keranjang.id_akun_kostumer='$idKostumer'";
        $harga = array();
        $jumlah = array();
        $dataHargaJumlah = mysqli_query($this->koneksi, $query);
        if (!$dataHargaJumlah) {
            return false;
        } else {
            while ($x = mysqli_fetch_array($dataHargaJumlah)) {
                $harga[] = $x['harga_produk'];
                $jumlah[] = $x['jumlah'];
            }
            return json_encode($harga) . "|" . json_encode($jumlah);
        }
    }

    function getDataKlien($idKlien)
    {
        $query = "SELECT * FROM akun INNER JOIN detail_klien ON akun.id_akun=detail_klien.id_akun where akun.id_akun='$idKlien'";
        $dataKlien =  mysqli_query($this->koneksi, $query);
        if ($dataKlien) {
            if (mysqli_num_rows($dataKlien) > 0) {
                return $dataKlien;
            } else {
                return false;
            }
        } else {
            return $query;
        }
    }

    function getDataPesanan($idPesanan, $idKlien)
    {
        $query = "SELECT p.id_pesanan, s.id_pesanan, p.tanggal as tanggal_pesan, p.metode, s.status, k.alamat, k.email, k.nomor_hp, a.nama FROM pesanan p inner join status_pesanan s ON p.id_pesanan=s.id_pesanan inner join detail_klien k ON k.id_akun=p.id_akun inner JOIN akun a ON a.id_akun=p.id_akun where p.id_pesanan='$idPesanan' AND p.id_akun='$idKlien' AND s.tanggal=(SELECT max(tanggal) from status_pesanan s where s.id_pesanan='$idPesanan');";
        $dataPesanan = array();
        $data = mysqli_query($this->koneksi, $query);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                $dataPesanan = mysqli_fetch_array($data);
                return $dataPesanan;
                // return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDetailPesanan($idPesanan, $idKlien)
    {
        $query = "select produk.nama_produk, produk.gambar, detail_pesanan.jumlah, produk.harga_produk, pesanan.tanggal, pesanan.metode, pesanan.id_akun FROM detail_pesanan inner JOIN pesanan on detail_pesanan.id_pesanan=pesanan.id_pesanan inner join produk on detail_pesanan.id_produk=produk.id_produk where pesanan.id_pesanan='$idPesanan' AND pesanan.id_akun='$idKlien'";
        $dataDetailPesanan =  mysqli_query($this->koneksi, $query);
        if ($dataDetailPesanan) {
            if (mysqli_num_rows($dataDetailPesanan) > 0) {
                return $dataDetailPesanan;
            } else {
                return "-1";
            }
        } else {
            return false;
        }
    }

    function getDataPembayaran($idPesanan, $idKlien)
    {
        $query = "SELECT b.bank_pemilik, b.no_rekening, b.nama_pemilik, p.id_akun, p.metode from pembayaran b INNER JOIN pesanan p ON b.id_pesanan=p.id_pesanan WHERE p.id_akun='$idKlien' AND b.id_pesanan='$idPesanan';";
        $dataPembayaran = mysqli_query($this->koneksi, $query);
        if ($dataPembayaran) {
            if (mysqli_num_rows($dataPembayaran) > 0) {
                return mysqli_fetch_array($dataPembayaran);
            } else {
                return "-1";
            }
        } else {
            return false;
        }
    }
}
