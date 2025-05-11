/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80041 (8.0.41)
 Source Host           : localhost:3306
 Source Schema         : traffic_violations

 Target Server Type    : MySQL
 Target Server Version : 80041 (8.0.41)
 File Encoding         : 65001

 Date: 12/05/2025 00:07:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Admin', 'admin@example.com', '$2y$12$jHQhRJkMVuiJ4jowwYknnu.8cDckc9p6UygQYyxp6cpFt5usWJVsu', 'super_admin', NULL, '2025-05-10 13:51:10', '2025-05-10 13:54:42');
INSERT INTO `admins` VALUES (2, 'Nguyễn Viết Thắng', 'nguyenvietthang12092004@gmail.com', '$2y$12$cHGQLJh5R4/hF9ipX2kSGOxRUgvMr/PNhIIZOlnCBoq2e/hs9MWla', 'admin', NULL, '2025-05-11 04:21:02', '2025-05-11 04:21:02');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_05_06_151708_create_vehicles_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_05_06_151725_create_violations_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_05_06_170337_create_owners_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_05_06_170400_add_columns_to_vehicles_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_05_06_170422_add_payment_columns_to_violations_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_05_06_170908_drop_owner_name_from_vehicles_table', 1);
INSERT INTO `migrations` VALUES (11, '2025_05_10_131957_create_admins_table', 1);
INSERT INTO `migrations` VALUES (12, '2025_05_10_174100_add_evidence_image_to_violations_table', 2);
INSERT INTO `migrations` VALUES (13, '2025_05_11_035732_create_traffic_situations_table', 3);

-- ----------------------------
-- Table structure for owners
-- ----------------------------
DROP TABLE IF EXISTS `owners`;
CREATE TABLE `owners`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `owners_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of owners
-- ----------------------------
INSERT INTO `owners` VALUES (1, 'Nguyễn Văn A', 'nva@example.com', '0901234567', 'Hà Nội', '2025-05-10 13:51:10', '2025-05-10 13:51:10');
INSERT INTO `owners` VALUES (2, 'Trần Thị B', 'ttb@example.com', '0901234568', 'TP.HCM', '2025-05-10 13:51:10', '2025-05-10 13:51:10');
INSERT INTO `owners` VALUES (3, 'Vi Xuân Cử', 'nguyenvietthang12092004@gmail.com', '0326270550', '296 Cầu giấy HN', '2025-05-10 16:59:47', '2025-05-10 16:59:47');
INSERT INTO `owners` VALUES (20, 'Nguyễn Văn An', 'abc@gmail.com', '0901234567', 'Số 123 Đường Lê Lợi, Quận 1, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 06:40:58');
INSERT INTO `owners` VALUES (21, 'Trần Thị Bình', NULL, '0912345678', 'Số 45 Đường Nguyễn Huệ, Quận 1, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (22, 'Lê Văn Công', NULL, '0923456789', 'Số 67 Đường Lý Tự Trọng, Quận 3, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (23, 'Phạm Thị Dung', NULL, '0934567890', 'Số 89 Đường Võ Thị Sáu, Quận 3, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (24, 'Hoàng Văn Em', NULL, '0945678901', 'Số 101 Đường Nam Kỳ Khởi Nghĩa, Quận 3, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (25, 'Đỗ Thị Phương', NULL, '0956789012', 'Số 23 Đường Cách Mạng Tháng Tám, Quận 10, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (26, 'Vũ Văn Giang', NULL, '0967890123', 'Số 45 Đường 3/2, Quận 10, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (27, 'Ngô Thị Hương', NULL, '0978901234', 'Số 67 Đường Điện Biên Phủ, Quận Bình Thạnh, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (28, 'Đặng Văn Ích', NULL, '0989012345', 'Số 89 Đường Xô Viết Nghệ Tĩnh, Quận Bình Thạnh, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');
INSERT INTO `owners` VALUES (29, 'Bùi Thị Khanh', NULL, '0990123456', 'Số 111 Đường D2, Quận Bình Thạnh, TP.HCM', '2025-05-11 13:32:07', '2025-05-11 13:32:07');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for traffic_situations
-- ----------------------------
DROP TABLE IF EXISTS `traffic_situations`;
CREATE TABLE `traffic_situations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of traffic_situations
-- ----------------------------
INSERT INTO `traffic_situations` VALUES (1, 'Đường Nguyễn Trãi', 'Ùn tắc nghiêm trọng do tai nạn lúc 7:00 sáng.', 'Hà Nội', '2025-05-11 04:12:27', '2025-05-11 08:12:00');
INSERT INTO `traffic_situations` VALUES (2, 'Cầu Sài Gòn', 'Giao thông thông thoáng, không có sự cố.', 'TP.HCM', '2025-05-11 04:12:27', '2025-05-11 04:12:27');
INSERT INTO `traffic_situations` VALUES (3, 'Đường Hùng Vương', 'Tắc nghẽn nhẹ do công trình sửa đường.', 'Đà Nẵng', '2025-05-11 04:12:27', '2025-05-11 04:12:27');
INSERT INTO `traffic_situations` VALUES (4, 'Đường Láng', 'Đang có sự kiện, giao thông đông đúc.', 'Hà Nội', '2025-05-11 04:12:27', '2025-05-11 02:12:27');
INSERT INTO `traffic_situations` VALUES (5, 'Đường Võ Văn Kiệt', 'Giao thông bình thường, di chuyển thuận lợi.', 'TP.HCM', '2025-05-11 04:12:27', '2025-05-11 01:12:27');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for vehicles
-- ----------------------------
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `license_plate` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `owner_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `vehicles_license_plate_unique`(`license_plate` ASC) USING BTREE,
  INDEX `vehicles_owner_id_foreign`(`owner_id` ASC) USING BTREE,
  CONSTRAINT `vehicles_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicles
