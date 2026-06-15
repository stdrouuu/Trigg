-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2026 at 04:13 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20222_wp2_412024022`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$kP0Nw708ZcMdoxiNk.1VjO.SZnbZOAETC4D2Gwpd.aRd.UpPnHq6G');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `session_id` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `qty`, `session_id`, `created_at`) VALUES
(64, 4, 1, 'ran9f8hss6kvle3isi4pd1405r', '2026-06-08 07:33:19'),
(65, 3, 1, 'lsifocvjgpk18go5kkga890vtv', '2026-06-11 16:50:18'),
(66, 4, 1, 'lsifocvjgpk18go5kkga890vtv', '2026-06-11 16:50:20'),
(67, 5, 1, 'lsifocvjgpk18go5kkga890vtv', '2026-06-11 16:50:24'),
(72, 28, 1, 'kh7r0djbgjv7vo153qnldq0bcg', '2026-06-12 17:22:14'),
(83, 3, 1, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 06:23:23'),
(84, 7, 1, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 06:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `order_id` int DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','in_review','resolved') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `session_id`, `order_id`, `category`, `message`, `status`, `created_at`, `updated_at`) VALUES
(3, 'gu0e8jhqqc6jmd27qlpc1l14jr', 8, 'Masalah Pembayaran', 'Pembayaran saya sudah berhasil tapi layar web saya ngestuck. tolong apakah barangnya bisa diantar ya?', 'resolved', '2026-06-13 10:53:41', '2026-06-13 10:54:51'),
(4, 'gu0e8jhqqc6jmd27qlpc1l14jr', NULL, 'Lainnya', 'websitenya kadang suka ngeblack screen tiba-tiba', 'resolved', '2026-06-13 11:10:31', '2026-06-13 15:20:37'),
(5, 'gu0e8jhqqc6jmd27qlpc1l14jr', NULL, 'Lainnya', 'Saya mau logout tapi ngga bisa', 'open', '2026-06-13 11:24:35', '2026-06-13 11:24:35'),
(6, 'gu0e8jhqqc6jmd27qlpc1l14jr', 7, 'Permintaan Refund', 'Kak, sori bange tadi adek saya gak sengaja kepencet beli game pakai HP saya, posisinya beli pake e-wallet OVO, padahal gamenya nggak mau beli. Bisa minta tolong di-refund gak ya uangnya?', 'open', '2026-06-13 15:06:51', '2026-06-13 15:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `product_id`, `session_id`, `created_at`) VALUES
(18, 2, 'kh7r0djbgjv7vo153qnldq0bcg', '2026-06-12 18:04:19'),
(30, 11, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 03:51:37'),
(32, 3, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 06:00:00'),
(33, 15, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 06:00:09'),
(34, 6, 'gu0e8jhqqc6jmd27qlpc1l14jr', '2026-06-13 06:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `total_price` int NOT NULL DEFAULT '0',
  `status` enum('pending','processing','shipped','delivered') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `order_notes` text,
  `first_name` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `total_price`, `status`, `created_at`, `updated_at`, `email`, `order_notes`, `first_name`, `address`, `phone`) VALUES
(7, 'gu0e8jhqqc6jmd27qlpc1l14jr', 1612300, 'processing', '2026-06-13 03:55:22', '2026-06-13 11:13:12', 'brando92@gmail.com', 'minta bubblewrap lebih.', 'Brandon', 'Jl. Kebayoran Baru No.12 RT.1/RW.2, Kramat Pela,', '082111111111'),
(8, 'gu0e8jhqqc6jmd27qlpc1l14jr', 366600, 'shipped', '2026-06-13 04:00:51', '2026-06-13 14:40:58', 'brando92@gmail.com', 'req tambah bonus wkkw', 'Brandon', 'Jl. Kebayoran Baru No.12 RT.1/RW.2, Kramat Pela,', '08111111111111'),
(9, 'gu0e8jhqqc6jmd27qlpc1l14jr', 672300, 'pending', '2026-06-13 04:34:57', '2026-06-13 14:41:05', 'brando92@gmail.com', '-', 'Brandon', 'Jl. Kebayoran Baru No.12 RT.1/RW.2, Kramat Pela,', '08111111111111'),
(10, 'gu0e8jhqqc6jmd27qlpc1l14jr', 8199000, 'delivered', '2026-06-13 04:37:39', '2026-06-13 11:14:10', 'brando92@gmail.com', '-', 'Brandon', 'Jl. Kebayoran Baru No.12 RT.1/RW.2, Kramat Pela,', '08111111111111');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price_at_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_image`, `qty`, `price_at_order`) VALUES
(19, 7, 3, 'Kirby: Air Riders', 'assets/img/kirby.jpg', 1, 950000),
(20, 7, 28, 'PS4 Tekken 7 Standard Edition  (R3/English) ', 'assets/img/1780901134_tekken7.jpg', 1, 599000),
(21, 7, 25, 'Steam Wallet Gift Card (IDR 60.000)', 'assets/img/steam.jpg', 1, 63300),
(22, 8, 25, 'Steam Wallet Gift Card (IDR 60.000)', 'assets/img/steam.jpg', 1, 63300),
(23, 8, 26, 'PlayStation Network Card IDR 300.000', 'assets/img/psstore.jpg', 1, 303300),
(24, 9, 25, 'Steam Wallet Gift Card (IDR 60.000)', 'assets/img/steam.jpg', 1, 63300),
(25, 9, 23, 'Nintendo Eshop Card USD $35', 'assets/img/princess.jpg', 1, 609000),
(26, 10, 16, 'PlayStation 5 Digital Edition Slim', 'assets/img/ps5.jpg', 1, 8199000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `label` enum('PLAYSTATION','SWITCH 2','OTHER') NOT NULL DEFAULT 'OTHER',
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `label`, `description`, `created_at`) VALUES
(1, 'NBA 2K26', 815000, 'assets/img/nba.jpg', 'PLAYSTATION', 'Command every court with authenticity and realism Powered by ProPLAY, giving you ultimate control over how you play in NBA 2K25.', '2026-06-08 05:25:36'),
(2, 'SpongeBob: Titans ', 479000, 'assets/img/spongebob.jpg', 'SWITCH 2', 'Seamlessly switch between SpongeBob and Patrick and combine their unique skills to save Bikini Bottom from total ghostification.', '2026-06-08 05:25:36'),
(3, 'Kirby: Air Riders', 950000, 'assets/img/kirby.jpg', 'SWITCH 2', 'Ready, set, battle! Charge, boost, and spin to attack your rivals in Kirby Air Riders, a fast-paced vehicle action featuring Kirby and crew.', '2026-06-08 05:25:36'),
(4, 'Call of Duty: Black Ops 7', 999000, 'assets/img/codbo7.jpg', 'PLAYSTATION', 'In Call of Duty Black Ops 7, Treyarch and Raven Software are bringing players the biggest Black Ops ever.', '2026-06-08 05:25:36'),
(5, 'Ninja Gaiden 4', 1045000, 'assets/img/ninja.jpg', 'PLAYSTATION', 'The definitive ninja action-adventure franchise returns with NINJA GAIDEN 4!', '2026-06-08 05:25:36'),
(6, 'Ghost Of Yotei', 1029000, 'assets/img/yotei.jpg', 'PLAYSTATION', 'Taking place 300 years after Ghost of Tsushima, this standalone experience follows a haunted, lone mercenary named Atsu.', '2026-06-08 05:25:36'),
(7, 'The Last of Us Part I', 700000, 'assets/img/tlou1.png', 'PLAYSTATION', 'Discover the award-winning game that inspired the critically acclaimed television show.', '2026-06-08 05:25:36'),
(8, 'God of War Ragnarok', 703200, 'assets/img/gow.png', 'PLAYSTATION', 'Kratos and Atreus embark on a mythic journey for answers before Ragnarok arrives.', '2026-06-08 05:25:36'),
(9, 'Red Dead Redemption 2', 3000, 'assets/img/rdr2.png', 'PLAYSTATION', 'Arthur Morgan and the Van der Linde Gang are outlaws on the run.', '2026-06-08 05:25:36'),
(10, 'The Last of Us Part II', 850000, 'assets/img/tlou2.png', 'PLAYSTATION', 'Experience the winner of over 300 Game of the Year awards, now on Playstation.', '2026-06-08 05:25:36'),
(11, 'Spiderman: Miles Morales', 350000, 'assets/img/spidermanmiles.png', 'PLAYSTATION', 'After the events of Spider-Man Remastered, teenage Miles Morales is adjusting to his new home.', '2026-06-08 05:25:36'),
(12, 'Lynked: Banner of the Spark', 119999, 'assets/img/lynked.jpg', 'SWITCH 2', 'Build your squad, choose abilities, and fight through a fractured kingdom in this tactical adventure.', '2026-06-08 05:25:36'),
(13, 'Jurassic World: Evolution 2', 749000, 'assets/img/jurrasic.jpg', 'PLAYSTATION', 'Create and manage your own dinosaur park with new systems, smarter creatures, and more customization.', '2026-06-08 05:25:36'),
(14, 'EA Sports FC 26', 350000, 'assets/img/fc26.jpg', 'SWITCH 2', 'The Club is Yours in EA SPORTS FC 26. Play your way with an overhauled gameplay experience.', '2026-06-08 05:25:36'),
(15, 'Motogp 25', 350000, 'assets/img/motogp.jpg', 'SWITCH 2', 'Race through official tracks with realistic bike handling and a full career mode.', '2026-06-08 05:25:36'),
(16, 'PlayStation 5 Digital Edition Slim', 8199000, 'assets/img/ps5.jpg', 'PLAYSTATION', 'The PS5 Slim offers fast loading, sharp visuals, and a compact build with a 1TB SSD.', '2026-06-08 05:25:36'),
(17, 'Nintendo Switch 2 Console - 512GB', 8099000, 'assets/img/switch2.jpg', 'SWITCH 2', 'A new generation of hybrid gaming with better performance, improved display, and smooth portability.', '2026-06-08 05:25:36'),
(18, 'Nintendo Switch JoyCon - Green/Pink', 350000, 'assets/img/switch2joycon.jpg', 'SWITCH 2', 'A stylish JoyCon pair with responsive controls, motion support, and HD Rumble.', '2026-06-08 05:25:36'),
(19, 'DualSense Wireless Controller - Starlight Blue', 1499000, 'assets/img/dualsense.jpg', 'PLAYSTATION', 'A PS5 controller with haptic feedback, adaptive triggers, and a clean Starlight Blue finish.', '2026-06-08 05:25:36'),
(20, 'Miyoo Mini Plus Retro Game Portable', 875000, 'assets/img/miyoo.jpg', 'OTHER', 'Miyoo Mini Plus Retro Game Console, Portable Handheld Open Source Game Console.', '2026-06-08 05:25:36'),
(21, 'KontrolFreek Performance Grips - Inferno Red', 240000, 'assets/img/grips.jpg', 'PLAYSTATION', 'Anti-slip grips designed to improve comfort and control during intense gameplay.', '2026-06-08 05:25:36'),
(22, 'Nintendo Eshop Card USD $20', 609000, 'assets/img/mario.jpg', 'SWITCH 2', 'Add $20 credit to your Nintendo account for games, DLC, and digital content.', '2026-06-08 05:25:36'),
(23, 'Nintendo Eshop Card USD $35', 609000, 'assets/img/princess.jpg', 'SWITCH 2', 'Top up your Nintendo account with a $35 card for easy digital purchases.', '2026-06-08 05:25:36'),
(24, 'Nintendo Eshop Card USD $50', 844000, 'assets/img/bowser.jpg', 'SWITCH 2', 'Redeem $50 of eShop credit to buy games, add-ons, and other Nintendo content.', '2026-06-08 05:25:36'),
(25, 'Steam Wallet Gift Card (IDR 60.000)', 63300, 'assets/img/steam.jpg', 'OTHER', 'Add funds to your Steam account for games, items, and marketplace purchases.', '2026-06-08 05:25:36'),
(26, 'PlayStation Network Card IDR 300.000', 303300, 'assets/img/psstore.jpg', 'PLAYSTATION', 'Redeem IDR 200.000 credit for PSN games, DLC, subscriptions, and more.', '2026-06-08 05:25:36'),
(28, 'PS4 Tekken 7 Standard Edition  (R3/English) ', 599000, 'assets/img/1780901134_tekken7.jpg', 'PLAYSTATION', 'One of the most successful fighting games in the world, Tekken 7 combines the adrenaline of the arcade with the precision of a fighting simulator.', '2026-06-08 06:45:34'),
(29, 'PS5 Tekken 8  Standard Edition (R3/English)', 570000, 'assets/img/1780902185_tekken8.jpg', 'PLAYSTATION', 'TEKKEN 8 continues the tragic saga of the Mishima and Kazama bloodlines and their world-shaking father-and-son grudge matches\r\nExciting new gameplay focused on “Aggressive Tactics”\r\nFeatures a wide variety of customizations to playable characters, avatars, HUD elements, and music\r\nIn the new single-player mode ‘Arcade Quest’, players can create their own avatar and conquer their rivals', '2026-06-08 07:03:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
