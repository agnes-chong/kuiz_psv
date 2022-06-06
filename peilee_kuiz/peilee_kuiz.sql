-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peilee_kuiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nama_guru` varchar(60) DEFAULT NULL,
  `nokp_guru` varchar(12) NOT NULL,
  `katalaluan_guru` varchar(30) DEFAULT NULL,
  `tahap` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nama_guru`, `nokp_guru`, `katalaluan_guru`, `tahap`) VALUES
('Ruhayati', '690511071018', '123', 'ADMIN'),
('Noriz', '711118040698', '123', 'GURU');

-- --------------------------------------------------------

--
-- Table structure for table `jawapan_murid`
--

CREATE TABLE `jawapan_murid` (
  `id_jawapan` int(11) NOT NULL,
  `no_soalan` int(11) DEFAULT NULL,
  `jawapan` varchar(100) DEFAULT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `nokp_murid` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawapan_murid`
--

INSERT INTO `jawapan_murid` (`id_jawapan`, `no_soalan`, `jawapan`, `catatan`, `nokp_murid`) VALUES
(688, 20, 'jawapan_a', 'BETUL', '040915070606'),
(689, 23, 'jawapan_a', 'BETUL', '040915070606'),
(690, 32, 'jawapan_a', 'BETUL', '040915070606'),
(691, 31, 'jawapan_d', 'SALAH', '040915070606'),
(692, 24, 'tidak jawab', 'TIDAK JAWAB', '040915070606'),
(693, 31, 'jawapan_a', 'BETUL', '040621011014'),
(694, 24, 'jawapan_c', 'SALAH', '040621011014'),
(695, 23, 'jawapan_a', 'BETUL', '040621011014'),
(696, 32, 'tidak jawab', 'TIDAK JAWAB', '040621011014'),
(697, 20, 'jawapan_a', 'BETUL', '040621011014'),
(698, 37, 'jawapan_b', 'SALAH', '040301100111'),
(699, 36, 'jawapan_a', 'BETUL', '040301100111'),
(700, 39, 'jawapan_c', 'SALAH', '040301100111'),
(701, 38, 'jawapan_d', 'SALAH', '040301100111'),
(702, 35, 'jawapan_a', 'BETUL', '040301100111'),
(703, 35, 'jawapan_a', 'BETUL', '040316100555'),
(704, 39, 'tidak jawab', 'TIDAK JAWAB', '040316100555'),
(705, 37, 'jawapan_a', 'BETUL', '040316100555'),
(706, 36, 'jawapan_a', 'BETUL', '040316100555'),
(707, 38, 'jawapan_b', 'SALAH', '040316100555'),
(708, 41, 'jawapan_c', 'SALAH', '040316100555'),
(709, 42, 'jawapan_a', 'BETUL', '040316100555'),
(710, 40, 'jawapan_a', 'BETUL', '040316100555'),
(711, 41, 'jawapan_a', 'BETUL', '040301100111'),
(712, 42, 'jawapan_a', 'BETUL', '040301100111'),
(713, 40, 'jawapan_a', 'BETUL', '040301100111');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `ting` varchar(2) DEFAULT NULL,
  `nama_kelas` varchar(30) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `ting`, `nama_kelas`, `nokp_guru`) VALUES
(5, '2', 'Iswara', '711118040698'),
(7, '2', 'Wira', '690511071018');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `nama_murid` varchar(60) DEFAULT NULL,
  `nokp_murid` varchar(12) NOT NULL,
  `katalaluan_murid` varchar(30) DEFAULT NULL,
  `id_kelas` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`nama_murid`, `nokp_murid`, `katalaluan_murid`, `id_kelas`) VALUES
('Jojo', '040301100111', '123', 7),
('Amos', '040316100555', '123', 7),
('Min Sew', '040621011014', '123', 5),
('Regina', '040915070606', '123', 5);

-- --------------------------------------------------------

--
-- Table structure for table `set_soalan`
--

CREATE TABLE `set_soalan` (
  `no_set` int(9) NOT NULL,
  `topik` varchar(60) DEFAULT NULL,
  `arahan` varchar(250) DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `masa` varchar(50) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL,
  `jenis` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `set_soalan`
--

INSERT INTO `set_soalan` (`no_set`, `topik`, `arahan`, `tarikh`, `masa`, `nokp_guru`, `jenis`) VALUES
(6, 'REKA BENTUK HIASAN DALAMAN', 'Jawab semua soalan', '2021-12-01', 'Tiada', '690511071018', 'Latihan'),
(8, 'CATAN', 'Jawab semua soalan', '2021-10-02', 'Tiada', '711118040698', 'Latihan'),
(9, 'LUKISAN', 'Jawab semua soalan', '2021-10-27', '5', '690511071018', 'Kuiz');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `no_soalan` int(11) NOT NULL,
  `no_set` int(9) DEFAULT NULL,
  `soalan` varchar(250) DEFAULT NULL,
  `gambar` varchar(60) DEFAULT NULL,
  `jawapan_a` varchar(60) DEFAULT NULL,
  `jawapan_b` varchar(60) DEFAULT NULL,
  `jawapan_c` varchar(60) DEFAULT NULL,
  `jawapan_d` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`no_soalan`, `no_set`, `soalan`, `gambar`, `jawapan_a`, `jawapan_b`, `jawapan_c`, `jawapan_d`) VALUES
(20, 8, 'Bahan pengilat yang digunakan bersama cat tempera adalah', ' ', 'Kuning telur', 'Minyak linseed', 'Turpetin', 'Gam arab'),
(23, 8, 'Teknik manakah yang digunakan dalam cat air?', ' ', 'Basah atas basah', 'Impasto', 'Hard edges', 'Scumbling'),
(24, 8, 'Berikut merupakan pelukis catan yang terkenal daripada aliran impressionisme.Antara berikut yang manakah salah?', ' ', 'Frida Kahlo', 'Claude Monet', 'Edgar Degas', 'Camille Pissarro '),
(31, 8, 'Catan tersebut menggunakan teknik glazing dan bahan pengantara adalah air. Antara yang berikut, apakah media yang digunakan?', '../images/2021-10-25011400PM.jpg', 'Cat akrilik', 'Cat air', 'Cat minyak', 'Cat tempera'),
(32, 8, 'Yang manakah salah tentang sifat yang terdapat pada cat minyak?', ' ', 'Warna tidak lama kekal', 'Lambat kering', 'Turpetin sebagai pelarut warna', 'Memberikan kesan yang tegap'),
(35, 9, 'Antara pensel berikut, yang manakah lebih lembut?', '../images/2021-10-29031526PM.jpg', '8B', 'BB', 'HB', '5B'),
(36, 9, 'Apakah media yang digunakan dalam lukisan gua di Gua Tambun, Perak?', ' ', 'Hematit', 'Kapur', 'Arang', 'Ranting Kayu'),
(37, 9, 'Di manakah lukisan terawal ditemui?', ' ', 'Dinding gua', 'Tulang Haiwan', 'Kulit Pokok', 'Kulit Haiwan'),
(38, 9, 'Yang manakah dikaitkan dengan lukisan?', ' ', 'Dakwat', 'Akrilik', 'Tempera', 'Gouache'),
(39, 9, 'Manakah yang salah tentang teknik lukisan?', ' ', 'Teknik Melembut', 'Teknik\r\nLorekan', 'Teknik\r\nContengan', 'Teknik\r\nSilang Pangkah'),
(40, 6, 'Antara yang berikut, yang manakah bukan prinsip reka bentuk?', ' ', 'Estetik', 'Harmoni', 'Imbangan', 'Kontra'),
(41, 6, 'Apakah benda yang bukan simetri?', ' ', 'Pokok', 'Cermin mata', 'Tayar', 'Kertas A4'),
(42, 6, 'Yang manakah bukan elemen semula jadi?', ' ', 'Lampu', 'Kolam', 'Tumbuhan', 'Batu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nokp_guru`);

--
-- Indexes for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD PRIMARY KEY (`id_jawapan`),
  ADD UNIQUE KEY `no_soalan` (`no_soalan`,`nokp_murid`),
  ADD KEY `nokp_murid` (`nokp_murid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `nokp_guru` (`nokp_guru`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`nokp_murid`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD PRIMARY KEY (`no_set`),
  ADD KEY `nokp_guru` (`nokp_guru`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`no_soalan`),
  ADD KEY `no_set` (`no_set`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  MODIFY `id_jawapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `set_soalan`
--
ALTER TABLE `set_soalan`
  MODIFY `no_set` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `soalan`
--
ALTER TABLE `soalan`
  MODIFY `no_soalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD CONSTRAINT `jawapan_murid_ibfk_1` FOREIGN KEY (`no_soalan`) REFERENCES `soalan` (`no_soalan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawapan_murid_ibfk_2` FOREIGN KEY (`nokp_murid`) REFERENCES `murid` (`nokp_murid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `murid`
--
ALTER TABLE `murid`
  ADD CONSTRAINT `murid_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD CONSTRAINT `set_soalan_ibfk_1` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`no_set`) REFERENCES `set_soalan` (`no_set`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