-- ----------------------------
INSERT INTO `vehicles` VALUES (1, '30A-12345', 'Car', '2025-05-10 13:51:10', '2025-05-10 13:51:10', 'Toyota', 'Camry', 1);
INSERT INTO `vehicles` VALUES (2, '51H-67890', 'Motorcycle', '2025-05-10 13:51:10', '2025-05-10 13:51:10', 'Honda', 'Wave', 2);
INSERT INTO `vehicles` VALUES (3, '29B-54321', 'Car', '2025-05-10 13:51:10', '2025-05-10 13:51:10', 'Honda', 'Civic', 1);
INSERT INTO `vehicles` VALUES (4, '98H1-11439', 'Motorcycle', '2025-05-10 17:01:11', '2025-05-10 17:01:11', 'Honda', 'Wave', 3);
INSERT INTO `vehicles` VALUES (5, '30A-12340', 'Truck', '2025-05-11 06:19:51', '2025-05-11 06:19:51', 'Honda', 'Hyundai', 3);
INSERT INTO `vehicles` VALUES (20, '51A-12345', 'Ô tô', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Toyota', 'Vios', 20);
INSERT INTO `vehicles` VALUES (21, '51B-23456', 'Ô tô', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Honda', 'City', 21);
INSERT INTO `vehicles` VALUES (22, '59C-34567', 'Ô tô', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Ford', 'Ranger', 22);
INSERT INTO `vehicles` VALUES (23, '51D-45678', 'Ô tô', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Mazda', 'CX-5', 23);
INSERT INTO `vehicles` VALUES (24, '59E-56789', 'Ô tô', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Hyundai', 'Accent', 24);
INSERT INTO `vehicles` VALUES (25, '51F-67890', 'Xe máy', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Honda', 'Wave', 25);
INSERT INTO `vehicles` VALUES (26, '51G-78901', 'Xe máy', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Yamaha', 'Exciter', 26);
INSERT INTO `vehicles` VALUES (27, '59H-89012', 'Xe máy', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Suzuki', 'Raider', 27);
INSERT INTO `vehicles` VALUES (28, '51K-90123', 'Xe máy', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Honda', 'SH', 28);
INSERT INTO `vehicles` VALUES (29, '59L-01234', 'Xe máy', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'Piaggio', 'Vespa', 29);

-- ----------------------------
-- Table structure for violations
-- ----------------------------
DROP TABLE IF EXISTS `violations`;
CREATE TABLE `violations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `violation_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fine_amount` decimal(10, 2) NOT NULL,
  `violation_date` datetime NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `evidence_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('pending','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `violations_vehicle_id_foreign`(`vehicle_id` ASC) USING BTREE,
  CONSTRAINT `violations_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of violations
-- ----------------------------
INSERT INTO `violations` VALUES (1, 1, 'Vượt đèn đỏ', 800000.00, '2025-03-15 00:00:00', 'Hà Nội', NULL, 'pending', '2025-05-10 13:51:10', '2025-05-11 05:26:32', 'Paid', 'Online');
INSERT INTO `violations` VALUES (2, 1, 'Chạy quá tốc độ', 1200000.00, '2025-04-10 00:00:00', 'Hà Nội', NULL, 'pending', '2025-05-10 13:51:10', '2025-05-11 05:26:53', 'Paid', 'Online');
INSERT INTO `violations` VALUES (3, 2, 'Không đội mũ bảo hiểm', 400000.00, '2025-02-20 00:00:00', 'TP.HCM', NULL, 'pending', '2025-05-10 13:51:10', '2025-05-10 13:51:10', 'Paid', 'Offline');
INSERT INTO `violations` VALUES (4, 4, 'Chạy quá tốc độ', 300000.00, '2025-05-08 00:00:00', 'Bắc Giang', NULL, 'pending', '2025-05-10 17:01:47', '2025-05-11 05:36:16', 'Unpaid', 'Offline');
INSERT INTO `violations` VALUES (5, 4, 'Chạy quá tốc độ', 200000.00, '2025-05-10 00:00:00', 'Bắc Giang', 'uploads/violations/1746900292_cr7-hd-surname-number-signature-dy1vxybhdsgx1fl2.jpg', 'pending', '2025-05-10 17:06:02', '2025-05-11 05:36:11', 'Unpaid', 'Online');
INSERT INTO `violations` VALUES (20, 20, 'Vượt đèn đỏ', 1500000.00, '2025-04-01 00:00:00', 'Ngã tư Lê Lợi - Nguyễn Huệ', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 06:44:21', 'Paid', 'Online');
INSERT INTO `violations` VALUES (21, 20, 'Đậu xe sai quy định', 700000.00, '2025-04-10 15:30:00', 'Đường Đồng Khởi', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (22, 21, 'Vượt quá tốc độ', 2500000.00, '2025-04-05 12:45:00', 'Đường Võ Văn Kiệt', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (23, 22, 'Không đội mũ bảo hiểm', 500000.00, '2025-04-12 10:20:00', 'Đường Nguyễn Văn Cừ', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (24, 23, 'Lấn làn đường', 1200000.00, '2025-04-15 17:10:00', 'Cầu Sài Gòn', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (25, 24, 'Vượt đèn đỏ', 1500000.00, '2025-04-18 09:05:00', 'Ngã tư Hàng Xanh', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'paid', NULL);
INSERT INTO `violations` VALUES (26, 25, 'Đi ngược chiều', 1800000.00, '2025-04-20 13:40:00', 'Đường Điện Biên Phủ', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (27, 26, 'Vượt quá tốc độ', 2500000.00, '2025-04-22 11:25:00', 'Xa lộ Hà Nội', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (28, 27, 'Không chấp hành hiệu lệnh', 1000000.00, '2025-04-25 16:50:00', 'Vòng xoay Lý Thái Tổ', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (29, 28, 'Chở quá số người quy định', 800000.00, '2025-04-28 14:15:00', 'Đường Nguyễn Thị Minh Khai', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (30, 20, 'Không có giấy phép lái xe', 3000000.00, '2025-05-01 08:30:00', 'Đường Lê Hồng Phong', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (31, 20, 'Đậu xe nơi cấm đỗ', 700000.00, '2025-05-03 09:45:00', 'Đường Tôn Đức Thắng', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (32, 20, 'Chạy xe ngược chiều', 1800000.00, '2025-05-04 10:55:00', 'Đường Nguyễn Hữu Cảnh', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (33, 20, 'Sử dụng điện thoại khi lái xe', 1000000.00, '2025-05-05 12:20:00', 'Đường Cách Mạng Tháng Tám', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (34, 21, 'Không chấp hành hiệu lệnh', 1000000.00, '2025-05-06 14:35:00', 'Ngã tư Phù Đổng', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (35, 21, 'Vượt đèn vàng', 700000.00, '2025-05-07 16:40:00', 'Đường Lý Thường Kiệt', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (36, 21, 'Vượt quá tốc độ', 2500000.00, '2025-05-08 18:15:00', 'Quốc lộ 1A', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (37, 22, 'Không mang giấy tờ xe', 1200000.00, '2025-05-09 19:25:00', 'Đường Trường Chinh', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (38, 23, 'Đậu xe sai quy định', 700000.00, '2025-05-10 07:10:00', 'Đường Lê Văn Sỹ', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (39, 24, 'Lấn làn đường', 1200000.00, '2025-05-10 08:20:00', 'Đường Nguyễn Thị Thập', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);
INSERT INTO `violations` VALUES (40, 20, 'Vượt đèn đỏ', 1500000.00, '2025-05-11 05:30:00', 'Ngã tư Bảy Hiền', NULL, 'pending', '2025-05-11 13:36:03', '2025-05-11 13:36:03', 'unpaid', NULL);

SET FOREIGN_KEY_CHECKS = 1;
