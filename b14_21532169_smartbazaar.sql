-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2018 at 11:13 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b14_21532169_smartbazaar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL COMMENT '1st acc pass: 123456'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Nilesh Sanyal', 'test@gmail.com', '$2y$10$uoVYTjN6Jpp/ekX3A3.YrOhLXbpPFXdzkOrTmB5DcD64zBYiaiFDG'),
(2, 'Ramesh Jain', 'raj@yahoo.com', '$2y$10$u9AG06iSC15qiaZ7QV8TVeBrzAlcHnFa66B206EIlCHGJlMRjAE4e');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(256) NOT NULL,
  `status` enum('y','n') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `status`) VALUES
(1, 'Water and Beverages', 'y'),
(2, 'Fruits and Vegetables', 'y'),
(3, 'Snacks', 'y'),
(4, 'Spices', 'y'),
(5, 'Dry Fruit', 'n'),
(6, 'Sweets', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `subtotal_amount` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `product_name`, `quantity`, `product_price`, `subtotal_amount`, `total_amount`, `user_id`, `user_name`, `order_date`) VALUES
(6, '10,7,20,8', 'JK Jeera,Orange Juice,Kelloggs Corn Flakes,Oven Cookies', '2,1,1,2', '40,70,200,45', '80.00,70.00,200.00,90.00', '440.00', 2, 'kartik', '2018-04-29 08:58:03'),
(7, '10,7,20,8', 'JK Jeera,Orange Juice,Kelloggs Corn Flakes,Oven Cookies', '2,1,1,2', '40,70,200,45', '80.00,70.00,200.00,90.00', '440.00', 2, 'kartik', '2018-04-29 08:58:03'),
(8, '9', 'Chocolate Pizza', '2', '999', '1,998.00', '1,998.00', 2, 'kartik', '2018-04-29 09:11:29'),
(9, '9', 'Chocolate Pizza', '2', '999', '1,998.00', '1,998.00', 2, 'kartik', '2018-04-29 09:11:30'),
(10, '17,10', 'Aquafina Packaged Drinking Water,JK Jeera', '1,1', '25,40', '25.00,40.00', '65.00', 2, 'kartik', '2018-04-29 09:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `status` enum('y','n') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cid`, `name`, `price`, `description`, `image`, `stock`, `status`) VALUES
(10, 4, 'JK Jeera', 40, 'Jeera powder is generally added in Indian food like lentils, vegetables, pulaos,raitas,etc. Jeera powder gives a nice flavor and taste to the food.', '74b4efb1bd3a18455a56367ec49bc871.jpg', 1500, 'y'),
(9, 4, 'Chocolate Pizza', 999, 'Finger licking taste and an exotic flavour. Perfect for a snack for you or your friends. Its a pack of 3. The Total amount includes Rs.15 Packaging charge.', '1b869606747c781d2394b2f0bc879590.jpg', 3000, 'y'),
(8, 3, 'Oven Cookies', 45, 'Heavenly taste of these incredibly delicious lavash. Every sensational bite of this artisanal handmade treat is sure to leave you craving for more.', '532b5faec398a00ed7a00fcb9c49ce3d.jpg', 2000, 'y'),
(7, 2, 'Orange Juice', 70, 'The real Nagpur Orange with a refreshing taste.', '5ff4225729487c0521cad4e2771f7aca.jpg', 500, 'y'),
(6, 1, 'Green Tea', 99, 'BB Royal Green tea is rich in anti-oxidants. It also increases metabolisim that burns calories & reduces fat content in the body. Drinking green tea on a daily basis refreshes your body & keeps you healthy.', '0e08a17ca8b5e92acc0de5781f95d819.jpg', 1500, 'y'),
(15, 2, 'Cabbage Small', 20, 'Cabbage has a round shape and is composed of superimposed leaf layers. There should be minimally a few outer loose leaves attached to the stem. If not, it may be an indication of disagreeable texture and savor. It is a brilliant supply of vitamin B6, C, K. \r\nProduct image shown is for representation purpose only, the actually product may vary based on season, produce & availability.', 'dd11844137a9da5c6bf9a38963b40aa9.jpg', 120, 'y'),
(16, 2, 'Palak Saag', 30, 'Fresho palak or spinach is composed of jade green, bittersweet and soft leaves with a crunchy texture. They are sourced directly from farmers and are stored in the right conditions to preserve taste, freshness and health benefits. Palak can be used in different dishes to enhance their flavours and nutrient content.', 'c439f1a9c3f2005031b43ef0a37ff551.jpg', 250, 'y'),
(17, 1, 'Aquafina Packaged Drinking Water', 25, 'Aquafina Drinking Water is a brand of purified bottled water products produced by PepsiCo. The water follows 7-step Hydro-7 Purification System eliminates substances other bottled waters leave in, you get pure water and wonderful taste all time.', '61bc26579ce292d11ad409954244cb29.jpg', 500, 'y'),
(18, 1, 'Horlicks Health & Nutrition Drink', 350, 'Health Drink that has nutrients to support immunity.Horlicks is Clinically proven to improve 5 signs of growth. Clinically proven to make kids Taller, Stronger & Sharper. Scientifically proven to improve Power of Milk', 'cc6cd616c2788290f5cd74f7269ffe35.jpg', 400, 'y'),
(19, 3, 'Britannia Biscuits - Marie Gold', 80, 'Tea times are incomplete without a packet of Britannia Marie biscuits. As todays woman packs in more each day while caring for her family, these low fat and zero cholesterol biscuits are her tea time mates. By dipping a Marie Gold into a piping hot cup of tea, a special moment of vitality is savoured.', '0e255395381cc4d60980854453007a1a.jpg', 300, 'y'),
(20, 1, 'Kelloggs Corn Flakes', 200, 'Kelloggs Corn Flakes cereal is the Original & Best cereal. Every bite of these crispy, golden flakes is just as delicious as the first. Youll be on your way to a great day when you pour a bowl of Kelloggs Corn Flakes cereal into your breakfast bowl.', 'e4986e706af0becec7879167b8167d69.jpg', 220, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT '1st user pass: 123456',
  `mobile_no` varchar(11) NOT NULL,
  `isblocked` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= Not blocked,1= Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `mobile_no`, `isblocked`) VALUES
(1, 'nilesh', 'nileshsanyal@yahoo.com', '$2y$10$rGPCluGxCoCkiWNaUy97mO7Tg31a.9iLV.b8JpgGDUZmBcaeHvLZC', '9903396402', 0),
(2, 'kartik', 'nil2take1@gmail.com', '$2y$10$sSp3pjQk4Rqh2OEd6zmUn.QDFQyTP9PILWRixahbrU2LwFW/fLWK2', '9674293089', 0),
(3, 'Shyam', 'nileshsanyal22@yahoo.com', '$2y$10$ak/g21UZ1PsY.nD.0bu2g.h8j0ZxdmpwlQ8bNiGHTSjmfupfezcFi', '9904455668', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
