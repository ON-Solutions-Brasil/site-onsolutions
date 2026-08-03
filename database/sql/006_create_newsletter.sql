-- ============================================================
-- On Solutions - Script SQL #006
-- Tabelas de Newsletter e Contato
-- ============================================================

SET NAMES utf8mb4;

-- -----------------------------------------------------------
-- Tabela: newsletter_subscribers
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `name` VARCHAR(255) NULL,
    `language` VARCHAR(5) DEFAULT 'pt',
    `status` ENUM('active', 'unsubscribed', 'bounced') DEFAULT 'active',
    `source` VARCHAR(100) NULL COMMENT 'De onde veio (site, import, manual)',
    `ip_address` VARCHAR(45) NULL,
    `subscribed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `unsubscribed_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_newsletter_email` (`email`),
    INDEX `idx_newsletter_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: contact_messages (mensagens de contato)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(50) NULL,
    `company` VARCHAR(255) NULL,
    `subject` VARCHAR(500) NULL,
    `message` TEXT NOT NULL,
    `status` ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    `replied_by` INT UNSIGNED NULL,
    `replied_at` TIMESTAMP NULL,
    `ip_address` VARCHAR(45) NULL,
    `source_page` VARCHAR(255) NULL,
    `language` VARCHAR(5) DEFAULT 'pt',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`replied_by`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_contact_status` (`status`),
    INDEX `idx_contact_date` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
