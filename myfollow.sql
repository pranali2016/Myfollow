-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2016 at 09:15 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myfollow`
--
CREATE DATABASE IF NOT EXISTS `myfollow` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `myfollow`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `companyName`) VALUES
(1, 'pranali', 'jpranali51@gmail.com', 'PROMACT'),
(2, 'Aayushi Mehta', 'maayushi4@gmail.com', 'ABB'),
(3, 'pranali', 'jpranali51@gmail.com', 'PROMACT'),
(4, 'PRANALI JADHAV', 'pranali@promactinfo.com', 'PROMACT'),
(5, 'pranali jadhav', 'pranali@io.com', 'promact'),
(6, 'PRANALI JADHAV', 'jpranali51@gmail.com', 'PROMACT');

-- --------------------------------------------------------

--
-- Table structure for table `enduser`
--

CREATE TABLE IF NOT EXISTS `enduser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `street1` varchar(50) NOT NULL,
  `street2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `enduser`
--

INSERT INTO `enduser` (`id`, `email`, `password`, `doj`, `gender`, `dob`, `street1`, `street2`, `city`, `state`, `country`, `pin`, `contactNo`) VALUES
(1, 'abcd1234@gmail.com', 'pranali', '2016-04-08 09:28:46', 'Female', '2016-12-12', '47- Ankur society', 'Waghodia Road', 'Vadodara', 'Gujarat', 'India', 390019, '2147483647'),
(6, 'pranali@pranali.com', 'pranali', '2016-04-08 10:07:55', 'Female', '1994-09-08', '47- Ankur society', 'Waghodia Road', 'Vadodara', 'Gujarat', 'India', 390019, '2147483647'),
(7, 'ab@ab.com', 'pranali', '2016-04-08 11:45:55', 'Male', '2016-12-12', 'asd', 'dgfwd', 'dfgvsdf', 'fvbsdf', 'fdbfsd', 369670, '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `state` varchar(50) NOT NULL COMMENT '0 = notfollowed,1=follow',
  `userId` varchar(50) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`fid`, `productId`, `state`, `userId`) VALUES
(81, 62, '1', '1'),
(84, 63, '1', '4JU9g8QKd_'),
(87, 68, '1', '7GtkANiGvD'),
(92, 65, '1', '7GtkANiGvD'),
(93, 62, '1', '7GtkANiGvD'),
(94, 62, '1', '4JU9g8QKd_');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(500) NOT NULL,
  `productId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `productId`) VALUES
(68, 'Chrysanthemum.jpg', 62),
(69, 'Desert.jpg', 62),
(70, 'Hydrangeas.jpg', 62),
(71, 'Jellyfish.jpg', 62),
(72, 'Koala.jpg', 62),
(73, 'church-members-clip-art.jpg', 63),
(74, 'download.jpg', 63),
(75, 'galaxy-s7_overview_step2_s7.png', 63),
(76, 'images (1).jpg', 63),
(77, 'images.jpg', 63),
(78, 'church-members-clip-art.jpg', 64),
(79, 'Penguins.jpg', 66),
(80, 'Tulips.jpg', 66),
(81, 'Koala.jpg', 67),
(82, 'Penguins.jpg', 67),
(83, 'Tulips.jpg', 67),
(84, 'Chrysanthemum.jpg', 67),
(85, 'Desert.jpg', 67),
(88, '81217681a6d256442d564248f81b8fe7.jpg', 69),
(89, 'dccced7be87e98bf627a2058a23bc113.jpg', 69),
(92, '5373e84c6fb8fd2875ed3fc06ba14996.jpg', 71),
(93, 'd2da556dfcba988084fb1a5dbd53e3b3.', 72);

-- --------------------------------------------------------

--
-- Table structure for table `productowner`
--

CREATE TABLE IF NOT EXISTS `productowner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `doj` date NOT NULL,
  `foundedIn` date NOT NULL,
  `street1` varchar(50) NOT NULL,
  `street2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `websiteUrl` varchar(100) NOT NULL,
  `twitterHandler` varchar(50) NOT NULL,
  `facebookPage` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `productowner`
--

