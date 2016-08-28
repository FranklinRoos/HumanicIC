-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 aug 2016 om 14:44
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kandidaten`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_functie`
--

CREATE TABLE `user_functie` (
  `user_functie_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `functie_id` int(3) NOT NULL,
  `ervaring` int(2) NOT NULL,
  `nwFunctie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_functie`
--

INSERT INTO `user_functie` (`user_functie_id`, `user_id`, `functie_id`, `ervaring`, `nwFunctie`) VALUES
(1, 1, 5, 3, ''),
(2, 1, 3, 5, ''),
(3, 2, 1, 0, ''),
(4, 2, 2, 0, ''),
(5, 2, 9, 0, ''),
(9, 2, 5, 0, ''),
(10, 5, 2, 3, ''),
(78, 5, 4, 4, ''),
(102, 6, 1, 0, ''),
(103, 6, 4, 0, ''),
(104, 7, 1, 0, ''),
(105, 7, 4, 0, ''),
(106, 3, 6, 7, 'CEO'),
(107, 3, 1, 8, 'CEO'),
(111, 3, 3, 0, 'CEO'),
(112, 3, 7, 5, 'CEO'),
(114, 3, 5, 9, 'CEO'),
(115, 3, 99, 6, 'CEO');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `user_functie`
--
ALTER TABLE `user_functie`
  ADD PRIMARY KEY (`user_functie_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `user_functie`
--
ALTER TABLE `user_functie`
  MODIFY `user_functie_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
