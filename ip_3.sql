-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 03. dub 2022, 14:15
-- Verze serveru: 10.4.17-MariaDB
-- Verze PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `ip_3`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `wage` int(11) NOT NULL DEFAULT 0,
  `room` int(11) DEFAULT NULL,
  `login` varchar(60) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `remember_token` varchar(60) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `surname`, `job`, `wage`, `room`, `login`, `password`, `remember_token`, `admin`) VALUES
(1, 'František', 'Netěsný', 'ředitel', 65000, 1, NULL, NULL, NULL, 0),
(3, 'Alena', 'Netěsná', 'ekonomka', 42000, 5, NULL, NULL, NULL, 0),
(4, 'Jiřina', 'Hamáčková', 'ekonomka', 32000, 5, NULL, NULL, NULL, 0),
(5, 'Stanislav', 'Lorenc', 'skladník', 14000, 8, NULL, NULL, NULL, 0),
(6, 'Martina', 'Marková', 'skladnice', 14500, 8, NULL, NULL, NULL, 0),
(7, 'Tomáš', 'Kalousek', 'technik', 23000, 7, NULL, NULL, NULL, 0),
(8, 'Jindřich', 'Holzer', 'technik', 22000, 7, NULL, NULL, NULL, 0),
(9, 'Alena', 'Krátká', 'technik', 24000, 7, NULL, NULL, NULL, 0),
(10, 'Stanislav', 'Janovič', 'technik', 22000, 7, NULL, NULL, NULL, 0),
(11, 'Milan', 'Steiner', 'mistr', 29000, 7, NULL, NULL, NULL, 0),
(14, 'Jan', 'Volhejn', 'pracovnik', 0, NULL, 'Admin', '$2y$10$TXegcXgiRZcFAnToKmiE6uDbCgO2CSmLp/iOrINP0cBwZ.lPqw9vG', 'u97YmL1uskOaftB0A9zsTd2gUG1TwKoLBDnCiVFnYGMvoZBFYHhVqiqDpk5K', 1),
(15, 'Pardubický', 'Kraťas', 'Soutěžící', 10000, NULL, 'pardubicky-kratas', '$2y$10$TXegcXgiRZcFAnToKmiE6uDbCgO2CSmLp/iOrINP0cBwZ.lPqw9vG', NULL, 0),
(16, 'Pardubický', 'Kraťas', NULL, 0, NULL, 'pardubicky-kratas1', '$2y$10$TXegcXgiRZcFAnToKmiE6uDbCgO2CSmLp/iOrINP0cBwZ.lPqw9vG', NULL, 0),
(17, 'Pardubický kraťas', 'Volhejn', 'pracovnik', 0, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `key`
--

CREATE TABLE `key` (
  `key_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `key`
--

INSERT INTO `key` (`key_id`, `employee`, `room`) VALUES
(1, 1, 1),
(19, 1, 2),
(20, 1, 3),
(21, 1, 4),
(22, 1, 5),
(23, 1, 6),
(16, 1, 7),
(17, 1, 8),
(18, 1, 11),
(46, 3, 1),
(47, 3, 2),
(6, 3, 5),
(35, 3, 6),
(48, 4, 2),
(7, 4, 5),
(36, 4, 6),
(38, 5, 6),
(9, 5, 8),
(50, 5, 11),
(39, 6, 6),
(10, 6, 8),
(51, 6, 11),
(37, 7, 6),
(8, 7, 7),
(52, 7, 11),
(31, 8, 6),
(2, 8, 7),
(53, 8, 11),
(32, 9, 6),
(3, 9, 7),
(54, 9, 11),
(33, 10, 6),
(4, 10, 7),
(55, 10, 11),
(49, 11, 2),
(34, 11, 6),
(5, 11, 7),
(56, 11, 11),
(57, 14, 11),
(58, 17, 1),
(59, 17, 6),
(60, 17, 7),
(61, 17, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `no` varchar(15) COLLATE utf8mb4_czech_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `room`
--

INSERT INTO `room` (`room_id`, `no`, `name`, `phone`) VALUES
(1, '101', 'Ředitelna', '2292'),
(2, '102', 'Kuchyňka', '2293'),
(3, '104', 'Zasedací místnost', '2294'),
(4, '201', 'Xerox', '2296'),
(5, '202', 'Ekonomické', '2295'),
(6, '203', 'Toalety', NULL),
(7, '001', 'Dílna', '2241'),
(8, '002', 'Sklad', '2243'),
(11, '003', 'Šatna', NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `room` (`room`);

--
-- Indexy pro tabulku `key`
--
ALTER TABLE `key`
  ADD PRIMARY KEY (`key_id`),
  ADD UNIQUE KEY `employee_room` (`employee`,`room`),
  ADD KEY `room` (`room`);

--
-- Indexy pro tabulku `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `no` (`no`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `key`
--
ALTER TABLE `key`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pro tabulku `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`room`) REFERENCES `room` (`room_id`);

--
-- Omezení pro tabulku `key`
--
ALTER TABLE `key`
  ADD CONSTRAINT `key_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `key_ibfk_2` FOREIGN KEY (`room`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
