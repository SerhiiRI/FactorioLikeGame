-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Gru 2017, 05:39
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
(9, 4, 'SÄ… to zbite pokÅ‚ady pierwiastkÃ³w wÄ™glowych z ciaÅ‚ organicznych.', 1),
(10, 4, 'Z dinozaurÃ³w.', 0),
(11, 4, 'Z kamieni.', 0),
(12, 4, 'RoÅ›nie na lawie.', 0),
(13, 5, 'Warstwy piachu, ziemi i drobnych kamyczkÃ³w.', 1),
(14, 5, 'Nie wiem.', 0),
(15, 5, 'Pomidory.', 0),
(16, 5, 'Tak.', 0);

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
(27, 4, 1, 13);

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
(4, 563, 'Z czego powstaje wÄ™giel?'),
(5, 563, 'Z czego siÄ™ skÅ‚ada prosty filtr wodny?');

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
(1, 'Woda', 15, 'WodociÄ…g', 'weather.svg', 'weather.svg'),
(2, 'Drzewo', 10, 'Tartak', 'Wood.png', 'Wood.png'),
(4, 'Å¼elazo', 5, 'Kopalnia Å¼elaza', '', 'zelazo.png'),
(6, 'WÄ™giel', 5, 'Kopalnia WÄ™gla', 'Ruda_wegla.png', 'Ruda_wegla.png');

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
(53, 6, 562, 0),
(55, 8, 562, 0),
(56, 9, 562, 0),
(57, 10, 562, 0),
(58, 4, 563, 0),
(59, 6, 563, 0),
(61, 8, 563, 0),
(62, 9, 563, 0),
(63, 10, 563, 0),
(64, 4, 564, 0),
(65, 6, 564, 0),
(67, 8, 564, 0),
(68, 9, 564, 0),
(69, 10, 564, 0);

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
(562, 6, 'Techniki wydobywania wÄ™gla.', 2, 100),
(563, 1, 'Podstawowa technika oczyszczanie wody.', 1, 25),
(564, 2, 'Podstawowa technika obrÃ³bki drzewa.', 1, 25);

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
(1, 'admin', 'admin', '2017-12-13', 1, -1, -1, 'gear6.gif'),
(4, 'J.T.Kirk', 'Kirk', '0000-00-00', 2, 0, 1, 'exit.png'),
(5, 'Spok', 'Spok', '0000-00-00', 2, 0, 0, ''),
(6, 'test', 'test', '0000-00-00', 2, 0, 3, ''),
(8, 'wsxNoHPdECtpiJREPzxg', '123', '0000-00-00', 2, 0, 5, ''),
(9, 'hulYVFUQmlWSSmLmoyry', '123', '0000-00-00', 2, 0, 3, ''),
(10, 'daNHFOoiCrcexwB UnUB', '123', '0000-00-00', 2, 0, 5, ''),
(11, 'serhii', '123', '0000-00-00', 2, 0, 0, 'defoult_user.svg'),
(12, 'suka', 'bliat', '0000-00-00', 2, 0, 0, 'defoult_user.svg'),
(13, 'aleks', 'admin', '2017-12-13', 2, 0, 0, 'industry.svg');

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
(5, 13, 25, 1),
(6, 13, 26, 1),
(7, 13, 27, 2);

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
  MODIFY `idAnswers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `factoryinstance`
--
ALTER TABLE `factoryinstance`
  MODIFY `idFactoryInstance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `question`
--
ALTER TABLE `question`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `resources`
--
ALTER TABLE `resources`
  MODIFY `idResources` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `score`
--
ALTER TABLE `score`
  MODIFY `idScore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `idTask` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `usermap`
--
ALTER TABLE `usermap`
  MODIFY `idUserMap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
