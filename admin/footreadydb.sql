-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 04:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `footreadydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(0, 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `customer_id` int(11) DEFAULT NULL,
  `shoe_id` int(11) DEFAULT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `total_cost` decimal(8,2) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `shoe_name` varchar(100) DEFAULT NULL,
  `shoe_color` varchar(100) DEFAULT NULL,
  `shoe_size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `postalcode` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `total_cost` decimal(8,2) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone_number`, `password`, `country`, `firstname`, `lastname`, `postalcode`, `city`, `region`, `address`, `total_cost`, `method`) VALUES
(1, 'Ivan Munoz', 'proctantgaming@gmail.com', '09455381098', '1234', '', 'Alexandrine ', 'Miniano', '', '', 'Region 1', 'Urdaneta City', NULL, 'cash'),
(2, 'Jayson Scott', 'jayson@gmail.com', '09455381096', '12345', '', 'Jayson', 'Scott', '', '', 'Region 1', 'Nancamaliran Asingan Pangasinan', NULL, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL,
  `shoe_name` varchar(50) DEFAULT NULL,
  `shoe_color` varchar(50) DEFAULT NULL,
  `shoe_price` decimal(9,2) DEFAULT NULL,
  `shoe_size` varchar(50) DEFAULT NULL,
  `shoe_description` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `image1` varchar(50) DEFAULT NULL,
  `image2` varchar(50) DEFAULT NULL,
  `image3` varchar(50) DEFAULT NULL,
  `image4` varchar(50) DEFAULT NULL,
  `shipfee` decimal(8,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_name`, `shoe_name`, `shoe_color`, `shoe_price`, `shoe_size`, `shoe_description`, `image`, `gender`, `image1`, `image2`, `image3`, `image4`, `shipfee`) VALUES
