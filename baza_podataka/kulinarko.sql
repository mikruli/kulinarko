-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2019 at 08:40 PM
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
  `datum_unosa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_izmene` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnicko_ime`, `lozinka`, `ime`, `prezime`, `el_adresa`, `datum_rodjenja`, `adresa_stanovanja`, `drzava_stanovanja`, `pol`, `telefon`, `mobilni_telefon`, `administrator`, `datum_unosa`, `datum_izmene`) VALUES
('anaa', '$2y$10$rhXpjuPThaXOxD8OmnjLaeI1mVueTzmMDv4hrJV1H3yN0v.eRA6oK', 'Ana', 'Zivanovic', 'ana20@gmail.com', '1999-09-07', 'Bulevar Revolucije 17, Beograd', 'Srbija', 'Z', '011-2122-434', '064-715-888', 0, '2019-10-20 19:47:25', '2019-10-20 20:24:19'),
('dejan', '$2y$10$kZjP4QznzQWk8GL9gsmsWuvVYnFVu.EWzYF1Maw5Q6S/SbU2poWRy', 'Dejan', 'Pavlovic', 'dejan30@gmail.com', '1972-03-19', 'Cara Lazara 8, Beograd', 'Srbija', 'M', '011-3759-583', '063-222-222', 1, '2019-10-20 19:56:44', '2019-10-20 20:25:43'),
('ilija', '$2y$10$dsfB84jLN7LyfY/hPrxRfOebcLKFDAV7H8vdC6V7bvZt/Jt5AF/2e', 'Ilija', 'Pavlovic', 'ilija30@gmail.com', '1975-01-29', 'Ilije Stojadinovica 8, Beograd', 'Srbija', 'M', '011-3315-128', '065-7165-978', 0, '2019-10-20 19:53:17', '2019-10-20 20:26:58'),
('jelena', '$2y$10$BDrOf12jvqkiLU4ICSi2Muh1WXZ7BUV1b0WMqLvbDBLdKjk/Giz7S', 'Jelena', 'Petrovic', 'jelena30@gmail.com', '1989-02-21', 'Lipa 8, Beograd', 'Srbija', 'Z', '011-3712-718', '063-625-312', 0, '2019-10-20 19:37:44', '2019-10-20 20:28:04'),
('jovan', '$2y$10$CZZr6N9Oy9A3c6BegUmCsuzLFYsU8e.U40c0Kztn1hkzKXUGaTL0m', 'Jovan', 'Jelic', 'jovan30@gmail.com', '1988-04-12', 'Pozeska 7, Beograd', 'Srbija', 'M', '011-2352-318', '064-528-119', 0, '2019-10-20 19:50:32', '2019-10-20 20:29:08'),
('luka', '$2y$10$Fj9pNh8r6B4TvldrXaTV9utSxh7xqA/qBzoYUnx0FsUUrhvN5YK.a', 'Luka', 'Vojvodic', 'luka30@gmail.com', '1994-04-25', 'Arcibalda Rajsa 12, Beograd', 'Srbija', 'M', '011-3199-445', '069-1111-222', 0, '2019-10-20 19:55:14', '2019-10-20 20:30:09'),
('marko', '$2y$10$hkQDflCXuVEhajtrpnnkZ.8Wy.J9OJtKNC2upiDR8vKZ1qfP0vC/O', 'Marko', 'Pavlovic', 'marko22@gmail.com', '1997-09-23', 'Ane Ahmatove 12, Beograd', 'Srbija', 'M', '011-2482-538', '063-452-198', 0, '2019-10-20 19:33:27', '2019-10-20 20:31:20'),
('misa', '$2y$10$e1XLLReZYhJukPQCxdW0YuHaCo5aRizbs.uSb.6Vq2fxFLR9XiYtu', 'Miodrag', 'Marinkovic', 'misa40@gmail.com', '1979-05-23', 'Radnicka 121, Beograd', 'Srbija', 'M', '011-4132-917', '069-715-738', 0, '2019-10-20 19:36:44', '2019-10-20 20:32:19'),
('momo', '$2y$10$Sjmm.2pGOqoqbWppFM44YezFWtLTT8FzwAV1bZwnlMwl3Ddh.i1c2', 'Momir', 'Markovic', 'momo30@gmail.com', '1998-03-18', 'Visnjicka 17, Beograd', 'Srbija', 'M', '011-3192-295', '065-9136-833', 0, '2019-10-20 19:56:00', '2019-10-20 20:33:16'),
('nina', '$2y$10$ahNnnWqLGkOVPs1M2A.ixehmOpsA7fWpTccOYxIz6Hw3yk1bqW0l6', 'Nina', 'Nesic', 'nina47@gmail.com', '1978-07-23', 'Bulevar mira 17, Beograd', 'Srbija', 'Z', '011-2212-414', '065-1435-312', 0, '2019-10-20 19:51:17', '2019-10-20 20:34:35'),
('pavle', '$2y$10$bWlUn1c/qI06R/HTbezyke6iqQIk8E.H7vehIz2kMEzqOXroV.sXK', 'Pavle', 'Markovic', 'pavle30@gmail.com', '1985-03-21', 'Breza 2, Beograd', 'Srbija', 'M', '011-3472-118', '063-135-208', 0, '2019-10-20 19:48:37', '2019-10-20 20:35:41'),
('pera', '$2y$10$HyjrWqZ.QWcsziNIFRAZy.3YrzMXHEJULys1sTrND3tmwERv7DHqi', 'Petar', 'Markovic', 'pera30@gmail.com', '1972-07-08', 'Nehruova 7, Beograd', 'Srbija', 'M', '011-3452-418', '069-435-908', 0, '2019-10-20 19:29:04', '2019-10-20 19:31:56'),
('stefan', '$2y$10$qCpX9WtpB6LEi0Tj/sQhgOjQdfhlMq.TQ3oX1Mf42NC1gCC2Sf6wW', 'Stefan', 'Pecarski', 'stefan25@gmail.com', '1994-12-01', 'Ustanicka 26, Beograd', 'Srbija', 'M', '011-1412-329', '064-236-311', 0, '2019-10-20 19:34:51', '2019-10-20 20:36:43'),
('zora', '$2y$10$AE.LT/jOYQGYkIwTnK6TpO7u1d3Fff37NKprwk9Zq2/Cq0pQKRikK', 'Zorka', 'Mirkovic', 'zora30@gmail.com', '1982-02-17', 'Marka Oreskovica 12, Beograd', 'Sbija', 'Z', '011-2299-777', '069-9825-812', 0, '2019-10-20 19:54:27', '2019-10-20 20:37:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recepti`
--

