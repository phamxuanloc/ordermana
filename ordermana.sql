/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : ordermana

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-12-02 19:26:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('2', '0', '1', null, null, 'aa');
INSERT INTO `category` VALUES ('3', '0', '0', null, null, '1111');

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
INSERT INTO `migration` VALUES ('m000000_000000_base', '1479783979');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1479784133');
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', '1479784134');
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', '1479784138');
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', '1479784140');
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', '1479784140');
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', '1479784141');
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', '1479784142');
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', '1479784143');
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', '1479784146');
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', '1479784147');
INSERT INTO `migration` VALUES ('m151218_234654_add_timezone_to_profile', '1479784147');
INSERT INTO `migration` VALUES ('m160226_063609_create_role', '1479784954');
INSERT INTO `migration` VALUES ('m161122_040418_initial_user', '1479787828');
INSERT INTO `migration` VALUES ('m161122_041638_initial_category', '1479893712');
INSERT INTO `migration` VALUES ('m161122_042210_initial_product', '1479893712');
INSERT INTO `migration` VALUES ('m161122_102209_initial_stock', '1479893712');
INSERT INTO `migration` VALUES ('m161122_163857_initial_order', '1479893713');
INSERT INTO `migration` VALUES ('m161122_170226_initial_order_item', '1479893713');
INSERT INTO `migration` VALUES ('m161122_171009_initial_customer', '1479893713');
INSERT INTO `migration` VALUES ('m161123_080529_fk_all', '1479893721');
INSERT INTO `migration` VALUES ('m161126_024343_add_column_to_product', '1480308802');
INSERT INTO `migration` VALUES ('m161126_031129_order_customer', '1480308806');
INSERT INTO `migration` VALUES ('m161126_084640_intial_item_customer', '1480308807');
INSERT INTO `migration` VALUES ('m161126_141246_alter_table_product_category', '1480308809');
INSERT INTO `migration` VALUES ('m161126_145241_add_column_category', '1480308809');
INSERT INTO `migration` VALUES ('m161126_151653_alter_product', '1480308810');
INSERT INTO `migration` VALUES ('m161126_154814_alter_product', '1480308810');
INSERT INTO `migration` VALUES ('m161128_110045_alter_product_code', '1480330925');
INSERT INTO `migration` VALUES ('m161128_163004_add_city', '1480389723');
INSERT INTO `migration` VALUES ('m161129_171507_update_user', '1480576813');
INSERT INTO `migration` VALUES ('m161129_175122_add_ncc', '1480576817');
INSERT INTO `migration` VALUES ('m161130_102208_add_column_order_item', '1480576819');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('12', '45', '100', null, '2016-12-02 18:49:19', '2016-12-02 18:49:19', '3', '1', '2', '1');
INSERT INTO `order` VALUES ('13', '45', '101', null, '2016-12-02 18:52:44', '2016-12-02 18:52:44', '3', '1', '2', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_item
-- ----------------------------
INSERT INTO `order_item` VALUES ('1', '12', '21', '3', '100', '1');
INSERT INTO `order_item` VALUES ('2', '13', '17', '20', '1', '1');
INSERT INTO `order_item` VALUES ('3', '13', '21', '5', '100', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '2', '1', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:01:25', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('2', '2', '11', '11', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:03:30', '1', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('3', '2', '111', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:04:50', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('4', '2', '1', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:06:44', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('5', '2', '1', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:07:01', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('6', '2', '1', '1', null, '1', '1', '<p>1</p>', '1', '1', '1', '2016-11-28 17:07:23', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('7', '2', '123', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:08:47', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('8', '2', '123', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:09:18', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('9', '2', '123', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:09:37', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('10', '2', '1', null, null, '1', '1', '', '1', '1', '1', '2016-11-28 17:10:27', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('11', '2', '1', '1', null, '1', '1', '<p>1</p>', '1', '1', '1', '2016-11-28 17:12:52', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('12', '2', '1', '1', null, '1', '1', '<p>1</p>', '1', '1', '1', '2016-11-28 17:16:44', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('13', '2', '11', '1', null, '1', '1', '<p>1</p>', '1', '1', '1', '2016-11-28 17:17:20', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('14', '2', '1', '1', null, '1', '1', '', '1', '11', '1', '2016-11-28 17:17:58', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('15', '2', '11', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:20:08', '', null, '', null, '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('16', '2', '1', '1', null, '1', '1', '', '1', '1', '1', '2016-11-28 17:22:11', '', null, '', '16_image.jpg', '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('17', '2', 'abbb', '123', '17_image.jpg', '0', '1000', '', '1', '1', '1', '2016-12-02 18:52:44', '', null, '', null, '', '', '', null, '', '3', null, null, null, '1', '1', '1');
INSERT INTO `product` VALUES ('18', '2', '123', '1', '18_image.jpg', '1', '1', '', '1', '1', '1', '2016-11-28 17:31:21', '', null, '', '18_image.jpg', '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('19', '2', '1', '2', '19_product_img.jpg', '1', '1', '', '1', '1', '1', '2016-11-28 17:34:11', '', null, '', '19_product_bill.jpg', '', '', '', null, '', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('20', '2', '1', '1', '20_image.jpg', '1', '1', '', '1', '1', '1', '2016-11-28 17:59:22', '1', '1', '', '20_bill_image.jpg', '', '', '1', '1', '1', '0', null, null, null, '1', '1', null);
INSERT INTO `product` VALUES ('21', '2', '123123213', 'sua ong chua', null, '92', '100', '', '103', '102', '104', '2016-12-02 18:51:54', null, null, '', null, '', '', '', null, '', '3', null, null, null, '100', '101', '1');

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
INSERT INTO `profile` VALUES ('45', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('46', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('47', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('48', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('49', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('50', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('51', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('52', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('53', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('54', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('55', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('56', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('57', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('58', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('59', null, null, null, null, null, null, null, null);

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
INSERT INTO `provider` VALUES ('1', 'abc', 'dà', 'ádf', '2016-12-02 18:46:56', '', '', '', '', null);

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
INSERT INTO `role` VALUES ('1', 'Administrator', '{\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":1,\"create\":1,\"update\":1,\"delete\":1}}', '1');
INSERT INTO `role` VALUES ('2', 'Đại diện', '{\"app\\\\controllers\\\\AdminController\":{\"index\":\"0\",\"update\":\"0\",\"create\":\"1\",\"tree\":\"1\",\"delete\":\"0\",\"block\":\"0\"},\"app\\\\controllers\\\\CategoryController\":{\"create\":\"0\",\"index\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\",\"view\":\"1\",\"delete\":\"0\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\ProviderController\":{\"create\":\"0\",\"index\":\"0\",\"view\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"0\"}}', '1');
INSERT INTO `role` VALUES ('3', 'Đại lí bán buôn', '{\"app\\\\controllers\\\\AdminController\":{\"index\":\"0\",\"update\":\"0\",\"create\":\"1\",\"tree\":\"1\",\"delete\":\"0\",\"block\":\"0\"},\"app\\\\controllers\\\\CategoryController\":{\"create\":\"0\",\"index\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\",\"view\":\"1\",\"delete\":\"0\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\ProviderController\":{\"create\":\"0\",\"index\":\"0\",\"view\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"0\"}}', '1');
INSERT INTO `role` VALUES ('4', 'Đại lý bán lẻ', '{\"app\\\\controllers\\\\AdminController\":{\"index\":\"0\",\"update\":\"0\",\"create\":\"1\",\"tree\":\"1\",\"delete\":\"0\",\"block\":\"0\"},\"app\\\\controllers\\\\CategoryController\":{\"create\":\"0\",\"index\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"1\",\"index\":\"1\",\"view\":\"1\",\"delete\":\"0\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\ProviderController\":{\"create\":\"0\",\"index\":\"0\",\"view\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"0\"}}', '1');
INSERT INTO `role` VALUES ('5', 'Điểm phân phối', '{\"app\\\\controllers\\\\AdminController\":{\"index\":\"0\",\"update\":\"0\",\"create\":\"0\",\"tree\":\"0\",\"delete\":\"0\",\"block\":\"0\"},\"app\\\\controllers\\\\CategoryController\":{\"create\":\"0\",\"index\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\OrderController\":{\"order-item\":\"0\",\"index\":\"0\",\"view\":\"0\",\"delete\":\"0\"},\"app\\\\controllers\\\\ProductController\":{\"receipt\":\"0\",\"index\":\"0\",\"update\":\"0\"},\"app\\\\controllers\\\\ProviderController\":{\"create\":\"0\",\"index\":\"0\",\"view\":\"0\",\"delete\":\"0\",\"update\":\"0\"},\"navatech\\\\role\\\\controllers\\\\DefaultController\":{\"index\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"view\":\"0\"}}', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'phuong17889@gmail.com', '$2y$10$.33kPNwmFkv7FBSwsd0aKuMNBYdDs4yWzRPetbhluxE9fo9AjC.Ty', 'X2eREcnF64l7EPaOCzEqC0y9Yt2EtFCH', '1456114858', '', null, '127.0.0.1', '1456114700', '1469526631', '0', '1', null, '63', '', null);
INSERT INTO `user` VALUES ('45', 'daidien1', 'loc.xuanphama1t1@gmail.com', '$2y$10$UA8gDv.t/65W/x8zqm.ZhuDsB3cBOTnar9SZEBc2OPhUFVBWqfDr2', 'AVZAG_wYAdIlsaTUWfYh6aQSSuMRTd2m', '1480664377', null, null, '::1', '1480664377', '1480664377', '0', '2', '1', '7', '123456', '');
INSERT INTO `user` VALUES ('46', 'daidien2', 'loc.sxuanphama1t1@gmail.com', '$2y$10$A2HgzHFi.Ryabcjh4IsiBOKk93m1.1OanLfGCe/7AMzMMmNwLmSoi', 'Y0ujIO4vqc8IhnTwwSVoxdBMNr72su33', '1480664403', null, null, '::1', '1480664403', '1480664403', '0', '2', '1', '1', '654211', '');
INSERT INTO `user` VALUES ('47', 'admin1', '333@gmail.com', '$2y$10$JZkI4AsFt5XCsF76metm3.r8KFw1z8vmZPCjrgfrZqLyhWETz.pgy', 'f-ly0Dkf9vamcVuu1BZ57qcW_GfsJlVh', '1480664439', null, null, '::1', '1480664439', '1480664439', '0', '1', null, '1', '44444', '');
INSERT INTO `user` VALUES ('48', 'daili1', 'loc.xuafcnphama1t1@gmail.com', '$2y$10$prgp.G3JTvRDl9VtuY8RYuSoyII.ge5w7feY8QizuXqMoh4aVYkga', '_jaGUEnRaK-4BoloTQUFW3FIA7DWT63e', '1480664511', null, null, '::1', '1480664511', '1480664511', '0', '3', '46', '1', '1666221945', '');
INSERT INTO `user` VALUES ('49', 'daidien3', 'da3@gmail.com', '$2y$10$J7w6Hy4uqEl8jy9fdZX8F.xxtf8RZao.u61hCrpbo7K2YVir5EUk.', 'gUwc-LMW6IwxR0Xw6EK9MUT_xyuOhL8F', '1480665686', null, null, '::1', '1480665686', '1480665686', '0', '2', '1', '7', '11111', '');
INSERT INTO `user` VALUES ('50', 'daili2', 'loc.xuanphama1td1@gmail.com', '$2y$10$erUAa4zvSKJCJSpzYNfeXOhgYJwl3nDfcgAnVjBJOBVxf/IxonsWm', 'SLFpSZColSMDYpoNFMqmhlCoOKhvbTfg', '1480665744', null, null, '::1', '1480665745', '1480665745', '0', '3', '49', '1', '1666221945sd', '');
INSERT INTO `user` VALUES ('51', 'dailinho1', 'loc.xuanphamaádfdasf1t1@gmail.com', '$2y$10$wfUvew9t6l2GRIzufgf5fO1hjF7TMXVdBjHEELrwhBAbPgMEkDcOu', 'PAcJAfnec3JeOh9OcL-BWvdhHidUKoD8', '1480666323', null, null, '::1', '1480666323', '1480666323', '0', '4', '50', '1', '1666221945dsfasdf', '');
INSERT INTO `user` VALUES ('52', 'admin3', 'admin3@gmail.com', '$2y$10$1dkPbgY7CN5kUWiM83buzOiVQcvXxAh4djsUxroJqUjUOfh84Zl2C', '_yTbEIGt9KAQryv50STsi_VEYjS8MgIp', '1480667704', null, null, '::1', '1480667704', '1480667704', '0', '1', null, '1', '5555', '');
INSERT INTO `user` VALUES ('53', 'daidien4', 'loc.xuanpádfhama1t1@gmail.com', '$2y$10$p0D1i5VpnhbshzYOT.XKp.NOW9ZS6wRFm/e9KBaL1RqiUyrp.FDiq', '6uKxQjaq-6vsClF-Zkz4rn0QkHrM8Ltz', '1480667793', null, null, '::1', '1480667793', '1480667793', '0', '2', '47', '7', '1666221945dsfa', 'Kim Chung');
INSERT INTO `user` VALUES ('54', 'dlbb', 'loc.xdfasdfuanphama1t1@gmail.com', '$2y$10$E9JrrZltEXtdvd9aJDYo1OJHsahxwRfqHM6YpMGbn5O3eXuWQ8r7a', 'UJ2RTMljbD24-Epskz_PUbb7ZuYN4j9Y', '1480680262', null, null, '::1', '1480680262', '1480680262', '0', '3', '45', '1', '1232131', 'Kim Chung');
INSERT INTO `user` VALUES ('55', 'dailicon', 'loc.xuanphamádfasdfa1t1@gmail.com', '$2y$10$/pntYNha75bKL8XG9bdHFulx3RLbaRPeOvdCzoMh75A2zXzhDNr3y', 'KIP-p1WXI6-RrJO2oPBYxoQBfCyOSXQl', '1480680399', null, null, '::1', '1480680399', '1480680399', '0', '4', '54', '1', '1666221945fasdfasd', 'Kim Chung');
INSERT INTO `user` VALUES ('56', 'dlbb2', '123123@gmail.com', '$2y$10$yC0hvhu7NaGaP.qyiiq8duHJ9NWnzgmgUla7wTKB037NNq5yUBIeS', 'qo5VeyzN4aLuprDmZs_vLYnGPE2-nkDi', '1480680536', null, null, '::1', '1480680536', '1480680536', '0', '3', '45', '6', '123123', '');
INSERT INTO `user` VALUES ('57', 'dpp1', 'asdfasdf@gmail.com', '$2y$10$VRYQNBdVdLd9A6psdbpiRuY8B7zP31/k4aYWCH8ZzsYNOfOCUi2Um', 'Dl5-j6GdOHypwu1vqZzQN1Pu05TsMn5K', '1480680604', null, null, '::1', '1480680604', '1480680604', '0', '5', '55', '1', '123456fdàdsf', '');
INSERT INTO `user` VALUES ('58', 'daidien5', 'loc.xuanphaádfasdfma1t1@gmail.com', '$2y$10$X6Xp15Nmreis5j5eu2wqjujia4wL2IFn2zHTEzQMYZTi0HG.PomIC', 'WrYgDNj8vO18-8SfHWbLA3Rngr2uWs20', '1480680819', null, null, '::1', '1480680819', '1480680819', '0', '2', '1', '1', '1666221945ádfasd', 'Kim Chung');
INSERT INTO `user` VALUES ('59', 'daidien123213', 'loc.xdđuanphama1t1@gmail.com', '$2y$10$9zCMVcpmm0g3OZw7SVaYJ.74Gmc1RV1ec0xDVGJ.00Gc7CbBqA6re', 'gJqUde6ZIrS-G-jJCGVSclggAJY9DjSR', '1480680944', null, null, '::1', '1480680944', '1480680944', '0', '2', '1', '1', 'ádfdasf', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_stock
-- ----------------------------
INSERT INTO `user_stock` VALUES ('1', '45', '21', '8', '2016-12-02 18:51:54', null);
INSERT INTO `user_stock` VALUES ('2', '45', '17', '20', '2016-12-02 18:52:44', null);
