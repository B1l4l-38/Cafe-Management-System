-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 02:20 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `bill_Date` date NOT NULL,
  `bill_time` time NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `tax`, `bill_Date`, `bill_time`, `total_price`, `order_id`) VALUES
(2, 105, '2023-09-13', '07:25:03', '1155', 8),
(3, 35, '2023-09-13', '07:26:42', '385', 9),
(4, 30, '2023-09-13', '07:27:06', '330', 10),
(5, 240, '2023-09-13', '07:32:44', '2640', 11),
(6, 75, '2023-09-13', '07:46:34', '825', 12);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `passkey` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `passkey`, `username`) VALUES
(1, 'Hijab', 'abc', 'hijab'),
(2, 'Faiza Zulfiqar', 'faiza', 'faizayy');

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

CREATE TABLE `fooditem` (
  `fid` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`fid`, `name`, `price`, `category`, `url`) VALUES
(1, 'Pizza', 200, 'Fast', 'https://static.toiimg.com/thumb/53110049.cms?width=1200&height=900'),
(2, 'Burger', 350, 'Fast', 'https://propakistani.pk/wp-content/uploads/2022/04/front-view-tasty-meat-burger-wit.jpg'),
(3, 'Chicken Shawarma', 300, 'Fast', 'https://mumkitchen.pk/Content/Products/ProductImages/2686/Chicken-Tikka-Pockets-Shawarma1.jpg'),
(4, 'Chunky Grill Burger', 450, 'Fast', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSksoG0OB27pz0AawkVdl5_GCcdLsrzmcuGrw&usqp=CAU'),
(5, 'Wrap Zilla', 350, 'Fast', 'https://runwaypakistan.com/wp-content/uploads/2022/02/best-wrap-places-in-Karachi-Runway-Pakistan.jpg'),
(6, 'Loaded Fries', 200, 'Fast', 'https://propakistani.pk/foodnama/wp-content/uploads/2022/01/Untitled-design-99-1024x536.png'),
(7, 'Alfredo Pasta', 550, 'Fast', 'https://www.budgetbytes.com/wp-content/uploads/2022/01/Shrimp-Alfredo-Pasta-bowl2-500x500.jpg'),
(8, 'Chicken Nuggets', 50, 'Fast', 'https://static.finmail.com/wp-content/uploads/2020/05/27101339/chicken-nuggets-_web-cover-2.jpg'),
(9, 'Chilli Chicken Nuggets', 60, 'Fast', 'https://www.pakistanichefrecipes.com/wp-content/uploads/2018/04/chilli-nuggets.jpg'),
(10, 'Parmesan Chicken Nuggets', 60, 'Fast', 'https://lh4.googleusercontent.com/-zrR0_643aeI/VLTH3Kn7P1I/AAAAAAAE5Yg/-0lgAvlbbPA/s800/parmesan-chicken-nuggets-21.jpg'),
(11, 'Hawaiian Sandwiches', 200, 'Fast', 'https://www.masala.tv/wp-content/uploads/2018/05/1-57.jpg'),
(12, 'Chicken Mayo Sandwich', 199, 'Fast', 'https://itstastybygohar.com/wp-content/uploads/2021/04/IMG_5849.jpg'),
(13, 'Hamburger', 499, 'Fast', 'https://joyfoodsunshine.com/wp-content/uploads/2022/10/best-hamburger-recipe-11.jpg'),
(14, 'Chicken Bread Balls', 100, 'Continental', 'https://kfoods.com/images1/newrecipeicon/chicken-balls_10460.jpg'),
(15, 'Fiery Fingers Tacos', 550, 'Continental', 'https://propakistani.pk/foodnama/wp-content/uploads/2022/01/mexican-tacos-with-beef-tomato-s.jpg'),
(16, 'Mozzarella Sticks', 150, 'Continental', 'https://kandns.pk/smartcooking/assets/template/images/breakfast-sausage-mozzarella-cheese-sticks.jpg'),
(17, 'CHERRY PIE', 300, 'Continental', 'https://w4s8p5t8.rocketcdn.me/wp-content/uploads/2022/06/vegan-cherry-pie-23.jpg.webp'),
(18, 'TACO', 550, 'Continental', 'https://c.ndtvimg.com/2021-09/10cgsus8_tacos_625x300_09_September_21.jpg'),
(19, 'SIZZLER', 850, 'Continental', 'https://woodholmecardio.com/wp-content/uploads/2018/06/grilled-chicken-sizzler.jpg'),
(20, 'BLACK PEPPPER CHICKEN', 850, 'Continental', 'https://pickledplum.com/wp-content/uploads/2017/06/black-pepper-chicken-1-1200.webp'),
(21, 'FRIED FISH', 1500, 'Continental', 'https://www.ruchikrandhap.com/wp-content/uploads/2015/02/BasicFishFry1-1-1024x682.jpg'),
(22, 'STUFFED CHICKEN BREAST', 750, 'Continental', 'https://www.skinnytaste.com/wp-content/uploads/2021/01/Spinach-Tomato-and-Feta-Stuffed-Chicken-Breast-9.jpg'),
(23, 'CHICKEN CHOPS', 650, 'Continental', 'https://s3-ap-south-1.amazonaws.com/betterbutterbucket-silver/jyothi-rajesh145694710956d73fa4d45c3.jpeg'),
(24, 'PANEER SEEKH KABAB', 150, 'Continental', 'https://mytastycurry.com/wp-content/uploads/2019/02/Paneer-Seekh-Kebab-.jpg'),
(25, 'SINGAPOREAN RICE', 550, 'Continental', 'https://recipe52.com/wp-content/uploads/2020/05/Singaporean-Rice-18.jpg'),
(26, 'Chicken Shaslik', 650, 'Continental', 'https://media.istockphoto.com/id/912629972/photo/chicken-kebab-with-bell-pepper.jpg?s=1024x1024&w=is&k=20&c=knCC5g2sD3dZ81P39HF0GnyD9DlZsEjPGBrhN0VUw7U='),
(27, 'BATTER FINGER FISH', 1500, 'Continental', 'https://static.toiimg.com/thumb/67175180.cms?imgsize=1095068&width=800&height=800'),
(28, 'Chicken Chili Dry with Ri', 550, 'Continental', 'https://arcadiancafe.com/wp-content/uploads/2021/08/chickenchillidry.jpg'),
(29, 'Chicken Fried Rice', 480, 'Continental', 'https://twoplaidaprons.com/wp-content/uploads/2023/04/Close-up-shot-of-Thai-fried-rice-on-a-plate.jpg'),
(30, 'CHICKEN STEAK', 550, 'Continental', 'https://ikneadtoeat.com/wp-content/uploads/2022/11/grilled-chicken-steak-3.jpg'),
(31, 'TUSCAN CHICKEN', 450, 'Continental', 'https://www.kitchensanctuary.com/wp-content/uploads/2018/04/Tuscan-Chicken-tall-FS-36.webp'),
(32, 'Chow mein', 1499, 'Chinese', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-2CFH2U6ADX6nCXmD2qAgilwJTMxH9ZhPqMe_CzQk97kMjpMYJaeugncj8AJw1zxDN70&usqp=CAU'),
(33, 'Mapo Tofu', 950, 'Chinese', 'https://www.chinasichuanfood.com/wp-content/uploads/2020/11/mapo-tofu-16.webp'),
(34, 'Spring Rolls', 550, 'Chinese', 'https://redhousespice.com/wp-content/uploads/2021/12/whole-spring-rolls-and-halved-ones-scaled.jpg'),
(35, 'Dumplings', 650, 'Chinese', 'https://www.recipetineats.com/wp-content/uploads/2022/09/Vegetable-Dumplings-1-on-plate.jpg?w=500&h=500&crop=1'),
(36, 'Chilli Chicken', 1150, 'Chinese', 'https://www.licious.in/blog/wp-content/uploads/2022/08/Shutterstock_1237679371.jpg'),
(37, 'Manchurian', 1100, 'Chinese', 'https://www.licious.in/blog/wp-content/uploads/2021/09/shutterstock_1650877375.jpg'),
(38, 'Noodle Soup', 499, 'Chinese', 'https://pakistanichefs.com/wp-content/uploads/2020/12/noddles-soup-4.jpg'),
(39, 'WonTon', 100, 'Chinese', 'https://www.thespruceeats.com/thmb/qrHOEu06bNxWZ4MjwqGJrYR8ggA=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/pork-and-shrimp-wonton-4077052-hero-01-3215d83b87704242a85db72b4201ebc1.jpg'),
(40, 'Hot and Sour Soup', 650, 'Chinese', 'https://www.chilitochoc.com/wp-content/uploads/2021/01/chinese-hot-and-sour-soup-sq.jpg'),
(41, 'Chicken And Vegetable Spa', 1150, 'Chinese', 'https://gracefoods.com/images/Recipes2017/cropped-Chicken-Vegetable-Stir-Fry-Spaghetti.jpg'),
(42, 'Peking Roast Duck', 1350, 'Chinese', 'https://redhousespice.com/wp-content/uploads/2022/01/sliced-peking-duck-with-pancakes-scaled.jpg'),
(43, 'Char Siu', 2550, 'Chinese', 'https://thewoksoflife.com/wp-content/uploads/2019/04/char-siu-recipe-15.jpg'),
(44, 'Congee', 550, 'Chinese', 'https://www.foodandwine.com/thmb/gPBdndXOjEGBqOdnBlqFOvzJ09g=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/FAW-basic-chinese-congee-hero-04-f643caa36dce4137839eef70a0b1beac.jpg'),
(46, 'Fried Rice', 399, 'Chinese', 'https://www.seriouseats.com/thmb/zO80j7KGl3j2k3vgrNVahBWUQBk=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/20230529-SEA-EggFriedRice-AmandaSuarez-hero-c8d95fbf69314b318bc279159f582882.jpg'),
(47, 'Dumpling Zhang', 999, 'Chinese', 'http://i.hipinpakistan.com/primary/2017/03/58cbb2fd158b2.jpg'),
(48, 'Cashew Chicken', 799, 'Chinese', 'https://www.whiskaffair.com/wp-content/uploads/2014/05/Cashew-Chicken-1-3.jpg'),
(49, 'Sweet chilli chicken', 999, 'Chinese', 'https://media.healthyfood.com/wp-content/uploads/2016/11/Sweet-chilli-chicken-and-cashew-stir-fry.jpg'),
(50, 'Chilli jam stir-fry', 899, 'Chinese', 'https://img.taste.com.au/JAqJqmCh/taste/2016/11/chicken-cashew-and-chilli-jam-stir-fry-76440-1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `fooditem_view`
--

CREATE TABLE `fooditem_view` (
  `fid` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem_view`
--

INSERT INTO `fooditem_view` (`fid`, `name`, `price`, `category`, `url`) VALUES
(2, 'Burger', 350, 'Fast', 'https://propakistani.pk/wp-content/uploads/2022/04/front-view-tasty-meat-burger-wit.jpg'),
(3, 'Chicken Shawarma', 300, 'Fast', 'https://mumkitchen.pk/Content/Products/ProductImages/2686/Chicken-Tikka-Pockets-Shawarma1.jpg'),
(4, 'Chunky Grill Burger', 450, 'Fast', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSksoG0OB27pz0AawkVdl5_GCcdLsrzmcuGrw&usqp=CAU'),
(5, 'Wrap Zilla', 350, 'Fast', 'https://runwaypakistan.com/wp-content/uploads/2022/02/best-wrap-places-in-Karachi-Runway-Pakistan.jpg'),
(6, 'Loaded Fries', 200, 'Fast', 'https://propakistani.pk/foodnama/wp-content/uploads/2022/01/Untitled-design-99-1024x536.png'),
(7, 'Alfredo Pasta', 550, 'Fast', 'https://www.budgetbytes.com/wp-content/uploads/2022/01/Shrimp-Alfredo-Pasta-bowl2-500x500.jpg'),
(8, 'Chicken Nuggets', 50, 'Fast', 'https://static.finmail.com/wp-content/uploads/2020/05/27101339/chicken-nuggets-_web-cover-2.jpg'),
(9, 'Chilli Chicken Nuggets', 60, 'Fast', 'https://www.pakistanichefrecipes.com/wp-content/uploads/2018/04/chilli-nuggets.jpg'),
(10, 'Parmesan Chicken Nuggets', 60, 'Fast', 'https://lh4.googleusercontent.com/-zrR0_643aeI/VLTH3Kn7P1I/AAAAAAAE5Yg/-0lgAvlbbPA/s800/parmesan-chicken-nuggets-21.jpg'),
(11, 'Hawaiian Sandwiches', 200, 'Fast', 'https://www.masala.tv/wp-content/uploads/2018/05/1-57.jpg'),
(12, 'Chicken Mayo Sandwich', 199, 'Fast', 'https://itstastybygohar.com/wp-content/uploads/2021/04/IMG_5849.jpg'),
(13, 'Hamburger', 499, 'Fast', 'https://joyfoodsunshine.com/wp-content/uploads/2022/10/best-hamburger-recipe-11.jpg'),
(14, 'Chicken Bread Balls', 100, 'Continental', 'https://kfoods.com/images1/newrecipeicon/chicken-balls_10460.jpg'),
(15, 'Fiery Fingers Tacos', 550, 'Continental', 'https://propakistani.pk/foodnama/wp-content/uploads/2022/01/mexican-tacos-with-beef-tomato-s.jpg'),
(16, 'Mozzarella Sticks', 150, 'Continental', 'https://kandns.pk/smartcooking/assets/template/images/breakfast-sausage-mozzarella-cheese-sticks.jpg'),
(17, 'CHERRY PIE', 300, 'Continental', 'https://w4s8p5t8.rocketcdn.me/wp-content/uploads/2022/06/vegan-cherry-pie-23.jpg.webp'),
(18, 'TACO', 550, 'Continental', 'https://c.ndtvimg.com/2021-09/10cgsus8_tacos_625x300_09_September_21.jpg'),
(19, 'SIZZLER', 850, 'Continental', 'https://woodholmecardio.com/wp-content/uploads/2018/06/grilled-chicken-sizzler.jpg'),
(20, 'BLACK PEPPPER CHICKEN', 850, 'Continental', 'https://pickledplum.com/wp-content/uploads/2017/06/black-pepper-chicken-1-1200.webp'),
(21, 'FRIED FISH', 1500, 'Continental', 'https://www.ruchikrandhap.com/wp-content/uploads/2015/02/BasicFishFry1-1-1024x682.jpg'),
(22, 'STUFFED CHICKEN BREAST', 750, 'Continental', 'https://www.skinnytaste.com/wp-content/uploads/2021/01/Spinach-Tomato-and-Feta-Stuffed-Chicken-Breast-9.jpg'),
(23, 'CHICKEN CHOPS', 650, 'Continental', 'https://s3-ap-south-1.amazonaws.com/betterbutterbucket-silver/jyothi-rajesh145694710956d73fa4d45c3.jpeg'),
(24, 'PANEER SEEKH KABAB', 150, 'Continental', 'https://mytastycurry.com/wp-content/uploads/2019/02/Paneer-Seekh-Kebab-.jpg'),
(25, 'SINGAPOREAN RICE', 550, 'Continental', 'https://recipe52.com/wp-content/uploads/2020/05/Singaporean-Rice-18.jpg'),
(26, 'Chicken Shaslik', 650, 'Continental', 'https://media.istockphoto.com/id/912629972/photo/chicken-kebab-with-bell-pepper.jpg?s=1024x1024&w=is&k=20&c=knCC5g2sD3dZ81P39HF0GnyD9DlZsEjPGBrhN0VUw7U='),
(27, 'BATTER FINGER FISH', 1500, 'Continental', 'https://static.toiimg.com/thumb/67175180.cms?imgsize=1095068&width=800&height=800'),
(28, 'Chicken Chili Dry with Ri', 550, 'Continental', 'https://arcadiancafe.com/wp-content/uploads/2021/08/chickenchillidry.jpg'),
(29, 'Chicken Fried Rice', 480, 'Continental', 'https://twoplaidaprons.com/wp-content/uploads/2023/04/Close-up-shot-of-Thai-fried-rice-on-a-plate.jpg'),
(30, 'CHICKEN STEAK', 550, 'Continental', 'https://ikneadtoeat.com/wp-content/uploads/2022/11/grilled-chicken-steak-3.jpg'),
(31, 'TUSCAN CHICKEN', 450, 'Continental', 'https://www.kitchensanctuary.com/wp-content/uploads/2018/04/Tuscan-Chicken-tall-FS-36.webp'),
(32, 'Chow mein', 1499, 'Chinese', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-2CFH2U6ADX6nCXmD2qAgilwJTMxH9ZhPqMe_CzQk97kMjpMYJaeugncj8AJw1zxDN70&usqp=CAU'),
(33, 'Mapo Tofu', 950, 'Chinese', 'https://www.chinasichuanfood.com/wp-content/uploads/2020/11/mapo-tofu-16.webp'),
(34, 'Spring Rolls', 550, 'Chinese', 'https://redhousespice.com/wp-content/uploads/2021/12/whole-spring-rolls-and-halved-ones-scaled.jpg'),
(35, 'Dumplings', 650, 'Chinese', 'https://www.recipetineats.com/wp-content/uploads/2022/09/Vegetable-Dumplings-1-on-plate.jpg?w=500&h=500&crop=1'),
(36, 'Chilli Chicken', 1150, 'Chinese', 'https://www.licious.in/blog/wp-content/uploads/2022/08/Shutterstock_1237679371.jpg'),
(37, 'Manchurian', 1100, 'Chinese', 'https://www.licious.in/blog/wp-content/uploads/2021/09/shutterstock_1650877375.jpg'),
(38, 'Noodle Soup', 499, 'Chinese', 'https://pakistanichefs.com/wp-content/uploads/2020/12/noddles-soup-4.jpg'),
(39, 'WonTon', 100, 'Chinese', 'https://www.thespruceeats.com/thmb/qrHOEu06bNxWZ4MjwqGJrYR8ggA=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/pork-and-shrimp-wonton-4077052-hero-01-3215d83b87704242a85db72b4201ebc1.jpg'),
(40, 'Hot and Sour Soup', 650, 'Chinese', 'https://www.chilitochoc.com/wp-content/uploads/2021/01/chinese-hot-and-sour-soup-sq.jpg'),
(41, 'Chicken And Vegetable Spa', 1150, 'Chinese', 'https://gracefoods.com/images/Recipes2017/cropped-Chicken-Vegetable-Stir-Fry-Spaghetti.jpg'),
(42, 'Peking Roast Duck', 1350, 'Chinese', 'https://redhousespice.com/wp-content/uploads/2022/01/sliced-peking-duck-with-pancakes-scaled.jpg'),
(43, 'Char Siu', 2550, 'Chinese', 'https://thewoksoflife.com/wp-content/uploads/2019/04/char-siu-recipe-15.jpg'),
(44, 'Congee', 550, 'Chinese', 'https://www.foodandwine.com/thmb/gPBdndXOjEGBqOdnBlqFOvzJ09g=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/FAW-basic-chinese-congee-hero-04-f643caa36dce4137839eef70a0b1beac.jpg'),
(46, 'Fried Rice', 399, 'Chinese', 'https://www.seriouseats.com/thmb/zO80j7KGl3j2k3vgrNVahBWUQBk=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/20230529-SEA-EggFriedRice-AmandaSuarez-hero-c8d95fbf69314b318bc279159f582882.jpg'),
(47, 'Dumpling Zhang', 999, 'Chinese', 'http://i.hipinpakistan.com/primary/2017/03/58cbb2fd158b2.jpg'),
(48, 'Cashew Chicken', 799, 'Chinese', 'https://www.whiskaffair.com/wp-content/uploads/2014/05/Cashew-Chicken-1-3.jpg'),
(49, 'Sweet chilli chicken', 999, 'Chinese', 'https://media.healthyfood.com/wp-content/uploads/2016/11/Sweet-chilli-chicken-and-cashew-stir-fry.jpg'),
(50, 'Chilli jam stir-fry', 899, 'Chinese', 'https://img.taste.com.au/JAqJqmCh/taste/2016/11/chicken-cashew-and-chilli-jam-stir-fry-76440-1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `passkey` varchar(255) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `name`, `passkey`, `username`) VALUES
(1, 'Manager', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORDER_id` int(11) NOT NULL,
  `ORDER_date` date DEFAULT NULL,
  `ORDER_time` time DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ORDER_id`, `ORDER_date`, `ORDER_time`, `customer_id`, `manager_id`) VALUES
(8, '2023-09-13', '07:25:03', 1, 1),
(9, '2023-09-13', '07:26:42', 1, 1),
(10, '2023-09-13', '07:27:06', 1, 1),
(11, '2023-09-13', '07:32:44', 1, 1),
(12, '2023-09-13', '07:46:34', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_contain_fooditems`
--

CREATE TABLE `orders_contain_fooditems` (
  `order_id` int(11) NOT NULL,
  `fooditem_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_contain_fooditems`
--

INSERT INTO `orders_contain_fooditems` (`order_id`, `fooditem_id`, `quantity`) VALUES
(8, 2, 3),
(9, 2, 1),
(10, 3, 1),
(11, 2, 3),
(11, 3, 3),
(11, 4, 1),
(12, 2, 2),
(12, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `manager_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`manager_id`, `order_id`, `bill_id`) VALUES
(1, 8, 2),
(1, 9, 3),
(1, 10, 4),
(1, 11, 5),
(1, 12, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `FK_order_id` (`order_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `fooditem_view`
--
ALTER TABLE `fooditem_view`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_contain_fooditems`
--
ALTER TABLE `orders_contain_fooditems`
  ADD PRIMARY KEY (`order_id`,`fooditem_id`,`quantity`),
  ADD KEY `fooditem_id` (`fooditem_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`manager_id`,`order_id`,`bill_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `fooditem_view`
--
ALTER TABLE `fooditem_view`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORDER_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_manager_id` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`);

--
-- Constraints for table `orders_contain_fooditems`
--
ALTER TABLE `orders_contain_fooditems`
  ADD CONSTRAINT `orders_contain_fooditems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ORDER_id`),
  ADD CONSTRAINT `orders_contain_fooditems_ibfk_2` FOREIGN KEY (`fooditem_id`) REFERENCES `fooditem` (`fid`);

--
-- Constraints for table `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ORDER_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
