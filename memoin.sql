-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2019 at 02:04 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memo`
--

CREATE TABLE `tbl_memo` (
  `mm_id` int(11) NOT NULL,
  `mm_pengirim` varchar(20) NOT NULL,
  `mm_tujuan` varchar(20) NOT NULL,
  `mm_perihal` varchar(255) NOT NULL,
  `mm_isi` text NOT NULL,
  `mm_note` varchar(255) NOT NULL,
  `mm_tgl_buat` int(11) NOT NULL,
  `mm_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memo_activity`
--

CREATE TABLE `tbl_memo_activity` (
  `ma_id` int(11) NOT NULL,
  `ma_mm_id` int(11) NOT NULL,
  `ma_by` varchar(100) NOT NULL,
  `ma_date` int(11) NOT NULL,
  `ma_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nik` varchar(20) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `user_no_telp` varchar(15) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `user_bagian` varchar(50) NOT NULL,
  `user_is_active` int(1) NOT NULL,
  `user_date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nik`, `user_name`, `user_no_telp`, `user_email`, `user_password`, `user_role`, `user_bagian`, `user_is_active`, `user_date_created`) VALUES
(12, '12345678', 'Bagus Tri Harjanto', '081290220996', 'admin@gmail.com', '$2y$10$MLMFBu4bvXxAEDXcQQfbQucXY8f7QJStqMZnf2xojqrAD8zAf3g.q', 'Administrator', '', 1, 1562586962),
(13, '11223154', 'Intania Cahya Sari', '08999555917', 'staff@gmail.com', '$2y$10$dH.iFe8CQ9L6DBx8uEKt3OY7t8Mk2XENBotXbrPpdYRbkrLrEG/wC', 'Staff', 'Keuangan', 1, 1562586996),
(14, '81736589', 'M Alwi Hassan', '079423482737', 'manager@gmail.com', '$2y$10$GXLQ4C1XluWadcVKlpKJfeYWxMMjCsHYFmjDMrNUejV5FultoP40a', 'Manager', 'Keuangan', 1, 1562587025),
(15, '816374851', 'M Yasifa Prasetya', '081290220996', 'direktur@gmail.com', '$2y$10$LkktnThYT3HjdLrWU6rVeusH9AGmcew8E40SxMHD5RGNCMZXTyA0q', 'Direktur', 'Utama', 1, 1562587058);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_token`
--

CREATE TABLE `tbl_user_token` (
  `ut_id` int(11) NOT NULL,
  `ut_email` varchar(128) NOT NULL,
  `ut_token` varchar(128) NOT NULL,
  `ut_date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_memo`
--
ALTER TABLE `tbl_memo`
  ADD PRIMARY KEY (`mm_id`);

--
-- Indexes for table `tbl_memo_activity`
--
ALTER TABLE `tbl_memo_activity`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD PRIMARY KEY (`ut_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_memo`
--
ALTER TABLE `tbl_memo`
  MODIFY `mm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_memo_activity`
--
ALTER TABLE `tbl_memo_activity`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
