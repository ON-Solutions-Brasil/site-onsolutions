<?php

namespace App\Middlewares;

/**
 * Middleware de permissão.
 * Verifica se o usuário tem a permissão necessária.
 */
class PermissionMiddleware
{
    private string $permission;

    public function __construct(string $permission = '')
    {
        $this->permission = $permission;
    }

    public function handle(): bool
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $user = $_SESSION['user'] ?? null;

        // Super admin tem acesso total
        if ($user && $user['role'] === 'super_admin') {
            return true;
        }

        // Verificar permissão específica
        if (!empty($this->permission)) {
            $permissions = $_SESSION['permissions'] ?? [];
            if (!in_array($this->permission, $permissions)) {
                http_response_code(403);
                require APP_PATH . '/views/errors/403.php';
                exit;
            }
        }

        return true;
    }
}
