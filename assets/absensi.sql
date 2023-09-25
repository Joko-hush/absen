-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 04:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `abs_ijin`
--

CREATE TABLE `abs_ijin` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `ditujukan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `approved_at` int(11) DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `pejabat_id` int(11) DEFAULT NULL,
  `tgl_masuk2` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `abs_kehadiran`
--

CREATE TABLE `abs_kehadiran` (
  `ID` int(11) NOT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `TGL_MASUK` date DEFAULT NULL,
  `TIME_IN` datetime DEFAULT NULL,
  `TIME_OUT` datetime DEFAULT NULL,
  `PICTURE_IN` varchar(100) DEFAULT NULL,
  `PICTURE_OUT` varchar(100) DEFAULT NULL,
  `STAT_KERJA` int(11) DEFAULT NULL,
  `STAT_ABSEN` int(11) DEFAULT NULL,
  `LOK_IN` varchar(255) DEFAULT NULL,
  `LOK_OUT` varchar(255) DEFAULT NULL,
  `INFO` varchar(255) DEFAULT NULL,
  `DISETUJUI_OLEH` varchar(255) DEFAULT NULL,
  `IJIN_ID` int(11) DEFAULT NULL,
  `JAM_KERJA_ID` int(11) DEFAULT NULL,
  `DURASI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `abs_stat_absen`
--

