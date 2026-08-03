<?php

namespace App\Middlewares;

/**
 * Middleware de autenticação.
 * Verifica se o usuário está logado.
 */
class AuthMiddleware
{
    public function handle(): bool
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        // Verificar se a sessão não expirou
        $sessionLifetime = 7200; // 2 horas
        if (isset($_SESSION['last_activity'])) {
            if (time() - $_SESSION['last_activity'] > $sessionLifetime) {
                session_destroy();
                header('Location: ' . BASE_URL . '/admin/login?expired=1');
                exit;
            }
        }
        $_SESSION['last_activity'] = time();

        return true;
    }
}
