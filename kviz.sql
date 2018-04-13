-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 05:33 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kviz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answertable`
--

CREATE TABLE `answertable` (
  `A_id` int(10) UNSIGNED NOT NULL,
  `ans` varchar(50) NOT NULL,
  `t_id` int(10) NOT NULL,
  `q_id` int(50) NOT NULL,
  `correct` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answertable`
--

INSERT INTO `answertable` (`A_id`, `ans`, `t_id`, `q_id`, `correct`) VALUES
(1, 'Melnu kafiju', 1, 1, 1),
(2, 'Melnu kafiju ar cukuru un pienu', 1, 1, 0),
(3, 'Espresso', 1, 1, 0),
(4, 'Kapučīno', 1, 1, 0),
(5, 'otraaa testa pirmaa jautaajuma pirmaa atbilde', 2, 1, 1),
(6, '23Mazu', 1, 2, 0),
(8, 'otraaa testa pirmaa jautaajuma otraaaaaa atbilde', 2, 1, 0),
(9, 'otraaa testa pirmaa jautaajuma 3. atbilde', 2, 1, 0),
(10, 'Kafejnīca', 1, 3, 1),
(11, 'Tuvākajā vietā pie mājām/darba', 1, 4, 0),
(14, '222    testa 2222   jautaajuma pirmaa atbilde', 2, 2, 1),
(15, '22222   testa 22222    jautaajuma pirmaa atbilde', 2, 2, 0),
(16, '222    testa 2   jautaajuma 3333   atbilde', 2, 2, 0),
(17, '22222   testa 2   jautaajuma 33333   atbilde', 2, 2, 0),
(18, 'Aromāts', 1, 5, 1),
(19, 'Garsa', 1, 5, 0),
(20, 'Pēcgarsa', 1, 5, 0),
(21, 'Kofeīns', 1, 5, 0),
(22, '2 3 1', 2, 3, 1),
(23, '2 4 1', 2, 4, 0),
(24, 'Normālu', 1, 2, 1),
(25, 'Mājas', 1, 3, 0),
(26, 'Narvesenā/Statoilā', 1, 4, 1),
(27, 'Lielveikalā', 1, 4, 0),
(28, 'sasaāčš', 1, 1, 0),
(29, 'kas citsšā', 1, 1, 0),
(30, 'kas notiekāš', 1, 1, 0),
(31, 'kas notiekāšss', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questiontable`
--

CREATE TABLE `questiontable` (
  `Q_id` int(10) UNSIGNED NOT NULL,
  `questions` varchar(300) NOT NULL,
  `test_id` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questiontable`
--

INSERT INTO `questiontable` (`Q_id`, `questions`, `test_id`) VALUES
(1, 'Kādu kafiju parasti Tu parasti vislabprātāk izvēlies?', 1),
(2, 'Kāda izmēra krūzīti Tu parasti izvēlies, ja pērc kafiju līdzņemšanai?', 1),
(3, 'Kas ir Tava iecienītākā vieta kafijas baudīšanai?', 1),
(4, 'Kur Tu parasti iegādājies kafiju?', 1),
(5, 'otras grupas 1  jaut', 2),
(6, 'otras grupas 2  jaut', 2),
(7, 'otras grupas 3  jaut', 2),
(8, 'otras grupas 4  jaut', 2),
(9, 'Kas Tev visvairāk patīk kafijā?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `S_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `T_id` int(10) NOT NULL,
  `score` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`S_id`, `user_id`, `T_id`, `score`) VALUES
(1, 42, 1, 5),
(10, 42, 2, 1),
(11, 83, 1, 5),
(12, 83, 2, 3),
(13, 84, 1, 4),
(14, 86, 1, 5),
(15, 88, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `T_id` int(10) UNSIGNED NOT NULL,
  `testname` varchar(50) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `score` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`T_id`, `testname`, `user_id`, `score`) VALUES
(1, 'Pirmais tests', 1, 2),
(2, 'Otrais tests', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int(6) UNSIGNED DEFAULT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `role_id`, `register_date`) VALUES
(14, 'name', '2c315d91421f17a4437fafed8dce72ef', 'email', 0, '2017-10-19 17:01:22'),
(17, 'maris', '$2y$10$dL/IW2qd6e1IRs3BKuRILO7Ho559soBXgHHNOEAekFTFEBLC06Kca', 'lak@lak.lv', 2, '2018-01-19 17:17:05'),
(84, 'q', '$2y$10$.M61XtRKNr8sRj1MIWopDOrHaZgUSTz/uXgCef87Dfltk4zikDSTO', 'q@q.lv', NULL, '2018-03-26 12:50:01'),
(69, 'lkaslas', '2c315d91421f17a4437fafed8dce72ef', 'las@as.lv', NULL, '2018-01-29 18:20:00'),
(72, 'vec', '2c315d91421f17a4437fafed8dce72ef', 'vec@vec.lv', NULL, '2018-01-29 18:45:41'),
(73, 'kaskas', '$2y$10$8M6CRXaOQ84Ow7hnjamD2uVZpHGkwHNtDb1enKsK4NQOT3Mbg5Tpm', 'kas@sss.lv', NULL, '2018-01-29 18:53:26'),
(64, 'f', '$2y$10$x48eDx/yfERQXxBmuAwkLe/Qj7mdNRC..lUgUzGKnS1d2hWTElBf2', 'f@fd.lv', NULL, '2018-01-29 14:52:03'),
(78, 'udhsdn', '$2y$10$orjXpgjsNPt8MdS4jZJXE.HoV4gwz8k4lZwzmrAvqaM.v/DSBWLI.', 'asas@lklk.lv', NULL, '2018-01-29 19:32:17'),
(62, 'd', '$2y$10$8qVDUjWCiu0oe616hicVFerPZwkP0gdt7vpvfOUVYgoLl3VgXiDOW', 'd@d.lv', NULL, '2018-01-29 14:48:41'),
(61, 'c', '$2y$10$Ne9LnUrU7ulgORHwoS6oHuvw4Lty4zkOjt104SfyyixCDf0yJ5CXS', 'c@c.lv', NULL, '2018-01-29 14:47:01'),
(83, 'a', '$2y$10$/yTxbUl/mxUhghSsd6.jIOI0KidU5kYv3H1LWk6L5c4aI8yHMMyx.', 'a@a.lv', NULL, '2018-03-25 20:35:25'),
(79, 'kass', '$2y$10$vjm5VRTLSvSnEMYjL4P8pOWWKy/W0UwFBfjKl9WYHRpq4UCEQMCyy', 'kss@as.lv', NULL, '2018-03-11 15:31:49'),
(80, 'asasas', '$2y$10$o6e.p1y.cgQkER.ZWUxel.Ki6H6Kr9HdhmQSbGDhraJ2OP14Nfsw2', 'asaas@asaasas.lv', NULL, '2018-03-11 15:36:03'),
(85, 'z', '$2y$10$9BO1URNCeU1SKfUt/fjEheDPbm5cqGQ4o2yEEDAZG751QJozhN8MC', 'z@z.lv', NULL, '2018-03-26 12:57:22'),
(86, 'lk', '$2y$10$HJmq/VmzydPgjMutTAmi9.vpAjyMCaQsEqlvhRypHigDGShjcMMD.', 'lkas@sds.lv', NULL, '2018-03-26 13:07:32'),
(87, 'laka', '$2y$10$0ETCTlK3Wltvi4RpVsMxdeDyFUmQjMXZgNmpUFWoAMify4EHhwtbm', 'laka@a.lv', NULL, '2018-03-26 16:45:43'),
(88, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a@a.lv', NULL, '2018-04-02 20:04:21'),
(89, 'qwe', '6ac933301a3933c8a22ceebea7000326', 'qwe@in.lv', NULL, '2018-04-04 13:43:37'),
(90, 'kals', '9c87cc3bd289c2d6f68218a4ea6b6cf4', 'kals@kals.lv', NULL, '2018-04-04 13:45:02'),
(91, 'kaj', '$2y$10$HaytP97SQroTeXxaYerIb.LOcZPEgRQNa0rYyk/tdUshhyDwTx/FO', 'kaj@kaj.lv', NULL, '2018-04-04 13:51:19'),
(92, 'kaste', '$2y$10$xDZE4rQzbV37GAj0AbEcxOnX.AJY0Jj24GRxe2/.z2DIgrH1hKZnS', 'kaste@lv.lv', NULL, '2018-04-04 13:56:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answertable`
--
ALTER TABLE `answertable`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `questiontable`
--
ALTER TABLE `questiontable`
  ADD PRIMARY KEY (`Q_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`S_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`T_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answertable`
--
ALTER TABLE `answertable`
  MODIFY `A_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `questiontable`
--
ALTER TABLE `questiontable`
  MODIFY `Q_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `S_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `T_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
