-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 08:50 AM
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
-- Database: `pegawai_museum`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addPegawai` ()   BEGIN
    insert into pegawai (kode_pegawai, nama_depan, nama_belakang, alamat, kota, jenis_kelamin, kode_jabatan, kode_tempat) values ('$kode_pegawai_up','$nama_depan_up', '$nama_belakang_up', '$alamat_up', '$kota_up', '$jk_up', '$jb_up', '$cb_up');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteAdmin` (IN `id` INT)   BEGIN
   DELETE FROM admin WHERE id_admin = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeletePegawai` (IN `id_admin` INT)   BEGIN
   DELETE FROM pegawai WHERE id_pegawai=id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteTempat` (IN `id_tempat` INT)   BEGIN
   DELETE FROM tempat WHERE kode_tempat=id_tempat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoAdmin` (IN `kode_pegawai_up` VARCHAR(10), IN `password_up` VARCHAR(20))   BEGIN
   INSERT INTO admin (kode_pegawai, password) VALUES (kode_pegawai_up, password_up);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoPegawai` (IN `kode_pegawai_up` VARCHAR(10), IN `nama_depan_up` VARCHAR(30), IN `nama_belakang_up` VARCHAR(30), IN `alamat_up` VARCHAR(50), IN `kota_up` VARCHAR(20), IN `jk_up` ENUM('Pria','Wanita'), IN `jb_up` INT, IN `cb_up` INT)   BEGIN
   INSERT INTO pegawai (kode_pegawai, nama_depan, nama_belakang, alamat, kota, jenis_kelamin, kode_jabatan, kode_tempat) VALUES (kode_pegawai_up, nama_depan_up, nama_belakang_up, alamat_up, kota_up, jk_up, jb_up, cb_up);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAdminPegawai` (IN `kode_pegawai` VARCHAR(10), IN `password` VARCHAR(20))   BEGIN
   SELECT admin.*, pegawai.nama_depan, pegawai.nama_belakang 
   FROM admin 
   JOIN pegawai ON admin.kode_pegawai = pegawai.kode_pegawai 
   WHERE admin.kode_pegawai = kode_pegawai AND admin.password = password;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectAdminPegawaiDetails` ()   BEGIN
   SELECT admin.id_admin, admin.kode_pegawai, pegawai.nama_depan, pegawai.nama_belakang, pegawai.alamat, pegawai.kota, pegawai.jenis_kelamin 
   FROM admin, pegawai 
   WHERE admin.kode_pegawai = pegawai.kode_pegawai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPegawai` ()   BEGIN
    select pegawai.id_pegawai, pegawai.kode_pegawai, pegawai.nama_depan, pegawai.nama_belakang, pegawai.alamat, pegawai.kota, pegawai.jenis_kelamin, jabatan.nama_jabatan, tempat.nama_tempat from pegawai,jabatan,tempat where pegawai.kode_jabatan = jabatan.kode_jabatan and pegawai.kode_tempat = tempat.kode_tempat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPegawaidanAdmin` ()   BEGIN
    SELECT admin.*, pegawai.nama_depan, pegawai.nama_belakang FROM admin JOIN pegawai ON admin.kode_pegawai = pegawai.kode_pegawai WHERE admin.kode_pegawai='$kode_pegawai';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTempat` ()   BEGIN
    select * from tempat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePegawai` (IN `Id` INT, IN `nama_depan_up` VARCHAR(30), IN `nama_belakang_up` VARCHAR(30), IN `alamat_up` VARCHAR(50), IN `kota_up` VARCHAR(20), IN `jk_up` ENUM('Pria','Wanita'), IN `jb_up` INT, IN `cb_up` INT)   BEGIN
   UPDATE pegawai SET nama_depan = nama_depan_up,  nama_belakang = nama_belakang_up,  alamat = alamat_up, kota = kota_up, jenis_kelamin = jk_up, kode_jabatan = jb_up, kode_tempat = cb_up WHERE id_pegawai = id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `kode_pegawai` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `kode_pegawai`, `password`) VALUES
(16, '10121121', 'admin123'),
(17, '10121102', 'admin123'),
(18, '10121101', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`) VALUES
(1, 'Conservator'),
(2, 'Exhibit Designer'),
(3, 'Visitor Services Coordina'),
(4, 'Curator'),
(5, 'Archivist');

--
-- Triggers `jabatan`
--
DELIMITER $$
CREATE TRIGGER `after_delete_on_jabatan` AFTER DELETE ON `jabatan` FOR EACH ROW BEGIN
   DELETE FROM pegawai WHERE pegawai.kode_jabatan = OLD.kode_jabatan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `kode_pegawai` varchar(10) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `kode_tempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `kode_pegawai`, `nama_depan`, `nama_belakang`, `alamat`, `kota`, `jenis_kelamin`, `kode_jabatan`, `kode_tempat`) VALUES
