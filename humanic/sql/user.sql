-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 sep 2016 om 06:18
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
  `vergeetstatus` enum('n','y') NOT NULL DEFAULT 'n',
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
  `facebook` varchar(80) NOT NULL,
  `motivatie` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `user_inlognaam`, `user_wachtwoord`, `user_authorisatie`, `user_email`, `user_activ`, `user_form-activ`, `activ_code`, `vergeetcode`, `vergeetstatus`, `user_online`, `datum_gezien`, `tijdstip_gezien`, `user_sinds`, `achternaam`, `tussenvoegsel`, `voornaam`, `straat`, `huisnummer`, `toevoeging`, `postcode`, `plaats`, `telefoon`, `foto`, `cv`, `geboortedatum`, `salaris`, `uitkering`, `uitkering_geldig_tot`, `user_sector`, `user_bedrijf_grootte`, `rijbewijs`, `auto`, `reisafstand`, `opmerking`, `linkedin`, `twitter`, `facebook`, `motivatie`) VALUES
(2, 'blackliq', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'blachout@upcmail.nl', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:33:32', '2016-07-01', 'Hout', 'van', 'Thijs', 'W.v.Hembyzestraat', '17', '', '1067PM', 'Amsterdam', '0615579992', '57a9c5607ad3c.jpg', '57a820630d663.pdf', '1978-03-15', 3500, 'WW', '2017-08-25', 'ICT', '>500', 'ja', 'ja', 30, 'mijn oude fiets is gestolen!																																																																																																			', 'https://nl.linkedin.com/in/thijsvanhout/nl', 'https://twitter.com/', 'https://www.facebook.com/', 'mot1'),
(3, 'Unal', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'selahattin@xs4all.nl', 'yes', 'no', '', '', 'n', 'n', '2016-09-03', '13:40:08', '2016-07-05', 'Unal', '', 'Selahattin', 'Hortensiastraat', '18', '5hoog', '1032CJ', 'Amsterdam', '062960228', '57a9c2eb4659d.jpg', '57a5b514b4073.pdf', '1960-05-16', 3000, 'WW', '2017-08-30', 'ICT', '50-100', 'ja', 'ja', 25, 'foto en cv kunnen vervangen worden																																																																																																																																																																																																																														', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/', 'mot1'),
(5, 'Franklin', 'd8f51e0a60145fc0019192389be706a0', 'usr', 'frankieboy37@hotmail.com', 'yes', 'no', '', '', 'n', 'y', '2016-09-14', '06:11:27', '2016-07-06', 'Roos', '', 'Franklin', 'Watermolenstraat', '98', '', '1098bn', 'Amsterdam', '0629359610', 'Franklin.jpg', 'CV_Roos.pdf', '1973-06-15', 3200, 'WW', '2017-08-29', 'ICT', '100-500', 'ja', 'ja', 25, 'IK HEB HONGER !!!!!!																		', 'https://nl.linkedin.com/in/franklin-roos', 'https://twitter.com/', 'https://www.facebook.com/', 'aan motivatie geen gebrek'),
(6, 'balboa', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'balboadesus@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:41:19', '2016-07-12', 'Dagama', 'Desus', 'Balboa', 'Columbusstraat', '28', '3hoog', '1778BT', 'schagen', '0206194483', '57b060ff7a163.jpg', '57a5d12de9c90.txt', '1975-11-25', 3200, 'WW', '2017-08-25', 'ICT', '1-10', 'ja', 'ja', 35, '	Blablablabla																																																																																	', 'https://nl.linkedin.com/in/selahattinunal/nl', 'https://twitter.com/', 'https://www.facebook.com/', 'mot1'),
(7, 'bart', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'bartkijlstra@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-29', '13:20:01', '2016-08-01', 'Kijsltra', '', 'Bart', 'Muiderpoortstation', '35', '3hoog', '1092vw', 'Amsterdam', '0619874146', '57a9c7082aac9.jpg', '57a821aaf2de5.txt', '1958-08-10', 3400, 'WW', '2017-08-30', 'ICT', '', 'ja', 'ja', 35, '								', 'https://nl.linkedin.com/in/bartkijlstra', '', '', 'mot1'),
(8, 'Ron', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'rdewit599@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:39:00', '2016-07-13', 'Wit', 'de', 'Ron', 'Hupsakeestraat', '525', '7hoog', '1107ZO', 'Amsterdam', '0645845457', '57a9c6e2f0971.jpg', '57a821d587fea.txt', '1974-04-14', 3300, 'WW', '2017-02-28', 'ICT', '', 'nee', 'nee', 15, '	Ik wil koffie												', 'https://nl.linkedin.com/in/ron-de-wit-3b4928118', 'https://twitter.com/', 'https://www.facebook.com/', 'mot1'),
(9, 'Elmar', '8bdc0a760490ca729fa9d4711ca70893', 'admin', 'elmar_ziet_@alles.nl', 'yes', 'no', '', '', 'n', 'n', '2016-08-30', '13:09:36', '2016-08-05', 'Geurts', '', 'Elmar', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '0000-00-00', 'ICT', '', '', '', 0, '', '', '', '', 'aan motivatie geen gebrek'),
(10, 'mercita', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'mmcoronel80@gmail.com', 'yes', 'no', '', '', 'n', 'y', '2016-08-31', '21:22:29', '2016-08-09', 'Coronel', '', 'Mercita', 'Da Costa kade', '25', '2hoog', '1058TC', 'Amsterdam', '0611344827', '57a9cbfe76d50.jpg', '', '1975-11-25', 3600, 'WW', '2018-09-09', 'ICT', '', 'ja', 'ja', 25, '	Ben ook als jounalist inzetbaar																																																							', 'https://nl.linkedin.com/in/mercita-coronel-7a89607/nl', 'https://twitter.com/login', 'https://www.facebook.com/mercita.coronel?fref=ts', 'mot1'),
(11, 'Fred', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'fred@kneefel.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:43:07', '2016-08-10', 'Kneefel', '', 'Fred', '', '', '', '', '', '0629359610', '57aa5aeccbdcd.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '		', 'https://nl.linkedin.com/in/fred-kneefel-6543b37/nl', '', 'https://www.facebook.com/fred.kneefel?fref=ts', 'mot1'),
(12, 'Alwin', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'paulisto1@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-10', '00:40:44', '2016-08-10', 'Tjon', '', 'Alwin', '', '', '', '', '', '0629359610', '57aa5bfc70297.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '		', 'https://nl.linkedin.com/in/alwin-tjon-pon-fong-1522656a', '', 'https://www.facebook.com', 'mot1'),
(13, 'patrick', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'patesa15@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-10', '00:49:35', '2016-08-10', 'Schmitz', '', 'Patrick', '', '', '', '', '', '0628292163', '57aa5e36c6e88.jpg', '', '0000-00-00', 3000, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 30, '	', 'https://nl.linkedin.com/in/pschmitz73', '', 'https://www.facebook.com/patrick.schmitz.9081?fref=ts', 'mot1'),
(14, 'Jhona', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'jhonathanstuart@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:44:22', '2016-08-10', 'Stuart Hoyos ', '', 'Jhonathan', '', '', '', '', '', '0634293329', '57aa60017b517.jpg', '', '0000-00-00', 4300, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '			', 'https://nl.linkedin.com/in/jhonathan-stuart-hoyos-acosta-61b5507a', '', 'https://www.facebook.com/jhonathan.hoyosacosta?fref=ts', 'mot1'),
(15, 'Merel', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '02:21:11', '2016-08-10', 'Rover', 'de', 'Merel', '', '', '', '', '', '0627492625', '57aa617595194.jpg', '', '0000-00-00', 3600, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '		', 'https://nl.linkedin.com/in/merelderover', '', 'https://www.facebook.com/merel.derover?fref=ts', 'mot1'),
(16, 'Stella', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'Stellahartog@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:36:06', '2016-08-10', 'Hartog', '', 'Stella', '', '', '', '', '', '0634539390', '57aa62ca1a0c2.jpg', '', '1998-04-12', 4500, 'WW', '2017-12-25', 'ICT', '', 'ja', 'ja', 0, '		hallooooo, 	Ik ben Stella	blaaaa								', 'https://nl.linkedin.com/in/stella-hartog-907a244b', '', 'https://www.facebook.com/stellebel.stel?fref=ts', 'mot1'),
(17, 'Ramon', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', 'n', '2016-08-10', '01:14:05', '2016-08-10', 'Kok', '', 'Ramon', '', '', '', '', '', '0633135753', '57aa6418b7f4a.jpg', '', '0000-00-00', 5600, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '			', '', '', '', 'mot1'),
(18, 'Mike', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'michael_mitrasing@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-30', '13:08:51', '2016-08-10', 'Mitrasing', '', 'Michael', '', '', '', '', '', '0629359610', '57aa65c9dea97.jpg', '', '0000-00-00', 4500, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '																			', 'https://nl.linkedin.com/in/michael-mitrasing-257a272/nl', '', 'https://www.facebook.com/cindy.enmichael?fref=ts', 'mot1'),
(19, 'Jurgen', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', 'n', '2016-08-12', '21:12:13', '2016-08-11', 'Dion de Clercq', '', 'Jurgen', '', '', '', '', 'North Fort Myers, Florida', '0629359610', '57ace1247ceb2.jpg', '57ace1339eb03.txt', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '									', 'https://www.linkedin.com/in/jurgendeclercq/nl', 'https://twitter.com/datahousedc', 'https://www.facebook.com/profile.php?id=574775694&fref=ts', 'mot1'),
(20, 'Mohamed', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'aitmesss@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '01:38:29', '2016-08-14', 'Ait Mesaoud', '', 'Mohamed', 'Mohamedstraat', '5', 'huis', '1015bt', 'Amsterdam', '0629359610', '57b065f65d167.jpg', '', '0000-00-00', 3500, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '		', 'https://nl.linkedin.com/in/mohamed-ait-messaoud-28509a14/nl', 'https://twitter.com/Aitmesss', 'https://www.facebook.com/mohamed.aitmessaoud?fref=ts', ''),
(21, 'Pedro', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'pedro_calado@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-09-05', '23:07:53', '2016-08-14', 'Calado', '', 'Pedro', '', '', '', '', '', '0629359610', '57b0995c04bb8.jpg', '', '1960-03-21', 4500, 'Wajong', '2017-12-28', 'ICT', '', 'ja', 'ja', 35, '	geef mij maar paella								', 'https://nl.linkedin.com/in/pedrocalado/nl', '', '', ''),
(22, 'Orlando', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'orlando_neira@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '14:15:22', '2016-08-14', 'Neira', '', 'Orlando', '', '', '', '', '', '0629359610', '57b0a5514612c.jpg', '', '0000-00-00', 6500, 'WW', '2018-08-23', 'ICT', '', 'nee', 'nee', 0, '	Hello , ik ben Orlando						', 'https://co.linkedin.com/in/orlando-neira-s-6384252b/nl', '', 'https://www.facebook.com/orlyneira?fref=ts', ''),
(23, 'clemo', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '19:18:18', '2016-08-14', 'Roos', '', 'Clemens', '', '', '', '', '', '0629359610', '57b0a7c14bebf.jpg', '', '0000-00-00', 9000, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '			', 'https://www.linkedin.com/in/clemens-roos-3b19018/nl', '', '', 'mot1'),
(24, 'Germaine', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'germaine_oostwijk@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-21', '14:15:49', '2016-08-14', 'Oostwijk', '', 'Germaine', '', '', '', '', '', '0629359610', '57b0a9bbccf5e.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	halloooooooo		', 'https://www.linkedin.com/in/germaine-oostwijk-42203718/nl', '', '', ''),
(25, 'Lara', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'lara_de_groot@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-15', '00:03:42', '2016-08-14', 'Groot', 'de', 'Lara', 'Jacobastraat', '5', 'huis', '1301al', 'Almere', '0629359610', '57b0ac83e118c.jpg', '', '1998-06-17', 2500, 'WW', '0000-00-00', 'ICT', '', 'ja', 'nee', 0, '		Ola							', 'https://nl.linkedin.com/in/laradegroot/nl', '', 'https://www.facebook.com/lara.m.degroot?fref=ts', ''),
(26, 'jacob', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'jacob_hahury@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '19:59:20', '2016-08-14', 'Hahury', '', 'Jacob', 'Hoogoordreef', '45', '4hoog', '1107ZO', 'Amsterdam', '0629359610', '57b0b2145885a.jpg', '', '0000-00-00', 3300, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 35, '	BLAAAAAAAAAA		', 'https://nl.linkedin.com/in/jacob-hahury-a26301105', '', 'https://www.facebook.com/jacob.hahury?fref=ts', 'mot1'),
(27, 'piet', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'pieter_schorn@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '20:21:51', '2016-08-14', 'Schorn', '', 'Pieter', '', '', '', '', '', '0629359610', '57b0b6ce3271e.jpg', '', '0000-00-00', 2500, 'WW', '2017-10-18', 'ICT', '', 'ja', 'ja', 40, '					', 'https://nl.linkedin.com/in/pieter-schorn-a817039/nl', '', 'https://www.facebook.com/pieter.schorn?fref=ts', 'mot1'),
(28, 'charra', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'shivano_d@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '20:57:50', '2016-08-14', 'Dwarkasing', '', 'Charwin', '', '', '', '', '', '0642430659', '57b0bb907fb16.jpg', '', '0000-00-00', 2300, 'WW', '2017-09-15', 'ICT', '', 'ja', 'ja', 25, '										', 'https://nl.linkedin.com/in/charwin-dwarkasing-819b9b94', '', 'https://www.facebook.com/charra.dwarka?fref=ts', ''),
(29, 'Jeroen', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'jeroen_schrassen@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:02:59', '2016-08-14', 'Schrassen', '', 'Jeroen', '', '', '', '', '', '0629359610', '57b0c09121761.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'ja', 'nee', 0, 'hhhhhhhhhhhhhh																', 'https://nl.linkedin.com/in/jeroen-schrassen-b2934979', '', 'https://www.facebook.com/jeroen.schras?fref=ts', ''),
(30, 'Mudy', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'mudy59@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:12:57', '2016-08-14', 'Taya', '', 'Mudhafar', '', '', '', '', '', '0629359610', '57b0c2c7f34a6.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', 'https://nl.linkedin.com/in/mudhafar-taya-763202b/nl', '', 'https://www.facebook.com/tayappa.madhavar?fref=ts', ''),
(31, 'frank_d', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'fr.daniels@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-15', '00:02:36', '2016-08-14', 'Daniels', '', 'Frank', '', '', '', '', '', '0629359610', '57b0c3e6b8410.jpg', '', '0000-00-00', 3500, 'WW', '2018-11-21', 'ICT', '', 'ja', 'ja', 25, '			bcccccccccccbbbbbbbbb								', '', '', '', ''),
(32, 'Fred_m', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'fmes@xs4all.nl', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:23:11', '2016-08-14', 'Mes', '', 'Fred', '', '', '', '', '', '0652512800', '57b0c54f3b5d5.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', 'https://nl.linkedin.com/in/fred-mes-50a55315/nl', '', 'https://www.facebook.com/fred.mesquita.1?fref=ts', ''),
(33, 'Diana', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'vsichem@xs4all.nl', 'yes', 'no', '', '', 'n', 'n', '2016-08-15', '11:32:35', '2016-08-14', 'Sichem', 'van', 'Diana', '', '', '', '', '', '0629359610', '57b0c645cd6d1.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'ja', 'ja', 0, '		', 'https://nl.linkedin.com/in/diana-van-sichem-bb77ba33/nl', '', '', ''),
(34, 'Anous', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'aibvleijden@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-29', '12:56:46', '2016-08-14', 'Leijden', 'van', 'Anouschka', '', '', '', '', '', '0629359610', '57b0c7831fec6.jpg', '', '0000-00-00', 2800, 'WW', '2018-05-18', 'ICT', '', 'ja', 'ja', 25, 'Wil eens wat anders																						', 'ttps://nl.linkedin.com/in/anouschka-van-leijden-05659037/nl', '', '', ''),
(35, 'Ida', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'idavisser100@gmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:36:19', '2016-08-14', 'Visser', '', 'Ida', '', '', '', '', '', '0629359610', '57b0c83f991a3.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(36, 'Jan', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'jan_doedel@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:39:19', '2016-08-14', 'Doedel', '', 'Jan', '', '', '', '', '', '0629359610', '57b0c8fc3f89a.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(37, 'Piet_b', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'piet_boogaard@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:45:03', '2016-08-14', 'Boogaard', '', 'Piet', '', '', '', '', '', '0629359610', '57b0ca52783c7.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(38, 'Walter', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'walter_samseer@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:47:52', '2016-08-14', 'Samseer', '', 'Walter', '', '', '', '', '', '0629359610', '57b0caf880024.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(39, 'Bertus', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'bertusdDridder@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:51:22', '2016-08-14', 'Ridder', 'de', 'Bertus', '', '', '', '', '', '0629359610', '57b0cbd2f3eab.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(40, 'Ricardo', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'ricardo_geerlings@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:55:22', '2016-08-14', 'Geerlings', '', 'Ricardo', '', '', '', '', '', '0629359610', '57b0ccbce40f9.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(41, 'Ben', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'benVDriel@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '21:59:21', '2016-08-14', 'Driel', 'van', 'Ben', '', '', '', '', '', '0629359610', '57b0cda7ae6d9.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(42, 'Melvin', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'melvin_seymonson@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '22:02:27', '2016-08-14', 'Seymonson', '', 'Melvin', '', '', '', '', '', '0629359610', '57b0ce63b482e.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', ''),
(43, 'Karel', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'karel_bal@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-09-06', '04:33:51', '2016-08-14', 'Bal', '', 'Karel', '', '', '', '', '', '0629359610', '57b0cf3278ab3.jpg', '', '1958-02-15', 5600, 'WW', '2018-07-06', 'ICT', '', 'ja', 'ja', 35, '			laterzzzzzzzzzzzzzz								', '', '', '', ''),
(44, 'Max', '8bdc0a760490ca729fa9d4711ca70893', 'usr', '', 'yes', 'no', '', '', 'n', 'n', '2016-08-14', '22:08:20', '2016-08-14', 'Cilinder', '', 'Max', '', '', '', '', '', '0629359610', '57b0cfbf7ab88.jpg', '', '0000-00-00', 0, 'WW', '0000-00-00', 'ICT', '', 'nee', 'nee', 0, '	', '', '', '', 'mot1'),
(45, 'Randy', '8bdc0a760490ca729fa9d4711ca70893', 'usr', 'randy_mauricia@hotmail.com', 'yes', 'no', '', '', 'n', 'n', '2016-08-18', '21:49:58', '2016-08-16', 'Mauricia', '', 'Randy', '', '', '', '', '', '062935178', '57b61226ae4f8.jpg', '', '0000-00-00', 3400, 'WW', '2017-09-25', 'ICT', '', 'ja', 'ja', 0, '	Fw	', '', '', '', '');

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
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
