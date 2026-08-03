-- ============================================================
-- On Solutions - Script SQL #007
-- Tabelas do CMS (páginas dinâmicas)
-- ============================================================

SET NAMES utf8mb4;

-- -----------------------------------------------------------
-- Tabela: pages (páginas CMS)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title_pt` VARCHAR(500) NOT NULL,
    `title_en` VARCHAR(500) NULL,
    `title_es` VARCHAR(500) NULL,
    `slug` VARCHAR(500) NOT NULL UNIQUE,
    `content_pt` LONGTEXT NULL,
    `content_en` LONGTEXT NULL,
    `content_es` LONGTEXT NULL,
    `excerpt_pt` TEXT NULL,
    `excerpt_en` TEXT NULL,
    `excerpt_es` TEXT NULL,
    `featured_image` VARCHAR(500) NULL,
    `template` VARCHAR(100) DEFAULT 'default',
    `parent_id` INT UNSIGNED NULL,
    `author_id` INT UNSIGNED NULL,
    `status` ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    `show_in_menu` TINYINT(1) DEFAULT 0,
    `menu_order` INT DEFAULT 0,
    `meta_title_pt` VARCHAR(255) NULL,
    `meta_title_en` VARCHAR(255) NULL,
    `meta_title_es` VARCHAR(255) NULL,
    `meta_description_pt` VARCHAR(500) NULL,
    `meta_description_en` VARCHAR(500) NULL,
    `meta_description_es` VARCHAR(500) NULL,
    `og_image` VARCHAR(500) NULL,
    `custom_css` TEXT NULL,
    `custom_js` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`parent_id`) REFERENCES `pages`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_pages_slug` (`slug`),
    INDEX `idx_pages_status` (`status`),
    INDEX `idx_pages_menu` (`show_in_menu`, `menu_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: menus
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `menus` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `location` VARCHAR(100) NOT NULL COMMENT 'header, footer, sidebar',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: menu_items
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `menu_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `menu_id` INT UNSIGNED NOT NULL,
    `parent_id` INT UNSIGNED NULL,
    `title_pt` VARCHAR(255) NOT NULL,
    `title_en` VARCHAR(255) NULL,
    `title_es` VARCHAR(255) NULL,
    `url` VARCHAR(500) NULL,
    `page_id` INT UNSIGNED NULL,
    `target` VARCHAR(20) DEFAULT '_self',
    `icon` VARCHAR(100) NULL,
    `order_position` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`parent_id`) REFERENCES `menu_items`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir menus padrão
-- -----------------------------------------------------------
INSERT INTO `menus` (`name`, `slug`, `location`) VALUES
('Menu Principal', 'main-menu', 'header'),
('Menu Footer', 'footer-menu', 'footer'),
('Menu Serviços', 'services-menu', 'footer');
