-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 sep 2016 om 06:17
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
-- Tabelstructuur voor tabel `bedrijf`
--

CREATE TABLE IF NOT EXISTS `bedrijf` (
  `id` int(11) NOT NULL,
  `aantal_medewerkers` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijf`
--

INSERT INTO `bedrijf` (`id`, `aantal_medewerkers`) VALUES
(1, 'micro'),
(2, 'klein'),
(3, 'middelgroot'),
(4, 'groot');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bedrijf_gewerkt`
--

CREATE TABLE IF NOT EXISTS `bedrijf_gewerkt` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `bedrijf_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijf_gewerkt`
--

INSERT INTO `bedrijf_gewerkt` (`id`, `user_id`, `bedrijf_id`) VALUES
(1, 3, 1),
(2, 2, 4),
(4, 0, 4),
(5, 7, 4);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `bedrijf_view`
--
CREATE TABLE IF NOT EXISTS `bedrijf_view` (
`bedrijf_id` int(11)
,`grootte` varchar(15)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(5) NOT NULL,
  `user_id` int(5) unsigned NOT NULL,
  `user_inlognaam` varchar(25) NOT NULL,
  `contact_naam` varchar(50) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `contact_subject` varchar(60) NOT NULL,
  `contact_bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `functie`
--

CREATE TABLE IF NOT EXISTS `functie` (
  `functie_id` int(3) NOT NULL,
  `functie_naam` varchar(50) NOT NULL,
  `functie_omschrijving` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

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
(99, 'Anders', '');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `functie_view`
--
CREATE TABLE IF NOT EXISTS `functie_view` (
`functie_id` int(3)
,`functie_naam` varchar(50)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gewenste_sector`
--

CREATE TABLE IF NOT EXISTS `gewenste_sector` (
  `gewenste_sector_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `sector_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gewenste_sector`
--

INSERT INTO `gewenste_sector` (`gewenste_sector_id`, `user_id`, `sector_id`) VALUES
(25, 3, 3),
(28, 5, 1),
(29, 5, 4),
(32, 2, 1),
(33, 45, 3),
(34, 16, 3),
(35, 18, 1),
(36, 34, 1),
(37, 10, 1);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `kandiaten_vw`
--
CREATE TABLE IF NOT EXISTS `kandiaten_vw` (
`user_id` int(5)
,`user_email` varchar(80)
,`achternaam` varchar(50)
,`tussenvoegsel` varchar(10)
,`voornaam` varchar(50)
,`plaats` varchar(50)
,`telefoon` varchar(11)
,`foto` varchar(30)
,`cv` varchar(30)
,`geboortedatum` date
,`salaris` int(5)
,`uitkering` varchar(10)
,`uitkering_geldig_tot` date
,`rijbewijs` enum('ja','nee')
,`auto` enum('ja','nee')
,`reisafstand` int(3)
,`opmerking` text
,`linkedin` varchar(80)
,`facebook` varchar(80)
,`twitter` varchar(80)
,`ervaring` int(2)
,`functie_naam` varchar(50)
,`grootte` varchar(15)
,`regio_naam` varchar(50)
,`sector_naam` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `kandidaten`
--
CREATE TABLE IF NOT EXISTS `kandidaten` (
`user_id` int(5)
,`voornaam` varchar(50)
,`tussenvoegsel` varchar(10)
,`achternaam` varchar(50)
,`naam` varchar(50)
,`foto` varchar(30)
,`cv` varchar(30)
,`user_email` varchar(80)
);

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
  `navIn` enum('yes','no','both') NOT NULL DEFAULT 'no',
  `volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `nav`
--

INSERT INTO `nav` (`nav_id`, `nav_naam`, `nav_url`, `nav_place`, `nav_show`, `nav_parent_id`, `nav_taal`, `nav_auth`, `navIn`, `volgorde`) VALUES
(1, '<div class="nav">Home</div>', 'index.php', 'header', 'y', 0, 'nl', 'usr', 'both', 1),
(2, 'Wachtwoord wijzigen', 'application/modules/humanic-portal/account.php', 'header', 'y', 21, 'nl', 'usr', 'yes', 7),
(3, 'Werkgevers', 'application/modules/humanic-portal/werkgever.php', 'header', 'n', 0, 'nl', 'usr', 'yes', 5),
(4, 'Contact', 'http://humanicdevelopment.com/index.html#content5-12', 'footer', 'n', 0, 'nl', 'usr', 'yes', 8),
(5, 'Over ons', 'http://humanicdevelopment.com/index.html#content5-12', 'header', 'y', 0, 'nl', 'usr', 'both', 4),
(6, 'Kandidaat-Registratie', 'application/modules/humanic-portal/register.php', 'header', 'y', 0, 'nl', 'usr', 'no', 2),
(7, 'Algemene Voorwaarden', 'alv.php', 'footer', 'n', 0, 'nl', 'usr', 'yes', 10),
(8, 'Disclaimer', 'disclaimer.php', 'footer', 'n', 0, 'nl', 'usr', 'yes', 11),
(9, 'Privacy Beleid', 'privacy.php', 'footer', 'n', 0, 'nl', 'usr', 'yes', 12),
(10, 'Kandidaat-Login', 'application/modules/humanic-portal/login.php', 'header', 'y', 0, 'nl', 'usr', 'no', 3),
(11, 'Werkgever-Registratie', 'application/modules/humanic-portal/werkgever.php', 'header', 'y', 3, 'nl', 'usr', 'yes', 6),
(12, 'Werkgever-Inloggen', 'application/modules/humanic-portal/login.php', 'header', 'n', 3, 'nl', 'usr', 'yes', 7),
(13, 'ADMIN', 'application/modules/admin/indexAdmin.php', 'header', 'y', 0, 'nl', 'admin', 'yes', 13),
(20, '<div class=adres>Programmeurs:</div> F.Roos(franklin_roos@hotmail.com), T v Hout(blackhout@upcmail.nl), B.Kijlstra(bartkijlstra@gmail.com), S.Unal(selahattin@xs4all.nl), R.de Wit(r.dewit@outlook.com)', '', 'footer', 'n', 0, 'nl', 'usr', 'yes', 18),
(21, 'Mijn Gegevens', 'application/modules/humanic-portal/kandidaat.php', 'header', 'y', 0, 'nl', 'usr', 'yes', 5),
(22, '<div class=adres>\r\n	             Adres Gegevens\r\n	    </div><br/>\r\n		<div class=adresR>\r\n		         H.E.J. Wenkenbachweg 123<br/>1096 AM Amsterdam Nederland\r\n		</div>', '', 'footer', 'y', 0, 'nl', 'usr', 'yes', 17),
(23, '<div class=adres1><div class=adres>Contact</div><br/>\r\n<div class=adresR>Email: info@Humanic.cloud<br/>\r\nTel: +31(0)852736963</div>', '', 'footer', 'y', 0, 'nl', 'usr', 'yes', 18),
(24, '', '', '', '', 0, 'nl', 'usr', 'yes', 0),
(25, '<div class=nav>Home</div>', 'index.php', 'header', 'y', 0, 'nl', 'elm', 'yes', 1),
(26, 'Mijn profiel', 'application/modules/humanic-portal/kandidaat.php', 'header', 'y', 21, 'nl', 'usr', 'yes', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `navadmin`
--

CREATE TABLE IF NOT EXISTS `navadmin` (
  `navadmin_id` int(2) NOT NULL,
  `navadmin_naam` varchar(30) NOT NULL,
  `navadmin_url` varchar(60) NOT NULL,
  `navadmin_show` enum('y','n') NOT NULL,
  `navadmin_auth` enum('ptr','admin') NOT NULL DEFAULT 'admin',
  `navadmin_volgorde` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `navadmin`
--

INSERT INTO `navadmin` (`navadmin_id`, `navadmin_naam`, `navadmin_url`, `navadmin_show`, `navadmin_auth`, `navadmin_volgorde`) VALUES
(1, 'Home', 'index.php', 'y', 'ptr', 1),
(4, 'nav', 'application/modules/nav/nav.php', 'n', 'admin', 4),
(5, 'navadmin', 'application/modules/navadmin/navadmin.php', 'n', 'admin', 5),
(6, 'Totaal overzicht', 'application/modules/query/overzicht.php', 'y', 'admin', 6),
(7, 'Query Maken', 'application/modules/query/queryMaken.php', 'y', 'admin', 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nav_nl`
--

CREATE TABLE IF NOT EXISTS `nav_nl` (
  `nav_nl_id` int(2) NOT NULL,
  `nav_nl_naam` varchar(80) NOT NULL,
  `nav_nl_url` varchar(80) NOT NULL,
  `nav_nl_place` enum('header','footer') NOT NULL,
  `nav_nl_show` enum('y','n') NOT NULL,
  `nav_nl_parent_id` int(2) NOT NULL,
  `nav_nl_taal` enum('nl','en') NOT NULL,
  `nav_nl_auth` enum('usr','admin','ptr') NOT NULL DEFAULT 'usr',
  `volgorde` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `online_id` int(15) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `online_ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `online_locatie` varchar(2555) NOT NULL DEFAULT '''''',
  `online_tijd` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `online`
--

INSERT INTO `online` (`online_id`, `user_id`, `online_ip`, `online_locatie`, `online_tijd`) VALUES
(1, 4, '0.0.0.0', '''''', 0),
(2, 5, '0.0.0.0', '''''', 0),
(3, 5, '0.0.0.0', '''''', 0),
(4, 5, '0.0.0.0', '''''', 0),
(5, 5, '0.0.0.0', '''''', 0),
(6, 5, '0.0.0.0', '''''', 0),
(7, 5, '0.0.0.0', '''''', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(2) NOT NULL,
  `page_nav_id` int(2) NOT NULL,
  `page_content` text NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_description` varchar(100) NOT NULL,
  `page_keywords` varchar(100) NOT NULL,
  `page_show` enum('y','n') NOT NULL,
  `page_taal` enum('en','nl') NOT NULL DEFAULT 'nl'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pages`
--

INSERT INTO `pages` (`page_id`, `page_nav_id`, `page_content`, `page_title`, `page_description`, `page_keywords`, `page_show`, `page_taal`) VALUES
(1, 1, '\r\n    <!-- Half Page Image Background Carousel Header -->\r\n    <header id="myCarousel" class="carousel slide">\r\n        <!-- Indicators -->\r\n        <ol class="carousel-indicators">\r\n            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>\r\n            <li data-target="#myCarousel" data-slide-to="1"></li>\r\n            <li data-target="#myCarousel" data-slide-to="2"></li>\r\n			<li data-target="#myCarousel" data-slide-to="3"></li>\r\n        </ol>\r\n\r\n        <!-- Wrapper for Slides -->\r\n        <div class="carousel-inner">\r\n            <div class="item active">\r\n                <!-- Set the first background image using inline CSS below. -->\r\n                <div class="fill" style="background-image:url(''http://localhost:7777/HumanicIC/humanic/assets/images/air-balloon-planet-2560x1440-2560x1440-3.jpg'');"></div>\r\n                <div class="carousel-caption">\r\n                    <h2 class=homeP>Talent Journey to a World of Innovation</h2>\r\n                </div>\r\n            </div>\r\n            <div class="item">\r\n                <!-- Set the second background image using inline CSS below. -->\r\n                <div class="fill" style="background-image:url(''http://localhost:7777/HumanicIC/humanic/assets/images/air-balloon-3-1920x1200-60.jpg'');"></div>\r\n                <div class="carousel-caption">\r\n                    <h2 class=homeP>Samen naar de TOP</h2>\r\n                </div>\r\n            </div>\r\n            <div class="item">\r\n                <!-- Set the third background image using inline CSS below. -->\r\n                <div class="fill" style="background-image:url(''http://localhost:7777/HumanicIC/humanic/assets/images/air-balloon-2-1920x1200-55.jpg'');"></div>\r\n                <div class="carousel-caption">\r\n                    <h2 class=homeP>Nieuw overzicht, nieuw inzicht!</h2>\r\n                </div>\r\n            </div>\r\n			<div class="item">\r\n                <!-- Set the fourth background image using inline CSS below. -->\r\n                <div class="fill" style="background-image:url(''http://localhost:7777/HumanicIC/humanic/assets/images/air-balloon-1-1920x1200-42.jpg'');"></div>\r\n                <div class="carousel-caption">\r\n                    <h2 class=homeP>Samenwerken is samen winnen!</h2>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- Controls -->\r\n        <a class="left carousel-control" href="#myCarousel" data-slide="prev">\r\n            <span class="icon-prev"></span>\r\n        </a>\r\n        <a class="right carousel-control" href="#myCarousel" data-slide="next">\r\n            <span class="icon-next"></span>\r\n        </a>\r\n\r\n    </header>\r\n\r\n    <!-- Page Content -->\r\n    <div class="container">\r\n\r\n        <div class="row">\r\n            <div class="col-lg-12">\r\n                <h1>Collectief Organiseren, Ondernemen en Opleiden van ICT Talent</h1>\r\n                <p>Humanic Development is geboren vanuit de constatering dat Nederland veel digitaal talent bezit, maar dat werkzoekend talent slecht aansluiting vindt bij de ICT werkgevers die ook zoekende zijn. Het probleem is inmiddels voor werkgevers zo schrijnend, dat nieuwe kansrijke beroepen in de ICT al snel uitmonden in moeilijk vervulbare vacatures. Hierdoor stagneert groei en stijgen kosten.</p> <p>Het gat in de ICT arbeidsmarkt wordt alleen maar groter, als we niet van concurreren naar innoveren gaan. De innovatie die nu wereldwijd beschikbaar is vraagt om een andere oplossing en mentaliteit van werkgevers en werknemers. Het is onze missie om dit door innovatie gedreven gat te laten verkleinen en verdwijnen! </p>\r\n            </div>\r\n        </div>\r\n\r\n        <hr>\r\n\r\n    </div>\r\n<!-- /.container -->\r\n\r\n\r\n    <!-- jQuery -->\r\n    <script src="/assets/js/jquery.js"></script>\r\n\r\n    <!-- Bootstrap Core JavaScript -->\r\n    <script src="/assets/js/bootstrap.min.js"></script>\r\n\r\n    <!-- Script to Activate the Carousel -->\r\n    <script>\r\n    $(''.carousel'').carousel({\r\n        interval: 5000 //changes the speed\r\n    })\r\n    </script>', '', 'why, onstaansgeschiedenis', 'HumainIC, website, werkzoekende', 'y', 'nl'),
(2, 2, '\r\nWil jij instappen op een van onze leerwerk trajecten met baangarantie?\r\n\r\nOnderneem nu en start jouw Talent Journey.\r\n\r\n\r\n\r\nVul onderstaand formulier in!\r\n\r\nWij nemen binnen 2 werkdagen contact met jou op.', '<h4 class=instappen>Instappen werkzoekenden!<br/>\r\nRegistreren</h4>', 'inschrijfformulier', 'werkzoekenden, inschrijven', 'y', 'nl'),
(3, 3, 'Nieuw talent nodig om de marktvraag op te vangen?\r\n\r\nVind ICT-toptalenten via onze Talent Journeys!\r\n\r\n\r\n\r\nVul onderstaand formulier in!\r\n\r\nWij nemen binnen 2 werkdagen contact op.', 'Instappen werkgevers!', 'werkgevers pagina', 'nieuw talent, werkgevers, banen, marktvraag', 'y', 'nl'),
(4, 4, '', 'CONTACT FORM', 'contact formulier', '', 'y', 'nl'),
(6, 6, '', '<h1>Kandidaat Registratie Formulier<hr></h1>', 'kandidaat regisratie', 'kandidaat, registratie, humanicIC, c03logie', 'y', 'nl'),
(7, 7, '<h5>\r\nAlgemene Voorwaarden - neutrale versie<hr><br>\r\n\r\nInhoudsopgave:\r\n<ul>\r\n<li>Artikel   1 - Definities</li>\r\n<li>Artikel   2 - Identiteit van de ondernemer</li>\r\n<li>Artikel   3 - Toepasselijkheid</li>\r\n<li>Artikel   4 - Het aanbod</li>\r\n<li>Artikel   5 - De overeenkomst</li>\r\n<li>Artikel   6 - Herroepingsrecht</li>\r\n<li>Artikel   7 - Verplichtingen van de consument tijdens de bedenktijd</li>\r\n<li>Artikel   8 - Uitoefening van het herroepingsrecht door de consument en kosten daarvan</li>\r\n<li>Artikel   9 - Verplichtingen van de ondernemer bij herroeping</li>\r\n<li>Artikel 10 - Uitsluiting herroepingsrecht</li>\r\n<li>Artikel 11 - De prijs</li>\r\n<li>Artikel 12 - Nakoming en extra </li>\r\n<li>Artikel 13 - Levering en uitvoering</li>\r\n<li>Artikel 14 - Duurtransacties: duur, opzegging en verlenging</li>\r\n<li>Artikel 15 - Betaling</li>\r\n<li>Artikel 16 - Klachtenregeling</li>\r\n<li>Artikel 17 - Geschillen</li>\r\n<li>Artikel 18 - Aanvullende of afwijkende bepalingen</ul>\r\n\r\nArtikel 1 - Definities<hr><br>\r\nIn deze voorwaarden wordt verstaan onder:\r\n<ul>\r\n<li>1.	Aanvullende overeenkomst: een overeenkomst waarbij de consument producten, digitale inhoud en/of diensten verwerft in verband met een overeenkomst op afstand en deze zaken, digitale inhoud en/of diensten door de ondernemer worden geleverd of door een derde partij op basis van een afspraak tussen die derde en de ondernemer;</li>\r\n<li>2.	Bedenktijd: de termijn waarbinnen de consument gebruik kan maken van zijn herroepingsrecht;</li>\r\n<li>3.	Consument: de natuurlijke persoon die niet handelt voor doeleinden die verband houden met zijn handels-, bedrijfs-, ambachts- of beroepsactiviteit;</li>\r\n<li>4.	Dag: kalenderdag;</li>\r\n<li>5.	Digitale inhoud: gegevens die in digitale vorm geproduceerd en geleverd worden;</li>\r\n<li>6.	Duurovereenkomst: een overeenkomst die strekt tot de regelmatige levering van zaken, diensten en/of digitale inhoud gedurende een bepaalde periode;</li>\r\n<li>7.	Duurzame gegevensdrager: elk hulpmiddel - waaronder ook begrepen e-mail - dat de consument of ondernemer in staat stelt om informatie die aan hem persoonlijk is gericht, op te slaan op een manier die toekomstige raadpleging of gebruik gedurende een periode die is afgestemd op het doel waarvoor de informatie is bestemd, en die ongewijzigde reproductie van de opgeslagen informatie mogelijk maakt;</li>\r\n<li>8.	Herroepingsrecht: de mogelijkheid van de consument om binnen de bedenktijd af te zien van de overeenkomst op afstand;</li>\r\n<li>9.	Ondernemer: de natuurlijke of rechtspersoon die producten, (toegang tot) digitale inhoud en/of diensten op afstand aan consumenten aanbiedt;</li>\r\n<li>10.	Overeenkomst op afstand: een overeenkomst die tussen de ondernemer en de consument wordt gesloten in het kader van een georganiseerd systeem voor verkoop op afstand van producten, digitale inhoud en/of diensten, waarbij tot en met het sluiten van de overeenkomst uitsluitend of mede gebruik gemaakt wordt van één of meer technieken voor communicatie op afstand;</li>\r\n<li>11.	Modelformulier voor herroeping: het in Bijlage I van deze voorwaarden opgenomen Europese modelformulier voor herroeping. Bijlage I hoeft niet ter beschikking te worden gesteld als de consument ter zake van zijn bestelling geen herroepingsrecht heeft;</li>\r\n<li>12.	Techniek voor communicatie op afstand: middel dat kan worden gebruikt voor het sluiten van een overeenkomst, zonder dat consument en ondernemer gelijktijdig in dezelfde ruimte hoeven te zijn samengekomen.</li>\r\n</ul>\r\nArtikel 2 - Identiteit van de ondernemer<hr><br>\r\n[Naam ondernemer] (statutaire naam, eventueel aangevuld met handelsnaam);<br>\r\n[Vestigingsadres];<br>\r\n[Bezoekadres, indien dit afwijkt van het vestigingsadres];<br>\r\nTelefoonnummer: [en tijdstip(pen) waarop de ondernemer telefonisch te bereiken is]<br>\r\nE-mailadres: [of ander aan de consument aangeboden elektronisch communicatiemiddel met dezelfde functionaliteit als e-mail]<br>\r\nKvK-nummer:<br> \r\nBtw-identificatienummer:<br><br> \r\n\r\nIndien de activiteit van de ondernemer is onderworpen aan een relevant vergunningstelsel: de<br><br>\r\ngegevens over de toezichthoudende autoriteit.\r\n\r\nIndien de ondernemer een gereglementeerd beroep uitoefent:<br>\r\n-	de beroepsvereniging of -organisatie waarbij hij is aangesloten;<br>\r\n-	de beroepstitel, de plaats in de EU of de Europese Economische Ruimte waar deze is toegekend;<br>\r\n-	een verwijzing naar de beroepsregels die in Nederland van toepassing zijn en aanwijzingen waar en hoe deze beroepsregels toegankelijk zijn.<br><br>\r\n\r\nArtikel 3 - Toepasselijkheid<hr>\r\n<ul>\r\n<li>1.	Deze algemene voorwaarden zijn van toepassing op elk aanbod van de ondernemer en op elke tot stand gekomen overeenkomst op afstand tussen ondernemer en consument.</li>\r\n<li>2.	Voordat de overeenkomst op afstand wordt gesloten, wordt de tekst van deze algemene voorwaarden aan de consument beschikbaar gesteld. Indien dit redelijkerwijs niet mogelijk is, zal de ondernemer voordat de overeenkomst op afstand wordt gesloten, aangeven op welke wijze de algemene voorwaarden bij de ondernemer zijn in te zien en dat zij op verzoek van de consument zo spoedig mogelijk kosteloos worden toegezonden.</li>\r\n<li>3.	Indien de overeenkomst op afstand elektronisch wordt gesloten, kan in afwijking van het vorige lid en voordat de overeenkomst op afstand wordt gesloten, de tekst van deze algemene voorwaarden langs elektronische weg aan de consument ter beschikking worden gesteld op zodanige wijze dat deze door de consument op een eenvoudige manier kan worden opgeslagen op een duurzame gegevensdrager. Indien dit redelijkerwijs niet mogelijk is, zal voordat de overeenkomst op afstand wordt gesloten, worden aangegeven waar van de algemene voorwaarden langs elektronische weg kan worden kennisgenomen en dat zij op verzoek van de consument langs elektronische weg of op andere wijze kosteloos zullen worden toegezonden.</li>\r\n<li>4.	Voor het geval dat naast deze algemene voorwaarden tevens specifieke product- of dienstenvoorwaarden van toepassing zijn, is het tweede en derde lid van overeenkomstige toepassing en kan de consument zich in geval van tegenstrijdige voorwaarden steeds beroepen op de toepasselijke bepaling die voor hem het meest gunstig is.</li>\r\n</ul>\r\nArtikel 4 - Het aanbod<hr>\r\n<ul>\r\n<li>1.	Indien een aanbod een beperkte geldigheidsduur heeft of onder voorwaarden geschiedt, wordt dit nadrukkelijk in het aanbod vermeld.</li>\r\n<li>2.	Het aanbod bevat een volledige en nauwkeurige omschrijving van de aangeboden producten, digitale inhoud en/of diensten. De beschrijving is voldoende gedetailleerd om een goede beoordeling van het aanbod door de consument mogelijk te maken. Als de ondernemer gebruik maakt van afbeeldingen, zijn deze een waarheidsgetrouwe weergave van de aangeboden producten, diensten en/of digitale inhoud. Kennelijke vergissingen of kennelijke fouten in het aanbod binden de ondernemer niet.</li>\r\n<li>3.	Elk aanbod bevat zodanige informatie, dat voor de consument duidelijk is wat de rechten en verplichtingen zijn, die aan de aanvaarding van het aanbod zijn verbonden.</li>\r\n</ul>\r\nArtikel 5 - De overeenkomst<hr>\r\n<ul>\r\n<li>1.	De overeenkomst komt, onder voorbehoud van het bepaalde in lid 4, tot stand op het moment van aanvaarding door de consument van het aanbod en het voldoen aan de daarbij gestelde voorwaarden.</li>\r\n<li>2.	Indien de consument het aanbod langs elektronische weg heeft aanvaard, bevestigt de ondernemer onverwijld langs elektronische weg de ontvangst van de aanvaarding van het aanbod. Zolang de ontvangst van deze aanvaarding niet door de ondernemer is bevestigd, kan de consument de overeenkomst ontbinden.</li>\r\n<li>3.	Indien de overeenkomst elektronisch tot stand komt, treft de ondernemer passende technische en organisatorische maatregelen ter beveiliging van de elektronische overdracht van data en zorgt hij voor een veilige webomgeving. Indien de consument elektronisch kan betalen, zal de ondernemer daartoe passende veiligheidsmaatregelen in acht nemen.</li>\r\n<li>4.	De ondernemer kan zich binnen wettelijke kaders - op de hoogte stellen of de consument aan zijn betalingsverplichtingen kan voldoen, alsmede van al die feiten en factoren die van belang zijn voor een verantwoord aangaan van de overeenkomst op afstand. Indien de ondernemer op grond van dit onderzoek goede gronden heeft om de overeenkomst niet aan te gaan, is hij gerechtigd gemotiveerd een bestelling of aanvraag te weigeren of aan de uitvoering bijzondere voorwaarden te verbinden.</li>\r\n<li>5.	De ondernemer zal uiterlijk bij levering van het product, de dienst of digitale inhoud aan de consument de volgende informatie, schriftelijk of op zodanige wijze dat deze door de consument op een toegankelijke manier kan worden opgeslagen op een duurzame gegevensdrager, meesturen: </li>\r\n<li>a.	het bezoekadres van de vestiging van de ondernemer waar de consument met klachten terecht kan;</li>\r\n<li>b.	de voorwaarden waaronder en de wijze waarop de consument van het herroepingsrecht gebruik kan maken, dan wel een duidelijke melding inzake het uitgesloten zijn van het herroepingsrecht;</li>\r\n<li>c.	de informatie over garanties en bestaande service na aankoop;</li>\r\n<li>d.	de prijs met inbegrip van alle belastingen van het product, dienst of digitale inhoud; voor zover van toepassing de kosten van aflevering; en de wijze van betaling, aflevering of uitvoering van de overeenkomst op afstand;</li>\r\n<li>e.	de vereisten voor opzegging van de overeenkomst indien de overeenkomst een duur heeft van meer dan één jaar of van onbepaalde duur is;</li>\r\n<li>f.	indien de consument een herroepingsrecht heeft, het modelformulier voor herroeping.</li>\r\n<li>6.	In geval van een duurtransactie is de bepaling in het vorige lid slechts van toepassing op de eerste levering.</li>\r\n</ul>\r\nArtikel 6 - Herroepingsrecht<hr><br>\r\nBij producten:<br>\r\n<ul>\r\n<li>1.	De consument kan een overeenkomst met betrekking tot de aankoop van een product gedurende een bedenktijd van minimaal 14 dagen zonder opgave van redenen ontbinden. De ondernemer mag de consument vragen naar de reden van herroeping, maar deze niet tot opgave van zijn reden(en) verplichten.</li>\r\n<li>2.	De in lid 1 genoemde bedenktijd gaat in op de dag nadat de consument, of een vooraf door de consument aangewezen derde, die niet de vervoerder is, het product heeft ontvangen, of:</li>\r\n<li>a.	als de consument in eenzelfde bestelling meerdere producten heeft besteld: de dag waarop de consument, of een door hem aangewezen derde, het laatste product heeft ontvangen. De ondernemer mag, mits hij de consument hier voorafgaand aan het bestelproces op duidelijke wijze over heeft geïnformeerd, een bestelling van meerdere producten met een verschillende levertijd weigeren.</li>\r\n<li>b.	als de levering van een product bestaat uit verschillende zendingen of onderdelen: de dag waarop de consument, of een door hem aangewezen derde, de laatste zending of het laatste onderdeel heeft ontvangen;</li>\r\n<li>c.	bij overeenkomsten voor regelmatige levering van producten gedurende een bepaalde periode: de dag waarop de consument, of een door hem aangewezen derde, het eerste product heeft ontvangen.</li>\r\n</ul>\r\nBij diensten en digitale inhoud die niet op een materiële drager is geleverd:<br>\r\n<ul>\r\n<li>3.	De consument kan een dienstenovereenkomst en een overeenkomst voor levering van digitale inhoud die niet op een materiële drager is geleverd gedurende minimaal 14 dagen zonder opgave van redenen ontbinden. De ondernemer mag de consument vragen naar de reden van herroeping, maar deze niet tot opgave van zijn reden(en) verplichten.</li>\r\n<li>4.	De in lid 3 genoemde bedenktijd gaat in op de dag die volgt op het sluiten van de overeenkomst.</li>\r\n</ul>\r\nVerlengde bedenktijd voor producten, diensten en digitale inhoud die niet op een materiële drager is geleverd bij niet informeren over herroepingsrecht:<br>\r\n<ul>\r\n<li>5.	Indien de ondernemer de consument de wettelijk verplichte informatie over het herroepingsrecht of het modelformulier voor herroeping niet heeft verstrekt, loopt de bedenktijd af twaalf maanden na het einde van de oorspronkelijke, overeenkomstig de vorige leden van dit artikel vastgestelde bedenktijd.</li>\r\n<li>6.	Indien de ondernemer de in het voorgaande lid bedoelde informatie aan de consument heeft verstrekt binnen twaalf maanden na de ingangsdatum van de oorspronkelijke bedenktijd, verstrijkt de bedenktijd 14 dagen na de dag waarop de consument die informatie heeft ontvangen.</li>\r\n</ul>\r\nArtikel 7 - Verplichtingen van de consument tijdens de bedenktijd<hr>\r\n<ul>\r\n<li>1.	Tijdens de bedenktijd zal de consument zorgvuldig omgaan met het product en de verpakking. Hij zal het product slechts uitpakken of gebruiken in de mate die nodig is om de aard, de kenmerken en de werking van het product vast te stellen. Het uitgangspunt hierbij is dat de consument het product slechts mag hanteren en inspecteren zoals hij dat in een winkel zou mogen doen.</li>\r\n<li>2.	De consument is alleen aansprakelijk voor waardevermindering van het product die het gevolg is van een manier van omgaan met het product die verder gaat dan toegestaan in lid 1.</li>\r\n<li>3.	De consument is niet aansprakelijk voor waardevermindering van het product als de ondernemer hem niet voor of bij het sluiten van de overeenkomst alle wettelijk verplichte informatie over het herroepingsrecht heeft verstrekt.</li>\r\n</ul>\r\nArtikel 8 - Uitoefening van het herroepingsrecht door de consument en kosten daarvan<hr>\r\n<ul>\r\n<li>1.	Als de consument gebruik maakt van zijn herroepingsrecht, meldt hij dit binnen de bedenktermijn door middel van het modelformulier voor herroeping of op andere ondubbelzinnige wijze aan de ondernemer.</li> \r\n<li>2.	Zo snel mogelijk, maar binnen 14 dagen vanaf de dag volgend op de in lid 1 bedoelde melding, zendt de consument het product terug, of overhandigt hij dit aan (een gemachtigde van) de ondernemer. Dit hoeft niet als de ondernemer heeft aangeboden het product zelf af te halen. De consument heeft de terugzendtermijn in elk geval in acht genomen als hij het product terugzendt voordat de bedenktijd is verstreken.</li>\r\n<li>3.	De consument zendt het product terug met alle geleverde toebehoren, indien redelijkerwijs mogelijk in originele staat en verpakking, en conform de door de ondernemer verstrekte redelijke en duidelijke instructies.</li>\r\n<li>4.	Het risico en de bewijslast voor de juiste en tijdige uitoefening van het herroepingsrecht ligt bij de consument.</li>\r\n<li>5.	De consument draagt de rechtstreekse kosten van het terugzenden van het product. Als de ondernemer niet heeft gemeld dat de consument deze kosten moet dragen of als de ondernemer aangeeft de kosten zelf te dragen, hoeft de consument de kosten voor terugzending niet te dragen.</li>\r\n<li>6.	Indien de consument herroept na eerst uitdrukkelijk te hebben verzocht dat de verrichting van de dienst of de levering van gas, water of elektriciteit die niet gereed voor verkoop zijn gemaakt in een beperkt volume of bepaalde hoeveelheid aanvangt tijdens de bedenktijd, is de consument de ondernemer een bedrag verschuldigd dat evenredig is aan dat gedeelte van de verbintenis dat door de ondernemer is nagekomen op het moment van herroeping, vergeleken met de volledige nakoming van de verbintenis.</li> \r\n<li>7.	De consument draagt geen kosten voor de uitvoering van diensten of de levering van water, gas of elektriciteit, die niet gereed voor verkoop zijn gemaakt in een beperkt volume of hoeveelheid, of tot levering van stadsverwarming, indien:</li>\r\n<li>a.	de ondernemer de consument de wettelijk verplichte informatie over het herroepingsrecht, de kostenvergoeding bij herroeping of het modelformulier voor herroeping niet heeft verstrekt, of;</li> \r\n<li>b.	de consument niet uitdrukkelijk om de aanvang van de uitvoering van de dienst of levering van gas, water, elektriciteit of stadsverwarming tijdens de bedenktijd heeft verzocht.</li>\r\n<li>8.	De consument draagt geen kosten voor de volledige of gedeeltelijke levering van niet op een materiële drager geleverde digitale inhoud, indien:</li>\r\n<li>a.	hij voorafgaand aan de levering ervan niet uitdrukkelijk heeft ingestemd met het beginnen van de nakoming van de overeenkomst voor het einde van de bedenktijd;</li>\r\n<li>b.	hij niet heeft erkend zijn herroepingsrecht te verliezen bij het verlenen van zijn toestemming; of</li>\r\n<li>c.	de ondernemer heeft nagelaten deze verklaring van de consument te bevestigen.</li>\r\n<li>9.	Als de consument gebruik maakt van zijn herroepingsrecht, worden alle aanvullende overeenkomsten van rechtswege ontbonden.</li>\r\n</ul>\r\nArtikel 9 - Verplichtingen van de ondernemer bij herroeping<hr>\r\n<ul>\r\n<li>1.	Als de ondernemer de melding van herroeping door de consument op elektronische wijze mogelijk maakt, stuurt hij na ontvangst van deze melding onverwijld een ontvangstbevestiging.</li>\r\n<li>2.	De ondernemer vergoedt alle betalingen van de consument, inclusief eventuele leveringskosten door de ondernemer in rekening gebracht voor het geretourneerde product, onverwijld doch binnen 14 dagen volgend op de dag waarop de consument hem de herroeping meldt. Tenzij de ondernemer aanbiedt het product zelf af te halen, mag hij wachten met terugbetalen tot hij het product heeft ontvangen of tot de consument aantoont dat hij het product heeft teruggezonden, naar gelang welk tijdstip eerder valt.</li> \r\n<li>3.	De ondernemer gebruikt voor terugbetaling hetzelfde betaalmiddel dat de consument heeft gebruikt, tenzij de consument instemt met een andere methode. De terugbetaling is kosteloos voor de consument.</li>\r\n<li>4.	Als de consument heeft gekozen voor een duurdere methode van levering dan de goedkoopste standaardlevering, hoeft de ondernemer de bijkomende kosten voor de duurdere methode niet terug te betalen.</li>\r\n</ul>\r\nArtikel 10 - Uitsluiting herroepingsrecht<hr>\r\nDe ondernemer kan de navolgende producten en diensten uitsluiten van het herroepingsrecht, maar alleen als de ondernemer dit duidelijk bij het aanbod, althans tijdig voor het sluiten van de overeenkomst, heeft vermeld:<br>\r\n<ul>\r\n<li>1.	Producten of diensten waarvan de prijs gebonden is aan schommelingen op de financiële markt waarop de ondernemer geen invloed heeft en die zich binnen de herroepingstermijn kunnen voordoen;</li>\r\n<li>2.	Overeenkomsten die gesloten zijn tijdens een openbare veiling. Onder een openbare veiling wordt verstaan een verkoopmethode waarbij producten, digitale inhoud en/of diensten door de ondernemer worden aangeboden aan de consument die persoonlijk aanwezig is of de mogelijkheid krijgt persoonlijk aanwezig te zijn op de veiling, onder leiding van een veilingmeester, en waarbij de succesvolle bieder verplicht is de producten, digitale inhoud en/of diensten af te nemen;</li>\r\n<li>3.	Dienstenovereenkomsten, na volledige uitvoering van de dienst, maar alleen als:</li>\r\n<li>a.	de uitvoering is begonnen met uitdrukkelijke voorafgaande instemming van de consument; en</li>\r\n<li>b.	de consument heeft verklaard dat hij zijn herroepingsrecht verliest zodra de ondernemer de overeenkomst volledig heeft uitgevoerd;</li>\r\n<li>4.	Pakketreizen als bedoeld in artikel 7:500 BW en overeenkomsten van personenvervoer;</li>\r\n<li>5.	Dienstenovereenkomsten voor terbeschikkingstelling van accommodatie, als in de overeenkomst een bepaalde datum of periode van uitvoering is voorzien en anders dan voor woondoeleinden, goederenvervoer, autoverhuurdiensten en catering;</li>\r\n<li>6.	Overeenkomsten met betrekking tot vrijetijdsbesteding, als in de overeenkomst een bepaalde datum of periode van uitvoering daarvan is voorzien;</li>\r\n<li>7.	Volgens specificaties van de consument vervaardigde producten, die niet geprefabriceerd zijn en die worden vervaardigd op basis van een individuele keuze of beslissing van de consument, of die duidelijk voor een specifieke persoon bestemd zijn;</li>\r\n<li>8.	Producten die snel bederven of een beperkte houdbaarheid hebben;</li>\r\n<li>9.	Verzegelde producten die om redenen van gezondheidsbescherming of hygiëne niet geschikt zijn om te worden teruggezonden en waarvan de verzegeling na levering is verbroken;</li>\r\n<li>10.	Producten die na levering door hun aard onherroepelijk vermengd zijn met andere producten;</li>\r\n<li>11.	Alcoholische dranken waarvan de prijs is overeengekomen bij het sluiten van de overeenkomst, maar waarvan de levering slechts kan plaatsvinden na 30 dagen, en waarvan de werkelijke waarde afhankelijk is van schommelingen van de markt waarop de ondernemer geen invloed heeft;</li>\r\n<li>12.	Verzegelde audio-, video-opnamen en computerprogrammatuur, waarvan de verzegeling na levering is verbroken;</li>\r\n<li>13.	Kranten, tijdschriften of magazines, met uitzondering van abonnementen hierop;</li>\r\n<li>14.	De levering van digitale inhoud anders dan op een materiële drager, maar alleen als:</li>\r\n<li>a.	de uitvoering is begonnen met uitdrukkelijke voorafgaande instemming van de consument; en</li>\r\n<li>b.	de consument heeft verklaard dat hij hiermee zijn herroepingsrecht verliest.</li>\r\n</ul>\r\nArtikel 11 - De prijs<hr>\r\n<ul>\r\n<li>1.	Gedurende de in het aanbod vermelde geldigheidsduur worden de prijzen van de aangeboden producten en/of diensten niet verhoogd, behoudens prijswijzigingen als gevolg van veranderingen in btw-tarieven.</li>\r\n<li>2.	In afwijking van het vorige lid kan de ondernemer producten of diensten waarvan de prijzen gebonden zijn aan schommelingen op de financiële markt en waar de ondernemer geen invloed op heeft, met variabele prijzen aanbieden. Deze gebondenheid aan schommelingen en het feit dat eventueel vermelde prijzen richtprijzen zijn, worden bij het aanbod vermeld.</li> \r\n<li>3.	Prijsverhogingen binnen 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien zij het gevolg zijn van wettelijke regelingen of bepalingen.</li>\r\n<li>4.	Prijsverhogingen vanaf 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien de ondernemer dit bedongen heeft en:</li> \r\n<li>a. deze het gevolg zijn van wettelijke regelingen of bepalingen; of</li>\r\n<li>b. de consument de bevoegdheid heeft de overeenkomst op te zeggen met ingang van de dag waarop de prijsverhoging ingaat.</li>\r\n<li>5.	De in het aanbod van producten of diensten genoemde prijzen zijn inclusief btw.</li>\r\n</ul>\r\nArtikel 12 - Nakoming overeenkomst en extra garantie<hr>\r\n<ul> \r\n<li>1.	De ondernemer staat er voor in dat de producten en/of diensten voldoen aan de overeenkomst, de in het aanbod vermelde specificaties, aan de redelijke eisen van deugdelijkheid en/of bruikbaarheid en de op de datum van de totstandkoming van de overeenkomst bestaande wettelijke bepalingen en/of overheidsvoorschriften. Indien overeengekomen staat de ondernemer er tevens voor in dat het product geschikt is voor ander dan normaal gebruik.</li>\r\n<li>2.	Een door de ondernemer, diens toeleverancier, fabrikant of importeur verstrekte extra garantie beperkt nimmer de wettelijke rechten en vorderingen die de consument op grond van de overeenkomst tegenover de ondernemer kan doen gelden indien de ondernemer is tekortgeschoten in de nakoming van zijn deel van de overeenkomst.</li>\r\n<li>3.	Onder extra garantie wordt verstaan iedere verbintenis van de ondernemer, diens toeleverancier, importeur of producent waarin deze aan de consument bepaalde rechten of vorderingen toekent die verder gaan dan waartoe deze wettelijk verplicht is in geval hij is tekortgeschoten in de nakoming van zijn deel van de overeenkomst.</li>\r\n</ul>\r\nArtikel 13 - Levering en uitvoering<hr>\r\n<ul>\r\n<li>1.	De ondernemer zal de grootst mogelijke zorgvuldigheid in acht nemen bij het in ontvangst nemen en bij de uitvoering van bestellingen van producten en bij de beoordeling van aanvragen tot verlening van diensten.</li>\r\n<li>2.	Als plaats van levering geldt het adres dat de consument aan de ondernemer kenbaar heeft gemaakt.</li>\r\n<li>3.	Met inachtneming van hetgeen hierover in artikel 4 van deze algemene voorwaarden is vermeld, zal de ondernemer geaccepteerde bestellingen met bekwame spoed doch uiterlijk binnen 30 dagen uitvoeren, tenzij een andere leveringstermijn is overeengekomen. Indien de bezorging vertraging ondervindt, of indien een bestelling niet dan wel slechts gedeeltelijk kan worden uitgevoerd, ontvangt de consument hiervan uiterlijk 30 dagen nadat hij de bestelling geplaatst heeft bericht. De consument heeft in dat geval het recht om de overeenkomst zonder kosten te ontbinden en recht op eventuele schadevergoeding.</li>\r\n<li>4.	Na ontbinding conform het vorige lid zal de ondernemer het bedrag dat de consument betaald heeft onverwijld terugbetalen.</li>\r\n<li>5.	Het risico van beschadiging en/of vermissing van producten berust bij de ondernemer tot het moment van bezorging aan de consument of een vooraf aangewezen en aan de ondernemer bekend gemaakte vertegenwoordiger, tenzij uitdrukkelijk anders is overeengekomen.</li>\r\n</ul>\r\nArtikel 14 - Duurtransacties: duur, opzegging en verlenging<hr><br>\r\nOpzegging:\r\n<ul>\r\n<li>1.	De consument kan een overeenkomst die voor onbepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste één maand.</li>\r\n<li>2.	De consument kan een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde tegen het einde van de bepaalde duur opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste één maand.</li>\r\n<li>3.	De consument kan de in de vorige leden genoemde overeenkomsten:</li>\r\n<li>-	te allen tijde opzeggen en niet beperkt worden tot opzegging op een bepaald tijdstip of in een bepaalde periode;</li>\r\n<li>-	tenminste opzeggen op dezelfde wijze als zij door hem zijn aangegaan;</li>\r\n<li>-	altijd opzeggen met dezelfde opzegtermijn als de ondernemer voor zichzelf heeft bedongen.</li>\r\n</ul>\r\nVerlenging:<br>\r\n<ul>\r\n<li>4.	Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, mag niet stilzwijgend worden verlengd of vernieuwd voor een bepaalde duur.</li>\r\n<li>5.	In afwijking van het vorige lid mag een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van dag- nieuws- en weekbladen en tijdschriften stilzwijgend worden verlengd voor een bepaalde duur van maximaal drie maanden, als de consument deze verlengde overeenkomst tegen het einde van de verlenging kan opzeggen met een opzegtermijn van ten hoogste één maand.</li>\r\n<li>6.	Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten of diensten, mag alleen stilzwijgend voor onbepaalde duur worden verlengd als de consument te allen tijde mag opzeggen met een opzegtermijn van ten hoogste één maand. De opzegtermijn is ten hoogste drie maanden in geval de overeenkomst strekt tot het geregeld, maar minder dan eenmaal per maand, afleveren van dag-, nieuws- en weekbladen en tijdschriften.</li>\r\n<li>7.	Een overeenkomst met beperkte duur tot het geregeld ter kennismaking afleveren van dag-, nieuws- en weekbladen en tijdschriften (proef- of kennismakingsabonnement) wordt niet stilzwijgend voortgezet en eindigt automatisch na afloop van de proef- of kennismakingsperiode.</li>\r\n</ul>\r\nDuur:<br>\r\n8.	Als een overeenkomst een duur van meer dan een jaar heeft, mag de consument na een jaar de overeenkomst te allen tijde met een opzegtermijn van ten hoogste één maand opzeggen, tenzij de redelijkheid en billijkheid zich tegen opzegging vóór het einde van de overeengekomen duur verzetten.<br><br>\r\n\r\nArtikel 15 - Betaling<hr>\r\n<ul>\r\n<li>1.	Voor zover niet anders is bepaald in de overeenkomst of aanvullende voorwaarden, dienen de door de consument verschuldigde bedragen te worden voldaan binnen 14 dagen na het ingaan van de bedenktermijn, of bij het ontbreken van een bedenktermijn binnen 14 dagen na het sluiten van de overeenkomst. In geval van een overeenkomst tot het verlenen van een dienst, vangt deze termijn aan op de dag nadat de consument de bevestiging van de overeenkomst heeft ontvangen.</li>\r\n<li>2.	Bij de verkoop van producten aan consumenten mag de consument in algemene voorwaarden nimmer verplicht worden tot vooruitbetaling van meer dan 50%. Wanneer vooruitbetaling is bedongen, kan de consument geen enkel recht doen gelden aangaande de uitvoering van de desbetreffende bestelling of dienst(en), alvorens de bedongen vooruitbetaling heeft plaatsgevonden.</li>\r\n<li>3.	De consument heeft de plicht om onjuistheden in verstrekte of vermelde betaalgegevens onverwijld aan de ondernemer te melden.\r\n<li>4.	Indien de consument niet tijdig aan zijn betalingsverplichting(en) voldoet, is deze, nadat hij door de ondernemer is gewezen op de te late betaling en de ondernemer de consument een termijn van 14 dagen heeft gegund om alsnog aan zijn betalingsverplichtingen te voldoen, na het uitblijven van betaling binnen deze 14-dagen-termijn, over het nog verschuldigde bedrag de wettelijke rente verschuldigd en is de ondernemer gerechtigd de door hem gemaakte buitengerechtelijke incassokosten in rekening te brengen. Deze incassokosten bedragen maximaal: 15% over openstaande bedragen tot € 2.500,=; 10% over de daaropvolgende € 2.500,= en 5% over de volgende € 5.000,= met een minimum van € 40,=. De ondernemer kan ten voordele van de consument afwijken van genoemde bedragen en percentages.</li>\r\n</ul>\r\nArtikel 16 - Klachtenregeling<hr>\r\n<ul>\r\n<li>1.	De ondernemer beschikt over een voldoende bekend gemaakte klachtenprocedure en behandelt de klacht overeenkomstig deze klachtenprocedure.</li>\r\n<li>2.	Klachten over de uitvoering van de overeenkomst moeten binnen bekwame tijd nadat de consument de gebreken heeft geconstateerd, volledig en duidelijk omschreven worden ingediend bij de ondernemer.</li>\r\n<li>3.	Bij de ondernemer ingediende klachten worden binnen een termijn van 14 dagen gerekend vanaf de datum van ontvangst beantwoord. Als een klacht een voorzienbaar langere verwerkingstijd vraagt, wordt door de ondernemer binnen de termijn van 14 dagen geantwoord met een bericht van ontvangst en een indicatie wanneer de consument een meer uitvoerig antwoord kan verwachten.</li>\r\n<li>4.	De consument dient de ondernemer in ieder geval 4 weken de tijd te geven om de klacht in onderling overleg op te lossen. Na deze termijn ontstaat een geschil dat vatbaar is voor de geschillenregeling.</li>\r\n</ul><hr>\r\nArtikel 17 - Geschillen<br>\r\n1.	Op overeenkomsten tussen de ondernemer en de consument waarop deze algemene voorwaarden betrekking hebben, is uitsluitend Nederlands recht van toepassing.<br><br>\r\n\r\nArtikel 18 - Aanvullende of afwijkende bepalingen<hr><br>\r\nAanvullende dan wel van deze algemene voorwaarden afwijkende bepalingen mogen niet ten nadele van de consument zijn en dienen schriftelijk te worden vastgelegd dan wel op zodanige wijze dat deze door de consument op een toegankelijke manier kunnen worden opgeslagen op een duurzame gegevensdrager.<br>\r\n</h5>', 'Algemene Voorwaarden', 'algemene voorwaarden', 'algemene voorwaarden', 'y', 'nl'),
(8, 8, '<h5>\r\nWebsite disclaimer: cover<hr><br>\r\nSEQ Legal LLP<br>\r\n<ul>\r\n<li>1.	This template legal document was produced and published by SEQ Legal LLP.</li>\r\n<li>2.	We control the copyright in this template, and you may only use this template in accordance with the licensing provisions in our terms and conditions. Those licensing provisions include an obligation to retain the SEQ Legal credit incorporated into the template.</li>\r\n<li>3.	The current version of our terms and conditions is available at: http://www.seqlegal.com/our-terms-and-conditions.</li>\r\n<li>4.	If you would like to use this template without the SEQ Legal credit, you can purchase a licence to do so at: http://www.website-contracts.co.uk/seqlegal-licences.html</li>\r\n<li>5.	You will need to edit this template before use. Guidance notes to help you do so are set out at the end of the template. During the editing process, you should delete those guidance notes and this cover sheet. Square brackets in the body of the document indicate areas that require editorial attention. Forward slashes and "ORs" in the body of the document indicate alternative provisions. By the end of the editing process, there should be no square brackets left in the body of the document, and only one alternative from each set of alternatives should remain.</li>\r\n<li>6.	If you have any doubts about the editing or use of this template, you should seek professional legal advice.</li>\r\n<li>7.	You may be able to get free legal guidance using our public Q&A system, available at: http://www.seqlegal.com/questions.</li> \r\n<li>8.	You can request a quote for legal services (including the adaptation or review of a legal document produced from this template) using this form: http://www.seqlegal.com/request-quote.</li>\r\n</ul> \r\n\r\nWebsite disclaimer<br>\r\n1.	Introduction<hr>\r\n<ul>\r\n<li>1.1	This disclaimer shall govern your use of our website.</li>\r\n<li>1.2	By using our website, you accept this disclaimer in full; accordingly, if you disagree with this disclaimer or any part of this disclaimer, you must not use our website.</li>\r\n<li>1.3	Our website uses cookies; by using our website or agreeing to this disclaimer, you consent to our use of cookies in accordance with the terms of our [privacy and cookies policy].</li>\r\n</ul>\r\n2.	Credit<hr>\r\n<ul>\r\n<li>2.1	This document was created using a template from SEQ Legal (http://www.seqlegal.com).</li>\r\n	You must retain the above credit, unless you purchase a licence to use this document without the credit. You can purchase a licence at: http://www.website-contracts.co.uk/seqlegal-licences.html. Warning: use of this document without the credit, or without purchasing a licence, is an infringement of copyright.</li>\r\n</ul>	\r\n3.	Copyright notice<hr>\r\n<ul>\r\n<li>3.1	Copyright (c) [2015] [Pieter Spierenburg].</li>\r\n<li>3.2	Subject to the express provisions of this disclaimer:</li>\r\n<li>(a)	we, together with our licensors, own and control all the copyright and other intellectual property rights in our website and the material on our website; and</li>\r\n<li>(b)	all the copyright and other intellectual property rights in our website and the material on our website are reserved.</li>\r\n</ul>\r\n4.	Licence to use website<hr>\r\n<ul>\r\n<li>4.1	You may:</li>\r\n<li>(a)	view pages from our website in a web browser;</li>\r\n<li>(b)	download pages from our website for caching in a web browser; and</li>\r\n<li>(c)	print pages from our website,\r\n	subject to the other provisions of this disclaimer.</li>\r\n<li>4.2	Except as expressly permitted by Section 4.1 or the other provisions of this disclaimer, you must not download any material from our website or save any such material to your computer.</li>\r\n<li>4.3	You may only use our website for [your own personal and business purposes], and you must not use our website for any other purposes.</li>\r\n<li>4.4	Unless you own or control the relevant rights in the material, you must not:</li>\r\n<li>(a)	republish material from our website (including republication on another website);</li>\r\n<li>(b)	sell, rent or sub-license material from our website;</li>\r\n<li>(c)	show any material from our website in public;</li>\r\n<li>(d)	exploit material from our website for a commercial purpose; or</li>\r\n<li>(e)	redistribute material from our website.</li>\r\n<li>4.5	We reserve the right to restrict access to areas of our website, or indeed our whole website, at our discretion; you must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.</li>\r\n</ul>\r\n5.	Acceptable use<hr>\r\n<ul>\r\n<li>5.1	You must not:</li>\r\n<li>(a)	use our website in any way or take any action that causes, or may cause, damage to the website or impairment of the performance, availability or accessibility of the website;</li>\r\n<li>(b)	use our website in any way that is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity;</li>\r\n<li>(c)	use our website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software;</li>\r\n<li>(d)	conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to our website without our express written consent;</li>\r\n<li>(e)	[access or otherwise interact with our website using any robot, spider or other automated means;]</li>\r\n<li>(f)	[violate the directives set out in the robots.txt file for our website; or]</li>\r\n<li>(g)	[use data collected from our website for any direct marketing activity (including without limitation email marketing, SMS marketing, telemarketing and direct mailing).]</li>\r\n<li>5.2	You must not use data collected from our website to contact individuals, companies or other persons or entities.</li>\r\n<li>5.3	You must ensure that all the information you supply to us through our website, or in relation to our website, is [true, accurate, current, complete and non-misleading].</li>\r\n</ul>\r\n6.	Limited warranties<hr>\r\n<ul>\r\n<li>6.1	We do not warrant or represent:</li>\r\n<li>(a)	the completeness or accuracy of the information published on our website;</li>\r\n<li>(b)	that the material on the website is up to date; or</li>\r\n<li>(c)	that the website or any service on the website will remain available.</li>\r\n<li>6.2	We reserve the right to discontinue or alter any or all of our website services, and to stop publishing our website, at any time in our sole discretion without notice or explanation; and save to the extent expressly provided otherwise in this disclaimer, you will not be entitled to any compensation or other payment upon the discontinuance or alteration of any website services, or if we stop publishing the website.</li>\r\n<li>6.3	To the maximum extent permitted by applicable law and subject to Section 7.1, we exclude all representations and warranties relating to the subject matter of this disclaimer, our website and the use of our website.</li>\r\n</ul>\r\n7.	Limitations and exclusions of liability<hr>\r\n<ul>\r\n<li>7.1	Nothing in this disclaimer will:</li>\r\n<li>(a)	limit or exclude any liability for death or personal injury resulting from negligence;</li>\r\n<li>(b)	limit or exclude any liability for fraud or fraudulent misrepresentation;</li>\r\n<li>(c)	limit any liabilities in any way that is not permitted under applicable law; or</li>\r\n<li>(d)	exclude any liabilities that may not be excluded under applicable law.</li>\r\n<li>7.2	The limitations and exclusions of liability set out in this Section 7 and elsewhere in this disclaimer:</li> \r\n<li>(a)	are subject to Section 7.1; and</li>\r\n<li>(b)	govern all liabilities arising under the disclaimer or relating to the subject matter of the disclaimer, including liabilities arising in contract, in tort (including negligence) and for breach of statutory duty, except to the extent expressly provided otherwise in the disclaimer.</li>\r\n<li>7.3	To the extent that our website and the information and services on our website are provided free of charge, we will not be liable for any loss or damage of any nature.</li>\r\n<li>7.4	We will not be liable to you in respect of any losses arising out of any event or events beyond our reasonable control.</li>\r\n<li>7.5	We will not be liable to you in respect of any business losses, including (without limitation) loss of or damage to profits, income, revenue, use, production, anticipated savings, business, contracts, commercial opportunities or goodwill.</li>\r\n<li>7.6	We will not be liable to you in respect of any loss or corruption of any data, database or software.</li>\r\n<li>7.7	We will not be liable to you in respect of any special, indirect or consequential loss or damage.</li>\r\n<li>7.8	You accept that we have an interest in limiting the personal liability of our officers and employees and, having regard to that interest, you acknowledge that we are a limited liability entity; you agree that you will not bring any claim personally against our officers or employees in respect of any losses you suffer in connection with the website or this disclaimer (this will not, of course, limit or exclude the liability of the limited liability entity itself for the acts and omissions of our officers and employees).</li>\r\n</ul>\r\n8.	Variation<hr>\r\n<ul>\r\n<li>8.1	We may revise this disclaimer from time to time.</li>\r\n<li>8.2	The revised disclaimer shall apply to the use of our website from the time of publication of the revised disclaimer on the website.</li>\r\n</ul> \r\n9.	Severability<hr>\r\n<ul>\r\n<li>9.1	If a provision of this disclaimer is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect.</li>\r\n<li>9.2	If any unlawful and/or unenforceable provision of this disclaimer would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect. </li>\r\n<li>10.	Law and jurisdiction\r\n<li>10.1	This disclaimer shall be governed by and construed in accordance with [dutch-law].</li>\r\n<li>10.2	Any disputes relating to this disclaimer shall be subject to the [exclusive / non-exclusive] jurisdiction of the courts of [Netherlands].</li>\r\n</ul>\r\n11.	Statutory and regulatory disclosures<hr>\r\n<ul>\r\n<li>11.1	We are registered in [trade register]; you can find the online version of the register at [URL], and our registration number is [number].</li>\r\n<li>11.2	We are subject to [authorisation scheme], which is supervised by [supervisory authority].</li>\r\n<li>11.3	We are registered as [title] with [professional body] in [the Netherlands] and are subject to [rules], which can be found at [URL].</li>\r\n<li>11.4	We subscribe to [code(s) of conduct], which can be consulted electronically at [URL(s)].</li>\r\n<li>11.5	Our VAT number is [number].\r\n</ul>\r\n12.	Our details<hr>\r\n<ul>\r\n<li>12.1	This website is owned and operated by [name].</li>\r\n<li>12.2	We are registered in [Netherlands] under registration number [number], and our registered office is at [address].</li>\r\n<li>12.3	Our principal place of business is at [address].</li>\r\n<li>12.4	You can contact us by writing to the business address given above, by using our website contact form, by email to [spierenburg@law.eur.nl] or by telephone on [0611164440].</li>\r\n</ul>\r\n</h5>', 'Disclaimer', 'disclaimer', 'disclaimer', 'y', 'nl');
INSERT INTO `pages` (`page_id`, `page_nav_id`, `page_content`, `page_title`, `page_description`, `page_keywords`, `page_show`, `page_taal`) VALUES
(9, 9, '<h5>\r\nPrivacy Policy VOORBEELD<hr>\r\n<p> \r\n<i>Pieterspierenburg.com</i> zal de privacy van alle gebruikers van haar site waarborgen en wij zullen ten alle tijden de persoonlijke informatie die u aan ons verschaft vertrouwelijk wordt behandeld.<br> Wij zullen uw gegevens slechts gebruiken om de bestellingen zo snel en gemakkelijk mogelijk te laten verlopen.<br> Voor het overige zullen wij deze gegevens uitsluitend gebruiken met uw toestemming. Pieterspierenburg.com zal uw persoonlijke gegevens niet aan derden verkopen en zal deze uitsluitend aan derden ter beschikking stellen die zijn betrokken bij het uitvoeren van uw bestelling.<br><br> \r\n \r\nPieterspierenburg.com gebruikt de verzamelde gegevens om haar klanten de volgende diensten te leveren:\r\n<ul> \r\n<li>Als u een bestelling of offerteaanvraag plaatst, hebben we uw naam, e-mailadres, afleveradres en betaalgegevens nodig om uw bestelling uit te voeren en u van het verloop daarvan op de hoogte te houden.</li> \r\n \r\n<li>Om het winkelen en het proces van offerte aanvragen bij Pieterspierenburg.com zo aangenaam mogelijk te laten zijn, slaan wij met uw toestemming uw persoonlijke gegevens en de gegevens met betrekking tot uw bestelling of offerteaanvraag en het gebruik van onze diensten op. Hierdoor kunnen wij de website persoonlijker maken.</li>  \r\n \r\n<li> kunnen uw e-mailadres gebruiken om u informatie te verschaffen over de ontwikkeling van onze website en over onze speciale aanbiedingen en acties. Als u hier geen prijs op stelt, kunt u zich uitschrijven via onze website.</li>  \r\n \r\n<li>Indien u bij Pieterspierenburg.com een bestelling plaatst bewaren wij, indien gewenst, uw gegevens op een Secure Server. U kunt een gebruikersnaam en wachtwoord opgeven zodat uw naam en adres, telefoonnummer, e-mailadres, aflever- en betaalgegevens, zodat u deze niet bij iedere nieuwe bestelling hoeft in te vullen.</li>  \r\n \r\n<li>Gegevens over het gebruik van onze site en de feedback die we krijgen van onze bezoekers helpen ons om onze site verder te ontwikkelen en te verbeteren. Als u besluit een recensie te schrijven, kunt u zelf kiezen of u uw naam of andere persoonlijke gegevens toevoegt. We zijn benieuwd naar de meningen van onze bezoekers, maar behouden het recht bijdragen die niet aan onze sitevoorwaarden voldoen niet te publiceren.</li>  \r\n \r\n<li>Als u reageert op een actie of prijsvraag, vragen wij uw naam, adres en e-mailadres. Deze gegevens gebruiken we om de actie uit te voeren, de prijswinnaar(s) bekend te maken, en de respons op onze marketingacties te meten.</li>  \r\n </ul>\r\nPieterspierenburg.com verkoopt uw gegevens niet<br> \r\nPersoonlijke gegevens zullen nooit aan derden verkocht worden en zal deze uitsluitend aan derden ter beschikking stellen indien deze betrokken zijn bij het uitvoeren van uw bestelling. Onze werknemers en door ons ingeschakelde derden zijn verplicht om de vertrouwelijkheid van uw gegevens te respecteren.<br><br> \r\n  \r\nCookies<hr><br> \r\nCookies zijn kleine stukjes informatie die door uw browser worden opgeslagen op uw computer.<br> \r\nOnze website gebruikt deze cookies om u te herkennen bij een volgend bezoek. Deze Cookies stellen ons in staat om informatie te verzamelen over het gebruik van onze diensten en deze te verbeteren en aan te passen aan de wensen van onze bezoekers. Onze cookies geven informatie met betrekking tot persoonsidentificatie. U kunt uw browser ook zo instellen dat u tijdens het winkelen bij Pieterspierenburg.com geen cookies ontvangt.<hr><br><br> \r\n \r\nIndien u nog vragen mocht hebben over de Privacy Policy van Onze website, dan kunt u contact met ons opnemen. Onze klantenservice helpt u verder als u informatie nodig heeft over uw gegevens of als u deze wilt wijzigen. In geval wijziging van onze Privacy Policy nodig mocht zijn, dan vindt u op deze pagina altijd de meest recente informatie. \r\n\r\n</h5>', 'Privacy Beleid', 'privacy beleid', 'privacy, beleid, regels', 'y', 'nl'),
(10, 50, '', 'Administrator Panel HumanicIC', 'administrator taken', 'administrator taken, HumanicIC', 'y', 'nl'),
(11, 5, '', 'CV-UPLOAD', 'cv-upload', 'cv, upload', 'y', 'nl'),
(12, 12, '<div id=introtext>Administrator App<hr>   <br><br>\r\n<h4 class=beheer>Beheerders: </h4>\r\n<ul id= adminapp>\r\n<li>Elmar Geurts</li><br><br>\r\n<li>Frank Breet</li>\r\n</div>', '<div id=header>HumanIC Query Straat</div>', 'database queries', 'humanic, queries, database', 'y', 'nl'),
(13, 10, '<div class="container" id="inlogMelding">\r\n\r\n\r\n<div class="profkop">\r\n			<h3 class="pf">In je<a  href="kandidaat.php"> profiel</a> kun je:</h3>\r\n				<ul class="prof">\r\n					<li>Je persoonlijke gegevens invullen/aanpassen</li> \r\n					<li>Je foto en CV uploaden.</li>\r\n					<li>Aangeven voor welke IT functies je gevraagd wilt worden</li>\r\n					<li>Aangeven in welke regio''s je wilt werken</li>\r\n					<li>Aangeven in welke sectoren je ervaring hebt.</li>\r\n				</ul>\r\n			<aside class="meer">Hoe meer gegevens je invult, hoe beter we je kunnen helpen.</aside><br/><br/>\r\n</div>			\r\n			<p class="naarProfiel">\r\n					<a class="btn btn-primary btn-md" href="kandidaat.php">Je kan hier naar je profiel </a>\r\n			</p>          \r\n </div>', '<h2 style="text-align:center;" class="welkom">Welkom, je bent ingelogd</h2>', '', '', 'y', 'nl'),
(14, 22, '', '<div class=wachtwoord>Wachtwoord wijzigen</div>', 'wachtwoord wijzigen', 'wachtwoord wijzigen', 'y', 'nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regio`
--

CREATE TABLE IF NOT EXISTS `regio` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `regio`
--

INSERT INTO `regio` (`id`, `naam`) VALUES
(1, 'Noord-Holland'),
(2, 'Zuid-Holland'),
(3, 'Zeeland'),
(4, 'Noord-Brabant'),
(5, 'Limburg'),
(6, 'Gelderland'),
(7, 'Overijssel'),
(8, 'Utrecht'),
(9, 'Flevoland'),
(10, 'Drenthe'),
(11, 'Groningen'),
(12, 'Friesland'),
(13, 'Amsterdam e.o.'),
(14, 'Rotterdam e.o.'),
(15, 'Den Haag'),
(16, 'Eindhoven e.o.'),
(17, 'Nijmegen');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `regio_view`
--
CREATE TABLE IF NOT EXISTS `regio_view` (
`regio_id` int(11)
,`regio_naam` varchar(50)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sector_id` int(2) NOT NULL,
  `sector_naam` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_naam`) VALUES
(1, 'ICT'),
(2, 'Zorg'),
(3, 'Industrie'),
(4, 'Retail');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `sector_view`
--
CREATE TABLE IF NOT EXISTS `sector_view` (
`sector_id` int(2)
,`sector_naam` varchar(50)
);

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_bedrijf`
--

CREATE TABLE IF NOT EXISTS `user_bedrijf` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `bedrijf_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_bedrijf`
--

INSERT INTO `user_bedrijf` (`id`, `user_id`, `bedrijf_id`) VALUES
(1, 3, 1),
(2, 2, 4),
(4, 0, 4),
(5, 7, 4),
(6, 45, 4),
(7, 16, 2),
(8, 34, 4),
(9, 10, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_functie`
--

CREATE TABLE IF NOT EXISTS `user_functie` (
  `user_functie_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `functie_id` int(3) NOT NULL,
  `ervaring` int(2) NOT NULL,
  `nwFunctie` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

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
(78, 5, 4, 4, ''),
(102, 6, 1, 0, ''),
(103, 6, 4, 0, ''),
(104, 7, 1, 6, ''),
(105, 7, 4, 4, ''),
(119, 10, 1, 5, ' '),
(120, 10, 2, 9, ' '),
(121, 10, 3, 7, ' '),
(122, 10, 4, 2, ' '),
(123, 10, 5, 4, ' '),
(124, 10, 6, 7, ' '),
(130, 10, 99, 0, 'flamenco danseres'),
(132, 34, 10, 0, 'flamenco danseres'),
(134, 34, 1, 5, 'flamenco danseres'),
(136, 34, 2, 4, 'flamenco danseres'),
(137, 34, 3, 8, 'flamenco danseres'),
(138, 34, 4, 4, 'flamenco danseres'),
(139, 34, 5, 6, 'flamenco danseres'),
(140, 34, 6, 8, 'flamenco danseres'),
(141, 34, 7, 7, 'flamenco danseres'),
(142, 34, 8, 9, 'flamenco danseres'),
(143, 34, 9, 7, 'flamenco danseres'),
(144, 18, 1, 7, 'vissen'),
(145, 18, 2, 5, 'vissen'),
(146, 18, 3, 7, 'vissen'),
(147, 18, 4, 5, 'vissen'),
(148, 18, 5, 6, 'vissen'),
(149, 18, 6, 7, 'vissen'),
(150, 18, 7, 6, 'vissen'),
(151, 18, 8, 6, 'vissen'),
(152, 18, 9, 7, 'vissen'),
(153, 18, 10, 0, 'vissen'),
(154, 18, 99, 0, 'vissen'),
(156, 3, 1, 5, 'hitman'),
(157, 3, 99, 8, 'hitman'),
(158, 43, 1, 5, ''),
(159, 43, 3, 9, ''),
(160, 3, 2, 6, 'hitman');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `user_functie_view`
--
CREATE TABLE IF NOT EXISTS `user_functie_view` (
`user_id` int(5)
,`user_functie_id` int(8)
,`ervaring` int(2)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_regio`
--

CREATE TABLE IF NOT EXISTS `user_regio` (
  `user_regio_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `regio_id` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_regio`
--

INSERT INTO `user_regio` (`user_regio_id`, `user_id`, `regio_id`) VALUES
(1, 3, 6),
(2, 3, 10),
(5, 3, 13),
(6, 3, 8),
(40, 6, 8),
(41, 6, 13),
(47, 2, 13),
(48, 2, 8),
(49, 2, 1),
(50, 2, 5),
(58, 5, 8),
(59, 5, 13),
(81, 7, 1),
(82, 7, 13),
(83, 15, 12),
(84, 45, 8),
(85, 45, 13),
(86, 16, 5),
(87, 16, 12),
(88, 10, 13),
(89, 21, 13),
(90, 16, 13),
(91, 43, 13),
(92, 20, 13),
(93, 8, 13),
(94, 6, 9),
(95, 6, 11),
(96, 7, 4),
(97, 7, 6),
(99, 11, 1),
(100, 11, 2),
(101, 11, 3),
(102, 11, 4),
(103, 11, 5),
(104, 11, 6),
(105, 11, 7),
(106, 11, 8),
(107, 11, 9),
(108, 11, 10),
(109, 11, 11),
(110, 11, 12),
(111, 11, 13),
(112, 11, 14),
(113, 11, 15),
(114, 11, 16),
(115, 14, 6),
(116, 14, 7),
(117, 14, 13),
(118, 15, 13),
(119, 15, 16),
(120, 18, 13),
(121, 34, 13),
(122, 22, 13),
(123, 24, 13),
(124, 18, 7),
(125, 34, 4);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `user_regio_view`
--
CREATE TABLE IF NOT EXISTS `user_regio_view` (
`user_id` int(5)
,`regio_id` int(3)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_sector`
--

CREATE TABLE IF NOT EXISTS `user_sector` (
  `user_sector_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `sector_id` int(2) NOT NULL,
  `jaren` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_sector`
--

INSERT INTO `user_sector` (`user_sector_id`, `user_id`, `sector_id`, `jaren`) VALUES
(1, 2, 1, 'jaren_gewe'),
(2, 2, 2, 'jaren_gewe'),
(3, 2, 3, 'jaren_gewe'),
(4, 2, 4, 'jaren_gewe'),
(5, 1, 1, ''),
(6, 1, 4, ''),
(7, 3, 1, 'jaren_gewe'),
(8, 3, 4, 'jaren_gewe'),
(9, 5, 1, 'jaren_gewe'),
(10, 6, 1, 'jaren_gewe'),
(11, 6, 4, 'jaren_gewe'),
(12, 0, 1, ''),
(13, 0, 4, ''),
(14, 0, 2, ''),
(15, 0, 3, ''),
(16, 7, 1, 'jaren_gewe'),
(17, 15, 1, '15jaren_ge'),
(18, 45, 3, '0jaren_gew'),
(19, 16, 1, '15jaren_ge'),
(20, 18, 3, '15jaren_ge'),
(21, 18, 1, '35jaren_ge'),
(22, 34, 1, '0'),
(23, 10, 1, '0');

-- --------------------------------------------------------

--
-- Structuur voor de view `bedrijf_view`
--
DROP TABLE IF EXISTS `bedrijf_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bedrijf_view` AS select `bedrijf`.`id` AS `bedrijf_id`,`bedrijf`.`aantal_medewerkers` AS `grootte` from `bedrijf`;

-- --------------------------------------------------------

--
-- Structuur voor de view `functie_view`
--
DROP TABLE IF EXISTS `functie_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `functie_view` AS select `functie`.`functie_id` AS `functie_id`,`functie`.`functie_naam` AS `functie_naam` from `functie`;

-- --------------------------------------------------------

--
-- Structuur voor de view `kandiaten_vw`
--
DROP TABLE IF EXISTS `kandiaten_vw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kandiaten_vw` AS select `user`.`user_id` AS `user_id`,`user`.`user_email` AS `user_email`,`user`.`achternaam` AS `achternaam`,`user`.`tussenvoegsel` AS `tussenvoegsel`,`user`.`voornaam` AS `voornaam`,`user`.`plaats` AS `plaats`,`user`.`telefoon` AS `telefoon`,`user`.`foto` AS `foto`,`user`.`cv` AS `cv`,`user`.`geboortedatum` AS `geboortedatum`,`user`.`salaris` AS `salaris`,`user`.`uitkering` AS `uitkering`,`user`.`uitkering_geldig_tot` AS `uitkering_geldig_tot`,`user`.`rijbewijs` AS `rijbewijs`,`user`.`auto` AS `auto`,`user`.`reisafstand` AS `reisafstand`,`user`.`opmerking` AS `opmerking`,`user`.`linkedin` AS `linkedin`,`user`.`facebook` AS `facebook`,`user`.`twitter` AS `twitter`,`user_functie`.`ervaring` AS `ervaring`,`functie_view`.`functie_naam` AS `functie_naam`,`bedrijf_view`.`grootte` AS `grootte`,`regio_view`.`regio_naam` AS `regio_naam`,`sector_view`.`sector_naam` AS `sector_naam` from ((((`user` left join (`user_functie` join `functie_view` on((`functie_view`.`functie_id` = `user_functie`.`functie_id`))) on((`user_functie`.`user_id` = `user`.`user_id`))) left join (`user_regio` join `regio_view` on((`regio_view`.`regio_id` = `user_regio`.`regio_id`))) on((`user_regio`.`user_id` = `user`.`user_id`))) left join (`user_bedrijf` join `bedrijf_view` on((`user_bedrijf`.`bedrijf_id` = `bedrijf_view`.`bedrijf_id`))) on((`user_bedrijf`.`user_id` = `user`.`user_id`))) left join (`user_sector` join `sector_view` on((`user_sector`.`sector_id` = `sector_view`.`sector_id`))) on((`user_sector`.`user_id` = `user`.`user_id`)));

-- --------------------------------------------------------

--
-- Structuur voor de view `kandidaten`
--
DROP TABLE IF EXISTS `kandidaten`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kandidaten` AS select distinct `user`.`user_id` AS `user_id`,`user`.`voornaam` AS `voornaam`,`user`.`tussenvoegsel` AS `tussenvoegsel`,`user`.`achternaam` AS `achternaam`,`functie`.`functie_naam` AS `naam`,`user`.`foto` AS `foto`,`user`.`cv` AS `cv`,`user`.`user_email` AS `user_email` from (((((`user` left join (`user_bedrijf` join `bedrijf` on((`user_bedrijf`.`bedrijf_id` = `bedrijf`.`id`))) on((`user_bedrijf`.`user_id` = `user`.`user_id`))) left join (`user_functie` join `functie` on((`user_functie`.`functie_id` = `functie`.`functie_id`))) on((`user_functie`.`user_id` = `user`.`user_id`))) left join (`user_regio` join `regio` on((`user_regio`.`regio_id` = `regio`.`id`))) on((`user_regio`.`user_id` = `user`.`user_id`))) left join (`user_sector` join `sector` `s1` on((`user_sector`.`sector_id` = `s1`.`sector_id`))) on((`user_sector`.`user_id` = `user`.`user_id`))) left join (`gewenste_sector` join `sector` `s2` on((`gewenste_sector`.`sector_id` = `s2`.`sector_id`))) on((`gewenste_sector`.`user_id` = `user`.`user_id`)));

-- --------------------------------------------------------

--
-- Structuur voor de view `regio_view`
--
DROP TABLE IF EXISTS `regio_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `regio_view` AS select `regio`.`id` AS `regio_id`,`regio`.`naam` AS `regio_naam` from `regio`;

-- --------------------------------------------------------

--
-- Structuur voor de view `sector_view`
--
DROP TABLE IF EXISTS `sector_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sector_view` AS select `sector`.`sector_id` AS `sector_id`,`sector`.`sector_naam` AS `sector_naam` from `sector`;

-- --------------------------------------------------------

--
-- Structuur voor de view `user_functie_view`
--
DROP TABLE IF EXISTS `user_functie_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `user_functie_view` AS select `user_functie`.`user_id` AS `user_id`,`user_functie`.`user_functie_id` AS `user_functie_id`,`user_functie`.`ervaring` AS `ervaring` from `user_functie`;

-- --------------------------------------------------------

--
-- Structuur voor de view `user_regio_view`
--
DROP TABLE IF EXISTS `user_regio_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`localhost` SQL SECURITY DEFINER VIEW `user_regio_view` AS select `user_regio`.`user_id` AS `user_id`,`user_regio`.`regio_id` AS `regio_id` from `user_regio`;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bedrijf`
--
ALTER TABLE `bedrijf`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bedrijf_gewerkt`
--
ALTER TABLE `bedrijf_gewerkt`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexen voor tabel `functie`
--
ALTER TABLE `functie`
  ADD PRIMARY KEY (`functie_id`);

--
-- Indexen voor tabel `gewenste_sector`
--
ALTER TABLE `gewenste_sector`
  ADD PRIMARY KEY (`gewenste_sector_id`);

--
-- Indexen voor tabel `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`nav_id`);

--
-- Indexen voor tabel `navadmin`
--
ALTER TABLE `navadmin`
  ADD PRIMARY KEY (`navadmin_id`);

--
-- Indexen voor tabel `nav_nl`
--
ALTER TABLE `nav_nl`
  ADD PRIMARY KEY (`nav_nl_id`);

--
-- Indexen voor tabel `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexen voor tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexen voor tabel `regio`
--
ALTER TABLE `regio`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexen voor tabel `user_bedrijf`
--
ALTER TABLE `user_bedrijf`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_functie`
--
ALTER TABLE `user_functie`
  ADD PRIMARY KEY (`user_functie_id`);

--
-- Indexen voor tabel `user_regio`
--
ALTER TABLE `user_regio`
  ADD PRIMARY KEY (`user_regio_id`);

--
-- Indexen voor tabel `user_sector`
--
ALTER TABLE `user_sector`
  ADD PRIMARY KEY (`user_sector_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bedrijf`
--
ALTER TABLE `bedrijf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `bedrijf_gewerkt`
--
ALTER TABLE `bedrijf_gewerkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `functie`
--
ALTER TABLE `functie`
  MODIFY `functie_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT voor een tabel `gewenste_sector`
--
ALTER TABLE `gewenste_sector`
  MODIFY `gewenste_sector_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT voor een tabel `nav`
--
ALTER TABLE `nav`
  MODIFY `nav_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT voor een tabel `navadmin`
--
ALTER TABLE `navadmin`
  MODIFY `navadmin_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `nav_nl`
--
ALTER TABLE `nav_nl`
  MODIFY `nav_nl_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `online`
--
ALTER TABLE `online`
  MODIFY `online_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT voor een tabel `regio`
--
ALTER TABLE `regio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT voor een tabel `user_bedrijf`
--
ALTER TABLE `user_bedrijf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `user_functie`
--
ALTER TABLE `user_functie`
  MODIFY `user_functie_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT voor een tabel `user_regio`
--
ALTER TABLE `user_regio`
  MODIFY `user_regio_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT voor een tabel `user_sector`
--
ALTER TABLE `user_sector`
  MODIFY `user_sector_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
