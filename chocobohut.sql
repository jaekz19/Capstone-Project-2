-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2017 at 06:31 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chocobohut`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Potion', '50', 'Restores 100 HP', '../../images/items/potion.png'),
(2, 'Hi-Potion', '300', 'Restores 500 HP', '../../images/items/hi-potion.png'),
(3, 'X-Potion', '900', 'Fully restores HP', '../../images/items/x-potion.png'),
(4, 'Ether', '150', 'Restores 100 MP', '../../images/items/ether.png'),
(5, 'Turbo Ether', '1100', 'Fully restores MP', '../../images/items/turbo-ether.png'),
(6, 'Elexir', '1700', 'Fully restores HP and MP', '../../images/items/elixir.png'),
(7, 'Mega Elixir', '2300', 'Fully restores All Party\'s HP and MP', '../../images/items/mega-elixir.png'),
(8, 'Phoenix Down', '300', 'Revive KO\'d ally with 1/4 of it\'s max HP', '../../images/items/phoenix-down.png'),
(9, 'Antidote', '80', 'Cures Poison status', '../../images/items/antidote.png'),
(10, 'Eye Drop', '50', 'Cures Darkness status', '../../images/items/eye-drop.png'),
(11, 'Soft', '150', 'Cures Petrify status', '../../images/items/soft.png'),
(12, 'Maiden Kiss', '150', 'Cures Voodoo status', '../../images/items/maidenkiss.png'),
(13, 'Cornucopia', '150', 'Cures Mini status', '../../images/items/cornucopia.png'),
(14, 'Echo Screen', '100', 'Cures Silence status', '../../images/items/echoscreen.png'),
(15, 'Hyper', '100', 'Cures Sadness status', '../../images/items/hyper.png'),
(16, 'Tranquilizer', '100', 'Cures Fury status', '../../images/items/tranquilizer.png'),
(17, 'Remedy', '1000', 'Cures All Abnormal status', '../../images/items/remedy.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gil` decimal(4,0) DEFAULT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `gil`, `role`) VALUES
(7, 'admin', 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4', NULL, 'admin'),
(8, 'john', 'a027184a55211cd23e3f3094f1fdc728df5e0500', '9999', 'user'),
(10, 'paul', '828c1a17681e8566a17a1a4801ea67306010b273', '9049', 'user'),
(11, 'jaekz', '828c1a17681e8566a17a1a4801ea67306010b273', '9999', 'user'),
(14, 'guest1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '9999', 'user'),
(15, 'guest2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '9999', 'user'),
(16, 'guest3', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '9999', 'user'),
(17, 'guest4', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '9999', 'user'),
(18, 'guest5', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '9999', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `quantity` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id`, `user_id`, `items_id`, `quantity`) VALUES
(4, 8, 2, '66'),
(13, 8, 6, '2'),
(14, 8, 7, '3'),
(15, 8, 5, '7'),
(16, 8, 10, '3'),
(17, 8, 15, '1'),
(18, 8, 8, '3'),
(19, 8, 11, '6'),
(20, 8, 9, '99'),
(21, 8, 4, '1'),
(22, 8, 13, '1'),
(23, 8, 16, '1'),
(24, 11, 8, '4'),
(25, 11, 3, '1'),
(26, 14, 14, '1'),
(27, 14, 7, '2'),
(28, 10, 14, '59'),
(29, 10, 4, '52'),
(30, 14, 1, '1'),
(31, 14, 2, '2'),
(32, 10, 3, '2'),
(33, 10, 6, '64'),
(34, 10, 9, '99'),
(35, 10, 12, '99'),
(36, 10, 17, '99'),
(38, 8, 1, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `items_id` (`items_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_items`
--
ALTER TABLE `user_items`
  ADD CONSTRAINT `user_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_items_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
