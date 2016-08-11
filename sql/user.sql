-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 aug 2016 om 15:03
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
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL,
  `user_inlognaam` varchar(30) NOT NULL,
  `user_wachtwoord` varchar(50) NOT NULL,
  `user_authorisatie` enum('usr','admin','ptr') NOT NULL DEFAULT 'usr',
  `user_email` varchar(80) NOT NULL,
  `user_activ` enum('no','yes','','') NOT NULL DEFAULT 'no',
  `user_form-activ` enum('yes','no') NOT NULL DEFAULT 'no',
  `activ_code` varchar(50) NOT NULL,
  `vergeetcode` varchar(50) NOT NULL,
  `user_online` enum('y','n') NOT NULL DEFAULT 'n',
  `datum_gezien` date NOT NULL,
  `tijdstip_gezien` time NOT NULL,
  `user_sinds` date NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(10) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `straat` varchar(100) NOT NULL,
  `huisnummer` varchar(20) NOT NULL,
  `toevoeging` varchar(10) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(50) NOT NULL,
  `telefoon` varchar(11) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `cv` varchar(30) NOT NULL,
  `geboortedatum` date NOT NULL,
  `salaris` int(5) NOT NULL,
  `uitkering` varchar(10) NOT NULL,
  `uitkering_geldig_tot` date NOT NULL,
  `user_sector` enum('ICT','ZORG','INDUSTRIR','RETAIL') NOT NULL DEFAULT 'ICT',
  `user_bedrijf_grootte` varchar(10) NOT NULL,
  `rijbewijs` enum('ja','nee') NOT NULL,
  `auto` enum('ja','nee') NOT NULL,
  `reisafstand` int(3) NOT NULL,
  `opmerking` text NOT NULL,
  `linkedin` varchar(80) NOT NULL,
  `twitter` varchar(80) NOT NULL,
  `facebook` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `user_inlognaam`, `user_wachtwoord`, `user_authorisatie`, `user_email`, `user_activ`, `user_form-activ`, `activ_code`, `vergeetcode`, `user_online`, `datum_gezien`, `tijdstip_gezien`, `user_sinds`, `achternaam`, `tussenvoegsel`, `voornaam`, `straat`, `huisnummer`, `toevoeging`, `postcode`, `plaats`, `telefoon`, `foto`, `cv`, `geboortedatum`, `salaris`, `uitkering`, `uitkering_geldig_tot`, `user_sector`, `user_bedrijf_grootte`, `rijbewijs`, `auto`, `reisafstand`, `opmerking`, `linkedin`, `twitter`, `facebook`) VALUES
