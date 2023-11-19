-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 08:27 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_hakmiah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) NOT NULL,
  `name_en` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name_ar` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description_ar` longtext CHARACTER SET latin1 NOT NULL,
  `description_en` longtext CHARACTER SET latin1 NOT NULL,
  `status` enum('A','I') CHARACTER SET latin1 NOT NULL COMMENT 'A=Active , I=Inactive',
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `updated_by` bigint(11) NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('N','Y') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `name_en`, `name_ar`, `description_ar`, `description_en`, `status`, `slug`, `updated_by`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(1, 'Privacy & Policy', 'Privacy & Policy', 'The complete set of 675 icons in Font Awesome 4.7.0. You asked, Font Awesome delivers with 41 shiny new icons in version 4.7. Want to request new icons?', 'The complete set of 675 icons in Font Awesome 4.7.0. You asked, Font Awesome delivers with 41 shiny new icons in version 4.7. Want to request new icons?', 'A', 'privace_policy', 1, 1, '2020-10-28 18:30:00', NULL, 'N', NULL, NULL),
(2, 'Test12', 'Test', '<p>cfhbfchfh</p>', '<p>fgdfhbgdfh</p>', 'A', NULL, 1, 1, '2020-10-30 01:09:45', '2020-10-30 01:21:55', 'Y', '2020-10-30 01:21:55', 1),
(3, 'About Us', 'About Us', '<p>Descriptionn<br></p>', '<p>For more than a decade, Matrix Media Solutions is offering technical, \r\ndigital marketing, designing solutions and off-shore white labelled \r\nservices to the visionary companies, and those needing help with \r\nsoftware development. We donâ€™t provide run-of-the-mill solutions. We \r\nstrive to be different and make a difference. Our client-centric \r\nattitude drives us to provide solutions that deliver results. Itâ€™s that \r\nsimple.</p>', 'A', NULL, 1, 1, '2021-02-03 04:02:12', '2021-02-03 04:02:12', 'N', NULL, NULL),
(4, 'ghg', 'fghgh', '<p>ghgj</p>', '<p>fhgh</p>', 'A', NULL, 1, 1, '2020-10-30 02:50:59', '2020-10-30 02:51:03', 'Y', '2020-10-30 02:51:03', 1),
(5, 'tesr', 'dfv', '<p>xvcfzsxfc</p>', '<p>dxfvzsxc</p>', 'A', NULL, 1, 1, '2020-11-02 03:38:50', '2020-11-02 03:39:00', 'Y', '2020-11-02 03:39:00', 1),
(6, 'test', 'dgvfdvg', '<p>xfcbhgfx</p>', '<p>dgvb</p>', 'A', NULL, 1, 1, '2021-02-03 08:59:24', '2021-02-03 08:59:24', 'N', NULL, NULL),
(7, 'gdfg', 'dfgdf', 'dfgdfg', 'gdfgfdg', 'A', NULL, 1, 1, '2021-03-31 06:51:35', '2021-03-31 06:53:10', 'Y', '2021-03-31 06:53:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_images`
--

CREATE TABLE `cms_images` (
  `id` bigint(20) NOT NULL,
  `cms_id` bigint(20) NOT NULL,
  `path` varchar(255) NOT NULL,
  `slider_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_checked` enum('N','Y') NOT NULL DEFAULT 'N',
  `status` enum('A','I','D') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_images`
--

INSERT INTO `cms_images` (`id`, `cms_id`, `path`, `slider_status`, `is_checked`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(14, 5, '1604517736.png', 'N', 'N', 'A', '2020-11-04 13:52:16', '2020-11-04 13:52:16', 1, 1, 'N', NULL, NULL),
(15, 5, '1604517736.jpeg', 'N', 'N', 'A', '2020-11-04 13:52:16', '2020-11-04 13:52:16', 1, 1, 'N', NULL, NULL),
(19, 5, '1604517915-0.jpg', 'N', 'N', 'A', '2020-11-04 13:55:15', '2020-11-04 13:55:15', 1, 1, 'N', NULL, NULL),
(20, 3, '1604609320-0.jpg', 'N', 'Y', 'A', '2020-11-05 15:18:40', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(21, 3, '1604609320-1.jpg', 'N', 'Y', 'A', '2020-11-05 15:18:40', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(22, 3, '1604609320-2.jpg', 'N', 'N', 'A', '2020-11-05 15:18:40', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(23, 3, '1604609320-3.jpg', 'N', 'N', 'A', '2020-11-05 15:18:40', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(24, 3, '1604609320-4.jpg', 'N', 'N', 'A', '2020-11-05 15:18:40', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(27, 3, '1604609387-0.jpg', 'N', 'N', 'A', '2020-11-05 15:19:47', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(28, 3, '1604609390-0.jpg', 'N', 'N', 'A', '2020-11-05 15:19:50', '2021-02-03 04:02:12', 1, 1, 'N', NULL, NULL),
(29, 6, '1612362546-0.jpg', 'N', 'Y', 'A', '2021-02-03 08:59:06', '2021-02-03 08:59:24', 1, 1, 'N', NULL, NULL),
(30, 6, '1612362546-1.png', 'N', 'Y', 'A', '2021-02-03 08:59:06', '2021-02-03 08:59:24', 1, 1, 'N', NULL, NULL),
(31, 7, '1617193295-0.png', 'N', 'N', 'A', '2021-03-31 06:51:35', '2021-03-31 06:51:35', 1, 1, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_images`
--

CREATE TABLE `home_images` (
  `id` bigint(20) NOT NULL,
  `home_id` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slider_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_checked` enum('N','Y') NOT NULL DEFAULT 'N',
  `status` enum('A','I','D') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_images`
--

INSERT INTO `home_images` (`id`, `home_id`, `image`, `slider_status`, `is_checked`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(1, 1, '1617199356-0.png', 'N', 'N', 'A', '2021-03-31 08:32:36', '2021-03-31 08:35:07', 1, 1, 'N', NULL, NULL),
(2, 1, '1617199423-0.png', 'N', 'N', 'A', '2021-03-31 08:33:43', '2021-03-31 08:35:07', 1, 1, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_page_galleries`
--

CREATE TABLE `home_page_galleries` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description_en` text CHARACTER SET utf8 NOT NULL,
  `description_ar` text CHARACTER SET utf8 NOT NULL,
  `status` enum('A','I') CHARACTER SET utf8 NOT NULL COMMENT 'A=Active , I=Inactive',
  `updated_by` bigint(11) NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_page_galleries`
--

INSERT INTO `home_page_galleries` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `status`, `updated_by`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(1, 'sdgsg', 'الحياة مبنية', '1Lorem Ipsum is a virtual template that is placed in designs to be presented to the customer to visualize how to place texts in designs, whether they are printed designs, brochures or flyers for example, or website templates. Upon the customer\'s initial approval of the design, this text is removed from the design.', 'لوريم إيبسوم هو قالب افتراضي يتم وضعه في تصميمات ليتم تقديمها للعميل لتصور كيفية وضع النصوص في التصميمات ، سواء كانت تصميمات مطبوعة أو كتيبات أو منشورات على سبيل المثال ، أو قوالب مواقع الويب. عند الموافقة المبدئية للعميل على التصميم ، يتم إزالة هذا النص من التصميم.', 'A', 1, 1, '2021-03-31 08:35:07', '2021-03-31 08:35:07', 'N', '2021-03-29 18:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_page_settings`
--

CREATE TABLE `home_page_settings` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description_en` text CHARACTER SET utf8 NOT NULL,
  `description_ar` text CHARACTER SET utf8 NOT NULL,
  `status` enum('A','I') CHARACTER SET utf8 NOT NULL COMMENT 'A=Active , I=Inactive',
  `updated_by` bigint(11) NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_page_settings`
--

INSERT INTO `home_page_settings` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `status`, `updated_by`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(2, 'A life is built', 'اميندار هو حلمك القادم', 'Lorem Ipsum is a virtual template that is placed in designs to be shown to the client to visualize how to place texts.', 'القادمLorem Ipsum هو نموذج افتراضي يتم وضعه في تصميمات ليتم عرضها للعميل لتصور كيفية وضع النصوص.', 'A', 1, 1, '2021-03-31 00:39:41', '2021-03-31 10:01:29', 'N', '2021-03-29 18:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2020_04_24_070120_create_roles_table', 1),
(20, '2020_04_24_070145_create_permissions_table', 1),
(21, '2020_04_24_073518_create_role_user_table', 1),
(22, '2020_04_24_074403_create_permission_role_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description_en` text CHARACTER SET utf8 NOT NULL,
  `description_ar` text CHARACTER SET utf8 NOT NULL,
  `status` enum('A','I') CHARACTER SET utf8 NOT NULL COMMENT 'A=Active , I=Inactive',
  `updated_by` bigint(11) NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `status`, `updated_by`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`, `deleted_by`) VALUES
(2, 'news latest', 'الحياة مبنية', 'Lorem Ipsum is a virtual template that is placed in designs to be presented to the customer to visualize how to place texts in designs, whether they are printed designs, brochures or flyers for example, or website templates. Upon the customer\'s initial approval of the design, this text is removed from the design.', 'لوريم إيبسوم هو قالب افتراضي يتم وضعه في تصميمات ليتم تقديمها للعميل لتصور كيفية وضع النصوص في التصميمات ، سواء كانت تصميمات مطبوعة أو كتيبات أو منشورات على سبيل المثال ، أو قوالب مواقع الويب. عند الموافقة المبدئية للعميل على التصميم ، يتم إزالة هذا النص من التصميم.', 'A', 1, 1, '2021-03-31 06:11:53', '2021-03-31 06:11:53', 'N', '2021-03-29 18:30:00', 1),
(3, 'sdgs', 'sdgsdg', 'sdgsd', 'sdgsg', 'A', 1, 1, '2021-03-31 06:06:57', '2021-03-31 06:11:38', 'Y', '2021-03-31 06:11:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `module_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Role List', 'role-list', NULL, 'Roles', 1, '2021-02-01 18:30:00', NULL),
(2, 'User List', 'user-list', NULL, 'Users', 1, '2021-02-01 18:30:00', NULL),
(3, 'User Create', 'user-create', NULL, 'Users', 1, '2021-02-01 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, NULL),
(2, 3, 3, NULL, NULL),
(3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `heading_ar` varchar(255) NOT NULL,
  `content_video` text NOT NULL,
  `content` text NOT NULL,
  `content_ar` text NOT NULL,
  `map` text NOT NULL,
  `near_to` text NOT NULL,
  `services` text NOT NULL,
  `virtual_toure_image` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `featured` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `name_ar`, `banner`, `heading`, `heading_ar`, `content_video`, `content`, `content_ar`, `map`, `near_to`, `services`, `virtual_toure_image`, `type`, `featured`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Project One', 'Project One Ar', '2_Blog_UniSpan_1617197440.jpeg', 'Heading project one', 'Heading project one ar', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/WjoplqS1u18\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable Arabic.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.3571649819028!2d88.46495411496016!3d22.60313398516707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a027544e22a5b6f%3A0xf22acb90ceebe765!2sEco%20Park!5e0!3m2!1sen!2sin!4v1617192889097!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '6,7', '5', '<div class=\"ia ib s\"><iframe src=\"https://cdn.embedly.com/widgets/media.html?src=https%3A%2F%2Fmomento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174&amp;url=https%3A%2F%2Fmomento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174&amp;image=https%3A%2F%2Fcdn.momento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174%2Fsphere%2Fpreview&amp;key=a19fcc184b9711e1b4764040d3dc5c07&amp;type=text%2Fhtml&amp;schema=momento360\" allowfullscreen=\"\" frameborder=\"0\" height=\"450\" width=\"900\" title=\"Lungshan Template in Taipei\" class=\"t u v qy aj\" scrolling=\"auto\"></iframe></div>', 'Previous', '0', '1', '2021-03-31 08:00:40', '2021-03-31 22:42:57', NULL),
(6, 'Project Two', 'Project Two Ar', '2_Blog_UniSpan_1617198060.jpeg', 'Heading project two', 'Heading project two ar', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/WjoplqS1u18\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable Arabic.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.3571649819028!2d88.46495411496016!3d22.60313398516707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a027544e22a5b6f%3A0xf22acb90ceebe765!2sEco%20Park!5e0!3m2!1sen!2sin!4v1617192889097!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '6,7', '4,5', '<div class=\"ia ib s\"><iframe src=\"https://cdn.embedly.com/widgets/media.html?src=https%3A%2F%2Fmomento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174&amp;url=https%3A%2F%2Fmomento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174&amp;image=https%3A%2F%2Fcdn.momento360.com%2Fe%2Fu%2Feac19ba08a7943788bcbfb293cfc8174%2Fsphere%2Fpreview&amp;key=a19fcc184b9711e1b4764040d3dc5c07&amp;type=text%2Fhtml&amp;schema=momento360\" allowfullscreen=\"\" frameborder=\"0\" height=\"450\" width=\"900\" title=\"Lungshan Template in Taipei\" class=\"t u v qy aj\" scrolling=\"auto\"></iframe></div>', 'Upcoming', '1', '0', '2021-03-31 08:11:00', '2021-04-01 00:46:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_faqs`
--

CREATE TABLE `project_faqs` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `question_en` text NOT NULL,
  `answer_en` text NOT NULL,
  `question_ar` text NOT NULL,
  `answer_ar` text NOT NULL,
  `status` enum('A','I') NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(11) NOT NULL,
  `updated_by` bigint(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_faqs`
--

INSERT INTO `project_faqs` (`id`, `project_id`, `question_en`, `answer_en`, `question_ar`, `answer_ar`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'faq-question', 'faq-answer', 'faq-question-ar', 'faq-answer-ar', 'A', 'N', '2021-03-31 04:14:31', '2021-03-31 04:14:31', 1, 1, '2021-03-30 18:30:00', 0),
(2, 1, 'fghfg', 'gfhf', 'gfh', 'gfh', 'A', 'Y', '2021-03-31 09:20:47', '2021-03-31 04:04:54', 1, 1, '2021-03-31 04:04:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_galleries`
--

CREATE TABLE `project_galleries` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `gallery_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_galleries`
--

INSERT INTO `project_galleries` (`id`, `project_id`, `gallery_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Webp.net-resizeimage_1617197440.png', '2021-03-31 08:00:40', '2021-03-31 08:00:40', NULL),
(2, 2, 'undraw_winter_designer_a2m7_1617197440.png', '2021-03-31 08:00:40', '2021-03-31 08:00:40', NULL),
(3, 2, 'undraw_winter_walk_2yac_1617197440.png', '2021-03-31 08:00:40', '2021-03-31 08:00:40', NULL),
(4, 2, 'undraw_in_no_time_6igu (2)_1617197440.png', '2021-03-31 08:00:40', '2021-03-31 08:00:40', NULL),
(5, 6, 'undraw_winter_designer_a2m7_1617198060.png', '2021-03-31 08:11:00', '2021-03-31 08:11:00', NULL),
(6, 6, 'undraw_winter_walk_2yac_1617198060.png', '2021-03-31 08:11:01', '2021-03-31 08:11:01', NULL),
(7, 6, 'undraw_in_no_time_6igu (2)_1617198060.png', '2021-03-31 08:11:01', '2021-03-31 08:11:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_near_places`
--

CREATE TABLE `project_near_places` (
  `id` int(11) NOT NULL,
  `near_name` varchar(255) NOT NULL,
  `near_name_ar` varchar(255) NOT NULL,
  `near_image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_near_places`
--

INSERT INTO `project_near_places` (`id`, `near_name`, `near_name_ar`, `near_image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Airport', 'Airport Ar', 'airport_1617258380.png', '1', '2021-03-31 04:19:45', '2021-04-01 00:56:21', NULL),
(7, 'University', 'University Ar', '89037_1617189491.png', '1', '2021-03-31 05:48:11', '2021-03-31 05:48:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_services`
--

CREATE TABLE `project_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_name_ar` varchar(255) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_services`
--

INSERT INTO `project_services` (`id`, `service_name`, `service_name_ar`, `service_image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Gym', 'Gym Ar', 'gym_1617172742.png', '1', '2021-03-31 01:09:02', '2021-03-31 01:09:06', '2021-03-31 01:09:06'),
(4, 'Gymnasium', 'Gym Ar', 'gymm_1617177358.jpg', '1', '2021-03-31 01:14:18', '2021-03-31 03:22:06', NULL),
(5, 'Mall', 'Mall Ar', 'mall-1596148-1355180_1617173075.png', '1', '2021-03-31 01:14:35', '2021-03-31 01:14:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_units`
--

CREATE TABLE `project_units` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_subheading` varchar(255) NOT NULL,
  `unit_content` text NOT NULL,
  `unit_name_ar` varchar(255) NOT NULL,
  `unit_subheading_ar` varchar(255) NOT NULL,
  `unit_content_ar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_unit_galleries`
--

CREATE TABLE `project_unit_galleries` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `unit_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'Super admin role', 1, '2020-04-25 18:30:00', '2020-04-25 18:30:00'),
(3, 'User manager', 'user-manager', 'User manager role', 1, '2021-02-02 09:20:52', '2021-02-03 04:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-04-25 18:30:00', '2020-04-25 18:30:00'),
(2, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description_en` text CHARACTER SET utf8 NOT NULL,
  `description_ar` text CHARACTER SET utf8 NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `status` enum('A','I') CHARACTER SET utf8 NOT NULL COMMENT 'A=Active , I=Inactive',
  `updated_by` bigint(11) NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `youtube_link`, `status`, `updated_by`, `created_by`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`) VALUES
(2, 'Amindar is your next dream', 'اميندار هو حلمك القادم', 'Lorem Ipsum is a virtual template that is placed in designs to be shown to the client to visualize how to place texts.', 'القادمLorem Ipsum هو نموذج افتراضي يتم وضعه في تصميمات ليتم عرضها للعميل لتصور كيفية وضع النصوص.', '', 'A', 1, 1, '2021-03-31 05:35:16', '2021-03-31 05:35:16', 'N', '2021-03-29 18:30:00'),
(3, 'thj', 't', 'thjj', 't', '', 'A', 1, 1, '2021-03-31 05:25:04', '2021-03-31 05:33:09', 'Y', '2021-03-31 05:33:09'),
(4, 'new', 'dfg', 'dfg', 't', 'https://www.youtube.com/watch?v=ziGbylaem7w', 'A', 1, 1, '2021-03-31 06:24:47', '2021-03-31 06:24:51', 'Y', '2021-03-31 06:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL COMMENT 'Id of country table',
  `tz_name` varchar(255) DEFAULT NULL,
  `current_utc_offset` varchar(150) DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A => Active,  I => Inactive',
  `priority` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `country_id`, `tz_name`, `current_utc_offset`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 1, 'Asia/Kabul', '+04:30', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 12:07:10'),
(2, 2, 'Europe/Tirane', '+01:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:17'),
(3, 3, 'Africa/Algiers', '+01:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:17'),
(4, 4, 'Pacific/Pago_Pago', '-11:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:17'),
(5, 5, 'Europe/Andorra', '+01:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:17'),
(6, 6, 'Africa/Luanda', '+01:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(7, 7, 'America/Anguilla', '-04:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(8, 8, 'Antarctica/Casey', '+08:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(9, 8, 'Antarctica/Davis', '+07:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(10, 8, 'Antarctica/DumontDUrville', '+10:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(11, 8, 'Antarctica/Mawson', '+05:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(12, 8, 'Antarctica/McMurdo', '+13:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(13, 8, 'Antarctica/Palmer', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(14, 8, 'Antarctica/Rothera', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(15, 8, 'Antarctica/Syowa', '+03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(16, 8, 'Antarctica/Troll', 'UTC', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(17, 8, 'Antarctica/Vostok', '+06:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(18, 9, 'America/Antigua', '-04:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(19, 10, 'America/Argentina/Buenos_Aires', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(20, 10, 'America/Argentina/Catamarca', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(21, 10, 'America/Argentina/Cordoba', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(22, 10, 'America/Argentina/Jujuy', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(23, 10, 'America/Argentina/La_Rioja', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:18'),
(24, 10, 'America/Argentina/Mendoza', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(25, 10, 'America/Argentina/Rio_Gallegos', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(26, 10, 'America/Argentina/Salta', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(27, 10, 'America/Argentina/San_Juan', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(28, 10, 'America/Argentina/San_Luis', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(29, 10, 'America/Argentina/Tucuman', '-03:00', 'A', 1, '2019-12-26 15:37:58', '2019-12-27 11:46:19'),
(30, 10, 'America/Argentina/Ushuaia', '-03:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(31, 11, 'Asia/Yerevan', '+04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(32, 12, 'America/Aruba', '-04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(33, 13, 'Antarctica/Macquarie', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(34, 13, 'Australia/Adelaide', '+10:30', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(35, 13, 'Australia/Brisbane', '+10:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(36, 13, 'Australia/Broken_Hill', '+10:30', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(37, 13, 'Australia/Currie', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(38, 13, 'Australia/Darwin', '+09:30', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(39, 13, 'Australia/Eucla', '+08:45', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(40, 13, 'Australia/Hobart', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:19'),
(41, 13, 'Australia/Lindeman', '+10:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(42, 13, 'Australia/Lord_Howe', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(43, 13, 'Australia/Melbourne', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(44, 13, 'Australia/Perth', '+08:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(45, 13, 'Australia/Sydney', '+11:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(46, 14, 'Europe/Vienna', '+01:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(47, 15, 'Asia/Baku', '+04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(48, 16, 'America/Nassau', '-05:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(49, 17, 'Asia/Bahrain', '+03:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(50, 18, 'Asia/Dhaka', '+06:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(51, 19, 'America/Barbados', '-04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(52, 20, 'Europe/Minsk', '+03:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(53, 21, 'Europe/Brussels', '+01:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(54, 22, 'America/Belize', '-06:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(55, 23, 'Africa/Porto-Novo', '+01:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(56, 24, 'Atlantic/Bermuda', '-04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:20'),
(57, 25, 'Asia/Thimphu', '+06:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:21'),
(58, 26, 'America/La_Paz', '-04:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:46:21'),
(60, 27, 'Europe/Sarajevo', '+01:00', 'A', 1, '2019-12-26 15:54:22', '2019-12-27 11:47:59'),
(61, 28, 'Africa/Gaborone', '+02:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(62, 30, 'America/Araguaina', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(63, 30, 'America/Bahia', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(64, 30, 'America/Belem', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(65, 30, 'America/Boa_Vista', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(66, 30, 'America/Campo_Grande', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:47:59'),
(67, 30, 'America/Cuiaba', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(68, 30, 'America/Eirunepe', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(69, 30, 'America/Fortaleza', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(70, 30, 'America/Maceio', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(71, 30, 'America/Manaus', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(72, 30, 'America/Noronha', '-02:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(73, 30, 'America/Porto_Velho', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(74, 30, 'America/Recife', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(75, 30, 'America/Rio_Branco', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(76, 30, 'America/Santarem', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(77, 30, 'America/Sao_Paulo', '-03:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(78, 31, 'Indian/Chagos', '+06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(79, 32, 'Asia/Brunei', '+08:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(80, 33, 'Europe/Sofia', '+02:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(81, 34, 'Africa/Ouagadougou', 'UTC', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(82, 35, 'Africa/Bujumbura', '+02:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(83, 36, 'Asia/Phnom_Penh', '+07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:00'),
(84, 37, 'Africa/Douala', '+01:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(85, 38, 'America/Atikokan', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(86, 38, 'America/Blanc-Sablon', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(87, 38, 'America/Cambridge_Bay', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(88, 38, 'America/Creston', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(89, 38, 'America/Dawson', '-08:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(90, 38, 'America/Dawson_Creek', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(91, 38, 'America/Edmonton', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(92, 38, 'America/Fort_Nelson', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(93, 38, 'America/Glace_Bay', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(94, 38, 'America/Goose_Bay', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(95, 38, 'America/Halifax', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(96, 38, 'America/Inuvik', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(97, 38, 'America/Iqaluit', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(98, 38, 'America/Moncton', '-04:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(99, 38, 'America/Nipigon', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:01'),
(100, 38, 'America/Pangnirtung', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(101, 38, 'America/Rainy_River', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(102, 38, 'America/Rankin_Inlet', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(103, 38, 'America/Regina', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(104, 38, 'America/Resolute', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(105, 38, 'America/St_Johns', '-03:30', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(106, 38, 'America/Swift_Current', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(107, 38, 'America/Thunder_Bay', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(108, 38, 'America/Toronto', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(109, 38, 'America/Vancouver', '-08:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(110, 38, 'America/Whitehorse', '-08:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(111, 38, 'America/Winnipeg', '-06:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(112, 38, 'America/Yellowknife', '-07:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(113, 39, 'Atlantic/Cape_Verde', '-01:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(114, 40, 'America/Cayman', '-05:00', 'A', 1, '2019-12-27 12:18:13', '2019-12-27 11:48:02'),
(115, 41, 'Africa/Bangui', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:02'),
(116, 42, 'Africa/Ndjamena', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:02'),
(117, 43, 'America/Punta_Arenas', '-03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:02'),
(118, 43, 'America/Santiago', '-03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(119, 43, 'Pacific/Easter', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(120, 44, 'Asia/Shanghai', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(121, 44, 'Asia/Urumqi', '+06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(122, 45, 'Indian/Christmas', '+07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(123, 46, 'Indian/Cocos', '+06:30', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(124, 47, 'America/Bogota', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(125, 48, 'Indian/Comoro', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(126, 49, 'Africa/Brazzaville', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(127, 50, 'Africa/Kinshasa', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(128, 50, 'Africa/Lubumbashi', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(129, 51, 'Pacific/Rarotonga', '-10:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(130, 52, 'America/Costa_Rica', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(131, 54, 'Europe/Zagreb', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(132, 55, 'America/Havana', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(134, 56, 'Asia/Famagusta', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(135, 56, 'Asia/Nicosia', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:03'),
(136, 57, 'Europe/Prague', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(137, 53, 'Africa/Abidjan', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(138, 58, 'Europe/Copenhagen', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(139, 59, 'Africa/Djibouti', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(140, 60, 'America/Dominica', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(141, 61, 'America/Santo_Domingo', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(142, 63, 'America/Guayaquil', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(143, 63, 'Pacific/Galapagos', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(144, 64, 'Africa/Cairo', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(145, 65, 'America/El_Salvador', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(146, 66, 'Africa/Malabo', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(147, 67, 'Africa/Asmara', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(148, 68, 'Europe/Tallinn', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(149, 69, 'Africa/Addis_Ababa', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(150, 71, 'Atlantic/Stanley', '-03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(151, 72, 'Atlantic/Faroe', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(152, 73, 'Pacific/Fiji', '+13:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(153, 74, 'Europe/Helsinki', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:04'),
(154, 75, 'Europe/Paris', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(155, 76, 'America/Cayenne', '-03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(156, 77, 'Pacific/Gambier', '-09:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(157, 77, 'Pacific/Marquesas', '-09:30', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(158, 77, 'Pacific/Tahiti', '-10:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(159, 78, 'Indian/Kerguelen', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(160, 79, 'Africa/Libreville', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(161, 80, 'Africa/Banjul', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(162, 81, 'Asia/Tbilisi', '+04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(163, 82, 'Europe/Berlin', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(164, 82, 'Europe/Busingen', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(165, 83, 'Africa/Accra', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(166, 84, 'Europe/Gibraltar', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(167, 85, 'Europe/Athens', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(168, 86, 'America/Danmarkshavn', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(169, 86, 'America/Godthab', '-03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(170, 86, 'America/Scoresbysund', '-01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(171, 86, 'America/Thule', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:05'),
(172, 87, 'America/Grenada', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(173, 88, 'America/Guadeloupe', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(174, 89, 'Pacific/Guam', '+10:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(175, 90, 'America/Guatemala', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(177, 92, 'Africa/Conakry', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(178, 93, 'Africa/Bissau', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(179, 94, 'America/Guyana', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(180, 95, 'America/Port-au-Prince', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(181, 236, 'Europe/Vatican', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(182, 97, 'America/Tegucigalpa', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(183, 98, 'Asia/Hong_Kong', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(184, 99, 'Europe/Budapest', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(185, 100, 'Atlantic/Reykjavik', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(186, 101, 'Asia/Kolkata', '+05:30', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(187, 102, 'Asia/Jakarta', '+07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(188, 102, 'Asia/Jayapura', '+09:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(189, 102, 'Asia/Makassar', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(190, 102, 'Asia/Pontianak', '+07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:06'),
(191, 103, 'Asia/Tehran', '+03:30', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(192, 104, 'Asia/Baghdad', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(193, 105, 'Europe/Dublin', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(195, 106, 'Asia/Jerusalem', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(196, 107, 'Europe/Rome', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(197, 108, 'America/Jamaica', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(198, 109, 'Asia/Tokyo', '+09:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(200, 111, 'Asia/Amman', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(201, 112, 'Asia/Almaty', '+06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(202, 112, 'Asia/Aqtau', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(203, 112, 'Asia/Aqtobe', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(204, 112, 'Asia/Atyrau', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(205, 112, 'Asia/Oral', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(206, 112, 'Asia/Qostanay', '+06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(207, 112, 'Asia/Qyzylorda', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(208, 113, 'Africa/Nairobi', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(209, 114, 'Pacific/Enderbury', '+13:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:07'),
(210, 114, 'Pacific/Kiritimati', '+14:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(211, 114, 'Pacific/Tarawa', '+12:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(212, 115, 'Asia/Pyongyang', '+09:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(213, 116, 'Asia/Seoul', '+09:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(214, 117, 'Asia/Kuwait', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(215, 118, 'Asia/Bishkek', '+06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(216, 119, 'Asia/Vientiane', '+07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(217, 120, 'Europe/Riga', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(218, 121, 'Asia/Beirut', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(219, 122, 'Africa/Maseru', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(220, 123, 'Africa/Monrovia', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(221, 124, 'Africa/Tripoli', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(222, 125, 'Europe/Vaduz', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(223, 126, 'Europe/Vilnius', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(224, 127, 'Europe/Luxembourg', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(225, 128, 'Asia/Macau', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(226, 129, 'Europe/Skopje', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:08'),
(227, 130, 'Indian/Antananarivo', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(228, 131, 'Africa/Blantyre', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(229, 132, 'Asia/Kuala_Lumpur', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(230, 132, 'Asia/Kuching', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(231, 133, 'Indian/Maldives', '+05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(232, 134, 'Africa/Bamako', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(233, 135, 'Europe/Malta', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(234, 137, 'Pacific/Kwajalein', '+12:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(235, 137, 'Pacific/Majuro', '+12:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(236, 138, 'America/Martinique', '-04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(237, 139, 'Africa/Nouakchott', 'UTC', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(238, 140, 'Indian/Mauritius', '+04:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(239, 141, 'Indian/Mayotte', '+03:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(240, 142, 'America/Bahia_Banderas', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(241, 142, 'America/Cancun', '-05:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(242, 142, 'America/Chihuahua', '-07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(243, 142, 'America/Hermosillo', '-07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(244, 142, 'America/Matamoros', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(245, 142, 'America/Mazatlan', '-07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:09'),
(246, 142, 'America/Merida', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(247, 142, 'America/Mexico_City', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(248, 142, 'America/Monterrey', '-06:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(249, 142, 'America/Ojinaga', '-07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(250, 142, 'America/Tijuana', '-08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(251, 143, 'Pacific/Chuuk', '+10:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(252, 143, 'Pacific/Kosrae', '+11:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(253, 143, 'Pacific/Pohnpei', '+11:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(254, 144, 'Europe/Chisinau', '+02:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(255, 145, 'Europe/Monaco', '+01:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(256, 146, 'Asia/Choibalsan', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(257, 146, 'Asia/Hovd', '+07:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10'),
(258, 146, 'Asia/Ulaanbaatar', '+08:00', 'A', 1, '2019-12-27 14:56:38', '2019-12-27 11:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password_reset_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expiry` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `setting_json` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `is_active`, `status`, `is_admin`, `password_reset_code`, `password_reset_expiry`, `remember_token`, `created_at`, `created_by`, `updated_by`, `updated_at`, `is_deleted`, `setting_json`) VALUES
(1, 'Super Admin', 'super_admin@gmail.com', '4578523125', '2020-04-24 06:42:00', '$2y$10$N7DZnIx8rz7b0Xz7akL4sukU7wSb0zW81oETY5wFLojVZOWDVZrhW', 1, 'A', 1, NULL, NULL, 'bZtjM9aMytcKHsiI0kTZ3pATM6dknZD1OSedauX6G3f6NKYdB5StDIKxTytU', '2020-04-24 06:42:00', NULL, NULL, '2020-04-24 06:42:00', 'N', '{\"timezone\":\"Asia\\/Kolkata\",\"date_format\":\"d-M-Y\",\"time_format\":\"g:i A\",\"vat_value_for_pr_copywrite\":\"43\",\"vat_value_for_press_release\":\"43\",\"facebook_link\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_link\":\"https:\\/\\/twitter.com\\/\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/\",\"instagram_link\":\"https:\\/\\/www.instagram.com\\/login\",\"vimeo_link\":\"https:\\/\\/www.vimeo.com\",\"return_request\":\"no\",\"limitation_count\":\"\",\"currency_symbol\":\"\\u0192\",\"currency_code\":\"AWG\"}'),
(2, 'Test User', 'test@gmail.com', '7872503102', '2020-04-25 18:30:00', '$2y$10$N7DZnIx8rz7b0Xz7akL4sukU7wSb0zW81oETY5wFLojVZOWDVZrhW', 1, 'A', 1, NULL, NULL, NULL, '2020-04-25 18:30:00', NULL, NULL, '2020-04-25 18:30:00', 'N', NULL),
(3, 'Rajashree', 'r@yopmail.com', '7876567234', NULL, '$2y$10$iOzF7C0N.AikVosQ2ZsbQuoVIWfdtWmXu0PnCcDxluYXWA40RW7Ge', 1, 'A', 0, NULL, NULL, NULL, '2021-03-26 00:46:29', 1, 1, '2021-03-26 00:46:29', 'N', '{\"timezone\":\"Asia/Kolkata\",\"date_format\":\"Y-m-d\"}'),
(4, 'Manager', 'manager@gmail.com', '7872503102', NULL, '$2y$10$9SiSZHDjCo1313K0oNYru.gRbVWuGi.GqKqMvXLEbfkBsBj8iqVlS', 1, 'A', 0, NULL, NULL, NULL, '2021-03-26 01:17:31', 1, 1, '2021-03-26 01:27:12', 'N', '{\"timezone\":\"Asia/Kolkata\",\"date_format\":\"Y-m-d\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_images`
--
ALTER TABLE `cms_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_images`
--
ALTER TABLE `home_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_galleries`
--
ALTER TABLE `home_page_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_faqs`
--
ALTER TABLE `project_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_galleries`
--
ALTER TABLE `project_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_near_places`
--
ALTER TABLE `project_near_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_services`
--
ALTER TABLE `project_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_units`
--
ALTER TABLE `project_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_unit_galleries`
--
ALTER TABLE `project_unit_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cms_images`
--
ALTER TABLE `cms_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_images`
--
ALTER TABLE `home_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home_page_galleries`
--
ALTER TABLE `home_page_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_faqs`
--
ALTER TABLE `project_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_galleries`
--
ALTER TABLE `project_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_near_places`
--
ALTER TABLE `project_near_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_services`
--
ALTER TABLE `project_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_units`
--
ALTER TABLE `project_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_unit_galleries`
--
ALTER TABLE `project_unit_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
