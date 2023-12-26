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
-- מבנה טבלה עבור טבלה `users`
--

CREATE TABLE `users` (
  `id` varchar(25) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(25) NOT NULL,
  `birtdhday` varchar(25) NOT NULL,
  `residence` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `gender`, `birtdhday`, `residence`, `email`, `status`) VALUES
('6', 'avi123', '76da8f404ea2b16e8713c1a8c707a420', 'female', '1996-01-13', 'USA', 'a@gmail.com', 'start'),
('0', 'avishay', '202cb962ac59075b964b07152d234b70', 'male', '1996-07-23', 'israel', 'a@gmail.com', 'finish'),
('8', 'avishay123', 'c9f1ba7d0c4c71162e50de5e75795927', 'female', '1996-01-19', 'Israel', 'abbbbbbbb@gmail.com', 'start'),
('3', 'dana', '202cb962ac59075b964b07152d234b70', 'female', '2023-02-01', 'USA', 'a@gmail.com', 'finish'),
('4', 'guy', '202cb962ac59075b964b07152d234b70', 'female', '2017-03-07', 'Israel', 'abbbbbbbb@gmail.com', 'inproccess'),
('5', 'noa123', '5fa90dc7d1cef9f22d8ba41897d210f2', 'female', '2016-07-20', 'Israel', 'shir@gmail.com', 'start'),
('2', 'ofri', '202cb962ac59075b964b07152d234b70', 'other', '', 'Israel', '', 'inproccess'),
('1', 'shir', '202cb962ac59075b964b07152d234b70', '', '', '', '', 'finish'),
('9', 'shir123', 'c9f1ba7d0c4c71162e50de5e75795927', 'female', '1996-01-19', 'Israel', 'abbbbbbbb@gmail.com', 'finish'),
('7', 'yossi123', 'cbda3571927de704b51f65623dfc62e7', 'male', '1996-01-14', 'USA', 'a@gmail.com', 'finish');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
