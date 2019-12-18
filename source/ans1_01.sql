-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019-04-23 09:19:58
-- 伺服器版本: 10.1.21-MariaDB
-- PHP 版本： 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ans1_01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `max` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  `top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `activity`
--

INSERT INTO `activity` (`id`, `name`, `description`, `date`, `about`, `img`, `join`, `start`, `end`, `max`, `template_id`, `hidden`, `top`) VALUES
(1, 'name', 'description', '2019-04-24', 'about', '8b661f5574ba89fd9f68f77431c18580.png', 'join', '2019-04-21', '2019-04-27', 5033, 1, 0, 0),
(7, '333', '33', '2019-04-10', '112', '77a27282447e1f0fe0901ded9fce19f1.png', '2313', '2019-04-02', '2019-04-11', 123123, 1, 0, 0),
(8, '空ㄉ', '空ㄉ', '2019-04-27', 'www.yahoo.com.tw', 'b75fee110e515d593b8dcf1c971cc634.png', '空ㄉ', '2019-04-17', '2019-04-26', 3, 1, 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `ESN` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `people`
--

INSERT INTO `people` (`id`, `user_id`, `activity_id`, `ESN`) VALUES
(2, 1, 1, 'x7S6Hib94w'),
(3, 6, 8, 'txTV1QWsyz'),
(4, 1, 8, 'UNyKscFQMB');

-- --------------------------------------------------------

--
-- 資料表結構 `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `css` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `template`
--

INSERT INTO `template` (`id`, `name`, `css`) VALUES
(1, '版型1', '<table style=\"margin:0 auto;\" width=\"200\" border=\"1\">\n  <tr>\n    <td colspan=\"2\" align=\"center\" valign=\"middle\">{{圖片}}</td>\n  </tr>\n  <tr>\n    <td align=\"center\" valign=\"middle\">{{電競名稱}}</td>\n    <td rowspan=\"2\" align=\"center\" valign=\"middle\">{{電競活動簡介}}</td>\n  </tr>\n  <tr>\n    <td align=\"center\" valign=\"middle\">{{競賽日期}}</td>\n  </tr>\n  <tr>\n    <td align=\"center\" valign=\"middle\">{{報名}}</td>\n    <td align=\"center\" valign=\"middle\">{{活動新聞連結}}</td>\n  </tr>\n</table>'),
(2, '版型2', '<table width=\"200\" style=\"margin:0 auto;\" border=\"1\">\n  <tr>\n    <td colspan=\"2\" align=\"center\" valign=\"middle\">{{圖片}}</td>\n  </tr>\n  <tr>\n    <td rowspan=\"2\" align=\"center\" valign=\"middle\">{{電競活動簡介}}</td>\n    <td align=\"center\" valign=\"middle\">{{電競名稱}}</td>\n  </tr>\n  <tr>\n    <td align=\"center\" valign=\"middle\">{{競賽日期}}</td>\n  </tr>\n  <tr>\n    <td align=\"center\" valign=\"middle\">{{報名}}</td>\n    <td align=\"center\" valign=\"middle\">{{活動新聞連結}}</td>\n  </tr>\n</table>'),
(3, '111111', '					<table style=\"margin:0 auto;\" width=\"200\" border=\"1\">\r\n  <tr>\r\n    <td colspan=\"2\" align=\"center\" valign=\"middle\">{{圖片}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\">{{電競名稱}}</td>\r\n    <td rowspan=\"2\" align=\"center\" valign=\"middle\">{{電競活動簡介}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\">{{競賽日期}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\">{{報名}}</td>\r\n    <td align=\"center\" valign=\"middle\">{{活動新聞連結}}</td>\r\n  </tr>\r\n</table>				'),
(4, '', '					<table style=\"margin:0 auto;\" width=\"200\" border=\"1\">\r\n  \r\n <tr>\r\n    <td align=\"center\" valign=\"middle\">{{競賽日期}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\">{{電競名稱}}</td>\r\n    <td rowspan=\"2\" align=\"center\" valign=\"middle\">{{電競活動簡介}}</td>\r\n  </tr>\r\n   <tr>\r\n    <td align=\"center\" valign=\"middle\">{{報名}}</td>\r\n    <td align=\"center\" valign=\"middle\">{{活動新聞連結}}</td>\r\n  </tr>\r\n<tr>\r\n    <td colspan=\"2\" align=\"center\" valign=\"middle\">{{圖片}}</td>\r\n  </tr>\r\n</table>				');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `uid`, `name`, `account`, `password`, `permission`) VALUES
(1, 'u0001', '特殊管理員', 'admin', '1234', '管理者'),
(5, 'u0005', 'aaa', 'aaa', 'aaa', '一般使用者'),
(6, 'u0006', 'ken', 'ken', '1234', '一般使用者');

