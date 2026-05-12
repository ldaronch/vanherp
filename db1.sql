-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela vanherp.about_company
CREATE TABLE IF NOT EXISTS `about_company` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.about_company: ~1 rows (aproximadamente)
INSERT INTO `about_company` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Sobre a Nossa Empresa', 'Conteúdo inicial sobre a empresa.', NULL, '2026-05-12 18:56:32', '2026-05-12 18:56:32');

-- Copiando estrutura para tabela vanherp.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.banners: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.categories: ~1 rows (aproximadamente)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Copo plástico', 'parana', '2026-05-11 01:19:16', '2026-05-11 01:19:16');

-- Copiando estrutura para tabela vanherp.circulars
CREATE TABLE IF NOT EXISTS `circulars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.circulars: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.circular_attachments
CREATE TABLE IF NOT EXISTS `circular_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circular_id` bigint unsigned NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `circular_attachments_circular_id_foreign` (`circular_id`),
  CONSTRAINT `circular_attachments_circular_id_foreign` FOREIGN KEY (`circular_id`) REFERENCES `circulars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.circular_attachments: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.clients: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.config_settings
CREATE TABLE IF NOT EXISTS `config_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_leads` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_display` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellphone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps_iframe` text COLLATE utf8mb4_unicode_ci,
  `working_hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.config_settings: ~1 rows (aproximadamente)
INSERT INTO `config_settings` (`id`, `site_title`, `email_leads`, `email_display`, `phone`, `cellphone`, `whatsapp`, `emergency_phone`, `address`, `city`, `state`, `zip_code`, `mailing_address`, `maps_iframe`, `working_hours`, `copyright_text`, `created_at`, `updated_at`) VALUES
	(1, 'VAN HERP & FRUMENTO', NULL, 'contato@vanherp.com', '(00) 0000-0000', '(00) 0000-0000', '(00) 0000-0000', '+55 41 <strong>99978-2564</strong>', 'Av. Arthur de Abreu, 29 – 9º andar , Sala 10\r\nEd. Palácio do Café, Centro Histórico,\r\nCEP 83.203-210 - Paranaguá – PR / Brasil', NULL, NULL, NULL, 'P.O. Box 355 - Centro Histórico, \r\nCEP 83.203-970 - Paranaguá / Brasil', NULL, NULL, '© 2026 Vanherp. Todos os direitos reservados.', '2026-05-04 04:22:18', '2026-05-12 04:02:15');

-- Copiando estrutura para tabela vanherp.contents
CREATE TABLE IF NOT EXISTS `contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `primary_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.contents: ~2 rows (aproximadamente)
INSERT INTO `contents` (`id`, `primary_text`, `title`, `subtitle`, `text`, `image`, `section`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Porto de Paranaguá:', 'FORÇA LOGÍSTICA QUE CONECTA O BRASIL AO MUNDO', 'O Porto de Paranaguá é um dos mais importantes complexos portuários do Brasil e referência nacional em logística, importação e exportação. Localizado em posição estratégica no litoral do Paraná, conecta o país aos principais mercados internacionais e movimenta milhões de toneladas em cargas todos os anos. Reconhecido pela eficiência operacional e constante modernização, o porto é essencial para setores como agronegócio, indústria, energia e comércio exterior, impulsionando o desenvolvimento econômico da região e do Brasil.', 'contents/oFOLcX9mhSoyM1li2HMwtFNpz8KRFhhESSFqqUDi.jpg', 'Um dos principais complexos portuários da América Latina, referência em eficiência, movimentação de cargas e desenvolvimento econômico nacional.', 1, '2026-05-09 19:25:05', '2026-05-09 19:25:05'),
	(2, 'Named “Dom Pedro II” in honor of Brazil\'s Emperor, it came under the administration\r\nof the Government of Paraná in 1917 and was officially inaugurated on 17 March 1935.', 'Port of Paranaguá:', 'The Port of Paranaguá is the largest bulk cargo port in Latin America.', 'It is sited in the city of Paranaguá, in the State of Paraná, on the southern shore of Paranaguá Bay. Maritime access is provided through the Galheta Channel, while road access is via the BR-277 highway, which connects Paranaguá to the state capital, Curitiba.\r\nThe port belongs to a port complex formed by the Ports of Paranaguá and Antonina, known as “Portos do Paraná.”\r\nThe main cargoes transported through the port are soya beans, corn, sugar, soya bean meal, fertilizers, containers mainly refrigerated cargoes, liquid agri-bulk cargoes, petroleum derivatives, ethanol, and vehicles.', 'contents/lTe7HiNe53r3o0R123WaRPrtvLNXXSZu8rIMNfv0.jpg', 'port_banner', 1, '2026-05-09 21:05:05', '2026-05-09 21:12:54');

-- Copiando estrutura para tabela vanherp.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.guidelines
CREATE TABLE IF NOT EXISTS `guidelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.guidelines: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.legal_texts
CREATE TABLE IF NOT EXISTS `legal_texts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `legal_texts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.legal_texts: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.migrations: ~37 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_04_13_135206_create_clients_table', 1),
	(6, '2026_04_13_135213_create_seos_table', 1),
	(7, '2026_04_13_135220_create_about_company_table', 1),
	(8, '2026_04_13_135227_create_partners_table', 1),
	(9, '2026_04_13_135233_create_contents_table', 1),
	(10, '2026_04_13_135240_create_banners_table', 1),
	(11, '2026_04_22_131410_create_ports_table', 1),
	(12, '2026_04_22_131553_create_circulars_table', 1),
	(13, '2026_04_22_131559_create_guidelines_table', 1),
	(14, '2026_04_22_131607_create_social_networks_table', 1),
	(15, '2026_04_22_131613_create_contact_settings_table', 1),
	(16, '2026_04_22_131938_create_legal_texts_table', 1),
	(17, '2026_04_22_131945_create_posts_table', 1),
	(18, '2026_04_22_131952_create_categories_table', 1),
	(19, '2026_04_22_133533_create_circular_attachments_table', 1),
	(20, '2026_04_28_000001_add_emergency_phone_and_mailing_address_to_contact_settings_table', 2),
	(21, '2026_04_28_000002_rename_social_networks_table_to_socialnets', 3),
	(22, '2026_04_28_000003_rename_contact_settings_table_to_config_settings', 4),
	(23, '2026_04_28_000004_create_pi_club_sections_table', 5),
	(24, '2026_04_28_000005_create_pi_club_links_table', 5),
	(25, '2026_05_04_000001_create_hometext_table', 6),
	(26, '2026_05_05_000001_create_news_table', 7),
	(27, '2026_05_05_000002_create_news_images_table', 7),
	(28, '2026_05_08_000001_add_url_to_hometext_table', 8),
	(29, '2026_05_09_000001_add_primary_text_to_contents_table', 9),
	(30, '2026_05_09_000002_add_date_and_header_line_to_posts_table', 10),
	(31, '2026_05_09_000003_add_is_active_to_contents_table', 11),
	(32, '2026_05_09_000004_make_posts_category_nullable_and_add_is_featured_to_posts_table', 12),
	(33, '2026_05_10_000001_add_url_and_is_active_to_ports_table', 13),
	(34, '2026_05_12_000001_update_pi_clubs_tables_for_public_page_and_toggles', 14),
	(35, '2026_05_12_000002_create_circular_guideline_sections_and_items_tables', 15),
	(36, '2026_05_12_000003_add_team_fields_to_partners_table', 16),
	(37, '2026_05_12_000004_create_page_banners_table', 17);

