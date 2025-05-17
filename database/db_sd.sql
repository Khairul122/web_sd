-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2025 at 04:09 PM
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
-- Database: `db_sd`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_evaluasi`
--

CREATE TABLE `hasil_evaluasi` (
  `hasil_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `total_nilai` decimal(5,2) NOT NULL,
  `ranking` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `hasil_evaluasi`
--

INSERT INTO `hasil_evaluasi` (`hasil_id`, `siswa_id`, `total_nilai`, `ranking`, `created_at`, `updated_at`) VALUES
(47, 1, '3.96', 1, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(48, 5, '3.80', 2, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(49, 6, '3.80', 3, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(50, 9, '3.80', 4, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(51, 10, '3.80', 5, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(52, 12, '3.80', 6, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(53, 14, '3.80', 7, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(54, 15, '3.80', 8, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(55, 20, '3.80', 9, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(56, 21, '3.80', 10, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(57, 22, '3.80', 11, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(58, 23, '3.80', 12, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(59, 8, '3.77', 13, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(60, 4, '3.71', 14, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(61, 13, '3.71', 15, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(62, 18, '3.71', 16, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(63, 2, '3.69', 17, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(64, 16, '3.68', 18, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(65, 3, '3.67', 19, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(66, 17, '3.67', 20, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(67, 7, '3.65', 21, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(68, 19, '3.62', 22, '2025-05-17 16:08:41', '2025-05-17 16:08:41'),
(69, 11, '3.57', 23, '2025-05-17 16:08:41', '2025-05-17 16:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int NOT NULL,
  `nama_kelas` varchar(20) COLLATE utf8mb3_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, '1', '2025-05-17 14:56:59', '2025-05-17 14:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kriteria_id` int NOT NULL,
  `kode` varchar(5) COLLATE utf8mb3_swedish_ci NOT NULL,
  `nama_kriteria` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `bobot` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kriteria_id`, `kode`, `nama_kriteria`, `bobot`, `created_at`, `updated_at`) VALUES
(2, 'C1', 'Kehadiran', '0.20', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(3, 'C2', 'Mengikuti Upacara', '0.10', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(4, 'C3', 'Melaksanakan Piket Mingguan', '0.15', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(5, 'C4', 'Kerapian Seragam', '0.15', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(6, 'C5', 'Ketepatan Waktu', '0.15', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(7, 'C6', 'Pengumpulan Tugas', '0.15', '2025-05-17 15:09:19', '2025-05-17 15:09:19'),
(8, 'C7', 'Kehadiran di Kelas', '0.10', '2025-05-17 15:09:19', '2025-05-17 15:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kedisiplinan`
--

CREATE TABLE `penilaian_kedisiplinan` (
  `penilaian_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `c1` decimal(5,2) NOT NULL,
  `c2` decimal(5,2) NOT NULL,
  `c3` decimal(5,2) NOT NULL,
  `c4` decimal(5,2) NOT NULL,
  `c5` decimal(5,2) NOT NULL,
  `c6` decimal(5,2) NOT NULL,
  `c7` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `penilaian_kedisiplinan`
--

INSERT INTO `penilaian_kedisiplinan` (`penilaian_id`, `siswa_id`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `created_at`, `updated_at`) VALUES
(2, 1, '4.20', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(3, 2, '3.40', '3.60', '4.00', '4.00', '4.00', '3.00', '4.00', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(4, 3, '3.20', '3.60', '4.00', '4.00', '4.00', '3.40', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(5, 4, '3.40', '3.60', '4.00', '4.00', '4.00', '3.40', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(6, 5, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(7, 6, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(8, 7, '3.40', '3.60', '4.00', '4.00', '4.00', '3.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(9, 8, '3.40', '3.60', '4.00', '4.00', '4.00', '3.80', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(10, 9, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(11, 10, '4.00', '3.60', '4.00', '4.00', '4.00', '3.20', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(12, 11, '3.00', '3.60', '4.00', '4.00', '4.00', '3.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(13, 12, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(14, 13, '3.40', '3.60', '4.00', '4.00', '4.00', '3.40', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(15, 14, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(16, 15, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(17, 16, '3.40', '3.60', '4.00', '4.00', '4.00', '3.20', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(18, 17, '3.20', '3.60', '4.00', '4.00', '4.00', '3.40', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(19, 18, '3.40', '3.60', '4.00', '4.00', '4.00', '3.40', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(20, 19, '3.20', '3.40', '4.00', '4.00', '4.00', '3.20', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(21, 20, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(22, 21, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(23, 22, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58'),
(24, 23, '3.40', '3.60', '4.00', '4.00', '4.00', '4.00', '3.60', '2025-05-17 15:15:58', '2025-05-17 15:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int NOT NULL,
  `nama_siswa` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb3_swedish_ci NOT NULL,
  `kelas_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `nama_siswa`, `jenis_kelamin`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1, 'Gaudiarashyia', 'P', 1, '2025-05-17 15:01:10', '2025-05-17 15:01:10'),
(2, 'Ria Purnamasari', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(3, 'Suci Amandayani', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(4, 'Kayla Varisha', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(5, 'Rosarina', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(6, 'Aishwa Nahla', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(7, 'Yosfat Lumban Toruan', 'L', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(8, 'Alya Azahara', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(9, 'Zivana Devina', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(10, 'Raihan Laksmana', 'L', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(11, 'Rehan Fahrezy Hasibuan', 'L', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(12, 'Indah Selvian Shaluku', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(13, 'Zefanya Elkhsa Turnip', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(14, 'Cello Mitha Gracia Naingolan', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(15, 'Trisyah Andini Nasution', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(16, 'Mutiara Azahra Pohan', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(17, 'Cindy Hanindya Putri', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(18, 'Khalisa Humaira', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(19, 'Nurul Ade Sidomi', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(20, 'Yosia Pinondang Siahaan', 'L', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(21, 'Fila Delfia Lumbantobing', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(22, 'Narendra Alfareza', 'L', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27'),
(23, 'Elma Feodora Simatupang', 'P', 1, '2025-05-17 15:01:27', '2025-05-17 15:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_swedish_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `role` enum('admin','guru') COLLATE utf8mb3_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin', '2025-05-17 14:47:26', '2025-05-17 14:47:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  ADD PRIMARY KEY (`hasil_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kriteria_id`);

--
-- Indexes for table `penilaian_kedisiplinan`
--
ALTER TABLE `penilaian_kedisiplinan`
  ADD PRIMARY KEY (`penilaian_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  MODIFY `hasil_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kriteria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penilaian_kedisiplinan`
--
ALTER TABLE `penilaian_kedisiplinan`
  MODIFY `penilaian_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  ADD CONSTRAINT `hasil_evaluasi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_kedisiplinan`
--
ALTER TABLE `penilaian_kedisiplinan`
  ADD CONSTRAINT `penilaian_kedisiplinan_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