-- --------------------------------------------------------

--
-- 資料表結構 `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `try` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `time`, `log`, `try`) VALUES
(1, 1, '2019-04-23 01:06:09', '登入', '成功'),
(2, 1, '2019-04-23 01:52:25', '登出', '成功'),
(3, 1, '2019-04-23 01:52:32', '登入', '失敗/密碼錯誤'),
(4, 1, '2019-04-23 01:52:37', '登入', '失敗/驗證碼錯誤'),
(5, 1, '2019-04-23 01:52:43', '登入', '成功'),
(6, 1, '2019-04-23 03:32:27', '登出', '成功'),
(7, 1, '2019-04-23 03:32:38', '登入', '成功'),
(8, 1, '2019-04-23 03:44:07', '登出', '成功'),
(9, 5, '2019-04-23 03:44:14', '登入', '成功'),
(10, 5, '2019-04-23 03:46:58', '登出', '成功'),
(11, 1, '2019-04-23 03:47:10', '登入', '成功'),
(12, 1, '2019-04-23 05:53:45', '登出', '成功'),
(13, 1, '2019-04-23 05:53:54', '登入', '失敗/驗證碼錯誤'),
(14, 1, '2019-04-23 05:54:02', '登入', '失敗/驗證碼錯誤'),
(15, 1, '2019-04-23 05:54:12', '登入', '失敗/驗證碼錯誤'),
(16, 1, '2019-04-23 05:54:23', '登入', '成功'),
(17, 1, '2019-04-23 05:54:50', '登出', '成功'),
(18, 1, '2019-04-23 05:55:18', '登入', '成功'),
(19, 1, '2019-04-23 05:55:55', '登出', '成功'),
(20, 6, '2019-04-23 05:56:09', '登入', '成功'),
(21, 6, '2019-04-23 06:00:13', '登出', '成功'),
(22, 1, '2019-04-23 06:00:22', '登入', '成功'),
(23, 1, '2019-04-23 06:01:27', '登出', '成功'),
(24, 5, '2019-04-23 06:01:39', '登入', '成功'),
(25, 5, '2019-04-23 06:02:54', '登出', '成功'),
(26, 1, '2019-04-23 06:26:43', '登入', '成功'),
(27, 1, '2019-04-23 06:28:29', '登入', '成功'),
(28, 1, '2019-04-23 06:35:09', '登出', '成功'),
(29, 1, '2019-04-23 06:36:04', '登入', '成功'),
(30, 1, '2019-04-23 06:39:45', '登出', '成功'),
(31, 1, '2019-04-23 06:45:53', '登出', '成功'),
(32, 1, '2019-04-23 06:58:30', '登入', '成功'),
(33, 1, '2019-04-23 06:59:32', '登出', '成功'),
(34, 1, '2019-04-23 07:05:30', '登入', '失敗/驗證碼錯誤'),
(35, 1, '2019-04-23 07:05:39', '登入', '成功'),
(36, 1, '2019-04-23 07:06:01', '登出', '成功'),
(37, 6, '2019-04-23 07:06:10', '登入', '失敗/密碼錯誤'),
(38, 1, '2019-04-23 07:15:27', '登出', '成功');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用資料表 AUTO_INCREMENT `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
