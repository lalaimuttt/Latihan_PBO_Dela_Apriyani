-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 04:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1b_dela_apriyani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(20) DEFAULT NULL,
  `efek_gerak_fitur` varchar(50) DEFAULT NULL,
  `bantal_selimut_pack` varchar(50) DEFAULT NULL,
  `layanan_butler` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers: Endgame', '2026-06-20 14:00:00', 2, '50000.00', 'Regular', 'Dolby Digital', 'A5', NULL, NULL, NULL, NULL),
(2, 'Spider-Man: No Way Home', '2026-06-20 16:30:00', 3, '45000.00', 'Regular', 'Stereo', 'B7', NULL, NULL, NULL, NULL),
(3, 'The Batman', '2026-06-20 19:00:00', 1, '55000.00', 'Regular', 'Dolby Atmos', 'C3', NULL, NULL, NULL, NULL),
(4, 'Dune', '2026-06-21 13:00:00', 4, '48000.00', 'Regular', 'Dolby Digital', 'D2', NULL, NULL, NULL, NULL),
(5, 'John Wick 4', '2026-06-21 15:30:00', 2, '52000.00', 'Regular', 'Stereo', 'E8', NULL, NULL, NULL, NULL),
(6, 'Oppenheimer', '2026-06-21 18:00:00', 3, '50000.00', 'Regular', 'Dolby Atmos', 'F4', NULL, NULL, NULL, NULL),
(7, 'Barbie', '2026-06-22 14:00:00', 2, '47000.00', 'Regular', 'Dolby Digital', 'G6', NULL, NULL, NULL, NULL),
(8, 'Avatar: Way of Water', '2026-06-20 13:00:00', 2, '75000.00', 'IMAX', NULL, NULL, '3D-IMAX-001', 'D-BOX Motion', NULL, NULL),
(9, 'Top Gun: Maverick', '2026-06-20 15:30:00', 3, '70000.00', 'IMAX', NULL, NULL, '3D-IMAX-002', '4DX Motion', NULL, NULL),
(10, 'Interstellar', '2026-06-20 18:30:00', 1, '80000.00', 'IMAX', NULL, NULL, '3D-IMAX-003', 'D-BOX Motion', NULL, NULL),
(11, 'Inception', '2026-06-21 14:00:00', 4, '72000.00', 'IMAX', NULL, NULL, '3D-IMAX-004', 'Motion Seat', NULL, NULL),
(12, 'Tenet', '2026-06-21 16:30:00', 2, '78000.00', 'IMAX', NULL, NULL, '3D-IMAX-005', 'D-BOX Motion', NULL, NULL),
(13, 'Dune Part Two', '2026-06-21 19:00:00', 3, '76000.00', 'IMAX', NULL, NULL, '3D-IMAX-006', '4DX Motion', NULL, NULL),
(14, 'Mission Impossible 7', '2026-06-22 15:00:00', 2, '74000.00', 'IMAX', NULL, NULL, '3D-IMAX-007', 'Motion Seat', NULL, NULL),
(15, 'The Godfather', '2026-06-20 15:00:00', 2, '120000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Premium Package', 'Personal Butler'),
(16, 'The Dark Knight', '2026-06-20 18:00:00', 1, '130000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Deluxe Package', 'VIP Butler'),
(17, 'Pulp Fiction', '2026-06-21 14:30:00', 3, '115000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Premium Package', 'Personal Butler'),
(18, 'Fight Club', '2026-06-21 17:00:00', 2, '125000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Deluxe Package', 'VIP Butler'),
(19, 'Forrest Gump', '2026-06-22 13:30:00', 4, '110000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Premium Package', 'Personal Butler'),
(20, 'The Shawshank Redemption', '2026-06-22 16:00:00', 2, '128000.00', 'Velvet', NULL, NULL, NULL, NULL, 'Deluxe Package', 'VIP Butler');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
