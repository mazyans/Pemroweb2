-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2024 pada 17.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uefa_groups`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'Albania'),
(2, 'Andorra'),
(3, 'Armenia'),
(4, 'Austria'),
(5, 'Azerbaijan'),
(6, 'Belarus'),
(7, 'Belgium'),
(8, 'Bosnia and Herzegovina'),
(9, 'Bulgaria'),
(10, 'Croatia'),
(11, 'Cyprus'),
(12, 'Czech Republic'),
(13, 'Denmark'),
(14, 'England'),
(15, 'Estonia'),
(16, 'Faroe Islands'),
(17, 'Finland'),
(18, 'France'),
(19, 'Georgia'),
(20, 'Germany'),
(21, 'Gibraltar'),
(22, 'Greece'),
(23, 'Hungary'),
(24, 'Iceland'),
(25, 'Ireland'),
(26, 'Israel'),
(27, 'Italy'),
(28, 'Kazakhstan'),
(29, 'Kosovo'),
(30, 'Latvia'),
(31, 'Liechtenstein'),
(32, 'Lithuania'),
(33, 'Luxembourg'),
(34, 'Malta'),
(35, 'Moldova'),
(36, 'Monaco'),
(37, 'Montenegro'),
(38, 'Netherlands'),
(39, 'North Macedonia'),
(40, 'Northern Ireland'),
(41, 'Norway'),
(42, 'Poland'),
(43, 'Portugal'),
(44, 'Romania'),
(45, 'Russia'),
(46, 'San Marino'),
(47, 'Scotland'),
(48, 'Serbia'),
(49, 'Slovakia'),
(50, 'Slovenia'),
(51, 'Spain'),
(52, 'Sweden'),
(53, 'Switzerland'),
(54, 'Turkey'),
(55, 'Ukraine'),
(56, 'Wales');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_country`
--

CREATE TABLE `group_country` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_results`
--

CREATE TABLE `group_results` (
  `result_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `win` int(11) DEFAULT 0,
  `draw` int(11) DEFAULT 0,
  `loss` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `group_results`
--

INSERT INTO `group_results` (`result_id`, `group_id`, `country_id`, `win`, `draw`, `loss`, `points`) VALUES
(1, 1, 8, 1, 1, 1, 1),
(2, 1, 18, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('211011400912', 'cerdas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indeks untuk tabel `group_country`
--
ALTER TABLE `group_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indeks untuk tabel `group_results`
--
ALTER TABLE `group_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `group_country`
--
ALTER TABLE `group_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `group_results`
--
ALTER TABLE `group_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `group_country`
--
ALTER TABLE `group_country`
  ADD CONSTRAINT `group_country_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_country_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);

--
-- Ketidakleluasaan untuk tabel `group_results`
--
ALTER TABLE `group_results`
  ADD CONSTRAINT `group_results_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_results_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
