-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2015 at 06:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(2, 'Latest Videos', '', '', 'site/viewlatestvideos', 1, 0, 1, 2, 'icon-dashboard'),
(3, 'Picked Videos', '', '', 'site/viewpickedvideos', 1, 0, 1, 3, 'icon-dashboard'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(5, 'Events', '', '', 'site/viewevents', 1, 0, 1, 4, 'icon-dashboard'),
(6, 'Blogs', '', '', 'site/viewblogs', 1, 0, 1, 5, 'icon-dashboard'),
(7, 'Photo Gallery Category', '', '', 'site/viewphotogallerycategory', 1, 0, 1, 6, 'icon-dashboard'),
(8, 'Video Gallery Category', '', '', 'site/viewvideogallerycategory', 1, 0, 1, 7, 'icon-dashboard'),
(9, 'Notification', '', '', 'site/viewnotification', 1, 0, 1, 8, 'icon-dashboard'),
(10, 'Feedback', '', '', 'site/viewfeedback', 1, 0, 1, 9, 'icon-dashboard'),
(11, 'Enquiry', '', '', 'site/viewenquiry', 1, 0, 1, 10, 'icon-dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `forgotpassword` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `address`, `contact`, `dob`, `street`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `website`, `forgotpassword`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', '1', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', '0', '0', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', '0', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 2, '2014-12-03 11:06:19', 3, '', '', '123', '1', 'demojson', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(13, 'aaa', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 3, '2014-12-04 06:55:42', 3, NULL, '', '1', '2', 'userjson', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(14, 'pooja thakare', 'a47be87b44f71faca4141bdde4db220b', 'pooja.wohlig@gmail.com', 2, '2015-10-10 09:50:53', 3, 'Frozen_Garlic_Cloves_design1.jpg', '', '12121221', '0', '0', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(16, 'wohlig', '440ac85892ca43ad26d44c7ad9d47d3e', 'wohlig@wo1hlig.com', 1, '2015-10-10 10:01:48', 2, '', '', 'rtyu', '0', '0', '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(18, 'abc', '440ac85892ca43ad26d44c7ad9d47d3e', 'awwwwbc@email.com', 1, '2015-10-10 10:25:48', 2, 'download4.jpg', '', 'asdf', '0', 'gsgs', '542524', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(20, 'bharati', '95387d140a350afaef5c641beb107efd', 'bharti@gmail.com', 1, '2015-10-10 10:29:39', 2, 'available_at5.JPG', '', '425hdrhr', 'Google', 'airoli', '43523452435', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(21, 'Pooja Thakare', '', '', 3, '2015-10-10 12:03:42', 1, 'https://graph.facebook.com/459604874211073/picture?width=150&height=150', '', '459604874211073', 'Facebook', ',', '', '0000-00-00', '', '', '', '', '', '459604874211073', '', '', '', ''),
(22, 'Pooja Thakare', '', 'pooja.wohlig@gmail.com', 3, '2015-10-10 12:04:23', 1, 'https://lh5.googleusercontent.com/-5B1PwZZrwdI/AAAAAAAAAAI/AAAAAAAAABw/J3Hf871N8IE/photo.jpg', '', '103402210128529539675', 'Google', ',', '', '0000-00-00', '', '', '', '', '', '', '103402210128529539675', '', '', ''),
(23, 'aarti', 'c26cf19cab23bced196bfbc88dd3c2e3', 'aarti@ghj.com', 1, '2015-10-21 09:25:18', 2, 'download_(2).jpg', '', 'thteh', 'Email', 'airoli111', '99999', '2015-11-02', '', '', '', '', '', '', '', '', 'www.wohlig.in', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_blogs`
--

CREATE TABLE IF NOT EXISTS `youtube_blogs` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_blogs`
--

INSERT INTO `youtube_blogs` (`id`, `order`, `status`, `name`, `image`, `url`, `timestamp`, `content`) VALUES
(1, 1, 3, 'blog1', 'available_at8.JPG', 'ghgscgvhb', '2015-10-10 07:56:38', 'ghshgg');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_enquiry`
--

CREATE TABLE IF NOT EXISTS `youtube_enquiry` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_enquiry`
--

INSERT INTO `youtube_enquiry` (`id`, `user`, `name`, `email`, `timestamp`, `content`) VALUES
(1, 1, 'wohlig', 'dsa@jdfha.djf', '2015-10-10 10:46:14', 'retwe');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_events`
--

CREATE TABLE IF NOT EXISTS `youtube_events` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_events`
--

INSERT INTO `youtube_events` (`id`, `status`, `name`, `venue`, `image`, `url`, `starttime`, `timestamp`, `content`) VALUES
(1, 2, 'wohlig', 'Mumbai', 'available_at7.JPG', 'cvgbhn', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rghj');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_feedback`
--

CREATE TABLE IF NOT EXISTS `youtube_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_feedback`
--

INSERT INTO `youtube_feedback` (`id`, `name`, `email`, `timestamp`, `content`) VALUES
(1, 'wohlig1', 'pooja1.wohlig@gmail.com', '2015-10-10 10:45:09', '111dcvgbhjn');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_latestvideos`
--

CREATE TABLE IF NOT EXISTS `youtube_latestvideos` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_latestvideos`
--

INSERT INTO `youtube_latestvideos` (`id`, `order`, `status`, `url`, `image`, `timestamp`) VALUES
(1, 1, 2, 'FCojpFwWuG0', 'available_at3.JPG', '2015-10-10 09:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_notification`
--

CREATE TABLE IF NOT EXISTS `youtube_notification` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_notification`
--

INSERT INTO `youtube_notification` (`id`, `status`, `order`, `name`, `link`, `timestamp`, `content`) VALUES
(1, 3, 11, 'wohligm', 'http://ddsfdf.in', '2015-10-10 10:44:20', 'mmm');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_photogallery`
--

CREATE TABLE IF NOT EXISTS `youtube_photogallery` (
  `id` int(11) NOT NULL,
  `photogallerycategory` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_photogallery`
--

INSERT INTO `youtube_photogallery` (`id`, `photogallerycategory`, `order`, `status`, `image`, `timestamp`) VALUES
(1, 2, 1, 2, 'available_at1.JPG', '2015-10-10 08:31:06'),
(5, 2, 2, 2, 'available_at2.JPG', '2015-10-10 09:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_photogallerycategory`
--

CREATE TABLE IF NOT EXISTS `youtube_photogallerycategory` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_photogallerycategory`
--

INSERT INTO `youtube_photogallerycategory` (`id`, `order`, `status`, `name`, `image`, `timestamp`) VALUES
(1, 1, 2, 'trail', 'download.jpg', '2015-10-10 08:04:55'),
(2, 2, 2, 'Diwali', 'available_at.JPG', '2015-10-10 08:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_pickedvideos`
--

CREATE TABLE IF NOT EXISTS `youtube_pickedvideos` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_pickedvideos`
--

INSERT INTO `youtube_pickedvideos` (`id`, `status`, `url`, `image`, `timestamp`) VALUES
(1, 2, 'xdcvghbjn', 'available_at6.JPG', '2015-10-10 10:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_videogallery`
--

CREATE TABLE IF NOT EXISTS `youtube_videogallery` (
  `id` int(11) NOT NULL,
  `videogallerycategory` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_videogallery`
--

INSERT INTO `youtube_videogallery` (`id`, `videogallerycategory`, `status`, `order`, `url`, `timestamp`) VALUES
(1, 1, 2, 1, 'daerg', '0000-00-00 00:00:00'),
(3, 2, 2, 2, 'hjytjgyf', '2015-10-10 09:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_videogallerycategory`
--

CREATE TABLE IF NOT EXISTS `youtube_videogallerycategory` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube_videogallerycategory`
--

INSERT INTO `youtube_videogallerycategory` (`id`, `status`, `order`, `name`, `subtitle`, `url`, `timestamp`) VALUES
(1, 2, 1, 'wohlig', 'concert', 'FCojpFwWuG0', '0000-00-00 00:00:00'),
(2, 2, 2, 'Home', 'new art', 'mTijtdjzg8U', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_blogs`
--
ALTER TABLE `youtube_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_enquiry`
--
ALTER TABLE `youtube_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_events`
--
ALTER TABLE `youtube_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_feedback`
--
ALTER TABLE `youtube_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_latestvideos`
--
ALTER TABLE `youtube_latestvideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_notification`
--
ALTER TABLE `youtube_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_photogallery`
--
ALTER TABLE `youtube_photogallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_photogallerycategory`
--
ALTER TABLE `youtube_photogallerycategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_pickedvideos`
--
ALTER TABLE `youtube_pickedvideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_videogallery`
--
ALTER TABLE `youtube_videogallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_videogallerycategory`
--
ALTER TABLE `youtube_videogallerycategory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `youtube_blogs`
--
ALTER TABLE `youtube_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_enquiry`
--
ALTER TABLE `youtube_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_events`
--
ALTER TABLE `youtube_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_feedback`
--
ALTER TABLE `youtube_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_latestvideos`
--
ALTER TABLE `youtube_latestvideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_notification`
--
ALTER TABLE `youtube_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_photogallery`
--
ALTER TABLE `youtube_photogallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `youtube_photogallerycategory`
--
ALTER TABLE `youtube_photogallerycategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `youtube_pickedvideos`
--
ALTER TABLE `youtube_pickedvideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `youtube_videogallery`
--
ALTER TABLE `youtube_videogallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `youtube_videogallerycategory`
--
ALTER TABLE `youtube_videogallerycategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
