<?php

namespace App\Models;

use App\Core\Model;

class ActivityLog extends Model
{
    protected string $table = 'activity_logs';

    /**
     * Registra uma atividade no log.
     */
    public function log(string $action, string $module, ?string $description = null, array $extra = []): int
    {
        $data = [
            'user_id'     => $_SESSION['user_id'] ?? null,
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'target_type' => $extra['target_type'] ?? null,
            'target_id'   => $extra['target_id'] ?? null,
            'old_values'  => isset($extra['old_values']) ? json_encode($extra['old_values']) : null,
            'new_values'  => isset($extra['new_values']) ? json_encode($extra['new_values']) : null,
            'ip_address'  => clientIp(),
            'user_agent'  => $_SERVER['HTTP_USER_AGENT'] ?? null,
        ];

        return $this->create($data);
    }

    /**
     * Obtém logs com informações do usuário.
     */
    public function getWithUser(int $page = 1, int $perPage = 50): array
    {
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch("SELECT COUNT(*) as total FROM activity_logs");
        $totalRecords = (int) ($total['total'] ?? 0);

        $records = $this->db->fetchAll(
            "SELECT al.*, u.name as user_name, u.email as user_email 
             FROM activity_logs al 
             LEFT JOIN users u ON al.user_id = u.id 
             ORDER BY al.created_at DESC 
             LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );

        return [
            'data'         => $records,
            'total'        => $totalRecords,
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => (int) ceil($totalRecords / $perPage),
        ];
    }

    /**
     * Filtra logs por módulo.
     */
    public function getByModule(string $module, int $limit = 50): array
    {
        return $this->db->fetchAll(
            "SELECT al.*, u.name as user_name 
             FROM activity_logs al 
             LEFT JOIN users u ON al.user_id = u.id 
             WHERE al.module = ? 
             ORDER BY al.created_at DESC 
             LIMIT ?",
            [$module, $limit]
        );
    }
}
