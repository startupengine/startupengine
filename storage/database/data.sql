# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18)
# Database: startupengine-site
# Generation Time: 2017-10-17 21:07:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`, `description`, `status`)
VALUES
	(1,NULL,2,'Blog Posts','blog','2017-10-12 04:36:54','2017-10-14 21:14:57',NULL,NULL),
	(2,NULL,3,'Announcements','announcements','2017-10-12 04:36:54','2017-10-14 21:15:04',NULL,NULL),
	(3,NULL,1,'Features','features','2017-10-13 00:34:44','2017-10-14 21:10:10','Discover the features of StartupEngine.',NULL),
	(5,NULL,6,'Documentation','documentation','2017-10-14 07:01:59','2017-10-14 21:15:26','Technical information about the content API.',NULL),
	(6,NULL,5,'Tutorials','tutorials','2017-10-14 07:02:10','2017-10-17 08:04:46','Learn the tricks of the trade to bootstrap your marketing.','published'),
	(7,NULL,4,'Getting Started','getting-started','2017-10-14 07:02:33','2017-10-14 21:15:11',NULL,NULL),
	(8,NULL,1,'Frequently Asked Questions','frequently-asked-questions','2017-10-16 11:35:56','2017-10-16 11:35:56','What does Startup Engine do? How does it work? What does it cost?\n',NULL);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table data_rows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data_rows`;

CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`)
VALUES
	(1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),
	(2,1,'author_id','text','Author',1,0,1,1,0,1,NULL,2),
	(3,1,'category_id','text','Category',0,0,1,1,1,0,NULL,3),
	(4,1,'title','text','Title',1,1,1,1,1,1,NULL,4),
	(5,1,'excerpt','text_area','excerpt',0,0,1,1,1,1,NULL,5),
	(6,1,'body','rich_text_box','Body',1,0,1,1,1,1,NULL,6),
	(7,1,'image','image','Post Image',0,1,1,1,1,1,'{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}',7),
	(8,1,'slug','text','slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true}}',8),
	(9,1,'meta_description','text_area','meta_description',0,0,1,1,1,1,NULL,9),
	(10,1,'meta_keywords','text_area','meta_keywords',0,0,1,1,1,1,NULL,10),
	(11,1,'status','select_dropdown','status',1,1,1,1,1,1,'{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}',11),
	(12,1,'created_at','timestamp','created_at',0,1,1,0,0,0,NULL,12),
	(13,1,'updated_at','timestamp','updated_at',0,0,0,0,0,0,NULL,13),
	(14,2,'id','number','id',1,0,0,0,0,0,NULL,1),
	(15,2,'author_id','text','author_id',1,0,0,0,0,0,NULL,2),
	(16,2,'title','text','title',1,1,1,1,1,1,NULL,3),
	(17,2,'excerpt','text_area','excerpt',0,0,1,1,1,1,NULL,6),
	(18,2,'body','code_editor','body',0,0,1,1,1,1,NULL,7),
	(19,2,'slug','text','slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\"}}',4),
	(20,2,'meta_description','text','meta_description',0,0,1,1,1,1,NULL,10),
	(21,2,'meta_keywords','text','meta_keywords',0,0,1,1,1,1,NULL,11),
	(22,2,'status','select_dropdown','status',1,1,1,1,1,1,'{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}',12),
	(23,2,'created_at','timestamp','created_at',0,1,1,0,0,0,NULL,13),
	(24,2,'updated_at','timestamp','updated_at',0,0,0,0,0,0,NULL,14),
	(25,2,'image','image','image',0,1,1,1,1,1,NULL,15),
	(26,3,'id','number','id',1,0,0,0,0,0,'',1),
	(27,3,'name','text','name',1,1,1,1,1,1,'',2),
	(28,3,'email','text','email',1,1,1,1,1,1,'',3),
	(29,3,'password','password','password',0,0,0,1,1,0,'',4),
	(30,3,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"roles\",\"pivot\":\"0\"}',10),
	(31,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',5),
	(32,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',6),
	(33,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',7),
	(34,3,'avatar','image','avatar',0,1,1,1,1,1,'',8),
	(35,5,'id','number','id',1,0,0,0,0,0,'',1),
	(36,5,'name','text','name',1,1,1,1,1,1,'',2),
	(37,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),
	(38,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),
	(39,4,'id','number','id',1,0,0,0,0,0,NULL,1),
	(40,4,'parent_id','select_dropdown','parent_id',0,0,1,1,1,1,'{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),
	(41,4,'order','text','order',1,1,1,1,1,1,'{\"default\":1}',3),
	(42,4,'name','text','name',1,1,1,1,1,1,NULL,4),
	(43,4,'slug','text','slug',1,1,1,1,1,1,'{\"slugify\":{\"origin\":\"name\"}}',5),
	(44,4,'created_at','timestamp','created_at',0,0,1,0,0,0,NULL,6),
	(45,4,'updated_at','timestamp','updated_at',0,0,0,0,0,0,NULL,7),
	(46,6,'id','number','id',1,0,0,0,0,0,'',1),
	(47,6,'name','text','Name',1,1,1,1,1,1,'',2),
	(48,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),
	(49,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),
	(50,6,'display_name','text','Display Name',1,1,1,1,1,1,'',5),
	(51,1,'seo_title','text','seo_title',0,1,1,1,1,1,NULL,14),
	(52,1,'featured','checkbox','featured',1,1,1,1,1,1,NULL,15),
	(53,3,'role_id','text','role_id',1,1,1,1,1,1,'',9),
	(54,2,'scripts','code_editor','Scripts',0,0,1,1,1,0,NULL,9),
	(55,2,'css','code_editor','Css',0,0,1,1,1,0,NULL,8),
	(56,2,'type','select_dropdown','Type',0,1,1,1,1,1,'{\"default\":\"page\",\"options\":{\"page\":\"Page\",\"help\":\"Help\",\"search\":\"Search\"}}',5),
	(57,1,'splash_class','select_dropdown','Splash Class',0,0,1,1,1,1,'{\"default\":\"bg-dark\",\"options\":{\"bg-dark\":\"Dark\",\"bg-light\":\"Light\",\"bg-black\":\"Black\",\"bg-white\":\"White\"}}',8),
	(58,1,'comments_enabled','checkbox','Comments Enabled',0,1,1,1,1,1,'{\"on\":\"Comments On\",\"off\":\"Comments Off\",\"checked\":\"true\"}',14),
	(59,1,'css','code_editor','CSS',0,0,1,1,1,1,NULL,18),
	(76,4,'description','text_area','Description',0,1,1,1,1,1,NULL,8),
	(85,15,'id','text','Id',1,0,0,0,0,0,NULL,1),
	(86,15,'header_html','code_editor','Header Html',0,1,1,1,1,1,NULL,2),
	(87,15,'css','code_editor','Css',0,1,1,1,1,1,NULL,3),
	(88,15,'scripts','code_editor','Scripts',0,1,1,1,1,1,NULL,4),
	(89,15,'footer_html','code_editor','Footer Html',0,1,1,1,1,1,NULL,5),
	(90,15,'name','text','Name',1,1,1,1,1,1,NULL,6),
	(91,15,'description','text_area','Description',0,1,1,1,1,1,NULL,7),
	(92,15,'deleted_at','timestamp','Deleted At',0,1,1,1,1,1,NULL,8),
	(94,1,'background_image','image','Background Image',0,1,1,1,1,1,NULL,19),
	(95,4,'status','text','Status',0,1,1,1,1,1,'{\"default\":\"draft\",\"options\":{\"published\":\"Published\",\"draft\":\"Draft\",\"pending\":\"Pending\"}}',9);

/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table data_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data_types`;

CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `created_at`, `updated_at`)
VALUES
	(1,'posts','posts','Post','Posts','voyager-news','TCG\\Voyager\\Models\\Post','TCG\\Voyager\\Policies\\PostPolicy',NULL,NULL,1,0,'2017-10-12 04:36:24','2017-10-12 20:39:16'),
	(2,'pages','pages','Page','Pages','voyager-file-text','TCG\\Voyager\\Models\\Page',NULL,NULL,NULL,1,0,'2017-10-12 04:36:24','2017-10-12 06:51:48'),
	(3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','','',1,0,'2017-10-12 04:36:24','2017-10-12 04:36:24'),
	(4,'categories','categories','Category','Categories','voyager-categories','TCG\\Voyager\\Models\\Category',NULL,NULL,NULL,1,0,'2017-10-12 04:36:24','2017-10-14 21:09:43'),
	(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,'2017-10-12 04:36:24','2017-10-12 04:36:24'),
	(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'','',1,0,'2017-10-12 04:36:24','2017-10-12 04:36:24'),
	(15,'templates','templates','Template','Templates',NULL,'App\\Template',NULL,NULL,NULL,1,0,'2017-10-15 19:04:35','2017-10-15 19:04:35');

/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`)
VALUES
	(1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2017-10-12 04:36:24','2017-10-12 04:36:24','voyager.dashboard',NULL),
	(2,1,'Media','','_self','voyager-images',NULL,NULL,7,'2017-10-12 04:36:24','2017-10-14 02:26:39','voyager.media.index',NULL),
	(3,1,'Posts','','_self','voyager-news',NULL,NULL,6,'2017-10-12 04:36:24','2017-10-14 02:26:39','voyager.posts.index',NULL),
	(4,1,'Users','','_self','voyager-person',NULL,NULL,2,'2017-10-12 04:36:24','2017-10-14 02:26:27','voyager.users.index',NULL),
	(5,1,'Categories','','_self','voyager-categories',NULL,NULL,4,'2017-10-12 04:36:24','2017-10-14 02:26:35','voyager.categories.index',NULL),
	(6,1,'Pages','','_self','voyager-file-text',NULL,NULL,5,'2017-10-12 04:36:24','2017-10-14 02:26:39','voyager.pages.index',NULL),
	(7,1,'Roles','','_self','voyager-lock',NULL,NULL,3,'2017-10-12 04:36:24','2017-10-14 02:26:27','voyager.roles.index',NULL),
	(9,1,'Menu Builder','','_self','voyager-list',NULL,NULL,11,'2017-10-12 04:36:24','2017-10-14 02:27:04','voyager.menus.index',NULL),
	(10,1,'Database','','_self','voyager-data',NULL,NULL,8,'2017-10-12 04:36:24','2017-10-14 02:27:04','voyager.database.index',NULL),
	(11,1,'Compass','/admin/compass','_self','voyager-compass',NULL,NULL,9,'2017-10-12 04:36:24','2017-10-14 02:27:04',NULL,NULL),
	(12,1,'Hooks','/admin/hooks','_self','voyager-hook',NULL,NULL,10,'2017-10-12 04:36:24','2017-10-14 02:27:04',NULL,NULL),
	(13,1,'Settings','','_self','voyager-settings',NULL,NULL,12,'2017-10-12 04:36:24','2017-10-14 02:26:27','voyager.settings.index',NULL),
	(17,2,'Features','/','_self',NULL,'#000000',NULL,1,'2017-10-12 23:54:32','2017-10-14 23:34:32',NULL,''),
	(18,2,'Support','/forums','_self',NULL,'#000000',NULL,4,'2017-10-13 18:58:01','2017-10-15 03:35:56',NULL,''),
	(19,2,'Help','/help','_self',NULL,'#000000',NULL,3,'2017-10-14 20:34:35','2017-10-15 01:57:01',NULL,''),
	(20,2,'Articles','/articles','_self',NULL,'#000000',NULL,2,'2017-10-15 01:56:45','2017-10-15 01:57:45',NULL,'');

/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','2017-10-12 04:36:24','2017-10-12 18:04:03'),
	(2,'site','2017-10-12 18:02:17','2017-10-12 18:04:14');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2016_01_01_000000_add_voyager_user_fields',1),
	(4,'2016_01_01_000000_create_data_types_table',1),
	(5,'2016_01_01_000000_create_pages_table',1),
	(6,'2016_01_01_000000_create_posts_table',1),
	(7,'2016_02_15_204651_create_categories_table',1),
	(8,'2016_05_19_173453_create_menu_table',1),
	(9,'2016_10_21_190000_create_roles_table',1),
	(10,'2016_10_21_190000_create_settings_table',1),
	(11,'2016_11_30_135954_create_permission_table',1),
	(12,'2016_11_30_141208_create_permission_role_table',1),
	(13,'2016_12_26_201236_data_types__add__server_side',1),
	(14,'2017_01_13_000000_add_route_to_menu_items_table',1),
	(15,'2017_01_14_005015_create_translations_table',1),
	(16,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),
	(17,'2017_01_15_000000_create_permission_groups_table',1),
	(18,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),
	(19,'2017_03_06_000000_add_controller_to_data_types_table',1),
	(20,'2017_04_11_000000_alter_post_nullable_fields_table',1),
	(21,'2017_04_21_000000_add_order_to_data_rows_table',1),
	(22,'2017_07_05_210000_add_policyname_to_data_types_table',1),
	(23,'2017_08_05_000000_add_group_to_settings_table',1),
	(25,'2017_10_12_083900_add_scripts_field_to_pages',2),
	(26,'2017_10_12_083900_add_css_field_to_pages',3),
	(27,'2017_10_12_083900_add_type_field_to_pages',4),
	(28,'2017_10_12_203237_add_splash_class_to_posts',5),
	(29,'2017_10_12_223622_add_comments_enabled_to_posts',6),
	(30,'2017_10_13_015041_create_categories_table',0),
	(31,'2017_10_13_015041_create_data_rows_table',0),
	(32,'2017_10_13_015041_create_data_types_table',0),
	(33,'2017_10_13_015041_create_menu_items_table',0),
	(34,'2017_10_13_015041_create_menus_table',0),
	(35,'2017_10_13_015041_create_pages_table',0),
	(36,'2017_10_13_015041_create_password_resets_table',0),
	(37,'2017_10_13_015041_create_permission_groups_table',0),
	(38,'2017_10_13_015041_create_permission_role_table',0),
	(39,'2017_10_13_015041_create_permissions_table',0),
	(40,'2017_10_13_015041_create_posts_table',0),
	(41,'2017_10_13_015041_create_roles_table',0),
	(42,'2017_10_13_015041_create_settings_table',0),
	(43,'2017_10_13_015041_create_translations_table',0),
	(44,'2017_10_13_015041_create_users_table',0),
	(45,'2017_10_13_015043_add_foreign_keys_to_categories_table',0),
	(46,'2017_10_13_015043_add_foreign_keys_to_data_rows_table',0),
	(47,'2017_10_13_015043_add_foreign_keys_to_menu_items_table',0),
	(48,'2017_10_13_015043_add_foreign_keys_to_permission_role_table',0),
	(49,'2017_10_13_015352_import_default_data',7),
	(50,'2017_10_13_015352_import_default_data',7),
	(51,'2016_08_17_203844_create_laravellikecommet_comments_table',8),
	(52,'2016_08_18_152344_create_laravellikecomment_total_likes_table',8),
	(53,'2016_08_18_152401_create_laravellikecomment_likes_table',8),
	(54,'2016_07_29_171118_create_chatter_categories_table',9),
	(55,'2016_07_29_171118_create_chatter_discussion_table',9),
	(56,'2016_07_29_171118_create_chatter_post_table',9),
	(57,'2016_07_29_171128_create_foreign_keys',9),
	(58,'2016_08_02_183143_add_slug_field_for_discussions',9),
	(59,'2016_08_03_121747_add_color_row_to_chatter_discussions',9),
	(60,'2017_01_16_121747_add_markdown_and_lock_to_chatter_posts',9),
	(61,'2017_01_16_121747_create_chatter_user_discussion_pivot_table',9);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css` longtext COLLATE utf8mb4_unicode_ci,
  `scripts` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `type`, `css`, `scripts`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`)
VALUES
	(2,1,'Home',NULL,'<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header clear-filter\" filter-color=\"orange\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-image: url(\'https://images.unsplash.com/photo-1450149632596-3ef25a62011a?dpr=1&auto=compress,format&fit=crop&w=2816&h=&q=80&cs=tinysrgb&crop=\');\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center brand\">\r\n                    <img class=\"n-logo\" src=\"https://psychoanalytics.s3-us-west-1.amazonaws.com/settings/October2017/logo1.png\" alt=\"\" style=\"margin-bottom:25px;max-width:75px;\">\r\n                    <h1 class=\"h1-seo\">Startup Engine</h1>\r\n                    <h3>Beautiful, Open-Source, & Free <span style=\"display:inline-block\">CMS for Startups</span></h3>\r\n                    <a class=\"btn btn-neutral\" href=\"/get-started\">\r\n                        Learn More\r\n                    </a>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</body>','page',NULL,NULL,NULL,'home',NULL,NULL,'ACTIVE','2017-10-15 08:08:05','2017-10-16 05:46:05'),
	(3,1,'Help',NULL,'<div class=\"wrapper\">\r\n    <div class=\"section\" style=\"padding-top:25px;margin-top:-100px;background:none;\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"col-lg-12 col-md-12\">\r\n                    \r\n                    <div class=\"col-md-6\" style=\"float:left;\">\r\n                        <div class=\"card\">\r\n                          <div class=\"card-body\">\r\n                            <h4 class=\"card-title\">Frequently Asked Questions</h4>\r\n                            <p class=\"card-text\">What does Startup Engine do? How does it work? What does it cost?</p>\r\n                            <a href=\"/browse?category=frequently-asked-questions\" class=\"btn btn-info pull-right\">View FAQs</a>\r\n                          </div>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <div class=\"col-md-6\" style=\"float:left;\">\r\n                        <div class=\"card\">\r\n                          <div class=\"card-body\">\r\n                            <h4 class=\"card-title\">Tutorials</h4>\r\n                            <p class=\"card-text\">Learn the tricks of the trade to bootstrap your marketing.</p>\r\n                            <a href=\"/browse?category=tutorials\" class=\"btn btn-info pull-right\">View Tutorials</a>\r\n                          </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"col-md-6\" style=\"float:left;\">\r\n                        <div class=\"card\">\r\n                          <div class=\"card-body\">\r\n                            <h4 class=\"card-title\">Articles</h4>\r\n                            <p class=\"card-text\">Insights and observations about the startup life.</p>\r\n                            <a href=\"/articles\" class=\"btn btn-info pull-right\">View Articles</a>\r\n                          </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"col-md-6\" style=\"float:left;\">\r\n                        <div class=\"card\">\r\n                          <div class=\"card-body\">\r\n                            <h4 class=\"card-title\">Documentation</h4>\r\n                            <p class=\"card-text\">Technical information about the content API.</p>\r\n                            <a href=\"/browse?category=documentation\" class=\"btn btn-info pull-right\">View Docs</a>\r\n                          </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>','help','<style>\r\n    .page-header-image{\r\n        background: #ff9966;  /* fallback for old browsers */\r\n        background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);  /* Chrome 10-25, Safari 5.1-6 */\r\n        background: linear-gradient(to top right, #ff5e62, #ff9966); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */\r\n    }\r\n</style>','<!-- Start of Async Drift Code -->\r\n<script>\r\n!function() {\r\n  var t;\r\n  if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error(\"Drift snippet included twice.\")) : (t.invoked = !0, \r\n  t.methods = [ \"identify\", \"config\", \"track\", \"reset\", \"debug\", \"show\", \"ping\", \"page\", \"hide\", \"off\", \"on\" ], \r\n  t.factory = function(e) {\r\n    return function() {\r\n      var n;\r\n      return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;\r\n    };\r\n  }, t.methods.forEach(function(e) {\r\n    t[e] = t.factory(e);\r\n  }), t.load = function(t) {\r\n    var e, n, o, i;\r\n    e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement(\"script\"), \r\n    o.type = \"text/javascript\", o.async = !0, o.crossorigin = \"anonymous\", o.src = \"https://js.driftt.com/include/\" + i + \"/\" + t + \".js\", \r\n    n = document.getElementsByTagName(\"script\")[0], n.parentNode.insertBefore(o, n);\r\n  });\r\n}();\r\ndrift.SNIPPET_VERSION = \'0.3.1\';\r\ndrift.load(\'gd2u4pcakv8w\');\r\n</script>\r\n<!-- End of Async Drift Code -->',NULL,'help',NULL,NULL,'ACTIVE','2017-10-15 18:58:24','2017-10-17 08:25:27'),
	(4,1,'Features',NULL,'<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header clear-filter\" filter-color=\"black\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-image: url(\'https://images.unsplash.com/photo-1437422061949-f6efbde0a471?dpr=1&auto=compress,format&fit=crop&w=2850&h=&q=80&cs=tinysrgb&crop=\');\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center brand\">\r\n                    <h1 class=\"h1-seo\">Features</h1>\r\n                    <h3>Custom CMS, A/B Testing, Integrated Analytics & More</h3>\r\n                    <a class=\"btn btn-neutral\" href=\"/get-started\">\r\n                        Learn More\r\n                    </a>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</body>','page',NULL,NULL,NULL,'features',NULL,NULL,'INACTIVE','2017-10-15 22:24:01','2017-10-17 03:14:27'),
	(5,1,'Articles',NULL,'<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header page-header-small clear-filter\" filter-color=\"black\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-image:url(\'https://images.unsplash.com/photo-1501954378833-0ee4020fd660?dpr=1&auto=compress,format&fit=crop&w=2978&h=&q=80&cs=tinysrgb&crop=\');\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center\" style=\"top:200px !important;\">\r\n                    <h1 class=\"title text-center\" style=\"padding-bottom: 25px;border-bottom: #fff solid 5px;\">The Launchpad</h1>\r\n                    <h4 class=\"title text-center\">A blog about starting up & taking off</h5>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"section\" style=\"padding-top:25px;margin-top:-100px !important;background:none;\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-12 col-md-12\">\r\n                        <div id=\"articles\" class=\"card-deck\">\r\n                            <todo-item\r\n                              v-for=\"item in items\"\r\n                              v-bind:todo=\"item\"\r\n                              v-bind:key=\"item.id\"\r\n                              v-bind:href=\"item.slug\">\r\n                            </todo-item>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</body>','page','<style>\r\n    .card-link:hover {\r\n        text-decoration:none !important;\r\n    }\r\n    .card-text  {\r\n        color:#666;\r\n    }\r\n    .card-title {\r\n        color:#111 !important;\r\n    }\r\n    .card-footer {\r\n        color:#2CA8FF !important;\r\n    }\r\n</style>','<script>\r\n    Vue.component(\'todo-item\', {\r\n    props: [\'todo\'],\r\n    template: \'<div class=\"col-sm-4\"><a class=\"card-link\" v-bind:href=\"todo.slug\"><div class=\"card\"><img class=\"card-img-top\" v-bind:src=\"todo.image\"><div class=\"card-body\"><h4 class=\"card-title\" align=\"center\">{{ todo.title }}</h4><p class=\"card-text\">{{ todo.meta_description }}</p></div><div class=\"card-footer\" align=\"center\">Read More</div></div></a></div>\'\r\n});\r\nvar app7 = new Vue({\r\n  el: \'#articles\',\r\n  data: {\r\n        items: null\r\n    },\r\n    created: function () {\r\n        var _this = this;\r\n        $.getJSON(\'http://127.0.0.1:8000/api/items?type=posts&limit=10\', function (json) {\r\n            _this.items = json;\r\n        });\r\n    }\r\n  \r\n});\r\n</script>',NULL,'articles',NULL,NULL,'INACTIVE','2017-10-15 22:38:47','2017-10-17 03:11:41'),
	(6,1,'Search',NULL,'<div class=\"wrapper\">\r\n    <div class=\"section\" style=\"padding-top:25px;margin-top:-100px;background:none;\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"col-lg-12 col-md-12\">\r\n                    <div id=\"articles\" class=\"card-deck\">\r\n                        <todo-item\r\n                          v-for=\"item in items\"\r\n                          v-bind:todo=\"item\"\r\n                          v-bind:key=\"item.id\"\r\n                          v-bind:href=\"item.slug\">\r\n                        </todo-item>\r\n                    </div>                    \r\n                    \r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>','search','<style>\r\n    .page-header-image{\r\n        background: #ff9966;  /* fallback for old browsers */\r\n        background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);  /* Chrome 10-25, Safari 5.1-6 */\r\n        background: linear-gradient(to top right, #ff5e62, #ff9966); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */\r\n    }\r\n</style>','<script>\r\n    var url_string = window.location;\r\n    var url = new URL(url_string);\r\n    var input = url.searchParams.get(\"s\");\r\n    Vue.component(\'todo-item\', {\r\n    props: [\'todo\'],\r\n    template: \'<div class=\"col-md-6\" style=\"float:left;\"><div class=\"card\"><div class=\"card-body\"><h4 class=\"card-title\">{{ todo.title }}</h4><p class=\"card-text\">{{ todo.meta_description }}</p><a href=\"/category/tutorials\" class=\"btn btn-info pull-right\">View Tutorials</a></div></div></div>\'\r\n});\r\nvar app7 = new Vue({\r\n  el: \'#articles\',\r\n  data: {\r\n        items: null\r\n    },\r\n    created: function () {\r\n        var _this = this;\r\n        $.getJSON(\'http://127.0.0.1:8000/api/search?type=posts&s=\' + input, function (json) {\r\n            _this.items = json;\r\n        });\r\n    }\r\n  \r\n});\r\n</script>',NULL,'search',NULL,NULL,'INACTIVE','2017-10-15 23:55:56','2017-10-16 11:14:14'),
	(7,1,'Browse',NULL,'<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header page-header-small clear-filter\" filter-color=\"black\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-image:url(\'https://images.unsplash.com/photo-1501954378833-0ee4020fd660?dpr=1&auto=compress,format&fit=crop&w=2978&h=&q=80&cs=tinysrgb&crop=\');\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center\" style=\"top:200px !important;\">\r\n                    <div id=\"heading\">\r\n                             <category\r\n                              v-for=\"item in categories\"\r\n                              v-bind:category=\"item\"\r\n                              v-bind:key=\"item.id\">\r\n                            </category>\r\n                        </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"section\" style=\"padding-top:25px;margin-top:-100px !important;background:none;\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-12 col-md-12\">\r\n                        <div id=\"articles\" class=\"card-deck\">\r\n                            <todo-item\r\n                              v-for=\"item in items\"\r\n                              v-bind:todo=\"item\"\r\n                              v-bind:key=\"item.id\"\r\n                              v-bind:href=\"item.slug\">\r\n                            </todo-item>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</body>','page','<style>\r\n    .card-link:hover {\r\n        text-decoration:none !important;\r\n    }\r\n    .card-text  {\r\n        color:#666;\r\n    }\r\n    .card-title {\r\n        color:#111 !important;\r\n    }\r\n    .card-footer {\r\n        color:#2CA8FF !important;\r\n    }\r\n    .page-header-image {\r\n        background: #ff9966 !important;\r\n        background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966) !important;\r\n        background: linear-gradient(to top right, #ff5e62, #ff9966) !important;\r\n    }\r\n</style>','<script>\r\n    var url_string = window.location;\r\n    var url = new URL(url_string);\r\n    var input = url.searchParams.get(\"category\");\r\n    console.log(input);\r\n    Vue.component(\'todo-item\', {\r\n        props: [\'todo\'],\r\n        template: \'<div class=\"col-sm-4\"><a class=\"card-link\" v-bind:href=\"todo.slug\"><div class=\"card\"><img class=\"card-img-top\" v-bind:src=\"todo.image\"><div class=\"card-body\"><h4 class=\"card-title\" align=\"center\">{{ todo.title }}</h4><p class=\"card-text\">{{ todo.meta_description }}</p></div><div class=\"card-footer\" align=\"center\">Read More</div></div></a></div>\'\r\n    });\r\n    Vue.component(\'category\', {\r\n        props: [\'category\'],\r\n        template: \'<div><h1 class=\"title\">{{ category.name }}</h1><h4 class=\"title\">{{ category.description }}</h4></div>\'\r\n    });\r\n    var heading = new Vue({\r\n          el: \'#heading\',\r\n          data: {\r\n                categories: null\r\n            },\r\n            created: function () {\r\n                var _this = this;\r\n                $.getJSON(\'http://127.0.0.1:8000/api/item?type=categories&slug=\' + input, function (json) {\r\n                    _this.categories = json;\r\n                });\r\n            }\r\n        });            \r\n    var articles = new Vue({\r\n      el: \'#articles\',\r\n      data: {\r\n            items: null\r\n        },\r\n        created: function () {\r\n            var _this = this;\r\n            $.getJSON(\'http://127.0.0.1:8000/api/browse?type=posts&category=\' + input, function (json) {\r\n                _this.items = json;\r\n            });\r\n        }\r\n    });\r\n</script>',NULL,'browse',NULL,NULL,'INACTIVE','2017-10-15 22:38:47','2017-10-17 20:02:55');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table permission_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_groups`;

CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(5,4),
	(6,1),
	(6,4),
	(7,1),
	(7,4),
	(8,1),
	(8,4),
	(9,1),
	(9,4),
	(10,1),
	(10,4),
	(11,1),
	(11,4),
	(12,1),
	(12,4),
	(13,1),
	(13,4),
	(14,1),
	(14,4),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(19,1),
	(20,1),
	(21,1),
	(22,1),
	(23,1),
	(24,1),
	(25,1),
	(25,3),
	(25,4),
	(26,1),
	(26,3),
	(26,4),
	(27,1),
	(27,3),
	(27,4),
	(28,1),
	(28,3),
	(28,4),
	(29,1),
	(29,4),
	(30,1),
	(30,4),
	(31,1),
	(31,4),
	(32,1),
	(32,4),
	(33,1),
	(33,4),
	(34,1),
	(34,4),
	(35,1),
	(35,4),
	(36,1),
	(36,4),
	(37,1),
	(37,4),
	(38,1),
	(38,4),
	(39,1),
	(39,4);

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`, `permission_group_id`)
VALUES
	(1,'browse_admin',NULL,'2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(2,'browse_database',NULL,'2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(3,'browse_media',NULL,'2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(4,'browse_compass',NULL,'2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(5,'browse_menus','menus','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(6,'read_menus','menus','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(7,'edit_menus','menus','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(8,'add_menus','menus','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(9,'delete_menus','menus','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(10,'browse_pages','pages','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(11,'read_pages','pages','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(12,'edit_pages','pages','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(13,'add_pages','pages','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(14,'delete_pages','pages','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(15,'browse_roles','roles','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(16,'read_roles','roles','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(17,'edit_roles','roles','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(18,'add_roles','roles','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(19,'delete_roles','roles','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(20,'browse_users','users','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(21,'read_users','users','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(22,'edit_users','users','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(23,'add_users','users','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(24,'delete_users','users','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(25,'browse_posts','posts','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(26,'read_posts','posts','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(27,'edit_posts','posts','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(28,'add_posts','posts','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(29,'delete_posts','posts','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(30,'browse_categories','categories','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(31,'read_categories','categories','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(32,'edit_categories','categories','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(33,'add_categories','categories','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(34,'delete_categories','categories','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(35,'browse_settings','settings','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(36,'read_settings','settings','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(37,'edit_settings','settings','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(38,'add_settings','settings','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(39,'delete_settings','settings','2017-10-12 04:36:24','2017-10-12 04:36:24',NULL),
	(55,'browse_templates','templates','2017-10-15 19:04:35','2017-10-15 19:04:35',NULL),
	(56,'read_templates','templates','2017-10-15 19:04:35','2017-10-15 19:04:35',NULL),
	(57,'edit_templates','templates','2017-10-15 19:04:35','2017-10-15 19:04:35',NULL),
	(58,'add_templates','templates','2017-10-15 19:04:35','2017-10-15 19:04:35',NULL),
	(59,'delete_templates','templates','2017-10-15 19:04:35','2017-10-15 19:04:35',NULL);

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `splash_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `comments_enabled` blob,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `css` longtext COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `splash_class`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `comments_enabled`, `featured`, `created_at`, `updated_at`, `css`, `background_image`)
VALUES
	(6,1,3,'Generating revenue from comments',NULL,NULL,'<p style=\"text-align: center;\">This post demonstrates how easy it is to enable third-party comments.</p>','bg-dark','posts/October2017/glenn-carstens-peters-203007.jpg','generating-revenue-from-comments','This is a description...',NULL,'PUBLISHED',X'31',0,'2017-10-12 22:07:56','2017-10-16 12:34:57',NULL,NULL),
	(8,1,6,'Post with video',NULL,NULL,'<p>StartupEngine features a rich text editor (courtesy of <a href=\"https://laravelvoyager.com/\" target=\"_blank\" rel=\"noopener noreferrer\">Laravel Voyager</a>), which makes posting media from external sources such as Youtube and Giphy a snap.</p>\r\n<p style=\"text-align: center;\"><iframe title=\"Star Wars: The Force Awakens Official Teaser\" src=\"https://www.youtube.com/embed/erLk59H86ww?wmode=opaque&amp;theme=dark\" width=\"560\" height=\"400\" frameborder=\"0\" allowfullscreen=\"\">\r\n</iframe></p>','bg-black','posts/October2017/jakob-owens-1982341.jpg','post-with-video-2','This is a multi-line, very long description with many words, and it makes this post larger than the others...',NULL,'PUBLISHED',X'30',0,'2017-10-12 19:10:04','2017-10-17 07:12:31',NULL,NULL),
	(9,1,3,'Integrating Analytics',NULL,NULL,'<p>StartupEngine features a rich text editor (courtesy of <a href=\"https://laravelvoyager.com/\" target=\"_blank\" rel=\"noopener noreferrer\">Laravel Voyager</a>), which makes posting media from external sources such as Youtube and Giphy a snap.</p>\r\n<p style=\"text-align: center;\"><iframe title=\"Star Wars: The Force Awakens Official Teaser\" src=\"https://www.youtube.com/embed/erLk59H86ww?wmode=opaque&amp;theme=dark\" width=\"560\" height=\"400\" frameborder=\"0\" allowfullscreen=\"\">\r\n</iframe></p>','bg-black','posts/October2017/ilya-pavlov-874381.jpg','integrating-analytics','This is a multi-line, very long description with many words, and it makes this post larger than the others...',NULL,'PUBLISHED',X'30',0,'2017-10-12 19:10:04','2017-10-16 12:34:35',NULL,NULL);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','Administrator','2017-10-12 04:36:24','2017-10-12 04:36:24'),
	(2,'user','Normal User','2017-10-12 04:36:24','2017-10-12 04:36:24'),
	(3,'writer','Writer','2017-10-12 21:17:38','2017-10-12 21:17:47'),
	(4,'developer','Developer','2017-10-13 02:37:36','2017-10-13 02:37:44');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`)
VALUES
	(1,'site.title','Site Title','Startup Engine','','text',1,'Site'),
	(2,'site.description','Site Description','A CMS designed for startups.','','text',2,'Site'),
	(3,'site.logo','Site Logo','settings/October2017/logo.png','','image',3,'Site'),
	(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','UA-44021606-2','','text',6,'Site'),
	(5,'admin.bg_image','Admin Background Image','settings/October2017/luca-bravo-207676.jpg','','image',5,'Admin'),
	(6,'admin.title','Admin Title','Admin Panel','','text',1,'Admin'),
	(7,'admin.description','Admin Description','A CMS designed for startups.','','text',2,'Admin'),
	(8,'admin.loader','Admin Loader','settings/October2017/logo2.png','','image',3,'Admin'),
	(9,'admin.icon_image','Admin Icon Image','settings/October2017/logo1.png','','image',4,'Admin'),
	(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','541075191896-uu43j0q9785g4flqqv2d6psd40nujnpb.apps.googleusercontent.com','','text',1,'Admin'),
	(11,'site.global_css','Global CSS','<!--     Fonts and icons     -->\r\n<link href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700,200\" rel=\"stylesheet\" />\r\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\" />\r\n<!-- CSS Files -->\r\n<link href=\"/css/bootstrap.min.css\" rel=\"stylesheet\" />\r\n<link href=\"/css/now-ui-kit.css?v=1.1.0\" rel=\"stylesheet\" />\r\n<style>\r\n    .h1-seo {\r\n        font-weight:400 !important;\r\n    }\r\n    .card {\r\n        border-radius:5px !important;\r\n    }\r\n    .card h4 {\r\n        margin-top:10px !important;\r\n        text-align:center;\r\n    }\r\n    @media screen and (max-width: 991px) {\r\n        .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {\r\n            border: 1px solid rgba(255,255,255,0.1);\r\n        }\r\n        .sidebar-collapse .navbar .navbar-nav {\r\n            margin-top: 15px !important;\r\n        }\r\n    }\r\n    h4.title, h1.title {\r\n        font-weight:400;\r\n    }\r\n    \r\n    h1, h4 {\r\n        text-shadow: 0px 3px 7px rgba(0,0,0,0.3) !important;\r\n    }\r\n    \r\n    .sidebar-collapse .navbar-collapse:before {\r\n        background: #ff2e0c;  /* fallback for old browsers */\r\n        background: -webkit-linear-gradient(to bottom, #ff2e0c, #ffb733);  /* Chrome 10-25, Safari 5.1-6 */\r\n        background: linear-gradient(to bottom, #ff2e0c, #ffb733); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */\r\n    }\r\n\r\n    .page-header[filter-color=\"orange\"] {\r\n        background: rgba(44, 44, 44, 0.0);\r\n        background: -webkit-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));\r\n        background: -o-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));\r\n        background: -moz-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));\r\n        background: linear-gradient(0deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));\r\n    }\r\n    #disqus_thread {\r\n        padding:15px;\r\n    }\r\n</style>',NULL,'code_editor',9,'Site'),
	(12,'site.global_scripts','Global Scripts','<script>\r\n</script>',NULL,'code_editor',10,'Site'),
	(14,'site.footer_html','Footer HTML','<div class=\"column\">\r\n    <ul>\r\n        <li><strong>Navigation</strong></li>\r\n        <li><a href=\"/home\">Home</a></li>\r\n        <li><a href=\"/articles\">Blog</a></li>\r\n        <li><a href=\"/signin\">Sign In</a></li>\r\n    </ul>\r\n</div>\r\n<div class=\"column\">\r\n    <ul>\r\n        <li><strong>About This Site</strong></li>\r\n        <li><a href=\"mailto:example@example.com\">Contact Support</a></li>\r\n        <li><a href=\"https://github.com/luckyrabbitllc/startupengine\">View the code on GitHub</a></li>\r\n        <li><a href=\"https://dashboard.heroku.com/new?button-url=https%3A%2F%2Fgithub.com%2Fluckyrabbitllc%2Fstartupengine&template=https%3A%2F%2Fgithub.com%2Fluckyrabbitllc%2FStartupEngine\">Deploy to Heroku</a></li>\r\n    </ul>\r\n</div>',NULL,'code_editor',12,'Site'),
	(15,'site.comments_code','Comments Code','<div id=\"disqus_thread\"></div>\r\n<script>\r\n\r\n/**\r\n*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.\r\n*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/\r\n/*\r\nvar disqus_config = function () {\r\nthis.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable\r\nthis.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable\r\n};\r\n*/\r\n(function() { // DON\'T EDIT BELOW THIS LINE\r\nvar d = document, s = d.createElement(\'script\');\r\ns.src = \'https://startupengine-1.disqus.com/embed.js\';\r\ns.setAttribute(\'data-timestamp\', +new Date());\r\n(d.head || d.body).appendChild(s);\r\n})();\r\n</script>\r\n<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>',NULL,'code_editor',13,'Site'),
	(16,'site.twitter_account','Twitter Account','@StartupEngine',NULL,'text',14,'Site'),
	(17,'site.primary_color','Primary Color','#4444ff',NULL,'text',21,'Site'),
	(18,'site.secondary_color','Secondary Color','#7777ff',NULL,'text',24,'Site'),
	(20,'site.enable_comments','Enable Comments','1',NULL,'checkbox',26,'Site'),
	(21,'forum.forum_logo','Forum Logo','',NULL,'image',15,'Forum'),
	(22,'forum.welcome_message','Forum Welcome Message','Discussions',NULL,'text',16,'Forum'),
	(23,'forum.description','Forum Description','A place for feedback and support',NULL,'text',17,'Forum'),
	(24,'forum.header-background','Forum Header Background','[{\"download_link\":\"settings\\/October2017\\/1QuqaoWqotQL8J8ou1XJ.jpeg\",\"original_name\":\"photo-1503454175556-2d47ed6f1f7a.jpeg\"}]',NULL,'file',18,'Forum'),
	(25,'authentication.enable_auth0','Enable Auth0','0',NULL,'checkbox',19,'Authentication'),
	(26,'authentication.auth0_lock_code','auth0_lock_code','',NULL,'code_editor',20,'Authentication'),
	(27,'site.menu_html','Menu HTML','<!-- Navbar -->\r\n    <nav class=\"navbar navbar-expand-lg bg-info fixed-top navbar-transparent \" color-on-scroll=\"100\">\r\n        <div class=\"container\">\r\n            <div class=\"navbar-translate\">\r\n                <a class=\"navbar-brand\" href=\"/\" rel=\"tooltip\" title=\"A CMS designed for startups.\" data-placement=\"bottom\">\r\n                    <img src=\"https://psychoanalytics.s3-us-west-1.amazonaws.com/settings/October2017/logo1.png\" alt=\"Logo Icon\" style=\"max-width:40px;\"> Startup Engine\r\n                </a>\r\n                <button class=\"navbar-toggler navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navigation\" aria-controls=\"navigation-index\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n                    <span class=\"navbar-toggler-bar bar1\"></span>\r\n                    <span class=\"navbar-toggler-bar bar2\"></span>\r\n                    <span class=\"navbar-toggler-bar bar3\"></span>\r\n                </button>\r\n            </div>\r\n            <div class=\"collapse navbar-collapse justify-content-end\" id=\"navigation\" data-nav-image=\"/img/blurred-image-1.jpg\">\r\n                <ul class=\"navbar-nav\">\r\n                    <li class=\"nav-item hidden-sm-up\">\r\n                        <a class=\"nav-link\" href=\"/\">\r\n                            <p>Home</p>\r\n                        </a>\r\n                    </li>\r\n                    <li class=\"nav-item\">\r\n                        <a class=\"nav-link\" href=\"/features\">\r\n                            <p>Features</p>\r\n                        </a>\r\n                    </li>\r\n                    <li class=\"nav-item\">\r\n                        <a class=\"nav-link\" href=\"/articles\">\r\n                            <p>Articles</p>\r\n                        </a>\r\n                    </li>\r\n                     <li class=\"nav-item\">\r\n                        <a class=\"nav-link\" href=\"/help\">\r\n                            <p>Help & Documentation</p>\r\n                        </a>\r\n                    </li>\r\n                    <li class=\"nav-item\">\r\n                        <a class=\"nav-link btn btn-neutral\" href=\"/get-started\" style=\"color:#0f76ff;box-shadow: 0px 10px 30px rgba(0,0,0,0.1);\">\r\n                            <i class=\"now-ui-icons arrows-1_share-66\"></i>\r\n                            <p>Get Started</p>\r\n                        </a>\r\n                    </li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n<!-- End Navbar -->',NULL,'code_editor',11,'Site'),
	(28,'analytics.psychoanalytics_key','PsychoAnalytics Key','',NULL,'text',22,'Analytics'),
	(29,'analytics.custom_dashboard_html','Custom Dashboard HTML','',NULL,'code_editor',23,'Analytics'),
	(30,'site.global_header','Global Header','<meta charset=\"utf-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />\r\n<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no\' name=\'viewport\' />\r\n<script src=\"/js/core/jquery.3.2.1.min.js\" type=\"text/javascript\"></script>\r\n<script src=\"https://unpkg.com/vue\"></script>\r\n<!--   Core JS Files   -->\r\n<script src=\"/js/core/popper.min.js\" type=\"text/javascript\"></script>\r\n<script src=\"/js/core/bootstrap.min.js\" type=\"text/javascript\"></script>\r\n<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->\r\n<script src=\"/js/plugins/bootstrap-switch.js\"></script>\r\n<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->\r\n<script src=\"/js/plugins/nouislider.min.js\" type=\"text/javascript\"></script>\r\n<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->\r\n<script src=\"/js/plugins/bootstrap-datepicker.js\" type=\"text/javascript\"></script>\r\n<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->\r\n<script src=\"/js/now-ui-kit.js?v=1.1.0\" type=\"text/javascript\"></script>\r\n<script src=\"https://cdn.jsdelivr.net/npm/vue-resource@1.3.4\"></script>',NULL,'code_editor',7,'Site'),
	(31,'help.header_html','Header HTML','<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header page-header-small clear-filter\" filter-color=\"black\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-color:#3a92f1;\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center\" style=\"top:200px !important;\">\r\n                    <h1 class=\"title text-center\">How can we help?</h1>\r\n                    <div class=\"form-group\" style=\"padding:0px 15%;\">\r\n                        <form method=\"get\" enctype=\"multipart/form-data\" action=\"/search\">\r\n                            <input type=\"text\" id=\"s\" name=\"s\" class=\"form-control\" placeholder=\"Search for...\" aria-label=\"Search for...\">                     \r\n                        </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>',NULL,'code_editor',25,'Help'),
	(32,'site.favicon','Favicon','settings/October2017/logo3.png',NULL,'image',4,'Site'),
	(33,'post.header_html','Header HTML','<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n        <div class=\"wrapper\">\r\n            <div class=\"page-header page-header-small clear-filter\" filter-color=\"orange\">\r\n                <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-image: url(\'https://images.unsplash.com/photo-1493679349286-c570804c71ec?dpr=1&auto=compress,format&fit=crop&w=2851&h=&q=80&cs=tinysrgb&crop=\');\">\r\n                </div>\r\n                <div class=\"container\">\r\n                    <div class=\"content-center\">\r\n                        <div id=\"articles\">\r\n                            <todo-item\r\n                              v-for=\"item in items\"\r\n                              v-bind:todo=\"item\"\r\n                              v-bind:key=\"item.id\"\r\n                              v-bind:href=\"item.slug\">\r\n                            </todo-item>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"section\" style=\"padding-top:25px;margin-top:-75px !important;background:none;\">\r\n                    <div class=\"container\">\r\n                        <div class=\"row\">\r\n                            <div class=\"col-lg-12 col-md-12\">\r\n                                <div id=\"articles\" class=\"card-deck\">\r\n                                    <div class=\"col-md-12\" href=\"/content/post-with-video-2\"><div class=\"card\" style=\"box-shadow:0px -60px 60px rgba(0,0,0,0.2);\"><div class=\"card-body\">',NULL,'code_editor',27,'Post'),
	(34,'help.footer_html','Footer HTML','</body>',NULL,'code_editor',28,'Help'),
	(35,'search.header_html','Header HTML','<body class=\"index-page sidebar-collapse\">\r\n    <div id=\"startup_engine_nav_container\"></div>\r\n    <div class=\"wrapper\">\r\n        <div class=\"page-header page-header-small clear-filter\" filter-color=\"black\">\r\n            <div class=\"page-header-image\" data-parallax=\"true\" style=\"background-color:#222;\">\r\n            </div>\r\n            <div class=\"container\">\r\n                <div class=\"content-center\" style=\"top:200px !important;\">\r\n                    <h1 class=\"title text-center\">Search Results</h1>\r\n                    <div class=\"form-group\" style=\"padding:0px 15%;\">\r\n                        <form method=\"get\" enctype=\"multipart/form-data\" action=\"\">\r\n                            <input type=\"text\" id=\"s\" name=\"s\" class=\"form-control\" placeholder=\"Search for...\" aria-label=\"Search for...\">                     \r\n                        </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>',NULL,'code_editor',29,'Search'),
	(36,'search.footer_html','Footer HTML','</body>',NULL,'code_editor',30,'Search'),
	(37,'post.footer_html','Footer HTML','</div>  \r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <script>\r\n            var slug = /[^/]*$/.exec(window.location)[0];\r\n            Vue.component(\'todo-item\', {\r\n                props: [\'todo\'],\r\n                template: \'<div style=\"margin-top:100px;\"><h1>{{ todo.title }}</h1><h4>{{ todo.meta_description }}</h4></div>\'\r\n            });\r\n            console.log(slug);\r\n            var app7 = new Vue({\r\n              el: \'#articles\',\r\n              data: {\r\n                    items: null\r\n                },\r\n                created: function () {\r\n                    var _this = this;\r\n                    $.getJSON(\'http://127.0.0.1:8000/api/item?type=posts&slug=\' + slug, function (json) {\r\n                        _this.items = json;\r\n                    });\r\n                }\r\n            });\r\n            \r\n        </script>\r\n        </div>\r\n    </body>',NULL,'code_editor',31,'Post');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates`;

CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header_html` longtext COLLATE utf8_unicode_ci,
  `css` longtext COLLATE utf8_unicode_ci,
  `scripts` longtext COLLATE utf8_unicode_ci,
  `footer_html` longtext COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table translations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `translations`;

CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'data_types','display_name_singular',1,'pt','Post','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(2,'data_types','display_name_singular',2,'pt','Página','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(3,'data_types','display_name_singular',3,'pt','Utilizador','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(4,'data_types','display_name_singular',4,'pt','Categoria','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(5,'data_types','display_name_singular',5,'pt','Menu','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(6,'data_types','display_name_singular',6,'pt','Função','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(7,'data_types','display_name_plural',1,'pt','Posts','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(8,'data_types','display_name_plural',2,'pt','Páginas','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(9,'data_types','display_name_plural',3,'pt','Utilizadores','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(10,'data_types','display_name_plural',4,'pt','Categorias','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(11,'data_types','display_name_plural',5,'pt','Menus','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(12,'data_types','display_name_plural',6,'pt','Funções','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(13,'categories','slug',1,'pt','categoria-1','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(14,'categories','name',1,'pt','Categoria 1','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(15,'categories','slug',2,'pt','categoria-2','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(16,'categories','name',2,'pt','Categoria 2','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(17,'pages','title',1,'pt','Olá Mundo','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(18,'pages','slug',1,'pt','ola-mundo','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(19,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(20,'menu_items','title',1,'pt','Painel de Controle','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(21,'menu_items','title',2,'pt','Media','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(22,'menu_items','title',3,'pt','Publicações','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(23,'menu_items','title',4,'pt','Utilizadores','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(24,'menu_items','title',5,'pt','Categorias','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(25,'menu_items','title',6,'pt','Páginas','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(26,'menu_items','title',7,'pt','Funções','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(27,'menu_items','title',8,'pt','Ferramentas','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(28,'menu_items','title',9,'pt','Menus','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(29,'menu_items','title',10,'pt','Base de dados','2017-10-12 04:36:54','2017-10-12 04:36:54'),
	(30,'menu_items','title',13,'pt','Configurações','2017-10-12 04:36:54','2017-10-12 04:36:54');

/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,1,'Admin','admin@admin.com','users/October2017/default.png','$2y$10$fOCRCQwc554gP17x1Kp1r.rDK1I2HtGyBYoIAt3yi/RyqLiEMzXRW','62dSmBRS5WqcK25AS6OuyROBMBJZotFb7mxiDRNFJA9SxBrrXTOkvVL2qUsV','2017-10-12 04:36:54','2017-10-12 21:01:08');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
