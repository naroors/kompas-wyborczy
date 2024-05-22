-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 22, 2024 at 09:31 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kompas`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_uzytkownika`
--

CREATE TABLE `dane_uzytkownika` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wojewodztwo` varchar(100) DEFAULT NULL,
  `powiat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komitety`
--

CREATE TABLE `komitety` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komitety`
--

INSERT INTO `komitety` (`id`, `nazwa`) VALUES
(1, 'Koalicyjny Komitet Wyborczy Trzecia Droga Polska 2050 Szymona Hołowni – Polskie Stronnictwo Ludowe'),
(2, 'Komitet Wyborczy Konfederacja Wolność i Niepodległość'),
(3, 'Komitet Wyborczy Wyborców Bezpartyjni Samorządowcy – Normalna Polska w Normalnej Europie'),
(4, 'Komitet Wyborczy Polexit'),
(5, 'Koalicyjny Komitet Wyborczy Koalicja Obywatelska'),
(6, 'Koalicyjny Komitet Wyborczy Lewica'),
(7, 'Komitet Wyborczy Prawo i Sprawiedliwość');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi_komitetu`
--

CREATE TABLE `odpowiedzi_komitetu` (
  `id` int(11) NOT NULL,
  `komitet_id` int(11) DEFAULT NULL,
  `pytanie_id` int(11) DEFAULT NULL,
  `odpowiedz` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi_uzytkownika`
--

CREATE TABLE `odpowiedzi_uzytkownika` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `pytanie_id` int(11) DEFAULT NULL,
  `odpowiedz` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `punkty`
--

CREATE TABLE `punkty` (
  `id` int(11) NOT NULL,
  `komitet_id` int(11) DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `tekst_pytania` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `komitety`
--
ALTER TABLE `komitety`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `odpowiedzi_komitetu`
--
ALTER TABLE `odpowiedzi_komitetu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komitet_id` (`komitet_id`),
  ADD KEY `pytanie_id` (`pytanie_id`);

--
-- Indeksy dla tabeli `odpowiedzi_uzytkownika`
--
ALTER TABLE `odpowiedzi_uzytkownika`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `pytanie_id` (`pytanie_id`);

--
-- Indeksy dla tabeli `punkty`
--
ALTER TABLE `punkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komitet_id` (`komitet_id`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komitety`
--
ALTER TABLE `komitety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `odpowiedzi_komitetu`
--
ALTER TABLE `odpowiedzi_komitetu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `odpowiedzi_uzytkownika`
--
ALTER TABLE `odpowiedzi_uzytkownika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `punkty`
--
ALTER TABLE `punkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `odpowiedzi_komitetu`
--
ALTER TABLE `odpowiedzi_komitetu`
  ADD CONSTRAINT `odpowiedzi_komitetu_ibfk_1` FOREIGN KEY (`komitet_id`) REFERENCES `komitety` (`id`),
  ADD CONSTRAINT `odpowiedzi_komitetu_ibfk_2` FOREIGN KEY (`pytanie_id`) REFERENCES `pytania` (`id`);

--
-- Constraints for table `odpowiedzi_uzytkownika`
--
ALTER TABLE `odpowiedzi_uzytkownika`
  ADD CONSTRAINT `odpowiedzi_uzytkownika_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `dane_uzytkownika` (`id`),
  ADD CONSTRAINT `odpowiedzi_uzytkownika_ibfk_2` FOREIGN KEY (`pytanie_id`) REFERENCES `pytania` (`id`);

--
-- Constraints for table `punkty`
--
ALTER TABLE `punkty`
  ADD CONSTRAINT `punkty_ibfk_1` FOREIGN KEY (`komitet_id`) REFERENCES `komitety` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
