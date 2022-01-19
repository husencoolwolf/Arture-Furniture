CREATE TABLE `Akun` (
	`id_akun` INT NOT NULL,
	`nama` TEXT NOT NULL,
	`username` TEXT NOT NULL,
	`password` TEXT NOT NULL,
	`alamat` TEXT NOT NULL,
	`nomor_hp` TEXT NOT NULL,
	`id_hak_akses` INT NOT NULL,
	PRIMARY KEY (`id_akun`)
);

CREATE TABLE `Proyek` (
	`id_proyek` INT NOT NULL,
	`id_akun` INT NOT NULL,
	`nama_proyek` INT NOT NULL,
	`dibuat` DATETIME NOT NULL,
	`dimulai` DATETIME NOT NULL,
	`target_selesai` DATETIME NOT NULL,
	PRIMARY KEY (`id_proyek`)
);

CREATE TABLE `DetailProyek` (
	`id_detail_proyek` INT NOT NULL,
	`id_proyek` INT NOT NULL,
	`nama_detail_proyek` TEXT NOT NULL,
	`status_detail_proyek` TEXT NOT NULL,
	PRIMARY KEY (`id_detail_proyek`)
);

CREATE TABLE `Produk` (
	`id_produk` INT NOT NULL,
	`id_kategori` INT NOT NULL,
	`nama_produk` TEXT NOT NULL,
	`harga_produk` TEXT NOT NULL,
	`deskripsi` TEXT NOT NULL,
	`gambar` TEXT DEFAULT 'default.png',
	PRIMARY KEY (`id_produk`)
);

CREATE TABLE `Pembayaran` (
	`id_pembayaran` INT NOT NULL,
	`id_pesanan` INT NOT NULL,
	`bank_pemilik` TEXT NOT NULL,
	`no_rekening` TEXT NOT NULL,
	`nama_pemilik` TEXT NOT NULL,
	PRIMARY KEY (`id_pembayaran`)
);

CREATE TABLE `Kategori` (
	`id_kategori` INT NOT NULL AUTO_INCREMENT,
	`kategori` TEXT NOT NULL,
	PRIMARY KEY (`id_kategori`)
);

CREATE TABLE `Pesanan` (
	`id_pesanan` INT NOT NULL,
	`id_produk` INT NOT NULL,
	`id_akun` INT NOT NULL,
	`tanggal` DATE NOT NULL,
	`waktu` TIME NOT NULL,
	`jumlah` INT NOT NULL,
	PRIMARY KEY (`id_pesanan`)
);

CREATE TABLE `Hak_akses` (
	`id_hak_akses` INT NOT NULL AUTO_INCREMENT,
	`nama_hak_akses` TEXT NOT NULL,
	PRIMARY KEY (`id_hak_akses`)
);

ALTER TABLE `Akun` ADD CONSTRAINT `Akun_fk0` FOREIGN KEY (`id_hak_akses`) REFERENCES `Hak_akses`(`id_hak_akses`);

ALTER TABLE `Proyek` ADD CONSTRAINT `Proyek_fk0` FOREIGN KEY (`id_akun`) REFERENCES `Akun`(`id_akun`);

ALTER TABLE `DetailProyek` ADD CONSTRAINT `DetailProyek_fk0` FOREIGN KEY (`id_proyek`) REFERENCES `Proyek`(`id_proyek`);

ALTER TABLE `Produk` ADD CONSTRAINT `Produk_fk0` FOREIGN KEY (`id_kategori`) REFERENCES `Kategori`(`id_kategori`);

ALTER TABLE `Pembayaran` ADD CONSTRAINT `Pembayaran_fk0` FOREIGN KEY (`id_pesanan`) REFERENCES `Pesanan`(`id_pesanan`);

ALTER TABLE `Pesanan` ADD CONSTRAINT `Pesanan_fk0` FOREIGN KEY (`id_produk`) REFERENCES `Produk`(`id_produk`);

ALTER TABLE `Pesanan` ADD CONSTRAINT `Pesanan_fk1` FOREIGN KEY (`id_akun`) REFERENCES `Akun`(`id_akun`);









