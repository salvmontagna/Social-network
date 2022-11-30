-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 11, 2020 alle 11:03
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `follower`
--

CREATE TABLE `follower` (
  `username` varchar(15) NOT NULL,
  `username_following` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `follower`
--

INSERT INTO `follower` (`username`, `username_following`) VALUES
('fabiman', 'carlo_vita'),
('fabiman', 'egidio68'),
('fabiman', 's_monti97'),
('s_monti97', 'carlo_vita'),
('s_monti97', 'fabiman'),
('s_monti97', 'melo_pro12'),
('s_monti97', 'ricky123'),
('s_monti97', 's_monti97'),
('s_monti97', 'vinci.mari');

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `id_post_like` int(11) NOT NULL,
  `id_username_like` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`id_post_like`, `id_username_like`) VALUES
(19, 's_monti97'),
(20, 'egidio68'),
(20, 's_monti97'),
(21, 'fabiman'),
(21, 's_monti97'),
(23, 'fabiman'),
(24, 's_monti97'),
(27, 'fabiman'),
(27, 's_monti97'),
(28, 's_monti97'),
(29, 's_monti97'),
(32, 'fabiman'),
(32, 's_monti97'),
(33, 'fabiman'),
(33, 's_monti97'),
(34, 'fabiman'),
(34, 's_monti97');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_username` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `id_username`, `title`, `post_image`, `date_stamp`) VALUES
(19, 's_monti97', 'cad', 'https://media1.giphy.com/media/ppLnsUYynW0ne/100.gif?cid=35a20dad39c673955844c05656ca1fac962c50f54dfea124', '2020-05-09 13:17:31'),
(20, 'fabiman', 'pikachu bellissimo', 'https://media2.giphy.com/media/L95W4wv8nnb9K/100.gif?cid=35a20dad6ee984313b5078af66bc268bdeebd23c8b6694a6', '2020-05-09 13:58:22'),
(21, 'fabiman', 'mamma lo amo', 'https://media2.giphy.com/media/tYaF80CM7YL96/100.gif?cid=35a20dad8f0bcae6d7b7567f82f6aea7fe5f6505b64cbc1a', '2020-05-09 13:58:37'),
(22, 'vinci.mari', 'montagna è stupendo', 'https://media1.giphy.com/media/wJoDQt3uMfXW0/100.gif?cid=35a20dad2bda81d69d3a6c36e22d8ce5384f155663f19ec4', '2020-05-09 13:59:22'),
(23, 'egidio68', 'non devo comparire', 'https://media1.giphy.com/media/MDs1OPKPdW4UrxwYj6/100.gif?cid=35a20dad6e3e000647f5399415e89716dff7a296d40a48dd', '2020-05-09 15:33:58'),
(24, 's_monti97', 'carmelo frocio', 'https://media1.giphy.com/media/3o72FhP4UdUxU5yKUU/100.gif?cid=35a20dadc715a7e5d8ea87bf7603a3c1edaa5748df358999', '2020-05-09 16:50:25'),
(27, 's_monti97', 'asdsda', 'https://media1.giphy.com/media/3oKIPsx2VAYAgEHC12/100.gif?cid=35a20dad41ba8e6942b3890c9b9801b37bfca5885d4316a1', '2020-05-09 23:04:13'),
(28, 's_monti97', 'cas', 'https://pixabay.com/get/55e2d6444352a914f1dc84609629377b173fdeec534c704c7d267ad69e48c750_640.jpg', '2020-05-10 16:52:21'),
(29, 's_monti97', 'cas', 'https://media3.giphy.com/media/3ov9jWu7BuHufyLs7m/100.gif?cid=35a20dad3bad62a1097bc582013af56c5e865477d6669a31', '2020-05-10 22:35:16'),
(30, 's_monti97', 'car', 'https://pixabay.com/get/55e2d6444352a914f1dc84609629377b173fdeec534c704c7d267ad1974cc75b_640.jpg', '2020-05-10 22:35:28'),
(31, 's_monti97', 'cas', 'https://pixabay.com/get/52e3d14a4b5ab10ff3d8992cc628327c153fd7e54e5074417c2e7ed4964ecd_640.jpg', '2020-05-10 22:35:42'),
(32, 's_monti97', 'Test. Non dormu chiu', 'https://pixabay.com/get/57e3d3454350aa14f1dc84609629377b173fdeec534c704c7d267ad19545c751_640.jpg', '2020-05-10 23:20:46'),
(33, 'fabiman', 'Manco io. Scherzo sono monti', 'https://media3.giphy.com/media/xT8qBvH1pAhtfSx52U/100.gif?cid=35a20dad3be7a4c55c5cfe2ad9f5ccc26e3c71e8a145ec86', '2020-05-10 23:21:41'),
(34, 'fabiman', 'haiu sonnu', 'https://pixabay.com/get/57e0dd444253a514f1dc84609629377b173fdeec534c704c7d267ad19448c25c_640.jpg', '2020-05-10 23:33:13');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `name` text NOT NULL,
  `surname` text DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `name`, `surname`, `email`, `password`, `image`) VALUES
('carlo_vita', 'Carlo', 'Vitale', 'carlovitale@gmail.com', '123', 'csda12.jpg'),
('egidio68', 'manuel', 'messina', 'manumessina91@tiscali.it', '123', 'adsas.jpg'),
('fabiman', 'fabiola', 'mannelli', 'fabimanni@gmail.it', '1234', 'ads123.jpg'),
('melo_pro12', 'carmelo', 'proetto', 'meloproetto@yahoo.it', '123', 'dasds123.jpg'),
('ricky123', 'riccardo', 'mozzicato', 'riky14@gmail.com', '123', 'YDXJ0705.jpg'),
('sdads', 'sadas', 'asd', 'asdads@das.it', '123', 'Intex 28272 Piscina Frame Rettangolare 300x200x75cm-Piscine, 3834 Litri, 300 x 200 x 75 cm, Azzuro- Amazon.it- Giardino e giardinaggio.url'),
('s_monti', 'dasds', 'dasds', 'saddas@das.it', '123', 'Lez_2020_04_23.url'),
('s_monti97', 'salvatore', 'montagna', 'montino97@gmail.com', '123', 'miaFoto.jpg'),
('vinci.mari', 'vincenzo', 'marino', 'marinoenzo13@gmail.com', '123', 'ciadso12.jpg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`username`,`username_following`),
  ADD KEY `index_username` (`username`),
  ADD KEY `index_username_following` (`username_following`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_post_like`,`id_username_like`),
  ADD KEY `idx_post` (`id_post_like`),
  ADD KEY `idx_username` (`id_username_like`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `idx_username` (`id_username`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`username_following`) REFERENCES `user` (`username`);

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_post_like`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_username_like`) REFERENCES `user` (`username`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
