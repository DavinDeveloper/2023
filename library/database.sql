-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Nov 2023 pada 04.37
-- Versi server: 10.6.15-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1574150_opus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_contact`
--

CREATE TABLE `config_contact` (
  `id` int(11) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `telepon` varchar(256) NOT NULL,
  `operasional` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config_contact`
--

INSERT INTO `config_contact` (`id`, `alamat`, `email`, `telepon`, `operasional`) VALUES
(1, 'UIN Sunan Gunung Djati Bandung', 'admin@ojekampus.com', '628817738576', 'Senin - Kamis : 07.30 - 23.00 WIB\r\nJum\'at - Minggu : 07.30 - 00.00 WIB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_email`
--

CREATE TABLE `config_email` (
  `id` int(11) NOT NULL,
  `host` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config_email`
--

INSERT INTO `config_email` (`id`, `host`, `username`, `password`) VALUES
(1, 'srv61.niagahoster.com', 'admin@ojekampus.com', '@OjeKampus1212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_faq`
--

CREATE TABLE `config_faq` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(256) NOT NULL,
  `jawaban` varchar(256) NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config_faq`
--

INSERT INTO `config_faq` (`id`, `pertanyaan`, `jawaban`, `status`, `created`, `updated`) VALUES
(1, 'Bagaimana cara kerja opus?', 'Jadi gini...', 'show', '2023-11-11 05:15:09', '2023-11-11 05:15:09'),
(2, 'Kenapa harus Opus?', 'Jadi gini...', 'show', '2023-11-11 05:15:09', '2023-11-11 05:15:09'),
(3, 'Harus banget Opus?', 'Jadi gini...', 'show', '2023-11-11 05:15:09', '2023-11-11 05:15:09');

--
-- Trigger `config_faq`
--
DELIMITER $$
CREATE TRIGGER `update_config_faq` BEFORE UPDATE ON `config_faq` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_website`
--

CREATE TABLE `config_website` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `mt` enum('Off','On') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config_website`
--

INSERT INTO `config_website` (`id`, `name`, `url`, `mt`) VALUES
(1, 'OPUS', 'https://ojekampus.com/', 'Off');

-- --------------------------------------------------------

--
-- Struktur dari tabel `config_whatsapp`
--

CREATE TABLE `config_whatsapp` (
  `id` int(11) NOT NULL,
  `number` varchar(256) NOT NULL,
  `api_key` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `config_whatsapp`
--

INSERT INTO `config_whatsapp` (`id`, `number`, `api_key`, `url`) VALUES
(1, '628817738576', '4xdW6411ZEJEEsMg8VIAEOk0IUzSln', 'https://davin.gateaway.my.id/send-message');

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinasi_kampus`
--

CREATE TABLE `destinasi_kampus` (
  `id` int(11) NOT NULL,
  `destinasi` varchar(256) NOT NULL,
  `harga1` int(11) NOT NULL,
  `harga2` int(11) NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `destinasi_kampus`
--
DELIMITER $$
CREATE TRIGGER `update_destinasi_kampus` BEFORE UPDATE ON `destinasi_kampus` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinasi_lain`
--

CREATE TABLE `destinasi_lain` (
  `id` int(11) NOT NULL,
  `destinasi1` varchar(256) NOT NULL,
  `destinasi2` varchar(256) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `destinasi_lain`
--
DELIMITER $$
CREATE TRIGGER `update_destinasi_lain` BEFORE UPDATE ON `destinasi_lain` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `iklan`
--
DELIMITER $$
CREATE TRIGGER `update_iklan` BEFORE UPDATE ON `iklan` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `nomor` varchar(256) NOT NULL,
  `qr` varchar(256) NOT NULL,
  `alias` varchar(256) NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `metode_pembayaran`
--
DELIMITER $$
CREATE TRIGGER `update_metode_pembayaran` BEFORE UPDATE ON `metode_pembayaran` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `id_destinasi_kampus` int(11) DEFAULT NULL,
  `id_destinasi_lain` int(11) DEFAULT NULL,
  `pemberangkatan` enum('1','2') DEFAULT NULL,
  `destinasi_healing` varchar(256) DEFAULT NULL,
  `tipe` enum('Pulang','Berangkat','Healing','Destinasi Lain') NOT NULL,
  `kampus` enum('1','2') DEFAULT NULL,
  `catatan` varchar(256) NOT NULL,
  `patokan` varchar(256) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `status` enum('Menunggu','Diambil','Penjemputan','Perjalanan','Pembayaran','Selesai','Sibuk','Dibatalkan') NOT NULL,
  `latitude_customer` varchar(256) NOT NULL,
  `longitude_customer` varchar(256) NOT NULL,
  `latitude_driver` varchar(256) NOT NULL,
  `longitude_driver` varchar(256) NOT NULL,
  `pembayaran` enum('Cash','Cashless') NOT NULL,
  `masukan` varchar(256) NOT NULL,
  `nilai` int(11) NOT NULL,
  `end` datetime DEFAULT NULL,
  `time` time NOT NULL DEFAULT curtime(),
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `pesanan`
--
DELIMITER $$
CREATE TRIGGER `update_pesanan` BEFORE UPDATE ON `pesanan` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_chat`
--

CREATE TABLE `riwayat_chat` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `file` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_chat`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_chat` BEFORE UPDATE ON `riwayat_chat` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_masuk`
--

CREATE TABLE `riwayat_masuk` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `device` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_masuk` BEFORE UPDATE ON `riwayat_masuk` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pembatalan`
--

CREATE TABLE `riwayat_pembatalan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `alasan` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_pembatalan`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_pembatalan` BEFORE UPDATE ON `riwayat_pembatalan` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_penilaian`
--

CREATE TABLE `riwayat_penilaian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `masukan` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_penilaian`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_penilaian` BEFORE UPDATE ON `riwayat_penilaian` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `proses` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_pesanan`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_pesanan` BEFORE UPDATE ON `riwayat_pesanan` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_upload`
--

CREATE TABLE `riwayat_upload` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `file` varchar(256) NOT NULL,
  `jenis` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `riwayat_upload`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_upload` BEFORE UPDATE ON `riwayat_upload` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `topup_saldo`
--

CREATE TABLE `topup_saldo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `metode` varchar(256) NOT NULL,
  `catatan` varchar(256) NOT NULL,
  `status` enum('Menunggu','Dibatalkan','Berhasil') NOT NULL,
  `validasi` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `topup_saldo`
--
DELIMITER $$
CREATE TRIGGER `update_topup_saldo` BEFORE UPDATE ON `topup_saldo` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telepon` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `unhash` varchar(256) NOT NULL,
  `identitas` varchar(256) NOT NULL,
  `saldo` int(11) NOT NULL,
  `level` enum('Customer','Driver','Admin','Developer') NOT NULL,
  `status` enum('Pending','Active','Suspend') NOT NULL,
  `upload` enum('Nothing','Pending','Confirmed','Rejected') NOT NULL,
  `stay` enum('Off','On') NOT NULL,
  `pesanan` int(11) DEFAULT NULL,
  `penilaian` int(11) DEFAULT NULL,
  `verifikasi` varchar(256) DEFAULT NULL,
  `driver_merk` varchar(256) NOT NULL,
  `driver_warna` varchar(256) NOT NULL,
  `driver_plat` varchar(256) NOT NULL,
  `driver_face` varchar(256) NOT NULL,
  `cookie` varchar(256) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `update_users` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `config_contact`
--
ALTER TABLE `config_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config_email`
--
ALTER TABLE `config_email`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config_faq`
--
ALTER TABLE `config_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config_website`
--
ALTER TABLE `config_website`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `config_whatsapp`
--
ALTER TABLE `config_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `destinasi_kampus`
--
ALTER TABLE `destinasi_kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `destinasi_lain`
--
ALTER TABLE `destinasi_lain`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_id_destinasi_kampus_destinasi_kampus` (`id_destinasi_kampus`),
  ADD KEY `fk_pesanan_id_destinasi_lain_destinasi_lain` (`id_destinasi_lain`),
  ADD KEY `fk_pesanan_id_user_users` (`id_user`),
  ADD KEY `fk_pesanan_id_driver_users` (`id_driver`);

--
-- Indeks untuk tabel `riwayat_chat`
--
ALTER TABLE `riwayat_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_chat_id_user_users` (`id_user`),
  ADD KEY `fk_riwayat_chat_id_pesanan_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `riwayat_masuk`
--
ALTER TABLE `riwayat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_masuk_users` (`id_user`);

--
-- Indeks untuk tabel `riwayat_pembatalan`
--
ALTER TABLE `riwayat_pembatalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_pembatalan_id_user_users` (`id_user`),
  ADD KEY `fk_riwayat_pembatalan_id_pesanan_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `riwayat_penilaian`
--
ALTER TABLE `riwayat_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_penilaian_id_user_users` (`id_user`),
  ADD KEY `fk_riwayat_penilaian_id_pesanan_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_pesanan_id_pesanan_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `riwayat_upload`
--
ALTER TABLE `riwayat_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_upload_users` (`id_user`);

--
-- Indeks untuk tabel `topup_saldo`
--
ALTER TABLE `topup_saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topup_saldo_id_user_users` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_penilaian_pesanan_id_pesanan` (`penilaian`),
  ADD KEY `fk_users_pesanan_pesanan_id_pesanan` (`pesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `config_contact`
--
ALTER TABLE `config_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `config_email`
--
ALTER TABLE `config_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `config_faq`
--
ALTER TABLE `config_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `config_website`
--
ALTER TABLE `config_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `config_whatsapp`
--
ALTER TABLE `config_whatsapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `destinasi_kampus`
--
ALTER TABLE `destinasi_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `destinasi_lain`
--
ALTER TABLE `destinasi_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_chat`
--
ALTER TABLE `riwayat_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_masuk`
--
ALTER TABLE `riwayat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pembatalan`
--
ALTER TABLE `riwayat_pembatalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_penilaian`
--
ALTER TABLE `riwayat_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_upload`
--
ALTER TABLE `riwayat_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `topup_saldo`
--
ALTER TABLE `topup_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_id_destinasi_kampus_destinasi_kampus` FOREIGN KEY (`id_destinasi_kampus`) REFERENCES `destinasi_kampus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pesanan_id_destinasi_lain_destinasi_lain` FOREIGN KEY (`id_destinasi_lain`) REFERENCES `destinasi_lain` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pesanan_id_driver_users` FOREIGN KEY (`id_driver`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pesanan_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_chat`
--
ALTER TABLE `riwayat_chat`
  ADD CONSTRAINT `fk_riwayat_chat_id_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_riwayat_chat_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_masuk`
--
ALTER TABLE `riwayat_masuk`
  ADD CONSTRAINT `fk_riwayat_masuk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pembatalan`
--
ALTER TABLE `riwayat_pembatalan`
  ADD CONSTRAINT `fk_riwayat_pembatalan_id_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_riwayat_pembatalan_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_penilaian`
--
ALTER TABLE `riwayat_penilaian`
  ADD CONSTRAINT `fk_riwayat_penilaian_id_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_riwayat_penilaian_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD CONSTRAINT `fk_riwayat_pesanan_id_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_upload`
--
ALTER TABLE `riwayat_upload`
  ADD CONSTRAINT `fk_riwayat_upload_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `topup_saldo`
--
ALTER TABLE `topup_saldo`
  ADD CONSTRAINT `fk_topup_saldo_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_penilaian_pesanan_id_pesanan` FOREIGN KEY (`penilaian`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_pesanan_pesanan_id_pesanan` FOREIGN KEY (`pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
