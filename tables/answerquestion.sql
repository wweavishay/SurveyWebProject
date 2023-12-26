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
-- מבנה טבלה עבור טבלה `answerquestion`
--

CREATE TABLE `answerquestion` (
  `questionid` varchar(25) NOT NULL,
  `answer` longtext NOT NULL,
  `username` varchar(25) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `answerquestion`
--

INSERT INTO `answerquestion` (`questionid`, `answer`, `username`, `id`) VALUES
('0', '0', '0', 0),
('1', '3 ', 'dana', 1),
('2', '2', 'dana', 2),
('3', '3', 'dana', 3),
('4', '3', 'dana', 4),
('5', '3', 'dana', 5),
('6', '1', 'dana', 6),
('7', '3', 'dana', 7),
('8', '3', 'dana', 8),
('9', ',Newspaper', 'dana', 9),
('10', ',service', 'dana', 10),
('1', '3', 'avishay', 11),
('2', '3', 'avishay', 12),
('3', '3', 'avishay', 13),
('4', '3 ', 'avishay', 14),
('5', '3 ', 'avishay', 15),
('6', '3 ', 'avishay', 16),
('7', '4 ', 'avishay', 17),
('8', '4 ', 'avishay', 18),
('9', ',Newspaper,Media', 'avishay', 19),
('10', ',food,service', 'avishay', 20),
('1', '1', 'yossi123', 21),
('2', '2 ', 'yossi123', 22),
('3', '3 ', 'yossi123', 23),
('4', '3 ', 'yossi123', 24),
('5', '2 ', 'yossi123', 25),
('6', '1 ', 'yossi123', 26),
('7', '2 ', 'yossi123', 27),
('8', '3 ', 'yossi123', 28),
('9', ',Media,None', 'yossi123', 29),
('10', ',food,cleaning', 'yossi123', 30),
('1', '1 ', 'guy', 31),
('2', '', 'guy', 32),
('3', '', 'guy', 33),
('4', '', 'guy', 34),
('5', '', 'guy', 35),
('6', '', 'guy', 36),
('7', '', 'guy', 37),
('8', '', 'guy', 38),
('9', '', 'guy', 39),
('10', '', 'guy', 40),
('1', '1', 'shir123', 41),
('2', '3', 'shir123', 42),
('3', '3', 'shir123', 43),
('4', '2 ', 'shir123', 44),
('5', '3 ', 'shir123', 45),
('6', '4 ', 'shir123', 46),
('7', '4 ', 'shir123', 47),
('8', '2 ', 'shir123', 48),
('9', ',Newspaper,Media', 'shir123', 49),
('10', ',food,cleaning', 'shir123', 50);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `answerquestion`
--
ALTER TABLE `answerquestion`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
