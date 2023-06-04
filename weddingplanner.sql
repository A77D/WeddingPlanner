-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 07:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weddingplanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '111');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(100) NOT NULL,
  `start_time` int(2) NOT NULL,
  `end_time` int(2) NOT NULL,
  `offers_id` int(100) NOT NULL,
  `day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`) VALUES
(1, 20, 'hello'),
(2, 20, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `providers_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `details`, `price`, `category`, `image_01`, `image_02`, `image_03`, `providers_id`) VALUES
(9, 'Fruit Cake', 'Delicious Fruit Cake for you wedding.', 600, 'cake', '72edbb3406035819dc8413fb7f0a21db.jpg', 'c9eaa19d6f1af248d6c8c5382e393ad4.jpg', '53e569f245dfbb9a914d8eb790d575e8.jpg', 1),
(12, 'engagement dress', 'Nice wedding dress', 300, 'dress', 'main-qimg-4a061c6328a0888f004fb038e509e3ad-lq.jpeg', 'ca3.PNG', 'service-9.JPG', 2),
(13, 'Makeup collection', 'The perfect collection for all events', 100, 'makeup', 'featureimage-organizemakeup.webp', 'Cap4.PNG', 'ca3.PNG', 2),
(14, 'qiu', 'iojiojio', 80, 'hall', 'ca12.PNG', 'ca11.PNG', 'Ca7.PNG', 2),
(15, 'BMW', 'ad', 300, 'cake', 'o.PNG', 'Ca9.PNG', 'ca10.PNG', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `user_id` int(100) NOT NULL,
  `method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_products`, `total_price`, `placed_on`, `payment_status`, `user_id`, `method`) VALUES
(1, 'Fruit Cake (600 x 7) - oo (78 x 6) - ', 4668, '2023-01-12', 'completed', 14, NULL),
(2, 'oo (78 x 43) - Fruit Cake (600 x 1) - ', 3954, '2023-01-12', 'completed', 2, 'cash on delivery'),
(3, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'completed', 2, 'cash on delivery'),
(4, 'Fruit Cake (600 x 1) - oo (78 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(5, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(6, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(7, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(8, 'Fruit Cake (600 x 1) - ', 600, '2023-01-14', 'pending', 2, 'cash on delivery'),
(9, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(10, 'Fruit Cake (600 x 1) - ', 600, '2023-01-14', 'pending', 2, 'cash on delivery'),
(33, 'Fruit Cake (600 x 1) - ', 600, '2023-01-14', 'pending', 2, 'cash on delivery'),
(34, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(35, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(36, 'oo (78 x 1) - ', 78, '2023-01-14', 'pending', 2, 'cash on delivery'),
(37, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(38, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(39, 'oo (78 x 1) - Fruit Cake (600 x 2) - ', 1278, '2023-01-14', 'pending', 2, 'cash on delivery'),
(40, 'Fruit Cake (600 x 1) - oo (78 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(41, 'oo (78 x 1) - Fruit Cake (600 x 1) - ', 678, '2023-01-14', 'pending', 2, 'cash on delivery'),
(42, 'Fruit Cake (600 x 5) - oo (78 x 1) - ', 3078, '2023-01-16', 'pending', 2, 'cash on delivery'),
(43, 'oo (78 x 1) - ', 78, '2023-01-16', 'pending', 2, 'cash on delivery'),
(44, 'Makeup collection (100 x 1) - engagement dress (300 x 1) - Fruit Cake (600 x 1) - qiu (80 x ) - ', 1000, '2023-01-17', 'pending', 2, 'cash on delivery'),
(45, 'qiu (80 -> 1-3-', 160, '2023-01-19', 'pending', 2, 'cash on delivery'),
(46, 'qiu (80 -> 2-3-', 80, '2023-01-19', 'pending', 2, 'cash on delivery'),
(47, 'qiu (80 x 0) - Fruit Cake (600 x 1) - Makeup collection (100 x 1) - ', 700, '2023-01-20', 'pending', 2, 'cash on delivery'),
(48, 'qiu (80 -> 1-3)', 160, '2023-01-20', 'pending', 2, 'cash on delivery'),
(49, 'Fruit Cake (600 x 1) - qiu (80 -> 1-10[2023-01-20])', 1320, '2023-01-20', 'pending', 1, 'cash on delivery'),
(50, 'Makeup collection (100 x 1) - engagement dress (300 x 1) - ', 400, '2023-01-20', 'pending', 1, 'cash on delivery'),
(51, 'Makeup collection (100 x 1[2023-01-20])engagement dress (300 x 1)', 400, '2023-01-20', 'pending', 1, 'cash on delivery'),
(52, 'Makeup collection (100 x 2)qiu (80 -> 3-5[2023-01-27])', 360, '2023-01-21', 'pending', 18, 'cash on delivery'),
(53, 'Makeup collection (100 x 2)', 200, '2023-01-21', 'pending', 19, 'cash on delivery'),
(54, 'qiu (80 -> 1-1[2023-01-21])Makeup collection (100 x 1)', 100, '2023-01-21', 'pending', 20, 'cash on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `offer_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `day` date DEFAULT NULL,
  `start_time` int(2) DEFAULT NULL,
  `end_time` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `user_id`, `offer_id`, `name`, `price`, `quantity`, `image`, `day`, `start_time`, `end_time`) VALUES
