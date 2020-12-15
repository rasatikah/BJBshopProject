-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 02:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectwd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `phoneNumber` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `adminName`, `phoneNumber`) VALUES
(1, 'admin', '25f9e794323b453885f5181f1b624d0b', 'Nik Aiman', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`) VALUES
(1, 'Makanan dan Minuman'),
(2, 'Pakaian dan Aksesori'),
(3, 'Elektronik'),
(5, 'Peralatan Sekolah'),
(6, 'Peralatan Memasak'),
(7, 'Haiwan Peliharaan'),
(9, 'Buku');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `inquiries` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `name`, `email`, `phoneNumber`, `inquiries`) VALUES
(1, 'johan', 'n@s.com', '0123456789', 'bodoh punya website'),
(3, 'johan', 'n@s.com', '0123456789', 'bodoh punya website'),
(7, 'johan', 'nik@k.com', '0103445128', 'bodoh punya website'),
(9, 'johan', 'nik@k.com', '0103445128', 'bodoh punya website'),
(11, 'nik', 'nik@nik.nik', '0123456789', 'hahahha\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `username` varchar(99) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `orderPrice` decimal(9,2) NOT NULL,
  `orderQuantity` int(99) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `custName` varchar(255) NOT NULL,
  `custAddress` varchar(255) NOT NULL,
  `shippingMethod` varchar(255) NOT NULL,
  `orderStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`orderID`, `productID`, `custID`, `username`, `productName`, `orderPrice`, `orderQuantity`, `orderDate`, `custName`, `custAddress`, `shippingMethod`, `orderStatus`) VALUES
(1, 1, 1, 'user', 'Awesome cool T-shirt', '10.20', 12, '0000-00-00 00:00:00', 'Nik Aiman', '23, Jalan Warisan Indah 8/12 Kota Warisan 43900 Sepang Selangor', 'Pos Laju', 'Diterima'),
(3, 22, 6, 'aligator', 'iPhone 19 Max Pro S Plus', '3.50', 10, '2020-03-31 16:00:00', 'Ali Gator', 'Kota Warisan', 'PosPerlahan', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `paymenting`
--

CREATE TABLE `paymenting` (
  `paymentID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `custName` varchar(255) NOT NULL,
  `custAddress` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL,
  `productQuantity` int(99) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `proofPayment` varchar(255) NOT NULL,
  `paymentTime` timestamp NULL DEFAULT current_timestamp(),
  `orderStatus` varchar(255) NOT NULL,
  `orderTracking` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymenting`
--

INSERT INTO `paymenting` (`paymentID`, `username`, `custName`, `custAddress`, `productName`, `productID`, `productQuantity`, `price`, `proofPayment`, `paymentTime`, `orderStatus`, `orderTracking`) VALUES
(8, 'user', 'using', 'england - original', 'Nasi Lemak Telur', '3', 4, '2.00', 'payment/receipt.png', '2020-06-08 10:39:14', 'Diterima', '[POSLAJU] 10000002'),
(9, 'user', 'nokia', 'symbian', 'Nasi Lemak Telur', '3', 1, '0.50', 'payment/receipt.png', '0000-00-00 00:00:00', 'Sudah Dihantar', '[POSLAJU] 10000000'),
(10, 'user', 'aiman', '10 selangor', 'Sambal Nasi Lemak', '4', 5, '1.00', 'payment/receipt.png', '2020-06-08 14:54:33', 'Sudah Dihantar', 'Hilang'),
(11, 'jdb_official', 'John', 'UK', 'IC MALAYSIA - Original', '8', 5, '1000000.00', 'payment/receipt.png', '2020-06-09 00:54:20', 'Sudah Dibayar', 'Dalam Proses'),
(12, 'user', 'nik', 'aaa', 'Hp Laptop i7', '3', 1, '2599.00', 'payment/receipt.png', '2020-06-09 01:38:10', 'Sudah Dibayar', '00000'),
(13, 'user', 'nik', 'malaysia', 'Kucen	Zirafah	 ', '17', 1, '9999999.99', 'payment/DSC_0308.JPG', '2020-06-10 13:01:19', 'Diterima', 'Mennunggu Pengesahan'),
(14, 'user', 'nik', 'sepang', 'Kucen	Zirafah	 ', '17	16	 ', 1, '9999999.99', 'payment/DSC_0068.JPG', '2020-06-10 13:02:11', 'Diterima', 'Mennunggu Pengesahan'),
(15, 'user', 'test', 'test', 'Kucen	Zirafah	 ', '17	16	 ', 8, '9999999.99', 'payment/DSC_0058.JPG', '2020-06-10 13:09:34', 'Diterima', 'Mennunggu Pengesahan'),
(16, 'user', 'nik', 'ai', '                                                                        Hp Laptop i7                                      \r\n                                ', '                                                                        3                                      \r\n                                ', 4, '10396.00', 'payment/receipt.png', '2020-06-11 08:53:02', 'Diterima', 'Mennunggu Pengesahan');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` decimal(9,2) NOT NULL,
  `productDetail` varchar(255) NOT NULL,
  `productCategories` varchar(255) NOT NULL,
  `productQuantity` int(99) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `code`, `productName`, `productPrice`, `productDetail`, `productCategories`, `productQuantity`, `productImage`) VALUES
(2, 'nlib', 'HP Laptop i5', '1999.00', 'Tak Sedap', 'Makanan dan Minuman', 10, 'product-images/laptop.jpg'),
(3, 'nlt', 'Hp Laptop i7', '2599.00', 'tak Sedap', 'Makanan dan Minuman', 200, 'product-images/laptop.jpg'),
(8, 'ic', 'IC MALAYSIA - Original', '200000.00', 'Original', 'Elektronik dan Gadjet', 99, 'product-images/Annotation 2019-07-17 215543.png'),
(9, 'car001', 'Perodua Kelisa', '11999.00', 'Like New', '', 1, 'product-images/DSC_0065.JPG'),
(16, 'grf', 'Zirafah', '9999999.99', 'Tinggi', 'Haiwan Peliharaan', 21, 'product-images/DSC_0052.JPG'),
(17, 'kcg', 'Kucen', '6999.00', 'Comel', 'Haiwan Peliharaan', 1, 'product-images/DSC_0401.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `sellerID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sellerName` varchar(255) NOT NULL,
  `shopID` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerID`, `username`, `password`, `sellerName`, `shopID`, `shopName`) VALUES
(1, 'seller', '25f9e794323b453885f5181f1b624d0b', 'Seller', 1, 'ABC Shop');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `custName` varchar(255) NOT NULL,
  `shippingAddress` varchar(255) NOT NULL,
  `shippingDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `custName` varchar(255) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  `custAddress` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `custName`, `phoneNumber`, `custAddress`, `email`) VALUES
(1, 'user', '25f9e794323b453885f5181f1b624d0b', 'Nik Aiman', '104546226', '23, Jalan Warisan Indah 8/12 Kota Warisan 43900 Sepang Selangor', 'nikaiman10@gmail.com'),
(7, 'steven', '25f9e794323b453885f5181f1b624d0b', 'steven', '0123456789', 'Sabah dan sarawak', 'steven@steven.com'),
(9, 'jdb_official', '25f9e794323b453885f5181f1b624d0b', 'John D\'Blend', '0123456789', 'Indon', 'john@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `paymenting`
--
ALTER TABLE `paymenting`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`sellerID`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymenting`
--
ALTER TABLE `paymenting`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `sellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
