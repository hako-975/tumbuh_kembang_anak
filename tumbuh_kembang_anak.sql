-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2024 pada 17.49
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tumbuh_kembang_anak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anak`
--

CREATE TABLE `anak` (
  `id_anak` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `nama_ibu_kandung` varchar(100) NOT NULL,
  `no_telepon_orang_tua` varchar(15) DEFAULT NULL,
  `alamat_orang_tua` text NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anak`
--

INSERT INTO `anak` (`id_anak`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ibu_kandung`, `no_telepon_orang_tua`, `alamat_orang_tua`, `foto`, `dibuat_pada`) VALUES
(3, 'iireng schrodinger', '2024-07-07', 'perempuan', 'igi', '0', 'rumah', '668a04e15cb39_1720321249_jbc-TK_d8kni3OI-unsplash.jpg', '2024-07-07 02:09:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `waktu_antrian` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Menunggu','Diproses','Selesai','Dilewati') DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `waktu_antrian`, `status`) VALUES
(4, '2024-09-04 15:41:46', 'Selesai'),
(5, '2024-09-04 15:41:47', 'Selesai'),
(6, '2024-09-04 15:42:06', 'Menunggu'),
(7, '2024-09-04 15:42:48', 'Menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `spesialis`, `no_telepon`, `alamat`, `foto`, `dibuat_pada`) VALUES
(3, 'Andri Firman Saputra', 'Dokter Andrologi', '087808675313', 'Jl. AMD Babakan Pocis No. 88', '66896a1aae064_1720281626_65483768.jpeg', '2024-07-06 15:49:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tgl_log`, `id_user`) VALUES
(1, 'Password berhasil diperbaharui!', '2024-07-06 15:01:54', 1),
(2, 'Password berhasil diperbaharui!', '2024-07-06 15:02:14', 1),
(3, 'User  berhasil dihapus!', '2024-07-06 15:06:22', 1),
(4, 'User asd berhasil dihapus!', '2024-07-06 15:07:10', 1),
(5, 'User admin berhasil login!', '2024-07-06 15:08:21', 1),
(6, 'User asd berhasil ditambahkan!', '2024-07-06 15:11:07', 1),
(7, 'Profile berhasil diperbaharui!', '2024-07-06 15:12:08', 1),
(8, 'Profile berhasil diperbaharui!', '2024-07-06 15:12:14', 1),
(9, 'User asd berhasil diubah!', '2024-07-06 15:14:32', 1),
(10, 'User admin berhasil logout!', '2024-07-06 15:22:25', 1),
(11, 'User admin berhasil login!', '2024-07-06 15:22:34', 1),
(12, 'User asd berhasil dihapus!', '2024-07-06 15:37:59', 1),
(13, 'User asd berhasil ditambahkan!', '2024-07-06 15:38:16', 1),
(14, 'User asd berhasil dihapus!', '2024-07-06 15:38:19', 1),
(15, 'Dokter Andri Firman Saputra berhasil ditambahkan!', '2024-07-06 15:49:12', 1),
(16, 'Dokter Andri Firman Saputra berhasil dihapus!', '2024-07-06 15:55:27', 1),
(17, 'Dokter Andri Firman Saputra berhasil dihapus!', '2024-07-06 15:55:32', 1),
(18, 'Dokter Andri Firman Saputra123 berhasil diubah!', '2024-07-06 16:00:13', 1),
(19, 'Dokter Andri Firman Saputra123 berhasil diubah!', '2024-07-06 16:00:21', 1),
(20, 'Dokter Andri Firman Saputra123 berhasil diubah!', '2024-07-06 16:00:26', 1),
(21, 'Dokter Andri Firman Saputra berhasil diubah!', '2024-07-06 16:00:41', 1),
(22, 'Anak asd berhasil ditambahkan!', '2024-07-06 16:13:18', 1),
(23, 'Anak asd berhasil dihapus!', '2024-07-06 16:15:29', 1),
(24, 'Anak Alivia Sabrina berhasil ditambahkan!', '2024-07-06 16:15:48', 1),
(25, 'Anak Alivia Sabrina123 berhasil diubah!', '2024-07-06 16:19:19', 1),
(26, 'Anak Alivia Sabrina123 berhasil dihapus!', '2024-07-06 16:19:35', 1),
(27, 'User admin berhasil login!', '2024-07-07 01:55:24', 1),
(28, 'Anak ii berhasil ditambahkan!', '2024-07-07 02:09:31', 1),
(29, 'Anak iireng schrodinger berhasil diubah!', '2024-07-07 02:10:34', 1),
(30, 'Pemeriksaan iireng schrodinger berhasil ditambahkan!', '2024-07-07 02:43:56', 1),
(31, 'Pemeriksaan iireng schrodinger berhasil dihapus!', '2024-07-07 02:46:09', 1),
(32, 'Pemeriksaan iireng schrodinger berhasil ditambahkan!', '2024-07-07 02:46:32', 1),
(33, 'Pemeriksaan iireng schrodinger berhasil dihapus!', '2024-07-07 02:48:51', 1),
(34, 'Pemeriksaan iireng schrodinger berhasil ditambahkan!', '2024-07-07 02:49:11', 1),
(35, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-07 02:58:16', 1),
(36, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-07 02:58:38', 1),
(37, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-07 02:58:43', 1),
(38, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-07 03:00:20', 1),
(39, 'Anak iireng schrodinger berhasil diubah!', '2024-07-07 03:00:49', 1),
(40, 'User admin berhasil logout!', '2024-07-07 03:01:50', 1),
(41, 'User alivia123 berhasil login!', '2024-07-07 03:01:55', 20),
(42, 'User alivia123 berhasil logout!', '2024-07-07 03:01:59', 20),
(43, 'User admin berhasil login!', '2024-07-08 12:30:23', 1),
(44, 'Profile berhasil diperbaharui!', '2024-07-08 12:35:00', 1),
(45, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-08 12:51:26', 1),
(46, 'Pemeriksaan iireng schrodinger berhasil ditambahkan!', '2024-07-08 12:53:18', 1),
(47, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-08 12:59:51', 1),
(48, 'Anak iireng schrodingerv iireng schrodinger III berhasil diubah!', '2024-07-08 13:03:52', 1),
(49, 'Anak iireng schrodinger berhasil diubah!', '2024-07-08 13:04:25', 1),
(50, 'User admin berhasil logout!', '2024-07-08 13:42:21', 1),
(51, 'User admin berhasil login!', '2024-07-08 13:45:21', 1),
(52, 'User admin berhasil login!', '2024-07-12 17:50:51', 1),
(53, 'User admin berhasil logout!', '2024-07-12 17:51:15', 1),
(54, 'User admin berhasil login!', '2024-07-12 17:53:49', 1),
(55, 'User admin berhasil logout!', '2024-07-12 18:49:56', 1),
(56, 'User admin berhasil login!', '2024-07-14 02:49:04', 1),
(57, 'Pemeriksaan iireng schrodinger berhasil ditambahkan!', '2024-07-14 02:52:15', 1),
(58, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-14 03:00:34', 1),
(59, 'Pemeriksaan iireng schrodinger berhasil diubah!', '2024-07-14 03:00:59', 1),
(60, 'User admin berhasil logout!', '2024-07-14 03:15:40', 1),
(61, 'User alivia123 berhasil login!', '2024-07-14 03:15:47', 20),
(62, 'User alivia123 berhasil logout!', '2024-07-14 03:16:40', 20),
(63, 'User admin berhasil login!', '2024-07-14 03:16:43', 1),
(64, 'User admin berhasil logout!', '2024-07-14 03:16:46', 1),
(65, 'User alivia123 berhasil login!', '2024-07-14 03:16:50', 20),
(66, 'User alivia123 berhasil logout!', '2024-07-14 03:24:09', 20),
(67, 'User admin berhasil login!', '2024-09-04 14:44:57', 1),
(68, 'Antrian 1 berhasil dihapus!', '2024-09-04 15:15:59', 1),
(69, 'Antrian 1 berhasil dihapus!', '2024-09-04 15:16:08', 1),
(70, 'User admin berhasil login!', '2024-09-04 15:23:21', 1),
(71, 'Antrian 2 berhasil dihapus!', '2024-09-04 15:40:15', 1),
(72, 'Antrian 3 berhasil dihapus!', '2024-09-04 15:40:19', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `berat_badan` decimal(5,2) NOT NULL,
  `tinggi_badan` decimal(5,2) NOT NULL,
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `tanggal_pengamatan` datetime NOT NULL,
  `catatan` text DEFAULT NULL,
  `foto` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `id_anak`, `id_dokter`, `berat_badan`, `tinggi_badan`, `lingkar_kepala`, `tanggal_pengamatan`, `catatan`, `foto`, `id_user`) VALUES
(3, 3, 3, '21.00', '123.00', '40.00', '2024-07-07 09:48:00', 'sehat', '668a04c43d80d_1720321220_644e0627aff5b.jpeg', 1),
(4, 3, 3, '40.00', '140.00', '40.00', '2024-07-08 19:52:00', 'sehat', '668be2c7f0cd0_1720443591_61b19e6fc24b9.jpg', 1),
(5, 3, 3, '45.00', '141.00', '40.00', '2024-07-14 09:51:00', '', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('admin','petugas') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `foto`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'Administrator', '668bdcf48892c_1720442100_avatar5.png', '2024-07-04 08:52:18'),
(20, 'alivia123', '$2y$10$PszuD6VZ7N.lKSP7d3IFCudtAwrkgld5D2QOmP0icXoPP007LOvPG', 'petugas', 'Alivia Sabrina', '6688a81f8886c_1720231967_avatar3.png', '2024-07-06 02:12:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `pemeriksaan_ibfk_1` (`id_anak`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anak`
--
ALTER TABLE `anak`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemeriksaan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
