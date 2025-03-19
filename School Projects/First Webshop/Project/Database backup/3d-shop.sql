-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 dec 2024 om 23:32
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3d-shop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `description`, `active`) VALUES
(1, 'Tools', NULL, 1),
(2, 'Storage', NULL, 1),
(3, 'Decoration', NULL, 1),
(4, 'Fidget', NULL, 1),
(5, 'Keychain', 'Art with a ring for your keys', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `customerID` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `phoneNbr` varchar(20) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `houseNbr` int(255) NOT NULL,
  `postalcode` varchar(15) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `profile_picture` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `admin`, `active`, `email`, `password`, `phoneNbr`, `birthdate`, `street`, `houseNbr`, `postalcode`, `city`, `country`, `profile_picture`) VALUES
(1, 'Johny', 'Peters', 1, 1, 'johnypeters@gmail.com', '$2y$10$b2Jab4/caDDDrNkoe9ifgugMsrGbB2/MH/.w9swEXMzoNzYE8YEs2', '0458269741', '2014-11-13', 'Kerkstraat', 166, '2800', 'Mechelen', 'Belgium', 'Johny.jpeg'),
(2, 'Mary', 'Jansens', 0, 1, 'maryjansens@gmail.com', '$2y$10$HE0IFRQwyOWfaLa3XCw8J.4V.V4/3y3scd/fcj6PywxZrfVUW3gfW', '0489345746', '2015-07-13', 'Lindelaan', 73, '9000', 'Gent', 'Belgium', 'mary-profile.jpg'),
(3, 'Bob', 'Bober', 0, 1, 'bobbober@gmail.com', '$2y$10$ZdU4UjHxZQ9.suFA2BOjaOFUcXjMvhRzrrjBxdbTvkmn/A5gL5TY2', '0478536987', '0000-00-00', 'Elzestraat', 98, '2860', 'Sint Katelijne Waver', 'Belgium', 'bober.jpeg'),
(9, 'Arnauld', 'Timmermans', 0, 1, 'arnauldtimmers@gmail.com', '$2y$10$lvtCzmTfzYBmlZxmtE9eFuD2CFa4g6UmWAu3dCQzAZBn1ZCYMhgYS', '0485 63 24 17', '0000-00-00', 'Kerkhoflei', 54, '2800', 'Mechelen', 'Belgium', NULL),
(10, 'Maria', 'Bakker', 0, 1, 'mariabakker@gmail.com', '$2y$10$WKPp.JF.dKN4vIzgtTQSeOaBTcMcmuQJ5vUrGhCqDElEOL6.gjznm', '0475364587', '0000-00-00', 'Valkensweg', 4, '9000', 'Gent', 'Belgium', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(10) UNSIGNED DEFAULT NULL,
  `productID` int(10) UNSIGNED DEFAULT NULL,
  `unitPrice` float UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `discount` float UNSIGNED DEFAULT NULL,
  `OrderDetailID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `unitPrice`, `quantity`, `discount`, `OrderDetailID`) VALUES
(1, 1, 11, 2, NULL, 1),
(1, 2, 7, 1, NULL, 2),
(1, 3, 1.5, 1, NULL, 3),
(1, 4, 8.25, 1, NULL, 4),
(1, 5, 3.5, 1, NULL, 5),
(1, 6, 5.25, 1, NULL, 6),
(2, 2, 14, 2, NULL, 7),
(2, 3, 1.5, 1, NULL, 8),
(3, 4, 16.5, 2, NULL, 9),
(3, 3, 1.5, 1, NULL, 10),
(4, 5, 7, 2, NULL, 11),
(4, 1, 5.5, 1, NULL, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `customerID` int(10) UNSIGNED DEFAULT NULL,
  `orderDate` date NOT NULL,
  `shippedDate` date DEFAULT NULL,
  `shipStreet` varchar(255) NOT NULL,
  `shipHouseNumber` int(255) NOT NULL,
  `shipPostalcode` varchar(15) NOT NULL,
  `shipCity` varchar(255) NOT NULL,
  `shipCountry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `orderDate`, `shippedDate`, `shipStreet`, `shipHouseNumber`, `shipPostalcode`, `shipCity`, `shipCountry`) VALUES
(1, 3, '2024-12-12', '2024-12-12', 'Elzestraat', 98, '2860', 'Sint-Katelijne-Waver', 'Belgium'),
(2, 2, '2024-12-12', '2024-12-12', 'Lindelaan', 73, '9000', 'Gent', 'Belgium'),
(3, 2, '2024-12-12', '2024-12-13', 'Lindelaan', 73, '9000', 'Gent', 'Belgium'),
(4, 3, '2024-12-12', '2024-12-13', 'Elzestraat', 98, '2860', 'Sint-Katelijne-Waver', 'Belgium');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `productID` int(10) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `categoryID` int(10) UNSIGNED DEFAULT NULL,
  `currentUnitCost` float UNSIGNED NOT NULL,
  `currentUnitPrice` float UNSIGNED NOT NULL,
  `creator` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `picture` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`productID`, `productName`, `categoryID`, `currentUnitCost`, `currentUnitPrice`, `creator`, `description`, `active`, `picture`) VALUES
(1, 'Sanding tool', 1, 0.93, 5.5, 'Valera Perinski', 'This makes sanding more comfortable', 1, 'sandingtool.jpeg'),
(2, 'Tulips Wall Art Decoration', 3, 0.76, 7, 'ArgiCZ', 'Beautiful art to hang on your wall', 1, 'tulipwallart.jpeg'),
(3, 'Switch Fidget', 4, 0.22, 1.5, '3D Delight', 'Relax with this simple fidget switch', 1, 'fidgetswitch.jpeg'),
(4, 'Storage box (basket)', 2, 4.97, 8.25, 'Da Vinci', 'Use this elegant basket to store your stuff', 1, 'basket.jpeg'),
(5, '3x Bike tire removal tool', 1, 1.05, 3.5, 'Niko', 'Flat tire? This tool makes a tire change way easier', 1, 'tireremovaltool.jpeg'),
(6, 'Bolt measuring tool', 1, 1.14, 5.25, 'Sprenger', 'Tool to measure your bolts', 1, 'boltmeasuring.jpeg'),
(7, 'Cute cat candle holder', 3, 0.63, 3.75, 'SnailPrint', 'Unique decoration for cat lovers or for Christmas holidays', 1, 'catcandle.jpeg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexen voor tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderdetails_ibfk_1` (`orderID`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