(1, '10121101', 'Ina', 'Hidayat', 'Jl. Cikutra No. 345', 'Jakarta', 'Wanita', 2, 1),
(2, '10121102', 'Tika', 'Pratama', 'Jl. Sudirman No. 10', 'Yogyakarta', 'Wanita', 1, 4),
(3, '10121103', 'Aldi', 'Wahyudi', 'Jl. Cikapayang No. 380', 'Jakarta', 'Wanita', 3, 1),
(4, '10121104', 'Zara', 'Santoso', 'Jl. Cikutra No. 480', 'Yogyakarta', 'Pria', 1, 4),
(5, '10121105', 'Joni', 'Santoso', 'Jl. Gatot Subroto No. 20', 'Surabaya', 'Pria', 5, 3),
(6, '10121106', 'Oki', 'Wijaya', 'Jl. Cikutra No. 465', 'Yogyakarta', 'Wanita', 4, 4),
(7, '10121107', 'Cindy', 'Hermanto', 'Jl. Cikapayang No. 170', 'Bandung', 'Pria', 5, 2),
(8, '10121108', 'Dodi', 'Wijaya', 'Jl. Cikawao No. 280', 'Surabaya', 'Wanita', 3, 3),
(9, '10121109', 'Zara', 'Kusuma', 'Jl. Cikutra No. 285', 'Bandung', 'Wanita', 4, 2),
(10, '10121110', 'Cinta', 'Santoso', 'Jl. Cikutra No. 255', 'Yogyakarta', 'Pria', 3, 4),
(11, '10121111', 'Nina', 'Saputra', 'Jl. Cikapayang No. 395', 'Bandung', 'Wanita', 4, 2),
(12, '10121112', 'Fajar', 'Wijaya', 'Jl. Cikawao No. 370', 'Jakarta', 'Pria', 2, 1),
(13, '10121113', 'Cindy', 'Gunawan', 'Jl. Cikutra No. 465', 'Yogyakarta', 'Pria', 2, 4),
(14, '10121114', 'Fauzi', 'Hidayat', 'Jl. Cikutra No. 390', 'Bandung', 'Pria', 2, 2),
(15, '10121115', 'Rani', 'Santoso', 'Jl. Cikapayang No. 230', 'Surabaya', 'Wanita', 1, 3),
(16, '10121116', 'Sari', 'Kurniawan', 'Jl. Sisingamangaraja No. 40', 'Jakarta', 'Pria', 1, 1),
(17, '10121117', 'Lina', 'Saputro', 'Jl. Cikutra No. 405', 'Surabaya', 'Wanita', 5, 3),
(18, '10121118', 'Rani', 'Saputra', 'Jl. Cikutra No. 105', 'Surabaya', 'Wanita', 1, 3),
(19, '10121119', 'Fauzi', 'Putra', 'Jl. Cikapayang No. 140', 'Jakarta', 'Wanita', 1, 1),
(20, '10121120', 'Tika', 'Hermawan', 'Jl. Cikawao No. 190', 'Bandung', 'Wanita', 5, 2),
(121, '10121121', 'admin', 'admin', 'Jl. Admin 123', 'Bandung', 'Wanita', 2, 4);

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `after_delete_on_pegawai` AFTER DELETE ON `pegawai` FOR EACH ROW BEGIN
   DELETE FROM admin WHERE admin.kode_pegawai = OLD.kode_pegawai;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `kode_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(30) NOT NULL,
  `alamat_tempat` varchar(80) NOT NULL,
  `kota_tempat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`kode_tempat`, `nama_tempat`, `alamat_tempat`, `kota_tempat`) VALUES
(1, 'National Museum of Indonesia', 'Jl. Merdeka No. 123', 'Jakarta'),
(2, 'Museum Nasional', 'Jl. Diponegoro No. 456', 'Bandung'),
(3, 'Museum Seni Rupa dan Keramik', 'Jl. Sudirman No. 789', 'Surabaya'),
(4, 'Museum Sejarah', 'Jl. Gajah Mada No. 321', 'Yogyakarta');

--
-- Triggers `tempat`
--
DELIMITER $$
CREATE TRIGGER `after_delete_on_tempat` AFTER DELETE ON `tempat` FOR EACH ROW BEGIN
   DELETE FROM pegawai WHERE pegawai.kode_tempat = OLD.kode_tempat;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `kode_pegawai` (`kode_pegawai`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `kode_pegawai` (`kode_pegawai`),
  ADD KEY `kode_jabatan` (`kode_jabatan`),
  ADD KEY `kode_tempat` (`kode_tempat`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`kode_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `kode_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tempat`
--
ALTER TABLE `tempat`
  MODIFY `kode_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `pegawai` (`kode_pegawai`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`kode_tempat`) REFERENCES `tempat` (`kode_tempat`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
