-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 07, 2022 at 09:56 AM
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
(1, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(2, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(3, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(4, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(5, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(6, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(7, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(8, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(9, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(10, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(11, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Johannesburg', 'initial'),
(12, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(13, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(14, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(15, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(16, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(17, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(18, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(19, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(20, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(21, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(22, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Pretoria', 'initial'),
(23, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(24, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(25, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(26, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(27, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(28, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(29, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(30, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(31, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(32, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(33, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Sedibeng', 'initial'),
(34, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(35, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(36, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(37, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(38, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(39, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(40, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(41, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(42, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(43, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(44, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'West Rand', 'initial'),
(45, 'Dry Goods', 'Maize Meal', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(46, 'Dry Goods', 'Rice', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(47, 'Dry Goods', 'Sugar', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(48, 'Dry Goods', 'Cooking Oil', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(49, 'Dry Goods', 'Tea', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(50, 'Dry Goods', 'Baked Beans', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(51, 'Dry Goods', 'All Purpose Soap', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(52, 'Dry Goods', 'Soya Mince', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(53, 'Vegetables', 'Cabbage', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(54, 'Vegetables', 'Potatoes', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial'),
(55, 'Vegetables', 'Pumpkin', '0', '0', '0', 'Initial', '2022-07-07 09:51:10', 'Ekurhuleni', 'initial');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_tbl`
--

CREATE TABLE `beneficiary_tbl` (
  `bnf_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `grant_type` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `disabled` varchar(255) DEFAULT NULL,
  `bnf_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `change_agent_tbl`
--

CREATE TABLE `change_agent_tbl` (
  `ca_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `needs` varchar(255) DEFAULT NULL,
  `highest_skills` varchar(255) DEFAULT NULL,
  `contactnumber` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `workexperience` varchar(255) DEFAULT NULL,
  `careerpath` varchar(255) DEFAULT NULL,
  `ca_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `development_officer_tbl`
--

CREATE TABLE `development_officer_tbl` (
  `dev_off_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `dev_officer_name` varchar(255) DEFAULT NULL,
  `dev_officer_cellphone` varchar(255) DEFAULT NULL,
  `nearest_stakeholder` varchar(255) DEFAULT NULL,
  `social_intervention` varchar(255) DEFAULT NULL,
  `dev_off_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `distribution_route_tbl`
--

CREATE TABLE `distribution_route_tbl` (
  `distr_route_id` int(11) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `route_gen_date` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `route_update_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `food_parcel_delivery_tbl`
--

CREATE TABLE `food_parcel_delivery_tbl` (
  `fp_dlv_id` int(11) NOT NULL,
  `foodpack_code` varchar(255) DEFAULT NULL,
  `headofhousehold_code` varchar(255) DEFAULT NULL,
  `number_of_parcels` varchar(255) DEFAULT NULL,
  `delivery_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `head_of_household_tbl`
--

CREATE TABLE `head_of_household_tbl` (
  `hoh_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `head_grant_type` varchar(255) DEFAULT NULL,
  `home_address` text,
  `ward_number` varchar(255) DEFAULT NULL,
  `ward_code` varchar(255) DEFAULT NULL,
  `suburb` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `other_help` varchar(255) DEFAULT NULL,
  `made_payment` varchar(255) DEFAULT NULL,
  `paid_who` varchar(255) DEFAULT NULL,
  `by_official` varchar(255) DEFAULT NULL,
  `specify_other` varchar(255) DEFAULT NULL,
  `hoh_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL,
  `allocated` varchar(255) DEFAULT 'new',
  `allocated_ref` varchar(255) DEFAULT NULL,
  `no_delivery_times` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `household_details_tbl`
--

CREATE TABLE `household_details_tbl` (
  `hhd_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `household_status` varchar(255) DEFAULT NULL,
  `ailments_mobilities` varchar(255) DEFAULT NULL,
  `household_affected` varchar(255) DEFAULT NULL,
  `no_sa_id` varchar(255) DEFAULT NULL,
  `no_sa_passport` varchar(255) DEFAULT NULL,
  `no_birth_certificate` varchar(255) DEFAULT NULL,
  `country_of_origin` varchar(255) DEFAULT NULL,
  `no_other_country_id` varchar(255) DEFAULT NULL,
  `no_other_country_passport` varchar(255) DEFAULT NULL,
  `household_employed` varchar(255) DEFAULT NULL,
  `school_upto_grade12` varchar(255) DEFAULT NULL,
  `people_need_skills` varchar(255) DEFAULT NULL,
  `earnings_income` varchar(255) DEFAULT NULL,
  `earnings_grant` varchar(255) DEFAULT NULL,
  `earnings_other` varchar(255) DEFAULT NULL,
  `hhd_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `non_foodbank_staff_tbl`
--

CREATE TABLE `non_foodbank_staff_tbl` (
  `nfbs_id` int(11) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `official_name` varchar(255) DEFAULT NULL,
  `referral_contact` varchar(255) DEFAULT NULL,
  `date_reffered` varchar(255) DEFAULT NULL,
  `referral_department` varchar(255) DEFAULT NULL,
  `nfbs_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `foodpack_state` varchar(255) DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'foodbank',
  `deliveredto_idnumber` varchar(255) DEFAULT NULL,
  `deliveredto_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `beneficiary_tbl`
--
ALTER TABLE `beneficiary_tbl`
  ADD PRIMARY KEY (`bnf_id`);

--
-- Indexes for table `change_agent_tbl`
--
ALTER TABLE `change_agent_tbl`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `development_officer_tbl`
--
ALTER TABLE `development_officer_tbl`
  ADD PRIMARY KEY (`dev_off_id`);

--
-- Indexes for table `distribution_route_tbl`
--
ALTER TABLE `distribution_route_tbl`
  ADD PRIMARY KEY (`distr_route_id`);

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
-- Indexes for table `food_parcel_delivery_tbl`
--
ALTER TABLE `food_parcel_delivery_tbl`
  ADD PRIMARY KEY (`fp_dlv_id`);

--
-- Indexes for table `head_of_household_tbl`
--
ALTER TABLE `head_of_household_tbl`
  ADD PRIMARY KEY (`hoh_id`);

--
-- Indexes for table `household_details_tbl`
--
ALTER TABLE `household_details_tbl`
  ADD PRIMARY KEY (`hhd_id`);

--
-- Indexes for table `non_foodbank_staff_tbl`
--
ALTER TABLE `non_foodbank_staff_tbl`
  ADD PRIMARY KEY (`nfbs_id`);

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
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `actual_stocklevel_tbl`
--
ALTER TABLE `actual_stocklevel_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `beneficiary_tbl`
--
ALTER TABLE `beneficiary_tbl`
  MODIFY `bnf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `change_agent_tbl`
--
ALTER TABLE `change_agent_tbl`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `development_officer_tbl`
--
ALTER TABLE `development_officer_tbl`
  MODIFY `dev_off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `distribution_route_tbl`
--
ALTER TABLE `distribution_route_tbl`
  MODIFY `distr_route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `foodbank_stock_details_tbl`
--
ALTER TABLE `foodbank_stock_details_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `foodbank_stock_movement_tbl`
--
ALTER TABLE `foodbank_stock_movement_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `foodpack_detail_tbl`
--
ALTER TABLE `foodpack_detail_tbl`
  MODIFY `fp_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `food_parcel_delivery_tbl`
--
ALTER TABLE `food_parcel_delivery_tbl`
  MODIFY `fp_dlv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `head_of_household_tbl`
--
ALTER TABLE `head_of_household_tbl`
  MODIFY `hoh_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `household_details_tbl`
--
ALTER TABLE `household_details_tbl`
  MODIFY `hhd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `non_foodbank_staff_tbl`
--
ALTER TABLE `non_foodbank_staff_tbl`
  MODIFY `nfbs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packaged_foodpack_tbl`
--
ALTER TABLE `packaged_foodpack_tbl`
  MODIFY `foodpack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_allocation_tbl`
--
ALTER TABLE `stock_allocation_tbl`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stock_rejected_tbl`
--
ALTER TABLE `stock_rejected_tbl`
  MODIFY `rejected_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier_stock_details_tbl`
--
ALTER TABLE `supplier_stock_details_tbl`
  MODIFY `stockdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `supplier_stock_level_tbl`
--
ALTER TABLE `supplier_stock_level_tbl`
  MODIFY `stocklevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
