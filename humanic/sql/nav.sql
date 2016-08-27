-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 aug 2016 om 11:24
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
-- Tabelstructuur voor tabel `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `nav_id` int(2) NOT NULL,
  `nav_naam` varchar(240) NOT NULL,
  `nav_url` varchar(80) NOT NULL,
  `nav_place` enum('header','footer') NOT NULL,
  `nav_show` enum('y','n') NOT NULL,
  `nav_parent_id` int(2) NOT NULL DEFAULT '0',
  `nav_taal` enum('nl','en') NOT NULL DEFAULT 'nl',
  `nav_auth` enum('usr','admin','ptr','elm') NOT NULL DEFAULT 'usr',
  `volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `nav`
--

INSERT INTO `nav` (`nav_id`, `nav_naam`, `nav_url`, `nav_place`, `nav_show`, `nav_parent_id`, `nav_taal`, `nav_auth`, `volgorde`) VALUES
(1, '<div class="nav">Home</div>', 'index.php', 'header', 'y', 0, 'nl', 'usr', 1),
(2, 'Registratie/Login', 'application/modules/humanic-portal/login.php', 'header', 'n', 0, 'nl', 'usr', 2),
(3, 'Werkgevers', 'application/modules/humanic-portal/werkgever.php', 'header', 'n', 0, 'nl', 'usr', 5),
(4, 'Contact', 'http://humanicdevelopment.com/index.html#content5-12', 'footer', 'n', 0, 'nl', 'usr', 8),
(5, 'Over ons', 'http://humanicdevelopment.com/index.html#content5-12', 'header', 'y', 0, 'nl', 'usr', 9),
(6, 'Kandidaat-Registratie', 'application/modules/humanic-portal/register.php', 'header', 'y', 0, 'nl', 'usr', 3),
(7, 'Algemene Voorwaarden', 'alv.php', 'footer', 'n', 0, 'nl', 'usr', 10),
(8, 'Disclaimer', 'disclaimer.php', 'footer', 'n', 0, 'nl', 'usr', 11),
(9, 'Privacy Beleid', 'privacy.php', 'footer', 'n', 0, 'nl', 'usr', 12),
(10, 'Kandidaat-Login', 'application/modules/humanic-portal/login.php', 'header', 'y', 0, 'nl', 'usr', 4),
(11, 'Werkgever-Registratie', 'application/modules/humanic-portal/werkgever.php', 'header', 'y', 3, 'nl', 'usr', 6),
(12, 'Werkgever-Inloggen', 'application/modules/humanic-portal/login.php', 'header', 'n', 3, 'nl', 'usr', 7),
(13, 'ADMIN', 'application/modules/admin/indexAdmin.php', 'header', 'y', 0, 'nl', 'admin', 13),
(20, '<div class=adres>Programmeurs:</div> F.Roos(franklin_roos@hotmail.com), T v Hout(blackhout@upcmail.nl), B.Kijlstra(bartkijlstra@gmail.com), S.Unal(selahattin@xs4all.nl), R.de Wit(r.dewit@outlook.com)', '', 'footer', 'n', 0, 'nl', 'usr', 18),
(21, 'Mijn Gegevens', 'application/modules/humanic-portal/kandidaat.php', 'header', 'y', 0, 'nl', 'usr', 15),
(22, '<div class=adres1><div class=adres>Adres Gegevens</div><br/><div class=adresR>H.E.J. Wenkenbachweg 123<br/>1096 AM Amsterdam Nederland</div>\r\n\r\n', '', 'footer', 'y', 0, 'nl', 'usr', 17),
(23, '<div class=adres1><div class=adres>Contact</div><br/>\r\n<div class=adresR>Email: info@Humanic.cloud<br/>\r\nTel: +31(0)852736963</div>', '', 'footer', 'y', 0, 'nl', 'usr', 18),
(24, '', '', '', '', 0, 'nl', 'usr', 0),
(25, '<div class=nav>Home</div>', 'index.php', 'header', 'y', 0, 'nl', 'elm', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`nav_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `nav`
--
ALTER TABLE `nav`
  MODIFY `nav_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
