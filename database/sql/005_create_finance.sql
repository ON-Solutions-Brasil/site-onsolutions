-- ============================================================
-- On Solutions - Script SQL #005
-- Tabelas do Financeiro
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: finance_categories (categorias financeiras)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `finance_categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `type` ENUM('income', 'expense') NOT NULL,
    `color` VARCHAR(7) DEFAULT '#000000',
    `icon` VARCHAR(50) NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: finance_transactions (lançamentos)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `finance_transactions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `type` ENUM('income', 'expense') NOT NULL,
    `category_id` INT UNSIGNED NULL,
    `client_id` INT UNSIGNED NULL,
    `project_id` INT UNSIGNED NULL,
    `description` VARCHAR(500) NOT NULL,
    `amount` DECIMAL(12,2) NOT NULL,
    `currency` VARCHAR(10) DEFAULT 'BRL',
    `payment_method` VARCHAR(100) NULL,
    `reference` VARCHAR(255) NULL,
    `status` ENUM('pending', 'paid', 'overdue', 'cancelled') DEFAULT 'pending',
    `due_date` DATE NULL,
    `paid_date` DATE NULL,
    `notes` TEXT NULL,
    `receipt_path` VARCHAR(500) NULL,
    `recurring` TINYINT(1) DEFAULT 0,
    `recurring_interval` VARCHAR(50) NULL COMMENT 'monthly, weekly, yearly',
    `user_id` INT UNSIGNED NULL COMMENT 'Quem registrou',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `finance_categories`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_finance_type` (`type`),
    INDEX `idx_finance_status` (`status`),
    INDEX `idx_finance_date` (`due_date`),
    INDEX `idx_finance_client` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir categorias financeiras padrão
-- -----------------------------------------------------------
INSERT INTO `finance_categories` (`name`, `type`, `color`) VALUES
-- Receitas
('Projetos', 'income', '#28a745'),
('Manutenção', 'income', '#20c997'),
('Consultoria', 'income', '#17a2b8'),
('Licenças', 'income', '#6f42c1'),
('Outros', 'income', '#6c757d'),
-- Despesas
('Infraestrutura', 'expense', '#dc3545'),
('Pessoal', 'expense', '#fd7e14'),
('Marketing', 'expense', '#ffc107'),
('Ferramentas', 'expense', '#e83e8c'),
('Impostos', 'expense', '#343a40'),
('Escritório', 'expense', '#795548'),
('Outros', 'expense', '#9e9e9e');

SET FOREIGN_KEY_CHECKS = 1;
