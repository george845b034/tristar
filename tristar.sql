-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生日期: 2014 年 01 月 17 日 11:12
-- 伺服器版本: 5.5.32
-- PHP 版本: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `tristar`
--
CREATE DATABASE IF NOT EXISTS `tristar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tristar`;

-- --------------------------------------------------------

--
-- 表的結構 `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `cu_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `cu_name` varchar(30) NOT NULL COMMENT '名字',
  `cu_mail` varchar(30) NOT NULL COMMENT 'mail',
  `cu_title` varchar(30) NOT NULL COMMENT '標題',
  `cu_message` text NOT NULL COMMENT '內容',
  `cu_ip` varchar(15) NOT NULL COMMENT 'ip',
  `cu_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '時間',
  PRIMARY KEY (`cu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='聯絡我們' AUTO_INCREMENT=12 ;

--
-- 轉存資料表中的資料 `contact_us`
--

INSERT INTO `contact_us` (`cu_id`, `cu_name`, `cu_mail`, `cu_title`, `cu_message`, `cu_ip`, `cu_time`) VALUES
(11, 'test', 'test@gmail.com', 'titleTest', 'content', '::1', '2013-12-25 06:56:55'),
(2, 'aa', '', 'cc', 'ddd', '::1', '2013-12-20 09:21:55'),
(3, 'aa', '', 'gg', 'bbbbbbbb', '::1', '2013-12-20 09:29:14'),
(4, 'gg', 'goerge@gmail.com', 'test', 'content', '127.0.0.1', '2013-12-24 08:22:30'),
(5, 'bbb', 'bbb@gmail.com', 'test', 'content', '127.0.0.1', '2013-12-24 08:25:16'),
(6, 'a', 'a@gmail.com', 'aaaaa', 'ccc', '127.0.0.1', '2013-12-24 08:29:30'),
(7, 'qq', 'qq@gmail.com', 'qq', 'qq', '127.0.0.1', '2013-12-24 08:30:10'),
(8, 'tt', 'tt@gmail.com', 'tt', 'cc', '127.0.0.1', '2013-12-24 08:44:47'),
(9, 'georgeGG', 'gg@gmail.com', 'test', 'conetnet', '127.0.0.1', '2013-12-24 09:04:04'),
(10, 'vv', 'vv@gmail.com', 'tt', 'c', '::1', '2013-12-25 06:13:31');

-- --------------------------------------------------------

--
-- 表的結構 `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `mp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `mp_type` int(10) unsigned NOT NULL COMMENT '圖片種類',
  `mp_name` varchar(60) NOT NULL COMMENT '名稱',
  `mp_image` text NOT NULL COMMENT '圖片',
  `mp_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '時間',
  PRIMARY KEY (`mp_id`),
  KEY `mp_type` (`mp_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='首頁' AUTO_INCREMENT=15 ;

--
-- 轉存資料表中的資料 `images`
--

INSERT INTO `images` (`mp_id`, `mp_type`, `mp_name`, `mp_image`, `mp_time`) VALUES
(1, 1, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-10-26 05:45:01'),
(2, 1, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-10-26 05:46:25'),
(3, 1, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-10-26 05:46:59'),
(14, 1, 'GGG', '["Desert.jpg","Koala.jpg","Lighthouse.jpg"]', '2013-11-18 11:08:19'),
(7, 2, 'test', '["Jellyfish.jpg"]', '2013-11-09 11:28:20'),
(8, 2, 'test', '["Jellyfish.jpg"]', '2013-11-09 11:32:16'),
(9, 2, 'test', '["Jellyfish.jpg"]', '2013-11-09 11:33:11'),
(10, 2, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-11-09 11:33:21'),
(11, 2, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-11-09 11:34:10'),
(12, 2, 'test', '["Chrysanthemum.jpg","Desert.jpg"]', '2013-11-09 11:34:39'),
(13, 2, 'test2', '["Jellyfish.jpg"]', '2013-11-18 11:59:08');

-- --------------------------------------------------------

--
-- 表的結構 `images_type`
--

CREATE TABLE IF NOT EXISTS `images_type` (
  `it_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `it_name` varchar(30) NOT NULL COMMENT '類別名稱',
  PRIMARY KEY (`it_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='圖片類別' AUTO_INCREMENT=3 ;

--
-- 轉存資料表中的資料 `images_type`
--

INSERT INTO `images_type` (`it_id`, `it_name`) VALUES
(1, '拖鞋蘭'),
(2, '蝴蝶蘭');

-- --------------------------------------------------------

--
-- 表的結構 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `m_account` varchar(30) NOT NULL COMMENT '帳號',
  `m_password` varchar(32) NOT NULL COMMENT '密碼',
  `m_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`m_id`),
  KEY `m_account` (`m_account`,`m_password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='登入表' AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `member`
--

INSERT INTO `member` (`m_id`, `m_account`, `m_password`, `m_time`) VALUES
(1, 'tristar', '1c63129ae9db9c60c3e8aa94d3e00495', '2013-12-26 06:19:19');

-- --------------------------------------------------------

--
-- 表的結構 `plants_list`
--

CREATE TABLE IF NOT EXISTS `plants_list` (
  `pl_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `pl_type` int(10) unsigned NOT NULL COMMENT '目錄的型態',
  `pl_category` int(10) NOT NULL COMMENT '蘭化種類(0仙履蘭1其它',
  `pl_name1` varchar(60) NOT NULL COMMENT '品種名1',
  `pl_name2` varchar(60) NOT NULL COMMENT '品種名2',
  `pl_name1_img` varchar(60) NOT NULL COMMENT '品種名1圖片',
  `pl_name2_img` varchar(60) NOT NULL COMMENT '品種名2圖片',
  `pl_size` varchar(60) NOT NULL COMMENT '尺寸',
  `pl_price` varchar(60) NOT NULL COMMENT '價格',
  `pl_image` varchar(60) NOT NULL COMMENT '圖片',
  `pl_comment` text NOT NULL COMMENT '備註',
  `pl_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '時間',
  PRIMARY KEY (`pl_id`),
  KEY `pl_type` (`pl_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='植株目錄' AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `plants_list`
--

INSERT INTO `plants_list` (`pl_id`, `pl_type`, `pl_category`, `pl_name1`, `pl_name2`, `pl_name1_img`, `pl_name2_img`, `pl_size`, `pl_price`, `pl_image`, `pl_comment`, `pl_time`) VALUES
(1, 0, 0, '測試名55', '測試名2', '', '', '13~18cm', '3000', '["Jellyfish.jpg","Penguins.jpg"]', 'BBB', '2014-01-17 09:18:14'),
(2, 0, 0, '品種名1', '品種名2', 'Koala.jpg', 'Koala.jpg', '12', '55555', '["Koala.jpg"]', '', '2014-01-18 09:47:35'),
(4, 1, 0, 'test1', 'test2', 'Jellyfish.jpg', 'Penguins.jpg', '', '10000', '["Hydrangeas.jpg","Tulips.jpg"]', '備註備註備註', '2013-12-26 06:37:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