-- Copiando estrutura para tabela vanherp.partners
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partners_priority_index` (`priority`),
  KEY `partners_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.partners: ~3 rows (aproximadamente)
INSERT INTO `partners` (`id`, `name`, `role`, `bio`, `email`, `mobile`, `priority`, `is_active`, `logo`, `link`, `created_at`, `updated_at`) VALUES
	(1, 'JOÃO HELIO FRUMENTO', 'Senior in-house surveyor / handler.', 'Is a Master Mariner, holds a BSc (Hons) degree in Maritime Studies, having served 5 years at sea as Navigating and Deck Officer on General Cargo and Bulk-Carrier vessels.\r\nHandles all types of P&I casualties, mainly involving environmental pollution; collisions; casualties; property damage; general average; draft surveys; cargo loading and discharging monitoring; sealing and unsealing of hatches and commodity grading.\r\nJoão Frumento is a qualified Master Mariner and Agricultural Commodity Grader accredited by the Brazilian Ministry of Agriculture, being a Category G Professional Member of GAFTA (The Grain and Feed Trade Association).', 'frumento@pandi-png.com.br', '+55 41 99978-2564', 2, 1, 'team/TtffEbT3ET91XICpYmAgRhdWaPtxOGOW1cHolUyD.jpg', NULL, '2026-05-12 18:50:24', '2026-05-12 18:52:56'),
	(2, 'Abilio Abreu', 'Senior Handler / In-House Lawyer.', 'Has a degree in law and joined the company in 2000. \r\nHandles matters involving crew and shore personnel medical assistance; repatriation of crew members in case of death; stowaways; Customs, Immigration, Health and Navy Authorities’ regulations; cargo claims and containerized cargo.', 'abreu@pandi-png.com.br', '+55 41 99903-9631', 1, 1, 'team/LnMuhMXY1rLvKoJ3tfDlQaJqyT9bDqzR8CnDDxZQ.jpg', NULL, '2026-05-12 18:51:52', '2026-05-12 18:51:52'),
	(3, 'Angela Frumento', 'Junior Handler / In-House Lawyer.', 'Has a degree in law and joined the company in 2024.\r\nHandles matters involving Customs, Immigration, Health and Navy Authorities’ regulations, cargo claims and lawsuits.\r\nIs a member of WISTA Brazil, an international networking organization whose mission is to promote gender equality and diversity as forces for positive change across maritime, trading and logistics.', 'angela.frumento@pandi-png.com.br', '+55 41 99645-3402', 0, 1, 'team/lvncEF8wunutUvIo20QSDI5yRrDPLq78qedWnkBO.jpg', NULL, '2026-05-12 18:54:03', '2026-05-12 18:54:03');

