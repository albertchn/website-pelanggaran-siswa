-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2022 pada 06.17
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
(1, 'Keterlambatan', 'Siswa terlambat 1 - 10 menit', 1, '2022-08-03 03:18:59'),
(2, 'Keterlambatan', 'Siswa terlambat di atas 10 menit', 2, '2022-08-03 03:19:10'),
(3, 'pakaian', 'Siswa mengenakan pakaian diluar ketentuan seragam sekolah', 1, '2022-02-23 00:47:39'),
(4, 'pakaian', 'Saat olahraga siswa mengenakan baju olahraga bukan seragam olahraga SMKN 12', 1, '2022-02-23 00:49:05'),
(5, 'pakaian', 'Siswa mengenakan sepatu bukan warna hitam polos sebagaimana telah ditentukan sekolah', 1, '2022-02-23 00:50:49'),
(6, 'pakaian', 'Siswa mengenakan pakaian yang seronok yang sangat bertentangan dengan norma, agama, etika dan sopan santun', 1, '2022-02-23 00:51:36'),
(7, 'upacara', 'Siswa tidak mengikuti upacara bendera tanpa keterangan, baik pada hari senin maupun hari besar/Nasional', 5, '2022-02-23 00:54:34'),
(8, 'upacara', 'Siswa terlambat mengikuti upacara', 1, '2022-02-23 00:55:10'),
(9, 'upacara', 'Siswa tidak mengenakan seragam lengkap sesuai ketentuan sekolah', 1, '2022-02-23 00:56:04'),
(10, 'upacara', 'Siswa tidak tertib mengikuti upacara (ngobrol, duduk-duduk, dll)', 1, '2022-02-23 00:56:42'),
(11, 'media elektronik', 'Mengaktifkan dan berkomunikasi baik SMS-an maupun telepon saat KBM berlangsung tanpa seijin guru dikelas / mata pelajaran', 5, '2022-02-23 00:59:22'),
(12, 'media elektronik', 'Mendengarkan lagu, pidato, ceramah, dll melalui media saat KBM berlangsung', 5, '2022-02-23 01:00:20'),
(13, 'aksesoris', 'Siswa memakai aksesoris yang berlebihan, seperti: anting di hidung dan di lidah', 10, '2022-02-23 01:02:12'),
(14, 'aksesoris', 'Menghiasi tubuh dengan tato', 10, '2022-02-23 01:02:44'),
(15, 'aksesoris', 'Mengecat kuku kaki dan tangan serta rambut', 3, '2022-02-23 01:03:03'),
(16, 'kehadiran', 'Siswa tidak hadir di sekolah tanpa keterangan 1x', 3, '2022-02-23 01:04:27'),
(17, 'kehadiran', 'Siswa tidak hadir di sekolah tanpa keterangan 2x', 5, '2022-02-23 01:04:57'),
(18, 'kehadiran', 'Siswa tidak hadir di sekolah tanpa keterangan 3x', 8, '2022-02-23 01:05:15'),
(19, 'kehadiran', 'Siswa meninggalkan KBM sebelum waktunya tanpa ijin guru mata pelajaran dari guru piket', 3, '2022-02-23 01:05:55'),
(20, 'kehadiran', 'Siswa berada di luar kelas tanpa ijin saat KBM', 3, '2022-02-23 01:06:23'),
(21, 'kehadiran', 'Siswa ijin keluar dari lingkungan sekolah tapi dengan mengendarai kendaraan bermotor', 3, '2022-02-23 01:07:02'),
(22, 'lingkungan sekolah', 'Siswa mengotori, mencoret-coret dan merusak sarana belajar di sekolah', 5, '2022-02-23 01:07:53'),
(23, 'lingkungan sekolah', 'Siswa membuang sampah bukan pada tempatnya di lingkungan sekolah', 3, '2022-02-23 01:08:20'),
(24, 'mencuri', 'Mengambil barang, benda atau uang bukan miliknya', 10, '2022-02-23 01:09:31'),
(25, 'mencuri', 'Mengambil barang, uang milik sekolah', 10, '2022-02-23 01:09:55'),
(26, 'mencuri', 'Mengambil barang atau uang milik bapak/ibu guru', 10, '2022-02-23 01:10:17'),
(27, 'mencuri', 'Mengambil uang dan barang milik teman di sekolah', 10, '2022-02-23 01:10:43'),
(28, 'merokok', 'Membawa rokok di lingkungan sekolah', 20, '2022-02-23 01:11:28'),
(29, 'merokok', 'Merokok di lingkungan sekolah', 30, '2022-02-23 01:11:48'),
(30, 'Pornografi', 'Membawa gambar, film, video yang bernuansa pornografi dan pornoaksi', 25, '2022-08-09 03:50:21'),
(31, 'pornografi', 'Membuka, menonton situs porno di sekolah', 30, '2022-02-23 01:13:08'),
(32, 'pornografi', 'Melakukan tindakan yang mengarah pornografi dan pornoaksi', 30, '2022-02-23 01:13:36'),
(33, 'pornografi', 'Berbuat asusila (pornografi) dan direkam serta disebarluaskan', 100, '2022-02-23 01:14:08'),
(34, 'senjata tajam', 'Membawa senjata tajam yang dapat mengancam keselamatan dirinya dan orang lain', 60, '2022-02-23 01:15:08'),
(35, 'perkelahian / tawuran', 'Tawuran dengan siswa sekolah lain di lingkungan sekolah', 100, '2022-02-23 01:15:49'),
(36, 'narkoba / miras', 'Membawa dan mengedarkan narkoba', 100, '2022-02-23 01:16:35'),
(37, 'nerkoba / miras', 'Mengkonsumsi narkoba', 100, '2022-02-23 01:16:57'),
(38, 'kepribadian', 'Melawan guru secara fisik', 100, '2022-02-23 01:17:15'),
(39, 'kepribadian', 'Melawan guru dengan kata-kata', 50, '2022-02-23 01:17:37'),
(40, 'kepribadian', 'Mencermakan nama baik guru', 50, '2022-02-23 01:17:58'),
(41, 'kepribadian', 'Mencemarkan nama baik sekolah', 50, '2022-02-23 01:18:25'),
(42, 'kepribadian', 'Siswa memalsukan tanda tangan kepala sekolah, guru, dan orang tua', 60, '2022-02-23 01:19:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ket_prestasi`
--

CREATE TABLE `ket_prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `det_prestasi` varchar(255) NOT NULL,
  `poin_prestasi` int(3) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ket_prestasi`
--

INSERT INTO `ket_prestasi` (`id_prestasi`, `det_prestasi`, `poin_prestasi`, `waktu_dibuat`) VALUES
(2, 'Juara Kelas 1-2-3', 10, '2022-08-08 04:28:42'),
(3, 'Juara Tingkat Wilayah JAKUT 1-2-3', 25, '2022-08-08 04:19:07'),
(4, 'Juara Tingkat Wilayah Provinsi DKI Jakarta 1-2-3', 50, '2022-08-08 04:19:33'),
(5, 'Juara Tingkat Nasional 1-2-3', 80, '2022-08-08 04:19:47'),
(6, 'Juara Tingkat Internasional', 100, '2022-08-08 04:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponen`
--

CREATE TABLE `komponen` (
  `id_komponen` int(11) NOT NULL,
  `nama_komponen` varchar(100) NOT NULL,
  `isi_komponen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `nama_komponen`, `isi_komponen`) VALUES
(1, 'login_carousel', 'jett.jpg,logo.jpg,sage.png,valorant-omen-4k-v9-1920x1080.jpg,viper-valorant-game-4k-cp-1920x1080.jpg'),
(2, 'foto_index', 'LOGO SMKN 12.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id_pelanggaran_siswa` int(11) NOT NULL,
  `id_pelanggar` int(11) NOT NULL,
  `id_pelapor` varchar(18) NOT NULL,
  `id_pelanggaran` varchar(50) NOT NULL,
  `poin_berkurang` int(11) NOT NULL,
  `waktu_pelanggaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `tgl_prestasi` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_siswa`
--

CREATE TABLE `prestasi_siswa` (
  `id_prestasi_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_prestasi` int(11) NOT NULL,
  `poin_bertambah` int(3) NOT NULL,
  `tgl_prestasi` date NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `waktu_pelaporan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `email`, `jmlh_poin`, `role`, `foto`, `password`, `created_at`) VALUES
(1, 3, 34, 10965, 'Albert Christian Darwin', 'albertdarwin@gmail.com', 100, 'admin', NULL, '10965', '2022-08-15 04:15:57');

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
(1, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-15 04:16:21');

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
-- Indeks untuk tabel `ket_prestasi`
--
ALTER TABLE `ket_prestasi`
  ADD PRIMARY KEY (`id_prestasi`);

--
-- Indeks untuk tabel `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`);

--
-- Indeks untuk tabel `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`id_pelanggaran_siswa`),
  ADD KEY `id_pelanggar` (`id_pelanggar`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_pelanggaran1` (`id_pelanggaran`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  ADD PRIMARY KEY (`id_prestasi_siswa`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_prestasi` (`id_prestasi`);

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
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `ket_prestasi`
--
ALTER TABLE `ket_prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id_pelanggaran_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  MODIFY `id_prestasi_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Ketidakleluasaan untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  ADD CONSTRAINT `prestasi_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `prestasi_siswa_ibfk_2` FOREIGN KEY (`id_prestasi`) REFERENCES `ket_prestasi` (`id_prestasi`);

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
