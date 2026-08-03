<?php

namespace App\Models;

use App\Core\Model;

class Setting extends Model
{
    protected string $table = 'settings';

    /**
     * Obtém valor de uma configuração.
     */
    public function getValue(string $key, mixed $default = null): mixed
    {
        $result = $this->db->fetch(
            "SELECT setting_value FROM settings WHERE setting_key = ?",
            [$key]
        );
        return $result['setting_value'] ?? $default;
    }

    /**
     * Define valor de uma configuração.
     */
    public function setValue(string $key, mixed $value, string $group = 'general'): void
    {
        $existing = $this->db->fetch(
            "SELECT id FROM settings WHERE setting_key = ?",
            [$key]
        );

        if ($existing) {
            $this->db->update('settings', [
                'setting_value' => $value,
                'setting_group' => $group,
            ], 'setting_key = ?', [$key]);
        } else {
            $this->db->insert('settings', [
                'setting_key'   => $key,
                'setting_value' => $value,
                'setting_group' => $group,
            ]);
        }
    }

    /**
     * Obtém todas as configurações de um grupo.
     */
    public function getGroup(string $group): array
    {
        return $this->db->fetchAll(
            "SELECT setting_key, setting_value FROM settings WHERE setting_group = ?",
            [$group]
        );
    }

    /**
     * Salva múltiplas configurações de uma vez.
     */
    public function saveMultiple(array $data, string $group = 'general'): void
    {
        foreach ($data as $key => $value) {
            $this->setValue($key, $value, $group);
        }
    }
}