-- Copiando estrutura para tabela vanherp.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.password_resets: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.ports
CREATE TABLE IF NOT EXISTS `ports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ports_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.ports: ~5 rows (aproximadamente)
INSERT INTO `ports` (`id`, `name`, `url`, `is_active`, `location`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Itajai', 'http://www.portoitajai.com.br/', 1, NULL, NULL, NULL, '2026-05-12 05:06:13', '2026-05-12 05:06:13'),
	(2, 'Paranaguá', 'http://www.portosdoparana.pr.gov.br/', 1, NULL, NULL, NULL, '2026-05-12 05:07:39', '2026-05-12 05:07:39'),
	(3, 'Antonina', 'http://www.portosdoparana.pr.gov.br/', 1, NULL, NULL, NULL, '2026-05-12 05:08:42', '2026-05-12 05:08:42'),
	(4, 'São Francisco do Sul', 'http://www.apsfs.sc.gov.br/', 1, NULL, NULL, NULL, '2026-05-12 05:09:20', '2026-05-12 05:09:20'),
	(5, 'Imbituba', 'http://www.cdiport.com.br/', 1, NULL, NULL, NULL, '2026-05-12 05:09:56', '2026-05-12 05:09:56');

-- Copiando estrutura para tabela vanherp.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_line` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_index` (`category_id`),
  KEY `posts_is_featured_index` (`is_featured`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.posts: ~3 rows (aproximadamente)
INSERT INTO `posts` (`id`, `category_id`, `date`, `title`, `header_line`, `slug`, `content`, `image`, `is_published`, `is_featured`, `created_at`, `updated_at`) VALUES
	(1, NULL, '2026-05-09', 'SOYA SHELF LIFE – A NEW PERSPECTIVE', NULL, '#', '<p>There is promising research aimed at extending soya beans shelf-life. Scientists of UFRJ – Federal University of Rio de Janeiro and EMBRAPA - The Brazilian Agricultural Research Corporation discovered the benefits of a native Brazilian Amazon palm, named Tucuma (Astrocaryum vulgare Mat.) as an antifungal / biopesticide potential against pathogens.</p>', 'posts/3t7vmS9B1MQL5w4QphEfUuvDwEijrbTu9khBW9GS.jpg', 1, 1, '2026-05-11 01:29:00', '2026-05-12 19:14:29'),
	(2, NULL, '2026-05-09', 'BRAZILIAN SOYA BEANS DESTINED TO CHINA – CONTINUED CHALLENGE', NULL, 'soya', '<p>Brazil is one of the world\'s leading soya bean producers. Historically, exports to Europe rarely triggered cargoquality complaints due to shorter transit times and limited air and seawater temperature variation. However, as China increased imports, significant cargo claims became a new challenge for Owners and their P&amp;I Clubs.</p>', 'posts/jxiA8yuAyoQsUhMM9c7vVBhl9kPijpvl5rS3h8ap.jpg', 1, 1, '2026-05-11 01:29:00', '2026-05-12 19:16:17'),
	(3, NULL, '2026-05-09', 'DRAUGHT SURVEY: HULL DEFLEXION – SELECT THE CORRECT TOOL', NULL, 'ports', '<p>Bulk carriers must perform draft survey calculations before and after cargo operations (as set out in the contract of carriage). In States that have ratified the Carriage Conventions, bill of lading reservations may support carriers\' liability exemptions when shortage claims arise after the voyage. However, some jurisdictions reject these reservations, and Owners and their P&amp;I Clubs may face significant shortage claims.</p>', 'posts/E8KcshLmbq9e1eake96ux4Oz3URWn6IU838hqpT4.jpg', 1, 1, '2026-05-11 01:29:00', '2026-05-12 19:17:21');

-- Copiando estrutura para tabela vanherp.seos
CREATE TABLE IF NOT EXISTS `seos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seos_page_name_unique` (`page_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.seos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vanherp.socialnets
CREATE TABLE IF NOT EXISTS `socialnets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.socialnets: ~1 rows (aproximadamente)
INSERT INTO `socialnets` (`id`, `name`, `url`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Linkedin', 'https://www.linkedin.com/in/ldaronch/', 'fab fa-linkedin', 1, NULL, NULL);

-- Copiando estrutura para tabela vanherp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela vanherp.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Alex Architect', 'admin@admin.com', NULL, '$2y$10$El5sl3VgCfIomzeR4ZXZb.bEW8CmcHzRfpvUBYk8em4IKFN0qZTeW', NULL, '2026-04-29 05:18:33', '2026-04-29 05:18:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
