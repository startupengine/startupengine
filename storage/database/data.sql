# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18)
# Database: nlpbot
# Generation Time: 2017-10-17 23:32:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table announcements
# ------------------------------------------------------------

CREATE TABLE `announcements` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table api_tokens
# ------------------------------------------------------------

CREATE TABLE `api_tokens` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transient` tinyint(4) NOT NULL DEFAULT '0',
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_tokens_token_unique` (`token`),
  KEY `api_tokens_user_id_expires_at_index` (`user_id`,`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table customer_profile_research_collection
# ------------------------------------------------------------

CREATE TABLE `customer_profile_research_collection` (
  `research_collection_id` int(10) unsigned DEFAULT NULL,
  `customer_profile_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table invitations
# ------------------------------------------------------------

CREATE TABLE `invitations` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitations_token_unique` (`token`),
  KEY `invitations_team_id_index` (`team_id`),
  KEY `invitations_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `invitations` WRITE;
/*!40000 ALTER TABLE `invitations` DISABLE KEYS */;

INSERT INTO `invitations` (`id`, `team_id`, `user_id`, `email`, `token`, `created_at`, `updated_at`)
VALUES
	('8a49e914-d393-45e8-98e6-14f10e2e19c6',4,NULL,'support@psychoanalytics.io','QSgdkclZqvCbPm3qjxqY6dsk5zxARIYqVMtJR6Mn','2017-08-17 01:57:25','2017-08-17 01:57:25'),
	('e5fe524d-68aa-4adc-aba2-e1ebb86d8413',4,1,'huntercarter@gmail.com','85j4pMquxl84rCFFUOQRoh68hRcrVJcq0nVp02ga','2017-08-17 01:53:55','2017-08-17 01:53:55');

/*!40000 ALTER TABLE `invitations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invoices
# ------------------------------------------------------------

CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_created_at_index` (`created_at`),
  KEY `invoices_user_id_index` (`user_id`),
  KEY `invoices_team_id_index` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table meta
# ------------------------------------------------------------

CREATE TABLE `meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `metable_id` int(10) unsigned NOT NULL,
  `metable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_metable_id_index` (`metable_id`),
  KEY `meta_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;

INSERT INTO `meta` (`id`, `metable_id`, `metable_type`, `key`, `value`)
VALUES
	(2,2,'App\\Site','onboarding-stage','\"initial\"'),
	(6,4,'App\\Site','onboarding-stage','\"initial\"'),
	(9,1,'App\\Site','mixpanel-api-secret','\"x\"'),
	(10,1,'App\\Site','_token','\"j2aOVAHJkLK0Ubmk6ImQM1W4xWxPLsmViM3C3v93\"'),
	(35,1,'App\\Site','onboarding-stage','\"onboarded\"'),
	(36,1,'App\\Site','onboarding-percent','\"100\"');

/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2017_05_04_100000_create_meta_table',1),
	(2,'2017_06_15_045735_create_performance_indicators_table',1),
	(3,'2017_06_15_045736_create_announcements_table',1),
	(4,'2017_06_15_045738_create_users_table',1),
	(5,'2017_06_15_045741_create_password_resets_table',1),
	(6,'2017_06_15_045745_create_api_tokens_table',1),
	(7,'2017_06_15_045750_create_subscriptions_table',1),
	(8,'2017_06_15_045756_create_invoices_table',1),
	(9,'2017_06_15_045803_create_notifications_table',1),
	(10,'2017_06_15_045811_create_teams_table',1),
	(11,'2017_06_15_045820_create_team_users_table',1),
	(12,'2017_06_15_045830_create_invitations_table',1),
	(13,'2017_06_17_082120_create_jobs_table',1),
	(14,'2017_06_22_040004_create_tag_tables',1),
	(15,'2017_06_25_033813_create_urls',1),
	(16,'2017_06_25_035227_add_tags_columns',1),
	(17,'2017_06_25_042703_add_proccessed_text_column',1),
	(18,'2017_06_26_072924_add_concepts',1),
	(19,'2017_07_26_053129_create_research_collections_table',1),
	(20,'2017_07_26_190150_add_site_id_to_research_documents',1),
	(21,'2017_07_27_051133_rename_urls_table',1),
	(22,'2017_07_27_051223_create_researchcollection_researchitem_table',1),
	(23,'2017_07_29_051223_create_customer_profiles_research_collections_table',1),
	(24,'2017_07_29_203240_add_uid_to_research_items',1),
	(25,'2017_07_31_070848_add_watson_column_to_research_items',1),
	(26,'2017_08_10_205909_add_uclassy_column_to_research_items',1),
	(27,'2017_08_11_232955_add_auth0_fields_to_users_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

CREATE TABLE `notifications` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_created_at_index` (`user_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `user_id`, `created_by`, `icon`, `body`, `action_text`, `action_url`, `read`, `created_at`, `updated_at`)
VALUES
	('07fd5f62-9bc3-4b95-bc5f-5da25f94c43e',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:43:44','2017-08-18 01:12:19'),
	('3e098f68-2517-4489-b3d6-398b2bfeea65',3,NULL,'fa-clock-o','The Test project\'s trial period will expire on August 24th.','Subscribe','/settings/projects/4#/subscription',1,'2017-08-17 01:39:23','2017-08-17 23:13:27'),
	('41c99224-813c-4c1c-8089-4a0e46d00421',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:51:59','2017-08-18 01:12:19'),
	('4ecf6468-57ed-4fbf-b021-bebbed0d5766',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:53:57','2017-08-18 01:12:19'),
	('713b787f-1503-467f-a80d-cde454a7e45a',3,NULL,'fa-clock-o','The test project\'s trial period will expire on August 23rd.','Subscribe','/settings/projects/3#/subscription',1,'2017-08-16 21:30:46','2017-08-17 23:13:27'),
	('9044e9b6-12cb-4630-b33e-321e7b8cb607',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:52:28','2017-08-18 01:12:19'),
	('a7ac10e1-80b9-4d51-87da-9a9c040e9539',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:52:53','2017-08-18 01:12:19'),
	('aee64c4c-590a-4c19-a2a4-0ab1c259546e',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:42:34','2017-08-18 01:12:19'),
	('b211bbe7-79c2-4265-8097-5a4984bb4c6f',2,NULL,'fa-clock-o','The Test project\'s trial period will expire on August 23rd.','Subscribe','/settings/projects/2#/subscription',1,'2017-08-16 04:35:46','2017-08-16 04:35:54'),
	('d9b647e5-db5d-49b0-a84a-e22dc44db426',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:50:40','2017-08-18 01:12:19'),
	('e4d698ca-2989-457e-9cf4-43c1bec6a8e8',1,NULL,'fa-users','You have been invited to join the Test project!','View Invitations','/settings#/projects',1,'2017-08-17 01:51:33','2017-08-18 01:12:19');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table performance_indicators
# ------------------------------------------------------------

CREATE TABLE `performance_indicators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monthly_recurring_revenue` decimal(8,2) NOT NULL,
  `yearly_recurring_revenue` decimal(8,2) NOT NULL,
  `daily_volume` decimal(8,2) NOT NULL,
  `new_users` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `performance_indicators_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table research_collection_research_item
# ------------------------------------------------------------

CREATE TABLE `research_collection_research_item` (
  `research_collection_id` int(10) unsigned DEFAULT NULL,
  `research_item_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table research_collections
# ------------------------------------------------------------

CREATE TABLE `research_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `site_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table research_items
# ------------------------------------------------------------

CREATE TABLE `research_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `rawtext` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `summary_raw` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `keywords_raw` text COLLATE utf8mb4_unicode_ci,
  `topics` text COLLATE utf8mb4_unicode_ci,
  `topics_raw` text COLLATE utf8mb4_unicode_ci,
  `mood` decimal(8,2) DEFAULT NULL,
  `positive` decimal(8,2) DEFAULT NULL,
  `negative` decimal(8,2) DEFAULT NULL,
  `anger` decimal(8,2) DEFAULT NULL,
  `fear` decimal(8,2) DEFAULT NULL,
  `jealousy` decimal(8,2) DEFAULT NULL,
  `joy` decimal(8,2) DEFAULT NULL,
  `love` decimal(8,2) DEFAULT NULL,
  `sadness` decimal(8,2) DEFAULT NULL,
  `absolutistic` decimal(8,2) DEFAULT NULL,
  `achievist` decimal(8,2) DEFAULT NULL,
  `exploitive` decimal(8,2) DEFAULT NULL,
  `instinctive` decimal(8,2) DEFAULT NULL,
  `relativistic` decimal(8,2) DEFAULT NULL,
  `systemic` decimal(8,2) DEFAULT NULL,
  `tribalistic` decimal(8,2) DEFAULT NULL,
  `lowerleft` decimal(8,2) DEFAULT NULL,
  `lowerright` decimal(8,2) DEFAULT NULL,
  `upperleft` decimal(8,2) DEFAULT NULL,
  `upperright` decimal(8,2) DEFAULT NULL,
  `abstract` decimal(8,2) DEFAULT NULL,
  `concrete` decimal(8,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tags_raw` text COLLATE utf8mb4_unicode_ci,
  `processedtext` text COLLATE utf8mb4_unicode_ci,
  `concepts_raw` text COLLATE utf8mb4_unicode_ci,
  `site_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` text COLLATE utf8mb4_unicode_ci,
  `version` text COLLATE utf8mb4_unicode_ci,
  `watson_analysis` longtext COLLATE utf8mb4_unicode_ci,
  `uclassify_analysis` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table subscriptions
# ------------------------------------------------------------

CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table taggables
# ------------------------------------------------------------

CREATE TABLE `taggables` (
  `tag_id` int(10) unsigned NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `taggables_tag_id_foreign` (`tag_id`),
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table tags
# ------------------------------------------------------------

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table team_subscriptions
# ------------------------------------------------------------

CREATE TABLE `team_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table team_users
# ------------------------------------------------------------

CREATE TABLE `team_users` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `team_users_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `team_users` WRITE;
/*!40000 ALTER TABLE `team_users` DISABLE KEYS */;

INSERT INTO `team_users` (`team_id`, `user_id`, `role`)
VALUES
	(1,1,'owner'),
	(2,2,'owner'),
	(4,3,'owner');

/*!40000 ALTER TABLE `team_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table teams
# ------------------------------------------------------------

CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_slug_unique` (`slug`),
  KEY `teams_owner_id_index` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;

INSERT INTO `teams` (`id`, `owner_id`, `name`, `slug`, `photo_url`, `stripe_id`, `current_billing_plan`, `card_brand`, `card_last_four`, `card_country`, `billing_address`, `billing_address_line_2`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `vat_id`, `extra_billing_information`, `trial_ends_at`, `created_at`, `updated_at`)
VALUES
	(1,1,'Mythic',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-23 04:33:56','2017-08-16 04:33:56','2017-08-16 04:33:56'),
	(2,2,'Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-23 04:35:46','2017-08-16 04:35:46','2017-08-16 04:35:46'),
	(4,3,'Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-24 01:39:23','2017-08-17 01:39:23','2017-08-17 01:39:23');

/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `uses_two_factor_auth` tinyint(4) NOT NULL DEFAULT '0',
  `authy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_reset_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` int(11) DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `last_read_announcements_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth0id` varchar(244) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture_large` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_name` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_name` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(244) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `photo_url`, `uses_two_factor_auth`, `authy_id`, `country_code`, `phone`, `two_factor_reset_code`, `current_team_id`, `stripe_id`, `current_billing_plan`, `card_brand`, `card_last_four`, `card_country`, `billing_address`, `billing_address_line_2`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `vat_id`, `extra_billing_information`, `trial_ends_at`, `last_read_announcements_at`, `created_at`, `updated_at`, `auth0id`, `picture`, `picture_large`, `gender`, `given_name`, `family_name`, `locale`)
VALUES
	(1,'Hunter Carter','huntercarter@gmail.com',NULL,'Ch0E3QhlZgyEdyPZrHnCPY7yiObwMSiQkg2xmZmBnFJXFwqVjJ9xBGtTca5y',NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-16 04:33:47','2017-08-16 04:33:57','google-oauth2|114807777070269090907',NULL,NULL,NULL,NULL,NULL,NULL),
	(3,'Hunter Carter','jameshuntercarter@gmail.com',NULL,'IVN1bPPsF6o6FNvGbHSR8YJyIMAkFV9GBO1vd7q6gxjZLNZOaGnezsicDJEv',NULL,0,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-16 21:13:48','2017-08-17 01:39:23','google-oauth2|101883998741738711728',NULL,NULL,NULL,NULL,NULL,NULL),
	(4,'abcdefg@example.com','abcdefg@example.com',NULL,'NGO8eqxFy1ifFFpy444g0OUNfSMm6dRAV0QlHLOrppy2IQg1D5hCSENRG37p',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-08-17 00:34:04','2017-08-17 00:34:04','auth0|5994e47711a5631c8ff782b0',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
