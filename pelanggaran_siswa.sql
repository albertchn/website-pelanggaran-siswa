-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2024 pada 09.26
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

--
-- Dumping data untuk tabel `guru_pembina`
--

INSERT INTO `guru_pembina` (`id_guru`, `nip`, `nama_guru`, `email`, `role`, `password`, `created_at`) VALUES
(2, '1977022022211002', 'Irwan Saputra', 'saputra.one@gmail.com', 'admin', '1977022022211002', '2022-08-19 08:23:24');

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
  `waktu_pelanggaran` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id_pelanggaran_siswa`, `id_pelanggar`, `id_pelapor`, `id_pelanggaran`, `poin_berkurang`, `waktu_pelanggaran`, `created_at`) VALUES
(9, 180, '10965', '2', 2, '2022-10-20', '2022-10-20 01:53:06'),
(10, 180, '10965', '9', 1, '2022-10-20', '2022-10-20 01:54:54'),
(11, 173, '10965', '1,3,11', 7, '2022-10-20', '2022-10-20 09:20:08'),
(12, 172, '10965', '1,3', 2, '2022-12-12', '2022-12-12 13:19:18'),
(13, 180, '10965', '8', 1, '2022-12-12', '2022-12-12 13:19:29'),
(14, 173, '10965', '1', 1, '2022-12-15', '2022-12-15 00:21:42'),
(15, 174, '10965', '3', 1, '2022-12-15', '2022-12-15 00:21:52'),
(16, 175, '10965', '4', 1, '2022-12-15', '2022-12-15 00:22:01'),
(17, 176, '10965', '9', 1, '2022-12-15', '2022-12-15 00:22:11'),
(18, 177, '10965', '3', 1, '2022-12-15', '2022-12-15 00:22:20'),
(19, 178, '10965', '17', 5, '2022-12-15', '2022-12-15 00:22:30'),
(20, 179, '10965', '11', 5, '2022-12-15', '2022-12-15 00:22:41'),
(21, 180, '10965', '28', 20, '2022-12-15', '2022-12-15 00:22:56'),
(22, 181, '10965', '36', 100, '2022-12-15', '2022-12-15 00:23:16'),
(23, 182, '10965', '9', 1, '2022-12-15', '2022-12-15 00:23:26'),
(24, 183, '10965', '2,4,10,11,14,11', 19, '2022-12-15', '2022-12-15 00:23:53'),
(25, 183, '10965', '1', 1, '2023-01-04', '2023-01-04 07:40:14');

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

--
-- Dumping data untuk tabel `prestasi_siswa`
--

INSERT INTO `prestasi_siswa` (`id_prestasi_siswa`, `id_siswa`, `id_prestasi`, `poin_bertambah`, `tgl_prestasi`, `bukti`, `waktu_pelaporan`) VALUES
(5, 173, 3, 25, '2022-08-30', '630d8e80c4093.pdf', '2022-08-30 04:13:52');

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
  `jmlh_poin` int(3) NOT NULL,
  `role` varchar(5) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `jmlh_poin`, `role`, `foto`, `password`, `created_at`) VALUES
(99, 3, 31, 10852, 'SISKA OKTAVIYAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(100, 3, 31, 10853, 'SITI NURHALISAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(101, 3, 31, 10854, 'TANIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(149, 3, 29, 10941, 'HANA SAFIRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(150, 3, 29, 10942, 'HILDA MUFTIHATUL AULIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(151, 3, 29, 10943, 'HILDA SALBILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(152, 3, 29, 10944, 'JAMIATUN HODIJAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(153, 3, 29, 10945, 'MELINDA RACHMAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(154, 3, 29, 10946, 'MIFTA KHULHUSNA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(155, 3, 29, 10947, 'MITA AULIA DINICA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(156, 3, 29, 11011, 'MUHAMMAD YUSUF MUNAWAR SADAT', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(157, 3, 29, 10948, 'NABILA MARDIANA S', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(158, 3, 29, 10949, 'NAILAH RAESYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(159, 3, 29, 10950, 'NATASYA STEVANI GABRIELLE TINENDENG', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(160, 3, 29, 10951, 'NAYRA PERMATA SADHIVA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(161, 3, 29, 10952, 'NILAM MUTIARA CAHAYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(162, 3, 29, 10953, 'NISA DWI JULIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(163, 3, 29, 10954, 'NURHALIZA OKTAVIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(164, 3, 29, 10955, 'RAFIDA TASYA ANANDADILA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(165, 3, 29, 10956, 'RAHMAWATI ALIPIA ZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(166, 3, 29, 10957, 'SEROJA PUTRI KARTIKA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(167, 3, 29, 10958, 'SUSANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(168, 3, 29, 10959, 'SYIFA AZZAHRA ALAM PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(169, 3, 29, 10960, 'TRI UTAMI YANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(170, 3, 29, 10961, 'ULWA YULIA HAFSOH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(171, 3, 29, 10962, 'VANIA PUTRI KHAIRUNISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(172, 3, 34, 10964, 'AKHIRA KUSUMASTUTI', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(173, 3, 34, 10965, 'ALBERT CHRISTIAN DARWIN', 100, 'admin', '630da8139d5af.jpeg', 'albert', '2024-04-03 07:19:42'),
(174, 3, 34, 10966, 'ALVARO MUYASSAR', 100, 'siswa', '', '10966', '2024-04-03 07:19:42'),
(175, 3, 34, 10968, 'ANDRYAN SAPUTRA', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(176, 3, 34, 11258, 'ARDI PRATOMO', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(177, 3, 34, 10969, 'ARIF AMMAR SYA`BANI', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(178, 3, 34, 10970, 'BAYU PERMANA', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(179, 3, 34, 10971, 'DAFA MAULANA', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(180, 3, 34, 10972, 'DAVID SAM LIMBONG', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(181, 3, 34, 10973, 'DENNIS MONTERO PANKRATOV', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(182, 3, 34, 10974, 'EKKY FEBRIAN', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(183, 3, 34, 10975, 'FACHRI PRATAMA SUNARTO', 100, 'siswa', '', '123456', '2024-04-03 07:19:42'),
(184, 3, 34, 10976, 'FAJRI ABABIL PAWA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(185, 3, 34, 10977, 'GALLIANO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(186, 3, 34, 10979, 'KHAYLIA PUSPITA ANJANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(187, 3, 34, 10980, 'KIRAN SHABRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(188, 3, 34, 10981, 'MOCHAMMAD FARHAN ARYASUTA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(189, 3, 34, 10982, 'MUHAMMAD ARYA FAIQ', 100, 'osis', '', '123456', '2022-09-12 05:21:21'),
(190, 3, 34, 10983, 'MUHAMMAD GIFFARY', 100, 'siswa', '', '123456', '2022-08-30 03:57:22'),
(191, 3, 34, 10985, 'MUHAMMAD RIZAL ANDITAMA NUGRAHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(192, 3, 34, 10987, 'MUKHAMMAD MAULANA M IBRAHIM', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(193, 3, 34, 10988, 'NAJLA DAMAYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(194, 3, 34, 10990, 'REKHA SAFIRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(195, 3, 34, 10991, 'RIFKI AKBAR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(196, 3, 34, 10992, 'SALISHA SAFA NIKMAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(197, 3, 34, 10993, 'SANDI PERMANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(198, 3, 34, 10996, 'YAKOBUS ARDOTA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(199, 3, 34, 10997, 'ZAHRA NASYWA ZAIN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(200, 3, 34, 10998, 'ZIKRA FADLILAH ALDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(201, 2, 13, 11012, 'ABDUL RAHMAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(202, 2, 13, 11013, 'ALFIA NABILA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(203, 2, 13, 11014, 'ANDREA TEVY LITUHAYU LAMA DUA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(204, 2, 13, 11015, 'ARTA GABRIELA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(205, 2, 13, 10750, 'BUNGA DAMAYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(206, 2, 13, 11016, 'CHELSEA OLIVIA SINURAT', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(207, 2, 13, 11017, 'DESTA TRI ANDINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(208, 2, 13, 11018, 'DWI NOVIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(209, 2, 13, 11019, 'ELZA TRI WAHYUNI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(210, 2, 13, 11020, 'FATIMAH AZZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(211, 2, 13, 11021, 'FITRI AULIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(212, 2, 13, 11022, 'FITRI AYU SABILA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(213, 2, 13, 11260, 'HESTI HERAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(214, 2, 13, 11023, 'KURROTUL AINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(215, 2, 13, 11024, 'LIA FEBRI YANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(216, 2, 13, 11025, 'M. ABFATHIR AMARUDIN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(217, 2, 13, 11026, 'MAYZA NUSA BILLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(218, 2, 13, 11027, 'MINARTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(219, 2, 13, 11028, 'NABILA ZEINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(220, 2, 13, 11029, 'NAFRA FAUZIAH AMANDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(221, 2, 13, 10808, 'NAJMAH RATU AULYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(222, 2, 13, 11030, 'NAZWATU RAHMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(223, 2, 13, 11031, 'NILAM SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(224, 2, 13, 11032, 'NUR AINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(225, 2, 13, 11033, 'OKTAVIARA PRIYALINGGA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(226, 2, 13, 11034, 'RISMAH DWI UTAMI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(227, 2, 13, 11261, 'ROHMAT AL QODRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(228, 2, 13, 11035, 'ROSITA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(229, 2, 13, 11036, 'SARI AFRILIAN PUTRIE ARDIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(230, 2, 13, 11037, 'SELLA APRILLIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(231, 2, 13, 11038, 'SHERLY ULIANTY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(232, 2, 13, 11039, 'SINTIA SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(233, 2, 13, 11041, 'SUSI INDRAYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(234, 2, 13, 11042, 'TAZKIA FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(235, 2, 13, 11043, 'VINA NATASHA LESTARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(236, 2, 13, 11044, 'VITA AMELIA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(237, 2, 14, 11046, 'AISYAH ANANDA TRI AMALIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(238, 2, 14, 11047, 'ALYA ERIKA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(239, 2, 14, 11048, 'ANNISAH AZZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(240, 2, 14, 11049, 'CAMELIA RIPAHMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(241, 2, 14, 11050, 'DEA ANANDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(242, 2, 14, 11051, 'DIRA FEBRIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(243, 2, 14, 11052, 'DWI UTIYA RESTUHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(244, 2, 14, 11053, 'FADHILAH NUR RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(245, 2, 14, 11054, 'FEBRYANA ZUMAL', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(246, 2, 14, 11055, 'FITRI AYU NINGRUM', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(247, 2, 14, 11056, 'HANIFAH ADAWIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(248, 2, 14, 11057, 'LARISSA AKILAH FEBRIANE', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(249, 2, 14, 11058, 'LIDYA EKA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(250, 2, 14, 11059, 'MAURIZKIANI PUTRI AZ-ZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(251, 2, 14, 11060, 'MEYLANI PUTRI ALIANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(252, 2, 14, 11061, 'MUTHIA CHAERUNNISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(253, 2, 14, 11062, 'NADILLA ANANDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(254, 2, 14, 11063, 'NAZWA KEISYA MAULIDI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(255, 2, 14, 11064, 'NEISYA AULIA FAJARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(256, 2, 14, 11065, 'NOVA NURLITA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(257, 2, 14, 11066, 'NURJIHAN AULIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(258, 2, 14, 11262, 'NURUL MUSLIMAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(259, 2, 14, 11067, 'RAFLI RIDWANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(260, 2, 14, 11068, 'ROBIATUL ADAWIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(261, 2, 14, 11070, 'SARI FATMAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(262, 2, 14, 11071, 'SHAKIRA NOVIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(263, 2, 14, 11072, 'SIFA LAILIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(264, 2, 14, 11073, 'SITI AISYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(265, 2, 14, 11074, 'SONI ARDIANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(266, 2, 14, 11075, 'SYIFA AULIA AZZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(267, 2, 14, 11076, 'THAHARA SAFITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(268, 2, 14, 11077, 'VIRLIANA SALSABILA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(269, 2, 14, 11078, 'WIKANTI KROIS', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(270, 2, 14, 11079, 'ZAHRA RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(271, 2, 19, 11337, 'ADELIA PUTRI LESTARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(272, 2, 19, 11338, 'AKSIYAH ASY SYAMIATUZ ZAHRAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(273, 2, 19, 11339, 'ARDIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(274, 2, 19, 11340, 'AUDIAH ZABRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(275, 2, 19, 11341, 'CYNARA ARISTAWIDYA RIADY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(276, 2, 19, 11342, 'DAHNIAR PARAMITHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(277, 2, 19, 11343, 'DENI SANTO SATOINONG', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(278, 2, 19, 11344, 'DESTY PRAYATMAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(279, 2, 19, 11345, 'DEVALLY OCTAVIALLY VENEZUELLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(280, 2, 19, 11346, 'DIDAN AHMAD', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(281, 2, 19, 11347, 'DWI SEKAR LISTIYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(282, 2, 19, 11348, 'FIRA APRILIA VISTA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(283, 2, 19, 11349, 'FITRI WULANDARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(284, 2, 19, 11350, 'HERDIANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(285, 2, 19, 11351, 'KARLA CINTA PUTRI OCKTAVIAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(286, 2, 19, 11352, 'KURNIASIH HIDAYAT', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(287, 2, 19, 11353, 'LATIFAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(288, 2, 19, 11354, 'MARSYA ALICYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(289, 2, 19, 11355, 'MARSYA ZHAFIRAH LIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(290, 2, 19, 11356, 'NABILA KIRANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(291, 2, 19, 11357, 'NA\'ILAH RAISSA SAHDA EFENDI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(292, 2, 19, 11358, 'NATHANAEL OKTAVIANUS LIMAN PUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(293, 2, 19, 11359, 'NUR MAYLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(294, 2, 19, 11360, 'RABIATUL ADAWIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(295, 2, 19, 11361, 'RAHMA DINA ALGHIFARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(296, 2, 19, 11362, 'REVA NUR FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(297, 2, 19, 11363, 'RISCHA NUR SAFANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(298, 2, 19, 11364, 'RIZTY YULIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(299, 2, 19, 11365, 'SABRIL DIMAS SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(300, 2, 19, 11366, 'SALWA PUTRI RAMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(301, 2, 19, 11367, 'SHABRINA MULYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(302, 2, 19, 11368, 'SHAKILA NAYRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(303, 2, 19, 11369, 'SITI IGYA SETIANINGRUM', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(304, 2, 19, 11370, 'SUCI KHAERUNNISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(305, 2, 19, 11371, 'VERONICA INRI APRILIANI SIAHAAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(306, 2, 19, 11372, 'WINNA AMELIA SAFITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(307, 2, 16, 11116, 'AISYAH DAMAR WULAN SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(308, 2, 16, 11117, 'ALYA PUTRI UTAMI ', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(309, 2, 16, 11118, 'ANGELEXA GRACE YOHANA PUTERI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(310, 2, 16, 11120, 'BUNGA INDAH LESTARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(311, 2, 16, 11121, 'CAHYA REVICHA ABSHARINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(312, 2, 16, 11122, 'CHINTYA RAMDHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(313, 2, 16, 11123, 'DA,WATUL JANAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(314, 2, 16, 11124, 'DEA ANNISA AZZHARA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(315, 2, 16, 11125, 'EGIDIA ENDHITA LESTARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(316, 2, 16, 11126, 'GHALUH DIAN RATNA ARIMBI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(317, 2, 16, 11127, 'INDAH FEBIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(318, 2, 16, 11128, 'INDRI LESTIA SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(319, 2, 16, 11129, 'ISNAENI PUTRI KURNIAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(320, 2, 16, 11130, 'KARTIKA RUSDIANTO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(321, 2, 16, 11131, 'KIKI RACHMAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(322, 2, 16, 11132, 'MEGA THERESIA NARWADAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(323, 2, 16, 11133, 'MULYA PRASTYA DEWI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(324, 2, 16, 11134, 'NAILA FATASYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(325, 2, 16, 11135, 'NOVA ADELIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(326, 2, 16, 11136, 'NOVAL ADITYA PUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(327, 2, 16, 11139, 'PUTRI ANJANI JULLY HARCO CHANIAGO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(328, 2, 16, 11140, 'RAKHA NURVIKRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(329, 2, 16, 11008, 'RINJANI PURNAMA PUTRI ', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(330, 2, 16, 11141, 'RIYAN ASAY ROZI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(331, 2, 16, 11142, 'SALWA NISRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(332, 2, 16, 11143, 'SEPTIA NUR HALIZA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(333, 2, 16, 11144, 'SHASI KIRANA MATAHARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(334, 2, 16, 11145, 'SITI MUSAFA\'AH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(335, 2, 16, 11146, 'SUNETA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(336, 2, 16, 11147, 'TIARA RAHMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(337, 2, 16, 11148, 'VANIA SYAHIRAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(338, 2, 16, 11149, 'WELMA ANGELINA HOBBERTIN TENTUA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(339, 2, 16, 11150, 'ZEN FIO LIKCA TINDAON', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(340, 2, 17, 11152, 'AMELISA SUTOMO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(341, 2, 17, 11153, 'APRILIYA ANGGRAENI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(342, 2, 17, 11154, 'AZZAHARA MEITRI WULANDARI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(343, 2, 17, 11155, 'BUNGA PUTRI RAMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(344, 2, 17, 11156, 'CHARLEENA SYAFITRY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(345, 2, 17, 11157, 'CINDY AGUSTIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(346, 2, 17, 11159, 'DYAH MENUR NILAM SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(347, 2, 17, 11160, 'ERMIKA SALSABILLA FEBYANA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(348, 2, 17, 11264, 'GEVIRA NUR FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(349, 2, 17, 11161, 'ICHA NUR ALMALITHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(350, 2, 17, 11162, 'INDI RAHMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(351, 2, 17, 11163, 'IRMA NUR AULIYANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(352, 2, 17, 11164, 'JOANA DWI SHABILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(353, 2, 17, 11165, 'KHOLILLAH FAHIRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(354, 2, 17, 11166, 'LILIS SUDIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(355, 2, 17, 11167, 'MUHAMMAD RASYA FAJAR SIREGAR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(356, 2, 17, 11168, 'NADYA SABRINA AZ-ZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(357, 2, 17, 11169, 'NAYLA NAZWA SAFITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(358, 2, 17, 11170, 'NOVA AULIA SETYAWAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(359, 2, 17, 11171, 'NOVIANA LIESA RAHMAWATI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(360, 2, 17, 11172, 'NURKHOLIFAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(361, 2, 17, 11173, 'PRIHARTINI MULYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(362, 2, 17, 11174, 'RACHEL JESSICA PANDY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(363, 2, 17, 11175, 'RIMAZA FITRIYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(364, 2, 17, 10922, 'SALSABILA SABRINA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(365, 2, 17, 11177, 'SEPTIA NUR AMANAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(366, 2, 17, 11178, 'SEPTIA NURUL FATWAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(367, 2, 17, 11179, 'SHELA DWI HALIZAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(368, 2, 17, 11180, 'SITI RAHMA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(369, 2, 17, 11181, 'TAMALA FEBRIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(370, 2, 17, 10925, 'TIEFANNY', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(371, 2, 17, 11182, 'TRI WAHYUNI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(372, 2, 17, 11183, 'VINA NOPIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(373, 2, 17, 11184, 'ZAHRA AYU NISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(374, 2, 22, 11185, 'ADILAH JUNIARTO', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(375, 2, 22, 11186, 'AHMAD FAJAR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(376, 2, 22, 11187, 'ALEXA BIANCA PRISCILLA MALUEGHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(377, 2, 22, 11188, 'ANANDA SHAFITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(378, 2, 22, 11189, 'ANGGA DWI RHAMDANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(379, 2, 22, 11190, 'DAFFA ADITYA PUTRA ELLYAS', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(380, 2, 22, 11191, 'DAVINA AMELIA YUNITA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(381, 2, 22, 11192, 'FADLI ROHMAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(382, 2, 22, 11193, 'FARELIA ANANDA RIYANTO', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(383, 2, 22, 11265, 'FARID ABIDIN TRIPAMUNGKAS', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(384, 2, 22, 11194, 'FIKI NUR AFRIZA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(385, 2, 22, 11195, 'FITRA RISYA NAYSHILA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(386, 2, 22, 11196, 'IHSAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(387, 2, 22, 11197, 'JASMINE PUTRI SUGIANTO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(388, 2, 22, 11198, 'LUTFIATUL AULIA FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(389, 2, 22, 11199, 'MUHAMAD ARFIAN SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(390, 2, 22, 1266, 'MUHAMMAD FADHIL NAIM', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(391, 2, 22, 11200, 'MUHAMMAD YUDHA ADITYA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(392, 2, 22, 11201, 'NADYNE LOURENSIA SAEBRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(393, 2, 22, 11202, 'NURFITRI DESI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(394, 2, 22, 10989, 'PATAR IMMANUEL MANALU', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(395, 2, 22, 11203, 'PUTRA SETYONUGROHO', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(396, 2, 22, 11204, 'RAFITO JUAN SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(397, 2, 22, 11205, 'RAYLA THORIQ HAFUZA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(398, 2, 22, 11206, 'REVIN AJHAR FALAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(399, 2, 22, 11207, 'RIO VALDY HERMANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(400, 2, 22, 11208, 'RISKI DARMAWAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(401, 2, 22, 11209, 'RIZKY DHANI AGUSTIAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(402, 2, 22, 11210, 'SEPTI MUTIARA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(403, 2, 22, 11211, 'SHIFA ALIYA ROZAK', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(404, 2, 22, 11212, 'SUHENI AULIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(405, 2, 22, 11213, 'SYAIFUL FARHAN HANIF', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(406, 2, 22, 11214, 'TANOEJAYA SAMI AKBAR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(407, 2, 22, 11215, 'YATI KURNIAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(408, 2, 22, 11216, 'ZAHWA AMELIA PUTRI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(409, 2, 22, 11217, 'ZASKIA FEBRIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(410, 2, 23, 10963, 'ABDUL MAJID', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(411, 2, 23, 11218, 'AGUS MOLANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(412, 2, 23, 11219, 'AKHMAD KARIM', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(413, 2, 23, 11220, 'ALPINE VALENTINO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(414, 2, 23, 11221, 'ANANDA WIDYA MAHARANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(415, 2, 23, 11222, 'BAGUS LIR ANGGA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(416, 2, 23, 11223, 'DAMAYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(417, 2, 23, 11224, 'DHANYL AKHMAD SYAFAREL', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(418, 2, 23, 11225, 'FAHIRA PUTRI ANANTA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(419, 2, 23, 11226, 'FAUZAN AKBAR WIJAYA ', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(420, 2, 23, 11227, 'FIRMANSYAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(421, 2, 23, 11228, 'FITRIA ANISA FADILA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(422, 2, 23, 11229, 'INDAH SEFTYANY', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(423, 2, 23, 11230, 'JIHAN AULIA TAHIR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(424, 2, 23, 11231, 'MOHAMMAD ABDILLAH MUKTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(425, 2, 23, 11232, 'MUHAMMAD ALDI TRI SETIAWAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(426, 2, 23, 10984, 'MUHAMMAD NUR ILHAM', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(427, 2, 23, 11233, 'NABILAYULVANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(428, 2, 23, 11234, 'NATASYA MONICA FEBIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(429, 2, 23, 11235, 'PRIANA RAMADANTI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(430, 2, 23, 11236, 'RADIT YUSUF RAHMATILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(431, 2, 23, 11237, 'RATU AYU AULIA MUDZHIRIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(432, 2, 23, 11238, 'RENATA CHRISTY KALENGKONGAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(433, 2, 23, 11239, 'RIDWAN RIZKY RAMADHAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(434, 2, 23, 11240, 'RIRIS DESTIARA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(435, 2, 23, 11241, 'RIVANI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(436, 2, 23, 11242, 'SANIA RISWALA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(437, 2, 23, 11243, 'SEVITA RAHMA AULIA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(438, 2, 23, 11244, 'SITI NUR HIKMAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(439, 2, 23, 11267, 'SULTAN ANWAR', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(440, 2, 23, 10995, 'SUNARGI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(441, 2, 23, 11245, 'SYAFA SALSABIELAH SUSANTO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(442, 2, 23, 11246, 'SYIFA RASYA DAMERA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(443, 2, 23, 11247, 'TRI MUNARSIH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(444, 2, 23, 11248, 'ZAHRA NUR FADILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(445, 2, 23, 11249, 'ZASKIA ADAWIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(446, 1, 1, 11268, 'ADHWA DZAKIYAH SULAIMAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(447, 1, 1, 11269, 'ALICIA ANGELINE SURYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(448, 1, 1, 11270, 'ALYA NAZHIFAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(449, 1, 1, 11271, 'AMELIA HERMAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(450, 1, 1, 11272, 'ANGGUN PERMATASARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(451, 1, 1, 11273, 'ANINDYA KAIRA ALUNA', 100, 'siswa', '', '123456', '2022-08-30 04:11:36'),
(452, 1, 1, 11274, 'BELLA OKTAVIANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(453, 1, 1, 11275, 'CALISTA SALSABILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(454, 1, 1, 11276, 'CHELSEA SULISTIAWATI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(455, 1, 1, 11277, 'DAVINA HALAIDAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(456, 1, 1, 11278, 'DINA SABRINA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(457, 1, 1, 11279, 'DIVA OKTARIA VANDES', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(458, 1, 1, 11280, 'FIRLY SABILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(459, 1, 1, 11281, 'GHINA USWAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(460, 1, 1, 11282, 'LARAS AYU', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(461, 1, 1, 11283, 'MARNALISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(462, 1, 1, 11284, 'NADINE KIRANIA NUR FAUZIAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(463, 1, 1, 11285, 'NATHASYA SALSYABILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(464, 1, 1, 11286, 'NOVIANI RISMAYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(465, 1, 1, 11287, 'PUTRI DESI ANGRAINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(466, 1, 1, 11288, 'QUEENA TIARA KHAIRIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(467, 1, 1, 11289, 'RAHMA NASIFA PUTRI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(468, 1, 1, 11290, 'RAMEYZA NUR HIKMAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(469, 1, 1, 11291, 'RASYA NAJLA FAUZIYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(470, 1, 1, 11292, 'SALMA KHAIRUL NISSA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(471, 1, 1, 11293, 'SALWA ALYA FIRJANNAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(472, 1, 1, 11263, 'SELVIANA PUTRI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(473, 1, 1, 11294, 'SILVIANA EVANI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(474, 1, 1, 11295, 'SITI KHOIRUNNISA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(475, 1, 1, 11296, 'SITI SARAH HOERUNISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(476, 1, 1, 11297, 'SOFIA NUR LUTFIAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(477, 1, 1, 11298, 'TANTRI SUKMA PRATIWI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(478, 1, 1, 11299, 'TIARA ADINDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(479, 1, 1, 11300, 'TIYA ARIYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(480, 1, 1, 11301, 'WULAN SARI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(481, 1, 1, 11302, 'ZULVAN AL- FARISYI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(482, 1, 2, 11303, 'AATHIRAH NISRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(483, 1, 2, 11304, 'AISAH NUR FAHRIYANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(484, 1, 2, 11305, 'AISYAH FEBRIANTY', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(485, 1, 2, 11306, 'CHELSEA KAYLA ILMANDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(486, 1, 2, 11307, 'DEA AGUSTINA BUITBISI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(487, 1, 2, 11308, 'DEA ARISKA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(488, 1, 2, 11309, 'DEDE PUTRA SETIAWAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(489, 1, 2, 11310, 'DESVITA ADISKA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(490, 1, 2, 11311, 'DHEA ANANDA KARTINI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(491, 1, 2, 11312, 'DINI RODIANA AGUSTIN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(492, 1, 2, 11313, 'EKA RAHAYU PRASETIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(493, 1, 2, 11314, 'ELIA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(494, 1, 2, 11315, 'ERLISYA NAVISHA ROSYID', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(495, 1, 2, 11316, 'FIRMAN MAULANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(496, 1, 2, 11317, 'GIYANTI RAMADHANI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(497, 1, 2, 11318, 'HALIMAH DWI ANGGRAENI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(498, 1, 2, 11319, 'ISABELL LOUISYE', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(499, 1, 2, 11320, 'ISHMAH SUCI RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(500, 1, 2, 11321, 'IVA LATIFAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(501, 1, 2, 11322, 'KHOILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(502, 1, 2, 11323, 'MARSYAHLA AZZAHIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(503, 1, 2, 11324, 'MUHAMMAD NABIL AYRIEL MUSTOFA P.', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(504, 1, 2, 11325, 'NADIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(505, 1, 2, 11326, 'NADILA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(506, 1, 2, 11327, 'NAFISA HASNA AZZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(507, 1, 2, 11328, 'NAZWA MAULIDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(508, 1, 2, 11329, 'NESSY PRADITA RINJANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(509, 1, 2, 11330, 'NOVI KURNIAWAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(510, 1, 2, 11331, 'NUR AISYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(511, 1, 2, 11332, 'NUR LAILA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(512, 1, 2, 11333, 'RAAJWA INTAN ZAAHIRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(513, 1, 2, 11334, 'SALSA CAHYANI PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(514, 1, 2, 11069, 'SANIA MEIDINA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(515, 1, 2, 11335, 'TIARA NURFADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(516, 1, 2, 11336, 'ZASKIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(517, 1, 7, 11337, 'ADELIA PUTRI LESTARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(518, 1, 7, 11338, 'AKSIYAH ASY SYAMIATUZ ZAHRAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(519, 1, 7, 11339, 'ARDIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(520, 1, 7, 11340, 'AUDIAH ZABRINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(521, 1, 7, 11341, 'CYNARA ARISTAWIDYA RIADY', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(522, 1, 7, 11342, 'DAHNIAR PARAMITHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(523, 1, 7, 11343, 'DENI SANTO SATOINONG', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(524, 1, 7, 11344, 'DESTY PRAYATMAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(525, 1, 7, 11345, 'DEVALLY OCTAVIALLY VENEZUELLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(526, 1, 7, 11346, 'DIDAN AHMAD', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(527, 1, 7, 11347, 'DWI SEKAR LISTIYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(528, 1, 7, 11348, 'FIRA APRILIA VISTA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(529, 1, 7, 11349, 'FITRI WULANDARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(530, 1, 7, 11350, 'HERDIANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(531, 1, 7, 11351, 'KARLA CINTA PUTRI OCKTAVIAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(532, 1, 7, 11352, 'KURNIASIH HIDAYAT', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(533, 1, 7, 11353, 'LATIFAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(534, 1, 7, 11354, 'MARSYA ALICYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(535, 1, 7, 11355, 'MARSYA ZHAFIRAH LIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(536, 1, 7, 11356, 'NABILA KIRANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(537, 1, 7, 11357, 'NA\'ILAH RAISSA SAHDA EFENDI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(538, 1, 7, 11358, 'NATHANAEL OKTAVIANUS LIMAN PUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(539, 1, 7, 11359, 'NUR MAYLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(540, 1, 7, 11360, 'RABIATUL ADAWIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(541, 1, 7, 11361, 'RAHMA DINA ALGHIFARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(542, 1, 7, 11362, 'REVA NUR FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(543, 1, 7, 11363, 'RISCHA NUR SAFANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(544, 1, 7, 11364, 'RIZTY YULIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(545, 1, 7, 11365, 'SABRIL DIMAS SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(546, 1, 7, 11366, 'SALWA PUTRI RAMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(547, 1, 7, 11367, 'SHABRINA MULYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(548, 1, 7, 11368, 'SHAKILA NAYRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(549, 1, 7, 11369, 'SITI IGYA SETIANINGRUM', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(550, 1, 7, 11370, 'SUCI KHAERUNNISA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(551, 1, 7, 11371, 'VERONICA INRI APRILIANI SIAHAAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(552, 1, 7, 11372, 'WINNA AMELIA SAFITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(553, 1, 4, 11373, 'ADHE NOVYANI PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(554, 1, 4, 11374, 'ALBANI RAY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(555, 1, 4, 11375, 'ALLYA KHARISMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(556, 1, 4, 11376, 'AMELLIA AZZAHRA KELANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(557, 1, 4, 11377, 'ANDIRA VERNANDA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(558, 1, 4, 11378, 'ANNISA RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(559, 1, 4, 11119, 'AVRILLIA PRASETYA SARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(560, 1, 4, 11379, 'AZAHRA AULIA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(561, 1, 4, 11380, 'BUNGA SABILLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(562, 1, 4, 11381, 'CAILA BIANCA YUSUF', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(563, 1, 4, 11382, 'CAMELIA MAULANA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(564, 1, 4, 11383, 'CESYARE MALDINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(565, 1, 4, 11384, 'CUT ERSA REVALINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(566, 1, 4, 11385, 'DESINTA DEWI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(567, 1, 4, 11386, 'ELYSA RAHMA DANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(568, 1, 4, 11387, 'FARIDA ANZANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(569, 1, 4, 11388, 'FAUZAN AL SHIDDIQOH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(570, 1, 4, 11389, 'FEBBY AURELIA BADOA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(571, 1, 4, 11390, 'GADIS NALINDRA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(572, 1, 4, 11391, 'INA SARINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(573, 1, 4, 11392, 'LORENCA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(574, 1, 4, 11393, 'LUNA PUTRI AUDINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(575, 1, 4, 11394, 'MUHAMMAD ZIDANE FAHREZY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(576, 1, 4, 11395, 'NADIA MULYA ARTANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(577, 1, 4, 11396, 'NATASYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(578, 1, 4, 11397, 'NENTI FADIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(579, 1, 4, 11398, 'NUR BELI ASMIRANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(580, 1, 4, 11399, 'PUTRI ZASKIA RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(581, 1, 4, 11400, 'RAYHAN RAMADAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(582, 1, 4, 11401, 'SHIDQIYYAH NADINA KASYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(583, 1, 4, 11402, 'SITI HADIJAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(584, 1, 4, 11403, 'TANIA MEGA PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(585, 1, 4, 11404, 'VIERA AVIA SORAYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(586, 1, 4, 11405, 'WILLY VERGIAWAN ARFARY', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(587, 1, 4, 11406, 'ZAHRA AZIZAH RAHMAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(588, 1, 4, 11407, 'ZAHWA AMANDA AULIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(589, 1, 5, 11408, 'ALIFIA ZAHWA DIAH ASTUTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(590, 1, 5, 11409, 'ANGGRAENI PUTRI IMAS', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(591, 1, 5, 11410, 'ANYNDIAH IRWANDARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(592, 1, 5, 11153, 'APRILIYA ANGGRAENI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(593, 1, 5, 11411, 'ATIKAH TRI HAPSARI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(594, 1, 5, 11412, 'DANEZZA QUEENSYA AGISQI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(595, 1, 5, 11413, 'DELVI YULIANTI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(596, 1, 5, 11414, 'DEVINA ANNATASYA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(597, 1, 5, 11415, 'DINDA RAMADANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(598, 1, 5, 11416, 'EKA SAFITRI PUTRI RAHARJO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(599, 1, 5, 11417, 'ELSYA FIRANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(600, 1, 5, 11418, 'ERICCA NADYA PRISKILA TINDAON', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(601, 1, 5, 11419, 'FARHAN FADILAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(602, 1, 5, 11420, 'IQBAL SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(603, 1, 5, 11421, 'JINGGA KAILA CYMA NATHA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(604, 1, 5, 11422, 'KARINA CAHYANI PUTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(605, 1, 5, 11423, 'KAROEL RAKA ZETH PALENTENG', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(606, 1, 5, 11424, 'KHATERINA SUSANA TOLOK', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(607, 1, 5, 11425, 'NADIA NAILATUL IZZAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(608, 1, 5, 11426, 'NAILA AMALIA AHMAD', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(609, 1, 5, 11427, 'NAILA TSANIYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(610, 1, 5, 11428, 'NASYIFA DYAH WIGUNA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(611, 1, 5, 11429, 'NASYWA ATHIYYAH AUFA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(612, 1, 5, 11430, 'NASYWA SYAKIRAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(613, 1, 5, 11431, 'NUR AINI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(614, 1, 5, 11432, 'PASYA FIRMANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(615, 1, 5, 11433, 'RAIHAN FAJRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(616, 1, 5, 11434, 'RETA PAULINA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(617, 1, 5, 11435, 'SALIMATU SYA\'DIAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(618, 1, 5, 11436, 'SALMAN AL FARIZI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(619, 1, 5, 11437, 'SALSABILA SHALFANA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(620, 1, 5, 11438, 'SALWA FAIZAH ASSYIFA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(621, 1, 5, 11439, 'SELA CAHYANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(622, 1, 5, 11440, 'VINA NAILATUL ALWI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(623, 1, 5, 11441, 'WILDATUL HANUN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(624, 1, 5, 11442, 'ZAHRA SHABIRAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(625, 1, 10, 11443, 'AHMAD', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(626, 1, 10, 11444, 'AHMAD HASBI HASIDIKI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(627, 1, 10, 11445, 'AHMAD SOPPIAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(628, 1, 10, 11446, 'AKHDAN NAUFAL SYAHPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(629, 1, 10, 11447, 'ALIF ADYTIA RAENATA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(630, 1, 10, 11448, 'ANDREANUS SONDIKA BUTAR-BUTAR', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(631, 1, 10, 11449, 'ASWAN MAULA AMANULLAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(632, 1, 10, 11450, 'AZKA AULIARAHMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(633, 1, 10, 11451, 'BALQIS NABILLA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(634, 1, 10, 11452, 'DESTIAWAN SAPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(635, 1, 10, 11453, 'DIMAS ALIF ARDIANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(636, 1, 10, 11454, 'EKA NIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(637, 1, 10, 11455, 'EVELLYNE AZZAHRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(638, 1, 10, 11456, 'GALIH ARAFAT ADIPUTRA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(639, 1, 10, 11457, 'HARRIS PRATAMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(640, 1, 10, 11458, 'KANIA SARASWATI SUMANTRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(641, 1, 10, 11459, 'LICHA JULIANTO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(642, 1, 10, 11460, 'MARIA LOISHA FERNANDA MAJA SAWU', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(643, 1, 10, 11461, 'MUHAMAD REFI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(644, 1, 10, 11462, 'MUHAMMAD HABIBULLAH MURSALIN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(645, 1, 10, 11463, 'MUHAMMAD KA\'ANDRI', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(646, 1, 10, 11464, 'MUHAMMAD RIFKI JULIANTO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(647, 1, 10, 11465, 'MUHAMMAD ZILDJIAN EKO RAMADHANI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(648, 1, 10, 11466, 'NALITA AUDIA FITRI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(649, 1, 10, 11467, 'NATASYA DIAH PALUPI', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(650, 1, 10, 11468, 'NAUFAL FEBRIANSYAH', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(651, 1, 10, 11469, 'NICO YUSUF SULISTYO', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(652, 1, 10, 11470, 'REFAH DIAS KURNIAWAN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(653, 1, 10, 11471, 'RIDWAN INGRATUBUN', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(654, 1, 10, 11472, 'ROBIN MAINDRA', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(655, 1, 10, 11473, 'SEVILLA MAYSAH SALPIA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(656, 1, 10, 11474, 'SHANDIKA PRATAMA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(657, 1, 10, 11475, 'VIVIA ZERLINDAH', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(658, 1, 10, 11476, 'WILDAN', 100, 'siswa', '', '123456', '2022-08-30 03:55:57'),
(659, 1, 10, 11477, 'ZASKIA SIVA AYURA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00'),
(660, 1, 10, 11478, 'ZIDANE ATHALLAH WINATA', 100, 'siswa', '', '123456', '0000-00-00 00:00:00');

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
(1, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-15 04:16:21'),
(2, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-16 00:22:53'),
(3, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-16 00:41:11'),
(4, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-16 00:42:35'),
(5, '::1', '10965', 'Albert Christian Darwin', 'admin', '2022-08-18 02:52:25'),
(6, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-19 01:49:16'),
(7, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-19 08:08:48'),
(8, '::1', '1977022022211002', 'Irwan Saputra', 'admin', '2022-08-19 08:24:00'),
(9, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-19 08:27:07'),
(10, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-22 23:50:49'),
(11, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-22 23:51:38'),
(12, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-29 03:42:08'),
(13, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-29 05:26:07'),
(14, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-30 03:30:37'),
(15, '::1', '10966', 'ALVARO MUYASSAR', 'siswa', '2022-08-30 05:28:50'),
(16, '::1', '10966', 'ALVARO MUYASSAR', 'siswa', '2022-08-30 05:37:23'),
(17, '::1', '10966', 'ALVARO MUYASSAR', 'siswa', '2022-08-30 05:46:58'),
(18, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-30 05:47:24'),
(19, '::1', '10966', 'ALVARO MUYASSAR', 'siswa', '2022-08-30 06:35:28'),
(20, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-08-30 06:44:22'),
(21, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-09-09 03:46:45'),
(22, '::1', '10982', 'MUHAMMAD ARYA FAIQ', 'osis', '2022-09-12 05:22:06'),
(23, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-09-12 05:24:01'),
(24, '::1', '1977022022211002', 'Irwan Saputra', 'admin', '2022-09-12 05:30:41'),
(25, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-09-12 23:24:36'),
(26, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-09-13 00:01:02'),
(27, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-09-13 00:02:53'),
(28, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-04 06:51:45'),
(29, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-18 12:58:44'),
(30, '::1', '10966', 'ALVARO MUYASSAR', 'siswa', '2022-10-18 13:33:11'),
(31, '::1', '10968', 'ANDRYAN SAPUTRA', 'siswa', '2022-10-18 13:34:31'),
(32, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-19 23:32:45'),
(33, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-20 00:28:44'),
(34, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-20 00:30:02'),
(35, '::1', '3172030081104000', 'Giffary Chan', 'guru', '2022-10-20 00:46:12'),
(36, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-20 00:47:35'),
(37, '::1', '10964', 'AKHIRA KUSUMASTUTI', 'siswa', '2022-10-20 01:56:46'),
(38, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-20 09:19:45'),
(39, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-10-20 09:24:23'),
(40, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-11-16 02:16:00'),
(41, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-12 13:18:53'),
(42, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-13 02:42:29'),
(43, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-14 00:09:07'),
(44, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-14 13:55:42'),
(45, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-14 23:59:57'),
(46, '::1', '10964', 'AKHIRA KUSUMASTUTI', 'siswa', '2022-12-15 01:00:44'),
(47, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2022-12-15 01:06:04'),
(48, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2023-01-03 00:44:52'),
(49, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2023-01-04 07:39:50'),
(50, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2024-02-05 07:48:45'),
(51, '::1', '10965', 'ALBERT CHRISTIAN DARWIN', 'admin', '2024-04-03 07:15:38'),
(52, '::1', '1977022022211002', 'Irwan Saputra', 'admin', '2024-04-03 07:17:06'),
(53, '::1', '1977022022211002', 'Irwan Saputra', 'admin', '2024-04-03 07:18:52'),
(54, '::1', '1234567891234567', 'Admin', 'admin', '2024-04-03 07:21:42'),
(55, '::1', '1977022022211002', 'Irwan Saputra', 'admin', '2024-04-03 07:24:49');

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
  MODIFY `id_pelanggaran_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  MODIFY `id_prestasi_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=661;

--
-- AUTO_INCREMENT untuk tabel `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

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
