-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2022 pada 08.03
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelanggaran_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_pembina`
--

CREATE TABLE `guru_pembina` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru_pembina`
--

INSERT INTO `guru_pembina` (`id_guru`, `nip`, `nama_guru`, `email`, `role`, `password`, `created_at`) VALUES
(1, '123456789012345678', 'Ahmad Subarjo', 'ahmad@gmail.com', 'guru', '123456789012345678', '2022-02-14 17:11:45'),
(2, '234567890123456789', 'Rani Sunarti', 'rani@gmail.com', 'guru', '234567890123456789', '2022-02-14 17:11:45'),
(3, '345678901234567890', 'Ahmad Basir', 'ahmad@gmail.com', 'guru', '345678901234567890', '2022-02-15 13:52:43'),
(4, '456789012345678901', 'Nicholas Thomas', 'nicholas@gmail.com', 'guru', '456789012345678901', '2022-02-15 13:57:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kode_jurusan` varchar(255) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `id_kelas`, `kode_jurusan`, `nama_jurusan`) VALUES
(1, 1, 'AKL-1', 'Akuntasi dan Keuangan Lembaga'),
(2, 1, 'AKL-2', 'Akuntasi dan Keuangan Lembaga'),
(4, 1, 'BDP-1', 'Bisnis Daring dan Pemasaran'),
(5, 1, 'BDP-2', 'Bisnis Daring dan Pemasaran'),
(7, 1, 'OTKP-1', 'Otomatisasi Tata Kelola dan Perkantoran'),
(8, 1, 'OTKP-2', 'Otomatisasi Tata Kelola dan Perkantoran'),
(10, 1, 'RPL-1', 'Rekayasa Perangkat Lunak'),
(11, 1, 'RPL-2', 'Rekayasa Perangkat Lunak'),
(13, 2, 'AKL-1', 'Akuntasi dan Keuangan Lembaga'),
(14, 2, 'AKL-2', 'Akuntasi dan Keuangan Lembaga'),
(16, 2, 'BDP-1', 'Bisnis Daring dan Pemasaran'),
(17, 2, 'BDP-2', 'Bisnis Daring dan Pemasaran'),
(19, 2, 'OTKP-1', 'Otomatisasi Tata Kelola dan Perkantoran'),
(20, 2, 'OTKP-2', 'Otomatisasi Tata Kelola dan Perkantoran'),
(22, 2, 'RPL-1', 'Rekayasa Perangkat Lunak'),
(23, 2, 'RPL-2', 'Rekayasa Perangkat Lunak'),
(25, 3, 'AKL-1', 'Akuntasi dan Keuangan Lembaga'),
(26, 3, 'AKL-2', 'Akuntasi dan Keuangan Lembaga'),
(28, 3, 'BDP-1', 'Bisnis Daring dan Pemasaran'),
(29, 3, 'BDP-2', 'Bisnis Daring dan Pemasaran'),
(31, 3, 'OTKP-1', 'Otomatisasi Tata Kelola dan Perkantoran'),
(32, 3, 'OKTP-2', 'Otomatisasi Tata Kelola dan Perkantoran'),
(34, 3, 'RPL-1', 'Rekayasa Perangkat Lunak'),
(37, 3, 'RPL-2', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ket_pelanggaran`
--

CREATE TABLE `ket_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `jenis_pelanggaran` varchar(255) NOT NULL,
  `det_pelanggaran` varchar(255) NOT NULL,
  `poin_pelanggaran` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ket_pelanggaran`
--

INSERT INTO `ket_pelanggaran` (`id_pelanggaran`, `jenis_pelanggaran`, `det_pelanggaran`, `poin_pelanggaran`, `created_at`) VALUES
(1, 'kedisiplinan', 'Datang terlambat', 3, '2022-02-16 16:13:08'),
(2, 'kedisiplinan', 'Tidak mengerjakan tugas', 2, '2022-02-16 16:13:08'),
(3, 'kerapian', 'Rambut panjang', 1, '2022-02-16 16:13:08'),
(4, 'kerapian', 'Kuku panjang', 1, '2022-02-16 16:13:08'),
(5, 'kelengkapan', 'Atribut seragam tidak lengkap', 1, '2022-02-16 16:13:08'),
(6, 'kedisiplinan', 'Tidak mengikuti upacara', 2, '2022-02-16 16:20:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id_pelanggaran_siswa` int(11) NOT NULL,
  `id_pelanggar` int(11) NOT NULL,
  `id_pelapor` int(11) NOT NULL,
  `id_pelanggaran1` int(11) NOT NULL,
  `id_pelanggaran2` int(11) DEFAULT NULL,
  `id_pelanggaran3` int(11) DEFAULT NULL,
  `waktu_pelanggaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id_pelanggaran_siswa`, `id_pelanggar`, `id_pelapor`, `id_pelanggaran1`, `id_pelanggaran2`, `id_pelanggaran3`, `waktu_pelanggaran`) VALUES
(8, 1, 1, 1, 0, 0, '2022-02-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nis` int(5) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jmlh_poin` int(3) NOT NULL,
  `role` varchar(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `email`, `jmlh_poin`, `role`, `foto`, `password`, `created_at`) VALUES
(10, 1, 1, 10901, 'Ahmad Fajar', 'ahmad@gmail.com', 50, 'siswa', '620cea7c3cd78.jpg', '10901', '2022-02-16 12:13:48'),
(11, 1, 4, 10902, 'Putra Slamet', 'putra@gmail.com', 50, 'siswa', '620ceaa8b7fac.jpg', '10902', '2022-02-16 12:14:32'),
(12, 1, 7, 10903, 'Adhi Saputra', 'adhi@gmail.com', 50, 'siswa', '620ceb6fed529.jpg', '10903', '2022-02-16 12:17:51'),
(13, 1, 10, 10904, 'Triandini Maharani', 'triandini@gmail.com', 50, 'siswa', '620cec3f5fb6c.png', '10904', '2022-02-16 12:21:19'),
(14, 2, 13, 10905, 'Yudi Sugino', 'yudi@gmail.com', 50, 'siswa', '620cecd2163db.png', '10905', '2022-02-16 12:23:46'),
(15, 2, 16, 10906, 'Bambang Setiawan', 'bambang@gmail.com', 50, 'siswa', '620cecfc0cca3.png', '10906', '2022-02-16 12:24:28'),
(16, 2, 19, 10907, 'Safira Adinda', 'safira@gmail.com', 50, 'siswa', '620ced1ea98f6.png', '10907', '2022-02-16 12:25:02'),
(17, 2, 22, 10908, 'Albert Darwin', 'albert@gmail.com', 50, 'osis', '620ced393a9f7.png', '10908', '2022-02-17 04:24:42'),
(18, 3, 25, 10909, 'Puspita Anggraini', 'puput@gmail.com', 50, 'siswa', '620ced6e14189.png', '10909', '2022-02-16 12:26:22'),
(19, 3, 28, 10910, 'Abdul Kohir', 'abdul@gmail.com', 50, 'siswa', '620ced96bec6c.png', '10910', '2022-02-16 12:27:02'),
(20, 3, 31, 10911, 'Taufik Hidayat', 'taufik@gmail.com', 50, 'siswa', '620cedb7d7dbb.png', '10911', '2022-02-16 12:27:35'),
(21, 3, 34, 10912, 'Imelda Tanuji', 'imelda@gmail.com', 50, 'siswa', '620cedf03172b.png', '10912', '2022-02-16 12:28:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_log`
--

CREATE TABLE `user_log` (
  `id_log` int(11) NOT NULL,
  `ip_user` varchar(15) NOT NULL,
  `username` varchar(18) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_log`
--

INSERT INTO `user_log` (`id_log`, `ip_user`, `username`, `nama_user`, `role`, `log_time`) VALUES
(19, '::1', '345678901234567890', 'Ahmad Basir', 'guru', '2022-02-15 13:58:19'),
(20, '::1', '456789012345678901', 'Nicholas Thomas', 'guru', '2022-02-15 13:58:39'),
(21, '::1', '10901', 'Ahmad Fajar', 'siswa', '2022-02-17 04:23:50'),
(22, '::1', '10908', 'Albert Darwin', 'osis', '2022-02-17 04:24:55'),
(23, '::1', '123456789012345678', 'Ahmad Subarjo', 'guru', '2022-02-17 04:35:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru_pembina`
--
ALTER TABLE `guru_pembina`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `ket_pelanggaran`
--
ALTER TABLE `ket_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indeks untuk tabel `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`id_pelanggaran_siswa`),
  ADD KEY `id_pelanggar` (`id_pelanggar`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_pelanggaran1` (`id_pelanggaran1`),
  ADD KEY `id_pelanggaran2` (`id_pelanggaran2`),
  ADD KEY `id_pelanggaran3` (`id_pelanggaran3`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id_log`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru_pembina`
--
ALTER TABLE `guru_pembina`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ket_pelanggaran`
--
ALTER TABLE `ket_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id_pelanggaran_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
