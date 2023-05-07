-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 11:39 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipenggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nik`, `username`, `password`, `status`) VALUES
('ADM1', '201943500947', 'Sugianto', '827ccb0eea8a706c4c34a16891f84e7b', 'HRD'),
('ADM2', '201943500948', 'Suganda', '1e01ba3e07ac48cbdab2d3284d1dd0fa', 'Manager'),
('ADM3', '201943500949', 'Supriatna', 'e13dd027be0f2152ce387ac0ea83d863', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` varchar(15) NOT NULL,
  `nama_departemen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
('DPT1', 'HRD'),
('DPT2', 'Sales & Marketing'),
('DPT3', 'Creative'),
('DPT4', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(15) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gaji_pokok` int(30) NOT NULL,
  `id_tunjangan` varchar(15) NOT NULL,
  `id_departemen` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `id_tunjangan`, `id_departemen`) VALUES
('JBT1', 'Editor Foto', 4500000, 'TNJ1', 'DPT1'),
('JBT2', 'Sosial Media', 6000000, 'TNJ1', 'DPT1'),
('JBT3', 'Marketing', 8500000, 'TNJ1', 'DPT1'),
('JBT1', 'Editor Foto', 4500000, 'TNJ2', 'DPT1'),
('JBT4', 'Web Developer', 10000000, '', 'DPT4');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(15) NOT NULL,
  `id_jabatan` varchar(15) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `ptkp` varchar(30) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `id_jabatan`, `nama_karyawan`, `alamat`, `jenis_kelamin`, `no_telepon`, `ptkp`, `npwp`, `foto`, `tanggal_masuk`, `tanggal_keluar`) VALUES
('201943500947', 'JBT1', 'Sugianto', 'Sumedang', 'Laki-laki', '081953011992', 'TK/0', '374948973493', '201943500947.jpg', '2022-08-17', '0000-00-00'),
('201943500948', 'JBT2', 'Suganda', 'Bekasi', 'Laki-laki', '081953011992', 'K/0', '636283692', '201943500948.jpg', '2018-08-20', '2022-08-11'),
('201943500949', 'JBT3', 'Supriatna', 'Bandung', 'Laki-laki', '081953011992', 'K/I/0', '69286392', '201943500949.jpg', '2018-08-20', '2022-08-11'),
('201943500950', 'JBT4', 'Agus', 'Sumedang', 'Laki-laki', '081953011999', 'TK/0', '843804938', '86ff1e15044385d27c456a510a3a4dff.jpg', '2022-08-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `no_slip` varbinary(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` int(15) NOT NULL,
  `tahun` int(15) NOT NULL,
  `gaji_pokok` int(30) NOT NULL,
  `total_tunjangan` int(30) NOT NULL,
  `uang_lembur` int(30) NOT NULL,
  `total_absen` int(30) NOT NULL,
  `pph21` int(30) NOT NULL,
  `bpjs_ketenagakerjaan` int(30) NOT NULL,
  `bpjs_kesehatan` int(30) NOT NULL,
  `total_gaji` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`no_slip`, `nik`, `tanggal`, `bulan`, `tahun`, `gaji_pokok`, `total_tunjangan`, `uang_lembur`, `total_absen`, `pph21`, `bpjs_ketenagakerjaan`, `bpjs_kesehatan`, `total_gaji`) VALUES
(0x474a31323030383232303233333036, '201943500947', '2022-08-20', 8, 2022, 4500000, 805000, 180000, 0, 34975, 90000, 45000, 5315025),
(0x474a32323030383232303233333133, '201943500948', '2022-08-20', 8, 2022, 6000000, 345000, 120000, 0, 62588, 120000, 60000, 6222412),
(0x474a33323030383232303233333230, '201943500949', '2022-08-20', 8, 2022, 8500000, 345000, 0, 1, 0, 170000, 85000, 8490000),
(0x474a34323030383232303233333332, '201943500950', '2022-08-20', 8, 2022, 10000000, 0, 0, 0, 248750, 200000, 100000, 9451250);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` varchar(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` int(15) NOT NULL,
  `tahun` int(15) NOT NULL,
  `jam_masuk` varchar(30) NOT NULL,
  `jam_keluar` varchar(30) NOT NULL,
  `lembur` varchar(30) NOT NULL,
  `keterangan_lembur` varchar(150) NOT NULL,
  `absen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `nik`, `tanggal`, `bulan`, `tahun`, `jam_masuk`, `jam_keluar`, `lembur`, `keterangan_lembur`, `absen`) VALUES
('PR2190822102145', '201943500948', '2022-08-19', 8, 2022, '10:21:47', '10:21:54', '4', 'Membuat laporan keuangan', 'Masuk'),
('PR3190822223227', '201943500947', '2022-08-19', 8, 2022, '22:32:34', '22:32:56', '6', 'Edit foto urgent', 'Masuk'),
('PR3190822235435', '201943500949', '2022-08-19', 8, 2022, '', '', '', '', 'Cuti');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE `tunjangan` (
  `id_tunjangan` varchar(15) NOT NULL,
  `nama_tunjangan` varchar(30) NOT NULL,
  `tunjangan` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tunjangan`
--

INSERT INTO `tunjangan` (`id_tunjangan`, `nama_tunjangan`, `tunjangan`) VALUES
('TNJ1', 'Transportasi', 15000),
('TNJ2', 'Makan Siang', 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`,`username`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`no_slip`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- Indexes for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`id_tunjangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
