-- ============================================================
-- On Solutions - Script SQL #003
-- Tabelas do Portfólio
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: portfolio_categories
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name_pt` VARCHAR(255) NOT NULL,
    `name_en` VARCHAR(255) NULL,
    `name_es` VARCHAR(255) NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: portfolio_items (projetos do portfólio)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title_pt` VARCHAR(500) NOT NULL,
    `title_en` VARCHAR(500) NULL,
    `title_es` VARCHAR(500) NULL,
    `slug` VARCHAR(500) NOT NULL UNIQUE,
    `description_pt` LONGTEXT NULL,
    `description_en` LONGTEXT NULL,
    `description_es` LONGTEXT NULL,
    `short_description_pt` TEXT NULL,
    `short_description_en` TEXT NULL,
    `short_description_es` TEXT NULL,
    `client_name` VARCHAR(255) NULL,
    `client_logo` VARCHAR(500) NULL,
    `category_id` INT UNSIGNED NULL,
    `cover_image` VARCHAR(500) NULL,
    `video_url` VARCHAR(500) NULL,
    `technologies` JSON NULL,
    `results_pt` TEXT NULL,
    `results_en` TEXT NULL,
    `results_es` TEXT NULL,
    `project_url` VARCHAR(500) NULL,
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `completed_at` DATE NULL,
    `meta_title_pt` VARCHAR(255) NULL,
    `meta_title_en` VARCHAR(255) NULL,
    `meta_title_es` VARCHAR(255) NULL,
    `meta_description_pt` VARCHAR(500) NULL,
    `meta_description_en` VARCHAR(500) NULL,
    `meta_description_es` VARCHAR(500) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `portfolio_categories`(`id`) ON DELETE SET NULL,
    INDEX `idx_portfolio_slug` (`slug`),
    INDEX `idx_portfolio_featured` (`is_featured`),
    INDEX `idx_portfolio_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: portfolio_images (galeria do projeto)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_images` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `portfolio_id` INT UNSIGNED NOT NULL,
    `image_path` VARCHAR(500) NOT NULL,
    `caption` VARCHAR(500) NULL,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio_items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: portfolio_tags
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_tags` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: portfolio_item_tags
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_item_tags` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `portfolio_id` INT UNSIGNED NOT NULL,
    `tag_id` INT UNSIGNED NOT NULL,
    UNIQUE KEY `unique_portfolio_tag` (`portfolio_id`, `tag_id`),
    FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio_items`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tag_id`) REFERENCES `portfolio_tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir categorias padrão
-- -----------------------------------------------------------
INSERT INTO `portfolio_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `order_position`) VALUES
('Sistemas Web', 'Web Systems', 'Sistemas Web', 'sistemas-web', 1),
('ERP', 'ERP', 'ERP', 'erp', 2),
('CRM', 'CRM', 'CRM', 'crm', 3),
('Integrações', 'Integrations', 'Integraciones', 'integracoes', 4),
('Aplicativos', 'Mobile Apps', 'Aplicaciones', 'aplicativos', 5),
('IA & Machine Learning', 'AI & Machine Learning', 'IA & Machine Learning', 'ia-machine-learning', 6),
('E-commerce', 'E-commerce', 'E-commerce', 'e-commerce', 7),
('SaaS', 'SaaS', 'SaaS', 'saas', 8);

SET FOREIGN_KEY_CHECKS = 1;
