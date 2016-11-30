/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ordermana

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-01 01:35:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) unsigned zerofill DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '0', '00000000001', '1', '', 'Chuyên làm trắng');

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', 'An Giang', '1');
INSERT INTO `city` VALUES ('2', 'Ba Ria  Vung Tau', '1');
INSERT INTO `city` VALUES ('3', 'Bac Giang', '1');
INSERT INTO `city` VALUES ('4', 'Bac Kan', '1');
INSERT INTO `city` VALUES ('5', 'Bac Lieu', '1');
INSERT INTO `city` VALUES ('6', 'Bac Ninh', '1');
INSERT INTO `city` VALUES ('7', 'Ben Tre', '1');
INSERT INTO `city` VALUES ('8', 'Binh Dinh', '1');
INSERT INTO `city` VALUES ('9', 'Binh Duong', '1');
INSERT INTO `city` VALUES ('10', 'Binh Phuoc', '1');
INSERT INTO `city` VALUES ('11', 'Binh Thuan', '1');
INSERT INTO `city` VALUES ('12', 'Ca Mau', '1');
INSERT INTO `city` VALUES ('13', 'Cao Bang', '1');
INSERT INTO `city` VALUES ('14', 'Dak Lak', '1');
INSERT INTO `city` VALUES ('15', 'Dak Nong', '1');
INSERT INTO `city` VALUES ('16', 'Dien Bien', '1');
INSERT INTO `city` VALUES ('17', 'Dong Nai', '1');
INSERT INTO `city` VALUES ('18', 'Dong Thap', '1');
INSERT INTO `city` VALUES ('19', 'Gia Lai', '1');
INSERT INTO `city` VALUES ('20', 'Ha Giang', '1');
INSERT INTO `city` VALUES ('21', 'Ha Nam', '1');
INSERT INTO `city` VALUES ('22', 'Ha Tinh', '1');
INSERT INTO `city` VALUES ('23', 'Hai Duong', '1');
INSERT INTO `city` VALUES ('24', 'Hau Giang', '1');
INSERT INTO `city` VALUES ('25', 'Hoa Binh', '1');
INSERT INTO `city` VALUES ('26', 'Hung Yen', '1');
INSERT INTO `city` VALUES ('27', 'Khanh Hoa', '1');
INSERT INTO `city` VALUES ('28', 'Kien Giang', '1');
INSERT INTO `city` VALUES ('29', 'Kon Tum', '1');
INSERT INTO `city` VALUES ('30', 'Lai Chau', '1');
INSERT INTO `city` VALUES ('31', 'Lam Dong', '1');
INSERT INTO `city` VALUES ('32', 'Lang Son', '1');
INSERT INTO `city` VALUES ('33', 'Lao Cai', '1');
INSERT INTO `city` VALUES ('34', 'Long An', '1');
INSERT INTO `city` VALUES ('35', 'Nam Dinh', '1');
INSERT INTO `city` VALUES ('36', 'Nghe An', '1');
INSERT INTO `city` VALUES ('37', 'Ninh Binh', '1');
INSERT INTO `city` VALUES ('38', 'Ninh Thuan', '1');
INSERT INTO `city` VALUES ('39', 'Phu Tho', '1');
INSERT INTO `city` VALUES ('40', 'Quang Binh', '1');
INSERT INTO `city` VALUES ('41', 'Quang Nam', '1');
INSERT INTO `city` VALUES ('42', 'Quang Ngai', '1');
INSERT INTO `city` VALUES ('43', 'Quang Ninh', '1');
INSERT INTO `city` VALUES ('44', 'Quang Tri', '1');
INSERT INTO `city` VALUES ('45', 'Soc Trng', '1');
INSERT INTO `city` VALUES ('46', 'Son La', '1');
INSERT INTO `city` VALUES ('47', 'Tay Ninh', '1');
INSERT INTO `city` VALUES ('48', 'Thai Binh', '1');
INSERT INTO `city` VALUES ('49', 'Thai Nguyen', '1');
INSERT INTO `city` VALUES ('50', 'Thanh Hoa', '1');
INSERT INTO `city` VALUES ('51', 'Thua Thien Hue', '1');
INSERT INTO `city` VALUES ('52', 'Tien Giang', '1');
INSERT INTO `city` VALUES ('53', 'Tra Vinh', '1');
INSERT INTO `city` VALUES ('54', 'Tuyen Quang', '1');
INSERT INTO `city` VALUES ('55', 'Vinh Long', '1');
INSERT INTO `city` VALUES ('56', 'Vinh Phuc', '1');
INSERT INTO `city` VALUES ('57', 'Yen Bai', '1');
INSERT INTO `city` VALUES ('58', 'Phu Yen', '1');
INSERT INTO `city` VALUES ('59', 'Can Tho', '1');
INSERT INTO `city` VALUES ('60', 'Da Nang', '1');
INSERT INTO `city` VALUES ('61', 'Hai Phong', '1');
INSERT INTO `city` VALUES ('62', 'Ha Noi', '1');
INSERT INTO `city` VALUES ('63', 'TP HCM', '1');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_user_id` (`user_id`),
  CONSTRAINT `fk_customer_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customer
-- ----------------------------