CREATE TABLE `abs_stat_absen` (
  `ID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abs_stat_absen`
--

INSERT INTO `abs_stat_absen` (`ID`, `STATUS`) VALUES
(1, 'MASUK'),
(2, 'PULANG'),
(3, 'TIDAK HADIR'),
(4, 'PULANG AWAL'),
(5, 'LIBUR'),
(6, 'LEPAS JAGA');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_fungsional`
--

CREATE TABLE `jabatan_fungsional` (
  `id` int(11) NOT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `nama` longtext DEFAULT NULL,
  `skep` longtext DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_struktural`
--

CREATE TABLE `jabatan_struktural` (
  `id` int(11) NOT NULL,
  `nama` longtext NOT NULL,
  `tmt` date NOT NULL,
  `skep` longtext NOT NULL,
  `doc` longtext NOT NULL,
  `isactive` int(11) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `total_jam` int(11) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`id`, `nama`, `jam_masuk`, `jam_pulang`, `total_jam`, `ket`, `created_at`, `updated_at`, `isactive`, `periode`) VALUES
(9, 'Non Shift / STAFF', '07:00:00', '15:30:00', 510, 'Dinas Pagi Regular', 1652405693, 1672964523, 1, 1),
(10, 'Shift Pagi', '07:00:00', '14:00:00', 420, 'Perawat Ruang Perawatan', 1652406000, 1672964560, 1, 1),
(12, 'Shift Siang', '14:00:00', '21:00:00', 420, 'Perawat Ruang Rapat', 1652410483, 1665385706, 1, 1),
(13, 'Shift Malam', '21:00:00', '08:00:00', 660, '', 1652410516, 1665385743, 1, 2),
(14, 'Jaga Kesatrian', '08:00:00', '08:00:00', 1440, '2 hari berikutnya libur', 1652410753, 1652410753, 1, 3),
(15, 'Jaga Ruangan', '14:00:00', '08:00:00', 1080, '2 shift', 1659407748, 1665385764, 1, 2),
(16, 'Long Shift Penyaji', '06:00:00', '18:00:00', 720, 'Untuk Penyaji Jangwat', 1663816575, 1663816575, 1, 1),
(17, 'Jaga Ruangan OK', '07:00:00', '07:00:00', 1440, '', 1664846297, 1664846297, 1, 2),
(18, 'Dapur Dini Hari', '05:00:00', '12:00:00', 420, '', 1664953435, 1672017729, 1, 1),
(19, 'Dapur Siang', '11:30:00', '17:30:00', 360, '', 1664953460, 1672034572, 1, 1),
(20, 'Dapur pagi', '07:00:00', '13:00:00', 360, '', 1664953478, 1672034547, 1, 1),
(22, 'LOUNDRY', '06:00:00', '14:00:00', 480, '', 1672021972, 1672021972, 1, NULL),
(23, 'RM Pagi', '06:30:00', '14:30:00', 480, '', 1672276981, 1672300616, 1, NULL),
(24, 'Piket RM', '16:00:00', '07:00:00', 900, '', 1672277003, 1672277003, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jb_bpjs`
--

CREATE TABLE `jb_bpjs` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `bpjs` varchar(50) DEFAULT NULL,
  `fktp` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_b_asing`
--

CREATE TABLE `jb_b_asing` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `isactive` char(10) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_b_daerah`
--

CREATE TABLE `jb_b_daerah` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `isactive` char(10) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_dikmil_b`
--

CREATE TABLE `jb_dikmil_b` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `prestasi` varchar(50) DEFAULT NULL,
  `kep` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_dik_um`
--

CREATE TABLE `jb_dik_um` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `jenis_didik` varchar(50) DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `nama` longtext DEFAULT NULL,
  `prestasi` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_karis`
--

CREATE TABLE `jb_karis` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `no` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_kartu_keluarga`
--

CREATE TABLE `jb_kartu_keluarga` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_keluarga`
--

CREATE TABLE `jb_keluarga` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` longtext DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `hub` char(10) DEFAULT NULL,
  `gol_darah` char(10) DEFAULT NULL,
  `stat_hidup` char(10) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `bpjs` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `fktp` varchar(50) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `doc_aktalahir` longtext DEFAULT NULL,
  `doc_ktp` longtext DEFAULT NULL,
  `doc_bpjs` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_kepangkatan`
--

CREATE TABLE `jb_kepangkatan` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `no_skep` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `KDSTAFFPANGKAT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_ktp`
--

CREATE TABLE `jb_ktp` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `noktp` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `ket` char(10) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_npwp`
--

CREATE TABLE `jb_npwp` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_personil`
--

CREATE TABLE `jb_personil` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `name` longtext DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `sex` char(10) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `gol_darah` char(10) DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `suku_bangsa` varchar(50) DEFAULT NULL,
  `tmt_kerja` date DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `jabatan` longtext DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `bpjs` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `sumber_pa` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `psi` varchar(50) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `deleted` char(10) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `jam_kerja_id` int(11) DEFAULT NULL,
  `status` varchar(12) DEFAULT NULL,
  `kualifikasi_sdm` varchar(100) DEFAULT NULL,
  `gol_pkt` varchar(50) DEFAULT NULL,
  `online` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_prestasi`
--

CREATE TABLE `jb_prestasi` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `kegiatan` longtext DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `tempat` longtext DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `kep` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_r_tugas_luarnegri`
--

CREATE TABLE `jb_r_tugas_luarnegri` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `prestasi` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_r_tugas_operasi`
--

CREATE TABLE `jb_r_tugas_operasi` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` longtext DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `prestasi` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_sertifikat`
--

CREATE TABLE `jb_sertifikat` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jb_tanda_kehormatan`
--

CREATE TABLE `jb_tanda_kehormatan` (
  `id` int(11) NOT NULL,
  `personil_id` int(11) DEFAULT NULL,
  `nama` longtext DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  `prestasi` longtext DEFAULT NULL,
  `doc` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `limit_koperasi`
--

CREATE TABLE `limit_koperasi` (
  `id` int(11) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `action`, `created_at`) VALUES
(5, 2, 'login', 1695344653),
(6, NULL, 'logout', 1695344712),
(7, 3, 'login', 1695608880),
(8, NULL, 'masuk ke homepage', 1695608880),
(9, NULL, 'masuk ke homepage', 1695608912),
(10, NULL, 'masuk ke homepage', 1695608915),
(11, 3, 'logout', 1695608918),
(12, 3, 'login', 1695608929),
(13, 3, 'login', 1695609735),
(14, 3, 'login', 1695609751);

-- --------------------------------------------------------

--
-- Table structure for table `m_bagian`
--

CREATE TABLE `m_bagian` (
  `id` int(11) NOT NULL,
  `eselon_id` int(11) DEFAULT NULL,
  `bidang_id` int(11) DEFAULT NULL,
  `bagian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_bidang`
--

CREATE TABLE `m_bidang` (
  `id` int(11) NOT NULL,
  `eselon_id` int(11) NOT NULL,
  `bidang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_eselon`
--

CREATE TABLE `m_eselon` (
  `id` int(11) NOT NULL,
  `eselon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_ikt`
--

CREATE TABLE `m_ikt` (
  `id` int(11) NOT NULL,
  `DATECREATED` datetime DEFAULT NULL,
  `DATEUPDATED` datetime DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `jumlah` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `api_ikt` varchar(255) NOT NULL,
  `id_bios` int(11) DEFAULT NULL,
  `DATE_KIRIM` datetime DEFAULT NULL,
  `status_kirim` int(11) DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `upload_bukti` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `subbagian_id` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL,
  `leader` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_keuangan`
--

CREATE TABLE `m_keuangan` (
  `id` int(11) NOT NULL,
  `DATECREATED` datetime DEFAULT NULL,
  `DATEUPDATED` datetime DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `kode_akun` varchar(255) NOT NULL,
  `kode_bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `jumlah` decimal(24,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `api_keuangan` varchar(255) NOT NULL,
  `no_bilyet` int(11) DEFAULT NULL,
  `nilai_deposito` decimal(24,2) DEFAULT NULL,
  `nilai_bunga` decimal(24,2) DEFAULT NULL,
  `id_bios` int(11) DEFAULT NULL,
  `DATE_KIRIM` datetime DEFAULT NULL,
  `status_kirim` int(11) DEFAULT NULL,
  `memo` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_kinerja`
--

CREATE TABLE `m_kinerja` (
  `id` int(11) NOT NULL,
  `KDSTAFF` varchar(50) DEFAULT NULL,
  `sasaran` longtext DEFAULT NULL,
  `indikator` longtext DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_kualifikasi`
--

CREATE TABLE `m_kualifikasi` (
  `id` int(11) NOT NULL,
  `kualifikasi` varchar(50) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_kualifikasi`
--

INSERT INTO `m_kualifikasi` (`id`, `kualifikasi`, `created_at`, `updated_at`) VALUES
(1, 'TENAGA PERAWAT', 1684898757, 1684898757),
(2, 'BIDAN', 1684898757, 1684898757),
(3, 'LABORATORIUM', 1684898757, 1684898757),
(4, 'RADIOLOGI', 1684898757, 1684898757),
(5, 'GIZI', 1684898757, 1684898757),
(6, 'FISIOTERAFI', 1684898757, 1684898757),
(7, 'FARMASI', 1684898757, 1684898757),
(15, 'REKAM MEDIS', 1684898757, 1684898757),
(16, 'KESLING', 1684898757, 1684898757),
(17, 'REFRAKSIONIS', 1684898757, 1684898757),
(18, 'PSIKOLOGI', 1684898757, 1684898757),
(19, 'GIGI', 1684898757, 1684898757),
(20, 'ELEKTROMEDIS', 1684898757, 1684898757);

-- --------------------------------------------------------

--
-- Table structure for table `m_paramedis`
--

CREATE TABLE `m_paramedis` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pangkat` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `no_str` varchar(100) DEFAULT NULL,
  `no_sik` varchar(100) DEFAULT NULL,
  `ex_str` date DEFAULT NULL,
  `ex_sik` date DEFAULT NULL,
  `kualifikasi` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `file_str` varchar(255) DEFAULT NULL,
  `file_sik` varchar(255) DEFAULT NULL,
  `nira` varchar(50) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `th_lulus` date DEFAULT NULL,
  `stat` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_paramedis_deleted`
--

CREATE TABLE `m_paramedis_deleted` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pangkat` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `no_str` varchar(100) DEFAULT NULL,
  `no_sik` varchar(100) DEFAULT NULL,
  `ex_str` date DEFAULT NULL,
  `ex_sik` date DEFAULT NULL,
  `kualifikasi` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `file_str` varchar(255) DEFAULT NULL,
  `file_sik` varchar(255) DEFAULT NULL,
  `nira` varchar(50) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `th_lulus` date DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_paramedis_staff`
--

CREATE TABLE `m_paramedis_staff` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pangkat` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `no_str` varchar(100) DEFAULT NULL,
  `no_sik` varchar(100) DEFAULT NULL,
  `ex_str` date DEFAULT NULL,
  `ex_sik` date DEFAULT NULL,
  `kualifikasi` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `file_str` varchar(255) DEFAULT NULL,
  `file_sik` varchar(255) DEFAULT NULL,
  `nira` varchar(50) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `th_lulus` date DEFAULT NULL,
  `stat` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_personil`
--

CREATE TABLE `m_personil` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `pangkat` varchar(150) NOT NULL,
  `jabatan` varchar(150) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kualifikasi` varchar(30) NOT NULL,
  `tmt` date NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `isactive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_personil_pers`
--

CREATE TABLE `m_personil_pers` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `pangkat` varchar(150) NOT NULL,
  `jabatan` varchar(150) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kualifikasi` varchar(30) DEFAULT NULL,
  `tmt` date DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `gol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_subbagian`
--

CREATE TABLE `m_subbagian` (
  `id` int(11) NOT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `subbagian` varchar(255) DEFAULT NULL,
  `bidang_id` int(11) DEFAULT NULL,
  `eselon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_token`
--

CREATE TABLE `phone_token` (
  `id` int(11) NOT NULL,
  `tlp` varchar(20) DEFAULT NULL,
  `token` varchar(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stat_kerja`
--

CREATE TABLE `stat_kerja` (
  `ID` int(11) NOT NULL,
  `KET` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stat_kerja`
--

INSERT INTO `stat_kerja` (`ID`, `KET`) VALUES
(1, 'DINAS DALAM'),
(2, 'DINAS LUAR'),
(3, 'IZIN'),
(4, 'SAKIT'),
(5, 'CUTI');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `email` longtext NOT NULL,
  `image` longtext NOT NULL,
  `password` longtext NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `tlp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `nik`, `tlp`) VALUES
(2, 'JOKO BUDIYANTO', 'budiyantojoko3@gmail.com', 'default.jpg', '$2y$10$KpULBsdxhmIlG1vRzWNE3OVQgPRyJDOyCaKkTjJHaY66/eh7cZRz2', 1, 2, 1649646660, NULL, NULL),
(3, 'Personalia', 'pers@email.com', 'default.jpg', '$2y$10$MwxfAK5QvQoVhv/i/WEMn.8.ZRR/Q5ESc4twQG2XKt8MxShyN.xV6', 3, 2, 1649646660, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(5, 3, 3),
(6, 3, 2),
(7, 2, 3),
(8, 2, 4),
(9, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Menu'),
(3, 'User'),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` int(11) NOT NULL,
  `tlp` varchar(20) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member'),
(3, 'Personalia'),
(4, 'SDM'),
(5, 'KEUANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/index', 'fas fa-fw fa-digital-tachograph', 1),
(2, 3, 'My Profile', 'user', 'fas fa-fw fa-user-astronaut', 1),
(3, 3, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 2, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 2, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 3, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(8, 1, 'User list', 'admin/userlist', 'fas fa-fw fa-address-book', 1),
(9, 4, 'Personil', 'staff/personil', 'ri-shield-user-fill', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` longtext DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abs_ijin`
--
ALTER TABLE `abs_ijin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `abs_kehadiran`
--
ALTER TABLE `abs_kehadiran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `abs_stat_absen`
--
ALTER TABLE `abs_stat_absen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jabatan_fungsional`
--
ALTER TABLE `jabatan_fungsional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_struktural`
--
ALTER TABLE `jabatan_struktural`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_bpjs`
--
ALTER TABLE `jb_bpjs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_b_asing`
--
ALTER TABLE `jb_b_asing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_b_daerah`
--
ALTER TABLE `jb_b_daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_dikmil_b`
--
ALTER TABLE `jb_dikmil_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_dik_um`
--
ALTER TABLE `jb_dik_um`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_karis`
--
ALTER TABLE `jb_karis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_kartu_keluarga`
--
ALTER TABLE `jb_kartu_keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_keluarga`
--
ALTER TABLE `jb_keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_kepangkatan`
--
ALTER TABLE `jb_kepangkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_ktp`
--
ALTER TABLE `jb_ktp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_npwp`
--
ALTER TABLE `jb_npwp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_personil`
--
ALTER TABLE `jb_personil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_prestasi`
--
ALTER TABLE `jb_prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_r_tugas_luarnegri`
--
ALTER TABLE `jb_r_tugas_luarnegri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_r_tugas_operasi`
--
ALTER TABLE `jb_r_tugas_operasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_sertifikat`
--
ALTER TABLE `jb_sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jb_tanda_kehormatan`
--
ALTER TABLE `jb_tanda_kehormatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limit_koperasi`
--
ALTER TABLE `limit_koperasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bagian`
--
ALTER TABLE `m_bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bidang`
--
ALTER TABLE `m_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_eselon`
--
ALTER TABLE `m_eselon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_ikt`
--
ALTER TABLE `m_ikt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_keuangan`
--
ALTER TABLE `m_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kinerja`
--
ALTER TABLE `m_kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kualifikasi`
--
ALTER TABLE `m_kualifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_paramedis`
--
ALTER TABLE `m_paramedis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_paramedis_deleted`
--
ALTER TABLE `m_paramedis_deleted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_paramedis_staff`
--
ALTER TABLE `m_paramedis_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_personil`
--
ALTER TABLE `m_personil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_personil_pers`
--
ALTER TABLE `m_personil_pers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_subbagian`
--
ALTER TABLE `m_subbagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_token`
--
ALTER TABLE `phone_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stat_kerja`
--
ALTER TABLE `stat_kerja`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abs_ijin`
--
ALTER TABLE `abs_ijin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `abs_kehadiran`
--
ALTER TABLE `abs_kehadiran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `abs_stat_absen`
--
ALTER TABLE `abs_stat_absen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jabatan_fungsional`
--
ALTER TABLE `jabatan_fungsional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan_struktural`
--
ALTER TABLE `jabatan_struktural`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jb_bpjs`
--
ALTER TABLE `jb_bpjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_b_asing`
--
ALTER TABLE `jb_b_asing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_b_daerah`
--
ALTER TABLE `jb_b_daerah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_dikmil_b`
--
ALTER TABLE `jb_dikmil_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_dik_um`
--
ALTER TABLE `jb_dik_um`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_karis`
--
ALTER TABLE `jb_karis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_kartu_keluarga`
--
ALTER TABLE `jb_kartu_keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_keluarga`
--
ALTER TABLE `jb_keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_kepangkatan`
--
ALTER TABLE `jb_kepangkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_ktp`
--
ALTER TABLE `jb_ktp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_npwp`
--
ALTER TABLE `jb_npwp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_personil`
--
ALTER TABLE `jb_personil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_prestasi`
--
ALTER TABLE `jb_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_r_tugas_luarnegri`
--
ALTER TABLE `jb_r_tugas_luarnegri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_r_tugas_operasi`
--
ALTER TABLE `jb_r_tugas_operasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_sertifikat`
--
ALTER TABLE `jb_sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jb_tanda_kehormatan`
--
ALTER TABLE `jb_tanda_kehormatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `limit_koperasi`
--
ALTER TABLE `limit_koperasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_bagian`
--
ALTER TABLE `m_bagian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_bidang`
--
ALTER TABLE `m_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_eselon`
--
ALTER TABLE `m_eselon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_ikt`
--
ALTER TABLE `m_ikt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_keuangan`
--
ALTER TABLE `m_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_kinerja`
--
ALTER TABLE `m_kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_kualifikasi`
--
ALTER TABLE `m_kualifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `m_paramedis`
--
ALTER TABLE `m_paramedis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_paramedis_deleted`
--
ALTER TABLE `m_paramedis_deleted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_paramedis_staff`
--
ALTER TABLE `m_paramedis_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_personil`
--
ALTER TABLE `m_personil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_personil_pers`
--
ALTER TABLE `m_personil_pers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1592;

--
-- AUTO_INCREMENT for table `m_subbagian`
--
ALTER TABLE `m_subbagian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_token`
--
ALTER TABLE `phone_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stat_kerja`
--
ALTER TABLE `stat_kerja`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
