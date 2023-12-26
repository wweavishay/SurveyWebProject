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
-- מבנה טבלה עבור טבלה `threetablejoin`
--

CREATE TABLE `threetablejoin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `flightnum` text NOT NULL,
  `ideries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `threetablejoin`
--

INSERT INTO `threetablejoin` (`id`, `username`, `flightnum`, `ideries`) VALUES
(0, '0', '0', 0),
(10, 'dana', 'ly315888', 1),
(10, 'avishay', 'ly3158889', 2),
(10, 'yossi123', 'ly12121', 3),
(10, 'guy', 'lysdsdsd', 4),
(10, 'shir123', 'ly315', 5);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `threetablejoin`
--
ALTER TABLE `threetablejoin`
  ADD PRIMARY KEY (`ideries`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
