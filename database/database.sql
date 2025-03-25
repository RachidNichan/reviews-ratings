-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 10:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectrating`
--

-- --------------------------------------------------------

--
-- Table structure for table `nr_ads`
--

CREATE TABLE `nr_ads` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `code` text NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_categories`
--

CREATE TABLE `nr_categories` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `category_main_id` int(11) NOT NULL DEFAULT 0,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `english` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_categories_main`
--

CREATE TABLE `nr_categories_main` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `english` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_config`
--

CREATE TABLE `nr_config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nr_config`
--

INSERT INTO `nr_config` (`id`, `name`, `value`) VALUES
(1, 'url', 'http://localhost/Reviews-Ratings'),
(2, 'site_name', 'Reviews & Ratings Web App'),
(3, 'site_title', 'Reviews & Ratings Web App'),
(4, 'site_keywords', 'Ratings, Reviews'),
(5, 'site_description', 'Yes'),
(6, 'site_email', ''),
(7, 'default_theme', 'nichan'),
(8, 'defualt_lang', 'english'),
(9, 'user_registration', '1'),
(10, 'email_validation', '1'),
(11, 'delete_account', '1'),
(12, 'companies', '1'),
(13, 'reviews', '1'),
(14, 'smtp_or_mail', 'mail'),
(15, 'smtp_host', '1'),
(16, 'smtp_username', '1'),
(17, 'smtp_password', ''),
(18, 'smtp_port', '587'),
(19, 'smtp_encryption', 'tls');

-- --------------------------------------------------------

--
-- Table structure for table `nr_custompages`
--

CREATE TABLE `nr_custompages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `page_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_helpful`
--

CREATE TABLE `nr_helpful` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_langs`
--

CREATE TABLE `nr_langs` (
  `id` int(11) NOT NULL,
  `lang_key` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `english` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `raja` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ok` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tet` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ye` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtert` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `retreb` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `okokokok` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `russiaaa` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hkjhg` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nr_langs`
--

INSERT INTO `nr_langs` (`id`, `lang_key`, `english`, `raja`, `ok`, `tet`, `ye`, `rtert`, `retreb`, `okokokok`, `russiaaa`, `hkjhg`) VALUES
(1, 'login', 'Login', NULL, 'ok', NULL, 'english', 'Login', 'Login', 'Login', 'Login', 'Login'),
(2, 'register', 'Register', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'logout', 'Logout', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'profile', 'Profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'email', 'Email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'username', 'Username', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'password', 'Password', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'settings', 'Settings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'save', 'Save', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'review_name', 'Review name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'website_url', 'Website URL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'create', 'Create', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'please_check_details', 'Please check your details.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'name_is_required', '{name} is required', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'min_characters_length', '{name} must be a minimum of {value} characters.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'max_characters_length', '{name} must be a maximum of {value} characters.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'email_invalid_characters', 'This e-mail is invalid.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'name_already_exists', '{name} already exists.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'already_have_account', 'Already have an account?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'welcome', 'Welcome!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'username_invalid_characters', '{username} should not contain any special characters, symbols or spaces.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'incorrect_email_or_password_label', 'Incorrect email or password', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'forget_password', 'Forgot Password?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'dont_have_account', 'Don\'t have an account?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'this_url_is_invalid', 'This url is invalid.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'description', 'Description', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'skip', 'Skip', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'category', 'Category', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'categories', 'Categories', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'share', 'Share', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'reviews', 'Reviews', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'visit_this_website', 'Visit this website', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'about', 'About', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'helpful', 'Helpful', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'setting_updated', 'Setting successfully updated!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'language', 'Language', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'your_profile_picture', 'Your profile picture', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'no_reviews_yet', 'No reviews yet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'no_result_to_show', 'No result to show', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'search', 'Search', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'admin-area', 'Admin Area', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'delete', 'Delete', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'add_company', 'Add Company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'about', 'About', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'privacy_policy', 'Privacy Policy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'terms_of_use', 'Terms of Use', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nr_posts`
--

CREATE TABLE `nr_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `post_content` text NOT NULL,
  `review_id` int(11) NOT NULL DEFAULT 0,
  `rating` int(1) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `registered` varchar(32) NOT NULL DEFAULT '00/0000',
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_review`
--

CREATE TABLE `nr_review` (
  `id` int(11) NOT NULL,
  `review_user_id` int(11) NOT NULL DEFAULT 0,
  `review_username` varchar(50) NOT NULL,
  `review_name` varchar(50) NOT NULL,
  `review_url` varchar(250) NOT NULL,
  `review_category_main` int(11) NOT NULL DEFAULT 0,
  `review_category` int(11) NOT NULL DEFAULT 0,
  `review_avatar` varchar(50) NOT NULL DEFAULT 'review-default.png',
  `review_time` int(20) NOT NULL DEFAULT 0,
  `review_description` text NOT NULL,
  `review_step_info` enum('0','1') NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `registered` varchar(32) NOT NULL DEFAULT '00/0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_terms`
--

CREATE TABLE `nr_terms` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nr_terms`
--

INSERT INTO `nr_terms` (`id`, `type`, `text`) VALUES
(1, 'terms-of-use', '<p>Here is terms of use good</p>'),
(2, 'privacy-policy', '<p>Here is privacy policy best</p>'),
(3, 'about-us', '<p>Here is about great</p>');

-- --------------------------------------------------------

--
-- Table structure for table `nr_users`
--

CREATE TABLE `nr_users` (
  `id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_avatar` varchar(50) NOT NULL,
  `user_about` text NOT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `country_code` varchar(20) NOT NULL,
  `email_status` enum('0','1') NOT NULL DEFAULT '0',
  `email_code` varchar(20) NOT NULL,
  `device` varchar(20) NOT NULL,
  `browser` varchar(1000) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `registered` varchar(32) NOT NULL DEFAULT '00/0000',
  `lang_code` varchar(10) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `admin` enum('0','1','2') NOT NULL DEFAULT '0',
  `lastseen` int(32) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nr_users_session`
--

CREATE TABLE `nr_users_session` (
  `id` int(11) NOT NULL,
  `session_user_id` int(11) NOT NULL,
  `session_hash_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nr_ads`
--
ALTER TABLE `nr_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_categories`
--
ALTER TABLE `nr_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `nr_categories_main`
--
ALTER TABLE `nr_categories_main`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `nr_config`
--
ALTER TABLE `nr_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_custompages`
--
ALTER TABLE `nr_custompages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_helpful`
--
ALTER TABLE `nr_helpful`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_langs`
--
ALTER TABLE `nr_langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_posts`
--
ALTER TABLE `nr_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_review`
--
ALTER TABLE `nr_review`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `review_username` (`review_username`);

--
-- Indexes for table `nr_terms`
--
ALTER TABLE `nr_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nr_users`
--
ALTER TABLE `nr_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `nr_users_session`
--
ALTER TABLE `nr_users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nr_ads`
--
ALTER TABLE `nr_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_categories`
--
ALTER TABLE `nr_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_categories_main`
--
ALTER TABLE `nr_categories_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_config`
--
ALTER TABLE `nr_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nr_custompages`
--
ALTER TABLE `nr_custompages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_helpful`
--
ALTER TABLE `nr_helpful`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nr_langs`
--
ALTER TABLE `nr_langs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `nr_posts`
--
ALTER TABLE `nr_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_review`
--
ALTER TABLE `nr_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_terms`
--
ALTER TABLE `nr_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nr_users`
--
ALTER TABLE `nr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nr_users_session`
--
ALTER TABLE `nr_users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