(101, 15, 13, 'Makeup collection', 100, 1, 'featureimage-organizemakeup.webp', '0000-00-00', NULL, NULL),
(102, 15, 12, 'engagement dress', 300, 1, 'main-qimg-4a061c6328a0888f004fb038e509e3ad-lq.jpeg', '0000-00-00', NULL, NULL),
(103, 16, 13, 'Makeup collection', 100, 1, 'featureimage-organizemakeup.webp', '0000-00-00', NULL, NULL),
(104, 16, 14, 'qiu', 80, NULL, 'ca12.PNG', '2023-01-26', 21, 22),
(108, 2, 14, 'qiu', 80, NULL, 'ca12.PNG', '2023-01-20', 1, 4),
(119, 1, 12, 'engagement dress', 300, 1, 'main-qimg-4a061c6328a0888f004fb038e509e3ad-lq.jpeg', NULL, NULL, NULL),
(120, 1, 13, 'Makeup collection', 100, 1, 'featureimage-organizemakeup.webp', '2023-01-20', NULL, NULL),
(121, 17, 13, 'Makeup collection', 100, 3, 'featureimage-organizemakeup.webp', NULL, NULL, NULL),
(122, 17, 14, 'qiu', 80, NULL, 'ca12.PNG', '2023-01-25', 0, 3),
(128, 21, 14, 'qiu', 80, NULL, 'ca12.PNG', '2023-01-30', 5, 6),
(129, 21, 13, 'Makeup collection', 100, 3, 'featureimage-organizemakeup.webp', NULL, NULL, NULL),
(130, 21, 12, 'engagement dress', 300, 3, 'main-qimg-4a061c6328a0888f004fb038e509e3ad-lq.jpeg', '2023-01-31', NULL, NULL),
(131, 20, 15, 'BMW', 300, 1, 'o.PNG', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `bio` varchar(250) NOT NULL,
  `image_1` varchar(100) DEFAULT NULL,
  `image_2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name`, `email`, `password`, `phone`, `city`, `street`, `bio`, `image_1`, `image_2`) VALUES
