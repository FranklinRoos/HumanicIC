-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 okt 2016 om 18:14
-- Serverversie: 5.6.24
-- PHP-versie: 5.5.24

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
-- Tabelstructuur voor tabel `navadmin`
--

CREATE TABLE IF NOT EXISTS `navadmin` (
  `navadmin_id` int(2) NOT NULL,
  `navadmin_naam` varchar(30) NOT NULL,
  `navadmin_url` varchar(100) NOT NULL,
  `navadmin_show` enum('y','n') NOT NULL,
  `navadmin_parent_id` int(2) NOT NULL DEFAULT '0',
  `navadmin_auth` enum('ptr','admin') NOT NULL DEFAULT 'admin',
  `navadmin_volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `navadmin`
--

INSERT INTO `navadmin` (`navadmin_id`, `navadmin_naam`, `navadmin_url`, `navadmin_show`, `navadmin_parent_id`, `navadmin_auth`, `navadmin_volgorde`) VALUES
(1, 'Home', 'index.php', 'y', 0, 'ptr', 1),
(4, 'Query Maken(zonder Ajax)', 'application/modules/query/queryMaken.php', 'y', 0, 'admin', 5),
(5, 'navadmin', 'application/modules/navadmin/navadmin.php', 'n', 0, 'admin', 5),
(6, 'Totaal overzicht', 'application/modules/query/overzicht.php', 'y', 0, 'admin', 4),
(7, 'Query Maken(met Ajax)', 'application/modules/KandidatenQuery/pages/kandidatenSelectie.php', 'y', 0, 'admin', 7),
(8, 'Tabel Functie anpassen', 'application/modules/KandidatenQuery/pages/functies.php', 'y', 0, 'admin', 8);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `navadmin`
--
ALTER TABLE `navadmin`
  ADD PRIMARY KEY (`navadmin_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `navadmin`
--
ALTER TABLE `navadmin`
  MODIFY `navadmin_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
