-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 07, 2022 at 06:25 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities_tbl`
--

CREATE TABLE `activities_tbl` (
  `activity_id` int(11) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `action_performed` varchar(255) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities_tbl`
--

INSERT INTO `activities_tbl` (`activity_id`, `unique_code`, `action_performed`, `performed_by`, `user_id`, `date_time`, `region`) VALUES
(1, 'qadKEr06JC', 'The supplier has created a Goods Delivery Note, ', 'Frans Modikwe', '6', '2022-06-06 12:12:42', 'Johannesburg'),
(2, '3X4GDRScBk', 'The supplier has created a Goods Delivery Note, ', 'Frans Modikwe', '6', '2022-06-06 12:14:03', 'Johannesburg'),
(3, 'pYki7AC3ZG', 'The supplier has created a Goods Delivery Note, ', 'Frans Modikwe', '6', '2022-06-06 12:16:15', 'Johannesburg'),
(4, 'Vkux3CF4ft', 'The foodbank manager has processed a Goods Delivery Note, ', 'Victor Molotsane', '7', '2022-06-06 12:34:10', 'Johannesburg'),
(5, 'ucxNDH8WLI', 'The foodbank manager has processed a Goods Delivery Note, ', 'Victor Molotsane', '7', '2022-06-06 12:57:37', 'Johannesburg'),
(6, 'aut4EAqJ0S', 'The foodbank manager has processed a Goods Delivery Note, ', 'Victor Molotsane', '7', '2022-06-06 13:27:43', 'Johannesburg'),
(7, '2PRatwnKYW', 'The foodbank manager has processed a Goods Delivery Note, ', 'Victor Molotsane', '7', '2022-06-06 13:32:48', 'Johannesburg'),
(8, '3tPK6ndO4v', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:34:25', 'Johannesburg'),
(9, 'gEXzOj0h7f', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:37:04', 'Johannesburg'),
(10, 'ktvjsLGZJu', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:37:52', 'Johannesburg'),
(11, '90YCzXW25D', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:41:51', 'Johannesburg'),
(12, '7laJ9ZcA3r', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:43:49', 'Johannesburg'),
(13, 'NtUZoRQear', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:45:48', 'Johannesburg'),
(14, 'LMTndy7Iog', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:46:08', 'Johannesburg'),
(15, 'Rl41x9jGSb', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:48:20', 'Johannesburg'),
(16, 'XfIDFlzn1g', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:49:15', 'Johannesburg'),
(17, 'tgeoTh9Hvl', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:50:05', 'Johannesburg'),
(18, 'JOPeI8cCRF', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:51:21', 'Johannesburg'),
(19, 'qlpA7JHIwC', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:56:01', 'Johannesburg'),
(20, 'P7caY36eRZ', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 13:57:03', 'Johannesburg'),
(21, '4ctginNovh', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 14:00:59', 'Johannesburg'),
(22, 'rLHxl7R8PV', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 14:04:28', 'Johannesburg'),
(23, 'hSeWu4bNR3', 'The foodbank manager has processed allocated stock to floor square, ', 'Victor Molotsane', '7', '2022-06-06 14:05:30', 'Johannesburg'),
(24, 'APWRaxM0Uu', 'The foodbank manager has created a food pack, ', 'Victor Molotsane', '7', '2022-06-06 14:18:56', 'Johannesburg');

-- --------------------------------------------------------

--
-- Table structure for table `actual_stocklevel_tbl`
--

CREATE TABLE `actual_stocklevel_tbl` (
  `stock_id` int(11) NOT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(255) DEFAULT NULL,
  `current_stock_level` varchar(255) DEFAULT NULL,
  `old_stock_level` varchar(255) DEFAULT NULL,
  `updated_stock_level` varchar(255) DEFAULT NULL,
  `update_activity` varchar(255) DEFAULT NULL,
  `update_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL,
  `unique_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actual_stocklevel_tbl`
--

INSERT INTO `actual_stocklevel_tbl` (`stock_id`, `stock_type`, `stock_name`, `current_stock_level`, `old_stock_level`, `updated_stock_level`, `update_activity`, `update_datetime`, `region`, `unique_code`) VALUES
(1, 'Dry Goods', 'Maize Meal', '1599', '800', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', '2PRatwnKYW'),
(2, 'Dry Goods', 'Rice', '1599', '800', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', '2PRatwnKYW'),
(3, 'Dry Goods', 'Sugar', '1599', '800', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', '2PRatwnKYW'),
(4, 'Dry Goods', 'Cooking Oil', '1599', '800', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', '2PRatwnKYW'),
(5, 'Dry Goods', 'Tea', '799', '0', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'ucxNDH8WLI'),
(6, 'Dry Goods', 'Baked Beans', '1599', '0', '1600', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'ucxNDH8WLI'),
(7, 'Dry Goods', 'All Purpose Soap', '799', '0', '800', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'ucxNDH8WLI'),
(8, 'Dry Goods', 'Soya Mince', '2799', '1600', '1200', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', '2PRatwnKYW'),
(9, 'Vegetables', 'Cabbage', '1599', '0', '1600', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'aut4EAqJ0S'),
(10, 'Vegetables', 'Potatoes', '1599', '0', '1600', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'aut4EAqJ0S'),
(11, 'Vegetables', 'Pumpkin', '1599', '0', '1600', 'Added Fully Stock From The Supplier', '2022-06-06 14:18:56', 'Johannesburg', 'aut4EAqJ0S'),
(12, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial Setup', '2022-05-22 13:58:26', 'Pretoria', ''),
(13, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(14, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(15, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(16, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(17, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(18, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(19, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(20, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(21, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(22, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Pretoria', ''),
(23, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial Setup', '2022-05-22 13:58:36', 'Sedibeng', ''),
(24, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(25, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(26, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(27, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(28, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(29, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(30, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(31, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(32, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(33, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Sedibeng', ''),
(34, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial Setup', '2022-05-22 13:58:46', 'West Rand', ''),
(35, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(36, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(37, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(38, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(39, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(40, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(41, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(42, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(43, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(44, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'West Rand', ''),
(45, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial Setup', '2022-05-22 13:58:53', 'Ekurhuleni', ''),
(46, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(47, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(48, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(49, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(50, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(51, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(52, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(53, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(54, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', ''),
(55, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial Setup', '2022-05-16 18:54:39', 'Ekurhuleni', '');

-- --------------------------------------------------------

--
-- Table structure for table `foodbank_stock_details_tbl`
--

CREATE TABLE `foodbank_stock_details_tbl` (
  `stockdetail_id` int(11) NOT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(255) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `stock_level_amount` varchar(255) DEFAULT NULL,
  `stock_batch_number` varchar(255) DEFAULT NULL,
  `stock_man_date` varchar(255) DEFAULT NULL,
  `stock_exp_date` varchar(255) DEFAULT NULL,
  `unique_code` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `supplier_ref` varchar(255) NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allocated` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foodbank_stock_details_tbl`
--

INSERT INTO `foodbank_stock_details_tbl` (`stockdetail_id`, `stock_type`, `stock_name`, `stock_brand`, `stock_level_amount`, `stock_batch_number`, `stock_man_date`, `stock_exp_date`, `unique_code`, `user_id`, `status`, `supplier_ref`, `create_date_time`, `allocated`, `region`, `project_name`, `delivery_month`) VALUES
(1, 'Dry Goods', 'Soya Mince', 'Knorrox', '1600', '5FR87D-9', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(2, 'Dry Goods', 'All Purpose Soap', 'Sunlight', '800', 'NONE', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(3, 'Dry Goods', 'Baked Beans', 'Koo', '1600', 'ERF769-95', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(4, 'Dry Goods', 'Tea', 'Rooibos', '800', 'RTRJF09-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(5, 'Dry Goods', 'Cooking Oil', 'Sunflower', '800', 'ERY78087-P', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(6, 'Dry Goods', 'Sugar', 'Hullet', '800', 'R43TD89-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(7, 'Dry Goods', 'Rice', 'Tastic', '800', '765DRD9-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(8, 'Dry Goods', 'Maize Meal', 'White Star', '800', '56FT4F-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(9, 'Vegetables', 'Pumpkin', 'Schalk Farm', '1600', 'NONE', '2022-05-20', '2022-07-15', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(10, 'Vegetables', 'Potatoes', 'Schalk Farm', '1600', 'NONE', '2022-05-20', '2022-07-20', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(11, 'Vegetables', 'Cabbage', 'Schalk Farm', '1600', 'NONE', '2022-05-13', '2022-08-12', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', 'allocated', 'Johannesburg', 'War On Poverty', '2022-04'),
(12, 'Dry Goods', 'Soya Mince', 'Knorrox', '1200', '5FR87D-9', '2022-04-07', '2025-02-01', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:47', 'allocated', 'Johannesburg', 'War On Poverty', '2022-05'),
(13, 'Dry Goods', 'Cooking Oil', 'Sunflower', '800', 'ERY78087-P', '2022-03-04', '2023-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', 'allocated', 'Johannesburg', 'War On Poverty', '2022-05'),
(14, 'Dry Goods', 'Sugar', 'Hullet', '800', 'R43TD89-0', '2022-04-01', '2023-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', 'allocated', 'Johannesburg', 'War On Poverty', '2022-05'),
(15, 'Dry Goods', 'Rice', 'Mzansi Rice', '800', '765DRD9-0', '2022-03-03', '2023-03-01', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', 'allocated', 'Johannesburg', 'War On Poverty', '2022-05'),
(16, 'Dry Goods', 'Maize Meal', 'White Star', '800', '56FT4F-0', '2022-03-31', '2025-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', 'allocated', 'Johannesburg', 'War On Poverty', '2022-05');

-- --------------------------------------------------------

--
-- Table structure for table `foodbank_stock_movement_tbl`
--

CREATE TABLE `foodbank_stock_movement_tbl` (
  `stockdetail_id` int(11) NOT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(255) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `stock_level_amount` varchar(255) DEFAULT NULL,
  `stock_batch_number` varchar(255) DEFAULT NULL,
  `stock_man_date` varchar(255) DEFAULT NULL,
  `stock_exp_date` varchar(255) DEFAULT NULL,
  `unique_code` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `supplier_ref` varchar(255) NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allocated` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foodbank_stock_movement_tbl`
--

INSERT INTO `foodbank_stock_movement_tbl` (`stockdetail_id`, `stock_type`, `stock_name`, `stock_brand`, `stock_level_amount`, `stock_batch_number`, `stock_man_date`, `stock_exp_date`, `unique_code`, `user_id`, `status`, `supplier_ref`, `create_date_time`, `allocated`, `region`, `project_name`, `delivery_month`) VALUES
(1, 'Dry Goods', 'Soya Mince', 'Knorrox', '1599', '5FR87D-9', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(2, 'Dry Goods', 'All Purpose Soap', 'Sunlight', '799', 'NONE', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(3, 'Dry Goods', 'Baked Beans', 'Koo', '1599', 'ERF769-95', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(4, 'Dry Goods', 'Tea', 'Rooibos', '799', 'RTRJF09-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(5, 'Dry Goods', 'Cooking Oil', 'Sunflower', '799', 'ERY78087-P', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(6, 'Dry Goods', 'Sugar', 'Hullet', '799', 'R43TD89-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(7, 'Dry Goods', 'Rice', 'Tastic', '799', '765DRD9-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(8, 'Dry Goods', 'Maize Meal', 'White Star', '799', '56FT4F-0', '2022-01-01', '2024-01-01', 'ucxNDH8WLI', '7', 'Completed', 'qadKEr06JC', '2022-06-06 12:57:37', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(9, 'Vegetables', 'Pumpkin', 'Schalk Farm', '1599', 'NONE', '2022-05-20', '2022-07-15', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(10, 'Vegetables', 'Potatoes', 'Schalk Farm', '1599', 'NONE', '2022-05-20', '2022-07-20', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(11, 'Vegetables', 'Cabbage', 'Schalk Farm', '1599', 'NONE', '2022-05-13', '2022-08-12', 'aut4EAqJ0S', '7', 'Completed', '3X4GDRScBk', '2022-06-06 13:27:43', NULL, 'Johannesburg', 'War On Poverty', '2022-04'),
(12, 'Dry Goods', 'Soya Mince', 'Knorrox', '1199', '5FR87D-9', '2022-04-07', '2025-02-01', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:47', NULL, 'Johannesburg', 'War On Poverty', '2022-05'),
(13, 'Dry Goods', 'Cooking Oil', 'Sunflower', '799', 'ERY78087-P', '2022-03-04', '2023-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', NULL, 'Johannesburg', 'War On Poverty', '2022-05'),
(14, 'Dry Goods', 'Sugar', 'Hullet', '799', 'R43TD89-0', '2022-04-01', '2023-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', NULL, 'Johannesburg', 'War On Poverty', '2022-05'),
(15, 'Dry Goods', 'Rice', 'Mzansi Rice', '799', '765DRD9-0', '2022-03-03', '2023-03-01', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', NULL, 'Johannesburg', 'War On Poverty', '2022-05'),
(16, 'Dry Goods', 'Maize Meal', 'White Star', '799', '56FT4F-0', '2022-03-31', '2025-01-02', '2PRatwnKYW', '7', 'Completed', 'pYki7AC3ZG', '2022-06-06 13:32:48', NULL, 'Johannesburg', 'War On Poverty', '2022-05');

-- --------------------------------------------------------

--
-- Table structure for table `foodpack_detail_tbl`
--

CREATE TABLE `foodpack_detail_tbl` (
  `fp_detail_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(225) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `stock_man_date` varchar(255) DEFAULT NULL,
  `stock_exp_date` varchar(255) DEFAULT NULL,
  `from_floor_space` varchar(255) DEFAULT NULL,
  `packaged_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foodpack_detail_tbl`
--

INSERT INTO `foodpack_detail_tbl` (`fp_detail_id`, `unique_code`, `stock_type`, `stock_name`, `stock_brand`, `stock_man_date`, `stock_exp_date`, `from_floor_space`, `packaged_date`, `region`, `project_name`) VALUES
(1, 'APWRaxM0Uu', 'Dry Goods', 'Maize Meal', 'White Star', '2022-01-01', '2024-01-01', 'FL_SQ_01', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(2, 'APWRaxM0Uu', 'Dry Goods', 'Rice', 'Tastic', '2022-01-01', '2024-01-01', 'FL_SQ_01', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(3, 'APWRaxM0Uu', 'Dry Goods', 'Sugar', 'Hullet', '2022-01-01', '2024-01-01', 'FL_SQ_03', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(4, 'APWRaxM0Uu', 'Dry Goods', 'Cooking Oil', 'Sunflower', '2022-01-01', '2024-01-01', 'FL_SQ_04', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(5, 'APWRaxM0Uu', 'Dry Goods', 'Tea', 'Rooibos', '2022-01-01', '2024-01-01', 'FL_SQ_03', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(6, 'APWRaxM0Uu', 'Dry Goods', 'Baked Beans', 'Koo', '2022-01-01', '2024-01-01', 'FL_SQ_04', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(7, 'APWRaxM0Uu', 'Dry Goods', 'All Purpose Soap', 'Sunlight', '2022-01-01', '2024-01-01', 'FL_SQ_04', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(8, 'APWRaxM0Uu', 'Dry Goods', 'Soya Mince', 'Knorrox', '2022-01-01', '2024-01-01', 'FL_SQ_03', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(9, 'APWRaxM0Uu', 'Vegetables', 'Cabbage', 'Schalk Farm', '2022-05-13', '2022-08-12', 'STG_RM_SQ_02', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(10, 'APWRaxM0Uu', 'Vegetables', 'Potatoes', 'Schalk Farm', '2022-05-20', '2022-07-20', 'STG_RM_SQ_01', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty'),
(11, 'APWRaxM0Uu', 'Vegetables', 'Pumpkin', 'Schalk Farm', '2022-05-20', '2022-07-15', 'STG_RM_SQ_01', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty');

-- --------------------------------------------------------

--
-- Table structure for table `packaged_foodpack_tbl`
--

CREATE TABLE `packaged_foodpack_tbl` (
  `foodpack_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `package_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pakaged_by` varchar(255) DEFAULT NULL,
  `foodpack_state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packaged_foodpack_tbl`
--

INSERT INTO `packaged_foodpack_tbl` (`foodpack_id`, `unique_code`, `region`, `project_name`, `package_date`, `pakaged_by`, `foodpack_state`) VALUES
(1, 'APWRaxM0Uu', 'Johannesburg', 'War On Poverty', '2022-06-06 14:18:56', 'Victor Molotsane', 'Food Bank');

-- --------------------------------------------------------

--
-- Table structure for table `stock_allocation_tbl`
--

CREATE TABLE `stock_allocation_tbl` (
  `allocation_id` int(11) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `stock_brand` varchar(255) NOT NULL,
  `items_qty` varchar(255) NOT NULL,
  `stock_man_date` varchar(255) NOT NULL,
  `stock_exp_date` varchar(255) NOT NULL,
  `allocated_floor_space` varchar(255) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_allocation_tbl`
--

INSERT INTO `stock_allocation_tbl` (`allocation_id`, `stock_type`, `stock_name`, `stock_brand`, `items_qty`, `stock_man_date`, `stock_exp_date`, `allocated_floor_space`, `unique_code`, `date_time`, `region`, `project_name`, `delivery_month`) VALUES
(1, 'Dry Goods', 'Soya Mince', 'Knorrox', '1599', '2022-01-01', '2024-01-01', 'FL_SQ_03', '3tPK6ndO4v', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(2, 'Dry Goods', 'All Purpose Soap', 'Sunlight', '799', '2022-01-01', '2024-01-01', 'FL_SQ_04', 'gEXzOj0h7f', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(3, 'Dry Goods', 'Baked Beans', 'Koo', '1599', '2022-01-01', '2024-01-01', 'FL_SQ_04', 'ktvjsLGZJu', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(4, 'Dry Goods', 'Tea', 'Rooibos', '799', '2022-01-01', '2024-01-01', 'FL_SQ_03', '90YCzXW25D', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(5, 'Dry Goods', 'Cooking Oil', 'Sunflower', '799', '2022-01-01', '2024-01-01', 'FL_SQ_04', '7laJ9ZcA3r', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(6, 'Dry Goods', 'Sugar', 'Hullet', '799', '2022-01-01', '2024-01-01', 'FL_SQ_03', 'NtUZoRQear', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(7, 'Dry Goods', 'Rice', 'Tastic', '799', '2022-01-01', '2024-01-01', 'FL_SQ_01', 'LMTndy7Iog', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(8, 'Dry Goods', 'Maize Meal', 'White Star', '1599', '2022-01-01', '2024-01-01', 'FL_SQ_01', 'Rl41x9jGSb', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(9, 'Vegetables', 'Pumpkin', 'Schalk Farm', '1599', '2022-05-20', '2022-07-15', 'STG_RM_SQ_01', 'XfIDFlzn1g', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(10, 'Vegetables', 'Potatoes', 'Schalk Farm', '1599', '2022-05-20', '2022-07-20', 'STG_RM_SQ_01', 'tgeoTh9Hvl', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(11, 'Vegetables', 'Cabbage', 'Schalk Farm', '1599', '2022-05-13', '2022-08-12', 'STG_RM_SQ_02', 'JOPeI8cCRF', '2022-06-06 14:18:56', 'Johannesburg', 'War On Poverty', '2022-04'),
(12, 'Dry Goods', 'Soya Mince', 'Knorrox', '1200', '2022-04-07', '2025-02-01', 'FL_SQ_04', 'qlpA7JHIwC', '2022-06-06 13:56:01', 'Johannesburg', 'War On Poverty', '2022-05'),
(13, 'Dry Goods', 'Cooking Oil', 'Sunflower', '800', '2022-03-04', '2023-01-02', 'FL_SQ_03', 'P7caY36eRZ', '2022-06-06 13:57:03', 'Johannesburg', 'War On Poverty', '2022-05'),
(14, 'Dry Goods', 'Sugar', 'Hullet', '800', '2022-04-01', '2023-01-02', 'FL_SQ_02', '4ctginNovh', '2022-06-06 14:00:59', 'Johannesburg', 'War On Poverty', '2022-05'),
(15, 'Dry Goods', 'Rice', 'Mzansi Rice', '800', '2022-03-03', '2023-03-01', 'FL_SQ_01', 'rLHxl7R8PV', '2022-06-06 14:04:28', 'Johannesburg', 'War On Poverty', '2022-05');

-- --------------------------------------------------------

--
-- Table structure for table `stock_rejected_tbl`
--

CREATE TABLE `stock_rejected_tbl` (
  `rejected_id` int(11) NOT NULL,
  `supplier_unique_code` varchar(255) DEFAULT NULL,
  `manager_unique_code` varchar(255) DEFAULT NULL,
  `supplier_delivery_date` varchar(255) DEFAULT NULL,
  `reject_reported_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(255) DEFAULT NULL,
  `rejected_amounts` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reason_of_rejection` varchar(255) DEFAULT NULL,
  `logged_by` varchar(255) DEFAULT NULL,
  `logged_by_user_id` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_rejected_tbl`
--

INSERT INTO `stock_rejected_tbl` (`rejected_id`, `supplier_unique_code`, `manager_unique_code`, `supplier_delivery_date`, `reject_reported_date`, `stock_type`, `stock_name`, `rejected_amounts`, `status`, `reason_of_rejection`, `logged_by`, `logged_by_user_id`, `project_name`, `region`, `delivery_month`) VALUES
(1, 'pYki7AC3ZG', '2PRatwnKYW', '2022-06-06 14:16:15', '2022-06-06 13:32:48', 'Dry Goods', 'Tea', '800', 'food bank rejected', '', 'Victor Molotsane', '7', 'War On Poverty', 'Johannesburg', '2022-05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_stock_details_tbl`
--

CREATE TABLE `supplier_stock_details_tbl` (
  `stockdetail_id` int(11) NOT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `stock_name` varchar(255) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `stock_level_amount` varchar(255) DEFAULT NULL,
  `stock_batch_number` varchar(255) DEFAULT NULL,
  `stock_man_date` varchar(255) DEFAULT NULL,
  `stock_exp_date` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unique_code` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_stock_details_tbl`
--

INSERT INTO `supplier_stock_details_tbl` (`stockdetail_id`, `stock_type`, `stock_name`, `stock_brand`, `stock_level_amount`, `stock_batch_number`, `stock_man_date`, `stock_exp_date`, `create_date`, `unique_code`, `user_id`, `status`, `project_name`, `region`, `delivery_month`) VALUES
(1, 'Dry Goods', 'Maize Meal', 'White Star', '800', '56FT4F-0', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(2, 'Dry Goods', 'Rice', 'Tastic', '800', '765DRD9-0', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(3, 'Dry Goods', 'Sugar', 'Hullet', '800', 'R43TD89-0', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(4, 'Dry Goods', 'Cooking Oil', 'Sunflower', '800', 'ERY78087-P', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(5, 'Dry Goods', 'Tea', 'Rooibos', '800', 'RTRJF09-0', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(6, 'Dry Goods', 'Baked Beans', 'Koo', '1600', 'ERF769-95', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(7, 'Dry Goods', 'All Purpose Soap', 'Sunlight', '800', 'NONE', '2022-01-01', '2024-01-01', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(8, 'Dry Goods', 'Soya Mince', 'Knorrox', '1600', '5FR87D-9', '2022-01-01', '2024-01-01', '2022-06-06 12:12:42', 'qadKEr06JC', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(9, 'Vegetables', 'Cabbage', 'Schalk Farm', '1600', 'NONE', '2022-05-13', '2022-08-12', '2022-06-06 12:14:03', '3X4GDRScBk', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(10, 'Vegetables', 'Potatoes', 'Schalk Farm', '1600', 'NONE', '2022-05-20', '2022-07-20', '2022-06-06 12:14:03', '3X4GDRScBk', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(11, 'Vegetables', 'Pumpkin', 'Schalk Farm', '1600', 'NONE', '2022-05-20', '2022-07-15', '2022-06-06 12:14:03', '3X4GDRScBk', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-04'),
(12, 'Dry Goods', 'Maize Meal', 'White Star', '800', '56FT4F-0', '2022-03-31', '2025-01-02', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-05'),
(13, 'Dry Goods', 'Rice', 'Mzansi Rice', '800', '765DRD9-0', '2022-03-03', '2023-03-01', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-05'),
(14, 'Dry Goods', 'Sugar', 'Hullet', '800', 'R43TD89-0', '2022-04-01', '2023-01-02', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-05'),
(15, 'Dry Goods', 'Cooking Oil', 'Sunflower', '800', 'ERY78087-P', '2022-03-04', '2023-01-02', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-05'),
(16, 'Dry Goods', 'Tea', 'Joko', '800', 'RYF564-05', '2022-03-03', '2023-02-01', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'rejected', 'War On Poverty', 'Johannesburg', '2022-05'),
(17, 'Dry Goods', 'Soya Mince', 'Knorrox', '1200', '5FR87D-9', '2022-04-07', '2025-02-01', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'complete', 'War On Poverty', 'Johannesburg', '2022-05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_stock_level_tbl`
--

CREATE TABLE `supplier_stock_level_tbl` (
  `stocklevel_id` int(11) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `stock_type` varchar(255) DEFAULT NULL,
  `est_date_of_delivery` varchar(255) DEFAULT NULL,
  `stock_status` varchar(255) DEFAULT NULL,
  `driver_full_name` varchar(255) DEFAULT NULL,
  `driver_cellphone` varchar(255) DEFAULT NULL,
  `truck_details` varchar(255) DEFAULT NULL,
  `truck_registration_num` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unique_code` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `previous_reference` varchar(255) DEFAULT NULL,
  `delivery_month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_stock_level_tbl`
--

INSERT INTO `supplier_stock_level_tbl` (`stocklevel_id`, `region`, `project_name`, `stock_type`, `est_date_of_delivery`, `stock_status`, `driver_full_name`, `driver_cellphone`, `truck_details`, `truck_registration_num`, `create_date`, `unique_code`, `user_id`, `status`, `previous_reference`, `delivery_month`) VALUES
(1, 'Johannesburg', 'War On Poverty', 'Dry Goods', '2022-06-10', 'Full Stock', 'Thato Mohono', '0825561420', 'TATA', 'DF76TFGP', '2022-06-06 12:12:41', 'qadKEr06JC', '6', 'processed', '', '2022-04'),
(2, 'Johannesburg', 'War On Poverty', 'Vegetables', '2022-06-10', 'Full Stock', 'Thato Mohono', '0825561420', 'MERCEDES BENZ', 'RD7634GP', '2022-06-06 12:14:03', '3X4GDRScBk', '6', 'processed', 'qadKEr06JC', '2022-04'),
(3, 'Johannesburg', 'War On Poverty', 'Dry Goods', '2022-06-09', 'Under Stock', 'Thato Mohono', '0825561420', 'MERCEDES BENZ', 'DF76TFGP', '2022-06-06 12:16:15', 'pYki7AC3ZG', '6', 'processed', '', '2022-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities_tbl`
--
ALTER TABLE `activities_tbl`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `actual_stocklevel_tbl`
--
ALTER TABLE `actual_stocklevel_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `foodbank_stock_details_tbl`
--
ALTER TABLE `foodbank_stock_details_tbl`
  ADD PRIMARY KEY (`stockdetail_id`);

--
-- Indexes for table `foodbank_stock_movement_tbl`
--
ALTER TABLE `foodbank_stock_movement_tbl`
  ADD PRIMARY KEY (`stockdetail_id`);

--
-- Indexes for table `foodpack_detail_tbl`
--
ALTER TABLE `foodpack_detail_tbl`
  ADD PRIMARY KEY (`fp_detail_id`);

--
-- Indexes for table `packaged_foodpack_tbl`
--
ALTER TABLE `packaged_foodpack_tbl`
  ADD PRIMARY KEY (`foodpack_id`);

--
-- Indexes for table `stock_allocation_tbl`
--
ALTER TABLE `stock_allocation_tbl`
  ADD PRIMARY KEY (`allocation_id`);

--
-- Indexes for table `stock_rejected_tbl`
--
ALTER TABLE `stock_rejected_tbl`
  ADD PRIMARY KEY (`rejected_id`);

--
-- Indexes for table `supplier_stock_details_tbl`
--
ALTER TABLE `supplier_stock_details_tbl`
  ADD PRIMARY KEY (`stockdetail_id`);

--
-- Indexes for table `supplier_stock_level_tbl`
--
ALTER TABLE `supplier_stock_level_tbl`
  ADD PRIMARY KEY (`stocklevel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities_tbl`
--
ALTER TABLE `activities_tbl`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `actual_stocklevel_tbl`
--
ALTER TABLE `actual_stocklevel_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `foodbank_stock_details_tbl`
--
ALTER TABLE `foodbank_stock_details_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `foodbank_stock_movement_tbl`
--
ALTER TABLE `foodbank_stock_movement_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `foodpack_detail_tbl`
--
ALTER TABLE `foodpack_detail_tbl`
  MODIFY `fp_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `packaged_foodpack_tbl`
--
ALTER TABLE `packaged_foodpack_tbl`
  MODIFY `foodpack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_allocation_tbl`
--
ALTER TABLE `stock_allocation_tbl`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stock_rejected_tbl`
--
ALTER TABLE `stock_rejected_tbl`
  MODIFY `rejected_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_stock_details_tbl`
--
ALTER TABLE `supplier_stock_details_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `supplier_stock_level_tbl`
--
ALTER TABLE `supplier_stock_level_tbl`
  MODIFY `stocklevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
