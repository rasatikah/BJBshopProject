-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 04:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

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
(1, 'admin', '25f9e794323b453885f5181f1b624d0b', 'Admin', 123456789);

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
(7, 'Maria', 'maria@utm.my', '0103445128', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliverID` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `deliverAddress` varchar(255) NOT NULL,
  `deliverName` text NOT NULL,
  `deliverEmail` varchar(150) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliverID`, `username`, `password`, `deliverAddress`, `deliverName`, `deliverEmail`, `phoneNumber`) VALUES
(1, 'deliver', '8fa3f3b42193cc6ffe393a51e60ed744', 'KTDI', 'deliver', 'deliver@gmail.com', '012345678');

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
(1, 1, 1, 'user', 'Awesome cool T-shirt', '10.20', 12, '0000-00-00 00:00:00', 'user2', '23, Jalan Warisan Indah 8/12 Kota Warisan 43900 Sepang Selangor', 'Pos Laju', 'Diterima');

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
(12, 'user', 'user', 'utm', 'Hp Laptop i7', '3', 1, '2599.00', 'payment/receipt.png', '2020-06-09 01:38:10', 'Sudah Dibayar', '00000');

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
(2, 'nlib', 'HP Laptop i5', '1999.00', 'cantik', 'Elektronik', 10, 'product-images/laptop.jpg'),
(3, 'nlt', 'Converse highcut (preloved)', '599.00', 'size 8 UK', 'Pakaian dan Aksesori', 200, 'photo/images.jpg');

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
  `shopName` varchar(255) NOT NULL,
  `sellerAddress` varchar(200) NOT NULL,
  `sellerEmail` varchar(50) NOT NULL,
  `phoneNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerID`, `username`, `password`, `sellerName`, `shopID`, `shopName`, `sellerAddress`, `sellerEmail`, `phoneNumber`) VALUES
(2, 'seller', '1e4970ada8c054474cda889490de3421', 'seller', 0, '', 'K9 K10', 'seller@gmail.com', 123456788);

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
(15, 'user', '6ad14ba9986e3615423dfca256d04e3f', 'user', '192020292', 'KMJ', 'user2@gmail.com');

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
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliverID`);

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
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliverID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `sellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
