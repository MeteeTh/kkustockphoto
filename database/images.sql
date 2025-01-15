-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2025 at 01:09 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kkustockphoto_image`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DateTimeDigitized` datetime DEFAULT NULL,
  `width` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `Model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ExposureTime` varchar(255) NOT NULL,
  `FNumber` varchar(255) NOT NULL,
  `ISOSpeedRatings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `filepath`, `category`, `DateTimeDigitized`, `width`, `height`, `Model`, `ExposureTime`, `FNumber`, `ISOSpeedRatings`) VALUES
(531, '_DSC6289.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6289.jpg', 'Nature', '2021-10-18 09:30:50', '5299', '3533', NULL, '', '', ''),
(532, '_DSC6291.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6291.jpg', 'Nature', '2021-10-18 09:31:08', '5520', '3680', NULL, '', '', ''),
(533, '_DSC6294.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6294.jpg', 'Nature', '2021-10-18 09:32:20', '5359', '3573', NULL, '', '', ''),
(534, '_DSC6297.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6297.jpg', 'Nature', '2021-10-18 09:32:51', '5147', '3431', NULL, '', '', ''),
(535, '_DSC6308.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6308.jpg', 'Nature', '2021-10-18 09:35:18', '5467', '3645', NULL, '', '', ''),
(536, '_DSC6337.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6337.jpg', 'Nature', '2021-10-18 09:59:37', '5520', '3680', NULL, '', '', ''),
(537, '_DSC6339.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6339.jpg', 'Nature', '2021-10-18 09:59:46', '5520', '3680', NULL, '', '', ''),
(538, '_DSC6342.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6342.jpg', 'Nature', '2021-10-18 09:59:50', '5299', '3533', NULL, '', '', ''),
(539, '_DSC6344.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6344.jpg', 'Nature', '2021-10-18 10:00:35', '5512', '3675', NULL, '', '', ''),
(540, '_DSC6406.JPG', 'images/Nature/แปลงกัญชา มข/_DSC6406.JPG', 'Nature', '2021-10-18 10:12:58', '5520', '3680', NULL, '', '', ''),
(541, '_DSC6408.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6408.jpg', 'Nature', '2021-10-18 10:14:11', '5520', '3680', NULL, '', '', ''),
(542, '_DSC6426.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6426.jpg', 'Nature', '2021-10-18 10:18:54', '5520', '3680', NULL, '', '', ''),
(543, '_DSC6428.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6428.jpg', 'Nature', '2021-10-18 10:18:58', '5520', '3680', NULL, '', '', ''),
(544, '_DSC6434.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6434.jpg', 'Nature', '2021-10-18 10:19:52', '5119', '3413', NULL, '', '', ''),
(545, '_DSC6443.jpg', 'images/Nature/แปลงกัญชา มข/_DSC6443.jpg', 'Nature', '2021-10-18 10:22:05', '5426', '3617', NULL, '', '', ''),
(546, '_DSC6446.JPG', 'images/Nature/แปลงกัญชา มข/_DSC6446.JPG', 'Nature', '2021-10-18 10:22:09', '5520', '3680', NULL, '', '', ''),
(547, 'DSC_0064.jpg', 'uploads/Nature/DSC_0064.jpg', 'Nature', '2017-07-28 20:09:45', '3222', '4865', 'NIKON D7000', '1/2500', '2.8', '640'),
(548, 'DSC_0074.jpg', 'uploads/Nature/DSC_0074.jpg', 'Nature', '2017-07-28 20:10:27', '4928', '3264', 'NIKON D7000', '1/2500', '2.8', '640'),
(549, 'DSC_0081.jpg', 'uploads/Nature/DSC_0081.jpg', 'Nature', '2017-07-28 20:12:50', '4928', '3264', 'NIKON D7000', '1/5000', '2.8', '640'),
(550, 'DSC_0095.jpg', 'uploads/Nature/DSC_0095.jpg', 'Nature', '2017-07-28 20:17:01', '4928', '3264', 'NIKON D7000', '1/1250', '2.8', '640'),
(551, 'DSC_0113.jpg', 'uploads/Nature/DSC_0113.jpg', 'Nature', '2017-07-28 20:20:22', '4780', '3166', 'NIKON D7000', '1/2500', '2.8', '640'),
(552, 'DSC_0141.jpg', 'uploads/Nature/DSC_0141.jpg', 'Nature', '2017-07-28 20:21:59', '4632', '3068', 'NIKON D7000', '1/3200', '2.8', '640'),
(553, 'DSC_0171.jpg', 'uploads/Nature/DSC_0171.jpg', 'Nature', '2017-07-28 20:24:01', '4920', '3259', 'NIKON D7000', '1/800', '2.8', '640'),
(554, 'DSC_0207.jpg', 'uploads/Nature/DSC_0207.jpg', 'Nature', '2017-07-28 20:26:19', '3060', '4620', 'NIKON D7000', '1/2500', '2.8', '640'),
(555, 'DSC_0268.jpg', 'uploads/Nature/DSC_0268.jpg', 'Nature', '2017-07-28 20:29:48', '4928', '2772', 'NIKON D7000', '1/2500', '2.8', '640'),
(556, 'DSC_0294.jpg', 'uploads/Nature/DSC_0294.jpg', 'Nature', '2017-07-28 20:30:32', '4206', '2786', 'NIKON D7000', '1/1600', '2.8', '640'),
(557, 'DSC_0299.jpg', 'uploads/Nature/DSC_0299.jpg', 'Nature', '2017-07-28 20:33:16', '4741', '3140', 'NIKON D7000', '1/1600', '2.8', '640'),
(558, 'DSC_0353-2.jpg', 'uploads/Nature/DSC_0353-2.jpg', 'Nature', '2017-07-28 20:39:08', '4713', '2651', 'NIKON D7000', '1/1000', '5.6', '640'),
(559, 'DSC_0384.jpg', 'uploads/Nature/DSC_0384.jpg', 'Nature', '2017-07-28 20:40:09', '3436', '2276', 'NIKON D7000', '1/2500', '5.6', '640'),
(560, 'DSC_0475.jpg', 'uploads/Nature/DSC_0475.jpg', 'Nature', '2017-07-28 20:42:05', '4796', '2698', 'NIKON D7000', '1/400', '5.6', '640'),
(561, 'DSC_0638.jpg', 'uploads/Nature/DSC_0638.jpg', 'Nature', '2017-07-28 20:53:14', '4708', '3118', 'NIKON D7000', '1/1000', '5.6', '640'),
(562, 'DSC_9374.jpg', 'uploads/Nature/DSC_9374.jpg', 'Nature', '2017-07-28 19:19:48', '3386', '2243', 'NIKON D7000', '1/800', '5.6', '1250'),
(563, 'DSC_9379.jpg', 'uploads/Nature/DSC_9379.jpg', 'Nature', '2017-07-28 19:19:53', '3417', '2263', 'NIKON D7000', '1/800', '5.6', '1250'),
(564, 'DSC_9419.jpg', 'uploads/Nature/DSC_9419.jpg', 'Nature', '2017-07-28 19:20:59', '3665', '2062', 'NIKON D7000', '1/640', '5.6', '1250'),
(565, 'DSC_9429-2.jpg', 'uploads/Nature/DSC_9429-2.jpg', 'Nature', '2017-07-28 19:21:27', '3656', '2422', 'NIKON D7000', '1/640', '5.6', '1250'),
(566, 'DSC_9432.jpg', 'uploads/Nature/DSC_9432.jpg', 'Nature', '2017-07-28 19:21:34', '3639', '2410', 'NIKON D7000', '1/640', '5.6', '1250'),
(567, '_DSC3538.jpg', 'uploads/Nature/_DSC3538.jpg', 'Nature', '2017-07-22 10:18:07', '7026', '4689', 'NIKON D810', '1/5000', '5.6', '500'),
(568, '_DSC3545.jpg', 'uploads/Nature/_DSC3545.jpg', 'Nature', '2017-07-22 10:19:17', '6292', '4199', 'NIKON D810', '1/5000', '5', '500'),
(569, '_DSC3569.jpg', 'uploads/Nature/_DSC3569.jpg', 'Nature', '2017-07-22 10:20:46', '7033', '4694', 'NIKON D810', '1/4000', '5.6', '500'),
(570, '_DSC3578.jpg', 'uploads/Nature/_DSC3578.jpg', 'Nature', '2017-07-22 10:21:20', '7286', '4863', 'NIKON D810', '1/4000', '5.6', '500'),
(571, '_DSC3585.jpg', 'uploads/Nature/_DSC3585.jpg', 'Nature', '2017-07-22 10:21:40', '6513', '4347', 'NIKON D810', '1/4000', '5.6', '500'),
(572, '_DSC3589.jpg', 'uploads/Nature/_DSC3589.jpg', 'Nature', '2017-07-22 10:22:05', '7038', '4697', 'NIKON D810', '1/4000', '5.6', '500'),
(573, '_DSC3594.jpg', 'uploads/Nature/_DSC3594.jpg', 'Nature', '2017-07-22 10:26:16', '7360', '4912', 'NIKON D810', '1/1000', '2.8', '500'),
(574, '_DSC3596.jpg', 'uploads/Nature/_DSC3596.jpg', 'Nature', '2017-07-22 10:26:25', '7360', '4912', 'NIKON D810', '1/1000', '2.8', '500'),
(575, '_DSC3624.jpg', 'uploads/Nature/_DSC3624.jpg', 'Nature', '2017-07-24 08:39:56', '6272', '4186', 'NIKON D810', '1/3200', '5', '320'),
(576, '_DSC3796.jpg', 'uploads/Nature/_DSC3796.jpg', 'Nature', '2017-07-24 08:46:51', '5335', '3001', 'NIKON D810', '1/2000', '5', '320'),
(577, '_DSC3863.jpg', 'uploads/Nature/_DSC3863.jpg', 'Nature', '2017-07-24 08:51:23', '6882', '4593', 'NIKON D810', '1/5000', '2.8', '320'),
(578, '_DSC3978.jpg', 'uploads/Nature/_DSC3978.jpg', 'Nature', '2017-07-24 09:15:02', '6522', '4353', 'NIKON D810', '1/100', '5', '1600'),
(579, '_DSC4012.jpg', 'uploads/Nature/_DSC4012.jpg', 'Nature', '2017-07-24 09:22:04', '7360', '4912', 'NIKON D810', '1/100', '5', '1600'),
(580, '_DSC4061.jpg', 'uploads/Nature/_DSC4061.jpg', 'Nature', '2017-07-24 09:30:24', '7090', '4732', 'NIKON D810', '1/100', '2.8', '2000'),
(581, '_DSC4153.jpg', 'uploads/Nature/_DSC4153.jpg', 'Nature', '2017-07-24 09:46:13', '6587', '4396', 'NIKON D810', '1/160', '4', '2000'),
(582, '_DSC4297.jpg', 'uploads/Nature/_DSC4297.jpg', 'Nature', '2017-07-24 09:57:38', '5040', '3364', 'NIKON D810', '1/125', '4', '2000'),
(583, '_DSC4371.jpg', 'uploads/Nature/_DSC4371.jpg', 'Nature', '2017-07-24 10:13:43', '6918', '4617', 'NIKON D810', '1/100', '5.6', '2000'),
(584, '_DSC4451.jpg', 'uploads/Nature/_DSC4451.jpg', 'Nature', '2017-07-24 10:24:54', '7099', '4738', 'NIKON D810', '1/100', '2.8', '2000'),
(585, '_DSC4720.jpg', 'uploads/Nature/_DSC4720.jpg', 'Nature', '2017-07-24 14:55:27', '6136', '4095', 'NIKON D810', '1/125', '4.5', '2000'),
(586, '_DSC4804.jpg', 'uploads/Nature/_DSC4804.jpg', 'Nature', '2017-07-24 15:08:10', '6181', '4125', 'NIKON D810', '1/160', '5.6', '2000'),
(587, '_DSC4153_1.jpg', 'uploads/Nature/_DSC4153_1.jpg', 'Nature', '2017-07-24 09:46:13', '6587', '4396', 'NIKON D810', '1/160', '4', '2000'),
(588, '_DSC4297_1.jpg', 'uploads/Nature/_DSC4297_1.jpg', 'Nature', '2017-07-24 09:57:38', '5040', '3364', 'NIKON D810', '1/125', '4', '2000'),
(589, '_DSC4371_1.jpg', 'uploads/Nature/_DSC4371_1.jpg', 'Nature', '2017-07-24 10:13:43', '6918', '4617', 'NIKON D810', '1/100', '5.6', '2000'),
(590, '_DSC4451_1.jpg', 'uploads/Nature/_DSC4451_1.jpg', 'Nature', '2017-07-24 10:24:54', '7099', '4738', 'NIKON D810', '1/100', '2.8', '2000'),
(591, '_DSC4720_1.jpg', 'uploads/Nature/_DSC4720_1.jpg', 'Nature', '2017-07-24 14:55:27', '6136', '4095', 'NIKON D810', '1/125', '4.5', '2000'),
(592, '_DSC4804_1.jpg', 'uploads/Nature/_DSC4804_1.jpg', 'Nature', '2017-07-24 15:08:10', '6181', '4125', 'NIKON D810', '1/160', '5.6', '2000'),
(593, '_DSC5028.jpg', 'uploads/Nature/_DSC5028.jpg', 'Nature', '2017-07-24 15:44:54', '7240', '4832', 'NIKON D810', '1/100', '4.5', '2000'),
(594, '_DSC5035.jpg', 'uploads/Nature/_DSC5035.jpg', 'Nature', '2017-07-24 15:45:03', '7360', '4912', 'NIKON D810', '1/100', '4.5', '2000'),
(595, '_DSC5447.jpg', 'uploads/Nature/_DSC5447.jpg', 'Nature', '2017-07-24 16:13:16', '7360', '4912', 'NIKON D810', '1/100', '3.5', '2000'),
(596, '_DSC5473.jpg', 'uploads/Nature/_DSC5473.jpg', 'Nature', '2017-07-24 16:14:25', '7360', '4912', 'NIKON D810', '1/100', '3.5', '2000'),
(597, '_DSC5492.jpg', 'uploads/Nature/_DSC5492.jpg', 'Nature', '2017-07-24 16:15:31', '6724', '4488', 'NIKON D810', '1/400', '2.8', '2000'),
(598, '_DSC5590.jpg', 'uploads/Nature/_DSC5590.jpg', 'Nature', '2017-07-24 16:21:04', '7269', '4851', 'NIKON D810', '1/400', '2.8', '2000'),
(599, '_DSC5591-1.jpg', 'uploads/Nature/_DSC5591-1.jpg', 'Nature', '2017-07-24 10:33:04', '1417', '946', 'Canon EOS 6D', '1/500', '9', '640');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
