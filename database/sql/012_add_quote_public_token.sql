-- ============================================================
-- ON Solutions - Script SQL #012
-- Adicionar campo public_token na tabela quotes
-- Para acesso público ao orçamento via link compartilhável
-- ============================================================

ALTER TABLE `quotes` ADD COLUMN `public_token` VARCHAR(64) NULL UNIQUE AFTER `quote_number`;

-- Gerar tokens para orçamentos existentes
UPDATE `quotes` SET `public_token` = LOWER(CONCAT(
    HEX(RANDOM_BYTES(4)), '-',
    HEX(RANDOM_BYTES(2)), '-',
    HEX(RANDOM_BYTES(2)), '-',
    HEX(RANDOM_BYTES(2)), '-',
    HEX(RANDOM_BYTES(6))
)) WHERE `public_token` IS NULL;
