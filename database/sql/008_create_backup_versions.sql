-- ============================================================
-- On Solutions - Script SQL #008
-- Tabelas de Backup, Versionamento e Parceiros
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: backups (registro de backups)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `backups` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `filename` VARCHAR(500) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_size` BIGINT UNSIGNED NULL,
    `type` ENUM('manual', 'automatic') DEFAULT 'manual',
    `includes` VARCHAR(255) DEFAULT 'database' COMMENT 'database, files, full',
    `status` ENUM('completed', 'failed', 'in_progress') DEFAULT 'completed',
    `notes` TEXT NULL,
    `created_by` INT UNSIGNED NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: versions (versionamento do sistema)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `versions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `version_number` VARCHAR(50) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `changelog` LONGTEXT NULL,
    `released_by` INT UNSIGNED NULL,
    `released_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`released_by`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_versions_number` (`version_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: partners (parceiros)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `partners` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description_pt` TEXT NULL,
    `description_en` TEXT NULL,
    `description_es` TEXT NULL,
    `logo` VARCHAR(500) NULL,
    `website` VARCHAR(500) NULL,
    `type` ENUM('technology', 'business', 'consultant', 'reseller') DEFAULT 'business',
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: testimonials (depoimentos)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `client_name` VARCHAR(255) NOT NULL,
    `company` VARCHAR(255) NULL,
    `role` VARCHAR(255) NULL,
    `avatar` VARCHAR(500) NULL,
    `content_pt` TEXT NOT NULL,
    `content_en` TEXT NULL,
    `content_es` TEXT NULL,
    `rating` TINYINT UNSIGNED DEFAULT 5,
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: faqs (perguntas frequentes)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `faqs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `question_pt` TEXT NOT NULL,
    `question_en` TEXT NULL,
    `question_es` TEXT NULL,
    `answer_pt` TEXT NOT NULL,
    `answer_en` TEXT NULL,
    `answer_es` TEXT NULL,
    `category` VARCHAR(100) NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: services (serviços oferecidos)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `services` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title_pt` VARCHAR(255) NOT NULL,
    `title_en` VARCHAR(255) NULL,
    `title_es` VARCHAR(255) NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `short_description_pt` TEXT NULL,
    `short_description_en` TEXT NULL,
    `short_description_es` TEXT NULL,
    `content_pt` LONGTEXT NULL,
    `content_en` LONGTEXT NULL,
    `content_es` LONGTEXT NULL,
    `icon` VARCHAR(100) NULL,
    `image` VARCHAR(500) NULL,
    `cover_image` VARCHAR(500) NULL,
    `features` JSON NULL,
    `technologies` JSON NULL,
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `order_position` INT DEFAULT 0,
    `meta_title_pt` VARCHAR(255) NULL,
    `meta_title_en` VARCHAR(255) NULL,
    `meta_title_es` VARCHAR(255) NULL,
    `meta_description_pt` VARCHAR(500) NULL,
    `meta_description_en` VARCHAR(500) NULL,
    `meta_description_es` VARCHAR(500) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_services_slug` (`slug`),
    INDEX `idx_services_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir serviços padrão
-- -----------------------------------------------------------
INSERT INTO `services` (`title_pt`, `title_en`, `title_es`, `slug`, `short_description_pt`, `icon`, `is_featured`, `order_position`) VALUES
('Sistemas Web', 'Web Systems', 'Sistemas Web', 'sistemas-web', 'Desenvolvimento de sistemas web completos e escaláveis para sua empresa.', 'bi-globe', 1, 1),
('ERP Personalizado', 'Custom ERP', 'ERP Personalizado', 'erp-personalizado', 'Sistemas de gestão empresarial desenvolvidos sob medida para seu negócio.', 'bi-building', 1, 2),
('CRM', 'CRM', 'CRM', 'crm', 'Gestão completa do relacionamento com seus clientes.', 'bi-people', 1, 3),
('Integrações & APIs', 'Integrations & APIs', 'Integraciones & APIs', 'integracoes-apis', 'Conecte seus sistemas e automatize processos entre plataformas.', 'bi-diagram-3', 1, 4),
('Automações', 'Automations', 'Automatizaciones', 'automacoes', 'Automatize processos repetitivos e aumente a produtividade.', 'bi-gear-wide-connected', 1, 5),
('Dashboards & BI', 'Dashboards & BI', 'Dashboards & BI', 'dashboards-bi', 'Painéis de controle e business intelligence para tomada de decisão.', 'bi-bar-chart-line', 1, 6),
('Aplicativos Mobile', 'Mobile Apps', 'Aplicaciones Móviles', 'aplicativos-mobile', 'Apps nativos e híbridos para iOS e Android.', 'bi-phone', 0, 7),
('SaaS', 'SaaS', 'SaaS', 'saas', 'Plataformas SaaS escaláveis e multi-tenant.', 'bi-cloud', 0, 8),
('Inteligência Artificial', 'Artificial Intelligence', 'Inteligencia Artificial', 'inteligencia-artificial', 'Soluções com IA, machine learning e chatbots inteligentes.', 'bi-robot', 1, 9),
('Chatbots', 'Chatbots', 'Chatbots', 'chatbots', 'Chatbots inteligentes para atendimento e vendas.', 'bi-chat-dots', 0, 10),
('Machine Learning', 'Machine Learning', 'Machine Learning', 'machine-learning', 'Modelos preditivos e análise de dados avançada.', 'bi-cpu', 0, 11),
('Consultoria', 'Consulting', 'Consultoría', 'consultoria', 'Consultoria tecnológica para transformação digital.', 'bi-lightbulb', 1, 12),
('Performance', 'Performance', 'Rendimiento', 'performance', 'Otimização de performance e escalabilidade de sistemas.', 'bi-speedometer2', 0, 13),
('Infraestrutura', 'Infrastructure', 'Infraestructura', 'infraestrutura', 'Cloud computing, DevOps e infraestrutura escalável.', 'bi-hdd-rack', 0, 14);

-- -----------------------------------------------------------
-- Inserir parceiro padrão (LRV Web)
-- -----------------------------------------------------------
INSERT INTO `partners` (`name`, `slug`, `description_pt`, `description_en`, `description_es`, `website`, `type`, `is_featured`) VALUES
('LRV Web', 'lrv-web', 'Parceira estratégica em desenvolvimento web, design e marketing digital.', 'Strategic partner in web development, design and digital marketing.', 'Socio estratégico en desarrollo web, diseño y marketing digital.', 'https://lrvweb.com.br', 'business', 1);

-- -----------------------------------------------------------
-- Inserir versão inicial
-- -----------------------------------------------------------
INSERT INTO `versions` (`version_number`, `title`, `description`, `changelog`) VALUES
('1.0.0', 'Lançamento Inicial', 'Primeira versão do sistema On Solutions', 'Site institucional completo\nPainel administrativo\nBlog com IA\nCRM\nFinanceiro\nPortfólio\nMultilíngue (PT/EN/ES)');

SET FOREIGN_KEY_CHECKS = 1;
