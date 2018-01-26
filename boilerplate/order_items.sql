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
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `increment_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `print_count` int(11) NOT NULL DEFAULT '0',
  `carrier` varchar(50) NOT NULL,
  `ordered_qty` int(11) NOT NULL,
  `available_qty` int(11) NOT NULL,
  `in_transit_qty` int(11) NOT NULL,
  `label_color` varchar(50) NOT NULL DEFAULT 'green',
  `is_labeled` tinyint(4) NOT NULL DEFAULT '0',
  `market_name` varchar(255) DEFAULT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `supplier_product_name` varchar(255) DEFAULT NULL,
  `market_order_id` varchar(255) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_code` varchar(255) DEFAULT NULL,
  `ordered_date` datetime NOT NULL,
  `is_removed` tinyint(4) NOT NULL DEFAULT '0',
  `is_refunded` tinyint(4) NOT NULL DEFAULT '0',
  `tracking_number` varchar(255) DEFAULT NULL,
  `dispacted_date` datetime DEFAULT NULL,
  `expected_delivery_date` datetime DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `expenses` decimal(19,2) DEFAULT NULL,
  `selling_commission` decimal(19,2) DEFAULT NULL,
  `supplier_price` decimal(19,2) DEFAULT NULL,
  `packing` varchar(50) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `is_ordered_outside` tinyint(3) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `past_order_count` int(11) NOT NULL,
  `label` tinyint(4) NOT NULL DEFAULT '0',
  `supplier_image_link` varchar(255) NOT NULL,
  `order_item_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `sku`, `order_id`, `increment_id`, `status`, `print_count`, `carrier`, `ordered_qty`, `available_qty`, `in_transit_qty`, `label_color`, `is_labeled`, `market_name`, `volume`, `supplier_product_name`, `market_order_id`, `supplier_name`, `supplier_code`, `ordered_date`, `is_removed`, `is_refunded`, `tracking_number`, `dispacted_date`, `expected_delivery_date`, `product_name`, `price`, `expenses`, `selling_commission`, `supplier_price`, `packing`, `subtotal`, `vat`, `is_ordered_outside`, `created_at`, `updated_at`, `product_link`, `past_order_count`, `label`, `supplier_image_link`, `order_item_id`) VALUES
(43, 'GG-G1ME-H8RZ', 601, '100000611', '1', 0, 'RM24', 1, 10, 0, 'orange', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'HBSupplies.co.uk', '2015-12-24 06:54:51', 1, 1, 'NULL', '0000-00-00 00:00:00', NULL, 'product', '12.00', '2.34', NULL, '123.00', NULL, 35, 2, 0, '2015-12-24 06:54:51', '2015-12-24 06:54:51', 'image', 0, 0, 'image', '677'),
(44, 'KH-KWWX-T7OB', 602, '100000612', '1', 0, 'RM24', 1, 10, 0, 'orange', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'Rainbowcosmatic.co.uk 	', '2015-12-24 06:56:19', 1, 0, '24352432dfgxc', '0000-00-00 00:00:00', NULL, 'product', '12.00', '5.87', NULL, '121.00', NULL, 23, 2, 0, '2015-12-24 06:56:19', '2015-12-24 06:56:19', 'image', 0, 0, 'image', '678'),
(45, '9N-SZR0-W76W', 603, '100000613', '1', 0, 'RMT24', 1, 10, 0, 'orange', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'HBSupplies.co.uk', '2015-12-24 06:57:27', 0, 1, 'NULL32R FWF', '0000-00-00 00:00:00', NULL, 'product', '12.00', '12.40', NULL, '66.00', NULL, 45, 41, 0, '2015-12-24 06:57:27', '2015-12-24 06:57:27', 'image', 0, 0, 'image', '679'),
(46, '5X-24OL-71KA', 603, '100000613', '1', 0, 'RMT24', 1, 10, 0, 'green', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'dermalogica.co.uk', '2015-12-24 06:57:27', 0, 1, '436563TRGEG', NULL, NULL, 'product', '12.00', '7.00', NULL, '33.00', NULL, 11, 5, 0, '2015-12-24 06:57:27', '2015-12-24 06:57:27', 'image', 0, 0, 'image', '680'),
(47, '9K-ZTJO-CL7S', 603, '100000613', '1', 0, 'RMT24', 1, 0, 0, 'green', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'HomeBase', '2015-12-24 06:57:27', 0, 1, '4W53VCR345 VTVR43', NULL, NULL, 'product', '12.00', '4.00', NULL, '11.00', NULL, 5, 3, 0, '2015-12-24 06:57:27', '2015-12-24 06:57:27', 'image', 0, 0, 'image', '681'),
(48, '100001010', 604, '100000614', '1', 0, 'RM24', 1, 2, 0, 'orange', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'HBSupplies.co.uk', '2015-12-24 06:58:40', 0, 0, 'qrwdadqw3231', '0000-00-00 00:00:00', NULL, 'product', '12.00', '4.00', NULL, '8.00', NULL, 3, 4, 0, '2015-12-24 06:58:40', '2015-12-24 06:58:40', 'image', 0, 0, 'image', '682'),
(49, 'FD-ONCI-HIZ0', 605, '100000615', '1', 0, 'RM24', 1, 10, 0, 'orange', 0, 'amazon', '12', 'amazon', 'amazon', 'amazon', 'Rainbowcosmatic.co.uk 	', '2015-12-24 07:03:49', 1, 1, '5634623', '0000-00-00 00:00:00', NULL, 'product', '12.00', '3.00', NULL, '9.00', NULL, 8, 3, 0, '2015-12-24 07:03:49', '2015-12-24 07:03:49', 'image', 0, 0, 'image', '683');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
