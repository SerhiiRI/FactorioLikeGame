-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2018, 02:53
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `game`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `answers`
--

CREATE TABLE `answers` (
  `idAnswers` int(11) NOT NULL,
  `idQuestion` int(11) DEFAULT NULL,
  `Answer` text COLLATE utf8_unicode_ci,
  `Right` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `answers`
--

INSERT INTO `answers` (`idAnswers`, `idQuestion`, `Answer`, `Right`) VALUES
(77, 21, '4', 1),
(78, 21, '3', 0),
(79, 21, '5', 0),
(80, 21, '1', 0),
(85, 23, 'Materii organicznej', 1),
(86, 23, 'Materii nieorganicznej', 0),
(87, 23, 'Kosmicznych skaÅ‚', 0),
(88, 23, 'Z odpadÃ³w', 0),
(89, 24, 'Woda destylowana', 1),
(90, 24, 'Woda ÅºrÃ³dlana', 0),
(91, 24, 'Z wysokÄ… zawartoÅ›ciÄ… mineraÅ‚Ã³w', 0),
(92, 24, 'KaÅ¼da woda zaszkodzi', 0),
(105, 28, '1300', 1),
(106, 28, '100', 0),
(107, 28, '500', 0),
(108, 28, '5000', 0),
(109, 29, 'Åšwierk', 1),
(110, 29, 'DÄ…b', 0),
(111, 29, 'Brzoza', 0),
(112, 29, 'Orzech', 0),
(121, 32, 'a', 1),
(122, 32, 'b', 0),
(123, 32, '  c', 0),
(124, 32, 'd', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `factoryinstance`
--

CREATE TABLE `factoryinstance` (
  `idFactoryInstance` int(11) NOT NULL,
  `idResource` int(11) DEFAULT NULL,
  `Upgrade` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `factoryinstance`
--

INSERT INTO `factoryinstance` (`idFactoryInstance`, `idResource`, `Upgrade`, `idUser`) VALUES
(10, 2, 1, 2),
(25, 1, 1, 13),
(26, 2, 1, 13),
(28, 1, 1, 17),
(29, 2, 1, 17),
(30, 7, 1, 17),
(31, 9, 1, 17),
(32, 10, 1, 17),
(33, 1, 1, 22),
(34, 2, 1, 22),
(35, 1, 1, 34),
(36, 1, 1, 36),
(37, 1, 1, 33),
(38, 2, 1, 33),
(39, 2, 1, 34),
(40, 2, 1, 36),
(41, 9, 1, 36),
(42, 10, 1, 36),
(43, 7, 1, 36),
(44, 1, 1, 39),
(45, 2, 1, 39),
(46, 9, 1, 34),
(47, 10, 1, 34),
(48, 1, 1, 40),
(49, 2, 1, 40),
(50, 1, 1, 41),
(51, 2, 1, 41),
(52, 1, 1, 42),
(53, 2, 1, 42),
(54, 1, 1, 43),
(55, 2, 1, 43),
(56, 1, 1, 44),
(57, 2, 1, 44),
(58, 1, 1, 45),
(59, 2, 1, 45),
(60, 1, 1, 46),
(61, 2, 1, 46),
(62, 1, 1, 47),
(63, 2, 1, 47),
(64, 1, 1, 48),
(65, 2, 1, 48),
(66, 9, 1, 48),
(67, 10, 1, 48),
(68, 7, 1, 48),
(69, 1, 1, 49),
(70, 2, 1, 49),
(71, 9, 1, 49),
(72, 10, 1, 49),
(73, 7, 1, 49),
(74, 1, 1, 50),
(75, 2, 1, 50),
(76, 1, 1, 51),
(77, 2, 1, 51),
(78, 1, 1, 52),
(79, 2, 1, 52),
(80, 9, 1, 52),
(81, 10, 1, 52),
(82, 7, 1, 52),
(83, 1, 1, 53),
(84, 2, 1, 53),
(85, 9, 1, 53),
(86, 10, 1, 53),
(87, 7, 1, 53),
(88, 1, 1, 54),
(89, 2, 1, 54),
(90, 1, 1, 55),
(91, 2, 1, 55),
(92, 9, 1, 55),
(93, 10, 1, 55),
(94, 7, 1, 55),
(95, 1, 1, 56),
(96, 2, 1, 56),
(97, 9, 1, 56),
(98, 10, 1, 56),
(99, 1, 1, 57),
(100, 2, 1, 57),
(101, 9, 1, 57),
(103, 12, 1, 49),
(104, 14, 1, 49),
(105, 15, 1, 49),
(106, 1, 1, 58),
(107, 1, 1, 59),
(109, 2, 1, 59),
(110, 9, 1, 59),
(111, 10, 1, 59),
(112, 7, 1, 59),
(113, 12, 1, 59),
(114, 14, 1, 59),
(115, 15, 1, 59),
(117, 1, 1, 60),
(118, 2, 1, 60),
(120, 9, 1, 60),
(121, 10, 1, 60),
(122, 7, 1, 60),
(123, 12, 1, 60),
(124, 14, 1, 60),
(125, 15, 1, 60),
(126, 1, 1, 61),
(127, 2, 1, 61),
(129, 9, 1, 61),
(130, 10, 1, 61),
(131, 1, 1, 62),
(132, 2, 1, 62),
(133, 9, 1, 62),
(134, 10, 1, 62),
(135, 1, 1, 63),
(136, 2, 1, 63),
(137, 9, 1, 63),
(138, 10, 1, 63),
(139, 12, 1, 63),
(140, 7, 1, 63),
(141, 14, 1, 63),
(142, 15, 1, 63),
(143, 1, 1, 64),
(144, 1, 1, 69),
(145, 1, 1, 70),
(146, 2, 1, 70),
(147, 9, 1, 70),
(148, 10, 1, 70),
(149, 7, 1, 70),
(150, 12, 1, 70),
(151, 14, 1, 70),
(152, 15, 1, 70),
(153, 16, 1, 70),
(154, 1, 1, 71),
(155, 1, 1, 72),
(156, 1, 1, 73),
(157, 1, 1, 74),
(158, 1, 1, 75),
(159, 2, 1, 74),
(160, 9, 1, 74),
(161, 10, 1, 74),
(162, 7, 1, 74),
(163, 12, 1, 74),
(164, 1, 1, 76),
(165, 1, 1, 77),
(166, 2, 1, 77),
(167, 17, 1, 70),
(168, 18, 1, 70),
(169, 1, 1, 78),
(170, 2, 1, 78),
(171, 1, 1, 79),
(172, 19, 1, 79),
(173, 1, 1, 80),
(174, 1, 1, 81);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `question`
--

CREATE TABLE `question` (
  `idQuestion` int(11) NOT NULL,
  `idTask` int(11) DEFAULT NULL,
  `Question` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `question`
--

INSERT INTO `question` (`idQuestion`, `idTask`, `Question`) VALUES
(21, 595, '2 + 2 = ?'),
(23, 597, 'WÄ™giel to pozostaÅ‚oÅ›ci...'),
(24, 591, 'Jaki typ wody nie zaszkodzi elektronice?'),
(28, 596, 'Å»elazo wytapia siÄ™ przy temperaturze ? stopni Celcjusza.'),
(29, 593, 'KtÃ³re z drzew nie nadaje siÄ™ do palenia?'),
(32, 596, 'pytanie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `resources`
--

CREATE TABLE `resources` (
  `idResources` int(11) NOT NULL,
  `Resource` text COLLATE utf8_unicode_ci,
  `ProductionUnit` int(11) DEFAULT NULL,
  `FactoryName` text COLLATE utf8_unicode_ci NOT NULL,
  `IMG` text COLLATE utf8_unicode_ci NOT NULL,
  `IMGFac` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `resources`
--

INSERT INTO `resources` (`idResources`, `Resource`, `ProductionUnit`, `FactoryName`, `IMG`, `IMGFac`) VALUES
(1, 'Woda', 1, 'WodociÄ…g', 'Water.png', 'Water.png'),
(2, 'Drzewo', 2, 'Tartak', '', 'Wood.png'),
(7, 'ZÅ‚oto', 2, 'Kopalnia ZÅ‚ota', '', 'GoldOre.png'),
(9, 'Å»elazo', 5, 'Kopalnia Å¼elaza', '', 'zelazo.png'),
(10, 'WÄ™giel', 10, 'Kopalnia wÄ™gla', 'Ruda_wegla.png', 'Ruda_wegla.png'),
(12, 'Chomiczki', 1, 'Fabryka chomiczkÃ³w', '', 'chomiczek.gif'),
(14, 'Fabryka', 1, 'Fabryka fabryk', '', 'industry (1).svg'),
(15, 'KoÅ‚a zÄ™bate', 10, 'Fabryka kÃ³Å‚ zÄ™batych', 'gear4.svg', 'gear4.svg'),
(16, 'Koniec Gry', 1, 'Koniec Gry', 'DancingFog.gif', 'DancingFog.gif'),
(17, 'Loxodontus', 1, 'Loxodontus rex', '', 'Loxodontus.png'),
(18, 'asd ads', 2, 'asd sasd', 'exit.png', 'exit.png'),
(19, 'asd', 1, 'asd', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `score`
--

CREATE TABLE `score` (
  `idScore` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTask` int(11) DEFAULT NULL,
  `FinishedTask` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `score`
--

INSERT INTO `score` (`idScore`, `idUser`, `idTask`, `FinishedTask`) VALUES
(242, 4, 591, 0),
(243, 5, 591, 0),
(244, 6, 591, 0),
(248, 11, 591, 0),
(250, 15, 591, 0),
(251, 16, 591, 0),
(252, 17, 591, 1),
(258, 4, 593, 0),
(259, 5, 593, 0),
(260, 6, 593, 0),
(264, 11, 593, 0),
(266, 15, 593, 0),
(267, 16, 593, 0),
(268, 17, 593, 1),
(269, 4, 595, 0),
(270, 5, 595, 0),
(271, 6, 595, 0),
(275, 11, 595, 0),
(277, 15, 595, 0),
(278, 16, 595, 0),
(279, 17, 595, 1),
(280, 4, 596, 0),
(281, 5, 596, 0),
(282, 6, 596, 0),
(286, 11, 596, 0),
(288, 15, 596, 0),
(289, 16, 596, 0),
(290, 17, 596, 1),
(311, 4, 597, 0),
(312, 6, 597, 0),
(313, 17, 597, 1),
(454, 6, 599, 0),
(455, 17, 599, 0),
(461, 6, 600, 0),
(462, 17, 600, 0),
(464, 6, 601, 0),
(465, 17, 601, 0),
(470, 1, NULL, 0),
(471, 4, NULL, 0),
(472, 5, NULL, 0),
(473, 6, NULL, 0),
(474, 11, NULL, 0),
(475, 15, NULL, 0),
(476, 16, NULL, 0),
(477, 17, NULL, 0),
(573, 4, 604, 0),
(574, 6, 604, 0),
(575, 17, 604, 0),
(604, 81, 591, 1),
(605, 81, 593, 0),
(610, 83, 591, 0),
(611, 83, 593, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `idTask` int(11) NOT NULL,
  `idResources` int(11) NOT NULL,
  `Task` text COLLATE utf8_unicode_ci,
  `LevelTo` int(11) DEFAULT NULL,
  `ResourceTo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`idTask`, `idResources`, `Task`, `LevelTo`, `ResourceTo`) VALUES
(591, 1, 'Podstawowa technika oczyszczanie wody.', 1, 20),
(593, 2, 'Podstawowa technika obrÃ³bki drzewa.', 1, 25),
(595, 7, 'Wydobycie i odseparowanie zÅ‚ota.', 3, 75),
(596, 9, 'Podstawowe metody wytapiania Å¼elaza', 2, 50),
(597, 10, 'Podstawowe wydobycie wÄ™gla.', 2, 50),
(599, 12, 'Chomiczkowo', 3, 10),
(600, 14, 'Nowoczesne techniki favrykowania', 4, 10),
(601, 15, 'Przetapianie metalu na koÅ‚a zÄ™bate', 4, 30),
(604, 17, 'Loxodontus', 2, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `Email` text COLLATE utf8_unicode_ci,
  `Passwd` text COLLATE utf8_unicode_ci,
  `LastLogined` date NOT NULL,
  `Type` int(11) NOT NULL DEFAULT '2',
  `idScore` int(11) DEFAULT NULL,
  `Level` int(11) DEFAULT '0',
  `IMG` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`idUser`, `Email`, `Passwd`, `LastLogined`, `Type`, `idScore`, `Level`, `IMG`) VALUES
(1, 'admin@vp.pl', '7b902e6ff1db9f560443f2048974fd7d386975b0', '2018-01-17', 1, -1, -1, 'chomiczek.gif'),
(4, 'J.T.Kirk@wp.pl', '239c330155f70ffe2abe42c0ca95fe10fecd7117', '0000-00-00', 2, 0, 1, 'exit.png'),
(5, 'Spok@wp.pl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00', 2, 0, 0, 'gear2.svg'),
(6, 'test@wp.pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '0000-00-00', 2, 0, 3, 'DancingFog.gif'),
(11, 'serhii@wp.pl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00', 2, 0, 0, 'gear.svg'),
(15, 'darek@wp.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2017-12-13', 2, 0, 0, 'defoult_user.svg'),
(16, 'adam@wp.pl', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-12-13', 2, 0, 0, 'defoult_user.svg'),
(17, 'aleks@wp.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2018-01-17', 2, 0, 4, 'defoult_user.svg'),
(81, 'aleks@vp.pl', '9abc833bc5ab484db536445a007a184db86760ac', '2018-01-16', 2, 0, 0, 'defoult_user.svg'),
(83, 'assa@as', '6abf8aa421d6b8a1f8aeb8773f16dd08b6f6f608', '0000-00-00', 2, 0, 0, 'defoult_user.svg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usermap`
--

CREATE TABLE `usermap` (
  `idUserMap` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idFactory` int(11) NOT NULL,
  `CountFactory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `usermap`
--

INSERT INTO `usermap` (`idUserMap`, `idUser`, `idFactory`, `CountFactory`) VALUES
(4, 17, 28, 3),
(22, 17, 29, 2),
(23, 17, 30, 2),
(24, 17, 31, 2),
(25, 17, 32, 1),
(195, 81, 174, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`idAnswers`),
  ADD KEY `idQuestion` (`idQuestion`);

--
-- Indexes for table `factoryinstance`
--
ALTER TABLE `factoryinstance`
  ADD PRIMARY KEY (`idFactoryInstance`),
  ADD KEY `idResource` (`idResource`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `idAnswer` (`idTask`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`idResources`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`idScore`),
  ADD KEY `idTask` (`idTask`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`idTask`),
  ADD KEY `idResources` (`idResources`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idScore` (`idScore`);

--
-- Indexes for table `usermap`
--
ALTER TABLE `usermap`
  ADD PRIMARY KEY (`idUserMap`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idFactory` (`idFactory`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `answers`
--
ALTER TABLE `answers`
  MODIFY `idAnswers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT dla tabeli `factoryinstance`
--
ALTER TABLE `factoryinstance`
  MODIFY `idFactoryInstance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT dla tabeli `question`
--
ALTER TABLE `question`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `resources`
--
ALTER TABLE `resources`
  MODIFY `idResources` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `score`
--
ALTER TABLE `score`
  MODIFY `idScore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=622;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `idTask` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=608;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT dla tabeli `usermap`
--
ALTER TABLE `usermap`
  MODIFY `idUserMap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `Answers_ibfk_1` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `factoryinstance`
--
ALTER TABLE `factoryinstance`
  ADD CONSTRAINT `FactoryInstance_ibfk_4` FOREIGN KEY (`idResource`) REFERENCES `resources` (`idResources`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `Question_ibfk_1` FOREIGN KEY (`idTask`) REFERENCES `task` (`idTask`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `Score_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Score_ibfk_4` FOREIGN KEY (`idTask`) REFERENCES `task` (`idTask`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `Task_ibfk_1` FOREIGN KEY (`idResources`) REFERENCES `resources` (`idResources`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `usermap`
--
ALTER TABLE `usermap`
  ADD CONSTRAINT `UserMap_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserMap_ibfk_2` FOREIGN KEY (`idFactory`) REFERENCES `factoryinstance` (`idFactoryInstance`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
