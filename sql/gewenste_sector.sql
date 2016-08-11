-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 11 aug 2016 om 05:03
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `kandidaten`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gewenste_sector`
--

CREATE TABLE IF NOT EXISTS `gewenste_sector` (
`gewenste_sector_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `sector_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gewenste_sector`
--

INSERT INTO `gewenste_sector` (`gewenste_sector_id`, `user_id`, `sector_id`) VALUES
(25, 3, 3),
(28, 5, 1),
(29, 5, 4),
(32, 2, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gewenste_sector`
--
ALTER TABLE `gewenste_sector`
 ADD PRIMARY KEY (`gewenste_sector_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gewenste_sector`
--
ALTER TABLE `gewenste_sector`
MODIFY `gewenste_sector_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
