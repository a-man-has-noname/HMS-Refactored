-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 09:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL,
  `app_pname` text NOT NULL,
  `date_set` date NOT NULL,
  `app_date` date NOT NULL,
  `app_type` text NOT NULL,
  `status` text NOT NULL,
  `doc_assigned` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `app_pname`, `date_set`, `app_date`, `app_type`, `status`, `doc_assigned`) VALUES
(1, 'Nick Quaye Preston', '2020-06-09', '2020-07-16', 'Check Up', 'Approved', 'Farid Ali Issifu Kojo'),
(2, 'Farid Ali Issifu', '2020-06-09', '2020-06-02', 'Check Up', 'Approved', 'Divine Osagyefo Kwame Nkrumah'),
(3, 'Farid Ali Issifu', '2020-06-09', '2020-06-05', 'Check Up', 'Approved', 'Farid Ali Issifu Kojo'),
(4, 'Nick Quaye Preston', '2020-06-09', '2020-06-04', 'I am not sure', 'Approved', 'Jeff Seinaa');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `doc_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `tin_no`, `employee_id`, `birthdate`, `status`, `gender`, `address`, `doc_type`) VALUES
(13, 'Farid Ali Issifu Kojo', 'alifarid62868@gmail.com', 244685111, '0194bd61d326e4e1fcc533a9489525eb', 'Doctor', '12345', 25367785, '2020-11-06', 'Married', 'Male', 'Kumasi oo', 'Surgeon'),
(16, 'Divine Osagyefo Kwame Nkrumah', 'doctor@gmail.com', 483726172, 'c22cfd0872d2a458cf8fe86d8b35eb14', 'Doctor', '1232323', 20220194, '2020-06-01', 'Married', 'Male', 'Kumasi', 'Physiotherapist '),
(17, 'Benefo Berma GH', 'benefo@gmail.com', 245675324, '13eb313d5aa3485773f3b80d778197d6', 'Doctor', '2312434254', 14825010, '1999-11-22', 'Married', 'Male', 'Taadi', 'EYE'),
(18, 'Jeff Seinaa', 'jeff@gmail.com', 274517383, 'c59475be05bf3f69dbdaa7009a8d7d37', 'Doctor', '24123312355', 83603680, '1997-01-27', 'Single', 'Male', 'Daaban', 'Heart'),
(19, 'Weytey Bells', 'bells@gmail.com', 236261728, 'bb5ab76517fa4c39ef00a46aaf449f2d', 'Doctor', '12324534534', 74680057, '1998-07-23', 'Married', 'Male', 'Accra Zongo', 'Chest');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `tin_no`, `employee_id`, `birthdate`, `status`, `gender`, `address`) VALUES
(4, 'Farid Ali Issifu', 'alifarid62868@gmail.com', 0, '0194bd61d326e4e1fcc533a9489525eb', 'Doctor', '12345', 25367785, '0000-00-00', '', '', ''),
(5, 'Farid Ali Issifu', 'receptionist@gmail.com', 0, '1bc2ca0540324a2300d023b5512e28cc', 'Receptionist', '1234567', 47746779, '0000-00-00', '', '', ''),
(6, 'Farid Ali Issifu', 'pharm@gmail.com', 0, '010bae55009aa4addf424ff16a161ca5', 'Pharmacist', '1232321412', 51643284, '2020-06-03', 'Married', 'Female', 'Kumasi'),
(9, 'Divine Osagyefo Kwame Nkrumah', 'doctor@gmail.com', 235748293, 'c22cfd0872d2a458cf8fe86d8b35eb14', 'Doctor', '1232323', 20220194, '2020-06-01', 'Married', 'Male', 'Kumasi'),
(10, 'Yaa Abena Fowaa', 'nurse@gmail.com', 2147483647, 'f3c6920940b5f993bf5ebe58f93143dd', 'Nurse', '123123', 11342781, '2020-06-03', 'Single', 'Female', 'USA Minneapolis '),
(11, 'Yawaa Kyei', 'yaw@gmail.com', 374829201, 'ba39f9a3adfaaa82c0faca5354145e19', 'Pharmacist', '1231323', 30678857, '1995-02-09', 'Married', 'Female', 'Kumasi'),
(12, 'Benefo Berma GH', 'benefo@gmail.com', 245675324, '13eb313d5aa3485773f3b80d778197d6', 'Doctor', '2312434254', 14825010, '1999-11-22', 'Married', 'Male', 'Taadi'),
(13, 'Jeff Seinaa', 'jeff@gmail.com', 274517383, 'c59475be05bf3f69dbdaa7009a8d7d37', 'Doctor', '24123312355', 83603680, '1997-01-27', 'Single', 'Male', 'Daaban'),
(14, 'Weytey Bells', 'bells@gmail.com', 236261728, 'bb5ab76517fa4c39ef00a46aaf449f2d', 'Doctor', '12324534534', 74680057, '1998-07-23', 'Married', 'Male', 'Accra Zongo'),
(15, 'Ben Foster', 'ben@gmail.com', 245262721, 'a6da268c378e8557a24ce0305a0e7183', 'Pharmacist', '12342', 58735648, '1999-12-31', 'Single', 'Male', 'Tamale'),
(16, 'Bossman Ahenfo', 'bossman@gmail.com', 352617832, '1af5cff6e615d3ffd2ffbdfb6fe800bd', 'Pharmacist', '324563344', 51366000, '1996-01-01', 'Married', 'Male', 'Volta'),
(17, 'Esther Gamatsu', 'esthergamatsu@gmail.com', 264324563, '6b83df03e0de4198cdbc9402d25f3e04', 'Pharmacist', '452312323', 22272875, '1983-07-06', 'Married', 'Male', 'Ahodwo'),
(18, 'Gerald Annan Stalker', 'gerald@gmail.com', 234124253, '4709f416d08c82741920fba0cfb89ce0', 'Nurse', '2343213', 72089052, '1995-06-09', 'Married', 'Male', 'konongo'),
(19, 'Phanos Derrick', 'phanos@yahoo.co.uk', 123456789, '1b35f02e309f929d90b505277a8f14a5', 'Nurse', '5675344234', 98130459, '2020-06-17', 'Married', 'Male', 'Kubo'),
(20, 'Charles Awuche', 'charles@gmail.com', 234532533, '0f4150407b5e514e3a51f6cdb37b70cb', 'Nurse', '56780752', 95979754, '2006-03-02', 'Married', 'Male', 'Kumasi'),
(21, 'Keziah Poop Adjei', 'keziah@gmail.com', 546732123, '6fdc5c0ba08f8254bbb27d4f54e3e48b', 'Nurse', '23454231', 33019644, '1995-07-05', 'Single', 'Female', 'Ejisu');

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `tin_no`, `employee_id`, `birthdate`, `status`, `gender`, `address`) VALUES
(2, 'Yaa Abena Fowaa', 'nurse@gmail.com', 2147483647, 'f3c6920940b5f993bf5ebe58f93143dd', 'Nurse', '123123', 11342781, '2020-06-03', 'Single', 'Female', 'USA Minneapolis '),
(3, 'Gerald Annan Stalker', 'gerald@gmail.com', 234124253, '4709f416d08c82741920fba0cfb89ce0', 'Nurse', '2343213', 72089052, '1995-06-09', 'Married', 'Male', 'konongo'),
(4, 'Phanos Derrick', 'phanos@yahoo.co.uk', 123456789, '1b35f02e309f929d90b505277a8f14a5', 'Nurse', '5675344234', 98130459, '2020-06-17', 'Married', 'Male', 'Kubo'),
(5, 'Charles Awuche', 'charles@gmail.com', 234532533, '0f4150407b5e514e3a51f6cdb37b70cb', 'Nurse', '56780752', 95979754, '2006-03-02', 'Married', 'Male', 'Kumasi'),
(6, 'Keziah Poop Adjei', 'keziah@gmail.com', 546732123, '6fdc5c0ba08f8254bbb27d4f54e3e48b', 'Nurse', '23454231', 33019644, '1995-07-05', 'Single', 'Female', 'Ejisu');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `IDType` varchar(255) NOT NULL,
  `IDNumber` int(255) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `bp` int(255) NOT NULL,
  `temp` int(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `height` int(255) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `report` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `IDType`, `IDNumber`, `birthdate`, `status`, `gender`, `address`, `bp`, `temp`, `weight`, `height`, `bloodtype`, `symptoms`, `report`) VALUES
(13, 'Nick Quaye Preston', 'nick@gmail.com', 247234342, '6d60afe612d3479ace8e525fecd9f779', 'patient', 'NHIS', 3423, '1999-06-01', 'Married', 'Male', 'Accra', 23, 23, 234, 55, 'A+', 'He is mad in very complexion ', 'He needs help '),
(14, 'Farid Ali Issifu', 'alifarid62868@gmail.com', 0, '0194bd61d326e4e1fcc533a9489525eb', 'patient', 'NHIS', 12342233, '1999-11-01', 'Single', 'Male', 'P. O. Box 12962', 12, 24, 45, 546, '0-', 'high temp', 'Extreme help'),
(15, 'Johnny Cake', 'johnny@gmail.com', 0, '297cadd113f19c58f40ae7c01ced68fa', 'patient', 'NHIS', 1223232311, '1999-01-01', 'Married', 'Male', 'Kumasi', 0, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `tin_no`, `employee_id`, `birthdate`, `status`, `gender`, `address`) VALUES
(2, 'Farid Ali Issifu', 'pharm@gmail.com', 244685111, '010bae55009aa4addf424ff16a161ca5', 'Pharmacist', '1232321412', 51643284, '2020-06-03', 'Married', 'Female', 'Kumasi'),
(3, 'Yaw Kyei', 'yaw@gmail.com', 12345678, 'ba39f9a3adfaaa82c0faca5354145e19', 'Pharmacist', '1231323', 30678857, '1997-04-10', 'Married', 'Male', 'Kumasi'),
(4, 'Ben Foster', 'ben@gmail.com', 245262721, 'a6da268c378e8557a24ce0305a0e7183', 'Pharmacist', '12342', 58735648, '1999-12-31', 'Single', 'Male', 'Tamale'),
(5, 'Bossman Ahenfo', 'bossman@gmail.com', 352617832, '1af5cff6e615d3ffd2ffbdfb6fe800bd', 'Pharmacist', '324563344', 51366000, '1996-01-01', 'Married', 'Male', 'Volta'),
(6, 'Esther Gamatsu', 'esthergamatsu@gmail.com', 264324563, '6b83df03e0de4198cdbc9402d25f3e04', 'Pharmacist', '452312323', 22272875, '1983-07-06', 'Married', 'Male', 'Ahodwo');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `presc_id` int(11) NOT NULL,
  `pres_details` varchar(1000) NOT NULL,
  `pat_adminis_to` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `pres_date` date NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`presc_id`, `pres_details`, `pat_adminis_to`, `phone_no`, `pres_date`, `doc_name`, `doc_id`) VALUES
(1, 'haemoglobl=in', 'Nick Quaye Preston', 0, '2020-06-03', '', 0),
(2, 'aduro no asa', 'Farid ali Issifu', 0, '2020-06-01', '', 0),
(3, 'Para X 28', 'Nick Quaye Preston', 0, '2019-06-01', '', 0),
(4, 'Para x20\r\n6days ', 'Farid Ali Issifu', 0, '2020-06-10', 'Farid Ali Issifu Kojo', 13),
(5, 'haemoglobin 6\r\n12 days\r\nnew  patient', 'Farid Ali Issifu', 0, '2020-06-10', 'Farid Ali Issifu Kojo', 13);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `AccountType` text NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `name`, `email`, `phone_no`, `password`, `AccountType`, `tin_no`, `employee_id`, `birthdate`, `status`, `gender`, `address`) VALUES
(1, 'Farid Ali Issifu', 'receptionist@gmail.com', 0, '1bc2ca0540324a2300d023b5512e28cc', 'Receptionist', '1234567', 47746779, '0000-00-00', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`presc_id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `presc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
