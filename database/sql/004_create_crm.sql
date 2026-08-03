-- ============================================================
-- On Solutions - Script SQL #004
-- Tabelas do CRM (Clientes, Projetos, Orçamentos)
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: clients (clientes)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `clients` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `company_name` VARCHAR(255) NULL,
    `contact_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NULL,
    `phone` VARCHAR(50) NULL,
    `whatsapp` VARCHAR(50) NULL,
    `document` VARCHAR(50) NULL COMMENT 'CPF/CNPJ',
    `address` TEXT NULL,
    `city` VARCHAR(100) NULL,
    `state` VARCHAR(50) NULL,
    `zip_code` VARCHAR(20) NULL,
    `country` VARCHAR(100) DEFAULT 'Brasil',
    `website` VARCHAR(500) NULL,
    `logo` VARCHAR(500) NULL,
    `status` ENUM('lead', 'prospect', 'active', 'inactive', 'lost') DEFAULT 'lead',
    `funnel_stage` ENUM('awareness', 'interest', 'consideration', 'intent', 'evaluation', 'purchase') DEFAULT 'awareness',
    `source` VARCHAR(100) NULL COMMENT 'Como chegou até nós',
    `notes` TEXT NULL,
    `assigned_to` INT UNSIGNED NULL,
    `total_revenue` DECIMAL(12,2) DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_clients_status` (`status`),
    INDEX `idx_clients_funnel` (`funnel_stage`),
    INDEX `idx_clients_assigned` (`assigned_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: client_interactions (histórico de interações)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `client_interactions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `client_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NULL,
    `type` ENUM('call', 'email', 'meeting', 'whatsapp', 'note', 'other') NOT NULL,
    `subject` VARCHAR(500) NULL,
    `description` TEXT NULL,
    `scheduled_at` TIMESTAMP NULL,
    `completed_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_interactions_client` (`client_id`),
    INDEX `idx_interactions_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: client_documents (documentos do cliente)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `client_documents` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `client_id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_size` INT UNSIGNED NULL,
    `file_type` VARCHAR(100) NULL,
    `uploaded_by` INT UNSIGNED NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: projects (projetos)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(500) NOT NULL,
    `description` TEXT NULL,
    `client_id` INT UNSIGNED NULL,
    `manager_id` INT UNSIGNED NULL,
    `status` ENUM('planning', 'in_progress', 'review', 'completed', 'cancelled', 'on_hold') DEFAULT 'planning',
    `priority` ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    `budget` DECIMAL(12,2) NULL,
    `start_date` DATE NULL,
    `due_date` DATE NULL,
    `completed_date` DATE NULL,
    `estimated_hours` DECIMAL(8,2) NULL,
    `actual_hours` DECIMAL(8,2) DEFAULT 0.00,
    `progress_percent` INT DEFAULT 0,
    `technologies` JSON NULL,
    `notes` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`manager_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_projects_client` (`client_id`),
    INDEX `idx_projects_status` (`status`),
    INDEX `idx_projects_priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: project_members (membros do projeto)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_members` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `project_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `role` VARCHAR(100) DEFAULT 'member',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_project_member` (`project_id`, `user_id`),
    FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: project_files (arquivos do projeto)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_files` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `project_id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_size` INT UNSIGNED NULL,
    `file_type` VARCHAR(100) NULL,
    `uploaded_by` INT UNSIGNED NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: project_hours (horas registradas)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_hours` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `project_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `hours` DECIMAL(5,2) NOT NULL,
    `description` TEXT NULL,
    `work_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: quotes (orçamentos)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `quote_number` VARCHAR(50) NOT NULL UNIQUE,
    `client_id` INT UNSIGNED NULL,
    `user_id` INT UNSIGNED NULL COMMENT 'Quem criou',
    `title` VARCHAR(500) NOT NULL,
    `description` TEXT NULL,
    `status` ENUM('draft', 'sent', 'viewed', 'accepted', 'rejected', 'expired') DEFAULT 'draft',
    `subtotal` DECIMAL(12,2) DEFAULT 0.00,
    `discount_percent` DECIMAL(5,2) DEFAULT 0.00,
    `discount_value` DECIMAL(12,2) DEFAULT 0.00,
    `tax_percent` DECIMAL(5,2) DEFAULT 0.00,
    `tax_value` DECIMAL(12,2) DEFAULT 0.00,
    `total` DECIMAL(12,2) DEFAULT 0.00,
    `currency` VARCHAR(10) DEFAULT 'BRL',
    `valid_until` DATE NULL,
    `notes` TEXT NULL,
    `terms` TEXT NULL,
    `signature` TEXT NULL COMMENT 'Assinatura digital base64',
    `signed_at` TIMESTAMP NULL,
    `signed_ip` VARCHAR(45) NULL,
    `sent_at` TIMESTAMP NULL,
    `viewed_at` TIMESTAMP NULL,
    `accepted_at` TIMESTAMP NULL,
    `rejected_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_quotes_number` (`quote_number`),
    INDEX `idx_quotes_client` (`client_id`),
    INDEX `idx_quotes_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: quote_items (itens do orçamento)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `quote_id` INT UNSIGNED NOT NULL,
    `description` TEXT NOT NULL,
    `quantity` DECIMAL(10,2) DEFAULT 1.00,
    `unit_price` DECIMAL(12,2) NOT NULL,
    `total_price` DECIMAL(12,2) NOT NULL,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`quote_id`) REFERENCES `quotes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: quote_history (histórico do orçamento)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote_history` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `quote_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NULL,
    `action` VARCHAR(100) NOT NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`quote_id`) REFERENCES `quotes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
