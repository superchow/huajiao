-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-01 12:53:57
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zwz`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `name`, `text`, `date`) VALUES
(1, '周卫忠', '水电费水电费', '1482846863419');

-- --------------------------------------------------------

--
-- 表的结构 `c_english_a_2`
--

CREATE TABLE `c_english_a_2` (
  `id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='大英 A二班';

--
-- 转存表中的数据 `c_english_a_2`
--

INSERT INTO `c_english_a_2` (`id`, `student_id`, `name`, `sex`, `tel`, `email`) VALUES
(0, 2013061011020, '杨雅妧', '女', '13170888430', 'c_english_a_2');

-- --------------------------------------------------------

--
-- 表的结构 `c_math_a_1`
--

CREATE TABLE `c_math_a_1` (
  `id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c_math_a_1`
--

INSERT INTO `c_math_a_1` (`id`, `student_id`, `name`, `sex`, `tel`, `email`) VALUES
(0, 20130610110200, '杨雅妧', '女', '13170888430', '2301608467@qq.com'),
(1, 20130610110217, '张青苗', '女', '13170888432', 'zwzschow@163.com');

-- --------------------------------------------------------

--
-- 表的结构 `c_network_project_1`
--

CREATE TABLE `c_network_project_1` (
  `id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c_network_project_1`
--

INSERT INTO `c_network_project_1` (`id`, `student_id`, `name`, `sex`, `tel`, `email`) VALUES
(0, 20130610110200, '杨雅妧', '女', '13170888430', '2301608467@qq.com'),
(1, 20130610110217, '张青苗', '女', '13170888432', 'zwzschow@163.com');

-- --------------------------------------------------------

--
-- 表的结构 `iot_1`
--

CREATE TABLE `iot_1` (
  `student_id` bigint(20) NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `img` text NOT NULL,
  `infomation` text,
  `other` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物联网二班';

--
-- 转存表中的数据 `iot_1`
--

INSERT INTO `iot_1` (`student_id`, `tel`, `username`, `email`, `sex`, `age`, `img`, `infomation`, `other`) VALUES
(20130610110100, '13170884520', '晓敏', 'wwefrewr@163.com', '女', 22, '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `iot_2`
--

CREATE TABLE `iot_2` (
  `student_id` bigint(20) NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `img` text NOT NULL,
  `infomation` text,
  `other` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物联网二班';

--
-- 转存表中的数据 `iot_2`
--

INSERT INTO `iot_2` (`student_id`, `tel`, `username`, `email`, `sex`, `age`, `img`, `infomation`, `other`) VALUES
(20130610110200, '13170888430', '杨雅妧', '', '', 0, 'http://c.hiphotos.baidu.com/zhidao/pic/item/c8177f3e6709c93d72318d2d993df8dcd000542c.jpg', '一些信息', ''),
(20130610110201, '13170888431', '张达明', NULL, NULL, NULL, '', NULL, NULL),
(20130610110202, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(20130610110217, '13170888432', '张青苗(班长)', NULL, NULL, NULL, '', NULL, NULL),
(20130610110219, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `academy` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `birth` varchar(20) NOT NULL,
  `birthplace` varchar(30) NOT NULL,
  `current_class` varchar(50) NOT NULL,
  `current_table` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`name`, `sex`, `school_id`, `password`, `email`, `academy`, `major`, `class`, `birth`, `birthplace`, `current_class`, `current_table`) VALUES
('周卫忠', '男', 20130610110200, '7913086zwz', '2665752129@qq.com', '信息工程学院', '物联网工程', '二班', '1995-01-20', '江西', '', ''),
('周卫忠', '男', 20130610110218, '7913086zwz', '2665752129@qq.com', '信息学院', '物联网工程', '二班', '1995/01/25', '江西省吉安市永新县', '物联网工程 二班', 'iot_2');

-- --------------------------------------------------------

--
-- 表的结构 `task`
--

CREATE TABLE `task` (
  `id` int(10) NOT NULL,
  `student_id` bigint(50) NOT NULL,
  `task_name` varchar(20) NOT NULL,
  `task_who` varchar(10) NOT NULL,
  `starttime` varchar(20) NOT NULL,
  `endtime` varchar(20) NOT NULL,
  `task_info` text CHARACTER SET utf32 COLLATE utf32_croatian_ci NOT NULL,
  `from_class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `task`
--

INSERT INTO `task` (`id`, `student_id`, `task_name`, `task_who`, `starttime`, `endtime`, `task_info`, `from_class`) VALUES
(4, 20130610110200, '班费通知', '张青苗(班长)', '2016/12/28', '2016-12-30', '						\n每人交班费30元		', 'c_network_project_1');

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE `teacher` (
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `school_id` bigint(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `academy` varchar(30) NOT NULL,
  `current_class` varchar(50) NOT NULL,
  `current_table` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`name`, `sex`, `school_id`, `password`, `email`, `academy`, `current_class`, `current_table`) VALUES
('周卫忠', '男', 20130610110200, '7913086zwz', '2665752129@qq.com', '信息工程学院', '', ''),
('周卫忠', '男', 20130610110202, '7913086zwz', '2665752129@qq.com', '信息工程学院', '', ''),
('zxc', '男', 20130610110218, '7913086', '2665752129@qq.com', '土木建筑学院', '', ''),
('vvhn', '男', 201300610110218, '7913086', 'fvb@163.com', '软件学院', '', ''),
('xvb', '男', 2013061011021888, '7913086', 'ggbn@163.com', '土木建筑学院', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_english_a_2`
--
ALTER TABLE `c_english_a_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_math_a_1`
--
ALTER TABLE `c_math_a_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_network_project_1`
--
ALTER TABLE `c_network_project_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_1`
--
ALTER TABLE `iot_1`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `iot_2`
--
ALTER TABLE `iot_2`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`school_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