INSERT INTO `productowner` (`id`, `email`, `password`, `companyName`, `description`, `doj`, `foundedIn`, `street1`, `street2`, `city`, `state`, `country`, `pin`, `contactNo`, `websiteUrl`, `twitterHandler`, `facebookPage`) VALUES
(32, 'jpranali51@gmail.com', 'pranali', 'PROMACT', 'hgfviuy', '1992-12-30', '1996-12-12', '47- Ankur society', 'Waghodia Road', 'Vadodara', 'Gujarat', 'India', 390019, '9874563210', 'www.promactinfo.com', '@pranali9', 'Pranali jadhav'),
(33, 'pranalivj9@gmail.com', 'pranali', 'PROMACT', 'hello world', '2004-02-15', '1947-12-10', '47- Ankur society', 'Waghodia Road', 'Vadodara', 'Gujarat', 'India', 390019, '9898561234', 'www.promactinfo.com', '@pranali9', 'Pranali jadhav'),
(34, 'pranali@promactinfo.com', 'pranali', 'PROMACT', 'Nice.', '2016-03-21', '2003-12-12', 'Monalisa', 'Manjalpur', 'Vadodara', 'Gujarat', 'India', 390016, '2147483647', 'www.promactinfo.com', '@pranali9', 'Pranali jadhav');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intro` varchar(300) NOT NULL,
  `detail` text NOT NULL,
  `ownerId` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `intro`, `detail`, `ownerId`, `updated_at`) VALUES
(62, 'Membership Site\r\n\r\nFormats: Online community (forum or Facebook group), ongoing access to a database of resources, software or online service, ongoing group coaching delivered through teleconferences or webinars, mastermind group.\r\n\r\nPrice Range: $50 to $500 a month', 'Key Principles: Offered as an secondary upsell on front end products (secondary means it is an upsell if someone says yes to the first upsell). Can also be an upsell on back-end products and a standalone offer.\r\n\r\nFor many businesses, especially coaching/training practices, this product is where â€˜cash-cowâ€™ money comes from (the most reliable income stream long term). Some businesses donâ€™t even bother with a funnel and just focus on feeding as many people into the membership site as the only product, and working to keep attrition rates low (keep members active for years).\r\n\r\nWhile a front end subscription is a more hands-off product for you as the creator, the membership site requires you devote ongoing time to members. This may include leading regular webinars, participating in an online forum, or consistently creating new teaching content.\r\n\r\nExample From My Business: I run a group coaching membership called the EJ Insider Community (soon to be renamed to â€˜Laptop Lifestyle Academyâ€™). It contains regular live coaching webinars with me, training programs, a 24/7 forum, interviews with experts, the opportunity to ask for your website or any aspect of your online business to be reviewed, and a whole lot more.', 33, '2016-04-21 10:38:57'),
(63, 'Mid-Range Product..\r\n\r\nFormats: Video, audio or written short course, short home study course (CDs + manuals in the mail), a series of live webinars or teleconferences, one day bootcamp or workshop in person.\r\n\r\nPrice Range: $99 to $299', 'Key Principles: Sits in the middle of the front and back end as a stepping stone product. Easier to create than a flagship course and thus can be delivered quickly, and priced high enough to deliver good cash flow. Some people focus only on a range of mid-range products as their entire business.\r\n\r\nExample From My Business: I currently have two of these products, The Blog Money Finder and Power Podcasting.\r\n\r\nFor many experts who have just started their online business, the first product they create is a mid-range course, usually delivered first via live webinars, then sold ongoing as recordings. Itâ€™s the quickest product you can create that is priced high enough to deliver solid financial return.', 33, '2016-04-21 10:51:00'),
(64, 'Live Event..\r\n\r\nFormats: Two to five day bootcamp, workshop or conference.\r\n\r\nPrice Range: $500 to $10,000, with payment plan options', 'Key Principles: From small group bootcamps to large scale conferences, the live event is a popular back end product. You can offer high intensity training face-to-face with you as the expert, or multi-speaker events with a significant networking component.\r\n\r\nExample From My Business: I have never run any live events, but have attended as a speaker. I have contemplated running small bootcamps many times, especially because itâ€™s a great way to create other products (record the event and you have a mid-range or flagship training course you can sell over and over again). Some companies make the majority of their profits from one or two large conferences a year.', 33, '2016-04-21 10:51:40'),
(65, 'Private Coaching\r\n\r\nFormats: Phone coaching, in person coaching, email coaching.\r\n\r\nPrice Range: $500 an hour to $50,000 a year.', 'Key Principles: For full time coaches this is bread and butter income, but it is not for the blog sales funnel model due to the labour required.\r\n\r\nHigh end small group and private coaching packages priced above $5,000+ a year make good back-end offers, specifically for your most motivated clients who benefit significantly from time spent with you. However attendance must be capped so as not to demand too much of your time.\r\n\r\nExample From My Business: In the past I had a handful of $5,000 and $10,000 a year coaching clients under my Elite Entrepreneur program, but I discontinued it. Today I offer one-hour skype coaching sessions at $1,000 each, and do one or two calls a month.', 32, '2016-04-21 10:41:22'),
(70, 'Mid-Range Product\r\n\r\nFormats: Video, audio or written short course, short home study course (CDs + manuals in the mail), a series of live webinars or teleconferences, one day bootcamp or workshop in person.\r\n\r\nPrice Range: $99 to $299', 'Key Principles: Sits in the middle of the front and back end as a stepping stone product. Easier to create than a flagship course and thus can be delivered quickly, and priced high enough to deliver good cash flow. Some people focus only on a range of mid-range products as their entire business.\r\n\r\nExample From My Business: I currently have two of these products, The Blog Money Finder and Power Podcasting.\r\n\r\nFor many experts who have just started their online business, the first product they create is a mid-range course, usually delivered first via live webinars, then sold ongoing as recordings. Itâ€™s the quickest product you can create that is priced high enough to deliver solid financial return.', 33, '2016-04-22 10:46:22'),
(71, 'Membership Site\r\n\r\nFormats: Online community (forum or Facebook group), ongoing access to a database of resources, software or online service, ongoing group coaching delivered through teleconferences or webinars, mastermind group.\r\n\r\nPrice Range: $50 to $500 a month', 'Key Principles: Offered as an secondary upsell on front end products (secondary means it is an upsell if someone says yes to the first upsell). Can also be an upsell on back-end products and a standalone offer.\r\n\r\nFor many businesses, especially coaching/training practices, this product is where â€˜cash-cowâ€™ money comes from (the most reliable income stream long term). Some businesses donâ€™t even bother with a funnel and just focus on feeding as many people into the membership site as the only product, and working to keep attrition rates low (keep members active for years).\r\n\r\nWhile a front end subscription is a more hands-off product for you as the creator, the membership site requires you devote ongoing time to members. This may include leading regular webinars, participating in an online forum, or consistently creating new teaching content.\r\n\r\nExample From My Business: I run a group coaching membership called the EJ Insider Community (soon to be renamed to â€˜Laptop Lifestyle Academyâ€™). It contains regular live coaching webinars with me, training programs, a 24/7 forum, interviews with experts, the opportunity to ask for your website or any aspect of your online business to be reviewed, and a whole lot more.', 32, '2016-04-22 11:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
