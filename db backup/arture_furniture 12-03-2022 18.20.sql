-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2022 pada 07.19
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
(159775, 'Difa', 'difa', '7726a3674fbfab26b520ddac1d28818c', 1),
(294485, 'ali husen', 'ali_husen', 'fc9e195eac0b5bf53a851bc5905741a1', 1);

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
(159775, 159775, 'Jl. Kyai H. Abdul Latif No.5, Karangasem, Kec. Cilegon, Kota Cilegon, Banten 42417', 'difa@gmail.com', '081111111111'),
(294485, 294485, 'Jl. Merpati Raya no. 161, Ciputat, Tangerang selatan, Banten', 'coolwolfentertainment@gmail.com', '087771236822');

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
(4, 284085, 250963, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_proyek`
--

CREATE TABLE `detail_proyek` (
  `id_detail_proyek` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama_detail_proyek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 'finance');

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
(12, 294485, 250963, '2022-03-06 13:20:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `bank_pemilik` text NOT NULL,
  `no_rekening` text NOT NULL,
  `nama_pemilik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(284085, 294485, '2022-03-06 13:31:10', 'transfer');

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
  `id_akun` int(11) NOT NULL,
  `nama_proyek` int(11) NOT NULL,
  `dibuat` datetime NOT NULL,
  `dimulai` datetime NOT NULL,
  `target_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_proyek`
--

CREATE TABLE `status_proyek` (
  `id_status_proyek` int(11) NOT NULL,
  `id_detail_proyek` int(11) NOT NULL,
  `status` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
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
  ADD UNIQUE KEY `fk_detailPesanan_produk` (`id_produk`),
  ADD KEY `fk_detailPesanan_pesanan` (`id_pesanan`) USING BTREE;

--
-- Indeks untuk tabel `detail_proyek`
--
ALTER TABLE `detail_proyek`
  ADD PRIMARY KEY (`id_detail_proyek`),
  ADD KEY `DetailProyek_fk0` (`id_proyek`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

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
  ADD KEY `Pembayaran_fk0` (`id_pesanan`);

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
  ADD PRIMARY KEY (`id_proyek`),
  ADD KEY `Proyek_fk0` (`id_akun`);

--
-- Indeks untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  ADD PRIMARY KEY (`id_status_proyek`),
  ADD UNIQUE KEY `fk_detailProyek_statuProyek` (`id_detail_proyek`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  MODIFY `id_status_proyek` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `DetailProyek_fk0` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`);

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
  ADD CONSTRAINT `Pembayaran_fk0` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

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
-- Ketidakleluasaan untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `Proyek_fk0` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `status_proyek`
--
ALTER TABLE `status_proyek`
  ADD CONSTRAINT `FK_detailProyek_statusProyek` FOREIGN KEY (`id_detail_proyek`) REFERENCES `detail_proyek` (`id_detail_proyek`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
