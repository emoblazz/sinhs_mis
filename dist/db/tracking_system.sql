-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2022 at 04:18 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `fullname`, `password`, `contact`, `pic`) VALUES
(1, 'emoblazz', 'Honeylee T. Magbanua', '202cb962ac59075b964b07152d234b70', '09263562814', '../dist/img/avatar3.png'),
(2, 'gemma', 'Gemma Belnas', '9fab187bcdc5a5baf91a986ca34debe9', 'na', '../dist/img/avatar3.png'),
(3, 'alma', 'Alma Garnica', 'a13817dbe1bfbd579b282eb3a6e88598', 'na', '../dist/img/avatar3.png'),
(4, 'masheila', 'Ma. Sheila Fortunado', 'ffe49cdf45d56b04b8542e6abc4f5fb6', '09307730273', '../dist/img/avatar3.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Guest'),
(2, 'Student'),
(3, 'Parent'),
(4, 'JHS Personnel'),
(5, 'SHS Personnel'),
(6, 'Job Order'),
(7, 'LITERACY TEACHER');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Hinigaran'),
(2, 'Isabela'),
(3, 'Himamaylan City'),
(4, 'Bago City'),
(5, 'Bacolod City'),
(6, 'Pontevedra'),
(7, 'San Enrique'),
(8, 'Valladolid'),
(9, 'La Carlota City'),
(10, 'SILAY CITY');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `track_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`track_id`, `user_id`, `track_date`) VALUES
(48, 6, '2022-05-10 16:01:31'),
(49, 15, '2022-05-10 16:01:42'),
(50, 8, '2022-05-10 16:01:49'),
(51, 9, '2022-05-10 16:01:56'),
(52, 7, '2022-05-10 16:02:03'),
(53, 10, '2022-05-10 16:02:09'),
(54, 16, '2022-05-10 16:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `user_first` varchar(30) NOT NULL,
  `user_last` varchar(30) NOT NULL,
  `user_contact` varchar(30) NOT NULL,
  `qrcode` varchar(50) DEFAULT NULL,
  `user_address` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_bday` date NOT NULL,
  `user_sex` varchar(15) NOT NULL,
  `audio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first`, `user_last`, `user_contact`, `qrcode`, `user_address`, `city_id`, `cat_id`, `user_bday`, `user_sex`, `audio`) VALUES
