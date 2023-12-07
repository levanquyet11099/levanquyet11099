-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2019 lúc 11:48 AM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
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
-- Cơ sở dữ liệu: `db_quan_ly_ban_hang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `c_parent_id` int(11) DEFAULT 0,
  `c_supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `c_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `c_parent_id`, `c_supplier_id`, `c_name`, `c_code`, `c_active`, `created_at`, `updated_at`) VALUES
(5, 0, NULL, 'Bánh kẹo', 'iZv9Owz0IwDcjbk', 1, '2019-09-19 09:13:39', '2019-09-19 09:13:39'),
(6, 0, NULL, 'Nước giải khát', '4mFmrcqTJ36NgGy', 1, '2019-09-19 09:13:58', '2019-09-19 09:13:58'),
(7, 0, NULL, 'Dầu ăn', 'CPFwFyIJESVoVsH', 1, '2019-09-19 09:14:29', '2019-09-19 09:14:29'),
(8, 0, NULL, 'Bột ngọt', 'ZNMVadYoikayyEe', 1, '2019-09-19 09:14:51', '2019-09-19 09:14:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_permission`
--

CREATE TABLE `group_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_permission`
--

INSERT INTO `group_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Toàn bộ hệ thống', 'Toàn bộ quyền quản lý hệ thống', '2019-10-09 04:23:54', '2019-10-09 04:23:54'),
(2, 'Quản lý loại hàng', NULL, '2019-10-09 04:24:36', '2019-10-09 04:25:30'),
(3, 'Quản lý đơn vị tính', NULL, '2019-10-09 04:25:56', '2019-10-09 04:25:56'),
(4, 'Quản lý sản phẩm', NULL, '2019-10-09 04:26:03', '2019-10-09 04:26:03'),
(5, 'Quản lý nhà cung cấp', NULL, '2019-10-09 04:26:16', '2019-10-09 04:26:16'),
(6, 'Quản lý dữ liệu nhập hàng', NULL, '2019-10-09 04:35:44', '2019-10-09 04:35:44'),
(7, 'Quản lý dữ liệu xuất hàng', NULL, '2019-10-09 04:36:04', '2019-10-09 04:36:04'),
(8, 'Quản lý dữ liệu kho hàng', NULL, '2019-10-09 04:36:46', '2019-10-09 04:36:46'),
(9, 'Quản lý quản trị viên', NULL, '2019-10-09 04:37:19', '2019-10-09 04:37:19'),
(10, 'Quản lý vai trò thành viên', NULL, '2019-10-09 04:37:38', '2019-10-09 04:37:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_01_01_182234_create_users_table', 1),
(3, '2019_01_01_191839_entrust_setup_tables', 1),
(4, '2019_07_13_223947_create_jobs_table', 1),
(5, '2019_09_09_115130_create_supplier_table', 1),
(6, '2019_09_09_115248_create_category_table', 1),
(7, '2019_09_10_152224_create_units_table', 1),
(8, '2019_09_10_152317_create_products_table', 1),
(9, '2019_09_12_091125_create_warehousing_table', 1),
(10, '2019_09_12_091259_create_product_warehousing_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_permission_id`, `created_at`, `updated_at`) VALUES
(1, 'toan-bo-he-thong', 'Toàn bộ hệ thống', NULL, 1, '2019-10-09 04:38:19', '2019-10-09 04:38:19'),
(2, 'danh-sach-loai-hang', 'Danh sách loại hàng', NULL, 2, '2019-10-09 04:38:57', '2019-10-09 04:38:57'),
(3, 'them-moi-loai-hang', 'Thêm mới loại hàng', NULL, 2, '2019-10-09 04:39:21', '2019-10-09 04:39:21'),
(4, 'chinh-sua-loai-hang', 'Chỉnh sửa loại hàng', NULL, 2, '2019-10-09 04:39:41', '2019-10-09 04:39:41'),
(5, 'xoa-loai-hang', 'Xóa loại hàng', NULL, 2, '2019-10-09 04:39:55', '2019-10-09 04:39:55'),
(6, 'danh-sach-don-vi-tinh', 'Danh sách đơn vị tính', NULL, 3, '2019-10-09 04:40:45', '2019-10-09 04:40:45'),
(7, 'them-don-vi-tinh', 'Thêm đơn vị tính', NULL, 3, '2019-10-09 04:40:56', '2019-10-09 04:40:56'),
(8, 'sua-don-vi-tinh', 'Sửa đơn vị tính', NULL, 3, '2019-10-09 04:41:37', '2019-10-09 04:41:37'),
(9, 'xoa-don-vi-tinh', 'Xóa đơn vị tính', NULL, 3, '2019-10-09 04:41:49', '2019-10-09 04:41:49'),
(10, 'danh-sach-san-pham', 'Danh sách sản phẩm', NULL, 4, '2019-10-09 04:52:20', '2019-10-09 04:52:20'),
(11, 'them-san-pham', 'Thêm sản phẩm', NULL, 4, '2019-10-09 07:08:39', '2019-10-09 07:08:39'),
(12, 'sua-san-pham', 'Sửa sản phẩm', NULL, 4, '2019-10-09 07:08:54', '2019-10-09 07:08:54'),
(13, 'xoa-san-pham', 'Xóa sản phẩm', NULL, 4, '2019-10-09 07:09:06', '2019-10-09 07:09:06'),
(14, 'danh-sach-nha-cung-cap', 'Danh sách nhà cung cấp', NULL, 5, '2019-10-09 07:10:14', '2019-10-09 07:10:14'),
(15, 'them-nha-cung-cap', 'Thêm nhà cung cấp', NULL, 5, '2019-10-09 07:10:25', '2019-10-09 07:10:25'),
(16, 'sua-nha-cung-cap', 'Sửa nhà cung cấp', NULL, 5, '2019-10-09 07:10:41', '2019-10-09 07:10:41'),
(17, 'xoa-nha-cung-cap', 'Xóa nhà cung cấp', NULL, 5, '2019-10-09 07:11:12', '2019-10-09 07:11:12'),
(18, 'danh-sach-nhap-hang', 'Danh sách nhập hàng', NULL, 6, '2019-10-09 07:12:36', '2019-10-09 07:13:20'),
(19, 'them-don-nhap-hang', 'Thêm đơn nhập hàng', NULL, 6, '2019-10-09 07:13:50', '2019-10-09 07:14:33'),
(20, 'sua-don-nhap-hang', 'Sửa đơn nhập hàng', NULL, 6, '2019-10-09 07:14:17', '2019-10-09 07:14:17'),
(21, 'xoa-don-nhap-hang', 'Xóa đơn nhập hàng', NULL, 6, '2019-10-09 07:15:00', '2019-10-09 07:15:00'),
(22, 'du-lieu-san-pham-nhap-hang', 'Dữ liệu sản phẩm nhập hàng', NULL, 6, '2019-10-09 07:16:18', '2019-10-09 07:16:18'),
(23, 'danh-sach-xuat-hang', 'Danh sách xuất hàng', NULL, 7, '2019-10-09 07:17:36', '2019-10-09 07:17:36'),
(24, 'them-don-xuat-hang', 'Thêm đơn xuất hàng', NULL, 7, '2019-10-09 07:17:52', '2019-10-09 07:17:52'),
(25, 'sua-don-xuat-hang', 'Sửa đơn xuất hàng', NULL, 7, '2019-10-09 07:18:08', '2019-10-09 07:18:08'),
(26, 'xoa-don-xuat-hang', 'Xóa đơn xuất hàng', NULL, 7, '2019-10-09 07:18:38', '2019-10-09 07:18:38'),
(27, 'du-lieu-san-pham-xuat-hang', 'Dữ liệu sản phẩm xuất hàng', NULL, 7, '2019-10-09 07:19:51', '2019-10-09 07:19:51'),
(28, 'du-lieu-kho-hang', 'Dữ liệu kho hàng', NULL, 8, '2019-10-09 07:20:52', '2019-10-09 07:20:52'),
(29, 'danh-sach-quan-tri-vien', 'Danh sách quản trị viên', NULL, 9, '2019-10-09 07:22:20', '2019-10-09 07:22:20'),
(30, 'them-moi-quan-tri-vien', 'Thêm mới quản trị viên', NULL, 9, '2019-10-09 07:22:29', '2019-10-09 07:22:29'),
(31, 'sua-quan-tri-vien', 'Sửa quản trị viên', NULL, 9, '2019-10-09 07:22:49', '2019-10-09 07:22:49'),
(32, 'xoa-quan-tri-vien', 'Xóa quản trị viên', NULL, 9, '2019-10-09 07:24:27', '2019-10-09 07:24:27'),
(33, 'danh-sach-vai-tro-thanh-vien', 'Danh sách vai trò thành viên', NULL, 10, '2019-10-09 07:25:46', '2019-10-09 07:25:46'),
(34, 'them-vai-tro-thanh-vien', 'Thêm vài trò thành viên', NULL, 10, '2019-10-09 07:30:32', '2019-10-09 07:30:32'),
(35, 'sua-vai-tro-thanh-vien', 'Sửa vai trò thành viên', NULL, 10, '2019-10-09 07:30:43', '2019-10-09 07:30:43'),
(36, 'xoa-vai-tro-thanh-vien', 'Xóa vai trò thành viên', NULL, 10, '2019-10-09 07:30:56', '2019-10-09 07:30:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `p_category_id` int(10) UNSIGNED DEFAULT NULL,
  `p_unit_id` int(10) UNSIGNED DEFAULT NULL,
  `p_user_id` int(10) UNSIGNED DEFAULT NULL,
  `p_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_entry_price` double(8,2) DEFAULT NULL,
  `p_retail_price` double(8,2) DEFAULT NULL,
  `p_cost_price` double(8,2) DEFAULT NULL,
  `p_total_number` int(11) DEFAULT 0,
  `p_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `p_category_id`, `p_unit_id`, `p_user_id`, `p_code`, `p_name`, `p_images`, `p_entry_price`, `p_retail_price`, `p_cost_price`, `p_total_number`, `p_description`, `p_content`, `p_status`, `created_at`, `updated_at`) VALUES
(4, 7, 4, 1, 'lfbJ52NKq9PiO0F', 'Dầu ăn tường an', NULL, 40000.00, 50000.00, 45000.00, 70, NULL, NULL, 1, '2019-09-19 09:16:32', '2019-09-23 08:50:54'),
(5, 7, 4, 1, 'KQjJ3uHZp4tIQrv', 'Dầu ăn cái lân', NULL, 20000.00, 35000.00, 33000.00, 50, NULL, NULL, 1, '2019-09-20 02:52:00', '2019-09-23 08:50:54'),
(6, 8, 5, 1, '8xvu47x6fJF8mcY', 'Bột canh iot', NULL, 3000.00, 4500.00, 4000.00, 30, NULL, NULL, 1, '2019-09-20 02:52:45', '2019-09-23 08:26:40'),
(7, 6, 4, 1, 'PRr8vHYXRJmVYvh', 'Coca cola', NULL, 7500.00, 10000.00, 9000.00, 100, NULL, NULL, 1, '2019-09-20 02:53:31', '2019-09-23 08:50:54'),
(8, 6, 4, 1, 'NFLeGHMU6IvozrA', 'Pepsi', NULL, 6500.00, 9000.00, 8500.00, 0, NULL, NULL, 0, '2019-09-20 02:54:07', '2019-10-04 10:17:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_warehousing`
--

CREATE TABLE `product_warehousing` (
  `id` int(10) UNSIGNED NOT NULL,
  `pw_product_id` int(10) UNSIGNED DEFAULT NULL,
  `pw_warehousing_id` int(10) UNSIGNED DEFAULT NULL,
  `pw_supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `pw_total_number` int(11) DEFAULT 0,
  `pw_manufacturing_date` date DEFAULT NULL,
  `pw_expiry_date` date DEFAULT NULL,
  `pw_active_price` tinyint(4) DEFAULT NULL,
  `pw_custom_price` double(15,2) DEFAULT NULL,
  `pw_total_price` decimal(15,2) DEFAULT NULL,
  `pw_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw_location` tinyint(4) DEFAULT NULL,
  `pw_type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_warehousing`
--

INSERT INTO `product_warehousing` (`id`, `pw_product_id`, `pw_warehousing_id`, `pw_supplier_id`, `pw_total_number`, `pw_manufacturing_date`, `pw_expiry_date`, `pw_active_price`, `pw_custom_price`, `pw_total_price`, `pw_note`, `pw_location`, `pw_type`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 50, '2019-10-01', '2019-11-30', 1, NULL, '2000000.00', NULL, NULL, 1, '2019-10-11 07:17:09', '2019-10-11 07:17:09'),
(2, 5, 1, 4, 180, '2019-10-18', '2019-12-20', 1, NULL, '3600000.00', NULL, NULL, 1, '2019-10-11 07:17:09', '2019-10-11 07:17:09'),
(3, 7, 1, 6, 300, '2019-10-31', '2019-12-31', 1, NULL, '2250000.00', NULL, NULL, 1, '2019-10-11 07:17:09', '2019-10-11 07:17:09'),
(4, 8, 1, 7, 900, '2019-10-30', '2019-12-31', 1, NULL, '5850000.00', NULL, NULL, 1, '2019-10-11 07:17:09', '2019-10-11 07:17:09'),
(5, 4, 2, 5, 8, '2019-01-01', '2019-01-12', 4, 30000.00, '240000.00', NULL, NULL, 1, '2019-10-21 10:23:10', '2019-10-21 10:23:10'),
(6, 7, 2, 6, 50, '2019-01-05', '2020-01-12', 4, 10000.00, '500000.00', NULL, NULL, 1, '2019-10-21 10:23:10', '2019-10-21 10:23:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administration', 'Administration', NULL, '2019-10-09 07:37:59', '2019-10-09 07:37:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `s_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_fax` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`id`, `s_name`, `s_code`, `s_email`, `s_phone`, `s_fax`, `s_website`, `s_logo`, `s_status`, `created_at`, `updated_at`) VALUES
(4, 'Cái Lân', 'qlUv3GvEjt7zjWT', 'cailan@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:08:03', '2019-09-19 09:08:03'),
(5, 'Tường An', 'xCXXrKsMCuF9D8a', 'tuongan@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:08:27', '2019-09-19 09:08:27'),
(6, 'Coca Cola', 'kxGBtYRLeljoQlV', 'coacacola@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:08:58', '2019-09-19 09:08:58'),
(7, 'Pepsi', 'vlziGqINJB7jKde', 'pepsi@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:09:59', '2019-09-19 09:09:59'),
(8, 'Alibaba', '4Se6WpqQ3Yeivk7', 'alibaba@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:11:33', '2019-09-19 09:11:33'),
(9, 'Custas', 'coi5cycdJqrTxR6', 'Custas@gmail.com', '0928817228', NULL, NULL, NULL, 1, '2019-09-19 09:12:48', '2019-09-19 09:12:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `units`
--

INSERT INTO `units` (`id`, `u_code`, `u_name`, `created_at`, `updated_at`) VALUES
(2, 'TH456', 'Thùng', '2019-09-12 07:41:46', '2019-09-12 07:41:46'),
(3, 'HO123', 'Hộp', '2019-09-12 07:42:02', '2019-09-12 07:42:02'),
(4, 'CH789', 'Chai', '2019-09-12 07:42:30', '2019-09-12 07:42:30'),
(5, 'BI159', 'Bịch', '2019-09-12 07:42:48', '2019-09-12 07:42:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `full_name`, `email`, `phone`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$o0536xrgEK55EUZJorcju.pzFXmgwjkblc2pqEYtg24QZra7fubcq', 'Admin', 'duocnvoit@gmail.com', '12345678', NULL, 1, 'd5ikk6Agq8HhBjftyLyulxmd140MFEB8Wf6jvlu3uvvB4E3DEs3HH0w5twrH', '2019-09-12 02:55:20', '2019-09-12 02:55:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehousing`
--

CREATE TABLE `warehousing` (
  `id` int(10) UNSIGNED NOT NULL,
  `pw_user_id` int(10) UNSIGNED DEFAULT NULL,
  `w_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `warehousing`
--

INSERT INTO `warehousing` (`id`, `pw_user_id`, `w_code`, `w_name`, `w_note`, `w_type`, `created_at`, `updated_at`) VALUES
(1, 1, '3IhgJUdJZTvHSbw', 'Test phiếu nhập kho', NULL, 1, '2019-10-11 07:17:09', '2019-10-11 07:17:09'),
(2, 1, 'zhG7Z751T4KREcA', 'Lotte Hotel Hanoi', 'Lotte Hotel Hanoi', 1, '2019-10-21 10:23:10', '2019-10-21 10:23:10');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_c_code_unique` (`c_code`),
  ADD KEY `category_c_supplier_id_foreign` (`c_supplier_id`),
  ADD KEY `category_c_parent_id_index` (`c_parent_id`);

--
-- Chỉ mục cho bảng `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_permission_name_unique` (`name`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_group_permission_id_foreign` (`group_permission_id`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_p_category_id_foreign` (`p_category_id`),
  ADD KEY `products_p_unit_id_foreign` (`p_unit_id`),
  ADD KEY `products_p_user_id_foreign` (`p_user_id`);

--
-- Chỉ mục cho bảng `product_warehousing`
--
ALTER TABLE `product_warehousing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_warehousing_pw_product_id_foreign` (`pw_product_id`),
  ADD KEY `product_warehousing_pw_warehousing_id_foreign` (`pw_warehousing_id`),
  ADD KEY `product_warehousing_pw_supplier_id_foreign` (`pw_supplier_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_s_code_unique` (`s_code`),
  ADD UNIQUE KEY `supplier_s_email_unique` (`s_email`);

--
-- Chỉ mục cho bảng `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_account_unique` (`account`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `warehousing`
--
ALTER TABLE `warehousing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehousing_pw_user_id_foreign` (`pw_user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `product_warehousing`
--
ALTER TABLE `product_warehousing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `warehousing`
--
ALTER TABLE `warehousing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_c_supplier_id_foreign` FOREIGN KEY (`c_supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_group_permission_id_foreign` FOREIGN KEY (`group_permission_id`) REFERENCES `group_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_p_category_id_foreign` FOREIGN KEY (`p_category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_p_unit_id_foreign` FOREIGN KEY (`p_unit_id`) REFERENCES `units` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_p_user_id_foreign` FOREIGN KEY (`p_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_warehousing`
--
ALTER TABLE `product_warehousing`
  ADD CONSTRAINT `product_warehousing_pw_product_id_foreign` FOREIGN KEY (`pw_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_pw_supplier_id_foreign` FOREIGN KEY (`pw_supplier_id`) REFERENCES `supplier` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_pw_warehousing_id_foreign` FOREIGN KEY (`pw_warehousing_id`) REFERENCES `warehousing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `warehousing`
--
ALTER TABLE `warehousing`
  ADD CONSTRAINT `warehousing_pw_user_id_foreign` FOREIGN KEY (`pw_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
