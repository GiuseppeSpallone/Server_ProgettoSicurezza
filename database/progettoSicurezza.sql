-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 03, 2018 alle 12:59
-- Versione del server: 10.1.33-MariaDB
-- Versione PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progettosicurezza`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `aggiornamento`
--

CREATE TABLE `aggiornamento` (
  `id` int(2) NOT NULL,
  `versione` int(2) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `aggiornamento`
--

INSERT INTO `aggiornamento` (`id`, `versione`, `file`) VALUES
(1, 1, 'ferfer'),
(2, 1, 'ferfer');

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `id` int(3) NOT NULL,
  `titolo` varchar(25) NOT NULL,
  `formato` varchar(5) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id`, `titolo`, `formato`, `file`) VALUES
(1, 'Shrek', 'jpg', 'http://www.immaginipertutti.com/pic/shrek/immagini-shrek-2.jpg'),
(2, 'Minions', 'jpg', 'https://www.socialup.it/wp-content/uploads/2017/06/ridere-fa-bene.jpg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aggiornamento`
--
ALTER TABLE `aggiornamento`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `aggiornamento`
--
ALTER TABLE `aggiornamento`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
