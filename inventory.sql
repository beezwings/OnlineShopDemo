-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2018 at 06:35 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`product_id`, `quantity`, `order_id`) VALUES
(3, 6, 0),
(7, 5, 0),
(2, 4, 1),
(2, 4, 2),
(6, 4, 2),
(5, 3, 3),
(7, 4, 3),
(5, 4, 4),
(1, 5, 4),
(16, 4, 5),
(1, 4, 5),
(1, 2, 7),
(1, 1, 8),
(17, 3, 10),
(5, 1, 11),
(6, 1, 11),
(10, 3, 15),
(4, 3, 15),
(2, 4, 15),
(2, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `phone`, `email`, `date`) VALUES
(1, 'adsf', 'asdf', 'asdf', '2018-03-03 13:36:13'),
(2, 'Jessie', '2394203948', 'aldsfkadsf@gaslkdfj', '2018-03-03 13:43:57'),
(3, 'Jessie', '92304', 'asdkjfhad@asdlfkj.com', '2018-03-03 13:47:11'),
(4, 'Carolyn', '9021403984203498', 'bess@asdfioasdjfad', '2018-03-03 19:20:33'),
(5, 'Oshean', '90223049203498', 'asldfjlaskdjf@asldfjal.com', '2018-03-03 19:23:37'),
(6, 'Oshean', '90223049203498', 'asldfjlaskdjf@asldfjal.com', '2018-03-03 19:28:25'),
(7, 'Jess', 'asdflk', 'adslfkj', '2018-03-04 17:11:59'),
(8, 'JessieLitven', '30948', 'alsdjfad@gmail', '2018-03-04 17:13:09'),
(9, 'Jessie Litven', 'qwd8fasdlfiu', 'asldfj', '2018-03-04 17:13:37'),
(10, 'Ja Liptea', 'asdlkfja2', 'alskdfjlakdjsf', '2018-03-04 17:14:01'),
(11, 'Carolyn Yelloow', '234098230498', 'CarolynYeloo@gmail.com', '2018-03-04 22:20:56'),
(12, 'Carolyn Yelloow', '234098230498', 'CarolynYeloo@gmail.com', '2018-03-04 22:21:21'),
(13, 'Carolyn Yelloow', '234098230498', 'CarolynYeloo@gmail.com', '2018-03-04 22:23:02'),
(14, 'Carolyn Yelloow', '234098230498', 'CarolynYeloo@gmail.com', '2018-03-04 22:24:36'),
(15, 'Jessie Litven', '9203423', 'basdfads@adfadfjkh.com', '2018-03-05 01:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`, `category_id`, `image_url`) VALUES
(1, 'Blue Corduroy', 'From Robert Kaufman Fabrics, this ultra soft light weight 14 wale (number of cords per inch) corduroy is classic, durable and versatile. It is perfect for creating stylish shirts, vests, jumpers, skirts, dresses, light weight jackets and children\'s apparel. Also create window treatments, toss pillows and other home decor accessories.', 400, 5, 1, 'https://cdn.shopify.com/s/files/1/0109/6372/products/938_SRC_51b700c1a9f46_1000x.jpeg?v=1511067087'),
(2, 'Pink Brocade', NULL, 500, 5, 1, 'https://4.imimg.com/data4/UF/BH/MY-13047257/brocade-fabric-500x500.jpg'),
(3, 'Linen', NULL, 300, 2, 1, 'https://images.fabric.com/images/400/400/0365675.jpg'),
(4, 'Paisley', NULL, 400, 2, 1, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Persian_Silk_Brocade_-_Paisley_-_Persian_Paisley_-_Seyyed_Hossein_Mozhgani_-_1963.jpg/1200px-Persian_Silk_Brocade_-_Paisley_-_Persian_Paisley_-_Seyyed_Hossein_Mozhgani_-_1963.jpg'),
(5, 'Orange Burlap', NULL, 1000, 2, 1, 'https://d2d00szk9na1qq.cloudfront.net/Product/69f52998-9877-4fa5-a051-9be23f89eb83/Images/Large_UO-438.jpg'),
(6, 'White Rice Paper', NULL, 10, 20, 2, 'https://artofcollage.files.wordpress.com/2014/03/640-unryu-japanese-paper2.jpg'),
(7, 'Pink Textured Paper', NULL, 200, 20, 2, 'https://www.stockvault.net/data/2017/01/30/222083/preview16.jpg'),
(8, 'Green Rice Paper', NULL, 100, 12, 2, 'http://monalisa-artmat.com/shop/images/10293/unyru+paper.JPG?300,300,0,100,80,16777215,533511211'),
(9, 'Brown Fish Scale Tiles', NULL, 300, 3, 3, 'http://img.archiexpo.com/images_ae/photo-g/97708-11732912.jpg'),
(10, 'Aquatic Blue Tiles', NULL, 20, 4, 3, 'https://smhttp-ssl-44887.nexcesscdn.net/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/i/m/img_3937.jpg'),
(17, 'Red Glass Tiles', NULL, 100, 30, 3, 'https://www.bravotti.com/image/cache/catalog/mosaic-tiles/KLG004-1-500x500/crystal-glass-tile-backsplash-pebble-wall-tiles-klg004-red-penny-p717.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `category_image`) VALUES
(1, 'Fabrics', 'https://s-media-cache-ak0.pinimg.com/originals/28/9c/15/289c15bba6e80121c880fdb110527a7d.jpg'),
(2, 'Paper', 'https://cdn.shopify.com/s/files/1/1750/4945/products/pearlescent_metallic_dark_color_cardstock_paper_sampler_pack_1_600x.jpg?v=1508177023'),
(3, 'Tiles', 'https://b2bbusinessnews.files.wordpress.com/2012/07/ceramic-tiles.jpg');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
