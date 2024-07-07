-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2024 pada 05.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
(39, 'Anak iireng schrodinger berhasil diubah!', '2024-07-07 03:00:49', 1);

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
(3, 3, 3, '21.69', '123.42', '33.69', '2024-07-07 09:48:00', 'tes123', '668a04c43d80d_1720321220_644e0627aff5b.jpeg', 1);

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
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'Administrator', '6688a7d63d645_1720231894_avatar5.png', '2024-07-04 08:52:18'),
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
  ADD KEY `id_anak` (`id_anak`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`),
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `pemeriksaan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
