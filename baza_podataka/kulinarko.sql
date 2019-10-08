-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2019 at 08:01 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `korisnicko_ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'korisnicko ime mora biti jedinstveno',
  `lozinka` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `el_adresa` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `adresa_stanovanja` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drzava_stanovanja` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pol` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` int(20) DEFAULT NULL,
  `mobilni_telefon` int(20) DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `slika_jela` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sadrzaj_recepta` text COLLATE utf8_unicode_ci NOT NULL,
  `kategorija_jela` int(11) NOT NULL,
  `datum_unosa` datetime NOT NULL,
  `vreme_pripreme` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `autor_recepta` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`recept_id`),
  KEY `recept_korisnika` (`autor_recepta`),
  KEY `kategorija_recepta` (`kategorija_jela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
