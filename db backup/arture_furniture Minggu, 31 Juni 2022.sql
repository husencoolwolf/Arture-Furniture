-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2022 pada 16.49
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arture_furniture`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `id_hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `password`, `id_hak_akses`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(159775, 'Difa Ishomi', 'difa', '90cdacabb036a18cce4ac1417030d672', 1),
(294485, 'Ali Husen', 'ali_husen', 'e0033e8f9b61d3a3f7ee4531ad0b0b92', 1),
(321341, 'Ryan', 'ryan.marketing', 'bd410624ee16dc9e3e23bc68700c43ab', 3),
(766600, 'Dairoh', 'dairoh', '202cb962ac59075b964b07152d234b70', 1),
(767805, 'Andi Shandy Damario Putra', 'andi.ceo', 'c137606bbcf80110cbb188cfd74aada5', 6),
(829125, 'ina', 'ina.akuntansi', '0b91e0219839f423bc25e2bffc1cfdcd', 5),
(987030, 'Ikhsanudin', 'ikhsan.produksi', 'b2ab8163dc9a4ffdb8dcea1b0a4230f4', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_klien`
--

CREATE TABLE `detail_klien` (
  `id_detail_klien` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `nomor_hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_klien`
--

INSERT INTO `detail_klien` (`id_detail_klien`, `id_akun`, `alamat`, `email`, `nomor_hp`) VALUES
(159775, 159775, 'Jl. Kyai H. Abdul Latif No.5, Karangasem, Kec. Cilegon, Kota Cilegon, Banten 42417', 'difa@gmail.com', '08111111111'),
(294485, 294485, 'Belakang toko kelontong DAYAN MART no rumah 19, Jl. Merpati Raya No.161, RT.4/RW.3, Sawah Lama, Kec. Ciputat, Kota Tangerang Selatan, Banten 15413', 'ali.husen123@gmail.com', '087771236822'),
(321341, 321341, '', '', ''),
(766600, 766600, 'Belakang toko kelontong DAYAN MART no rumah 19, Jl. Merpati Raya No.161, RT.4/RW.3, Sawah Lama, Kec. Ciputat, Kota Tangerang Selatan, Banten 15413', 'dairoh.serang123@gmail.com', '08111223457'),
(767805, 767805, '', '', ''),
(829125, 829125, '', '', ''),
(987030, 987030, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_produk`, `jumlah`) VALUES
(3, 284085, 111111, 1),
(4, 284085, 250963, 1),
(13, 209063, 250963, 10),
(14, 209063, 111111, 1),
(17, 830201, 111114, 2),
(18, 830201, 111115, 1),
(27, 606034, 111111, 1),
(28, 606034, 250963, 2),
(37, 551374, 111111, 2),
(38, 551374, 250963, 2),
(41, 263706, 111115, 1),
(42, 120353, 111114, 1),
(43, 50113, 111112, 2),
(44, 50113, 111115, 1),
(45, 794780, 111112, 2),
(47, 613971, 111114, 2),
(48, 584752, 111114, 1),
(49, 584752, 250963, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_proyek`
--

CREATE TABLE `detail_proyek` (
  `id_detail_proyek` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama_klien` text NOT NULL,
  `lokasi` text NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `nomor_hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_proyek`
--

INSERT INTO `detail_proyek` (`id_detail_proyek`, `id_proyek`, `nama_klien`, `lokasi`, `alamat`, `email`, `nomor_hp`) VALUES
(1, 671278, 'Zahra', 'jakarta timur', '', '', '454518432163'),
(2, 161691, 'arman', 'Bekasi', 'Bekasi Timur', 'arman@gmail.com', '087774561234'),
(3, 765575, 'Ali Husen', 'Tangerang', 'Alam sutra', '', '087774632165'),
(4, 562875, 'Zahra 3', 'jakarta timur', '', '', '454518432163'),
(5, 289607, 'Zahra 2', 'jakarta timur', '', '', '454518432163'),
(7, 216603, 'Difa Ishomi', 'Cilegon', '', 'difa2@gmail.com', '20654612211');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` int(11) NOT NULL,
  `nama_hak_akses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `nama_hak_akses`) VALUES
