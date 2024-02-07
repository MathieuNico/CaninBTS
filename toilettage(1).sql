-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2024 at 08:57 AM
-- Server version: 10.11.4-MariaDB-1~deb12u1
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toilettage`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `breed` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `is_actif` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `breed`, `age`, `weight`, `height`, `comment`, `customer_id`, `is_actif`) VALUES
(1, 'Isla12', 'Labrador Retriever ', 5, 6050, 152, '/test4', 1, '0'),
(2, 'Milo', 'German Shepherd', 4, 57, 150, 'Cute dog', 2, ''),
(3, 'Aurora', 'Golden Retriever', 8, 45, 100, '/', 3, ''),
(4, 'Zephyr', 'Bulldog', 1, 56, 120, '/', 56, ''),
(27, 'Kiki', 'Labrador', 45, 487, 457, 'Test', 56, '');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `is_paid` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date_start`, `date_end`, `is_paid`, `user_id`, `animal_id`, `service_id`) VALUES
(1, '2023-11-15 14:00:00', '2023-11-15 15:00:00', 0, 4, 3, 1),
(2, '2024-01-30 10:00:00', '2024-01-30 11:30:00', 1, 2, 1, 2),
(3, '2024-01-12 15:00:00', '2024-01-12 16:00:00', 1, 5, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`user_id`, `service_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 1),
(5, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `postal_adress` varchar(45) DEFAULT NULL,
  `commentary` longtext DEFAULT NULL,
  `is_actif` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `mail`, `telephone`, `postal_adress`, `commentary`, `is_actif`) VALUES
(1, 'Emily Hargel 15 26', 'Johnson test', 'emily.johnson@example.com', '1024665457', '14 rue des fleurs', '', ''),
(2, 'Daniel45', 'Wilson', 'daniel.wilson@example.com', '0245876954', '456 Elm Avenue, Another City, USA', '', ''),
(3, 'Olivia', 'Smith', 'olivia.smith@example.com', '0354876152', '789 Oak Road, Somewhere, USA', '', ''),
(4, 'Samuel', 'Taylor', 'samuel.taylor@example.com', '0345812654', '567 Pine Lane, Anyville, USA', '', ''),
(56, NULL, NULL, NULL, '0645789654', 'Rue des tilleuils', 'Test', ''),
(62, 'Tran', 'Jérémie', 'test@mail.fr', '0548979875', 'rue des tilleuil', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`) VALUES
(1, 'toilettage', 20),
(2, 'découpage', 15.8),
(3, 'vaccination', 19),
(4, 'shampoing', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `postal_adress` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `firstname`, `lastname`, `telephone`, `mail`, `postal_adress`, `mdp`) VALUES
(1, 1, 'Pierre', 'Dupont', '0123456789', 'pierre.dupont@example.com', '123 Rue de la Liberté', 'P@ssw0rd1'),
(2, 0, 'Sophie', 'Martin', '0612345678', 'sophie.martin@email.fr', '45 Rue de la Paix', 'Secure123!'),
(3, 0, 'Jean', 'Dubois', '0456789012', 'jean.dubois@email.fr', '789 Avenue des Champs-Élysées', 'Pass1234'),
(4, 0, 'Marie', 'Leclerc', '0345678001', 'marie.leclerc@example.com', '567 Rue de la République', 'SecretPwd'),
(5, 0, 'Olivier', 'Laurent', '0234567890', 'olivier.laurent@email.fr', '234 Boulevard Saint-Germain', 'MyP@ssw0rd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD PRIMARY KEY (`user_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `capabilities`
--
ALTER TABLE `capabilities`
  ADD CONSTRAINT `capabilities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `capabilities_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
