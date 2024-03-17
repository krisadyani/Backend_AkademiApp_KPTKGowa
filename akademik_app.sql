-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2024 pada 04.57
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama`) VALUES
(1, 'Malang'),
(2, 'Surabaya'),
(3, 'Sidoarjo'),
(4, 'Jakarta'),
(5, 'Depok'),
(6, 'Trenggalek'),
(7, 'Tulungagung'),
(8, 'Blitar'),
(9, 'Tuban'),
(10, 'Cengkareng'),
(13, 'Batam'),
(16, 'Gresik'),
(17, 'Sukabumi'),
(61, 'Balekambang'),
(62, 'Probolinggo'),
(63, 'Bengkulu'),
(65, 'Bandung'),
(66, 'Cengkareng'),
(67, 'Padang'),
(68, 'Loksumawe'),
(69, 'Subang'),
(70, 'Solo'),
(71, 'Cilandak'),
(72, 'Bumiayu'),
(73, 'halo kota'),
(74, 'Jayapuraaad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenkel` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `nm_kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `tgl_lahir`, `alamat`, `jenkel`, `kota_id`, `nm_kota`) VALUES
(5, '090877887711', 'Ahmad Fauzan Arif', '2003-11-19', 'waru rejo GG anggrek', 1, 2, 'Surabaya'),
(6, '15135135', 'Sasi Kanti', '2002-10-23', 'agasdgas', 2, 1, 'Malang'),
(7, '1251251241215', 'Erik Setiadi', '1945-10-18', 'X Pare', 1, 1, 'Malang'),
(8, '1329846234970', 'Bayu Ramadhan', '2003-10-16', 'Sumbercupung', 1, 1, 'Malang'),
(10, '26269315309', 'Sasi Kanti', '2003-10-16', 'asgasdkgaskjdg', 2, 1, 'Malang'),
(12, '1241241241', 'Huda Surya', '2003-10-30', 'malang ', 1, 1, 'Malang'),
(13, '12412412', 'Kumala Binder shing', '2005-10-12', 'sdgdg', 2, 13, 'Batam'),
(14, '1241251251', 'Setiabudi John makmur setiadi', '2023-10-22', 'test', 1, 16, 'Gresik'),
(18, '125125124124', 'John sasimi', '2005-10-21', 'disana', 2, 17, 'Sukabumi'),
(19, '24124124', 'Jazzy anfield hayati', '2006-10-26', 'Bangil', 2, 3, 'Sidoarjo'),
(20, '12412414', 'Bojan malisic', '2003-10-15', 'serbia', 1, 2, 'Surabaya'),
(21, '6299199930001', 'Budi Jolali', '2003-10-09', 'Malang', 1, 61, 'Balekambang'),
(22, '113414312', 'Budi Doremi', '2003-10-08', 'testaamat', 1, 61, 'Balekambang'),
(23, '26273727273', 'Risma azzahro', '2004-10-12', 'test', 1, 6, 'Trenggalek'),
(24, '630000199002', 'Gilang zans', '2005-10-12', 'Exit', 1, 8, 'Blitar'),
(26, '1235849279', 'Rocky Ngerung', '2000-10-11', 'dirumahnya ', 1, 62, 'Probolinggo'),
(27, '098822882233', 'Ilham Setiawan Atmaja', '1945-10-02', 'Tenggarong', 1, 68, 'Loksumawe'),
(28, '131325332352', 'Ilham Udin armay', '2005-11-24', 'Cemorokandang', 1, 67, 'Padang'),
(29, '124124124', 'Umay ubaidillah', '2023-10-22', 'Paripurna', 1, 2, 'Surabaya'),
(30, '2414124124', 'Mike tyson ilmanna', '2023-10-22', 'test', 1, 65, 'Bandung'),
(31, '124124124', 'Maduh nyakopsah', '2005-10-21', 'TEST', 1, 10, 'Cengkareng'),
(32, '41251351515', 'Iwan Muniara', '2023-10-22', 'lombok', 1, 1, 'Malang'),
(33, '121214214', 'Big Daddy joee', '2023-10-31', 'test', 1, 65, 'Bandung'),
(34, '12412412', 'Yustina asimaaa', '2004-10-01', 'teset', 2, 5, 'Depok'),
(35, '1212412412', 'Kartika muliana', '2003-10-31', 'jalan baur', 2, 10, 'Cengkareng'),
(36, '12414124', 'Umi novia romadhona', '2003-10-09', 'bangil', 2, 1, 'Malang'),
(37, '1351352342', 'Jasmine aulia ', '2006-10-27', 'malang ', 2, 9, 'Tuban'),
(38, '141241241', 'Yayuk fadillah nuraini', '2005-10-12', 'malang', 2, 13, 'Batam'),
(39, '1251241241', 'Aulia vira nahfira', '2005-10-20', 'ondojaha', 2, 7, 'Tulungagung'),
(40, '12412124', 'Fitria khofifa warawansa', '2004-10-29', 'malang', 2, 1, 'Malang'),
(41, '136262535235', 'Wulan septi arfrida', '2005-10-11', 'malang', 2, 1, 'Malang'),
(42, '125124124', 'Naswa audia mecca', '2002-10-24', 'Jalan galunggung', 2, 8, 'Blitar'),
(43, '1512412142412', 'nurisfia ilmannaa', '2005-10-20', 'blitar jalan ikan gurami', 2, 8, 'Blitar'),
(44, '12412412', 'Hanum nurun nisa', '2005-10-27', 'bangil joidpan', 2, 67, 'Depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-01-05 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(1, 'Ahmad Fauzan Arif', 'fauzan@gmail.com', '$2y$10$yOD.nndXrJOV7EdQYd.UK.7/zvXF.nNS4cfvANB4aMqO9Y9FAI5tG', NULL, NULL, '2024-01-05 00:00:00', NULL),
(2, 'halogais3', 'halodo212c@gmail.com', '$2y$10$z09PS4g6r4WCzxR37aWFduEOyxjsqTuLer6djXH1kQgXCRgt44bym', NULL, NULL, '2024-01-05 00:00:00', NULL),
(3, 'Hudasurya', 'hudasurya@gmail.com', '$2y$10$SXUB5hmpNWYdWukVVbf8DeMjpnPLoRSai/nyXOtqQ06uNoPID2m6W', NULL, NULL, '2024-01-05 00:00:00', NULL),
(4, 'joebiden', 'joebiden@gmail.com', '$2y$10$CLID6FoRMtJPDtFRK1cymuEBusGXgE0rTeycIr7ZhzPzojOxBWAY6', NULL, NULL, '2024-01-05 00:00:00', NULL),
(5, 'kris', 'kris@gmail.com', '$2y$10$anPZLYFPAp2kvck3ep2akeGDpUYPx9B8rXRsPOY/pVBgSr4l3DTCu', NULL, NULL, '2024-01-05 00:00:00', NULL),
(6, 'talentana', 'talenta@gmail.com', '$2y$10$PAVaFLu8OUMEwaW4o4bHEOIG5leuNyG24v0AtzgLpWgTIilrDs5Fy', NULL, NULL, '2024-01-05 00:00:00', NULL),
(7, 'joko', 'joko@gmail.com', '$2y$10$1xmh835v3MSE2rl5SWQPjO5OQMXmci/.V7kZvxCoLrz1gnXnSYaHG', NULL, NULL, '2024-01-05 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kota_siswa` (`kota_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `FK_kota_siswa` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
