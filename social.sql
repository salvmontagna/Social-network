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
-- Structure of `follower`table
--

CREATE TABLE `follower` (
  `username` varchar(15) NOT NULL,
  `username_following` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure of `likes`table
--

CREATE TABLE `likes` (
  `id_post_like` int(11) NOT NULL,
  `id_username_like` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure of `post`table
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_username` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure of `user`table
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
-- Indexes for `follower` tables
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`username`,`username_following`),
  ADD KEY `index_username` (`username`),
  ADD KEY `index_username_following` (`username_following`);

--
-- Indexes for `likes` tables
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_post_like`,`id_username_like`),
  ADD KEY `idx_post` (`id_post_like`),
  ADD KEY `idx_username` (`id_username_like`);

--
-- Indexes for `post` tables
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `idx_username` (`id_username`);

--
-- Indexes for `user` tables
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for `post` table
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Limits for `follower` table
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`username_following`) REFERENCES `user` (`username`);

--
-- Limits for `likes` table
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_post_like`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_username_like`) REFERENCES `user` (`username`);

--
-- Limits for `post` table
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
