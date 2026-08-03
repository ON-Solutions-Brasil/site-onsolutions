<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    /**
     * Busca usuário por email.
     */
    public function findByEmail(string $email): ?array
    {
        return $this->db->fetch(
            "SELECT u.*, r.name as role_name, r.slug as role_slug 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.email = ? LIMIT 1",
            [$email]
        );
    }

    /**
     * Busca usuário por ID com dados do perfil.
     */
    public function findWithRole(int $id): ?array
    {
        return $this->db->fetch(
            "SELECT u.*, r.name as role_name, r.slug as role_slug 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.id = ?",
            [$id]
        );
    }

    /**
     * Retorna permissões do usuário.
     */
    public function getPermissions(int $roleId): array
    {
        $results = $this->db->fetchAll(
            "SELECT p.slug FROM permissions p 
             JOIN role_permissions rp ON p.id = rp.permission_id 
             WHERE rp.role_id = ?",
            [$roleId]
        );

        return array_column($results, 'slug');
    }

    /**
     * Registra tentativa de login falha.
     */
    public function incrementLoginAttempts(int $userId): void
    {
        $this->db->query(
            "UPDATE users SET login_attempts = login_attempts + 1 WHERE id = ?",
            [$userId]
        );
    }

    /**
     * Reseta tentativas de login.
     */
    public function resetLoginAttempts(int $userId): void
    {
        $this->db->update($this->table, [
            'login_attempts' => 0,
            'locked_until'   => null,
        ], 'id = ?', [$userId]);
    }

    /**
     * Bloqueia o usuário temporariamente.
     */
    public function lockUser(int $userId, int $minutes = 30): void
    {
        $lockedUntil = date('Y-m-d H:i:s', strtotime("+{$minutes} minutes"));
        $this->db->update($this->table, ['locked_until' => $lockedUntil], 'id = ?', [$userId]);
    }

    /**
     * Atualiza último login.
     */
    public function updateLastLogin(int $userId, string $ip): void
    {
        $this->db->update($this->table, [
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
            'login_attempts' => 0,
            'locked_until'   => null,
        ], 'id = ?', [$userId]);
    }

    /**
     * Define token de reset de senha.
     */
    public function setResetToken(int $userId, string $token): void
    {
        $this->db->update($this->table, [
            'reset_token'         => $token,
            'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ], 'id = ?', [$userId]);
    }

    /**
     * Busca por reset token.
     */
    public function findByResetToken(string $token): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM users WHERE reset_token = ? AND reset_token_expires > NOW()",
            [$token]
        );
    }

    /**
     * Limpa token de reset.
     */
    public function clearResetToken(int $userId): void
    {
        $this->db->update($this->table, [
            'reset_token'         => null,
            'reset_token_expires' => null,
        ], 'id = ?', [$userId]);
    }

    /**
     * Lista todos os usuários com perfil.
     */
    public function allWithRole(): array
    {
        return $this->db->fetchAll(
            "SELECT u.*, r.name as role_name 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             ORDER BY u.name ASC"
        );
    }

    /**
     * Conta usuários ativos.
     */
    public function countActive(): int
    {
        $result = $this->db->fetch("SELECT COUNT(*) as total FROM users WHERE is_active = 1");
        return (int) ($result['total'] ?? 0);
    }
}
