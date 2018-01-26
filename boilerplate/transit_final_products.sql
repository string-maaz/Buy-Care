-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2016 at 05:05 AM
-- Server version: 5.7.9-log
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boilerplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `transit_final_products`
--

CREATE TABLE `transit_final_products` (
  `id` int(11) NOT NULL,
  `transit_report_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `supplier_product_name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_code` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `supplier_price` decimal(19,2) NOT NULL,
  `subtotal` decimal(19,2) NOT NULL,
  `vat` decimal(19,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transit_final_products`
--

INSERT INTO `transit_final_products` (`id`, `transit_report_id`, `product_name`, `supplier_product_name`, `sku`, `product_id`, `supplier_code`, `qty`, `supplier_price`, `subtotal`, `vat`, `created_at`, `updated_at`) VALUES
(1, 25, '', 'amazon', 'GG-G1ME-H8RZ', 1, 'HBSupplies.co.uk', 1, '123.00', '123.00', '24.60', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 25, '', 'amazon', '9N-SZR0-W76W', 1, 'HBSupplies.co.uk', 1, '66.00', '66.00', '13.20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 25, '', 'amazon', '100001010', 1, 'HBSupplies.co.uk', 1, '8.00', '8.00', '1.60', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transit_final_products`
--
ALTER TABLE `transit_final_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKtransit_fi60360` (`transit_report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transit_final_products`
--
ALTER TABLE `transit_final_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transit_final_products`
--
ALTER TABLE `transit_final_products`
  ADD CONSTRAINT `transit_final_products_ibfk_1` FOREIGN KEY (`transit_report_id`) REFERENCES `transit_final_reports` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
