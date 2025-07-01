-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2025 at 04:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Aldenaire_Kitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `email`, `message`, `sent_at`) VALUES
(1, 'mina.nessim2012@gmail.com', 'where is your location?', '2025-06-21 02:02:09'),
(2, 'mina.nessim2012@gmail.com', 'where is your location?', '2025-06-21 02:04:07'),
(3, 'mina.nessim2012@gmail.com', 'where is your location?', '2025-06-21 02:04:17'),
(4, 'mina.nessim2012@gmail.com', 'where is your location?', '2025-06-21 02:07:16'),
(5, 'mina.nessim2012@gmail.com', 'Do you have Egyptian food in your menu?', '2025-06-21 02:11:05'),
(6, 'mina.nessim2012@gmail.com', 'Do you have Egyptian food in your menu?', '2025-06-21 02:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `category_id`, `item_name`, `description`, `price`, `image_path`, `is_popular`, `created_at`) VALUES
(1, NULL, 'Grilled Meat Steak', 'Delicious grilled steak with herbs.', 45.00, '14.png', 1, '2025-06-07 04:23:02'),
(2, NULL, 'Plate Grilled Chicken', 'Tender grilled chicken with sides.', 50.00, 'plate-grilled-chicken-vegetables-isolated-260nw-767067433-removebg-preview.png', 1, '2025-06-07 04:23:02'),
(3, NULL, 'Grilled Chicken with Salad', 'Healthy grilled chicken served with fresh salad.', 40.00, 'istockphoto-1056419208-612x612.jpg', 1, '2025-06-07 04:23:02'),
(4, NULL, 'Fried Meat and Rice', 'Traditional fried meat with rice.', 50.00, '11.top-view-plate-rice-fried-meat-top-view-plate-rice-fried-meat-white-background-302886539-removebg-preview.png', 1, '2025-06-07 04:23:02'),
(5, NULL, 'Grilled Salmon', 'Delicious grilled salmon.', 55.00, 'images__1_-removebg-preview.png', 0, '2025-06-09 22:09:10'),
(6, NULL, 'Vegetable Pasta', 'Fresh pasta with vegetables.', 35.00, 'pngtree-deliciously-vibrant-pasta-dish-with-vegetables-png-image_15824694-removebg-preview.png', 0, '2025-06-09 22:09:10'),
(7, NULL, 'Gourmet Beef Burger', 'Juicy beef burger with fries.', 30.00, 'hd-sapid-chicken-burger-with-french-fries-on-wood-plate-png-701751710858563bp8ufljnki-removebg-preview.png', 0, '2025-06-09 22:09:10'),
(8, NULL, 'Fresh Fruit Salad', 'Healthy mix of fresh fruits.', 25.00, 'istockphoto-1056419208-612x612.jpg', 0, '2025-06-09 22:09:10'),
(9, NULL, 'Shrimp Plate', 'Shrimp Plate ', 50.00, 'sherimp.png', 1, '2025-06-22 07:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `delivery_address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `delivery_address`, `payment_method`) VALUES
(31, 1, '2025-06-22 03:22:23', 50.00, 'pending', 'gxftjugfj', 'cash'),
(32, 1, '2025-06-22 03:22:52', 50.00, 'pending', '3030 Driftwood dr', 'credit'),
(37, NULL, '2025-06-22 04:46:28', 100.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(38, 1, '2025-06-22 05:04:44', 90.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(39, 1, '2025-06-22 05:06:43', 40.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(40, 1, '2025-06-22 05:10:31', 40.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(41, 1, '2025-06-22 05:12:36', 40.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(42, 1, '2025-06-22 05:13:29', 50.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(43, 1, '2025-06-22 05:15:02', 40.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(44, 1, '2025-06-22 05:15:16', 40.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(45, 1, '2025-06-22 05:18:00', 50.00, 'pending', '24-3030 Driftwoord dr', 'cash'),
(46, 1, '2025-06-22 07:22:47', 140.00, 'pending', '24-3030 Driftwoord dr', 'credit');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `item_id`, `quantity`, `unit_price`) VALUES
(1, 31, 2, 1, 50.00),
(2, 32, 2, 1, 50.00),
(3, 37, 4, 1, 50.00),
(4, 37, 2, 1, 50.00),
(5, 38, 2, 1, 50.00),
(6, 38, 3, 1, 40.00),
(7, 39, 3, 1, 40.00),
(8, 40, 3, 1, 40.00),
(9, 41, 3, 1, 40.00),
(10, 42, 2, 1, 50.00),
(11, 43, 3, 1, 40.00),
(12, 44, 3, 1, 40.00),
(13, 45, 2, 1, 50.00),
(14, 46, 3, 1, 40.00),
(15, 46, 4, 1, 50.00),
(16, 46, 9, 1, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `expiry_date` varchar(10) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `order_id`, `card_number`, `card_name`, `expiry_date`, `cvv`, `created_at`) VALUES
(1, 46, '34465454654654', 'Mina', '05/28', '257', '2025-06-22 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `item_id`, `rating`, `comment`, `review_date`, `name`) VALUES
(9, 1, 1, 5, 'Grilled Meat Steak was juicy and perfectly cooked!', '2025-06-22 07:51:34', NULL),
(10, 1, 2, 4, 'Fried Chicken was crispy but a bit salty.', '2025-06-22 07:51:34', NULL),
(11, 1, 3, 5, 'Delicious Burger, loved the sauce!', '2025-06-22 07:51:34', NULL),
(12, 1, 4, 3, 'Pizza was okay, but the crust was too thick.', '2025-06-22 07:51:34', NULL),
(13, 1, 5, 4, 'Pasta had great flavor, but portion was small.', '2025-06-22 07:51:34', NULL),
(14, 1, 6, 5, 'Salmon Fillet was fresh and tasty!', '2025-06-22 07:51:34', NULL),
(15, 1, 7, 4, 'Chicken Wings were spicy and flavorful!', '2025-06-22 07:51:34', NULL),
(16, 1, 8, 5, 'The Kebab Platter was amazing! Would eat again.', '2025-06-22 07:51:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone`, `address`, `created_at`) VALUES
(1, 'mina', 'mina@example.com', '123456', '0123456789', 'test address', '2025-06-22 03:20:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