(1, 'klien'),
(2, 'administrator'),
(3, 'marketing'),
(4, 'produksi'),
(5, 'akuntansi'),
(6, 'ceo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_proyek`
--

CREATE TABLE `item_proyek` (
  `id_item_proyek` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama_item_proyek` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item_proyek`
--

INSERT INTO `item_proyek` (`id_item_proyek`, `id_proyek`, `nama_item_proyek`, `jumlah`, `keterangan`, `harga_item`) VALUES
(155758, 671278, 'Lampu taman', 4, 'Lampu Taman LED ', 1000000),
(331682, 161691, 'Partisi A', 1, 'Vynil, 200x350', 26000000),
(347682, 671278, 'Lampu taman', 4, 'Lampu Taman LED ', 1000000),
(458280, 289607, 'Lampu taman', 4, 'Lampu Taman LED ', 1000000),
(485385, 289607, 'Lampu taman', 4, 'Lampu Taman LED ', 1000000),
(827565, 765575, 'Wallpaper type 3', 42, '', 6200000),
(832153, 216603, 'Lemari 1 Pintu', 1, 'Beli baru', 2000000),
(910740, 562875, 'Lampu taman', 4, 'Lampu Taman LED ', 1000000),
(999227, 161691, 'Partisi B', 1, 'Vinyl Coklat 200x500', 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Meja'),
(2, 'Kursi'),
(3, 'Lampu'),
(4, 'Lemari'),
(7, 'Sofa'),
(10, 'Laci'),
(13, 'Rak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_akun_kostumer` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_akun_kostumer`, `id_produk`, `tanggal`, `jumlah`) VALUES
(5, 159775, 250963, '2022-02-11 19:02:51', 10),
(9, 159775, 111111, '2022-03-05 19:30:09', 1),
(11, 294485, 111111, '2022-03-06 09:40:47', 1),
(12, 294485, 250963, '2022-03-06 13:20:55', 1),
(13, 159775, 111112, '2022-03-22 12:31:54', 1),
(14, 766600, 111114, '2022-05-27 11:08:31', 2),
(15, 766600, 111115, '2022-05-27 11:09:19', 1),
(16, 294485, 111114, '2022-07-21 22:05:23', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `bank_pemilik` text NOT NULL,
  `no_rekening` text NOT NULL,
  `nama_pemilik` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `bank_pemilik`, `no_rekening`, `nama_pemilik`, `tanggal`, `id_akun`) VALUES
(230438, 263706, 'bca', '25252852525', 'Difa Ishomi', '2022-07-18 05:38:53', 159775),
(337800, 551374, 'bri', '222222222', 'Ali Husen', '2022-07-01 00:20:22', 294485),
(478243, 120353, 'bca', '123432341', 'DAIROH', '2022-07-17 23:16:09', 766600),
(495097, 830201, 'mandiri', '022154682', 'DAIROH', '2022-06-27 00:00:00', 766600),
(743543, 584752, 'bca', '2312312321', 'anita', '2022-07-18 03:31:14', 294485),
(962193, 284085, 'bca', '123456', 'Mohammad Ali Vellayati Husaini', '2022-04-27 00:00:00', 294485);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `metode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_akun`, `tanggal`, `metode`) VALUES
(50113, 294485, '2022-07-18 04:26:17', 'transfer'),
(120353, 766600, '2022-07-18 02:28:16', 'transfer'),
(209063, 159775, '2022-04-24 00:17:21', 'transfer'),
(263706, 159775, '2022-07-18 02:16:13', 'transfer'),
(284085, 294485, '2022-03-06 13:31:10', 'transfer'),
(551374, 294485, '2022-06-16 20:19:33', 'transfer'),
(584752, 294485, '2022-07-18 02:15:50', 'transfer'),
(606034, 159775, '2022-06-15 00:31:01', 'transfer'),
(613971, 294485, '2022-07-21 22:20:24', 'transfer'),
(794780, 294485, '2022-07-18 04:26:59', 'transfer'),
(830201, 766600, '2022-05-27 11:20:54', 'transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` text NOT NULL,
  `harga_produk` text NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text DEFAULT 'default.png',
  `tersedia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi`, `gambar`, `tersedia`) VALUES
(111111, 1, 'Meja Makan', '400000', 'Meja Makan dengan kayu jati', 'default.jpg', 1),
(111112, 1, 'Meja Kantor', '721000', '4 Laci 30x40 cm<br>\ntinggi 100 cm', 'default.jpg', 1),
(111113, 1, 'Meja Bambu', '327000', 'Meja tamu berbahan bambu\r\ntinggi 80 cm\r\nalas kaca', 'default.jpg', 1),
(111114, 2, 'Kursi Lipat', '505000', 'Kursi bisa dilipat dan portable\r\nterbuat dari baja ringan yang kuat', 'default.jpg', 1),
(111115, 2, 'Kursi Kayu Jati', '700000', 'terbuat dari kayu jati asli\nkuat dan tahan lama\nanti rayap', 'default.jpg', 1),
(250963, 7, 'Sofa Bed', '500000', 'Sofa Bed Standard : 160cm x 110cm\r<br>Sofa Bed Jumbo : 200cm x 110cm\r<br>Menerima custom sofa bed', 'sofa.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `nama_proyek` text NOT NULL,
  `dibuat` datetime NOT NULL,
  `dimulai` datetime NOT NULL,
  `target_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `nama_proyek`, `dibuat`, `dimulai`, `target_selesai`) VALUES
(161691, 'pengisian 1 rumah', '2022-07-12 16:50:03', '2022-07-01 00:00:00', '2022-07-31 23:59:59'),
(216603, 'Repair Lemari', '2022-07-20 04:49:32', '2022-07-20 00:00:00', '2022-07-27 23:59:59'),
(289607, 'pengisian taman 2', '2022-07-12 19:37:59', '2022-07-10 00:00:00', '2022-07-31 23:59:59'),
(562875, 'pengisian taman 3', '2022-07-12 19:34:38', '2022-07-10 00:00:00', '2022-07-31 23:59:59'),
(671278, 'pengisian taman', '2022-07-11 17:56:47', '2022-07-10 00:00:00', '2022-07-31 00:00:00'),
(765575, 'pemasangan wallpaper lobby', '2022-07-12 19:22:31', '2022-07-10 00:00:00', '2022-07-31 23:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `id_status_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_pesanan`
--

INSERT INTO `status_pesanan` (`id_status_pesanan`, `id_pesanan`, `status`, `tanggal`, `keterangan`) VALUES
(1, 284085, 'menunggu info bank', '2022-03-12 13:49:13', ''),
(16, 284085, 'menunggu verifikasi bayar', '2022-04-18 17:03:21', ''),
(17, 209063, 'menunggu info bank', '2022-04-24 00:21:42', ''),
(18, 830201, 'menunggu info bank', '2022-05-27 11:25:06', ''),
(21, 606034, 'menunggu info bank', '2022-06-15 00:31:01', 'input manual : 1'),
(22, 551374, 'pembuatan', '2022-06-16 20:19:33', 'input manual : 1'),
(23, 551374, 'menunggu info bank', '2022-06-17 02:15:46', 'input manual : 1'),
(28, 551374, 'selesai', '2022-06-17 02:28:17', 'input manual : 1'),
(29, 830201, 'menunggu verifikasi bayar', '2022-06-25 22:33:22', ''),
(31, 584752, 'pembuatan', '2022-07-18 02:15:50', 'input manual : 1'),
(32, 263706, 'menunggu info bank', '2022-07-18 02:16:13', 'input manual : 1'),
(33, 120353, 'batal', '2022-07-18 02:28:16', 'input manual : 1'),
(34, 50113, 'menunggu info bank', '2022-07-18 04:26:17', 'input manual : 1'),
(35, 794780, 'menunggu info bank', '2022-07-18 04:26:59', 'input manual : 1'),
(38, 584752, 'pengiriman', '2022-07-19 17:12:30', '1'),
(39, 584752, 'selesai', '2022-07-21 01:13:03', '1'),
(40, 613971, 'menunggu info bank', '2022-07-21 22:20:24', ''),
(46, 584752, 'selesai', '2022-07-22 02:11:01', 'input manual : 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_proyek`
--

CREATE TABLE `status_proyek` (
  `id_status_proyek` int(11) NOT NULL,
  `id_item_proyek` int(11) NOT NULL,
  `status` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `progres` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_proyek`
--

INSERT INTO `status_proyek` (`id_status_proyek`, `id_item_proyek`, `status`, `tanggal`, `keterangan`, `progres`) VALUES
(1, 155758, 'menunggu hasil survey', '2022-07-11 17:56:47', '2 : 1', 0),
(2, 347682, 'menunggu hasil survey', '2022-07-11 17:56:48', '2 : 1', 0),
(3, 999227, 'menunggu hasil survey', '2022-07-12 16:50:03', '2 : 1', 0),
(4, 331682, 'menunggu hasil survey', '2022-07-12 16:50:03', '2 : 1', 0),
(5, 827565, 'selesai', '2022-07-12 19:22:32', '2 : 1', 0),
(6, 910740, 'menunggu hasil survey', '2022-07-12 19:34:38', '2 : 1', 0),
(7, 485385, 'menunggu hasil survey', '2022-07-12 19:37:59', '2 : 1', 0),
(8, 458280, 'menunggu hasil survey', '2022-07-12 19:37:59', '2 : 1', 0),
(15, 832153, 'menunggu hasil survey', '2022-07-19 23:52:21', '', 0),
(16, 331682, 'menunggu konfirmasi dp', '2022-07-20 16:14:53', '1', 0),
(17, 999227, 'menunggu konfirmasi dp', '2022-07-20 16:14:53', '1', 0),
(18, 331682, 'proses produksi', '2022-07-20 16:29:20', '1', 0),
(19, 999227, 'proses produksi', '2022-07-20 16:29:20', '1', 0),
(20, 331682, 'proses produksi', '2022-07-20 20:24:35', 'Tinggal instalasi', 40),
(21, 999227, 'proses produksi', '2022-07-20 20:24:40', 'belum', 0),
(22, 331682, 'proses produksi', '2022-07-20 23:03:20', '', 70),
(23, 999227, 'proses produksi', '2022-07-20 23:03:20', '', 0),
(25, 331682, 'proses produksi', '2022-07-21 00:46:45', 'Selesai', 100),
(26, 999227, 'proses produksi', '2022-07-21 00:46:45', 'instalasi hampir selesai', 50),
(27, 331682, 'pengiriman', '2022-07-21 00:47:34', '', 100),
(28, 999227, 'pengiriman', '2022-07-21 00:47:34', 'selesai', 100),
(29, 331682, 'menunggu konfirmasi pelunasan', '2022-07-21 00:48:04', '1', 0),
(30, 999227, 'menunggu konfirmasi pelunasan', '2022-07-21 00:48:04', '1', 0),
(31, 331682, 'selesai', '2022-07-21 00:55:59', '1', 0),
(32, 999227, 'selesai', '2022-07-21 00:55:59', '1', 0),
(33, 832153, 'menunggu konfirmasi dp', '2022-07-21 00:56:14', '1', 0),
(34, 832153, 'proses produksi', '2022-07-21 00:56:22', '1', 0),
(35, 832153, 'batal', '2022-07-21 00:56:35', 'Tidak ada follow up dari klien | 1', 0),
(36, 155758, 'menunggu konfirmasi dp', '2022-07-21 00:57:31', '1', 0),
(37, 347682, 'menunggu konfirmasi dp', '2022-07-21 00:57:31', '1', 0),
(38, 155758, 'proses produksi', '2022-07-21 00:57:44', '1', 0),
(39, 347682, 'proses produksi', '2022-07-21 00:57:44', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `Uniq_username` (`username`) USING HASH,
  ADD KEY `Akun_fk0` (`id_hak_akses`);

--
-- Indeks untuk tabel `detail_klien`
--
ALTER TABLE `detail_klien`
  ADD PRIMARY KEY (`id_detail_klien`),
  ADD KEY `fk_detailAkun_user` (`id_akun`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `fk_detailPesanan_pesanan` (`id_pesanan`) USING BTREE,
  ADD KEY `fk_detailPesanan_produk` (`id_produk`) USING BTREE;

--
-- Indeks untuk tabel `detail_proyek`
--
ALTER TABLE `detail_proyek`
  ADD PRIMARY KEY (`id_detail_proyek`),
  ADD KEY `FK_Proyek_detail_proyek` (`id_proyek`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indeks untuk tabel `item_proyek`
--
ALTER TABLE `item_proyek`
  ADD PRIMARY KEY (`id_item_proyek`),
  ADD KEY `DetailProyek_fk0` (`id_proyek`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_akun_keranjang` (`id_akun_kostumer`),
  ADD KEY `fk_produk_keranjang` (`id_produk`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `Pembayaran_fk0` (`id_pesanan`),
  ADD KEY `FK_akun->pembayaran` (`id_akun`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `Pesanan_fk1` (`id_akun`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `Produk_fk0` (`id_kategori`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- Indeks untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id_status_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  ADD PRIMARY KEY (`id_status_proyek`),
  ADD KEY `FK_item_proyek->status_proyek` (`id_item_proyek`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `detail_proyek`
--
ALTER TABLE `detail_proyek`
  MODIFY `id_detail_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id_status_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  MODIFY `id_status_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `Akun_fk0` FOREIGN KEY (`id_hak_akses`) REFERENCES `hak_akses` (`id_hak_akses`) ON DELETE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_klien`
--
ALTER TABLE `detail_klien`
  ADD CONSTRAINT `FK_detailKlien_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `FK_detailPesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detailPesanan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_proyek`
--
ALTER TABLE `detail_proyek`
  ADD CONSTRAINT `FK_detail_proyek_Proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_proyek`
--
ALTER TABLE `item_proyek`
  ADD CONSTRAINT `ItemProyek_fk0` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_akun_kostumer`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_akun->pembayaran` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `Pembayaran_fk0` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `Pesanan_fk1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `Produk_fk0` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD CONSTRAINT `FK_statusPesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  ADD CONSTRAINT `FK_item_proyek->status_proyek` FOREIGN KEY (`id_item_proyek`) REFERENCES `item_proyek` (`id_item_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
