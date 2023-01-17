-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 10:55 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `patient`, `date`, `timeslot`, `status`, `created_at`) VALUES
(1, 2, 2, '2023-01-21', '09:00:00', 'pending', '2023-01-17 08:23:14'),
(2, 2, 2, '2023-01-20', '11:00am - 12:00pm', 'pending', '2023-01-17 08:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `payment_status` varchar(10) NOT NULL,
  `invoice_title` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `doctor_id`, `patient_id`, `payment_method`, `payment_status`, `invoice_title`, `amount`, `created_at`) VALUES
(1, 2, 2, 'cash', 'paid', 'testing invoice', 300, '2023-01-17 09:44:58'),
(2, 2, 3, 'card', 'unpaid', 'testing invoice', 20, '2023-01-17 09:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `trade_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `doctor_id`, `trade_name`, `generic_name`, `note`) VALUES
(1, 2, 'burt', 'brophylica', 'testing drugs addation '),
(2, 2, 'comma', 'florotiolit', 'Lorem ipsum...');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `date` date NOT NULL,
  `drug_id` int(11) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `frequency` varchar(30) NOT NULL,
  `test_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `doctor_id`, `patient`, `date`, `drug_id`, `dosage`, `frequency`, `test_id`, `content`) VALUES
(1, 2, 3, '2023-01-11', 2, '1x a day', '5wks', 2, 'testing prescriptions!?'),
(2, 2, 3, '2023-01-29', 1, '1x a day', '5wks', 1, 'bot bot bite');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `doctor_id`, `test_name`, `description`) VALUES
(1, 2, 'worm', 'vaccines!?'),
(2, 2, 'volks', 'test for{{not}}');

-- --------------------------------------------------------

--
-- Table structure for table `user_doctor`
--

CREATE TABLE `user_doctor` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_doctor`
--

INSERT INTO `user_doctor` (`id`, `username`, `email`, `password`, `phone_no`, `address`) VALUES
(1, 'burt', 'burt@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+254724772046', '10300, 10200'),
(2, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '+254724772046', '10300, 10200'),
(3, 'test1', '0', '5a105e8b9d40e1329780d62ea2265d8a', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_patient`
--

CREATE TABLE `user_patient` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bloodgroup` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_patient`
--

INSERT INTO `user_patient` (`id`, `doctor_id`, `name`, `email`, `phone_no`, `birthday`, `gender`, `bloodgroup`, `address`, `weight`, `height`) VALUES
(1, 2, 'admin test edit', 'admintest@gmail.com', '+5247892023', '2004-06-18', 'Female', 'O+', '1356-66 tailerwind', '56kg', '123cm'),
(2, 2, 'admin test', 'admintest@gmail.com', '+5247892023', '2004-06-18', 'Female', 'O+', '1356-66 tailerwind', '56kg', '123cm'),
(3, 2, 'joseph', 'joseph@gmail.com', '0724586954', '2016-07-21', 'Male', 'B-', '12-34 gold', '59kg', '120cm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_doctor`
--
ALTER TABLE `user_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_patient`
--
ALTER TABLE `user_patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_doctor`
--
ALTER TABLE `user_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_patient`
--
ALTER TABLE `user_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