(3, 'ANTA', 'The Air Jordan 1 Retro High remakes the classic sn', 'IVORY WHITE/GREEN', '5050.40', '7', 'Built for the pros, the ANTA Z-UP 4 is the weapon of choice for wooden floors and indoor courts.', 'IMG-6487a543b64c90.33220904.webp', 'men', 'IMG-6487a543b68067.22411831.webp', 'IMG-6487a543b6b701.41180302.webp', 'IMG-6487a543b6e079.88734440.webp', 'IMG-6487a543b70d20.83321731.webp', '70.00'),
(4, 'NIKE', 'Nike Blazer Mid &#039;77 Vintage &#039;White and G', 'WHITE/GAME ROYAL-PURE PLATINUM', '8400.00', '12', 'In the &lsquo;70s, Nike was the new shoe on the block. So new in fact, we were still breaking into the basketball scene and testing prototypes on the feet\r\n', 'IMG-6487a586c41394.11473304.webp', 'unisex', 'IMG-6487a586c44199.74951897.webp', 'IMG-6487a586c472b4.68960458.webp', 'IMG-6487a586c4a0d3.74247841.webp', 'IMG-6487a586c4c754.45705687.webp', '70.00'),
(5, 'JORDAN', ' Air Jordan 11 Retro Low &#039;Cement Grey and Uni', 'WHITE/UNIVERSITY BLUE-CEMENT GREY', '7890.99', '10', 'Thirty-five years ago, the AJ3 came through, introducing the world to elephant print in Cement Grey. To celebrate that milestone, we&#039;re bringing you an AJ11 low in that same epic colorway. We kept all the AJ11 features you know and love, from the mesh upper to the patent leather to the sleek and ready-for-anything profile. And those University Blue accents? No two ways about it, they just look good.', 'IMG-6487a65e7179b3.98014941.webp', 'women', 'IMG-6487a65e719e78.52769068.webp', 'IMG-6487a65e71be98.10361898.webp', 'IMG-6487a65e71e0b8.69094584.webp', 'IMG-6487a65e71fc52.50985222.webp', '70.00'),
(6, 'JORDAN', ' Air Jordan 2 Retro x Maison Ch&acirc;teau Rouge &', 'SAIL/CITRON PULSE-ORANGE-CINNAMON', '4580.00', '9', 'Transcend beyond borders in the Air Jordan 2 x Maison Ch&acirc;teau Rouge. Designed in collaboration with the Parisian fashion label, the high-end design (good enough for any runway) shines a spotlight on heritage and community. From ornate detailing that nods to the brand&#039;s roots, to the &quot;UNITED YOUTH INTERNATIONAL&quot; and &quot;CHICAGO DAKAR PARIS&quot; on the tongues that celebrate the story of global youth culture, it bridges cultures while staying true to the AJ 2 look you love.', 'IMG-6487a69da0d009.08029656.webp', 'women', 'IMG-6487a69da0f483.23985103.webp', 'IMG-6487a69da11112.77756348.webp', 'IMG-6487a69da12d56.63774218.webp', 'IMG-6487a69da16139.75454776.webp', '70.00'),
(7, 'UNDERARMOUR', ' Under Armour Curry 10 GS &#039;Northern Lights', 'BLACK/BLITZRED/ANTIFREEZE', '6245.00', '11', 'Change directions&mdash;fast. UA Flow cushioning is totally rubberless, making these shoes light and ridiculously grippy. The UA Warp upper works like mini seat belts locking you in. Together, you get stop and go speed + control.', 'IMG-6487a6d3731ec5.85586007.webp', 'unisex ', 'IMG-6487a6d3734522.28047221.webp', 'IMG-6487a6d37365e8.09427869.webp', 'IMG-6487a6d3738577.18485700.webp', 'IMG-6487a6d373a5c8.66619444.webp', '70.00'),
(8, 'JORDAN', 'Air Jordan 13 Retro &#039;Playoffs&#039;', 'BLACK/TRUE RED-WHITE', '4000.00', '8', 'Bring your deftness to the forefront with the return of this stealthy colorway that dropped in &#039;98. Crafted to the original specs, the AJ13', 'IMG-6487a8081c76d9.26022031.webp', 'men', 'IMG-6487a8081ca0c6.37462073.webp', 'IMG-6487a8081cc9a2.79691133.webp', 'IMG-6487a8081cf892.02561627.webp', 'IMG-6487a8081d3674.54685822.webp', '70.00'),
(9, 'JORDAN', 'Jordan Why Not .6 PF &#039;Honor The Gift', 'MOON FOSSIL/YELLOW OCHRE-CAMPFIRE ORANGE', '11200.00', '12', 'Russell Westbrook&#039;s 6th signature shoe is&mdash;you guessed it&mdash;all about speed. To get you goin&#039; as fast as possible, we&#039;ve wrapped the rubber outsole nearly up to the midsole, so you&#039;re not gonna slip when you explode from 0 to 100. Added security comes from the interior bootie that keeps you strapped in as you jet across the court. It&#039;s all held together by an outer shroud and fastened with a zippered collar that spells out Russell&#039;s signature question: &amp', 'IMG-6487a83e9ab2d2.05063563.webp', 'men', 'IMG-6487a83e9ae3e6.65480442.webp', 'IMG-6487a83e9b0f13.45620621.webp', 'IMG-6487a83e9b3d12.69042922.webp', 'IMG-6487a83e9b63f1.69643339.webp', '70.00'),
(10, 'JORDAN', 'Wmns Air Jordan 1 Mid &#039;White and Sea Coral&#0', 'WHITE/SEA CORAL-ATMOSPHERE-SAIL', '4020.99', '12', 'The Air Jordan 1 Mid brings full-court style and premium comfort to an iconic look. Its Air-Sole unit cushions play on the hardwood, while the padded collar gives you a supportive feel.', 'IMG-6487befe0fcc86.14856925.webp', 'women', 'IMG-6487befe0ff444.85818283.webp', 'IMG-6487befe1025b2.15078606.webp', 'IMG-6487befe1058c7.28413753.webp', 'IMG-6487befe108915.63883656.webp', '70.00'),
(11, 'NIKE', 'Wmns Nike Air Force 1 &#039;07 LX &#039;Summit Whi', 'SUMMIT WHITE/GORGE GREEN-WHITE', '3990.00', '8', 'The &#039;90s called&mdash;they want their style back. Well, too bad! Weaving together two icons that have stood the test of time, this Air Force 1 brings you the pinnacle of retro hoops flair. Symbolic branding throughout nods to the iconic Air Command Force, while premium textured leather and an array of sporty colours finish off the look. Lace up and double your force.', 'IMG-6487bf9b1a8170.41028503.webp', 'women', 'IMG-6487bf9b1aaaa3.12686683.webp', 'IMG-6487bf9b1ad530.77761923.webp', 'IMG-6487bf9b1b0788.02565140.webp', 'IMG-6487bf9b1b2fb6.87340766.webp', '70.00'),
(12, 'NIKE', 'Wmns Nike Air Force 1 &#039;07 LX &#039;Obsidian a', 'GORGE GREEN/GOLD SUEDE-OBSIDIAN', '4120.00', '6', 'The &#039;90s called&mdash;they want their style back. Well, too bad! Weaving together two icons that have stood the test of time, this Air Force 1 brings you the pinnacle of retro hoops flair. Symbolic branding throughout nods to the iconic Air Command Force, while premium textured leather and an array of sporty colours finish off the look. Lace up and double your force.', 'IMG-6487c0094db648.41050148.webp', 'women', 'IMG-6487c0094e0260.86992533.webp', 'IMG-6487c0094e3a45.06788442.webp', 'IMG-6487c0094e70b8.99828486.webp', 'IMG-6487c0094e9a57.60946284.webp', '70.00'),
(13, 'UBDERARMOUR', 'CURRY 20', 'WHITE BLACK', '4000.00', '12', 'curry is most valuable player right now', 'IMG-6487e06e04cf72.10529166.webp', 'unisex', 'IMG-6487e06e051437.58846987.webp', 'IMG-6487e06e054a60.86448269.webp', 'IMG-6487e06e057b43.14892283.webp', 'IMG-6487e06e05aad2.83170918.webp', '70.00');