(000001, 'Alma', 'Garnica', '09983574531', '../dist/img/8.png', 'Isabela', 2, 4, '1963-02-18', 'Female', 'dist/audio/garnica.mp3'),
(000002, 'HONEYLEE', 'MAGBANUA', '09263562814', '../dist/img/6.png', 'BRGY. BUSAY', 4, 4, '1989-10-14', '', 'dist/audio/magbanua.mp3'),
(000003, 'Fortunado', 'Ma. Sheila', '09307730273', '../dist/img/7.png', 'Brgy. San Isidro', 6, 6, '1986-08-20', 'Female', 'dist/audio/fortunado.mp3'),
(000004, 'JEZEEL', 'TOLEDO', 'N/A', '../dist/img/30.png', 'BRGY. SAN ISIDRO', 6, 6, '0011-11-11', 'Male', 'dist/audio/toledo.mp3'),
(000005, 'JOSE', 'TENDERO', 'N/A', '../dist/img/29.png', 'BRGY. SAN ISIDRO', 6, 6, '0011-11-11', 'Male', 'dist/audio/tendero.mp3'),
(000006, 'EPIE', 'GOMEZ', 'N/A', '../dist/img/28.png', 'N/A', 10, 4, '1962-01-06', 'Male', 'dist/audio/gomez.mp3'),
(000007, 'IRIS LEE', 'PALLER', 'N/A', '../dist/img/27.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1982-08-13', 'Female', 'dist/audio/paller.mp3'),
(000008, 'REBECCA', 'MAGTULIS', 'N/A', '../dist/img/26.png', 'N/A', 6, 4, '1987-08-09', 'Female', 'dist/audio/magtulis.mp3'),
(000009, 'AMMIE', 'TEODORO', 'N/A', '../dist/img/9.png', 'BRGY. SAN ISIDRO', 6, 4, '1970-03-24', 'Female', 'dist/audio/ateodoro.mp3'),
(000010, 'ROWENA', 'RESUMA', 'N/A', '../dist/img/10.png', 'BRGY 1, ZONE 1', 1, 4, '1970-03-05', 'Female', 'dist/audio/resuma.mp3'),
(000011, 'LUCENDA', 'TEODORO ', 'N/A', '../dist/img/11.png', 'BRGY. SAN ISIDRO', 6, 4, '1960-03-25', 'Female', 'dist/audio/lteodoro.mp3'),
(000012, 'GEMMA', 'BELNAS', 'N/A', '../dist/img/12.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1969-12-30', 'Female', 'dist/audio/belnas.mp3'),
(000013, 'ROSEBEC', 'DE ASIS', 'N/A', '../dist/img/13.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1978-01-23', 'Female', 'dist/audio/deasis.mp3'),
(000014, 'AILENE', 'AMBAGAN', 'N/A', '../dist/img/14.png', 'BRGY. SAN ISIDRO', 6, 4, '1974-11-26', 'Female', 'dist/audio/aambagan.mp3'),
(000015, 'CAROLINE', 'CELIS', 'N/A', '../dist/img/15.png', 'N/A', 6, 4, '1977-01-05', 'Female', 'dist/audio/celis.mp3'),
(000016, 'JOMARIE', 'CANJA', 'N/A', '../dist/img/16.png', 'N/A', 8, 4, '1992-10-17', 'Male', 'dist/audio/canja.mp3'),
(000017, 'EVERLEE FAITH', 'TUYA', 'N/A', '../dist/img/17.png', 'N/A', 7, 4, '1978-11-15', 'Female', 'dist/audio/tuya.mp3'),
(000018, 'RAFFY', 'EYAN', 'N/A', '../dist/img/18.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1994-11-07', 'Male', 'dist/audio/reyan.mp3'),
(000019, 'JENNY ANN', 'GREGORIO', 'N/A', '../dist/img/19.png', 'BRGY. SAN ISIDRO', 6, 4, '1990-11-14', 'Female', 'dist/audio/gregorio.mp3'),
(000020, 'MHERVIE', 'ELAYRON', 'N/A', '../dist/img/20.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1979-09-22', 'Female', 'dist/audio/elayron.mp3'),
(000021, 'ROCELIA', 'SARASA', 'N/A', '../dist/img/21.png', 'BRGY. BALANGIGAY', 6, 4, '1973-02-22', 'Female', 'dist/audio/sarasa.mp3'),
(000022, 'MARJORIE', 'ELEDIA', 'N/A', '../dist/img/22.png', 'N/A', 6, 4, '1993-12-23', 'Female', 'dist/audio/eledia.mp3'),
(000023, 'CRIS MAY', 'GEANGA', 'N/A', '../dist/img/23.png', 'BRGY. M. H. DEL PILAR', 6, 4, '1996-12-20', 'Female', 'dist/audio/geanga.mp3'),
(000024, 'LISANDRO', 'PURA', 'N/A', '../dist/img/24.png', 'BRGY. SAN ISIDRO', 6, 4, '1978-08-03', 'Male', 'dist/audio/pura.mp3'),
(000025, 'ROCHELLIE', 'HULLEZA', 'N/A', '../dist/img/25.png', 'N/A', 8, 4, '1991-01-20', 'Female', 'dist/audio/hulleza.mp3'),
(000031, 'QUINCY MAE', 'EYAN', 'N/A', '../dist/img/31.png', 'BRGY. M. H. DEL PILAR', 6, 7, '0111-11-11', 'Female', 'dist/audio/qeyan.mp3'),
(000032, 'JONALYN', 'ESTRELLANES', 'N/A', '../dist/img/32.png', 'BRGY. SAN ISIDRO', 6, 7, '0111-11-11', 'Female', 'dist/audio/estrellanes.mp3'),
(000033, 'GRACE', 'FRIAS', 'N/A', '../dist/img/33.png', 'N/A', 8, 7, '0011-11-11', 'Female', 'dist/audio/frias.mp3'),
(000034, 'MA. HENISA', 'BANDIOLA', 'N/A', '../dist/img/34.png', 'N/A', 2, 5, '0011-11-11', 'Female', 'dist/audio/bandiola.mp3'),
(000035, 'ROWENA', 'MOGUAD', 'N/A', '../dist/img/35.png', 'BRGY. SAN ISIDRO', 6, 5, '0011-11-11', 'Female', 'dist/audio/moguad.mp3'),
(000036, 'SHEILA', 'JALANDONI', 'N/A', '../dist/img/36.png', 'BRGY. SAN ISIDRO', 6, 5, '0011-11-11', 'Female', 'dist/audio/jalandoni.mp3'),
(000037, 'MANUEL', 'ABADA', 'N/A', '../dist/img/37.png', 'N/A', 7, 5, '0111-11-11', 'Male', 'dist/audio/abada.mp3'),
(000038, 'JOMER', 'GEPANAGO', 'N/A', '../dist/img/38.png', 'N/A', 8, 5, '0111-11-11', 'Male', 'dist/audio/gepanago.mp3'),
(000039, 'REMAN', 'CABALONGA', 'N/A', '../dist/img/39.png', 'BRGY. CAMBARUS', 6, 5, '0111-11-11', 'Male', 'dist/audio/cabalonga.mp3'),
(000040, 'DSDS', 'DSDS', 'dsd', '../dist/img/40.png', 'DSDS', 5, 1, '2022-01-01', 'Male', NULL),
(000041, 'DDD', 'DDD', '4343', '../dist/img/41.png', '43', 6, 1, '2022-01-01', 'Female', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
