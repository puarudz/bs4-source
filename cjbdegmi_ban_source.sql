-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2020 lúc 03:18 AM
-- Phiên bản máy phục vụ: 10.2.32-MariaDB-cll-lve
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cjbdegmi_ban_source`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(300) NOT NULL,
  `VND` varchar(10) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `time_reg` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `html` text NOT NULL,
  `date` varchar(30) NOT NULL,
  `gia` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `trangthai` varchar(10) NOT NULL,
  `image` varchar(500) NOT NULL,
  `link` varchar(32) NOT NULL,
  `view` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `download` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `username` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `location` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gachthe`
--

CREATE TABLE `gachthe` (
  `id` int(10) NOT NULL,
  `code` text NOT NULL,
  `serial` text NOT NULL,
  `menhgia` int(11) NOT NULL,
  `loaithe` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `tinhtrang` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_chuyen_tien`
--

CREATE TABLE `lich_su_chuyen_tien` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `VND` varchar(32) NOT NULL,
  `hinh_thuc` varchar(30) NOT NULL,
  `nguoi_gui` varchar(55) NOT NULL,
  `nguoi_nhan` varchar(55) NOT NULL,
  `date` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_hoat_dong`
--

CREATE TABLE `lich_su_hoat_dong` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `VND` varchar(32) NOT NULL,
  `loai` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_mua_code`
--

CREATE TABLE `lich_su_mua_code` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `code` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `gia` varchar(10) NOT NULL,
  `date` varchar(30) NOT NULL,
  `download` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_momo`
--

CREATE TABLE `log_momo` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `sotien` varchar(32) NOT NULL,
  `date` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_nap_the`
--

CREATE TABLE `log_nap_the` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `VND` varchar(32) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_rut_tien`
--

CREATE TABLE `log_rut_tien` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `VND` varchar(32) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_vnd`
--

CREATE TABLE `log_vnd` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `VND` varchar(32) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `ma_giao_dich` varchar(55) NOT NULL,
  `so_tien` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `so_dien_thoai` varchar(13) NOT NULL,
  `date` varchar(30) NOT NULL,
  `trangthai` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rut_tien`
--

CREATE TABLE `rut_tien` (
  `id` int(11) NOT NULL,
  `loai` varchar(55) NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `chinhanh` varchar(200) NOT NULL,
  `menhgia` varchar(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `trangthai` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(10) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `trangthai` varchar(10) NOT NULL,
  `username` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `img_name` varchar(150) NOT NULL,
  `size` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gachthe`
--
ALTER TABLE `gachthe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_chuyen_tien`
--
ALTER TABLE `lich_su_chuyen_tien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_hoat_dong`
--
ALTER TABLE `lich_su_hoat_dong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_mua_code`
--
ALTER TABLE `lich_su_mua_code`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_momo`
--
ALTER TABLE `log_momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_nap_the`
--
ALTER TABLE `log_nap_the`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_rut_tien`
--
ALTER TABLE `log_rut_tien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_vnd`
--
ALTER TABLE `log_vnd`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rut_tien`
--
ALTER TABLE `rut_tien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chatbox`
--
ALTER TABLE `chatbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gachthe`
--
ALTER TABLE `gachthe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_chuyen_tien`
--
ALTER TABLE `lich_su_chuyen_tien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_hoat_dong`
--
ALTER TABLE `lich_su_hoat_dong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_mua_code`
--
ALTER TABLE `lich_su_mua_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_momo`
--
ALTER TABLE `log_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_nap_the`
--
ALTER TABLE `log_nap_the`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_rut_tien`
--
ALTER TABLE `log_rut_tien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_vnd`
--
ALTER TABLE `log_vnd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rut_tien`
--
ALTER TABLE `rut_tien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
