-- ============================================================
-- On Solutions - Script SQL #001
-- Criação das tabelas principais do sistema
-- Data: 2024
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: settings (configurações do sistema)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(191) NOT NULL UNIQUE,
    `setting_value` TEXT NULL,
    `setting_group` VARCHAR(100) DEFAULT 'general',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_settings_key` (`setting_key`),
    INDEX `idx_settings_group` (`setting_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: roles (perfis de usuário)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT NULL,
    `is_system` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: permissions (permissões)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `permissions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(191) NOT NULL UNIQUE,
    `slug` VARCHAR(191) NOT NULL UNIQUE,
    `module` VARCHAR(100) NOT NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: role_permissions (relação perfil-permissão)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `role_permissions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `role_id` INT UNSIGNED NOT NULL,
    `permission_id` INT UNSIGNED NOT NULL,
    UNIQUE KEY `unique_role_permission` (`role_id`, `permission_id`),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: users (usuários do sistema)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(191) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role_id` INT UNSIGNED NOT NULL,
    `role` VARCHAR(100) NOT NULL DEFAULT 'editor',
    `avatar` VARCHAR(500) NULL,
    `phone` VARCHAR(50) NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `email_verified_at` TIMESTAMP NULL,
    `remember_token` VARCHAR(255) NULL,
    `reset_token` VARCHAR(255) NULL,
    `reset_token_expires` TIMESTAMP NULL,
    `last_login_at` TIMESTAMP NULL,
    `last_login_ip` VARCHAR(45) NULL,
    `login_attempts` INT DEFAULT 0,
    `locked_until` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`),
    INDEX `idx_users_email` (`email`),
    INDEX `idx_users_role` (`role`),
    INDEX `idx_users_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: sessions (sessões ativas)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `session_id` VARCHAR(255) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NULL,
    `last_activity` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_sessions_user` (`user_id`),
    INDEX `idx_sessions_sid` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: activity_logs (logs de atividade)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `activity_logs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NULL,
    `action` VARCHAR(100) NOT NULL,
    `module` VARCHAR(100) NOT NULL,
    `description` TEXT NULL,
    `target_type` VARCHAR(100) NULL,
    `target_id` INT UNSIGNED NULL,
    `old_values` JSON NULL,
    `new_values` JSON NULL,
    `ip_address` VARCHAR(45) NULL,
    `user_agent` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_logs_user` (`user_id`),
    INDEX `idx_logs_action` (`action`),
    INDEX `idx_logs_module` (`module`),
    INDEX `idx_logs_date` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: rate_limits (controle de tentativas)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rate_limits` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `ip_address` VARCHAR(45) NOT NULL,
    `route_key` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_rate_ip` (`ip_address`),
    INDEX `idx_rate_route` (`route_key`),
    INDEX `idx_rate_date` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: api_tokens (tokens para API)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `api_tokens` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL UNIQUE,
    `abilities` JSON NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `last_used_at` TIMESTAMP NULL,
    `expires_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_api_token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir perfis padrão
-- -----------------------------------------------------------
INSERT INTO `roles` (`name`, `slug`, `description`, `is_system`) VALUES
('Super Administrador', 'super_admin', 'Acesso total ao sistema', 1),
('Administrador', 'admin', 'Acesso administrativo geral', 1),
('Editor', 'editor', 'Gerencia conteúdo do site e blog', 1),
('Comercial', 'commercial', 'Acesso ao CRM, orçamentos e clientes', 1),
('Financeiro', 'financial', 'Acesso ao módulo financeiro', 1),
('Marketing', 'marketing', 'Acesso ao blog, newsletter e portfólio', 1),
('Desenvolvedor', 'developer', 'Acesso técnico e logs', 1);

-- -----------------------------------------------------------
-- Inserir permissões padrão
-- -----------------------------------------------------------
INSERT INTO `permissions` (`name`, `slug`, `module`) VALUES
-- Dashboard
('Visualizar Dashboard', 'dashboard.view', 'dashboard'),
-- Usuários
('Visualizar Usuários', 'users.view', 'users'),
('Criar Usuários', 'users.create', 'users'),
('Editar Usuários', 'users.edit', 'users'),
('Excluir Usuários', 'users.delete', 'users'),
-- Clientes
('Visualizar Clientes', 'clients.view', 'clients'),
('Criar Clientes', 'clients.create', 'clients'),
('Editar Clientes', 'clients.edit', 'clients'),
('Excluir Clientes', 'clients.delete', 'clients'),
-- Projetos
('Visualizar Projetos', 'projects.view', 'projects'),
('Criar Projetos', 'projects.create', 'projects'),
('Editar Projetos', 'projects.edit', 'projects'),
('Excluir Projetos', 'projects.delete', 'projects'),
-- Orçamentos
('Visualizar Orçamentos', 'quotes.view', 'quotes'),
('Criar Orçamentos', 'quotes.create', 'quotes'),
('Editar Orçamentos', 'quotes.edit', 'quotes'),
('Excluir Orçamentos', 'quotes.delete', 'quotes'),
-- Financeiro
('Visualizar Financeiro', 'finance.view', 'finance'),
('Criar Lançamentos', 'finance.create', 'finance'),
('Editar Lançamentos', 'finance.edit', 'finance'),
('Excluir Lançamentos', 'finance.delete', 'finance'),
('Relatórios Financeiros', 'finance.reports', 'finance'),
-- Blog
('Visualizar Blog', 'blog.view', 'blog'),
('Criar Posts', 'blog.create', 'blog'),
('Editar Posts', 'blog.edit', 'blog'),
('Excluir Posts', 'blog.delete', 'blog'),
('Gerar Posts com IA', 'blog.ai_generate', 'blog'),
-- Portfólio
('Visualizar Portfólio', 'portfolio.view', 'portfolio'),
('Criar Portfólio', 'portfolio.create', 'portfolio'),
('Editar Portfólio', 'portfolio.edit', 'portfolio'),
('Excluir Portfólio', 'portfolio.delete', 'portfolio'),
-- Newsletter
('Visualizar Newsletter', 'newsletter.view', 'newsletter'),
('Exportar Newsletter', 'newsletter.export', 'newsletter'),
('Importar Newsletter', 'newsletter.import', 'newsletter'),
-- Páginas (CMS)
('Visualizar Páginas', 'pages.view', 'pages'),
('Criar Páginas', 'pages.create', 'pages'),
('Editar Páginas', 'pages.edit', 'pages'),
('Excluir Páginas', 'pages.delete', 'pages'),
-- Configurações
('Visualizar Configurações', 'settings.view', 'settings'),
('Editar Configurações', 'settings.edit', 'settings'),
-- Logs
('Visualizar Logs', 'logs.view', 'logs'),
-- Backup
('Gerenciar Backups', 'backup.manage', 'backup'),
-- Versionamento
('Gerenciar Versões', 'versions.manage', 'versions'),
-- IA
('Usar Assistente IA', 'ai.use', 'ai');

-- -----------------------------------------------------------
-- Atribuir todas as permissões ao Super Admin
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 1, `id` FROM `permissions`;

-- -----------------------------------------------------------
-- Atribuir permissões ao Administrador (tudo exceto gerenciamento de usuários)
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 2, `id` FROM `permissions` WHERE `slug` NOT IN ('users.create', 'users.delete', 'settings.edit', 'backup.manage');

-- -----------------------------------------------------------
-- Atribuir permissões ao Editor
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 3, `id` FROM `permissions` WHERE `module` IN ('dashboard', 'blog', 'portfolio', 'pages');

-- -----------------------------------------------------------
-- Atribuir permissões ao Comercial
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 4, `id` FROM `permissions` WHERE `module` IN ('dashboard', 'clients', 'projects', 'quotes');

-- -----------------------------------------------------------
-- Atribuir permissões ao Financeiro
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 5, `id` FROM `permissions` WHERE `module` IN ('dashboard', 'finance', 'clients');

-- -----------------------------------------------------------
-- Atribuir permissões ao Marketing
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 6, `id` FROM `permissions` WHERE `module` IN ('dashboard', 'blog', 'portfolio', 'newsletter', 'pages');

-- -----------------------------------------------------------
-- Atribuir permissões ao Desenvolvedor
-- -----------------------------------------------------------
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 7, `id` FROM `permissions` WHERE `module` IN ('dashboard', 'logs', 'versions', 'backup', 'ai', 'settings');

-- -----------------------------------------------------------
-- Inserir usuário super admin padrão
-- Senha: OnSolutions@2024!
-- -----------------------------------------------------------
INSERT INTO `users` (`name`, `email`, `password`, `role_id`, `role`, `is_active`, `email_verified_at`) VALUES
('Super Admin', 'admin@onsolutions.com.br', '$2y$12$LK8oG1oH.y5q5S8X1dIJXeQ7v.Ww.k9P8gM5F2x3J6nN4TkGZqR2u', 1, 'super_admin', 1, NOW());

-- -----------------------------------------------------------
-- Inserir configurações padrão
-- -----------------------------------------------------------
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_group`) VALUES
-- Geral
('site_name', 'On Solutions', 'general'),
('site_description', 'Desenvolvimento de Software Sob Medida, Sistemas Personalizados e Inteligência Artificial', 'general'),
('site_keywords', 'software sob medida, desenvolvimento personalizado, integrações, automação, inteligência artificial, consultoria tecnologia', 'general'),
('base_url', 'http://localhost/site-onsolutions', 'general'),
('logo', '', 'general'),
('favicon', '', 'general'),
('phone', '', 'general'),
('whatsapp', '', 'general'),
('email', 'contato@onsolutions.com.br', 'general'),
('address', '', 'general'),
('city', '', 'general'),
('state', '', 'general'),
('zip_code', '', 'general'),
('country', 'Brasil', 'general'),
-- Redes Sociais
('social_facebook', '', 'social'),
('social_instagram', '', 'social'),
('social_linkedin', '', 'social'),
('social_youtube', '', 'social'),
('social_github', '', 'social'),
-- SMTP
('smtp_host', '', 'smtp'),
('smtp_port', '587', 'smtp'),
('smtp_username', '', 'smtp'),
('smtp_password', '', 'smtp'),
('smtp_encryption', 'tls', 'smtp'),
('smtp_from_email', '', 'smtp'),
('smtp_from_name', 'On Solutions', 'smtp'),
-- Google
('google_analytics_id', '', 'google'),
('google_tag_manager_id', '', 'google'),
('meta_pixel_id', '', 'google'),
-- APIs de IA
('openai_api_key', '', 'ai'),
('openai_model', 'gpt-4', 'ai'),
('gemini_api_key', '', 'ai'),
('claude_api_key', '', 'ai'),
('deepseek_api_key', '', 'ai'),
('ai_default_provider', 'openai', 'ai'),
-- Blog IA
('blog_ai_enabled', '0', 'blog_ai'),
('blog_ai_articles_per_week', '3', 'blog_ai'),
('blog_ai_publish_days', '["monday","wednesday","friday"]', 'blog_ai'),
('blog_ai_model', 'openai', 'blog_ai'),
('blog_ai_writing_style', 'professional', 'blog_ai'),
('blog_ai_custom_prompt', '', 'blog_ai'),
('blog_ai_auto_image', '1', 'blog_ai'),
('blog_ai_auto_categories', '1', 'blog_ai'),
-- Idiomas
('default_language', 'pt', 'language'),
('active_languages', '["pt","en","es"]', 'language'),
-- Chatbot
('chatbot_enabled', '1', 'chatbot'),
('chatbot_greeting', 'Olá! Como posso ajudá-lo?', 'chatbot'),
('chatbot_ai_provider', 'openai', 'chatbot'),
-- WhatsApp
('whatsapp_enabled', '1', 'whatsapp'),
('whatsapp_number', '', 'whatsapp'),
('whatsapp_message', 'Olá! Gostaria de saber mais sobre os serviços da On Solutions.', 'whatsapp');

SET FOREIGN_KEY_CHECKS = 1;