(1, 'Bashar Odwan', 'basharadmin@gmail.com', 'Bashar123', '0592155134', 'Tulkarmm', 'Farounn', 'wedding dresses ..', NULL, NULL),
(2, 'BasharOdwan', 'basharodwan@gmail.com', 'bashar123', '0567155139', 'Tulkarmm', 'Faroun', 'cakefactory', NULL, NULL),
(3, 'BasharOdwan', 'bashar0odwan@gmail.c', 'bashar123', '0567155139', 'Tulkarm', 'Faroun', 'asdjias', NULL, NULL),
(4, 'BasharOdwan', 'basharodqwewe@sa.co', 'bashar123', '22', 's', 'x', 'sps', NULL, NULL),
(5, 'BasharKhaledOdwan', 'bashar_od@gmail.com', 'bashar123', '0597121212', 'Tulkar', 'Farou', 'asdjiasdjiasdjijioji', NULL, NULL),
(6, 'BasharOdwann', 'basharodwan@gmail.co', 'bashar123', '05671551399', 'Tulkarmm', 'Farounn', 'nnnnnn', NULL, NULL),
(7, 'BasharOdwan', 'basharodwan@gmail.com', 'bashar123', '0567155139', 'Tulkarm', 'Faroun', 'baad', NULL, NULL),
(8, 'BAsha', 'yu@sa.com', '123789BFa', '13781789123789', 'قطاع غزة', '132', 'qwe0u9qwe08', NULL, NULL),
(9, 'Majd Cars', 'majd@gmail.com', 'rawanS1234', '059999999', 'Nablus', 'Main street', 'jid', NULL, NULL),
(10, 'a7mad', 'a7mad@gmail.com', '@Hmad123', '0597320456', 'Tulkarm', 'kur', 'cake', NULL, NULL),
(11, 'Majd', 'amad@gmail.com', 'Majd1234', '0599999999', 'Nablue', 'Nablus', 'imhmiy', NULL, NULL),
(12, 'Israa Zedan', 'israa@gmail.com', 'Israa123', '05999999', 'Tulkarm', 'Ramin', 'oSDOPKIK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `admin_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `city`, `street`, `admin_id`) VALUES
(1, 'Bashar', 'bashar0odwan@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0567155139', 'Bashar', 'Bashar', NULL),
(2, 'Bashar Odwan', 'bashar_odwan@gmail.com', 'bashar123', '0567155139', 'Tulkarm', 'Faroun', 2),
(6, 'Bashar', 'bashar1odwan@gmail.com', 'bas', '0567155139', 'Tulkarm', 'Faroun', NULL),
(7, 'Bashar', 'bashar01odwan@gmail.com', 'Bashar123', '0567155139', 'Tulkarm', 'Faroun', NULL),
(8, 'Bashar', 'bashar02odwan@gmail.com', 'Basharr123', '0567155139', 'Tulkarm', 'Faroun', NULL),
(9, 'Bashar Khaled', 'basharkhaled@gmail.com', 'Bashar123', '0567155139', '1', 'Faroun', NULL),
(10, 'Bashar Odwan', 'basharkaled@gmail.com', 'basharBashar12', '0567155139', '12', 'aqwqwe', NULL),
(11, 'Bashar', 'basharad99@gmail.com', 'bashar11212B', '0567155139', '11', 'Faroun', NULL),
(12, 'BAsha', 'yu@sa.com', '123789BFa', '13781789123789', 'قطاع غزة', '132', 8),
(13, 'Basharr', 'basharn@gmail.com', 'BBashar123', '05671551391', '', 'qwqw', NULL),
(14, 'asd', 'bas@gmail.com', '089089KK1qw', '9089089', 'asdpko', 'ognixf', NULL),
(15, 'Bashara', 'bashpppodwan@gmail.com', 'bashar123pPD99', '056715513', 'ooo', 'ppp', NULL),
(16, 'Rawan Suliman', 'rawan_suliman@gmail.com', 'rawan123Q123', '0591111111', 'Tulkarm', 'lpoloas', NULL),
(17, 'Rawan Suliman', 'rawansuliman@gmail.com', 'rawanS1234', '059999999', 'Tulkarm', 'Main street', 9),
(18, 'Rawan Suliman', 'basha222doak@ji.com', 'bashar123W2ww', '059999999', 'ji', 'ui', NULL),
(19, 'Rawan su;iman', 'rawan@gmail.com', 'Rawan123U', '059999999', 'Tulkarm', 'Balaa', NULL),
(20, 'a7mad1', 'a7mad@gmail.com1', 'Ahmad123', '05973204561', 'Tulkarm1', 'kur1', 10),
(21, 'Majd', 'amad@gmail.com', 'Majd1234', '0599999999', 'Nablue', 'Nablus', 11),
(22, 'Israa Zedan', 'israa@gmail.com', 'Israa123', '05999999', 'Tulkarm', 'Ramin', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_id` (`offers_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_id` (`providers_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`offer_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`providers_id`) REFERENCES `providers` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `plan_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `providers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
