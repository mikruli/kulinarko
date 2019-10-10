-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2019 at 09:19 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kulinarko`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

DROP TABLE IF EXISTS `kategorije`;
CREATE TABLE IF NOT EXISTS `kategorije` (
  `id_kategorije` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_kategorije` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategorije`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_kategorije`, `naziv_kategorije`) VALUES
(1, 'predjelo'),
(2, 'glavno jelo'),
(3, 'supa i čorba'),
(4, 'kolač'),
(5, 'torta'),
(6, 'salata');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `korisnicko_ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'korisnicko ime mora biti jedinstveno',
  `lozinka` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `el_adresa` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `adresa_stanovanja` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drzava_stanovanja` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pol` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobilni_telefon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnicko_ime`, `lozinka`, `ime`, `prezime`, `el_adresa`, `datum_rodjenja`, `adresa_stanovanja`, `drzava_stanovanja`, `pol`, `telefon`, `mobilni_telefon`, `administrator`) VALUES
('ana', '01bb2464c09e36e7b686c976ae6bc2780f58330abebe1a9642813cb64207d309', 'Ana', 'Zivanovic', 'ana20@gmail.com', '1999-09-07', 'Bulevar Revolucije 17, Beograd', 'Srbija', 'Z', '011-2122-434', '064-715-888', 0),
('dejan', 'e539ada4f0efabad2513920fbaad91202793ac04d65ff7a2857cae622541439d', 'Dejan', 'Pavlovic', 'dejan30@gmail.com', '1972-03-19', 'Cara Lazara 8', 'Srbija', 'M', '011-3759-583', '063-222-222', 1),
('ilija', '8e0a894e6cc38b269db79a495109134d3be1b90b50719147438bc6eb4c054ccd', 'Ilija', 'Pavlovic', 'ilija30@gmail.com', '1975-01-29', 'Ilije Stojadinovica 8, Beograd', 'Srbija', 'M', '011-3315-128', '065-7165-978', 0),
('jelena', '832a8aa5dfa95b8ad7a281706f79a362133c18c27550c101ac2f76c6d66d34e1', 'Jelena', 'Petrovic', 'jelena30@gmail.com', '1989-02-21', 'Lipa 8, Beograd', 'Srbija', 'Z', '011-3712-718', '063-625-312', 0),
('jovan', 'e3477625b08f02f644d626e8f78359434c046b353b80656d5611556b831d52ac', 'Jovan', 'Jelic', 'jovan30@gmail.com', '1988-04-12', 'Pozeska 7, Beograd', 'Srbija', 'M', '011-2352-318', '064-528-119', 0),
('luka', 'db315f875f0b0687f5710ddfc71edc394a720cef09bb36136df5f48faf082b6e', 'Luka', 'Vojvodic', 'luka30@gmail.com', '1994-04-25', 'Arcibalda Rajsa 12, Beograd', 'Srbija', 'M', '011-3199-445', '069-1111-222', 0),
('marko', 'f8803b2368ec963df74ec52b4726a3284922a704c0aeb05915bdb8ec0bc75a37', 'Marko', 'Pavlovic', 'marko22@gmail.com', '1997-09-23', 'Ane Ahmatove 12, Beograd', 'Srbija', 'M', '011-2482-538', '063-452-198', 0),
('misa', '0045b274f98a70d6e12daef175e1de1af5141b008706044b4a6d7d709a976161', 'Miodrag', 'Marinkovic', 'misa40@gmail.com', '1979-05-23', 'Radnicka 121, Beograd', 'Srbija', 'M', '011-4132-917', '069-715-738', 0),
('momo', '26cd0987cdec11d8ac59049d4f50807349d4c6688a5c5292cc3dbf0eca2bff26', 'Momir', 'Markovic', 'momo30@gmail.com', '1998-03-18', 'Visnjicka 17', 'Srbija', 'M', '011-3192-295', '065-9136-833', 0),
('nina', '163dca0f9bb8e6e10972192b8cd468aecbd35a46a1411f5e467e2463d22cf390', 'Nina', 'Nesic', 'nina47@gmail.com', '1972-01-23', 'Bulevar mira 17, Beograd', 'Srbija', 'Z', '011-2212-414', '065-1435-312', 0),
('pavle', '09c22ea0c0f3895f88123ecf0dd1cea53e93347871c2ba39d034072d09b4e8ae', 'Pavle', 'Markovic', 'pavle30@gmail.com', '1985-03-21', 'Breza 2, Beograd', 'Srbija', 'M', '011-3472-118', '063-135-208', 0),
('pera', '5127f8458d015c84ae0887ed13b35e774d63b1ed0af5908f37f7321de78966f9', 'Petar', 'Markovic', 'pera30@gmail.com', '1972-07-08', 'Nehruova 7, Beograd', 'Srbija', 'M', '011-3452-418', '069-435-908', 0),
('stefan', 'd7b6ace32b9452ed317aa64dd793d2e5321f34216ff098766c730fdf08775602', 'Stefan', 'Pecarski', 'stefan25@gmail.com', '1994-12-01', 'Ustanicka 26, Beograd', 'Srbija', 'M', '011-1412-329', '064-236-311', 0),
('zora', 'a4dfb728fb54a2745a794d89b6bf15191dc155a6e2dccf601b177be0363442da', 'Zorka', 'Mirkovic', 'zora30@gmail.com', '1982-02-17', 'Marka Oreskovica 12, Beograd', 'Srbija', 'Z', '011-2299-777', '069-9825-812', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

DROP TABLE IF EXISTS `ocena`;
CREATE TABLE IF NOT EXISTS `ocena` (
  `ocena_id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `recept_id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `komentar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ocena_id`),
  KEY `ocena_korisnika` (`korisnicko_ime`),
  KEY `ocena_recepta` (`recept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recepti`
--

DROP TABLE IF EXISTS `recepti`;
CREATE TABLE IF NOT EXISTS `recepti` (
  `recept_id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_recepta` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sastojci` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slika_jela` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sadrzaj_recepta` text COLLATE utf8_unicode_ci NOT NULL,
  `kategorija_jela` int(11) NOT NULL,
  `datum_unosa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vreme_pripreme` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `autor_recepta` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`recept_id`),
  KEY `recept_korisnika` (`autor_recepta`),
  KEY `kategorija_recepta` (`kategorija_jela`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recepti`
--

INSERT INTO `recepti` (`recept_id`, `naziv_recepta`, `sastojci`, `slika_jela`, `sadrzaj_recepta`, `kategorija_jela`, `datum_unosa`, `vreme_pripreme`, `autor_recepta`) VALUES
(1, 'Pileći kroketi sa susamom', '300 g pilećeg belog mesa, po ukusu so, 1 kašičica suvog biljnog začina, 150 g brašna, 150 g prezli, 3 jajeta, 2 kašike susama. Za prženje: ulje po potrebi.', './fotografije/01_pileci_kroketi_sa_susamom.jpg', 'Pileće belo meso iseći na uže, duže delove i posoliti ih. Jaja razmutiti ručnom žicom za mućenje. U odgovarajućoj posudi sjediniti prezle i susam, dodati suvi biljni začin i izmešati. Brašno staviti u činiju,pa u njega uvaljati meso, potom u razmućena jaja i na kraju u mešavinu prezli, susama i suvog biljnog začina. Pržiti na zagrejanom ulju dok me porumene sa obe strane. Odlagati na kuhinjski papir kako bi se ocedio višak masnoće. Servirati i poslužiti.', 2, '2019-10-10 20:17:10', '30 min.', 'marko'),
(2, 'Pariske šnicle', '1 pileće belo meso, 100 g brašna, 2 jajeta, malo soli i suvih začina, malo ulja za prženje i prilog sezonska salata', './fotografije/02_pariske_snicle.jpg', 'Šnicle izlupati i osušiti. Šnicle posoliti i posuti biberom, uvaljati prvo u brašno, jaja (prethodno izlupati viljuškom i posoliti), pa opet u brašno. Staviti šnicle u zagrejano ulje i pržiti sa obe strane da blago porumene. Gotove šnicle izvadite iz ulja i staviti na salvete da upiju višak masnoće. Poslužite sa sezonskim povrćem ili salatom.', 2, '2019-10-10 21:09:55', '30 min.', 'nina'),
(3, 'Bečka šnicla', '500g telećeg mesa, 100g ulja, 3 jaja, 2 limuna, 500g kuvanog povrća, brašno, prezle i so.', './fotografije/03_becka_snicla.jpg', 'Iseći meso na šnicle debljine 1cm. Posoliti, izlupati, uvaljati u brašno, zatim u jaja pa u prezle. Peći u zagrejanom ulju sa obe strane. Ulje se odliva, a meso se preliva saftom od pečenja i malo supe i još malo proprži. Zatim se servira uz bareno povrće i prelivom od pečuraka.', 2, '2019-10-10 21:17:32', '30 min.', 'stefan');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_korisnika` FOREIGN KEY (`korisnicko_ime`) REFERENCES `korisnici` (`korisnicko_ime`),
  ADD CONSTRAINT `ocena_recepta` FOREIGN KEY (`recept_id`) REFERENCES `recepti` (`recept_id`);

--
-- Constraints for table `recepti`
--
ALTER TABLE `recepti`
  ADD CONSTRAINT `kategorija_recepta` FOREIGN KEY (`kategorija_jela`) REFERENCES `kategorije` (`id_kategorije`),
  ADD CONSTRAINT `recept_korisnika` FOREIGN KEY (`autor_recepta`) REFERENCES `korisnici` (`korisnicko_ime`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
