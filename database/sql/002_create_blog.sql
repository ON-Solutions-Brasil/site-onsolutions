-- ============================================================
-- On Solutions - Script SQL #002
-- Tabelas do Blog
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- Tabela: blog_categories (categorias do blog)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name_pt` VARCHAR(255) NOT NULL,
    `name_en` VARCHAR(255) NULL,
    `name_es` VARCHAR(255) NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description_pt` TEXT NULL,
    `description_en` TEXT NULL,
    `description_es` TEXT NULL,
    `image` VARCHAR(500) NULL,
    `parent_id` INT UNSIGNED NULL,
    `order_position` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`parent_id`) REFERENCES `blog_categories`(`id`) ON DELETE SET NULL,
    INDEX `idx_blog_cat_slug` (`slug`),
    INDEX `idx_blog_cat_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: blog_tags (tags do blog)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_tags` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_blog_tag_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: blog_posts (posts do blog)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title_pt` VARCHAR(500) NOT NULL,
    `title_en` VARCHAR(500) NULL,
    `title_es` VARCHAR(500) NULL,
    `slug` VARCHAR(500) NOT NULL UNIQUE,
    `excerpt_pt` TEXT NULL,
    `excerpt_en` TEXT NULL,
    `excerpt_es` TEXT NULL,
    `content_pt` LONGTEXT NULL,
    `content_en` LONGTEXT NULL,
    `content_es` LONGTEXT NULL,
    `featured_image` VARCHAR(500) NULL,
    `author_id` INT UNSIGNED NOT NULL,
    `category_id` INT UNSIGNED NULL,
    `status` ENUM('draft', 'published', 'scheduled', 'archived') DEFAULT 'draft',
    `is_featured` TINYINT(1) DEFAULT 0,
    `allow_comments` TINYINT(1) DEFAULT 1,
    `views_count` INT UNSIGNED DEFAULT 0,
    `meta_title_pt` VARCHAR(255) NULL,
    `meta_title_en` VARCHAR(255) NULL,
    `meta_title_es` VARCHAR(255) NULL,
    `meta_description_pt` VARCHAR(500) NULL,
    `meta_description_en` VARCHAR(500) NULL,
    `meta_description_es` VARCHAR(500) NULL,
    `meta_keywords` VARCHAR(500) NULL,
    `og_image` VARCHAR(500) NULL,
    `generated_by_ai` TINYINT(1) DEFAULT 0,
    `ai_model_used` VARCHAR(100) NULL,
    `scheduled_at` TIMESTAMP NULL,
    `published_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`category_id`) REFERENCES `blog_categories`(`id`) ON DELETE SET NULL,
    INDEX `idx_blog_slug` (`slug`),
    INDEX `idx_blog_status` (`status`),
    INDEX `idx_blog_published` (`published_at`),
    INDEX `idx_blog_featured` (`is_featured`),
    INDEX `idx_blog_ai` (`generated_by_ai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: blog_post_tags (relação post-tag)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_post_tags` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT UNSIGNED NOT NULL,
    `tag_id` INT UNSIGNED NOT NULL,
    UNIQUE KEY `unique_post_tag` (`post_id`, `tag_id`),
    FOREIGN KEY (`post_id`) REFERENCES `blog_posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tag_id`) REFERENCES `blog_tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: blog_comments (comentários)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_comments` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT UNSIGNED NOT NULL,
    `parent_id` INT UNSIGNED NULL,
    `author_name` VARCHAR(255) NOT NULL,
    `author_email` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `ip_address` VARCHAR(45) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `blog_posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`parent_id`) REFERENCES `blog_comments`(`id`) ON DELETE CASCADE,
    INDEX `idx_comments_post` (`post_id`),
    INDEX `idx_comments_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Tabela: blog_ai_queue (fila de geração por IA)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_ai_queue` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `topic` VARCHAR(500) NULL,
    `keywords` VARCHAR(500) NULL,
    `category_id` INT UNSIGNED NULL,
    `status` ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    `generated_post_id` INT UNSIGNED NULL,
    `ai_provider` VARCHAR(100) NULL,
    `error_message` TEXT NULL,
    `scheduled_for` TIMESTAMP NULL,
    `processed_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `blog_categories`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`generated_post_id`) REFERENCES `blog_posts`(`id`) ON DELETE SET NULL,
    INDEX `idx_ai_queue_status` (`status`),
    INDEX `idx_ai_queue_scheduled` (`scheduled_for`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Inserir categorias padrão do blog
-- -----------------------------------------------------------
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`) VALUES
('Tecnologia', 'Technology', 'Tecnología', 'tecnologia'),
('Desenvolvimento', 'Development', 'Desarrollo', 'desenvolvimento'),
('Inteligência Artificial', 'Artificial Intelligence', 'Inteligencia Artificial', 'inteligencia-artificial'),
('Integrações', 'Integrations', 'Integraciones', 'integracoes'),
('Automação', 'Automation', 'Automatización', 'automacao'),
('Cases de Sucesso', 'Success Stories', 'Casos de Éxito', 'cases-de-sucesso'),
('Dicas e Tutoriais', 'Tips and Tutorials', 'Consejos y Tutoriales', 'dicas-e-tutoriais'),
('Mercado', 'Market', 'Mercado', 'mercado');

SET FOREIGN_KEY_CHECKS = 1;
