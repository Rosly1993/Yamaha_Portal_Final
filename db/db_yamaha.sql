/*
 Navicat Premium Dump SQL

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_yamaha

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 18/08/2024 13:34:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2024-08-12-134513', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1723470340, 1);
INSERT INTO `migrations` VALUES (2, '2024-08-12-134924', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1723470578, 2);

-- ----------------------------
-- Table structure for tbl_log_details
-- ----------------------------
DROP TABLE IF EXISTS `tbl_log_details`;
CREATE TABLE `tbl_log_details`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `date_record` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_log_details
-- ----------------------------
INSERT INTO `tbl_log_details` VALUES (1, 'RR', 'Login', 'Successful login.', '2024-08-18 08:55:51');
INSERT INTO `tbl_log_details` VALUES (2, 'RR', 'Login', 'Failed login - Incorrect password.', '2024-08-18 08:57:04');
INSERT INTO `tbl_log_details` VALUES (3, 'RR', 'Login', 'Successful login.', '2024-08-18 08:57:24');
INSERT INTO `tbl_log_details` VALUES (4, 'RR', 'Logout', 'User logged out.', '2024-08-18 08:57:30');
INSERT INTO `tbl_log_details` VALUES (5, 'RR', 'Login', 'Successful login.', '2024-08-18 08:57:57');
INSERT INTO `tbl_log_details` VALUES (6, 'RR', 'Add', 'Added a new motorcycle: test1', '2024-08-18 09:08:11');
INSERT INTO `tbl_log_details` VALUES (7, 'RR', 'Add', '{\"pet_name\":\"sfsdf\",\"model_code\":\"sds\",\"model_name\":\"dsds\",\"model_type\":\"dsd\",\"category\":\"dad\",\"lastname\":null,\"is_active\":1,\"created_at\":\"2024-08-18 09:14:27\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 09:14:27');
INSERT INTO `tbl_log_details` VALUES (8, 'RR', 'Update', '{\"pet_name\":\"TEST\",\"model_code\":\"SDS\",\"model_name\":\"DSDS\",\"model_type\":\"DSD\",\"category\":\"DAD\",\"updated_at\":\"2024-08-18 09:16:21\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 09:16:21');
INSERT INTO `tbl_log_details` VALUES (9, 'RR', 'Activate Motorcycle', '{\"id\":\"00001\",\"pet_name\":\"test1\",\"model_code\":\"test1\",\"model_name\":\"test1\",\"model_type\":\"test1\",\"category\":\"test1\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 09:07:42\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 09:20:52');
INSERT INTO `tbl_log_details` VALUES (10, 'RR', 'Activate Motorcycle List', '{\"id\":\"00002\",\"pet_name\":\"test1\",\"model_code\":\"test1\",\"model_name\":\"test1\",\"model_type\":\"test1\",\"category\":\"test\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 09:08:11\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 09:23:02');
INSERT INTO `tbl_log_details` VALUES (11, 'RR', 'Activate Motorcycle List', '{\"id\":\"00003\",\"pet_name\":\"TEST\",\"model_code\":\"SDS\",\"model_name\":\"DSDS\",\"model_type\":\"DSD\",\"category\":\"DAD\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 09:14:27\",\"updated_by\":\"Rosly Rapada\",\"updated_at\":\"2024-08-18 09:16:21\"}', '2024-08-18 09:23:06');
INSERT INTO `tbl_log_details` VALUES (12, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"001\",\"model_code\":\"test\",\"model_name\":\"test\",\"model_type\":\"test\",\"category\":\"test\",\"lastname\":null,\"is_active\":1,\"created_at\":\"2024-08-18 09:23:37\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 09:23:37');
INSERT INTO `tbl_log_details` VALUES (13, 'RR', 'Update Motorcycle List', '{\"pet_name\":\"001\",\"model_code\":\"TEST\",\"model_name\":\"TEST\",\"model_type\":\"TEST77\",\"category\":\"TEST\",\"updated_at\":\"2024-08-18 09:24:04\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 09:24:04');
INSERT INTO `tbl_log_details` VALUES (14, 'RR', 'Add Motorcycle Category', '{\"model_type\":\"B\",\"category\":\"A\",\"lastname\":null,\"is_active\":1,\"created_at\":\"2024-08-18 09:59:59\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 09:59:59');
INSERT INTO `tbl_log_details` VALUES (15, 'RR', 'Add Motorcycle Category', '{\"model_type\":\"TEST\",\"category\":\"TEST\",\"is_active\":1,\"created_at\":\"2024-08-18 10:01:47\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 10:01:47');
INSERT INTO `tbl_log_details` VALUES (16, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"AS\",\"model_code\":\"AS\",\"model_name\":\"AS\",\"model_type\":\"AS\",\"category\":\"AS\",\"lastname\":null,\"is_active\":1,\"created_at\":\"2024-08-18 10:12:35\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 10:12:35');
INSERT INTO `tbl_log_details` VALUES (17, 'RR', 'Update Motorcycle Category', '{\"model_type\":\"AUTOMATIC\",\"category\":\"COMMUTER TYPE\",\"updated_at\":\"2024-08-18 10:14:10\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 10:14:10');
INSERT INTO `tbl_log_details` VALUES (18, 'RR', 'Update Motorcycle Category', '{\"model_type\":\"HYPER NAKED\",\"category\":\"SPORTS MACHINE\",\"updated_at\":\"2024-08-18 10:14:55\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 10:14:55');
INSERT INTO `tbl_log_details` VALUES (19, 'RR', 'Add Motorcycle Category', '{\"model_type\":\"OFFROAD\",\"category\":\"COMPETITION\",\"is_active\":1,\"created_at\":\"2024-08-18 10:15:13\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 10:15:13');
INSERT INTO `tbl_log_details` VALUES (20, 'RR', 'Deactivate Motorcycle Category', '{\"id\":\"00000000003\",\"category\":\"COMPETITION\",\"model_type\":\"OFFROAD\",\"is_active\":\"1\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:15:13\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 10:15:32');
INSERT INTO `tbl_log_details` VALUES (21, 'RR', 'Activate Motorcycle Category', '{\"id\":\"00000000003\",\"category\":\"COMPETITION\",\"model_type\":\"OFFROAD\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:15:13\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 10:15:40');
INSERT INTO `tbl_log_details` VALUES (22, 'RR', 'Add Motorcycle Category', '{\"model_type\":\"MOPED\",\"category\":\"COMMUTER TYPE\",\"is_active\":1,\"created_at\":\"2024-08-18 11:03:45\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 11:03:45');
INSERT INTO `tbl_log_details` VALUES (23, 'RR', 'Deactivate Motorcycle Category', '{\"id\":\"00000000002\",\"category\":\"SPORTS MACHINE\",\"model_type\":\"HYPER NAKED\",\"is_active\":\"1\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:01:47\",\"updated_by\":\"Rosly Rapada\",\"updated_at\":\"2024-08-18 10:14:55\"}', '2024-08-18 11:24:27');
INSERT INTO `tbl_log_details` VALUES (24, 'RR', 'Deactivate Motorcycle Category', '{\"id\":\"00000000003\",\"category\":\"COMPETITION\",\"model_type\":\"OFFROAD\",\"is_active\":\"1\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:15:13\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 11:24:30');
INSERT INTO `tbl_log_details` VALUES (25, 'RR', 'Deactivate Motorcycle Category', '{\"id\":\"00000000004\",\"category\":\"COMMUTER TYPE\",\"model_type\":\"MOPED\",\"is_active\":\"1\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 11:03:45\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 11:24:32');
INSERT INTO `tbl_log_details` VALUES (26, 'RR', 'Activate Motorcycle Category', '{\"id\":\"00000000002\",\"category\":\"SPORTS MACHINE\",\"model_type\":\"HYPER NAKED\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:01:47\",\"updated_by\":\"Rosly Rapada\",\"updated_at\":\"2024-08-18 10:14:55\"}', '2024-08-18 11:26:52');
INSERT INTO `tbl_log_details` VALUES (27, 'RR', 'Activate Motorcycle Category', '{\"id\":\"00000000004\",\"category\":\"COMMUTER TYPE\",\"model_type\":\"MOPED\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 11:03:45\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 11:27:11');
INSERT INTO `tbl_log_details` VALUES (28, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"TEST1\",\"model_code\":\"SDS\",\"model_name\":\"DSD\",\"model_type\":\"00000000001\",\"category\":\"COMMUTER TYPE\",\"is_active\":1,\"created_at\":\"2024-08-18 11:27:36\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 11:27:36');
INSERT INTO `tbl_log_details` VALUES (29, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"RTRT\",\"model_code\":\"TTRT\",\"model_name\":\"GRGR\",\"model_type\":\"00000000004\",\"category\":\"COMMUTER TYPE\",\"is_active\":1,\"created_at\":\"2024-08-18 11:28:25\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 11:28:25');
INSERT INTO `tbl_log_details` VALUES (30, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"TEST\",\"model_code\":\"TEST\",\"model_name\":\"TEST\",\"model_type\":\"00000000001\",\"category\":\"COMMUTER TYPE\",\"is_active\":1,\"created_at\":\"2024-08-18 11:30:07\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 11:30:07');
INSERT INTO `tbl_log_details` VALUES (31, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"TEQ\",\"model_code\":\"TEQ\",\"model_name\":\"TEQ\",\"model_type\":\"HYPER NAKED\",\"category\":\"SPORTS MACHINE\",\"is_active\":1,\"created_at\":\"2024-08-18 12:59:04\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 12:59:04');
INSERT INTO `tbl_log_details` VALUES (32, 'RR', 'Add Motorcycle List', '{\"pet_name\":\"SFSDF\",\"model_code\":\"DFDFD\",\"model_name\":\"FDFD\",\"model_type\":\"MOPED\",\"category\":\"COMMUTER TYPE\",\"is_active\":1,\"created_at\":\"2024-08-18 12:59:57\",\"created_by\":\"Rosly Rapada\"}', '2024-08-18 12:59:57');
INSERT INTO `tbl_log_details` VALUES (33, 'RR', 'Update Motorcycle List', '{\"pet_name\":\"TEST\",\"model_code\":\"TEST\",\"model_name\":\"TEST\",\"model_type\":\"MOPED\",\"category\":\"COMMUTER TYPE\",\"updated_at\":\"2024-08-18 13:05:53\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 13:05:53');
INSERT INTO `tbl_log_details` VALUES (34, 'RR', 'Deactivate Motorcycle Category', '{\"id\":\"00000000001\",\"category\":\"COMMUTER TYPE\",\"model_type\":\"AUTOMATIC\",\"is_active\":\"1\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 09:59:59\",\"updated_by\":\"Rosly Rapada\",\"updated_at\":\"2024-08-18 10:14:10\"}', '2024-08-18 13:06:37');
INSERT INTO `tbl_log_details` VALUES (35, 'RR', 'Activate Motorcycle Category', '{\"id\":\"00000000001\",\"category\":\"COMMUTER TYPE\",\"model_type\":\"AUTOMATIC\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 09:59:59\",\"updated_by\":\"Rosly Rapada\",\"updated_at\":\"2024-08-18 10:14:10\"}', '2024-08-18 13:07:04');
INSERT INTO `tbl_log_details` VALUES (36, 'RR', 'Activate Motorcycle Category', '{\"id\":\"00000000003\",\"category\":\"COMPETITION\",\"model_type\":\"OFFROAD\",\"is_active\":\"0\",\"created_by\":\"Rosly Rapada\",\"created_at\":\"2024-08-18 10:15:13\",\"updated_by\":null,\"updated_at\":null}', '2024-08-18 13:07:08');
INSERT INTO `tbl_log_details` VALUES (37, 'RR', 'Update Motorcycle List', '{\"pet_name\":\"TEQ\",\"model_code\":\"TEQ\",\"model_name\":\"TEQDGF\",\"model_type\":\"HYPER NAKED\",\"category\":\"SPORTS MACHINE\",\"updated_at\":\"2024-08-18 13:20:47\",\"updated_by\":\"Rosly Rapada\"}', '2024-08-18 13:20:47');
INSERT INTO `tbl_log_details` VALUES (38, 'RR', 'Logout', 'User logged out.', '2024-08-18 13:33:08');
INSERT INTO `tbl_log_details` VALUES (39, 'RR', 'Login', 'Successful login.', '2024-08-18 13:33:41');

-- ----------------------------
-- Table structure for tbl_motorcycle_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_motorcycle_category`;
CREATE TABLE `tbl_motorcycle_category`  (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_motorcycle_category
-- ----------------------------
INSERT INTO `tbl_motorcycle_category` VALUES (00000000001, 'COMMUTER TYPE', 'AUTOMATIC', 1, 'Rosly Rapada', '2024-08-18 09:59:59', 'Rosly Rapada', '2024-08-18 10:14:10');
INSERT INTO `tbl_motorcycle_category` VALUES (00000000002, 'SPORTS MACHINE', 'HYPER NAKED', 1, 'Rosly Rapada', '2024-08-18 10:01:47', 'Rosly Rapada', '2024-08-18 10:14:55');
INSERT INTO `tbl_motorcycle_category` VALUES (00000000003, 'COMPETITION', 'OFFROAD', 1, 'Rosly Rapada', '2024-08-18 10:15:13', NULL, NULL);
INSERT INTO `tbl_motorcycle_category` VALUES (00000000004, 'COMMUTER TYPE', 'MOPED', 1, 'Rosly Rapada', '2024-08-18 11:03:45', NULL, NULL);

-- ----------------------------
-- Table structure for tbl_motorcyclelist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_motorcyclelist`;
CREATE TABLE `tbl_motorcyclelist`  (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `model_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `model_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `model_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_motorcyclelist
-- ----------------------------
INSERT INTO `tbl_motorcyclelist` VALUES (00001, 'TEST', 'TEST', 'TEST', 'MOPED', 'COMMUTER TYPE', 1, 'Rosly Rapada', '2024-08-18 11:30:07', 'Rosly Rapada', '2024-08-18 13:05:53');
INSERT INTO `tbl_motorcyclelist` VALUES (00002, 'TEQ', 'TEQ', 'TEQDGF', 'HYPER NAKED', 'SPORTS MACHINE', 1, 'Rosly Rapada', '2024-08-18 12:59:04', 'Rosly Rapada', '2024-08-18 13:20:47');
INSERT INTO `tbl_motorcyclelist` VALUES (00003, 'SFSDF', 'DFDFD', 'FDFD', 'MOPED', 'COMMUTER TYPE', 1, 'Rosly Rapada', '2024-08-18 12:59:57', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  `last_login_date` datetime NULL DEFAULT NULL,
  `last_update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (00001, 'RR', 'admin@mail.com', '$2y$10$74KR7BL3HBoPFrojMX9y.OMASdwNgT/CNwIhA2fRkpBDvs/S/T1sS', NULL, NULL, 'Rosly', 'Barlongay', 'Rapada', 1, '2024-08-18 13:33:41', '2024-05-25 23:19:52');
INSERT INTO `users` VALUES (00006, 'TEST1234567', '123roslyrapada@gmail.com', '$2y$10$FDMXaQ8zak4EayfpGvXId..O3WNz4/JZQgxKvTbTicY1hMZARQ.ja', NULL, NULL, 'TEST1234567', 'TEST1234567', 'TEST1234567', 1, NULL, NULL);
INSERT INTO `users` VALUES (00007, 'DSDSADSDS', 'roslyrapada@gmail.com123', '$2y$10$VN.WhmtgL5NQ6HVnx71QuOFNjZuaAOoaUzQWuatOpJ/OIZL6KAapG', NULL, NULL, 'DSDSADSDS', 'DSDSADSDS', 'DSDSADSDS', 1, NULL, NULL);
INSERT INTO `users` VALUES (00008, 'Test123*', 'r11oslyrapada@gmail.com', '$2y$10$fS3cnO539VX.rm2Vk/0hoecYgAJykx0uHzWE6alnvviVFEfJ1W5DG', NULL, NULL, 'DRYTRY', 'TYTYT', 'TRYYUTYTA', 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
