-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 aug 2016 om 14:43
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
-- Tabelstructuur voor tabel `functie`
--

CREATE TABLE `functie` (
  `functie_id` int(3) NOT NULL,
  `functie_naam` varchar(50) NOT NULL,
  `functie_omschrijving` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `functie`
--

INSERT INTO `functie` (`functie_id`, `functie_naam`, `functie_omschrijving`) VALUES
(1, 'C# developer', 'Hier komt de omschrijving van de functie C# developer'),
(2, '.NET developer', 'Hier komt de omschrijving van de functie .NET developer'),
(3, 'front-end developer', 'Hier komt de omschrijving van de functie front-end developer'),
(4, 'back-end developer', 'Hier komt de omschrijving van de functie back-end developer'),
(5, 'Java developer', 'Hier komt de omschrijving van de functie Java developer'),
(6, 'project manager', 'Hier komt de omschrijving van de functie project manager'),
(7, 'functioneel ontwerper', 'Hier komt de omschrijving van de functie functioneel ontwerper'),
(8, 'test coordinator', 'Hier komt de omschrijving van de functie test coordinator'),
(9, 'product owner', 'Hier komt de omschrijving van de functie product owner'),
(99, 'Anders', '');

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
  MODIFY `functie_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
