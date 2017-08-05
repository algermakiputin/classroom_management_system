-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2017 at 06:57 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `date_created`) VALUES
(13, 'alger makiputin', 'admin', '$2y$10$0W7pxEzZVc971mCwuLwHbuVyFcOperbdNS63.k.uj57', '07-27-2017 12:38:34 pm'),
(14, 'emma watson', 'emma', '$2y$10$c1MHH6zAfOnRiU8vgmWpEO1ReoLXjrLKLkuNI5Uhqr.', '07-27-2017 12:42:52 pm');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `floor_level` int(11) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_number`, `room_name`, `floor_level`, `date_added`) VALUES
(4, 404, 'Amazon', 4, '07-23-2017 12:24:13 am'),
(5, 405, 'makiputin', 4, '07-23-2017 12:25:07 am'),
(6, 406, 'Mcdo', 4, '07-24-2017 1:07:34 am'),
(7, 301, 'test', 3, '07-26-2017 12:50:04 am');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `r_number` int(11) NOT NULL,
  `sy_from` varchar(50) NOT NULL,
  `sy_to` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `room_id`, `subject_name`, `start_time`, `end_time`, `day`, `date`, `r_number`, `sy_from`, `sy_to`, `semester`) VALUES
(54, 7, 'CF1', '05:00 pm', '06:00 pm', 'monday', '07-31-2017 3:25:17 am', 301, '2017', '2018', 1),
(55, 7, 'Math311', '03:00 pm', '05:00 pm', 'monday', '07-31-2017 3:27:01 am', 301, '2017', '2018', 1),
(56, 7, 'IT-211', '04:00 pm', '06:00 pm', 'tuesday', '07-31-2017 4:46:09 am', 301, '2017', '2018', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `sy_from` varchar(50) NOT NULL,
  `sy_to` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `school_name`, `sy_from`, `sy_to`, `sem`) VALUES
(1, 'Holy Child College Of Davao', '2017', '2018', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sy_sem`
--

CREATE TABLE `sy_sem` (
  `id` int(11) NOT NULL,
  `sy` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL,
  `date_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sy_sem`
--
ALTER TABLE `sy_sem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sy_sem`
--
ALTER TABLE `sy_sem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