(2, 'blackliq', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'blachout@upcmail.nl', 'yes', 'no', '', '', 'n', '2016-08-11', '06:54:50', '2016-07-01', 'Hout', 'van', 'Thijs', 'W.v.Hembyzestraat', '17', '', '1067PM', 'Amsterdam', '0615579992', '57a9c5607ad3c.jpg', '57a820630d663.pdf', '1978-03-15', 3500, 'WW', '2017-08-25', 'ICT', '>500', 'ja', 'ja', 30, 'what the hell is going on																																																																																																			', 'https://nl.linkedin.com/in/thijsvanhout/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(3, 'Unal', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'selahattin@xs4all.nl', 'yes', 'no', '', '', 'n', '2016-08-09', '23:36:47', '2016-07-05', 'Unal', '', 'Selahattin', 'Hortensiastraat', '18', '5hoog', '1032CJ', 'Amsterdam', '062960228', '57a9c2eb4659d.jpg', '57a5b514b4073.pdf', '1960-05-16', 3000, 'WW', '2017-08-30', 'ICT', '50-100', 'ja', 'ja', 25, 'foto en cv kunnen vervangen worden																																																																																																																																																																																															', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(5, 'Franklin', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'frankieboy37@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-08', '06:37:30', '2016-07-06', 'Roos', '', 'Franklin', 'Watermolenstraat', '98', '', '1098bn', 'Amsterdam', '0629359610', 'Franklin.jpg', 'CV_Roos.pdf', '1973-06-15', 3200, 'WW', '2017-08-29', 'ICT', '100-500', 'ja', 'ja', 25, 'IK HEB HONGER !!!!!!																	', 'https://nl.linkedin.com/in/franklin-roos', 'https://twitter.com/', 'https://www.facebook.com/'),
(6, 'balboa', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'balboadesus@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-09', '13:59:53', '2016-07-12', 'Dagama', 'Desus', 'Balboa', 'Columbusstraat', '28', '3hoog', '1778BT', 'schagen', '0206194483', '57a9c5c87ac2e.jpg', '57a5d12de9c90.txt', '1975-11-25', 3200, 'WW', '2017-08-25', 'ICT', '1-10', 'ja', 'ja', 35, '	Blablablabla																																																																											', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/'),
(7, 'bart', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'bartkijlstra@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-09', '14:05:17', '2016-08-01', 'Kijsltra', '', 'Bart', 'Muiderpoortstation', '35', '3hoog', '1092vw', 'Amsterdam', '0619874146', '57a9c7082aac9.jpg', '57a821aaf2de5.txt', '1958-08-10', 3400, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 35, '				', 'https://nl.linkedin.com/in/bartkijlstra', '', ''),
(8, 'Ron', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'rdewit599@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-09', '14:04:35', '2016-07-13', 'Wit', 'de', 'Ron', 'Hupsakeestraat', '525', '7hoog', '1107ZO', 'Amsterdam', '0645845457', '57a9c6e2f0971.jpg', '57a821d587fea.txt', '1974-04-14', 3300, 'WW', '2017-02-28', 'ICT', '', 'nee', 'nee', 15, '	Ik wil koffie										', '', '', ''),
(9, 'Elmar', '8bdc0a760490ca729fa9d4711ca70893', 'admin', 'elmar_ziet_@alles.nl', 'yes', 'no', '', '', 'n', '2016-08-10', '11:48:48', '2016-08-05', 'Geurts', '', 'Elmar', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '0000-00-00', 'ICT', '', '', '', 0, '', '', '', ''),
(10, 'mercita', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'mmcoronel80@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-09', '16:09:05', '2016-08-09', 'Coronel', '', 'Mercita', 'Da Costa kade', '25', '2hoog', '1058TC', 'Amsterdam', '0611344827', '57a9cbfe76d50.jpg', '', '1975-11-25', 3600, 'WW', '2018-09-09', 'ICT', '', 'ja', 'ja', 25, '	Ben ook als jounalist inzetbaar																																														', 'https://nl.linkedin.com/in/mercita-coronel-7a89607/nl', 'https://twitter.com/login', 'https://www.facebook.com/mercita.coronel?fref=ts'),
(11, 'Fred', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'fred@kneefel.com', 'yes', 'no', '', '', 'n', '2016-08-10', '00:35:40', '2016-08-10', 'Kneefel', '', 'Fred', '', '', '', '', '', '0629359610', '57aa5aeccbdcd.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', 'https://nl.linkedin.com/in/fred-kneefel-6543b37/nl', '', 'https://www.facebook.com/fred.kneefel?fref=ts'),
(12, 'Alwin', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'paulisto1@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-10', '00:40:44', '2016-08-10', 'Tjon', '', 'Alwin', '', '', '', '', '', '0629359610', '57aa5bfc70297.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '		', 'https://nl.linkedin.com/in/alwin-tjon-pon-fong-1522656a', '', 'https://www.facebook.com'),
(13, 'patrick', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'patesa15@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-10', '00:49:35', '2016-08-10', 'Schmitz', '', 'Patrick', '', '', '', '', '', '0628292163', '57aa5e36c6e88.jpg', '', '0000-00-00', 3000, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 30, '	', 'https://nl.linkedin.com/in/pschmitz73', '', 'https://www.facebook.com/patrick.schmitz.9081?fref=ts'),
(14, 'Jhona', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'jhonathanstuart@gmail.com', 'yes', 'no', '', '', 'n', '2016-08-10', '00:57:21', '2016-08-10', 'Stuart Hoyos ', '', 'Jhonathan', '', '', '', '', '', '0634293329', '57aa60017b517.jpg', '', '0000-00-00', 4300, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '	', 'https://nl.linkedin.com/in/jhonathan-stuart-hoyos-acosta-61b5507a', '', 'https://www.facebook.com/jhonathan.hoyosacosta?fref=ts'),
(15, 'Merel', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', '2016-08-10', '01:03:17', '2016-08-10', 'Rover', 'de', 'Merel', '', '', '', '', '', '0627492625', '57aa617595194.jpg', '', '0000-00-00', 3600, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '	', 'https://nl.linkedin.com/in/merelderover', '', 'https://www.facebook.com/merel.derover?fref=ts'),
(16, 'Stella', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', '2016-08-10', '01:09:07', '2016-08-10', 'Hartog', '', 'Stella', '', '', '', '', '', '0634539390', '57aa62ca1a0c2.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '		', 'https://nl.linkedin.com/in/stella-hartog-907a244b', '', 'https://www.facebook.com/stellebel.stel?fref=ts'),
(17, 'Ramon', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', '2016-08-10', '01:14:05', '2016-08-10', 'Kok', '', 'Ramon', '', '', '', '', '', '0633135753', '57aa6418b7f4a.jpg', '', '0000-00-00', 5600, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '			', '', '', ''),
(18, 'Mike', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'michael_mitrasing@hotmail.com', 'yes', 'no', '', '', 'n', '2016-08-11', '14:59:58', '2016-08-10', 'Mitrasing', '', 'Michael', '', '', '', '', '', '0629359610', '57aa65c9dea97.jpg', '', '0000-00-00', 4500, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '			', 'https://nl.linkedin.com/in/michael-mitrasing-257a272/nl', '', 'https://www.facebook.com/cindy.enmichael?fref=ts');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