-- --------------------------------------------------------

--
-- Table structure for table `shipped`
--

CREATE TABLE `shipped` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `total_cost` decimal(8,2) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `shoe_name` varchar(100) DEFAULT NULL,
  `shoe_color` varchar(100) DEFAULT NULL,
  `shoe_size` varchar(50) DEFAULT NULL,
  `is_ship` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipped`
--

INSERT INTO `shipped` (`id`, `customer_id`, `shoe_id`, `total_cost`, `name`, `email`, `address`, `method`, `phone`, `image`, `shoe_name`, `shoe_color`, `shoe_size`, `is_ship`) VALUES
(1, 2, 1, '4160.50', 'Jayson Scott', 'jayson@gmail.com', 'Nancamaliran Asingan Pangasinan', 'cash', '09455381096', 'IMG-6487a40f358160.86202142.webp', 'Nike x PEACEMINUSONE G-Dragon Kwondo 1 Black and W', 'WHITE/BLACK/BLACK', '10.5', 1),
(2, 1, 2, '6770.00', 'Alexandrine  Miniano', 'proctantgaming@gmail.com', 'Urdaneta City', 'cash', '09455381098', 'IMG-6487a4c4c56226.25523771.webp', 'Air Jordan 1 Retro High OG Light Smoke Grey.', 'BLACK/FIRE RED-WHITE-LT SMOKE GREY', '12', 1);

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
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipped`
--
ALTER TABLE `shipped`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `confirmation`
--
ALTER TABLE `confirmation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shipped`
--
ALTER TABLE `shipped`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
