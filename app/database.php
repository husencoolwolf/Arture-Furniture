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

    // fungsi di bawah kurang efisien dalam mengecek apakah id sudah ada di tabel atau blm
    // function generateID($tabel, $field)
    // {
    //     $queryCheck = "SELECT $field from $tabel;";
    //     $dataID = mysqli_query($this->koneksi, $queryCheck);
    //     $daftar_ID = array();
    //     while ($row = mysqli_fetch_array($dataID)) {
    //         $daftar_ID[] = $row[$field];
    //     }

    //     $newID = rand(0, 999999);
    //     while (in_array($newID, $daftar_ID)) {
    //         $newID = rand(0, 999999);
    //     }

    //     return $newID;
    // }

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
        $idProduk = $this->pembuatIDUnik($this->koneksi, "produk", "id_produk");
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
                $queryStatusAwal = "INSERT INTO status_pesanan VALUES ('', '" . $data['id'] . "', 'menunggu info bank', now(), '');";
                $responStatus = mysqli_query($this->koneksi, $queryStatusAwal);
                if ($responStatus) {
                    return true;
                } else {
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

    function checkPassword($pass, $idAkun)
    {
        $pass = md5($pass);
        $cekPass = mysqli_query($this->koneksi, "SELECT password FROM akun WHERE password='$pass' && id_akun='$idAkun'");
        if (mysqli_num_rows($cekPass) > 0) {
            return "true";
        } else {
            return "false";
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

    function getDataAkunAdmin()
    {
        $query = "SELECT a.id_akun, a.nama, a.username, a.password, a.id_hak_akses, h.nama_hak_akses, d.id_akun as id_klien, d.alamat, d.email, d.nomor_hp FROM akun a INNER JOIN hak_akses h ON a.id_hak_akses=h.id_hak_akses LEFT JOIN detail_klien d ON a.id_akun=d.id_akun";
        $dataAkun = mysqli_query($this->koneksi, $query);
        if ($dataAkun) {
            if (mysqli_num_rows($dataAkun) > 0) {
                return $dataAkun;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getHargaProdukAdmin()
    {
        $query = "select p.id_produk, p.harga_produk from produk p";
        $dataProduk = mysqli_query($this->koneksi, $query);
        if ($dataProduk) {
            if (mysqli_num_rows($dataProduk) > 0) {
                $temp = array();
                while ($x = mysqli_fetch_assoc($dataProduk)) {
                    $temp[$x['id_produk']] = $x['harga_produk'];
                }
                return json_encode($temp);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataPesananAdmin()
    {
        $query = "SELECT p.id_pesanan, p.tanggal as tanggal_dibuat, p.metode, (SELECT COUNT(id_pesanan) FROM detail_pesanan d2 WHERE d2.id_pesanan=p.id_pesanan) as item, a.nama, s.status FROM pesanan p INNER JOIN akun a ON a.id_akun=p.id_akun LEFT JOIN status_pesanan s ON s.id_pesanan=p.id_pesanan WHERE s.tanggal=(SELECT max(tanggal) FROM status_pesanan s2 WHERE s2.id_pesanan=p.id_pesanan) ORDER by p.tanggal DESC;";
        $dataPesanan = mysqli_query($this->koneksi, $query);
        if ($dataPesanan) {
            if (mysqli_num_rows($dataPesanan) > 0) {
                return $dataPesanan;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataPesananAdminDetailed($idPesanan)
    {
        $query = "SELECT p.id_akun, p.id_pesanan, s.id_pesanan, p.tanggal as tanggal_pesan, p.metode, s.status, k.alamat, k.email, k.nomor_hp, a.nama FROM pesanan p inner join status_pesanan s ON p.id_pesanan=s.id_pesanan inner join detail_klien k ON k.id_akun=p.id_akun inner JOIN akun a ON a.id_akun=p.id_akun where p.id_pesanan='$idPesanan' AND s.tanggal=(SELECT max(tanggal) from status_pesanan s where s.id_pesanan='$idPesanan');";
        $dataPesanan = array();
        $data = mysqli_query($this->koneksi, $query);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                $dataPesanan = mysqli_fetch_assoc($data);
                return $dataPesanan;
                // return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDetailPesananAdmin($idPesanan)
    {
        $query = "select produk.id_produk, produk.nama_produk, produk.gambar, detail_pesanan.jumlah, produk.harga_produk, pesanan.tanggal, pesanan.metode, pesanan.id_akun FROM detail_pesanan inner JOIN pesanan on detail_pesanan.id_pesanan=pesanan.id_pesanan inner join produk on detail_pesanan.id_produk=produk.id_produk where pesanan.id_pesanan='$idPesanan'";
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

    function getDataKlienAdmin()
    {
        $query = "SELECT * FROM akun INNER JOIN detail_klien ON akun.id_akun=detail_klien.id_akun";
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

    function getDataHakAksesAdmin()
    {
        $query = "SELECT * FROM hak_akses";
        $dataHakAkses = mysqli_query($this->koneksi, $query);
        if ($dataHakAkses) {
            if (mysqli_num_rows($dataHakAkses) > 0) {
                return $dataHakAkses;
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    function getDataDetailPesananModalAdmin($idPesanan)
    {
        $dataSets = array();
        $query = "SELECT p.id_pesanan, p.id_akun as id_klien, s.id_pesanan, p.tanggal as tanggal_pesan, p.metode, s.status, k.alamat, k.email, k.nomor_hp, a.nama FROM pesanan p inner join status_pesanan s ON p.id_pesanan=s.id_pesanan inner join detail_klien k ON k.id_akun=p.id_akun inner JOIN akun a ON a.id_akun=p.id_akun where p.id_pesanan='$idPesanan' AND s.tanggal=(SELECT max(tanggal) from status_pesanan s where s.id_pesanan='$idPesanan');";
        $temp = array();
        $data = mysqli_query($this->koneksi, $query);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                $data = mysqli_fetch_assoc($data);

                $dataSets["detail_pesanan"] = $data;
                $query2 = "SELECT * FROM status_pesanan where id_pesanan='$idPesanan';";
                $data2 = mysqli_query($this->koneksi, $query2);
                if ($data2) {
                    if (mysqli_num_rows($data2) > 0) {
                        $temp = array();
                        while ($x = mysqli_fetch_assoc($data2)) {
                            $temp[] = $x;
                        }
                        $dataSets["history_status"] = $temp;
                        $query3 = "select produk.nama_produk, produk.gambar, detail_pesanan.jumlah, produk.harga_produk, pesanan.tanggal, pesanan.metode, pesanan.id_akun FROM detail_pesanan inner JOIN pesanan on detail_pesanan.id_pesanan=pesanan.id_pesanan inner join produk on detail_pesanan.id_produk=produk.id_produk where pesanan.id_pesanan='$idPesanan'";
                        $data3 = mysqli_query($this->koneksi, $query3);
                        if ($data3) {
                            if (mysqli_num_rows($data3) > 0) {
                                $temp = array();
                                while ($x = mysqli_fetch_assoc($data3)) {
                                    $temp[] = $x;
                                }
                                $dataSets["produk_pesanan"] = $temp;
                                return $dataSets;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        false;
                    }
                } else {
                    return false;
                }
                // return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDataDetailAkunModalAdmin($idAkun)
    {
        $dataSets = array();
        $query = "SELECT a.id_akun, a.nama, a.username, a.password, a.id_hak_akses, h.nama_hak_akses, d.id_akun as id_klien, d.alamat, d.email, d.nomor_hp FROM akun a INNER JOIN hak_akses h ON a.id_hak_akses=h.id_hak_akses LEFT JOIN detail_klien d ON a.id_akun=d.id_akun WHERE a.id_akun='$idAkun'";
        $detailAkun =  mysqli_query($this->koneksi, $query);
        if ($detailAkun) {
            if (mysqli_num_rows($detailAkun) > 0) {
                foreach (mysqli_fetch_assoc($detailAkun) as $key => $value) {
                    $dataSets[$key] = $value;
                }
                return $dataSets;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function updateDataTabelPesananAdmin($dari, $sampai)
    {
        $query = "SELECT p.id_pesanan, p.tanggal as tanggal_dibuat, p.metode, (SELECT COUNT(id_pesanan) FROM detail_pesanan d2 WHERE d2.id_pesanan=p.id_pesanan) as item, a.nama, s.status FROM pesanan p INNER JOIN akun a ON a.id_akun=p.id_akun LEFT JOIN status_pesanan s ON s.id_pesanan=p.id_pesanan WHERE s.tanggal=(SELECT max(tanggal) FROM status_pesanan s2 WHERE s2.id_pesanan=p.id_pesanan)";
        if (isset($dari) && $dari != '') {
            $dari = date('Y-m-d', strtotime($dari));
            $query .= " AND p.tanggal>='$dari'";
        }
        if (isset($sampai) && $sampai != '') {
            $sampai = date('Y-m-d', strtotime($sampai));
            $query .= " AND p.tanggal<='$sampai 23:59:21'";
        }
        $dataPesanan = mysqli_query($this->koneksi, $query);
        if ($dataPesanan) {
            if (mysqli_num_rows($dataPesanan) > 0) {
                $datareturn = array();
                while ($x = mysqli_fetch_array($dataPesanan)) {
                    $datareturn[] = $x;
                }
                return $datareturn;
            } else {
                return "-1"; //tidak ada hasil / hasil tidak ditemukan
            }
        } else {
            return false;
        }
    }

    function tambahPesananAdmin($dataPesanan, $dataProduk)
    {
        //id pesanan costume sedangkan id detail pesanan increased
        $idPesanan = $this->pembuatIDUnik($this->koneksi, "pesanan", "id_pesanan");
        $queryPesanan = "INSERT INTO pesanan VALUES('$idPesanan', 
        '" . $dataPesanan[0]['value'] . "',
        now(), 
        '" . $dataPesanan[1]['value'] . "')";
        $inputPesanan = mysqli_query($this->koneksi, $queryPesanan);
        if ($inputPesanan) {
            $berhasilInputProduk = 0;
            foreach ($dataProduk as $key => $value) {

                $queryProduk = "INSERT INTO detail_pesanan VALUES('', 
                '$idPesanan',
                '$key',
                '$value' )";
                $responProduk = mysqli_query($this->koneksi, $queryProduk);
                if ($responProduk) {
                    $berhasilInputProduk++;
                } else {
                    break;
                }
            }
            if ($berhasilInputProduk == count($dataProduk)) {
                $queryStatusAwal = "INSERT INTO status_pesanan VALUES ('', '" . $idPesanan . "', '" . $dataPesanan[2]['value'] . "', now(), 'input manual : " . $_SESSION['id_akun'] . "');";
                $responStatus = mysqli_query($this->koneksi, $queryStatusAwal);
                if ($responStatus) {
                    return true;
                } else {
                    return "-3";
                }
            } else {
                return "-2";
            }
        } else {
            return "-1";
        }
    }

    function tambahAkunAdmin($data)
    {
        $queryAkun = "INSERT INTO akun VALUES(
            '" . $data['id'] . "',
            '" . $data['nama'] . "',
            '" . $data['username'] . "',
            '" . md5($data['password']) . "',
            '" . $data['privilege'] . "'
        )";
        $inputAkun = mysqli_query($this->koneksi, $queryAkun);
        if ($inputAkun) {
            $queryDetailAkun = "INSERT INTO detail_klien VALUES(
                '" . $data['id'] . "',
                '" . $data['id'] . "',
                '" . $data['alamat'] . "',
                '" . $data['email'] . "',
                '" . $data['nope'] . "'
            )";
            $inputDetailAkun = mysqli_query($this->koneksi, $queryDetailAkun);
            if ($inputDetailAkun) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function editPesananAdmin($dataPesanan, $dataProduk, $idPesanan)
    {
        //id pesanan costume sedangkan id detail pesanan increased
        $queryPesanan = "UPDATE pesanan SET 
        id_akun='" . $dataPesanan[0]['value'] . "',
        metode='" . $dataPesanan[1]['value'] . "' WHERE id_pesanan='$idPesanan';";

        $editPesanan = mysqli_query($this->koneksi, $queryPesanan);
        if ($editPesanan) {
            $deleteDetailProduk = mysqli_query($this->koneksi, "DELETE FROM detail_pesanan WHERE id_pesanan='$idPesanan'");
            if ($deleteDetailProduk) {
                $berhasilEditProduk = 0;
                foreach ($dataProduk as $key => $value) {
                    $queryProduk = "INSERT INTO detail_pesanan VALUES('', 
                    '$idPesanan',
                    '$key',
                    '$value' )";
                    $responProduk = mysqli_query($this->koneksi, $queryProduk);
                    if ($responProduk) {
                        $berhasilEditProduk++;
                    } else {
                        break;
                    }
                }
                if ($berhasilEditProduk == count($dataProduk)) {
                    $queryStatusAwal = "INSERT INTO status_pesanan VALUES ('', '" . $idPesanan . "', '" . $dataPesanan[2]['value'] . "', now(), 'input manual : " . $_SESSION['id_akun'] . "');";
                    $responStatus = mysqli_query($this->koneksi, $queryStatusAwal);
                    if ($responStatus) {
                        return true;
                    } else {
                        return "-3";
                    }
                } else {
                    return "-2";
                }
            } else {
                return "-4";
            }
        } else {
            return "-1";
        }
    }

    function editAkunAdmin($idAkun, $data)
    {
        $queryAkun = "UPDATE akun SET 
            nama='" . $data['inputNama'] . "',
            id_hak_akses='" . $data['selectHakAkses'] . "'
            ";
        //kalau password baru ada dan password lama sama dengan database
        if ($data['inputPasswordBaru'] !== "") {
            $cekPass = $this->checkPassword($data['inputPasswordLama'], $idAkun);
            if ($cekPass == "true") {
                $queryAkun += ", password='" . $data['inputPasswordBaru'] . "'";
            }
        }
        $updateAkun = mysqli_query($this->koneksi, $queryAkun);
        if ($updateAkun) {
            $queryDetailAkun = "UPDATE detail_klien SET 
            alamat='" . $data['inputAlamat'] . "', 
            email='" . $data['inputEmail'] . "', 
            nomor_hp='" . $data['inputNope'] . "'";
            $updateDetailAkun = mysqli_query($this->koneksi, $queryDetailAkun);
            if ($updateDetailAkun) {
                return true;
            } else {
                return "-2";
            }
        } else {
            return "-1";
        }
    }

    function deleteAkunAdmin($idAkun)
    {
        $query = "DELETE FROM akun where id_akun='$idAkun'";
        $hapusAkun = mysqli_query($this->koneksi, $query);
        if ($hapusAkun) {
            return true;
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
                if ($i == count($idProduk) - 1) {
                    $query .= ") ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "ORDER BY FIELD(id_produk, ";
            for ($i = 0; $i < count($idProduk); $i++) {
                $query = $query . "$idProduk[$i]";
                if ($i == count($idProduk) - 1) {
                    $query .= ");";
                } else {
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
