-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 03:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 1, '2023-11-05 08:36:44', '2023-11-05 08:36:44'),
(3, 'Samsung', 'samsung', 1, '2023-11-05 08:37:14', '2023-11-05 08:37:14'),
(4, 'Apex', 'apex', 1, '2023-11-05 08:37:38', '2023-11-05 08:37:38'),
(5, 'Easy', 'easy', 1, '2023-11-05 08:38:05', '2023-11-05 08:38:05'),
(6, 'Sony', 'sony', 1, '2023-11-05 08:38:17', '2023-11-05 08:38:17'),
(7, 'Nivea', 'nivea', 1, '2023-11-05 08:39:29', '2023-11-05 08:39:29'),
(8, 'Bata', 'bata', 1, '2023-11-05 08:39:37', '2023-11-05 08:39:37'),
(9, 'Ponds', 'ponds', 1, '2023-11-05 08:42:27', '2023-11-05 08:42:27'),
(10, 'HP', 'hp', 1, '2023-11-05 08:50:02', '2023-11-05 08:50:02'),
(11, 'Colmi', 'colmi', 1, '2023-11-05 08:57:03', '2023-11-05 08:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `show_home` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `show_home`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', '1-1699193045.jpg', 1, 'Yes', '2023-11-05 08:04:05', '2023-11-05 08:04:05'),
(2, 'Men', 'men', '2-1699193101.jpg', 1, 'Yes', '2023-11-05 08:05:01', '2023-11-05 08:05:01'),
(3, 'Women', 'women', '3-1699193123.jpg', 1, 'Yes', '2023-11-05 08:05:23', '2023-11-05 08:05:23'),
(4, 'Baby Products', 'baby-products', '4-1699194083.jpg', 1, 'No', '2023-11-05 08:21:23', '2023-11-05 08:21:23'),
(5, 'Home Appliance', 'home-appliance', '5-1699194177.jpeg', 1, 'Yes', '2023-11-05 08:22:57', '2023-11-05 08:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `zip`, `created_at`, `updated_at`) VALUES
(1, 7, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'czcs', 'jangla', 'patuakhali', '8640', '2023-11-07 22:43:24', '2023-11-26 04:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'abcd', 'new year', NULL, 3, 2, 'fixed', 450.00, 5000.00, 1, '2023-11-09 04:42:00', '2023-11-11 04:42:00', '2023-11-09 22:43:09', '2023-11-09 23:06:06'),
(4, '333ddddd', 'puja', NULL, 32, 5, 'percent', 2.00, 7000.00, 1, '2023-11-09 09:47:00', '2023-12-11 09:47:00', '2023-11-10 03:47:42', '2023-11-10 03:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_infos`
--

CREATE TABLE `enterprise_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enterprise_infos`
--

INSERT INTO `enterprise_infos` (`id`, `country`, `city`, `street`, `zip`, `email`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 20, 'Mankato Mississippi', '711-2880 Nulla St.', '96522', 'jim@rock.com', '555-2368', '2023-11-16 05:23:16', '2023-11-16 05:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_24_031835_alter_users_table', 1),
(6, '2023_10_26_083423_create_categories_table', 1),
(7, '2023_10_28_012101_create_temp_images_table', 1),
(8, '2023_10_29_060810_create_sub_categories_table', 1),
(9, '2023_10_29_112132_create_brands_table', 1),
(10, '2023_10_30_011854_create_products_table', 1),
(11, '2023_10_30_013804_create_product_images_table', 1),
(12, '2023_11_05_014655_alter_products_table', 1),
(13, '2023_11_07_011603_alter_users_table', 2),
(14, '2023_11_08_002822_create_countries_table', 3),
(15, '2023_11_08_013119_create_orders_table', 4),
(16, '2023_11_08_013208_create_order_items_table', 4),
(17, '2023_11_08_013341_create_customer_addresses_table', 4),
(18, '2023_11_08_120332_create_shipping_charges_table', 5),
(19, '2023_11_08_120842_create_shipping_charges_table', 6),
(20, '2023_11_08_130756_create_shippings_table', 7),
(21, '2023_11_08_134243_create_shippings_table', 8),
(22, '2023_11_09_101729_create_discount_coupons_table', 9),
(23, '2023_11_11_032051_alter_orders_table', 10),
(24, '2023_11_12_020912_alter_orders_table', 11),
(25, '2023_11_13_020147_create_wishlists_table', 12),
(26, '2023_11_15_044555_alter_users_table', 13),
(27, '2023_11_15_085621_create_pages_table', 14),
(28, '2023_11_16_084747_create_enterprise_infos_table', 15),
(29, '2023_11_16_085835_create_enterprise_infos_table', 16),
(30, '2023_11_18_025159_create_product_ratings_table', 17),
(31, '2023_11_19_084043_create_payments_table', 18),
(32, '2023_11_25_023532_alter_orders_table', 19),
(33, '2023_11_25_043444_alter_orders_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid','cod') NOT NULL DEFAULT 'unpaid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `zip`, `notes`, `created_at`, `updated_at`, `session_id`) VALUES
(1, 7, 3500.00, 0.00, NULL, 0.00, 3500.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 20, 'dummy product', '65-kal road', 'patuakhali', '8640', 'my product', '2023-11-07 23:43:00', '2023-11-07 23:43:00', NULL),
(3, 7, 77900.00, 0.00, NULL, 0.00, 77900.00, '', 'pending', NULL, 'rahat', 'hossain', 'rahat@gmail.com', '01947657933', 15, 'dummy product 2', '65-kal road', 'sydeny', '8640', NULL, '2023-11-08 00:22:49', '2023-11-08 00:22:49', NULL),
(4, 7, 77900.00, 0.00, NULL, 0.00, 77900.00, '', 'pending', NULL, 'rahat', 'hossain', 'rahat@gmail.com', '01947657933', 15, 'dummy product 2', '65-kal road', 'sydeny', '8640', NULL, '2023-11-08 00:23:48', '2023-11-08 00:23:48', NULL),
(5, 7, 77900.00, 0.00, NULL, 0.00, 77900.00, '', 'pending', NULL, 'rahat', 'hossain', 'rahat@gmail.com', '01947657933', 15, 'dummy product 2', '65-kal road', 'sydeny', '8640', NULL, '2023-11-08 00:26:50', '2023-11-08 00:26:50', NULL),
(6, 7, 77900.00, 0.00, NULL, 0.00, 77900.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 8, 'dummy product', NULL, 'patuakhali', '8640', NULL, '2023-11-08 00:42:06', '2023-11-08 00:42:06', NULL),
(7, 7, 77900.00, 0.00, NULL, 0.00, 77900.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 8, 'dummy product', NULL, 'patuakhali', '8640', NULL, '2023-11-08 00:44:08', '2023-11-08 00:44:08', NULL),
(8, 7, 16040.00, 0.00, NULL, 0.00, 16040.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 8, 'dummy product', NULL, 'patuakhali', '8640', NULL, '2023-11-08 01:01:52', '2023-11-08 01:01:52', NULL),
(9, 7, 83000.00, 0.00, NULL, 0.00, 83000.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', '65-kal road', 'patuakhali', '8640', NULL, '2023-11-08 05:57:24', '2023-11-08 05:57:24', NULL),
(10, 7, 75750.00, 17776.00, NULL, 0.00, 93526.00, '', 'shipped', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 20, 'saaaaaaaaa', '65-kal road', 'patuakhali', '8640', NULL, '2023-11-09 03:33:33', '2023-11-09 03:33:33', NULL),
(11, 7, 13567.00, 13332.00, 'abcd', 450.00, 26449.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 20, 'qhichqiecbe', '65-kal road', 'patuakhali', '8640', NULL, '2023-11-10 19:35:39', '2023-11-10 19:35:39', NULL),
(12, 7, 11980.00, 22220.00, 'abcd', 450.00, 33750.00, '', 'shipped', '2023-11-14 10:10:00', 'rahat', 'hossain', 'user@example.com', '01947657933', 20, 'bfddy', '65-kal road', 'patuakhali', '8640', NULL, '2023-11-10 19:47:00', '2023-11-12 04:10:42', NULL),
(13, 7, 16040.00, 17776.00, '333ddddd', 320.80, 33495.20, '', 'cancelled', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 20, 'etwetaetg', '65-kal road', 'patuakhali', '8640', NULL, '2023-11-10 20:44:17', '2023-11-11 20:46:39', NULL),
(14, 7, 74850.00, 8888.00, NULL, 0.00, 83738.00, '', 'pending', NULL, 'rahat', 'hossain', 'rhossani@gmail.com', '01947657933', 20, 'ratnadi taltoli,manikchad', 'jangla', 'patuakhali', '8640', NULL, '2023-11-12 07:49:48', '2023-11-12 07:49:48', NULL),
(15, 7, 0.00, 0.00, NULL, 0.00, 0.00, '', 'pending', NULL, 'rahat', 'hossain', 'rhossani@gmail.com', '01947657933', 20, 'ratnadi taltoli,manikchad', 'jangla', 'patuakhali', '8640', NULL, '2023-11-12 07:50:04', '2023-11-12 07:50:04', NULL),
(16, 7, 0.00, 0.00, NULL, 0.00, 0.00, '', 'pending', NULL, 'rahat', 'hossain', 'rhossani@gmail.com', '01947657933', 20, 'ratnadi taltoli,manikchad', 'jangla', 'patuakhali', '8640', NULL, '2023-11-12 07:50:15', '2023-11-12 07:50:15', NULL),
(17, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:21:10', '2023-11-13 22:21:10', NULL),
(18, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:21:16', '2023-11-13 22:21:16', NULL),
(19, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:21:16', '2023-11-13 22:21:16', NULL),
(20, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:21:17', '2023-11-13 22:21:17', NULL),
(21, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:21:17', '2023-11-13 22:21:17', NULL),
(22, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2022-11-13 22:21:25', '2023-11-13 22:21:25', NULL),
(23, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'dummy product', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:22:08', '2023-11-13 22:22:08', NULL),
(24, 7, 148800.00, 17168.00, NULL, 0.00, 165968.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@example.com', '01947657933', 3, 'zdvzdv', 'jangla', 'patuakhali', '8640', NULL, '2023-11-13 22:24:13', '2023-11-13 22:24:13', NULL),
(25, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'ffff', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:36:55', '2023-11-19 03:36:55', NULL),
(26, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'ffff', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:36:57', '2023-11-19 03:36:57', NULL),
(27, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'ffff', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:37:16', '2023-11-19 03:37:16', NULL),
(28, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'ffff', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:37:22', '2023-11-19 03:37:22', NULL),
(29, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'xzxz', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:38:11', '2023-11-19 03:38:11', NULL),
(30, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'xzxz', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:38:13', '2023-11-19 03:38:13', NULL),
(31, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'xzxz', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:38:16', '2023-11-19 03:38:16', NULL),
(32, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'zvzdv', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:39:51', '2023-11-19 03:39:51', NULL),
(33, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'dvdsvs', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:39:56', '2023-11-19 03:39:56', NULL),
(34, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'user@gmail.com', '01947657933', 3, 'dvdsvs', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:40:17', '2023-11-19 03:40:17', NULL),
(35, 7, 10700.00, 17168.00, NULL, 0.00, 27868.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'cscsc', 'jangla', 'patuakhali', '8640', NULL, '2023-11-19 03:48:55', '2023-11-19 03:48:55', NULL),
(36, 7, 40800.00, 68672.00, NULL, 0.00, 109472.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'zsccSC', 'jangla', 'patuakhali', '8640', NULL, '2023-11-21 19:49:33', '2023-11-21 19:49:33', NULL),
(37, 7, 0.00, 0.00, NULL, 0.00, 0.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'zsccSC', 'jangla', 'patuakhali', '8640', NULL, '2023-11-21 19:49:40', '2023-11-21 19:49:40', NULL),
(38, 7, 15300.00, 25752.00, NULL, 0.00, 41052.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'axax', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 03:03:36', '2023-11-24 03:03:36', NULL),
(39, 7, 15300.00, 25752.00, NULL, 0.00, 41052.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'axax', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 03:03:38', '2023-11-24 03:03:38', NULL),
(40, 7, 15300.00, 25752.00, NULL, 0.00, 41052.00, '', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'axax', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 03:03:46', '2023-11-24 03:03:46', NULL),
(41, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'ssss', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 22:36:44', '2023-11-24 22:36:44', 'cs_test_b1G3hNnNES9amcnuJC2KWdKSmtbWFWHHF4Qa9BSmqI3a67kCXB4IlP1fNd'),
(42, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'cca j h', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 22:38:52', '2023-11-24 22:38:52', 'cs_test_b1riNC3haUt9dX76HyW2oo4dLfTrMgCHQYJIByTk9yaihlU51Av4p0SRAh'),
(43, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'cca j h', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 22:46:54', '2023-11-24 22:46:54', 'cs_test_b1x3nO7hkgOvK4I8srDeiMFJyI260JUe2CZHWAQMTJoox1SnR0hcG3dW2x'),
(44, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'zzxc', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 23:01:08', '2023-11-24 23:01:08', 'cs_test_b1vDIZtSgOTmZFqbYrcXMF2GZe9RJ42wztyszAZHRL3d1ATXCHtAyfn67o'),
(45, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'jhv', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 23:14:25', '2023-11-24 23:14:25', 'cs_test_b1zEdQyckSJHA9cn2T0ei5oV1DMpWzEpl0VQPp9EI6BSufOTGwdLXme1s3'),
(46, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'jhv', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 23:14:47', '2023-11-24 23:14:47', 'cs_test_b1uR9pCCPTYXWYMd6HR2WinZwLHMrcssuAaGmbWAxcEoyIm2aDV9CwhXb0'),
(47, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'hhhh', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 23:15:45', '2023-11-24 23:15:45', 'cs_test_b1XnGzjdfhlSIbSUfomlRZGooIbQDUH4N6XiDympOIXx0PUTgNLq412dMD'),
(48, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'hhhh', 'jangla', 'patuakhali', '8640', NULL, '2023-11-24 23:15:56', '2023-11-24 23:15:56', 'cs_test_b1cGYyJeRohgxW8Tu1XWXcg0TVItnnPbILF9GGpmroZB69Irs60gA76n0G'),
(49, 7, 23601.00, 42920.00, NULL, 0.00, 66521.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'xzxc', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 03:24:18', '2023-11-25 03:24:18', 'cs_test_b1Nctz9LeZ0AlOsJbfm9pLjQovt1MicPdu8RvMUSqCp2JTFFeIjr73VZBV'),
(50, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'zx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 03:25:56', '2023-11-25 03:25:56', 'cs_test_b1E4GhjbVobxJKnN9d7Ied4kQSrcZIksYMPbzrSNGgk6wQXyydWhCHQGRB'),
(51, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'zxczc', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:14:02', '2023-11-25 04:14:02', 'cs_test_b1cIUyfEZktqpmKvg5u15trCW5hMwKXg1LlFSaqSGAiKVQsANeLUN6yCpp'),
(52, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'dsdfd', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:20:30', '2023-11-25 04:20:30', 'cs_test_b16YptSnqLiOoOGLsr77gyVoUWaXvNmQersc0mNg2Fxs6XtSkgfCUqhdI2'),
(53, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'asfasf', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:22:50', '2023-11-25 04:22:50', 'cs_test_b1gwhsGuLMyak6mMXvp0Edt80uLPO5d8AAXK9IkRhjOkxzoPiYENWHGail'),
(54, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'gsg', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:25:39', '2023-11-25 04:25:39', 'cs_test_b1v35L4AU3YdXASWnFIlgBqitrRx18FmpjlbpF2utY0ZYJxqEBFnKv7sb7'),
(55, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'dxcx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:44:17', '2023-11-25 04:44:17', 'cs_test_b1FlslZClDxi12Ztmou5mRs3ZgsatUng2WydiCYVYL1GHiwEPV5Ip1yNq5'),
(56, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'dxcx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:46:47', '2023-11-25 04:46:47', 'cs_test_b1frxB86g9oWB9YLmvQYrTWnBrb0c9rPa1hl7Iq5IUtobyFFmM5DFZGcuf'),
(57, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'xzxX', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:48:01', '2023-11-25 04:48:01', 'cs_test_b1lSjc6wjrpJeR8OZ2g9kYLOfhwQU9xcvW9hDnRJv2OtbWQOTATwzcfKd9'),
(58, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'vzxzx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:50:23', '2023-11-25 04:50:23', 'cs_test_b1NLrEWiXr7tj1moKMP10NcMuIXRpzrV1daCQfXzAlisePprd9ParUkg9Z'),
(59, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'vzxzx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:50:25', '2023-11-25 04:50:25', 'cs_test_b1RECHg6McsE4u9Mlueds1j82StvRvAe4odO09hqc5vPKBpwQo9E3d1wn6'),
(60, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, '123', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:55:43', '2023-11-25 04:55:43', 'cs_test_b1nVYGLlmaPdMvUqFoDGiGHPgMEfnFEvsYxSXo4BIipaQjOVp9hrC82cZz'),
(61, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'cxx', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 04:58:07', '2023-11-25 05:00:00', 'cs_test_b1v6lVR9E04Bsng94rAyqeUBTYP3GwvNUG5lC2jJZLpOKeO4Dpp1sY7Qbb'),
(62, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'df s fa', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 05:00:45', '2023-11-25 05:01:01', 'cs_test_b1hpfHTuo18gVzvU5rfDRWdIOuix79gHceezvnJk7qlFZzcPnltiNeBCoY'),
(63, 7, 87801.00, 34336.00, NULL, 0.00, 122137.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'df s fa', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 05:02:11', '2023-11-25 05:02:26', 'cs_test_b16qYmnRYZAxvgt6ebNWF3ogzIELW7pAOyD95vYM7jOr9P2LungjYvvDP7'),
(64, 7, 78867.00, 17168.00, NULL, 0.00, 96035.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'asfsfas', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:07:20', '2023-11-25 21:07:41', 'cs_test_b1Dgc0wffJw94RD01ncAObWtt7V4YMcx0uJ2pkQXNbOD4CgljnVNjQXK0W'),
(65, 7, 74400.00, 8584.00, NULL, 0.00, 82984.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'asadw', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:09:11', '2023-11-25 21:09:28', 'cs_test_a1kq2DJ3IzC4QRRXVnsPVSVdhSDR6wvNwqLITWt17v1oDPrlJYOgU9Xded'),
(66, 7, 74400.00, 8584.00, NULL, 0.00, 82984.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'cC', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:12:46', '2023-11-25 21:12:46', 'cs_test_a1XGYK2Fuol9ncUUbUkjv5HtNxrCxqzG1yHbP2qyXuC0xMaT88IfO2GbRe'),
(67, 7, 74400.00, 8584.00, NULL, 0.00, 82984.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'DSDS', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:20:00', '2023-11-25 21:20:00', NULL),
(68, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'xxcz', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:39:58', '2023-11-25 21:39:58', NULL),
(69, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'fFEWEG', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:47:23', '2023-11-25 21:47:23', NULL),
(70, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'fFEWEG', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:47:51', '2023-11-25 21:47:51', 'cs_test_b1o17LIAVwW10X8VEkDRQk4m6SBqGi1Bygta5SUJ4QBkHKbg4ICfCGLU7P'),
(71, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'HJBJ', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:49:05', '2023-11-25 21:49:05', NULL),
(72, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'jjjj', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:49:56', '2023-11-25 21:49:56', NULL),
(73, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'ddd', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:51:24', '2023-11-25 21:51:24', NULL),
(74, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'unpaid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'ddd', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:51:55', '2023-11-25 21:51:55', 'cs_test_b1ZpROuph9fqvvu68hydLWeJ2sN1aBw7SW8HfpQYHse2W3p5TNph90ZHKI'),
(75, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'ddd', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:52:23', '2023-11-25 21:52:23', NULL),
(76, 7, 78200.00, 17168.00, NULL, 0.00, 95368.00, 'cod', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'fff', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 21:56:49', '2023-11-25 21:56:49', NULL),
(77, 7, 19434.00, 42920.00, '333ddddd', 388.68, 61965.32, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'bhhh', 'jangla', 'patuakhali', '8640', NULL, '2023-11-25 22:00:26', '2023-11-25 22:00:44', 'cs_test_b1oFpA3ugrYovRTUlrKQwtBDr7Ivr2wbsDVwRJYspK31pwwGqFbVvTmSnZ'),
(78, 7, 80000.00, 17168.00, NULL, 0.00, 97168.00, 'paid', 'pending', NULL, 'rahat', 'hossain', 'usercheck@gmail.com', '01947657933', 3, 'czcs', 'jangla', 'patuakhali', '8640', NULL, '2023-11-26 04:13:59', '2023-11-26 04:14:55', 'cs_test_b13LQkOTVMTEIiXLXup9cNFNPyBLymyEZcAXV73ADe73XU5NIb68pMvo2z');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 5, 7, 'Bata Sylist Bag', 1, 3500.00, 3500.00, '2023-11-08 00:26:50', '2023-11-08 00:26:50'),
(2, 5, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-08 00:26:50', '2023-11-08 00:26:50'),
(3, 6, 7, 'Bata Sylist Bag', 1, 3500.00, 3500.00, '2023-11-08 00:42:06', '2023-11-08 00:42:06'),
(4, 6, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-08 00:42:06', '2023-11-08 00:42:06'),
(5, 7, 7, 'Bata Sylist Bag', 1, 3500.00, 3500.00, '2023-11-08 00:44:08', '2023-11-08 00:44:08'),
(6, 7, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-08 00:44:08', '2023-11-08 00:44:08'),
(7, 8, 8, 'Apex Lossy Bag', 3, 5100.00, 15300.00, '2023-11-08 01:01:52', '2023-11-08 01:01:52'),
(8, 8, 2, 'Ponds Whitening Cream', 1, 740.00, 740.00, '2023-11-08 01:01:52', '2023-11-08 01:01:52'),
(9, 9, 7, 'Bata Sylist Bag', 1, 3500.00, 3500.00, '2023-11-08 05:57:24', '2023-11-08 05:57:24'),
(10, 9, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-08 05:57:24', '2023-11-08 05:57:24'),
(11, 9, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-08 05:57:24', '2023-11-08 05:57:24'),
(12, 10, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-09 03:33:33', '2023-11-09 03:33:33'),
(13, 10, 1, 'Ponds Deep Clean', 3, 450.00, 1350.00, '2023-11-09 03:33:33', '2023-11-09 03:33:33'),
(14, 11, 7, 'Bata Sylist Bag', 1, 3500.00, 3500.00, '2023-11-10 19:35:39', '2023-11-10 19:35:39'),
(15, 11, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-10 19:35:39', '2023-11-10 19:35:39'),
(16, 11, 5, 'Samsung H1 Watch', 1, 4467.00, 4467.00, '2023-11-10 19:35:39', '2023-11-10 19:35:39'),
(17, 12, 7, 'Bata Sylist Bag', 3, 3500.00, 10500.00, '2023-11-10 19:47:00', '2023-11-10 19:47:00'),
(18, 12, 2, 'Ponds Whitening Cream', 2, 740.00, 1480.00, '2023-11-10 19:47:00', '2023-11-10 19:47:00'),
(19, 13, 2, 'Ponds Whitening Cream', 1, 740.00, 740.00, '2023-11-10 20:44:17', '2023-11-10 20:44:17'),
(20, 13, 8, 'Apex Lossy Bag', 3, 5100.00, 15300.00, '2023-11-10 20:44:17', '2023-11-10 20:44:17'),
(21, 14, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-12 07:49:48', '2023-11-12 07:49:48'),
(22, 14, 1, 'Ponds Deep Clean', 1, 450.00, 450.00, '2023-11-12 07:49:48', '2023-11-12 07:49:48'),
(23, 17, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:10', '2023-11-13 22:21:10'),
(24, 18, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:16', '2023-11-13 22:21:16'),
(25, 19, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:16', '2023-11-13 22:21:16'),
(26, 20, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:17', '2023-11-13 22:21:17'),
(27, 21, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:17', '2023-11-13 22:21:17'),
(28, 22, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:21:25', '2023-11-13 22:21:25'),
(29, 23, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:22:08', '2023-11-13 22:22:08'),
(30, 24, 3, 'HP pavilion 15', 2, 74400.00, 148800.00, '2023-11-13 22:24:13', '2023-11-13 22:24:13'),
(31, 25, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:36:55', '2023-11-19 03:36:55'),
(32, 25, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:36:55', '2023-11-19 03:36:55'),
(33, 26, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:36:57', '2023-11-19 03:36:57'),
(34, 26, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:36:57', '2023-11-19 03:36:57'),
(35, 27, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:37:16', '2023-11-19 03:37:16'),
(36, 27, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:37:16', '2023-11-19 03:37:16'),
(37, 28, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:37:22', '2023-11-19 03:37:22'),
(38, 28, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:37:23', '2023-11-19 03:37:23'),
(39, 29, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:38:11', '2023-11-19 03:38:11'),
(40, 29, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:38:11', '2023-11-19 03:38:11'),
(41, 30, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:38:13', '2023-11-19 03:38:13'),
(42, 30, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:38:13', '2023-11-19 03:38:13'),
(43, 31, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:38:16', '2023-11-19 03:38:16'),
(44, 31, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:38:16', '2023-11-19 03:38:16'),
(45, 32, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:39:51', '2023-11-19 03:39:51'),
(46, 32, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:39:51', '2023-11-19 03:39:51'),
(47, 33, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:39:56', '2023-11-19 03:39:56'),
(48, 33, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:39:56', '2023-11-19 03:39:56'),
(49, 34, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:40:17', '2023-11-19 03:40:17'),
(50, 34, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:40:17', '2023-11-19 03:40:17'),
(51, 35, 8, 'Apex Lossy Bag', 1, 5100.00, 5100.00, '2023-11-19 03:48:55', '2023-11-19 03:48:55'),
(52, 35, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-19 03:48:55', '2023-11-19 03:48:55'),
(53, 36, 8, 'Apex Lossy Bag', 8, 5100.00, 40800.00, '2023-11-21 19:49:33', '2023-11-21 19:49:33'),
(54, 38, 8, 'Apex Lossy Bag', 3, 5100.00, 15300.00, '2023-11-24 03:03:36', '2023-11-24 03:03:36'),
(55, 39, 8, 'Apex Lossy Bag', 3, 5100.00, 15300.00, '2023-11-24 03:03:38', '2023-11-24 03:03:38'),
(56, 40, 8, 'Apex Lossy Bag', 3, 5100.00, 15300.00, '2023-11-24 03:03:46', '2023-11-24 03:03:46'),
(57, 49, 8, 'Apex Lossy Bag', 2, 5100.00, 10200.00, '2023-11-25 03:24:18', '2023-11-25 03:24:18'),
(58, 49, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 03:24:18', '2023-11-25 03:24:18'),
(59, 50, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 03:25:56', '2023-11-25 03:25:56'),
(60, 50, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 03:25:56', '2023-11-25 03:25:56'),
(61, 51, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:14:02', '2023-11-25 04:14:02'),
(62, 51, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:14:02', '2023-11-25 04:14:02'),
(63, 52, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:20:30', '2023-11-25 04:20:30'),
(64, 52, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:20:30', '2023-11-25 04:20:30'),
(65, 53, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:22:50', '2023-11-25 04:22:50'),
(66, 53, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:22:50', '2023-11-25 04:22:50'),
(67, 54, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:25:39', '2023-11-25 04:25:39'),
(68, 54, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:25:39', '2023-11-25 04:25:39'),
(69, 55, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:44:17', '2023-11-25 04:44:17'),
(70, 55, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:44:17', '2023-11-25 04:44:17'),
(71, 56, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:46:47', '2023-11-25 04:46:47'),
(72, 56, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:46:47', '2023-11-25 04:46:47'),
(73, 57, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:48:01', '2023-11-25 04:48:01'),
(74, 57, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:48:01', '2023-11-25 04:48:01'),
(75, 58, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:50:23', '2023-11-25 04:50:23'),
(76, 58, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:50:23', '2023-11-25 04:50:23'),
(77, 59, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:50:25', '2023-11-25 04:50:25'),
(78, 59, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:50:25', '2023-11-25 04:50:25'),
(79, 60, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:55:43', '2023-11-25 04:55:43'),
(80, 60, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:55:43', '2023-11-25 04:55:43'),
(81, 61, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 04:58:07', '2023-11-25 04:58:07'),
(82, 61, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 04:58:07', '2023-11-25 04:58:07'),
(83, 62, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 05:00:45', '2023-11-25 05:00:45'),
(84, 62, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 05:00:45', '2023-11-25 05:00:45'),
(85, 63, 5, 'Samsung H1 Watch', 3, 4467.00, 13401.00, '2023-11-25 05:02:11', '2023-11-25 05:02:11'),
(86, 63, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 05:02:11', '2023-11-25 05:02:11'),
(87, 64, 5, 'Samsung H1 Watch', 1, 4467.00, 4467.00, '2023-11-25 21:07:20', '2023-11-25 21:07:20'),
(88, 64, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:07:20', '2023-11-25 21:07:20'),
(89, 65, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:09:11', '2023-11-25 21:09:11'),
(90, 66, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:12:46', '2023-11-25 21:12:46'),
(91, 67, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:20:00', '2023-11-25 21:20:00'),
(92, 68, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:39:58', '2023-11-25 21:39:58'),
(93, 68, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:39:58', '2023-11-25 21:39:58'),
(94, 69, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:47:23', '2023-11-25 21:47:23'),
(95, 69, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:47:23', '2023-11-25 21:47:23'),
(96, 70, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:47:51', '2023-11-25 21:47:51'),
(97, 70, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:47:51', '2023-11-25 21:47:51'),
(98, 71, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:49:05', '2023-11-25 21:49:05'),
(99, 71, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:49:05', '2023-11-25 21:49:05'),
(100, 72, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:49:56', '2023-11-25 21:49:56'),
(101, 72, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:49:56', '2023-11-25 21:49:56'),
(102, 73, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:51:24', '2023-11-25 21:51:24'),
(103, 73, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:51:24', '2023-11-25 21:51:24'),
(104, 74, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:51:55', '2023-11-25 21:51:55'),
(105, 74, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:51:55', '2023-11-25 21:51:55'),
(106, 75, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:52:23', '2023-11-25 21:52:23'),
(107, 75, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:52:23', '2023-11-25 21:52:23'),
(108, 76, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-25 21:56:49', '2023-11-25 21:56:49'),
(109, 76, 4, 'Colmi F2 Watch', 1, 3800.00, 3800.00, '2023-11-25 21:56:49', '2023-11-25 21:56:49'),
(110, 77, 5, 'Samsung H1 Watch', 2, 4467.00, 8934.00, '2023-11-25 22:00:26', '2023-11-25 22:00:26'),
(111, 77, 7, 'Bata Sylist Bag', 3, 3500.00, 10500.00, '2023-11-25 22:00:26', '2023-11-25 22:00:26'),
(112, 78, 6, 'Apex Leather Bag', 1, 5600.00, 5600.00, '2023-11-26 04:13:59', '2023-11-26 04:13:59'),
(113, 78, 3, 'HP pavilion 15', 1, 74400.00, 74400.00, '2023-11-26 04:13:59', '2023-11-26 04:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(3, 'Terms & Conditions', 'terms-conditions', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span>', '2023-11-15 06:33:32', '2023-11-15 06:42:09'),
(4, 'Contact Us', 'contact-us', '<p style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(0, 29, 61); font-family: Poppins; background-color: rgb(241, 241, 241);\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p><address style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(0, 29, 61); font-family: Poppins; background-color: rgb(241, 241, 241);\"><br></address>', '2023-11-15 06:33:46', '2023-11-16 05:29:11'),
(5, 'About Us', 'about-us', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span><br></p>', '2023-11-15 06:34:01', '2023-11-15 06:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `related_products` varchar(255) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `short_description`, `description`, `shipping_returns`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `related_products`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ponds Deep Clean', 'ponds-deep-clean', NULL, NULL, NULL, 450.00, 500.00, 3, 7, 9, 'Yes', '2', 'SKU-453', NULL, 'Yes', 55, 1, '2023-11-05 08:45:02', '2023-11-05 08:47:37'),
(2, 'Ponds Whitening Cream', 'ponds-whitening-cream', NULL, NULL, NULL, 740.00, 800.00, 3, 7, 9, 'Yes', '1', 'SKU-4535', NULL, 'Yes', 34, 1, '2023-11-05 08:48:43', '2023-11-05 08:48:43'),
(3, 'HP pavilion 15', 'hp-pavilion-15', NULL, NULL, NULL, 74400.00, 79000.00, 1, 2, 10, 'Yes', NULL, 'SKU-423', NULL, 'Yes', -12, 1, '2023-11-05 08:51:17', '2023-11-26 04:13:59'),
(4, 'Colmi F2 Watch', 'colmi-f2-watch', NULL, NULL, NULL, 3800.00, 4000.00, 1, 6, 11, 'No', '5', 'SKU-123', NULL, 'Yes', 14, 1, '2023-11-05 08:58:25', '2023-11-25 21:56:49'),
(5, 'Samsung H1 Watch', 'samsung-h1-watch', NULL, NULL, NULL, 4467.00, 66666.00, 1, 6, 3, 'No', '4', 'SKU-4678', NULL, 'Yes', 17, 1, '2023-11-05 08:59:44', '2023-11-25 22:00:26'),
(6, 'Apex Leather Bag', 'apex-leather-bag', NULL, NULL, NULL, 5600.00, NULL, 3, 8, 4, 'Yes', '', 'SKU-734', NULL, 'Yes', -12, 1, '2023-11-05 19:13:52', '2023-11-26 04:13:59'),
(7, 'Bata Sylist Bag', 'bata-sylist-bag', NULL, NULL, NULL, 3500.00, 4000.00, 3, 8, 8, 'Yes', '6', 'SKU-967', NULL, 'Yes', 10, 1, '2023-11-05 20:36:47', '2023-11-25 22:00:26'),
(8, 'Apex Lossy Bag', 'apex-lossy-bag', 'Are satchel bags in style 2023? The Spring/Summer 2023 Handbag Trends to Know and Shop Now ... When shopping for a new bag this season, there are a few overarching themes that make up the most noteworthy spring/summer 2023 handbag trends. For starters, you can\'t go wrong with something roomy and soft or an updated style in a classic shape—think crossbody satchels, baguettes, and buckets', '<font face=\"Google Sans, arial, sans-serif\">Are satchel bags in style 2023? The Spring/Summer 2023 Handbag Trends to Know and Shop Now ... When shopping for a new bag this season, there are a few overarching themes that make up the most noteworthy spring/summer 2023 handbag trends. For starters, you can\'t go wrong with something roomy and soft or an updated style in a classic shape—think crossbody satchels, baguettes, and buckets</font>', 'Are satchel bags in style 2023? The Spring/Summer 2023 Handbag Trends to Know and Shop Now ... When shopping for a new bag this season, there are a few overarching themes that make up the most noteworthy spring/summer 2023 handbag trends. For starters, you can\'t go wrong with something roomy and soft or an updated style in a classic shape—think crossbody satchels, baguettes, and buckets', 5100.00, 6000.00, 3, 8, 4, 'Yes', '6,7', 'SKU-444', NULL, 'Yes', 15, 1, '2023-11-05 20:42:14', '2023-11-25 03:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '1-1-1699195657.jpeg', NULL, '2023-11-05 08:47:37', '2023-11-05 08:47:37'),
(2, 2, '2-2-1699195723.jpeg', NULL, '2023-11-05 08:48:43', '2023-11-05 08:48:43'),
(3, 3, '3-3-1699195877.jpeg', NULL, '2023-11-05 08:51:17', '2023-11-05 08:51:17'),
(11, 5, '5-11-1699196573.jpeg', NULL, '2023-11-05 09:02:53', '2023-11-05 09:02:53'),
(12, 4, '4-12-1699196672.jpeg', NULL, '2023-11-05 09:04:32', '2023-11-05 09:04:32'),
(13, 6, '6-13-1699233232.jpeg', NULL, '2023-11-05 19:13:52', '2023-11-05 19:13:52'),
(15, 7, '7-15-1699238207.jpeg', NULL, '2023-11-05 20:36:47', '2023-11-05 20:36:47'),
(16, 8, '8-16-1699238572.jpeg', NULL, '2023-11-05 20:42:52', '2023-11-05 20:42:52'),
(17, 8, '8-17-1699238572.jpeg', NULL, '2023-11-05 20:42:52', '2023-11-05 20:42:52'),
(18, 8, '8-18-1699238572.jpg', NULL, '2023-11-05 20:42:52', '2023-11-05 20:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Md Rahat Hossain', 'user@example.com', 'nice product', 4.00, 0, '2023-11-17 22:26:24', '2023-11-17 22:26:24'),
(2, 3, 'Md Rahat Hossain', 'jim@rock.com', 'nice I went with the blue model for my new apartment and an very pleased with the purchase. I\'m definitely someone not used to paying this much for furniture, and I am also anxious about buying online, but I am very happy with the quality of this couch. For me, it is the perfect mix of cushy firmness, and it arrived defect free. It really is well made and hopefully will be my main couch for a long time. I paid for the extra delivery & box removal, and had an excellent experience as well. I do tend move my own furniture, but with an online purchase this expensive, t', 5.00, 0, '2023-11-17 22:39:52', '2023-11-17 22:39:52'),
(3, 3, 'kavin', 'kavin@gmail.com', 'product is authentc I went with the blue model for my new apartment and an very pleased with the purchase. I\'m definitely someone not used to paying this much for furniture, and I am also anxious about buying online, but I am very happy with the quality of this couch. For me, it is the per', 3.00, 0, '2023-11-17 23:31:08', '2023-11-17 23:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(8, '3', 8584.00, '2023-11-08 22:38:30', '2023-11-08 22:38:30'),
(9, '6', 8351.00, '2023-11-08 22:38:40', '2023-11-08 22:38:40'),
(10, '104', 1111.00, '2023-11-08 22:38:57', '2023-11-08 22:38:57'),
(11, 'rest_of_world', 5555.00, '2023-11-09 03:23:01', '2023-11-09 03:23:01'),
(12, '20', 4444.00, '2023-11-09 03:32:46', '2023-11-09 03:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `show_home` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `category_id`, `show_home`, `created_at`, `updated_at`) VALUES
(1, 'Jacket', 'jacket', '1', 2, 'No', '2023-11-05 08:28:00', '2023-11-05 08:28:00'),
(2, 'Laptop', 'laptop', '1', 1, 'No', '2023-11-05 08:28:37', '2023-11-05 08:28:37'),
(3, 'Refregerator', 'refregerator', '1', 5, 'No', '2023-11-05 08:33:33', '2023-11-05 08:33:33'),
(4, 'Mobile', 'mobile', '1', 1, 'No', '2023-11-05 08:34:21', '2023-11-05 08:34:21'),
(5, 'Shoes', 'shoes', '1', 2, 'No', '2023-11-05 08:35:02', '2023-11-05 08:35:02'),
(6, 'Watch', 'watch', '1', 1, 'No', '2023-11-05 08:36:15', '2023-11-05 08:36:15'),
(7, 'Face Watch', 'face-watch', '1', 3, 'No', '2023-11-05 08:43:26', '2023-11-05 08:43:26'),
(8, 'Hand Bag', 'hand-bag', '1', 3, 'No', '2023-11-05 19:12:02', '2023-11-05 19:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(6, '1699195652.jpeg', '2023-11-05 08:47:32', '2023-11-05 08:47:32'),
(7, '1699195702.jpeg', '2023-11-05 08:48:22', '2023-11-05 08:48:22'),
(8, '1699195767.jpeg', '2023-11-05 08:49:27', '2023-11-05 08:49:27'),
(9, '1699195782.jpeg', '2023-11-05 08:49:42', '2023-11-05 08:49:42'),
(10, '1699195848.jpeg', '2023-11-05 08:50:48', '2023-11-05 08:50:48'),
(11, '1699196275.jpeg', '2023-11-05 08:57:55', '2023-11-05 08:57:55'),
(12, '1699196359.jpeg', '2023-11-05 08:59:19', '2023-11-05 08:59:19'),
(13, '1699196441.jpeg', '2023-11-05 09:00:41', '2023-11-05 09:00:41'),
(14, '1699196510.jpeg', '2023-11-05 09:01:50', '2023-11-05 09:01:50'),
(15, '1699196560.jpeg', '2023-11-05 09:02:40', '2023-11-05 09:02:40'),
(16, '1699196600.jpeg', '2023-11-05 09:03:20', '2023-11-05 09:03:20'),
(17, '1699196666.jpeg', '2023-11-05 09:04:26', '2023-11-05 09:04:26'),
(18, '1699196770.jpeg', '2023-11-05 09:06:10', '2023-11-05 09:06:10'),
(19, '1699233157.jpeg', '2023-11-05 19:12:37', '2023-11-05 19:12:37'),
(20, '1699238176.jpeg', '2023-11-05 20:36:16', '2023-11-05 20:36:16'),
(21, '1699238559.jpeg', '2023-11-05 20:42:39', '2023-11-05 20:42:39'),
(22, '1699238563.jpeg', '2023-11-05 20:42:43', '2023-11-05 20:42:43'),
(23, '1699238567.jpg', '2023-11-05 20:42:47', '2023-11-05 20:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, 2, 1, NULL, '$2y$10$hOBU8uv/F9E7uCnBcR7dUeoQctEjByJdY8CgIgAA6Nze0XNPHN7YO', NULL, '2023-11-05 07:42:06', '2023-11-16 00:59:52'),
(7, 'Rahat hossain', 'rahathossain@gmail.com', '01947657933', 1, 1, NULL, '$2y$10$Gek29YVdUon.DRBqmGMw8unZjLC7j3kEkNQl2bhfz6dEkO.7Debbm', NULL, '2023-11-07 04:44:35', '2023-11-16 22:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(23, 7, 6, '2023-11-13 08:05:45', '2023-11-13 08:05:45'),
(24, 7, 4, '2023-11-13 08:08:43', '2023-11-13 08:08:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprise_infos`
--
ALTER TABLE `enterprise_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enterprise_infos_country_foreign` (`country`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enterprise_infos`
--
ALTER TABLE `enterprise_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enterprise_infos`
--
ALTER TABLE `enterprise_infos`
  ADD CONSTRAINT `enterprise_infos_country_foreign` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
