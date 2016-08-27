-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 aug 2016 om 14:18
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
-- Tabelstructuur voor tabel `functie`
--

CREATE TABLE IF NOT EXISTS `functie` (
  `functie_id` int(3) NOT NULL,
  `functie_naam` varchar(50) NOT NULL,
  `functie_omschrijving` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `functie`
--

INSERT INTO `functie` (`functie_id`, `functie_naam`, `functie_omschrijving`) VALUES
(1, 'C# developer', 'een C# programmeur moet flink zweten'),
(2, '.NET developer', 'Zijn ware zakkenvullers!'),
(3, 'front-end developer', 'Front-end developers houden van het ''front'''),
(4, 'back-end developer', 'Back-end developers houden van de ''achterkant'''),
(5, 'Java developer', 'een Java developer kan op de eerste plaats goed javaans ''praten'''),
(6, 'project manager', 'Een project manager doet van alles wat, heeft over het algemeen ook veel last van hoofdpijn.'),
(7, 'functioneel ontwerper', 'Een functioneel ontwerper is iemand die vaak in de kroeg te vinden is, voor veelvuldig overleg.'),
(8, 'test coordinator', 'De test coordinator is vaak een baard dragende man van middelbare leeftijd.'),
(9, 'product owner', 'De product owner bepaalt in welke richting\r\ngedacht moet worden. '),
(10, 'business analist', 'De business analist houdt van analyseren , tot in den treure');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `functie`
--
ALTER TABLE `functie`
  ADD PRIMARY KEY (`functie_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `functie`
--
ALTER TABLE `functie`
  MODIFY `functie_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