-- ----------------------------
-- Table structure for customer_item
-- ----------------------------
DROP TABLE IF EXISTS `customer_item`;
CREATE TABLE `customer_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer_item_order_id` (`order_customer_id`),
  CONSTRAINT `fk_order_customer_item_order_id` FOREIGN KEY (`order_customer_id`) REFERENCES `order_customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customer_item
-- ----------------------------

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1479913607');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1479913619');
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', '1479913620');
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', '1479913625');
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', '1479913627');
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', '1479913628');
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', '1479913629');
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', '1479913630');
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', '1479913631');
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', '1479913634');
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', '1479913634');
INSERT INTO `migration` VALUES ('m151218_234654_add_timezone_to_profile', '1479913635');
INSERT INTO `migration` VALUES ('m160226_063609_create_role', '1479913741');
INSERT INTO `migration` VALUES ('m161122_040418_initial_user', '1479913785');
INSERT INTO `migration` VALUES ('m161122_041638_initial_category', '1479913786');
INSERT INTO `migration` VALUES ('m161122_042210_initial_product', '1479913786');
INSERT INTO `migration` VALUES ('m161122_102209_initial_stock', '1479913786');
INSERT INTO `migration` VALUES ('m161122_163857_initial_order', '1479913787');
INSERT INTO `migration` VALUES ('m161122_170226_initial_order_item', '1479913787');
INSERT INTO `migration` VALUES ('m161122_171009_initial_customer', '1479913787');
INSERT INTO `migration` VALUES ('m161123_080529_fk_all', '1479913796');
INSERT INTO `migration` VALUES ('m161126_024343_add_column_to_product', '1480130761');
INSERT INTO `migration` VALUES ('m161126_031129_order_customer', '1480130765');
INSERT INTO `migration` VALUES ('m161126_084640_intial_item_customer', '1480150877');
INSERT INTO `migration` VALUES ('m161126_141246_alter_table_product_category', '1480170544');
INSERT INTO `migration` VALUES ('m161126_145241_add_column_category', '1480172034');
INSERT INTO `migration` VALUES ('m161126_151653_alter_product', '1480173490');
INSERT INTO `migration` VALUES ('m161126_154814_alter_product', '1480175377');
INSERT INTO `migration` VALUES ('m161128_110045_alter_product_code', '1480350799');
INSERT INTO `migration` VALUES ('m161128_163004_add_city', '1480350803');
INSERT INTO `migration` VALUES ('m161129_171507_update_user', '1480439969');
INSERT INTO `migration` VALUES ('m161129_175122_add_ncc', '1480442896');
INSERT INTO `migration` VALUES ('m161130_102208_add_column_order_item', '1480502729');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user_id` (`user_id`),
  KEY `fk_order_parent_id` (`parent_id`),
  CONSTRAINT `fk_order_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_customer
-- ----------------------------
DROP TABLE IF EXISTS `order_customer`;
CREATE TABLE `order_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer_user_id` (`user_id`),
  KEY `fk_order_customer_customer_id` (`customer_id`),
  CONSTRAINT `fk_order_customer_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_customer_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_customer
-- ----------------------------

-- ----------------------------
-- Table structure for order_item
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orderitem_order_id` (`order_id`),
  KEY `fk_orderitem_product_id` (`product_id`),
  CONSTRAINT `fk_orderitem_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orderitem_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_item
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in_stock` int(11) NOT NULL DEFAULT '1',
  `base_price` float NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `distribute_sale` float NOT NULL,
  `agent_sale` float NOT NULL,
  `retail_sale` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deliver` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `price_tax` float DEFAULT NULL,
  `supplier_discount` int(11) DEFAULT '0',
  `updated_date` datetime DEFAULT NULL,
  `representative_sale` float NOT NULL,
  `big_agent_sale` float NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_id` (`category_id`),
  CONSTRAINT `fk_product_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for provider
-- ----------------------------
DROP TABLE IF EXISTS `provider`;
CREATE TABLE `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of provider
-- ----------------------------
INSERT INTO `provider` VALUES ('1', 'nhà cung cấp 1', '', '123456', '2016-11-30 01:39:15', '', '', '', '', null);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `is_backend_login` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'Công ty', '{\"app\\\\controllers\\\\AdminController\":{\"index\":\"1\",\"update\":\"1\"},\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"1\",\"index\":\"1\",\"update\":\"1\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"view\":\"1\"}}', '1');
INSERT INTO `role` VALUES ('2', 'Đại diện', '{\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"1\",\"update\":\"1\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"1\"}}', '1');
INSERT INTO `role` VALUES ('3', 'Đại lý bán buôn', '{\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"0\",\"index\":\"0\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"0\",\"update\":\"0\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"0\"}}', '1');
INSERT INTO `role` VALUES ('4', 'Đại lý bán lẻ', '{\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"1\",\"index\":\"1\",\"update\":\"1\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"view\":\"1\"}}', '1');
INSERT INTO `role` VALUES ('5', 'Điểm phân phối', '{\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"1\",\"index\":\"1\",\"update\":\"1\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"view\":\"1\"}}', '1');

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`),
  KEY `fk_user_role_id` (`role_id`),
  CONSTRAINT `fk_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin@gmail.com', '$2y$10$wd2NYwHxsHE6.POw85iAyeUUAwn8RST0tApW/IR45s/hxJWRGFAIG', '', '1456114858', null, null, null, '0', '1480436789', '0', '1', null, '62', '', null);

-- ----------------------------
-- Table structure for user_stock
-- ----------------------------
DROP TABLE IF EXISTS `user_stock`;
CREATE TABLE `user_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `in_stock` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_product_id` (`product_id`),
  KEY `fk_stock_user_id` (`user_id`),
  CONSTRAINT `fk_stock_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_stock_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_stock
-- ----------------------------
