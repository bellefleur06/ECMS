-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 06:30 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecms`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `barangay`, `date_added`) VALUES
(1, 'Barangay 105', '2022-03-29 19:10:09'),
(2, 'Barangay 101', '2022-03-29 19:10:19'),
(3, 'Barangay 128', '2022-03-29 19:10:28'),
(4, 'Barangay 649', '2022-03-29 19:10:36'),
(5, 'Barangay 20', '2022-03-29 19:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_types`
--

CREATE TABLE `calamity_types` (
  `id` int(11) NOT NULL,
  `calamity_type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calamity_types`
--

INSERT INTO `calamity_types` (`id`, `calamity_type`, `date_added`) VALUES
(1, 'Typhoon', '2022-03-23 21:02:55'),
(3, 'Flood', '2022-03-23 21:03:11'),
(4, 'Volcanic Eruption', '2022-03-23 21:03:28'),
(5, 'Landslide', '2022-03-23 21:03:33'),
(6, 'Fire', '2022-03-23 21:03:36'),
(7, 'Earthquake', '2022-03-27 06:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `evacuation_centers`
--

CREATE TABLE `evacuation_centers` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evacuation_centers`
--

INSERT INTO `evacuation_centers` (`id`, `center_name`, `address`, `contact_number`, `date_added`) VALUES
(1, 'Building 3', 'Barangay 128', '09653817377', '2022-03-29 19:11:27'),
(2, 'Building 18', 'Barangay 128', '09376276361', '2022-03-29 19:12:04'),
(3, 'TCI', 'Barangay 128', '09376265381', '2022-03-29 19:12:25'),
(4, 'Almario Elementary School', 'Barangay 20', '09376267518', '2022-03-29 19:12:55'),
(5, 'Baseco Evacuation Center', 'Barangay 649', '09336288123', '2022-03-29 19:30:40'),
(6, 'Barangay 105 Covered Court', 'Barangay 105', '09263765627', '2022-03-29 19:31:19'),
(7, 'Barangay 101 Covered Court', 'Barangay 101', '09363765528', '2022-03-29 19:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `evacuees`
--

CREATE TABLE `evacuees` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `barangay_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `family_head` varchar(255) NOT NULL,
  `calamity_type_id` varchar(255) NOT NULL,
  `evacuation_center_id` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evacuees`
--

INSERT INTO `evacuees` (`id`, `last_name`, `first_name`, `middle_name`, `contact_number`, `age`, `gender`, `barangay_id`, `address`, `family_head`, `calamity_type_id`, `evacuation_center_id`, `date_added`) VALUES
(1, 'Abaya', 'Christina', 'Chengco', '092763753871', '34', 'Female', '2', 'Rizal Street, Barangay Robles, La Castellana', 'Garret Abaya', '7', '7', '2022-03-29 19:36:26'),
(2, 'Barrameda', 'Donovan', '', '09376687121', '51', 'Male', '1', '328 EDSA, Pasay City, Metro Manila', 'Donovan Barrameda', '6', '6', '2022-03-29 19:38:43'),
(3, 'Abracosa', 'Tio', '', '09266276117', '25', 'Male', '3', '250 General Kalentong Street, Mandaluyong City, Metro Manila', 'Vance Abracosa', '3', '2', '2022-03-29 19:41:15'),
(4, 'Mangao', 'Aimee', '', '09837683181', '41', 'Female', '5', '36 St. Mary Avenue Corner Riverside Drive Provident Village, Marikina', 'Jerold Mangao', '5', '4', '2022-03-29 19:43:49'),
(5, 'Alonzo', 'Kristen', '', '09387281538', '13', 'Female', '4', '410 Cubao, Quezon City', 'Constantino Alonzo', '1', '5', '2022-03-29 19:45:28'),
(6, 'Romeo', 'Dominique', '', '09387648211', '44', 'Male', '2', 'Barangay Ginhawa, McArthur Highway, Malolos, Bulacan', 'Dominique Romeo', '4', '7', '2022-03-29 19:47:49'),
(7, 'Roces', 'Roderiga', 'Malita', '09326786211', '54', 'Female', '1', 'Omega Gold Building, San Vicente Pili', 'Luke Roces', '7', '6', '2022-03-29 19:50:11'),
(8, 'Baylosis', 'Benjamin', '', '09376876348', '22', 'Male', '3', 'Suite 1824 Tyrant Plaza, Orient Street, Manila', 'Oswaldo Baylosis', '6', '1', '2022-03-29 19:52:22'),
(9, 'Amerol', 'Brendan', '', '09385633872', '47', 'Male', '5', 'Malawaan Parek, Argonaut Highway, Subic Bay Freeport Zone, Zambales', 'Brendan Amerol', '3', '4', '2022-03-29 19:54:14'),
(10, 'Macalinao', 'Lorena', '', '09367387683', '53', 'Female', '4', '1260-C Cardona St. Cor. Osmena Valenzuela 1200, Makati City, Metro Manila', 'Rodrigo Macalinao ', '5', '5', '2022-03-29 19:56:59'),
(11, 'Baylosis', 'Dulce', '', '09263752611', '18', 'Female', '2', 'Suite 1824 Tyrant Plaza, Orient Street, Manila', 'Oswaldo Baylosis', '1', '7', '2022-03-30 07:09:41'),
(12, 'Rubio', 'Cayla', '', '09263854811', '27', 'Female', '1', 'Gomez Street corner Salazar Street, Barangay 105, Tacloban, Leyte', 'Deonzon Rubio', '4', '6', '2022-03-30 07:29:47'),
(13, 'Lansangan', 'Leonor', '', '09387875281', '23', 'Female', '3', 'South Supermarket, Filinvest Avenue, Filinvest Corporate City, Agno', 'Kolby Lansangan', '7', '3', '2022-03-30 07:33:24'),
(14, 'Fajardo', 'Bryce', '', '09376537651', '37', 'Male', '5', 'ROOM 112 Phoenix Building Recoleto Street 1000', 'Bryce Fajardo', '6', '4', '2022-03-30 07:37:19'),
(15, 'Padilla', 'Jackeline', '', '09263541811', '36', 'Female', '4', 'San Jose Street, Dunao, Ligao, Albay', 'Tomas Padilla', '3', '5', '2022-03-30 07:44:45'),
(16, 'Abaya', 'Garret', '', '09327487523', '35', 'Male', '2', 'Rizal Street, Barangay Robles, La Castellana', 'Garret Abaya', '7', '7', '2022-03-30 07:46:57'),
(17, 'Abracosa', 'Vance ', '', '09265417165', '35', 'Male', '3', '250 General Kalentong Street, Mandaluyong City, Metro Manila', 'Vance Abracosa', '3', '2', '2022-03-30 07:48:43'),
(18, 'Mangao', 'Jerold', '', '09276387471', '42', 'Male', '5', '36 St. Mary Avenue Corner Riverside Drive Provident Village, Marikina', 'Jerold Mangao', '5', '4', '2022-03-30 07:50:41'),
(19, 'Alonzo', 'Constantino', '', '0924712871', '44', 'Male', '4', '410 Cubao, Quezon City', 'Constantino Alonzo', '1', '5', '2022-03-30 07:52:03'),
(20, 'Roces', 'Luke', '', '09421384511', '65', 'Male', '1', 'Omega Gold Building, San Vicente Pili', 'Luke Roces', '7', '6', '2022-03-30 07:53:28'),
(21, 'Baylosis', 'Oswaldo', '', '09237542841', '40', 'Male', '3', 'Suite 1824 Tyrant Plaza, Orient Street, Manila', 'Oswaldo Baylosis', '6', '1', '2022-03-30 07:55:52'),
(22, 'Macalinao', 'Rodrigo', '', '09274618724', '54', 'Male', '4', '1260-C Cardona St. Cor. Osmena Valenzuela 1200, Makati City, Metro Manila', 'Rodrigo Macalinao', '5', '5', '2022-03-30 07:57:29'),
(23, 'Rubio', 'Deonzon', '', '09146145211', '38', 'Male', '1', 'Gomez Street corner Salazar Street, Barangay 105, Tacloban, Leyte', 'Deonzon Rubio', '4', '6', '2022-03-30 07:58:59'),
(24, 'Lansangan', 'Kolby', '', '09162547152', '33', 'Male', '3', 'South Supermarket, Filinvest Avenue, Filinvest Corporate City, Agno', 'Kolby Lansangan', '7', '3', '2022-03-30 08:02:01'),
(25, 'Padilla', 'Tomas', '', '09274712197', '37', 'Male', '4', 'San Jose Street, Dunao, Ligao, Albay', 'Tomas Padilla', '3', '5', '2022-03-30 08:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `lgu_settings`
--

CREATE TABLE `lgu_settings` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `website_name` varchar(255) NOT NULL,
  `facebook_page` varchar(255) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lgu_settings`
--

INSERT INTO `lgu_settings` (`id`, `city`, `contact_number`, `email_address`, `website_name`, `facebook_page`, `date_modified`) VALUES
(1, 'San Pedro City, Laguna', '09438165935', 'ecmssanpedro@gmail.com', 'ecms@sanpedrocity.com', 'ECMS - San Pedro Official', '2022-03-27 09:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `account_category` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `designation`, `contact_number`, `account_category`, `username`, `password`, `status`, `registration_date`) VALUES
(1, 'Patrick Ail Bandola', 'Healthcare Worker', '09503638031', 'Admin', 'admin', '$2y$10$iUK5iqHs3e6B1OAsQEbz3uEFQzDRG./4U766dapMB5CrxWGaJYo9e', '1', '2022-03-29 15:39:50'),
(2, 'John Doe', 'Helper', '09373878721', 'Encoder', 'staff', '$2y$10$G7E3V7eN972fyIEmOp5rdO.Y4bX8cpI9b7gzrcwULziqCrfVrAqFW', '1', '2022-03-29 19:58:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calamity_types`
--
ALTER TABLE `calamity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evacuation_centers`
--
ALTER TABLE `evacuation_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evacuees`
--
ALTER TABLE `evacuees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lgu_settings`
--
ALTER TABLE `lgu_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `calamity_types`
--
ALTER TABLE `calamity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `evacuation_centers`
--
ALTER TABLE `evacuation_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `evacuees`
--
ALTER TABLE `evacuees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lgu_settings`
--
ALTER TABLE `lgu_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
