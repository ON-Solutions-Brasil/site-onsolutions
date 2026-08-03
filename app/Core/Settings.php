<?php

namespace App\Core;

/**
 * Classe para gerenciar configurações armazenadas no banco de dados.
 * Singleton - carrega todas as configurações uma vez e mantém em cache.
 */
class Settings
{
    private static ?Settings $instance = null;
    private array $settings = [];
    private Database $db;

    private function __construct(Database $db)
    {
        $this->db = $db;
        $this->loadAll();
    }

    /**
     * Obtém a instância única.
     */
    public static function getInstance(Database $db = null): self
    {
        if (self::$instance === null) {
            if ($db === null) {
                throw new \RuntimeException('Database instance required for first initialization.');
            }
            self::$instance = new self($db);
        }
        return self::$instance;
    }

    /**
     * Carrega todas as configurações do banco.
     */
    private function loadAll(): void
    {
        try {
            $results = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings");
            foreach ($results as $row) {
                $this->settings[$row['setting_key']] = $row['setting_value'];
            }
        } catch (\PDOException $e) {
            // Tabela pode não existir ainda na instalação inicial
            $this->settings = [];
        }
    }

    /**
     * Obtém uma configuração pelo nome.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->settings[$key] ?? $default;
    }

    /**
     * Define uma configuração (salva no banco).
     */
    public function set(string $key, mixed $value): void
    {
        $existing = $this->db->fetch(
            "SELECT id FROM settings WHERE setting_key = ?",
            [$key]
        );

        if ($existing) {
            $this->db->update('settings', ['setting_value' => $value], 'setting_key = ?', [$key]);
        } else {
            $this->db->insert('settings', [
                'setting_key'   => $key,
                'setting_value' => $value,
            ]);
        }

        $this->settings[$key] = $value;
    }

    /**
     * Remove uma configuração.
     */
    public function delete(string $key): void
    {
        $this->db->delete('settings', 'setting_key = ?', [$key]);
        unset($this->settings[$key]);
    }

    /**
     * Retorna todas as configurações.
     */
    public function all(): array
    {
        return $this->settings;
    }

    /**
     * Retorna configurações de um grupo (prefixo).
     */
    public function group(string $prefix): array
    {
        $group = [];
        foreach ($this->settings as $key => $value) {
            if (str_starts_with($key, $prefix . '_')) {
                $shortKey = substr($key, strlen($prefix) + 1);
                $group[$shortKey] = $value;
            }
        }
        return $group;
    }

    /**
     * Recarrega as configurações do banco.
     */
    public function reload(): void
    {
        $this->settings = [];
        $this->loadAll();
    }
}
