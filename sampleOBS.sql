-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Ağu 2020, 12:47:18
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sampleOBS`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `classes`
--

CREATE TABLE `classes` (
  `classID` int(11) NOT NULL,
  `classCode` varchar(3) NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `classes`
--

INSERT INTO `classes` (`classID`, `classCode`, `className`) VALUES
(1, 'TUR', 'Turkce'),
(2, 'MAT', 'Matematik'),
(3, 'GEO', 'Geometri'),
(4, 'TAR', 'Tarih');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pickedClasses`
--

CREATE TABLE `pickedClasses` (
  `pcID` int(11) NOT NULL,
  `studentNumber` int(11) NOT NULL,
  `classID` int(5) NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `pickedClasses`
--

INSERT INTO `pickedClasses` (`pcID`, `studentNumber`, `classID`, `className`) VALUES
(1, 10, 1, 'Turkce'),
(2, 10, 2, 'Matematik'),
(5, 13, 1, 'Turkce'),
(6, 13, 2, 'Matematik'),
(7, 13, 3, 'Geometri'),
(8, 13, 4, 'Tarih'),
(9, 10, 4, 'Tarih');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`roleID`, `roleType`) VALUES
(1, 'Student'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userNo` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `userNo`, `name`, `surname`, `age`, `password`, `createdAt`, `role`) VALUES
(8, 10000, 'admin', 'admin', 12, 'admin', '2020-08-01', 2),
(9, 11111, 'yönetici', 'yönetici', 24, 'password', '2020-08-01', 2),
(10, 12345, 'Ahmet', 'Demir', 21, 'aDemir', '2020-08-01', 1),
(11, 54321, 'Ayşe', 'Özel', 32, 'aOzel', '2020-08-12', 1),
(13, 44444, 'Leyla', 'Mecnun', 23, 'lMecnun', '2020-08-12', 1),
(14, 55555, 'Beşer', 'Beşmez', 33, 'bBesmez', '2020-08-02', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`);

--
-- Tablo için indeksler `pickedClasses`
--
ALTER TABLE `pickedClasses`
  ADD PRIMARY KEY (`pcID`),
  ADD KEY `studentNumber` (`studentNumber`),
  ADD KEY `classID` (`classID`),
  ADD KEY `className` (`className`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `pickedClasses`
--
ALTER TABLE `pickedClasses`
  MODIFY `pcID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `pickedClasses`
--
ALTER TABLE `pickedClasses`
  ADD CONSTRAINT `pickedClasses_ibfk_1` FOREIGN KEY (`studentNumber`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pickedClasses_ibfk_2` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
