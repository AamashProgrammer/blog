-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 12:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_body` longtext NOT NULL,
  `youtube_url` varchar(500) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_body`, `youtube_url`, `blog_image`, `category`, `author_id`, `publish_date`) VALUES
(13, 'Is it OK to eat grapes everyday?', '<p>Recently published studies suggest that grape consumption may have a positive impact on health and lifespan. Adding more grapes to a high fat Western diet could decrease the risk of fatty liver disease and increase longevity.</p>\r\n', '', '97901258_grapes.jpg', 1, 1, '2022-10-29 10:16:32'),
(14, 'Why is rice so important?', '<p>Why is rice so important?</p>\r\n\r\n<p>As a complex carb,&nbsp;<strong>it is the primary source of energy for over half of the world&#39;s people</strong>. Depending on the strain of rice, it can contain decent amounts of fibre, protein, vitamin B, iron and manganese. This means it can play a vital role against malnutrition.</p>\r\n', '', '36555574_rice.jpg', 2, 1, '2022-10-29 10:16:17'),
(15, 'Which is the best time to eat apple?', '<p>Which is the best time to eat apple?</p>\r\n\r\n<p>the morning hours</p>\r\n\r\n<p>As per studies, you should eat an apple&nbsp;<strong>in the morning hours</strong>. This is because apples are rich in dietary fiber, pectin, which is found in its peel. Since most people have digestive issues due to improper sleep or late eating habits, apples right in the morning, after waking up is a good idea.</p>\r\n', '', '31565462_apple.jpg', 1, 1, '2022-10-29 10:15:51'),
(16, 'What is the price for a Lamborghini?', '<p>What is the price for a Lamborghini?</p>\r\n\r\n<p>The price of Lamborghini cars in India&nbsp;<strong>starts from 3.15 Cr for the Urus</strong>&nbsp;while the most expensive Lamborghini car in India one is the Aventador with a price of 9.00 Cr. The newest model in the Lamborghini line-up is the Huracan EVO with a price tag of 3.21 - 4.99 Cr</p>\r\n', '', '80350591_lamborghini.jpg', 3, 1, '2022-10-29 10:17:30'),
(17, 'How much are Royce Rolls?', '<p>How much are Royce Rolls?</p>\r\n\r\n<p>The least-expensive 2022 Rolls-Royce Phantom is the 2022 Rolls-Royce Phantom 4dr Sedan (6.7L 12cyl Turbo 8A). Including destination charge, it arrives with a Manufacturer&#39;s Suggested Retail Price (MSRP) of&nbsp;<strong>about $465,000</strong>. Other versions include: 4dr Sedan (6.7L 12cyl Turbo 8A) which starts at $465,000</p>\r\n', '', '82070740_rolls_royce.jpg', 3, 1, '2022-10-29 10:18:27'),
(18, 'How important is a good chair?', '<p>How important is a good chair?</p>\r\n\r\n<p>Sitting in the wrong office chair can cause major health issues for you. Simply avoid this by investing in an ergonomic chair.&nbsp;<strong>A good office chair can bear wonders for your back</strong>. It works by improving your posture, reducing unnecessary back pains, and reducing hip pressure</p>\r\n', '', '69425992_chair.jpg', 4, 1, '2022-10-29 10:19:48'),
(19, 'Which Colour is best for gaming room?', '<p>Which Colour is best for gaming room?</p>\r\n\r\n<p><strong>Gray</strong>. When it comes to color psychology, gray is the best paint color for a gaming room because it&#39;s an elegant, neutral, and balanced color.</p>\r\n', '', '30589730_gaming_room.jpg', 5, 1, '2022-10-29 10:20:39'),
(20, 'What does console mean in business?', '<p>What does console mean in business?</p>\r\n\r\n<p><strong>A terminal or workstation used to monitor and control a network either locally or remotely</strong>. The term often refers only to management software that resides in any Windows, Mac or Linux client machine. See Microsoft Management Console.</p>\r\n', '', '78792543_console.jpg', 5, 2, '2022-10-29 10:21:45'),
(21, 'What is a table and graph?', '<p>What is a table and graph?</p>\r\n\r\n<p>What are tables and graphs? Tables and graphs are&nbsp;<strong>visual representations</strong>. They are used to organise information to show patterns and relationships. A graph shows this information by representing it as a shape. Researchers and scientists often use tables and graphs to report findings from their research.</p>\r\n', '', '68430755_table.jpg', 4, 2, '2022-10-29 10:22:24'),
(22, 'What is the best-selling Toyota in 2022?', '<p>What is the best-selling Toyota in 2022?</p>\r\n\r\n<p>Although SUVs have largely taken over this list, the&nbsp;<strong>Toyota Camry</strong>&nbsp;remains the bestselling vehicle that&#39;s neither an SUV nor a pickup truck. The Camry dropped by 17 percent but still beat out many SUVs and eclipsed the next best passenger car, the Corolla, by a significant margin</p>\r\n', '', '73331122_toyota.jpg', 3, 2, '2022-10-29 10:23:12'),
(23, 'Does Mango have good quality?', '<p>Does Mango have good quality?</p>\r\n\r\n<p>From chic trousers to structured blazers to jewelry that could be mistaken for designer, Mango is the retailer that keeps on giving.&nbsp;<strong>The prices are a bit higher than most other high-street retailers, but so is the quality</strong>. It&#39;s 100% worth spending a bit more to have pieces with better materials and polished tailoring.</p>\r\n', '', '41148474_mago.jpg', 1, 2, '2022-10-29 10:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'fruits'),
(2, 'grocery'),
(3, 'cars'),
(4, 'furniture'),
(5, 'gaming');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'test', 'test@test.test', '6a2b3fa376eaaefa628ba0e36b601bb1adab5658', 1),
(2, 'sohaib', 'sohaib@email.com', '7cfbd5ffe8387b92342e5877d522a9d3f46a13da', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