INSERT INTO `recepti` (`recept_id`, `naziv_recepta`, `sastojci`, `slika_jela`, `sadrzaj_recepta`, `kategorija_jela`, `datum_unosa`, `vreme_pripreme`, `autor_recepta`) VALUES
(1, 'Pileći kroketi sa susamom', '300 g pilećeg belog mesa, po ukusu so, 1 kašičica suvog biljnog začina, 150 g brašna, 150 g prezli, 3 jajeta, 2 kašike susama, Za prženje: ulje po potrebi.', './fotografije/01_pileci_kroketi_sa_susamom.jpg', 'Pileće belo meso iseći na uže, duže delove i posoliti ih. Jaja razmutiti ručnom žicom za mućenje. U odgovarajućoj posudi sjediniti prezle i susam, dodati suvi biljni začin i izmešati. Brašno staviti u činiju,pa u njega uvaljati meso, potom u razmućena jaja i na kraju u mešavinu prezli, susama i suvog biljnog začina. Pržiti na zagrejanom ulju dok me porumene sa obe strane. Odlagati na kuhinjski papir kako bi se ocedio višak masnoće. Servirati i poslužiti.', 2, '2019-10-19 20:26:07', '30 min.', 'marko'),
(2, 'Pariske šnicle', '1 pileće belo meso, 100 g brašna, 2 jajeta, malo soli i suvih začina, malo ulja za prženje, prilog sezonska salata', './fotografije/02_pariske_snicle.jpg', 'Šnicle izlupati i osušiti. Šnicle posoliti i posuti biberom, uvaljati prvo u brašno, jaja (prethodno izlupati viljuškom i posoliti), pa opet u brašno. Staviti šnicle u zagrejano ulje i pržiti sa obe strane da blago porumene. Gotove šnicle izvadite iz ulja i staviti na salvete da upiju višak masnoće. Poslužite sa sezonskim povrćem ili salatom.', 2, '2019-10-19 20:26:43', '30 min.', 'nina'),
(3, 'Bečka šnicla', '500g telećeg mesa, 100g ulja, 3 jaja, 2 limuna, 500g kuvanog povrća, brašno, prezle, so.', './fotografije/03_becka_snicla.jpg', 'Iseći meso na šnicle debljine 1cm. Posoliti, izlupati, uvaljati u brašno, zatim u jaja pa u prezle. Peći u zagrejanom ulju sa obe strane. Ulje se odliva, a meso se preliva saftom od pečenja i malo supe i još malo proprži. Zatim se servira uz bareno povrće i prelivom od pečuraka.', 2, '2019-10-19 20:26:57', '30 min.', 'stefan'),
(4, 'Sarma od kiselog kupusa', '1 veća ili 2 manje glavice kiselog kupusa, 500 g mlevenog mešanog mesa, 4 glavice crnog luka, 6 kašika pirinča, 1 šolja ulja, 100 g suve slanine, crvena mlevena paprika, so, suvi biljni začin.', './fotografije/04_sarma_od_kiselog_kupusa.jpg', 'Odvojiti listove kupusa i dobro ih operite. Na malo ulja prodinstati sitno iseckan luk, dodajte meso pa nastavite dinstanje. Na kraju dinstanja dodati so, suvi biljni začin, alevu papriku, biber a onda i pirinač. Promešajte i filujte jedan po jedan list kupusa uvijajuci ih po želji. Ređajte ih u pogodnu posudu, tako da stanu u jednom redu. Slaninicu ređajte na režnjeve, pa je stavite između sarmi. Prelijte ih ostatkom ulja i vodom tako da sarme ogreznu. okrijte posudu folijom i stavite u rernu, pa pecite na umerenoj temperaturi oko 2 sata ili stavite na tihoj vatri da se kuvaju a pred kraj zapeći u rerni. Pre nego što sarme izvadite iz rerne, skinite foliju da sarme dobiju lepu rumenu boju.', 2, '2019-10-19 20:27:14', '60 min.', 'dejan'),
(5, 'Musaka', '1 kg krompira, 4-5 glavice crnog luka, 2-3 šargarepe, po ukusu suvog biljnog začina, po ukusu soli i bosiljka, po potrebi ulje, 400 g mlevenog mesa.', './fotografije/05_musaka.jpg', 'U nauljenom tiganju upržiti sitno iseckan luk i šargarepu sa malo soli i bosiljka. Kada smesa omekša, dodati mleveno meso i upržiti još malo. U veću činiju krompir oljuštiti i iseći na kolutove. Dodati suvog biljnog začina po ukusu (2-3 kašičice).  nauljenom plehu naređati polovinu krompira. Zatim staviti uprženu smesu. Preko smese naređati ostatak krompira. Preliti vodom i staviti da se peče u zagrejanoj rerni na 200 C, dok voda ne iskrčka malo i krompir ne omekša i bude pečen. ', 2, '2019-10-19 20:27:30', '120 min.', 'jelena'),
(6, 'Pizza makarone', '1 pakavanje makarona, 400 ml kečapa, 400 g praške šunke, 300 g sremskog kačkavalja.', './fotografije/06_pizza_makarone.jpg', 'Makarone skuvamo i procedimo. Sipamo u podmazan pleh, prosaramo kečapom. Narendamo šunkaricu i kačkavalj. Sipamo od gore preostali kečap i pečemo na 180C oko 15 minuta dok ne porumeni.', 1, '2019-10-19 20:27:44', '40 min.', 'jovan'),
(7, 'Rolovana pršuta sa kajmakom', '4 listića pršute, 2 pečene crvene paprike, 100 g mladog kajmaka, 200 g mileram, 50 g svježeg celera.', './fotografije/07_rolovana_prsuta_sa_kajmakom.jpg', 'Kajmak i mileram sjediniti. Svako parče pršute premazati sa smjesom, pa preko staviti parče pečene paprike. Svako parče urolati i dekorisati celerom.', 1, '2019-10-19 20:27:55', '10 min.', 'pera'),
(8, 'Grilovana salata', '1 manja tikvica, 2 paradajza, 1 manji krastavac, 100 g mladog sira, po ukusu beli luk, po ukusu peršunov list.', './fotografije/08_grillovana_salata.jpg', 'Tikvice ogulimo i nasečemo na šnite, posolimo i u tiganj grillujemo na par kapi ulja. Paradajz i krastavce nasečemo na kolutove, a sir na tanje kriške i njih smestimo u tiganj i grilujemo prvo jednu pa drugu stranu posolimo po ukusu. Serviramo u tanjir pospemo sa sitno seckanim belim lukom i peršunovim listom.\r\n ', 1, '2019-10-19 20:28:18', '15 min.', 'misa'),
(9, 'Omlet sa šunkom', '3 jajeta, 250 g praške šunke, 100 g kačkavalja, 200 g sira, 100 g margarina, 200 g brašna, 2 dl mleka.', './fotografije/09_omlet_sa_sunkom.jpg', 'Pripremamo bešamel sos na sledeći način. U šerpu sa rastopljenim margarinom dolijemo ulje i stavimo brašno. Postepeno dodajemo mleko i mešamo dok ne dobije potrebnu gustinu. U šerpu sa bešamel sosom dodamo izmućena tri žumanca. Belanca mutimo mikserom dok ne dobijemo potrebnu gustinu i sjedinimo sa prethodnom smesom. U nauljenu tepsiju presipamo smešu. Pečemo 15 minuta na 200 C. U međuvremenu napravimo fil od šunkarice isečene na parčad, izrendanog kačkavalja i sira. Omlet prevrnemo na dasku za sečenje i nanesemo fil. Uvijemo u rolat i sečemo na parčad. Pecite omlet u većoj posudi da ne bude debeo kao moj pa se teže roluje.', 1, '2019-10-20 20:16:08', '30 min.', 'anaa'),
(10, 'Kraljevski omlet', '4 jajeta, 1 kašika mleka, 2 kašičice putera, 100 g praške šunke, 50 g kačkavalja, 50 g pečuraka.', './fotografije/10_kraljevski_omlet.jpg', 'Umutiti viljuškom 2 jajeta sa pola kašike mleka. Zagrejati tiganj sa kašičicom putera. Razliti smesu. Peći na laganoj vatri 1 minut, okrenuti drugu stranu i naneti polovinu nadeva. Preklopiti omlet. Ostaviti da se peče još 1 minut. Na isti način spremiti i drugi omlet. Služiti uz sezonsku salatu. Nadev i količinu možete menjati po sopstvenom ukusu.', 1, '2019-10-19 20:29:23', '10 min.', 'pavle'),
(11, 'Teleća čorba', '1 manja glavica crnog luka, 3 kašike ulja, 300 g teletine, 1 šargarepa, 1 manji celer, 2 l vode, so, biber, suvi biljni začin, 2 kašike brašna.', './fotografije/11_teleca_corba.jpg', 'Iseckani crni luka propržiti na ulju u šerpu u kojoj će se kuvati čorba. Kada luk dobije zlatno žutu boju, dodati na kockice šargarepu i celer, zatim dodati meso koje je predhodno isečeno na sitne kockice. Naliti vodu, poklopiti i kuvati na laganoj vatri oko 1 sat. Doliti još vode, posoliti i začinima dodati biber i dve kašike brašna razmućene u malo vode. Sipati u čorbu. Pustiti da provri. Začiniti po želji.', 3, '2019-10-19 20:29:39', '60 min.', 'ilija'),
(12, 'Domaća supa', 'pileće meso količina po želji, 3 šargarepe, 100 g celera, 80 g paškanata, 1 koren peršuna, suvi biljni začin, domaća testenina.', './fotografije/12_domaca_supa.jpg', 'U veću šerpu staviti meso i sve navedene sastojke. Naliti vodom i staviti da se kuva. Kuvati dok meso omekša. Skuvano meso izvaditi i ostaviti na stranu, za pohovanje. Od povrća zadržati samo šargarepu i iseckati je, a ostalo povrće skloniti. Supu procediti, vratiti iseckanu šargarepu, dosoliti, po ukusu, pa začiniti sa domaćom testeninom.\r\n', 3, '2019-10-19 20:30:00', '60 min.', 'zora'),
(13, 'Čorbica sa spanaćem i pirinčem', '300 g spanaća, 3 krompira, 1/2 šolje pirinača, 1 glavica crnog luka, 1 šargarepa, 1 manji koren celera, so, biber, suvi biljni začini, 2 do 3 kašike ulja.', './fotografije/13_corbica_sa_spanacem_i_pirincem_posno.jpg', 'Na ulju malo propržiti luk (isečen na rebarca), šargarepu (isecenu na kockice ili kolitice) i celer (isečen na kocke) pa zatim dodati krompir (isečen na kocke) i očišćen spanać. Ostaviti još da se uprži da spanać slegne pa zatim naliti vodom malo više od litre. Kada počne da ključa dodati prethodno dobro opran pirinač. Posoliti, začiniti i ostaviti da se kuva da pirinač omekne. Prijatno!!!', 3, '2019-10-19 20:30:15', '30 min.', 'luka'),
(14, 'Bakini kolači', '5 jaja, 400 g šećera, 200 ml ulja, 200 ml mleka, 700 g brašna, 1 kesica praška za pecivo , 1 vanilin šećer, 1/2 limuna.', './fotografije/14_bakini_kolaci.jpg', 'Penasto umutiti belanca sa šećerom, pa potom dodati žumanca. U umućena jaja dodati ostale sastojke, pa sve sjediniti. Limun dobro oprati, pa u dobijenu smesu iscediti sok i sitno narendati koru. Peći u presi za bakin kolač. \r\n', 4, '2019-10-19 20:30:31', '60 min.', 'momo'),
(15, 'Stare dobre vanilice sa mašću', '200 g masti, 1 jaje, 1 žumance, 4 kašike šećera, 1/2 limuna - sok, 500 g brašna, po potrebi džema, po potrebi šećera u prahu.', './fotografije/15_stare_dobre_vanilice.jpg', 'Mast umutiti pa dadati šećer i nastaviti sa mućenjem. Zatim dodati jaje i žumanac, sjediniti i dodati sok od pola limuna i rendanu koru. Sjediniti pa postepeno dodavati brašno i mesiti rukom da se dopije lopta koja se odvaja od posude. Domesiti na pobrašnjenu radnu površinu pa razvući koru pola cm debljine. Čašicom vaditi kružiće i ređati na pleh sa papirom. Ostatak testa umesiti ponovo, pa razvući koru i vaditi nove kružiće. Ponavaljati dok imate smesu. Staviti u zagrejanu rerni na 200 C i peći da se ispeku, ali ostanu beli kružići. Kada se prohlade spajati po dva kružića sa malo džema i valjati u prah šećer.', 4, '2019-10-19 20:30:41', '120 min.', 'nina'),
(16, 'Koh od griza', '4 krupnija jajeta, 2 vršne kašike šećera, 8 vršnin kašika griza, 1/4 limuna - izrendana kora, 750 ml mleka, 5 kašika šećera, 1 kesica vanilin šećera.', './fotografije/16_koh_od_griza.jpg', 'Zakuvati mleko sa šećerom i vanilin šećerom. Ako je u pitanju dugotrajno mleko, kada bude proključalo, a šećer se otopio, promešati i skloniti s vatre jer nije potrebna duža termička obrada. Mleko nikako ne bi trebalo da zagori. Ostaviti ga da se hladi. Oprati limun sodom bikarbonom, posušiti ga i izrendati 1/4 kore. Izmeriti i prosejati griz. Posudu za pečenje namazati i posuti brašmžom, a višak brašna otresti. Iskrojiti i postaviti pek-papir na dno posude. Na slikama je silikonski kalup i isti postupak. Uključiti rernu da se greje na 200°C. Odvojiti belanca i žumanca vodeći računa da u belancima ne ostane ni traga od žumanaca, jer se neće umutiti onako kako bi trebalo. Belanca kratko mutiti mikserom, pa dodavati jednu po jednu kašiku šećera i nastaviti s mućenjem dok ne postignemo čvrst šam. Zatim dodavati jedno po jedno žumance, a mikser podesiti na najmanju brzinu. Staviti izrendanu koru od limuna u testo. Dodavati jednu po jednu kašiku griza i promešati varjačom između dodavanja. Sipati testo u posudu za pečenje, staviti je u zagrejanu rernu i peći kolač dvadesetak minuta, ili dok ne porumeni. Proveriti pomoću čačkalice da li je patišpanj pečen. Bocnuti ga do dna i ako na drvcetu nema ni traga od testa - pečen je. Ispečen patišpanj izvaditi iz kalupa, skinuti papir prebaciti ga, s dnom okrenutim na gore, u čistu staklenu, keramičku, ili neoštećenu emajliranu posudu. Donja strana lepše izgleda, ali ga svakako možemo zadržati i u prvobitnom položaju, samo ne zaboraviti na skidanje papira! Procediti mleko i polako preliti kolač, pa ga ostaviti da upije mleko i da se ohladi. Koh čuvati u frižideru, a posudu pokriti da se ne bi osušio. ', 4, '2019-10-19 20:30:55', '35 min.', 'pavle'),
(17, 'Brze kakao kocke', '100 g margarina, 50 g kakaoa, 200 g šećera, 250 g brašna, 2 dl mleka, 1 jaje, 1 kesica praška za pecivo, 1 kesica vanilin šećera, 50 g šećera u prahu.', './fotografije/17_brze_kakao_kocke.jpg', 'Umutiti omekšali margarin sa šećerom i jajetom, dodati mleko, a zatim brašno, kakao, prašak za pecivo i vanilin šećer. Sve dobro sjediniti, pa dobijenu smesu izliti u nauljen i brašnom posut pleh. Peći u zagrejanoj rerni na 200°C 15ak minuta. Gotov kolač posuti šećerom u prahu.', 4, '2019-10-19 20:31:07', '30 min.', 'ilija'),
(18, 'Kapućino mafini', '4 jajeta, 8 kašika šećera,  kašika brašna, 1 kesica praška za pecivo, 2 kašike ulja, 150 g margarina, 4 kesice vanil šećera, po potrebi kapućino toping i 200 g čokolade.', './fotografije/18_kapucino_mafini.jpg', 'Izmutiti jaja sa šećerom i vanil-šećerom tako da smesa postane bela i penasta. Dodati otopljen margarin i ulje, zatim brašno pomešano sa praškom za pecivo. Korpice za mafine napuniti do pola pripremljenom smesom, a zatim preko toga sipati po malo topinga sa ukusom kapućina. Pažljivo preko topinga sipati još malo smese za testo. Korpice ne treba puniti do kraja, već tako da ostanu malo prazne, jer će narasti prilikom pećenja. Staviti mafine da se peku na 200 stepeni oko 20 minuta. Pečene mafine premazati rastopljenom čokoladom.', 4, '2019-10-19 20:31:33', '45 min.', 'momo'),
(19, 'Kremasta torta', '1 l slatke pavlake, 200 g prah šećera, 400 g kisele pavlake, 300 g mlevenog plazma keksa, 8 Iseckanih krem bananica, 200 g eurokrema, 200 ml slatke pavlake za dekoraciju', './fotografije/19_kremasta_torta.jpg', 'Penasto umutiti slatku pavlaku sa prah šećerom, zatim dodati kiselu pavlaku i sve lagano sjediniti varjačom. Smesu podeliti na 3 dela. U jedan deo dodati mlevenu plazmu, u drugi bananice, a u treći eurokrem. U kalup prvo staviti smesu sa plazmom, zatim smesu sa bananicama i na kraju smesu sa eurokremom. Po želji tortu ukrasiti sa umućenom slatkom pavlakom.', 5, '2019-10-20 20:16:21', '30 min.', 'anaa'),
(20, 'Puslica torta', '9 belanjaka, 3 kašike šećera, malo soka od limuna, 4 kesice šlaga, 4 dl mleka, 9 žumanjaca, 200 g mlevenih oraha, 200 g margarina, 300 g šećera.', './fotografije/20_puslica_torta.jpg', 'Kore: peći 3 kore: 3 belanjca, 3 kašike šećera i malo soka od limuna. Susiti na laganoj vatri. Umutiti šlag. Fil: staviti 4 dl mleka da uzavri. Dodati smesu od 5 žumanaca i 300 g šećera. Umešati. Zatim skinuti s vatre i dodati preostala žumanca i 200 g mlevenih oraha jedno po jedno. Vratiti na vatru da još malo provri. Ohladiti i u ohlađeno dodati 200 g izrađenog margarina. Sve da odstoji 15tak minuta u frižideru. Filovati: kora, krema, šlag, kora, fil, šlag, kora, krema, šlag.', 5, '2019-10-20 20:16:30', '30 min.', 'anaa'),
(21, 'Vanil torta sa plazmom', '1 pakovanje plazme, 1 l mleka, 3 pudinga od vanilije, 8 kašika šećera, 200 g putera/margarina, 100 ml slatke pavlake, malo čokolade.', './fotografije/21_vanil_torta_sa_turskim_keksom.jpg', 'U šerpu sipati 800 ml mlijeka. Posebno umutiti prah puding, šećer i 200 ml mlijeka, da nema grudica. Sipati u šerpu. Kada puding dobije gustinu, maknuti i ostaviti da se ohladi. Dodati omekšao puter/margarin, pa izmiksati. Umutiti slatku pavlaku. U pleh redati: red turskog keksa, red vanil kreme, red slatke pavlake... Postupak ponavljati, dok se sastojci utroše (ovisno od veličine pleha imat ćete 3 ili 4 reda keksa)! Završiti umućenom pavlakom. Posuti ribanom čokoladom, pa staviti u frižider, da se ohladi i stegne.', 5, '2019-10-19 20:32:25', '40 min.', 'stefan'),
(22, 'Čoko moko torta', '10 jaja, 10 kašika šećera, 200 g preprženih lešnika, 450 g mlevene plazme, 700 g kisele pavlake, 500 g šlaga, 500 ml čokoladnog mleka, 200 g višanja, 200 g borovnica.', './fotografije/22_coko_moko_torta.jpg', 'Penasto umutiti 5 belanaca, 5 kašika šećera, dodati žumanca i na kraju dodati 100 g mlevenih lešnika. Promešati špatulom. Smesu sipati u pleh obložen pek papirom i staviti u zagrenu rernu. Peći između 20 i 30 minuta na 180 stepeni. Na isti način pripremiti i drugu koru. Pečene prohlađene korice natopiti čokoladnim mlekom. Fil I: Sjediniti plazmu i kiselu pavlaku. Dodati 4 kašike čokoladnog mleka. Fil II: umutiti šlag sa kiselom vodom. Filovati tortu: Staviti jedno koru na tacnu, 5 kašika fila od plazme, 5 kašika šlaga i preko borovnice. Staviti drugu koru, staviti ostatak fila od plazme, tanak sloj šlaga i preko toga višnje. Preko višanja staviti šlag i ukrasiti tortu.', 5, '2019-10-19 20:32:39', '60 min.', 'marko'),
(23, 'Čizkejk sa višnjama', '300 g mlevene plazme, 100 g mlevenih oraha, 100 g maslaca, 150 ml mleka, 2 kašike šećera u prahu, 300 g šlaga, 300 ml mleka, 300 g krem sira, 1 čaša (180g) kisele pavlake, 150 g šećera u prahu, 1 kesica želatina, 50 ml vode, 300 g višanja, 350 ml vode, 5 kašika šećera, 2 kašike gustina.', './fotografije/23_cizkejk_sa_visnjama.jpg', 'Umutiti maslac sa šećerom u prahu, dodati mleveni keks, mlevene orahe i mleko, izmešati. Staviti u pleh sa obručem (26cm), rasporediti. U jednoj posudi mikserom mutiti šlag sa mlekom, a u drugoj kašikom krem sir i kiselu pavlaku sa šećerom u prahu. Te dve mase izmešati. Želatin sipati u šerpicu, dodati vodu, ostaviti 5 minuta. Zatim zagrejati, ali da ne provri, samo da se otopi. Prohladiti i umesati u fil. Staviti preko kore. Staviti u frižider da se ohladi i stegne. Skinuti obruč. Rasporediti vinšje preko fila. U šerpicu sipati sok koji su višnje pustile pri odmrzavanju i vodom dopuniti do 350 ml. Dodati šećer i zagrejati. Gustin razmutiti sa malo vode i usuti u šerpicu i zakuvati. Prohladiti i sipati preko visanja. Ohladiti. Prijatno!', 5, '2019-10-19 20:32:53', '60 min.', 'dejan'),
(24, 'Šopska salata', '2 paradajza, 2 krastavca, 4 paprike, 1 glavica crnog luka, 100 g feta sira, malo ulja, malo sirćeta, po ukusu soli.', './fotografije/25_sopska_salata.jpg', 'Crni luk, paradaz i krastavce očistiti i iseckati na kockice. Papriku očistiti od semenki i iseckati na trakice. Posoliti po ukusu, sipati malo ulja i sirćeta i lagano promešati. Na kraju narendati feta sir.', 6, '2019-10-19 20:33:15', '20 min.', 'jelena'),
(25, 'Dzadziki salata', '500 g krastavca, 3 kisela mleka, 1/2 čaše pavlake, 4 čena belog luka, po potrebi so, malo mirođije, malo začinskog bilja, malo bibera.', './fotografije/26_dzadziki_salata.jpg', 'Izrendati krastavce i ostaviti 20 minuta da puste vodu. Ocediti ih posoliti i dodati kiselo mleko, pavlaku sitno seckan beli luk i začine. Ostaviti u frižider da odstoji. Propremiti je najmanje par sati pre posluženja da bi beli luk pusto sok i začini da daju pravi ukus. Prijatno!', 6, '2019-10-19 20:33:29', '30 min.', 'luka'),
(26, 'Salata meksikana', '500 g kukuruza šećerca, 1 konzerva crvenog pasulja, 2 glavice crvenog luka, po ukusu so, sirće/limun i ulje.', './fotografije/27_salata_meksikana.jpg', 'Kukuruz obariti. Ohladiti ga. Pasulj dobro procediti. Luk iseći na kockice srednje veličine pa ga malo posoliti i izgnječiti. Sve sjediniti, promešati, pa dodati po ukusu limuna ili sirće, još malo soli i maslinovog ulja. Ohladiti dobro i služiti najbolje uz ribu! Prijatno!', 6, '2019-10-11 20:44:13', '30 min.', 'nina'),
(27, 'Kupus salata', '1/2 glavice kiselog kupusa, 2 kašike maslinovog ulja, 1/2 kašičice mlevenog đumbira, 1 kašičica aleve paprike, malo suvog peršuna.', './fotografije/28_kupus_salata.jpg', 'Kupus iseći na krupnije komade, preliti uljem, posuti đumbirom, alevom paprikom i peršunom. Dobro promešati da kupus upije sve začine. Najviše prija uz pasulj i beli krompir iz rerne.', 6, '2019-10-19 20:33:58', '5 min.', 'ilija'),
(28, 'Faraonova salata', '200 g svežeg sira (Ela), 1 manja glavica crnog luka, 1 struk mladog crnog luka, 1 veći paradajz, 2 čeri paradajza, 10-ak listova zelene salate, 1/2-1 limun - sok, 1/2 do 1 kafene kašičice soli, 1 sveži krastavac, 2 do 3 supene kašike ulja od koštica grožđa.', './fotografije/29_faraonova_salata.jpg', 'U posudu staviti sir, dodati sok od pola limuna, 1/2 kašičice soli, prstohvat bibera i 2 kašike ulja. U ovoj salati se može koristiti kravlji ili ovčiji sir. Ja sam koristila sveži Ela sir koji je neslan, pa sam ga posolila sa pola kašičice soli. Ako se koristi slani sir, onda so nije potrebna. Izmešan sir ostaviti da odstoji u frižideru 20-ak minuta. Stari crni luk očistiti i iseći na kockice, a mladi očistiti, dobro oprati i sitno iseći. Krastavac oljuštiti i takođe iseći na kockice. Paradajz oprati i iseći na kockice. Ako se salata odmah koristi, iseći ceo paradajz, a ako će se koristiti kasnije, izvaditi seme i iseći samo mesnati deo. Zelenu salatu očistiti, oprati i iseći na rezance. Izvaditi sir iz frižidera pa umešati luk, krastavac i zelenu salatu. Paradajz se može umešati sa lukom, krastavcem i zelenom salatom i blago posoliti, ili staviti i preko krastavca, zelene salate i luka, bez mešanja. Za dekoraciju koristiti listove zelene salate i čeri paradajz. apomena: ova količina sastojaka je dovoljna za 2 do 3 porcije.', 6, '2019-10-19 20:34:11', '30 min.', 'jovan');

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
