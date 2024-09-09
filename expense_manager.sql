-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 19. jan 2022 ob 23.49
-- Različica strežnika: 10.4.18-MariaDB
-- Različica PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `expense manager`
--

-- --------------------------------------------------------

--
-- Struktura tabele `kategorija`
--

CREATE TABLE `kategorija` (
  `IDKategorija` int(50) NOT NULL,
  `ImeKategorije` varchar(50) NOT NULL,
  `DatumVnosa` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `kategorija`
--

INSERT INTO `kategorija` (`IDKategorija`, `ImeKategorije`, `DatumVnosa`) VALUES
(1, 'Hrana in pijača', '2022-01-09 11:18:30.663216'),
(2, 'Šport in zabava', '2022-01-09 11:19:41.169256'),
(3, 'Dom', '2022-01-09 11:20:17.584848'),
(4, 'Prevozni stroški', '2022-01-09 11:21:49.154429'),
(5, 'Darila', '2022-01-09 11:22:47.499544'),
(6, 'Drugo', '2022-01-09 11:22:55.032790');

-- --------------------------------------------------------

--
-- Struktura tabele `stranka`
--

CREATE TABLE `stranka` (
  `IDStranka` int(50) NOT NULL,
  `ImeStranke` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PriimekStranke` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Geslo` varchar(50) NOT NULL,
  `DatumVnosa` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `stranka`
--

INSERT INTO `stranka` (`IDStranka`, `ImeStranke`, `PriimekStranke`, `Email`, `Geslo`, `DatumVnosa`) VALUES
(1, 'Gregor', 'Gašparac', 'gasparac.gregor8@gmail.com', 'tsest', '2022-01-09 10:45:52.009685'),
(2, 'Gregor', 'Gašparac', 'gasparac.gregor@gmail.com', 'test', '2022-01-09 10:46:58.627415'),
(3, 'Gregor', 'Gašparac', 'gre.fifa@gmail.com', 'test', '2022-01-09 15:34:25.522772'),
(4, 'Jakob', 'Gimpelj', 'jakob.jakob122@gmail.com', 'piki', '2022-01-10 19:52:32.586933'),
(5, 'Janez', 'Novak', 'janez.novak@gmail.com', 'janez123', '2022-01-12 19:08:40.809055'),
(6, 'Michael', 'Jordan', 'mike@gmail.com', 'jordan', '2022-01-12 19:11:35.127409'),
(7, 'John', 'Doe', 'john@gmail.com', 'test', '2022-01-12 23:32:15.515677'),
(8, 'Miha', 'Prijatelj', 'miha.prijatelj@gmail.com', 'mihec', '2022-01-12 23:34:22.727098'),
(9, 'Maček', 'Muri', 'muri@siol.net', 'muri', '2022-01-12 23:35:43.939388'),
(10, 'Tom', 'Jerry', 'tj@gmail.com', 'lalala', '2022-01-12 23:37:01.105701'),
(11, 'Lebron', 'James', 'lakers@gmail.com', 'lakers', '2022-01-12 23:50:15.497610'),
(12, 'Gregor', 'Gašparac', 'fifa@gmail.com', 'fifa', '2022-01-12 23:51:05.775767'),
(13, 'Gregor', 'Gašparac', 'gasparac@gmail.com', 'fsdfsdfsf', '2022-01-12 23:51:53.836941'),
(14, 'Miki', 'Miška', 'miki@gmail.com', 'disney', '2022-01-12 23:52:53.131219'),
(15, 'Jaka', 'Racman', 'racman@gmail.com', 'jaka', '2022-01-13 14:52:05.609124'),
(16, 'Magnus', 'Carlsen', 'magnus.carlsen@gmail.com', 'playmagnus', '2022-01-18 18:37:05.915137');

-- --------------------------------------------------------

--
-- Struktura tabele `stroski`
--

CREATE TABLE `stroski` (
  `IDStrosek` int(50) NOT NULL,
  `ImeStroska` varchar(50) NOT NULL,
  `Vrednost` double NOT NULL,
  `IDStranke` int(50) NOT NULL,
  `IDKategorije` int(50) NOT NULL,
  `DatumStroska` date NOT NULL,
  `DatumVnosa` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `stroski`
--

INSERT INTO `stroski` (`IDStrosek`, `ImeStroska`, `Vrednost`, `IDStranke`, `IDKategorije`, `DatumStroska`, `DatumVnosa`) VALUES
(2, 'mercator', 6.87, 1, 1, '2022-01-11', '2022-01-18 17:47:11.364550'),
(3, 'bencin', 40, 1, 4, '2022-01-18', '2022-01-18 17:47:26.852941'),
(4, 'čistila', 12.99, 1, 3, '2022-01-13', '2022-01-18 17:48:00.193551'),
(5, 'bon', 25, 1, 5, '2021-12-28', '2022-01-18 17:48:49.952192'),
(6, 'žoga', 29.99, 1, 2, '2022-01-11', '2022-01-18 17:49:17.531513'),
(7, 'bon', 25, 1, 5, '2022-01-01', '2022-01-18 17:49:43.859834'),
(8, 'piva', 2, 1, 1, '2022-01-16', '2022-01-18 18:19:48.879638'),
(9, 'vinjeta', 110, 1, 4, '2022-01-05', '2022-01-18 18:31:23.574832'),
(10, 'gledališče', 15, 1, 6, '2022-01-02', '2022-01-18 18:42:35.098663'),
(11, 'špar', 87.76, 1, 1, '2022-01-17', '2022-01-18 20:10:40.511004'),
(14, 'letalska karta', 30, 1, 4, '2022-01-19', '2022-01-19 14:18:21.605617'),
(17, 'študentski bon', 4.31, 1, 1, '2022-01-19', '2022-01-19 23:33:59.349598'),
(18, 'študentski bon', 3.21, 1, 1, '2022-01-04', '2022-01-19 23:46:18.293040');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`IDKategorija`);

--
-- Indeksi tabele `stranka`
--
ALTER TABLE `stranka`
  ADD PRIMARY KEY (`IDStranka`);

--
-- Indeksi tabele `stroski`
--
ALTER TABLE `stroski`
  ADD PRIMARY KEY (`IDStrosek`),
  ADD KEY `IDStranke` (`IDStranke`),
  ADD KEY `IDKategorije` (`IDKategorije`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `IDKategorija` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT tabele `stranka`
--
ALTER TABLE `stranka`
  MODIFY `IDStranka` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT tabele `stroski`
--
ALTER TABLE `stroski`
  MODIFY `IDStrosek` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `stroski`
--
ALTER TABLE `stroski`
  ADD CONSTRAINT `stroski_ibfk_1` FOREIGN KEY (`IDStranke`) REFERENCES `stranka` (`IDStranka`),
  ADD CONSTRAINT `stroski_ibfk_2` FOREIGN KEY (`IDKategorije`) REFERENCES `kategorija` (`IDKategorija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
