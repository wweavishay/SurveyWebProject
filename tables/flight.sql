-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: ינואר 19, 2023 בזמן 05:08 PM
-- גרסת שרת: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveyproject`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `flight`
--

CREATE TABLE `flight` (
  `compname` varchar(25) NOT NULL,
  `classtype` varchar(25) NOT NULL,
  `landloc` varchar(25) NOT NULL,
  `takeoffloc` varchar(25) NOT NULL,
  `delay` varchar(25) NOT NULL,
  `durationtime` varchar(25) NOT NULL,
  `flightnum` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `flight`
--

INSERT INTO `flight` (`compname`, `classtype`, `landloc`, `takeoffloc`, `delay`, `durationtime`, `flightnum`) VALUES
('EL AL', 'First class', 'Paris,France  ', 'Paris,France  ', '10', '10', 'kydfdsf8'),
('Air France ', 'First class ', 'Paris,France ', 'Rome,Italy ', '10 ', '10 ', 'ly12121'),
('Emirates Airline   ', 'First class   ', 'Tel aviv,Israel   ', 'Rome,Italy   ', '10   ', '15   ', 'ly315'),
('American Airlines  ', 'First class  ', 'Paris,France  ', 'Paris,France  ', '10  ', '2  ', 'ly315888'),
('American Airlines  ', 'Second class  ', 'Tel aviv,Israel  ', 'Paris,France  ', '1  ', '1  ', 'ly3158889'),
('El al', 'Second class', 'Paris,France', 'Tel aviv,Israel', '10', '10', 'lysdsdsd');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flightnum`),
  ADD UNIQUE KEY `flightnum` (`flightnum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
